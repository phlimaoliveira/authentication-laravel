<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>{{ __('auth.dashboard') }}</title>

  <!-- Custom fonts for this template-->
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="{{ asset('site/style.css') }}" rel="stylesheet">

  <style>
      body {
          width:100%;
          height: 100%;
          background: #f8f9fc;
      }
  </style>
</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <div class="container" style="margin-top:80px;">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">{{ __('auth.reset_password') }}</h6>
                          </div>
        
                        <div class="card-body">

                            <form class="user" method="POST" action="{{ route('user.reset-password') }}">
                                @csrf                                       

                                @if(Session::has('passwordNotCheck'))
                                  <div class="form-group">
                                    <div class="m-0 font-weight-bold text-errors text-center">{{ __('auth.passwordNotCheck') }}</div>
                                  </div>
                                @endif

                                @if(Session::has('lengthErrorPassword'))
                                  <div class="form-group">
                                    <div class="m-0 font-weight-bold text-errors text-center">{{ __('auth.lengthErrorPassword') }}</div>
                                  </div>
                                @endif

                                @if(Session::has('authError'))
                                  <div class="form-group">
                                    <div class="m-0 font-weight-bold text-errors text-center">{{ __('auth.authError') }}</div>
                                  </div>
                                @endif

                                @if(Session::has('forgotSucess'))
                                  <div class="form-group">
                                    <div class="m-0 font-weight-bold text-success text-center">{{ __('auth.forgotSucess') }}</div>
                                  </div>
                                @endif
                                                                
                                <div class="form-group">
                                  <input type="email" class="form-control form-control-user" name="email" id="email" placeholder="{{ $email }}" disabled>                                  
                                </div>
                                <div class="form-group row">
                                  <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="password" class="form-control form-control-user" name="password" id="password" placeholder="{{ __('auth.password') }}" required autocomplete="new-password">                                    
                                  </div>
                                  <div class="col-sm-6">
                                    <input type="password" class="form-control form-control-user" name="retype_password" id="retype_password" placeholder="{{ __('auth.repeat_password') }}" required autocomplete="new-password">                                    
                                  </div>                  
                                </div>  
                                
                                <input type="hidden" id="email" name="email" value="{{ $email }}">
                                <input type="hidden" id="token" name="token" value="{{ $token }}">
                                <input type="submit" class="btn btn-primary btn-user btn-block" value="{{ __('auth.reset_password') }}">                
                            </form>                            
                              
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Bootstrap core JavaScript-->
  <script src="{{ asset('site/jquery.js') }}"></script>
  <script src="{{ asset('site/bootstrap.bundle.min.js') }}"></script>

  <!-- Core plugin JavaScript-->
  <script src="{{ asset('site/jquery.easing.min.js') }}"></script>

  <!-- Custom scripts for all pages-->
  <script src="{{ asset('site/sb-admin-2.min.js') }}"></script>

  <!-- Page level plugins -->
  <script src="{{ asset('site/Chart.min.js') }}"></script>

  <!-- Page level custom scripts -->
  <script src="{{ asset('site/chart-area-demo.js') }}"></script>
  <script src="{{ asset('site/chart-pie-demo.js') }}"></script>

</body>

</html>