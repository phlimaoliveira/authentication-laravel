
<!DOCTYPE html>
<html lang="pt-br">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>{{ __('auth.title_login') }}</title>

  <!-- Custom fonts for this template-->  
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="{{ asset('site/style.css') }}" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center" style="margin-top:120px;">

      <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">{{ __('auth.welcome_back') }}</h1>
                  </div>
                  <form class="user" method="POST" action="{{ route('user.auth') }}">
                    @csrf
                    <div class="form-group">
                      <input type="email" class="form-control form-control-user" name="email" aria-describedby="emailHelp" placeholder="{{ __('auth.email') }}">
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control form-control-user" name="password" placeholder="{{ __('auth.password') }}">
                    </div>

                    @if(Session::has('authError'))
                      <div class="form-group text-center">
                        <div class="m-0 font-weight-bold text-errors">{{ __('auth.authError') }}</div>
                      </div>
                    @endif
                    
                    <input type="submit" class="btn btn-primary btn-user btn-block" value="{{ __('auth.login') }}">                                          
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
                    <a class="small" href="/register">{{ __('auth.new_account') }}</a>
                  </div>
                </div>
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
