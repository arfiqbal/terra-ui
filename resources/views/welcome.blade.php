@extends('layouts.app')

@section('title')
Create VM | All VM
@endsection

@section('content')

  <!-- Page Content -->
    <div class="container">
        <div class="row">
            <div class="col-md-12 ">
                @if (session('vms'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                  {{ session('vms') }} has been created successfully
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                @endif
                <div class="card " >
                    <div class="card-header">

                        <ul class="nav nav-pills card-header-pills" id="pills-tab" role="tablist">
                          <li class="nav-item">
                            <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Create</a>
                          </li>

                          <li class="nav-item">
                            <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">All VM</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" id="pills-terminal-tab" data-toggle="pill" href="#pills-terminal" role="tab" aria-controls="pills-terminal" aria-selected="false">Terminal</a>
                          </li>
                          
                        </ul>
                    </div>

                    <div class="card-body">
                        
                        <div class="tab-content" id="pills-tabContent">

                          <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                            <div class="row">
                            <div class="col-md-6">
                                
                                <!-- <form method="POST" action="" class="" novalidate>
                                    {{ csrf_field() }} -->

                                <div class="card" id="vmmessgae">

                                  <div class="card-header">
                                    Creating VM for you
                                  </div>
                                  <div class="card-body">
                                    <h5 class="card-title">
                                        <div class="spinner-grow text-primary" role="status">
                                          <span class="sr-only">Loading...</span>
                                        </div>
                                        <div class="spinner-grow text-secondary" role="status">
                                          <span class="sr-only">Loading...</span>
                                        </div>
                                        <div class="spinner-grow text-success" role="status">
                                          <span class="sr-only">Loading...</span>
                                        </div>
                                        <div class="spinner-grow text-danger" role="status">
                                          <span class="sr-only">Loading...</span>
                                        </div>
                                        <div class="spinner-grow text-warning" role="status">
                                          <span class="sr-only">Loading...</span>
                                        </div>
                                        <div class="spinner-grow text-info" role="status">
                                          <span class="sr-only">Loading...</span>
                                        </div>
                                        <div class="spinner-grow text-light" role="status">
                                          <span class="sr-only">Loading...</span>
                                        </div>
                                    </h5>
                                    <p class="card-text">Please don't go back or refresh this page. You can view the logs in the terminal</p>
                                    
                                  </div>
                                </div>

                               
                                 <form id="hide-vm">

                                <div class="form-group">
                                    <label for="uname1">VM Name</label>
                                    <input type="text" class="form-control"  id="vmname" required>
                                   
                                </div>

                                <div class="form-group">
                                    <label for="uname1">Email</label>
                                    <input type="email" class="form-control"  id="email" required>
                                    
                                </div>

                                <div class="form-group">
                                    <label for="ipAddress">Routeable IP (Nic1)</label>
                                    <input type="text" class="form-control"  required id="ipAddress" ip-mask placeholder="000.000.000.000" value="{{$ips->nic1}}">
                                    <div class="invalid-feedback">Please enter valid IP range</div>
                                </div>
                                <div class="form-group">
                                    <label for="uname1">Non-Routeable IP (Nic2)</label>
                                    <input type="text" class="form-control"  id="ipAddress2" ip-mask placeholder="000.000.000.000" required value="{{$ips->nic2}}">
                                    <input type="hidden" name="ip_id" value="{{$ips->id}}">
                                    <div class="invalid-feedback">Please enter valid IP range</div>
                                </div>

                                
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Application</label>
                                    <select class="form-control"  id="app" required>
                                    <option value="">Select Application Image</option>
                                    @foreach ($apps as $app)
                                        <option value="{{$app->id}}">{{$app->name}}</option>
                                    @endforeach
                                      
                                    </select>
                                    <div class="invalid-feedback">Please select application </div>
                                  </div>

                                

                                <button type="button" id="launchVM" class="btn btn-success">Launch VM</button>
                            </form>
                                
                            </div>
                            <div class="col-md-6 float-right">
                                @if (count($available_ips))
                                <table class="table">
                                    <thead class="thead-dark">
                                    <tr>
                                      <th scope="col" colspan="3">Available IPs</th>
                                      
                                    </tr>
                                  </thead>
                                  <thead class="thead-dark">
                                    <tr>
                                      
                                      <th scope="col">Nic 1</th>
                                      <th scope="col">Nic 2</th>
                                      
                                    </tr>
                                  </thead>
                                  <tbody>
                                    @foreach ($available_ips as $ip)
                                    <tr>
                                      
                                      <td>{{$ip->nic1}}</td>
                                      <td>{{$ip->nic2}}</td>
                                      
                                    </tr>
                                    @endforeach
                                  </tbody>
                                </table>
                                @else
                                <h2>NO Ip found please contact mahesh</h2>
                                @endif

                            </div>
                        </div>
                            

                              
                          </div>
                            <!-- All VM -->
                          <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                            <table class="table table-hover table-striped" id="showVm">
                              <thead>
                                <tr>
                                  <th scope="col">Name</th>
                                  <th scope="col">Email</th>
                                  <th scope="col">Nic 1</th>
                                  <th scope="col">Nic 2</th>
                                  <th scope="col">Application</th>
                                  <th scope="col">Action</th>
                                </tr>
                              </thead>
                              <tbody>
                                @if(count($allVM))
                                    @foreach($allVM as $myVM)
                                        <tr id="{{$myVM->id}}">
                                          <th scope="row">{{$myVM->name}}</th>
                                          <td>{{$myVM->email}}</td>
                                          <td>{{$myVM->ips->nic1}}</td>
                                          <td>{{$myVM->ips->nic2}}</td>
                                          <td>{{$myVM->application->name}}</td>
                                          <td>
                                            
                                            <a  class="btn btn-danger deletevm" data-order="{{ $myVM->name }}"
                                            data-order_destroy_route="{{ route('deletevm', ['id' => $myVM->id]) }}"><img src="{{ asset('images/trash.svg') }}" alt="" width="24" height="24" title="DELETE VM"></a>
                                            

                                            <a  class="btn btn-info showlog" data-toggle="modal" data-target="#logs{{$myVM->id}}" data-order="{{$myVM->id}}"><img src="{{ asset('images/eye-fill.svg') }}" alt="" width="24" height="24" title="View log"></a>
                                           </td>
                                        </tr>
                                        
                                    @endforeach
                                @endif
                                
                              </tbody>
                            </table>
                          </div> <!-- All vM -->

                            <!-- All VM -->
                          <div class="tab-pane fade" id="pills-terminal" role="tabpanel" aria-labelledby="pills-terminal-tab" style="color: #fff;background: #000">
                            <div class="container" id="terminal-body">
                                asda
                            </div>
                          </div> <!-- All vM -->
                          
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
<div class="modal fade modal-xl" id="mylogmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle">View Log</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      
      </div>
      
    </div>
  </div>
</div>
@endsection
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
@section('js')
    <script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('#vmmessgae').hide();
    
    $(document).ready(function(){
      
      $("#launchVM").click(function(event) {
        event.preventDefault()
        var vmname = $('#vmname').val();
            var email = $('#email').val();
            var nic1 = $('#ipAddress').val(); 
            var nic2 = $('#ipAddress2').val();
             var app = $('#app option:selected').val();

        // Fetch form to apply custom Bootstrap validation
        var form = $("#hide-vm")
    
        if (form[0].checkValidity() === false) {
          console.log(form[0].checkValidity());
          event.preventDefault()
          event.stopPropagation()
          
        }else{
          
          //=============ajax call=====================

          form.addClass('was-validated');
          $('#hide-vm').hide();
          $('#vmmessgae').show();
              
  
              $.ajax({
                  type:'POST',
                  url: "<?= URL::to("vm");?>",
                  data: {vmname :vmname, email:email, nic1 :nic1, nic2 :nic2, app :app},
                  xhr: function () {
                      var xhr = $.ajaxSettings.xhr() ;
                      xhr.onprogress = function (e) {
                          //console.log(e.currentTarget.responseText);
                          $('#terminal-body').html(e.currentTarget.responseText);  
                      }
                      
                      return xhr ;
                       
                  },
                  success: function(data){
                      $('#vmmessgae').hide();
                       $('#hide-vm').show();
                       console.log(data);
                       //alert(vmname+ ' VM Created');
                       
                       //location.reload(true);
                  }
                  
              })
             

          // ==============ajax call ends here===========

        }
        
        
        
      });


      // ==============================

      $('[ip-mask]').ipAddress();

        $('#showVm  .showlog').click(function(){
                var id = $(this).attr('data-order');
                //console.log(id);
                $.get(
                   '<?=URL::to("vm");?>',
                   {'id': id },
                  function(result){

                    //console.log(result);

                    if(result){
                        $('.modal-body').html(result);
                        $('#mylogmodal').modal();
                    }
                  }
                );

        })

        $('#showVm tr td .deletevm').on('click', function(){
                var order = $(this).attr('data-order');
                var orderRoute = $(this).attr('data-order_destroy_route');

                //console.log(order);

               deleteOrder(order ,orderRoute);
            });

            var deleteOrder = function(order,orderRoute)
            {
               var ask =  confirm("Are you absolutely sure you want to delete " + order + "? This action cannot be undone." +
            "This will permanently delete " + order + ", and remove all collections and resources associated with it.");

               if(ask == true)
               {

                    $.ajax({
                        type:'POST',
                        url: orderRoute,
                          
                        }).done(function(data) {
                          console.log(data)
                          $('#'+data).hide();
                          //alert('Deleted');
                          
                    }).fail(function() {
                        
                    })
                   
               }
            }
    

      
    });
    
</script>
@endsection
  