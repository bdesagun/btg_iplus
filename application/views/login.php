<!-- =========================================================
* Argon Dashboard PRO v1.1.0
=========================================================

* Product Page: https://www.creative-tim.com/product/argon-dashboard-pro
* Copyright 2019 Creative Tim (https://www.creative-tim.com)

* Coded by Creative Tim

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
  <meta name="author" content="Creative Tim">
  <title><?php echo $_SESSION["systemname"]; ?></title>
  <?php require "css.php"; ?>
</head>

<body class="bg-default">
  <!-- Main content -->
  <div class="main-content">
    <!-- Header -->
    <div class="header bg-gradient-info py-7 py-lg-8 pt-lg-9">
      <div class="container">
        <div class="header-body text-center mb-7">
          <div class="row justify-content-center">
            <div class="col-xl-5 col-lg-6 col-md-8 px-5">
              <h1 class="text-white"><?php echo $_SESSION["systemname"]; ?></h1>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Page content -->
    <div class="container mt--8 pb-5">
      <div class="row justify-content-center">
        <div class="col-lg-5 col-md-7">
          <div class="card bg-secondary border-0 mb-0">
            <div class="card-body px-lg-5 py-lg-5">
              <div class="alert alert-danger alert-dismissible fade show" role="alert" id="loginAlert"  hidden>
                <span class="alert-text">Username or Password is incorrect.</span>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="text-center text-muted mb-4">
                <small>Sign in with credentials</small>
              </div>
              <form id="form_login">
                <div class="form-group mb-3" id="validation_login"></div>
                <div class="form-group mb-3">
                  <div class="input-group input-group-merge input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-circle-08"></i></span>
                    </div>
                    <input class="form-control" id="username" placeholder="Username" type="text" autocomplete="off" required>
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group input-group-merge input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                    </div>
                    <input class="form-control" id="password" placeholder="Password" type="password" autocomplete="off" required>
                  </div>
                </div>
                <div class="custom-control custom-control-alternative custom-checkbox">
                  <input class="custom-control-input" id=" customCheckLogin" type="checkbox">
                  <label class="custom-control-label" for=" customCheckLogin">
                    <span class="text-muted">Remember me</span>
                  </label>
                </div>
                <div class="text-center">
                  <button type="submit" class="btn btn-primary my-4">Sign in</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php require "js.php"; ?>
</body>
<script>
    $("#form_login").submit(function(e){
        e.preventDefault();
        var params;
        params = {
            username : $("#username").val(),
            password : $("#password").val()
        };
        $.post("verify_login",params).done(function(data) {
            if(data == 'denied'){
              $('#validation_login')
                .empty()
                .append("<div class='alert alert-danger alert-dismissible fade show' role='alert'><span class='alert-text'>Username or Password is incorrect!</span></div>");
            }
            else if(data == 'verified'){
                window.location.href = 'homepage';
            }
            else if(data == 'inactive'){
              $('#validation_login')
                .empty()
                .append("<div class='alert alert-danger alert-dismissible fade show' role='alert'><span class='alert-text'>Your account is inactive!</span></div>");
            }
        });
    });
</script>
</html>