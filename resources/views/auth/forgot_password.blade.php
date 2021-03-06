
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>{{ __('auth.title_forgot_password') }}</title>

  <!-- Custom fonts for this template-->
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="{{ asset('site/style.css') }}" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

  <div class="container" style="margin-top:120px;">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-6 d-none d-lg-block bg-password-image"></div>
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-2">{{ __('auth.forgot_password') }}</h1>
                    <p class="mb-4">{{ __('auth.message_forgot_password') }}</p>
                  </div>
                  
                  <form class="user" method="POST" action="{{ route('user.forgot-password') }}">
                    @csrf

                    @if(Session::has('passwordSent'))
                      <div class="form-group">
                        <div class="m-0 font-weight-bold text-success">{{ __('auth.passwordSent') }}</div>
                      </div>
                    @endif
                    
                    <div class="form-group">
                      <input type="email" class="form-control form-control-user" name="email" aria-describedby="emailHelp" placeholder="{{ __('auth.email_address') }}">
                    </div>

                    @if(Session::has('authError'))
                      <div class="form-group">
                        <div class="m-0 font-weight-bold text-errors text-center">{{ __('auth.authError') }}</div>
                      </div>
                    @endif

                    <input type="submit" class="btn btn-primary btn-user btn-block" value="{{ __('auth.reset_password') }}">                                        
                  </form>
                  <hr>
                  <div class="text-center">
                    <a class="small" href="/register">{{ __('auth.create_account') }}</a>
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

    </div>

  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="{{ asset('site/jquery.js') }}"></script>

  <!-- Custom scripts for all pages-->
  <script src="{{ asset('site/sb-admin-2.min.js') }}"></script>

</body>

</html>
