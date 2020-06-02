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

        @include('panel.partials.topbar')

        <div class="col-lg-12 mb-4">
            <div class="row justify-content-center align-items-center">
            <!-- Illustrations -->
            <div class="col-lg-6">
            <div class="card shadow mb-4 ">
              <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">{{ __('auth.verify_email_address') }}</h6>
              </div>
              <div class="card-body">
                @if (session('resent'))
                    <div class="alert alert-success" role="alert">
                        {{ __('auth.notification_send_email_verification') }}
                    </div>
                @endif
                
                <div class="text-center">
                    <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 25rem;" src="../img/email_unique.png" alt="">
                </div>                
                
                <div style="font-size:14pt">
                    {{ __('auth.message_email_verification_dashboard') }}
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" style="font-size:14pt" class="btn btn-link p-0 m-0 align-baseline">{{ __('auth.message_link_email_verification_dashboard') }}</button>
                    </form>
                </div>
              </div>
            </div>
            </div>
            </div>
          </div>

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">{{ __('auth.ready_to_leave') }}</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">{{ __('auth.message_ready_to_leave') }}</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">{{ __('auth.cancel') }}</button>
          <a class="btn btn-primary" href="{{ route('user.logout') }}">{{ __('auth.finish_session') }}</a>
        </div>
      </div>
    </div>
  </div>

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