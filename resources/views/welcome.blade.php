<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" crossorigin="anonymous">

    <title>Openstack</title>
  </head>
   
   <body>

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark static-top" style="background-color: #ce3030 !important">
    <div class="container">
      <a class="navbar-brand" href="#">Vodafone</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active">
            <a class="nav-link" href="#">Home
              <span class="sr-only">(current)</span>
            </a>
          </li>
          
          <li class="nav-item">
            <a class="nav-link" href="#">Contact</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Page Content -->
    <div class="container">
        <div class="row">
            <div class="col-md-12 ">
                <div class="card " >
                    <div class="card-header">

                        <ul class="nav nav-pills card-header-pills" id="pills-tab" role="tablist">
                          <li class="nav-item">
                            <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Create</a>
                          </li>

                          <li class="nav-item">
                            <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Terminal</a>
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
                                {!! Form::open(array('url'=>'vm',
                                                  'method' =>'POST',
                                                  'class'=>'form needs-validation',
                                                  
                                                  'novalidate' 
                                 )) !!}

                                <div class="form-group">
                                    <label for="uname1">VM Name</label>
                                    <input type="text" class="form-control" name="vmname" id="uname1" required="">
                                    <div class="invalid-feedback">Please enter vm-name</div>
                                </div>

                                <div class="form-group">
                                    <label for="uname1">Email</label>
                                    <input type="email" class="form-control" name="uname1" id="uname1" required="">
                                    <div class="invalid-feedback">Please enter  email</div>
                                </div>

                                <div class="form-group">
                                    <label for="ipAddress">Routeable IP (Nic1)</label>
                                    <input type="text" class="form-control" name="nic1" required="" id="ipAddress" ip-mask placeholder="000.000.000.000" value="{{$ips->nic1}}">
                                    <div class="invalid-feedback">Please enter valid IP range</div>
                                </div>
                                <div class="form-group">
                                    <label for="uname1">Non-Routeable IP (Nic2)</label>
                                    <input type="text" class="form-control" name="nic2" id="ipAddress2" ip-mask placeholder="000.000.000.000" required="" value="{{$ips->nic2}}">
                                    <div class="invalid-feedback">Please enter valid IP range</div>
                                </div>

                                
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Application</label>
                                    <select class="form-control" name="app" id="uname1" required="">
                                    <option >Select Application Image</option>
                                    @foreach ($apps as $app)
                                        <option value="{{$app->uid}}">{{$app->name}}</option>
                                    @endforeach
                                      
                                    </select>
                                    <div class="invalid-feedback">Please select application </div>
                                  </div>

                                

                                <button type="submit" class="btn btn-success">Launch VM</button>
                            </form>
                                
                            </div>
                            <div class="col-md-6 float-right">
                                @if ($available_ips->count())
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

                          <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                          </div>
                          
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="{{ asset('js/jquery.js') }}"  crossorigin="anonymous"></script>
    <script src="{{ asset('js/popper.js') }}"  crossorigin="anonymous"></script>

    <script src="{{ asset('js/bootstrap.min.js') }}" crossorigin="anonymous"></script>
    <script src="{{ asset('js/ip.js') }}" crossorigin="anonymous"></script>
    <script>
    $(document).ready(function(){
        $('[ip-mask]').ipAddress();
    });
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function() {
      'use strict';
      window.addEventListener('load', function() {
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.getElementsByClassName('needs-validation');
        // Loop over them and prevent submission
        var validation = Array.prototype.filter.call(forms, function(form) {
          form.addEventListener('submit', function(event) {
            if (form.checkValidity() === false) {
              event.preventDefault();
              event.stopPropagation();
            }
            form.classList.add('was-validated');
          }, false);
        });
      }, false);
    })();
</script>
  </body>
</html>