<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

Route::get('/test', function () {

 //     $process = new Process('ls -lrth /usr/local/bin');
     
 //     $process->run();
 //     dd($process->getIncrementalOutput());

	// foreach ($process as $type => $data) {

	//     if ($process::OUT === $type) {
	//         echo "\nRead from stdout: ".$data;
	//     } else { // $process::ERR === $type
	//         echo "\nRead from stderr: ".$data;
	//     }
	// }
	$path = public_path('template1');
	$process = new Process('terraform init -input=false');
	$process = new Process('ls -lrtha');
	//$process->setTimeout(3600);
    $process->setWorkingDirectory($path);
    $process->run();
    $process->setCommandLine('terraform12 apply -auto-approve -input=false');
    $process->run() ;
    foreach ($process as $type => $data) {

	    if ($process::OUT === $type) {
	        echo "\nRead from stdout: ".$data;
	    } else { // $process::ERR === $type
	        echo "\nRead from stderr: ".$data;
	    }
	}


});


Route::get('create-vm', 'VmController@index');
Route::post('vm', 'VmController@store');
Route::get('vm', 'VmController@show')->name('showVmLogs');
Route::post('vm/{id}', 'VmController@destroy')->name('deletevm');
Auth::routes();

Route::get('/', 'VmController@index')->name('home');
