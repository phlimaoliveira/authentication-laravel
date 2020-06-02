
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

  <style>
      .bg-send-verification-image {
            background:url('../img/send_confirmation_email.png');    
            background-position: center;
            background-size: cover;
            height:600px;
        }
   </style>

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
              <div class="col-lg-6 d-none d-lg-block bg-send-verification-image"></div>
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h1 text-gray-900 mb-4" style="margin-top:100px;">Parabéns!</h1>
                  </div>
                  
                  <div class="text-justify">
                    <h4 class="h4 text-gray-900 mb-4">O seu cadastro está quase pronto! Foi enviado um e-mail e precisamos que você abra ele e confirme sua identidade, só para confirmar que você não é um robo, você entende né?</h4>
                  </div>
                  
                  <div class="text-center" style="margin-bottom:100px;">
                    <a href="{{ route('login') }}">Se você já confirmou, clique para Fazer Login</a>
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
