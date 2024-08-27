<?php 
  require_once $_SERVER["DOCUMENT_ROOT"]."/connection.php";
  $_SESSION['ticket']='';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin Login</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="./plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="./plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="./dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page"style="background: radial-gradient(circle at -8.9% 51.2%, rgb(255, 124, 0) 0%, rgb(255, 124, 0) 15.9%, rgb(255, 163, 77) 15.9%, rgb(255, 163, 77) 24.4%, rgb(19, 30, 37) 24.5%, rgb(19, 30, 37) 66%);
">
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary"style="background: rgb(19, 30, 37);">
    <div class="card-header text-center">
      <a href="../../index2.html" class="h1"style="color:#ffff;"><b>TRF Hotel</b><br>Campaňeros Hotel</br></a>
    </div>
    <div class="card-body">
      <p class="login-box-msg" style="color:#ffff;">Sign in to start your session</p>

      <!-- <form action="admin-dashboard.php" method="post"> -->
        <div class="input-group mb-3">
          <input type="text" id="username" class="form-control" placeholder="Username">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" id="password" class="form-control" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <!-- <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">
                Remember Me
              </label>
            </div>
          </div>
           .col 
           <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
          </div> 
           .col 
        </div> -->
        <div class="social-auth-links text-center mt-2 mb-3">
          <button class="btn btn-block btn-primary" id="btnSignin" style="background:rgb(255, 124, 0);">
            Sign In
          </button>
        <!-- <a href="dashboard.php" class="btn btn-block btn-primary">
          Sign in
        </a> -->
        <!-- <a href="#" class="btn btn-block btn-danger">
          <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
        </a> -->
      </div>
      <!-- </form> -->

      
      <!-- /.social-auth-links -->

      <!-- <p class="mb-1">
        <a href="forgot-password.html">I forgot my password</a>
      </p> -->
        <!-- <p class="mb-0">
          <a href="register.html" class="text-center">Register a new membership</a>
        </p> -->
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="./plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="./plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="./dist/js/adminlte.min.js"></script>
<script>
    $("#btnSignin").click(function(){
      var username = $("#username").val();
      var password = $("#password").val();
      // alert (username + password);
      $.ajax({
        url:'login-process.php',
        method:"POST",
        data:{
          username:username,
          password:password
        },
        success:function(response){
          // alert(response);
          if(response.trim()=="welcome"){
            alert ("Success:Welcome");
            
            window.location.href="dashboard.php";
          }else{
            alert("Error:Invalid");

          }
          
        }
      })
    })
</script>
</body>
</html>