<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Register-Eternal Event Organizer</title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="{{asset('')}}template/modules/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="{{asset('')}}template/modules/fontawesome/css/all.min.css">

  <!-- CSS Libraries -->
  <link rel="stylesheet" href="{{asset('')}}template/modules/jquery-selectric/selectric.css">

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
          <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2">
            <div class="login-brand">
              <img src="{{url('template/img/logonew2.png')}}" alt="logo" width="350" class="shadow-light">
            </div>

            <div class="card card-primary">
              <div class="card-header"><h4>Register</h4></div>

              <div class="card-body">
                <form class="user" method = "POST" enctype='multipart/form-data' action = "{{url('insert-register')}}">
                    @csrf
                    <div class="form-group ">
                        <label for="frist_name">Name</label>
                        <input id="frist_name" type="text" class="form-control" name="name" autofocus required>
                    </div>
                    <div class="row">
                        <div class="form-group col-6">
                            <label>Gender</label>
                            <select class="form-control selectric" name = "jenis_kelamin" required>
                                <option>--Choose Gender--</option>
                                <option value ="Male">Male</option>
                                <option value = "Female">Female</option>
                            </select>
                        </div>
                        <div class="form-group col-6">
                            <label>Birth Of Date</label>
                            <input type="date" name = "tgl_lahir" class="form-control" required>
                        </div>
                    </div>


                    <div class="form-group">
                        <label>Address</label>
                        <input type="text" name="alamat" required class="form-control">
                    </div>


                    <div class="row">
                        <div class="form-group col-6">
                            <label for="email">Email</label>
                            <input id="email" type="email" class="form-control" name="email" required>
                        </div>
                        <div class="form-group col-6">
                            <label>Phone Number</label>
                            <input type="number" name = "phone_number" class="form-control" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-6">
                            <label>Photo</label>
                            <input type="file" name = "gambar" class="form-control" required>
                        </div>
                        <div class="form-group col-6">
                            <label for="cv">Curriculum vitae</label>
                            <input id="cv" type="file" class="form-control" name="cv" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password" class="d-block">Password</label>
                        <input id="password" type="password" class="form-control pwstrength" data-indicator="pwindicator" name="password" required>
                        <div id="pwindicator" class="pwindicator">
                            <div class="bar"></div>
                            <div class="label"></div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="custom-control custom-checkbox">
                        <input type="checkbox" name="agree" class="custom-control-input" id="agree" required>
                        <label class="custom-control-label" for="agree">I agree with all the terms and conditions</label>
                        </div>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-lg btn-block">
                        Register
                        </button>
                    </div>
                </form>

                <div class="mt-5 text-muted text-center">
                    Already have an account? <a href="{{url('login')}}">Login</a>
                  </div>
              </div>
            </div>
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
  <script src="{{asset('')}}template/modules/jquery-pwstrength/jquery.pwstrength.min.js"></script>
  <script src="{{asset('')}}template/modules/jquery-selectric/jquery.selectric.min.js"></script>

  <!-- Page Specific JS File -->
  <script src="{{asset('')}}template/js/page/auth-register.js"></script>

  <!-- Template JS File -->
  <script src="{{asset('')}}template/js/scripts.js"></script>
  <script src="{{asset('')}}template/js/custom.js"></script>
</body>
</html>
