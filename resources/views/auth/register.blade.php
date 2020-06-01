
<!DOCTYPE html>
<html lang="pt-br">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>{{ __('auth.title_register') }}</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="{{ asset('site/style.css') }}" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

  <div class="container" style="margin-top:120px;">

    <div class="card o-hidden border-0 shadow-lg my-5" >
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
          <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
          <div class="col-lg-7">
            <div class="p-5">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">{{ __('auth.create_account') }}</h1>
              </div>
              
              <form class="user" method="POST" action="{{ route('user.register') }}">
                @csrf
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="text" class="form-control form-control-user" name="first_name" id="first_name" placeholder="{{ __('auth.first_name') }}" required autofocus>
                  </div>
                  <div class="col-sm-6">
                    <input type="text" class="form-control form-control-user" name="last_name" id="last_name" placeholder="{{ __('auth.last_name') }}" required>
                  </div>
                </div>
                <div class="form-group">
                  <input type="email" class="form-control form-control-user" name="email" id="email" placeholder="{{ __('auth.email_address') }}" required>
                </div>
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="password" class="form-control form-control-user" name="password" id="password" placeholder="{{ __('auth.password') }}" required>
                  </div>
                  <div class="col-sm-6">
                    <input type="password" class="form-control form-control-user" name="retype_password" id="retype_password" placeholder="{{ __('auth.repeat_password') }}" required>
                  </div>                  
                </div>
                
                @if(Session::has('lengthErrorPassword'))
                  <div class="form-group">
                    <div class="m-0 font-weight-bold text-errors">{{ __('auth.lengthErrorPassword') }}</div>
                  </div>
                @endif

                @if(Session::has('passwordNotCheck'))
                  <div class="form-group">
                    <div class="m-0 font-weight-bold text-errors">{{ __('auth.passwordNotCheck') }}</div>                
                  </div>
                @endif

                @if(Session::has('userExist'))
                  <div class="form-group">
                    <div class="m-0 font-weight-bold text-errors">{{ __('auth.userExist') }}</div>                
                  </div>
                @endif
                
                <input type="submit" class="btn btn-primary btn-user btn-block" value="{{ __('auth.register') }}">                
                <hr>
                <a href="index.html" class="btn btn-google btn-user btn-block">
                  <i class="fab fa-google fa-fw"></i> {{ __('auth.login_with_google') }}
                </a>
                <a href="index.html" class="btn btn-facebook btn-user btn-block">
                  <i class="fab fa-facebook-f fa-fw"></i> {{ __('auth.login_with_facebook') }}
                </a>
              </form>
              <hr>
              <div class="text-center">
                <a class="small" href="/forgot-password">{{ __('auth.forgot_password') }}</a>
              </div>
              <div class="text-center">
                <a class="small" href="/login">{{ __('auth.already_have_account') }}</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="{{ asset('site/jquery.js') }}"></script>

  <!-- Custom scripts for all pages-->
  <script src="{{ asset('site/sb-admin-2.min.js') }}"></script>

</body>

</html>
