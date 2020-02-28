<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Application;
use App\IPs;
use App\VM;
use Log;
use File;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;


class VmController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $apps = Application::orderBy('id','DESC')->get();
        $ips  = IPs::orderBy('id','ASC')->where('active',1)->first();
        $available_ips  = IPs::orderBy('id','ASC')->where('active',1)->get();
        $allVM = VM::with('application','ips')->orderBy('id','DESC')->where('active',1)->get();

        //dd($allVM->toArray());
       
        return view('welcome',['apps' => $apps,'ips' => $ips, 'available_ips' => $available_ips,'allVM' => $allVM]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request);
        
        
        if(count($request)){

            $dir = $request->vmname.'-'.uniqid();
            //$dir = $request->vmname;

            $path = storage_path('app/'.$dir);
            

            $template = public_path('template/template.tf');

            $app = Application::find($request->app);
            // $newvm = New VM;
            //             $newvm->ip_id = $request->ip_id;
            //             $newvm->application_id = $request->app;
            //             $newvm->dir = $dir;
            //             $newvm->name = $request->vmname;
            //             $newvm->email = $request->email;
            //             $newvm->active = 1;
            //             if($newvm->save()){

            //                 $updateip = IPs::find($newvm->ip_id);
            //                 $updateip->active = 0;
            //                 $updateip->save(); 

                            
            //                 Log::info($request->vmname.'- VM created');

            //                 return redirect('/')->with('vms', $newvm->name);
            //             }


            //dd($template);

            $command = 'terraform apply -auto-approve -var="nic1='.$request->nic1.'" -var="nic2='.$request->nic1.'" -var="vmname='.$request->vmname.'" -var="app='.$app->uid.'" -var="emailid='.$request->email.'"';

            if(!File::isDirectory($path)){

                File::makeDirectory($path, 0777, true, true);
                File::copy($template, $path.'/main.tf');
                Log::useFiles($path.'/output.log');

                $process = new Process('terraform init -input=false');
                $process->setTimeout(3600);
                $process->setWorkingDirectory($path);
                $process->run();
                if ($process->isSuccessful()) {

                    $process->setCommandLine($command);
                    $process->run() ;
                    Log::debug($process->getOutput()); 

                        if (!$process->isSuccessful()) {
                            
                            Log::critical('Error occur while creating '.$request->vmname.'- VM');
                            throw new ProcessFailedException($process);
                        }

                        $newvm = New VM;
                        $newvm->ip_id = $request->ip_id;
                        $newvm->application_id = $request->app;
                        $newvm->dir = $dir;
                        $newvm->name = $request->vmname;
                        $newvm->email = $request->email;
                        $newvm->active = 1;
                        if($newvm->save()){

                            $updateip = IPs::find($newvm->ip_id);
                            $updateip->active = 0;
                            $updateip->save(); 

                            
                            Log::info($request->vmname.'- VM created');

                            return redirect('/')->with('vms', $newvm->name);
                        }

                    
                
                }else{
                        throw new ProcessFailedException($process);
                    }

                


            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        
        $showVmLogs = VM::find($request->id);
        $path = storage_path('app/'.$showVmLogs->dir.'/output.log');
        return File::get($path);
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleteVM = VM::find($id);
        // $deleteVM->active = 0;
        //     if($deleteVM->save()){
        //         return $deleteVM->id;
        //     }

        $path = storage_path('app/'.$deleteVM->dir);
        $process = new Process('terraform destroy');
        $process->setTimeout(3600);
        $process->setWorkingDirectory($path);
        $process->run();
        Log::debug($process->getOutput()); 
        if ($process->isSuccessful()) {


            $deleteVM->active = 0;
            if($deleteVM->save()){

                Log::info($deleteVM->vmname.'- VM deleted');
                return $deleteVM->id;
            }
        }


        
    }
}
