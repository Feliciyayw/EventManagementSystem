

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Eternal Event Organizer</title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="{{asset('')}}template/modules/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="{{asset('')}}template/modules/fontawesome/css/all.min.css">

  <!-- CSS Libraries -->
  <link rel="stylesheet" href="{{asset('')}}template/modules/bootstrap-social/bootstrap-social.css">

  <!-- Template CSS -->
  <link rel="stylesheet" href="{{asset('')}}template/css/style.css">
  <link rel="stylesheet" href="{{asset('')}}template/css/components.css">
<!-- Start GA -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-94034622-3');
</script>
<!-- /END GA --></head>

<body  style="background-color : #FAEFCC !important">
  <div id="app">
    <section class="section">
      <div class="container mt-5">
        <div class="row">
          <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
            <div class="login-brand">
              <img src="{{url('template/img/logonew2.png')}}" alt="logo" width="350" class="shadow-light">
            </div>

            <div class="card card-primary">
              <div class="card-header"><h4>Login</h4></div>
                @if (session()->has('err_message'))
                    <div class="alert alert-danger alert-dismissible" role="alert" auto-close="120">
                        <strong>Error! </strong>{{ session()->get('err_message') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                @if (session()->has('suc_message'))
                    <div class="alert alert-success alert-dismissible" role="alert" auto-close="120">
                        <strong>Success! </strong>{{ session()->get('suc_message') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
              <div class="card-body">
                <form method="POST" action="{{url('action-login')}}" class="needs-validation" novalidate="">
                  @csrf
                  <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" type="email" class="form-control" name="email" tabindex="1" required autofocus>
                    <div class="invalid-feedback">
                      Please fill in your email
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="d-block">
                    	<label for="password" class="control-label">Password</label>
                    </div>
                    <input id="password" type="password" class="form-control" name="password" tabindex="2" required>
                    <div class="invalid-feedback">
                      please fill in your password
                    </div>
                  </div>


                  <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                      Login
                    </button>
                    <a href="<?= url('')?>"  class="btn btn-warning btn-lg btn-block">Main Page</a>
                    <br>
                    <br>
                   <center>Does not have an account yet?<a href="{{url('register')}}"> Register</a></center>
                   <br>
                   <center>Forgot password? Please email admin</center>
                  </div>
                </form>


              </div>
            </div>
            {{-- <div class="mt-5 text-muted text-center">
              Register Akun Perseorangan? <a href="{{url('register')}}">Buat Akun Perseorangan</a>
            </div>

            <div class="mt-5 text-muted text-center">
                Register Akun Institusi? <a href="{{url('register-institusi')}}">Buat Akun Institusi</a>
              </div> --}}
            <div class="simple-footer">
              Copyright &copy; Eternal Event Organizer 2024
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  <!-- General JS Scripts -->
  <script src="{{asset('')}}template/modules/jquery.min.js"></script>
  <script src="{{asset('')}}template/modules/popper.js"></script>
  <script src="{{asset('')}}template/modules/tooltip.js"></script>
  <script src="{{asset('')}}template/modules/bootstrap/js/bootstrap.min.js"></script>
  <script src="{{asset('')}}template/modules/nicescroll/jquery.nicescroll.min.js"></script>
  <script src="{{asset('')}}template/modules/moment.min.js"></script>
  <script src="{{asset('')}}template/js/stisla.js"></script>

  <!-- JS Libraies -->

  <!-- Page Specific JS File -->

  <!-- Template JS File -->
  <script src="{{asset('')}}template/js/scripts.js"></script>
  <script src="{{asset('')}}template/js/custom.js"></script>
</body>
</html>
