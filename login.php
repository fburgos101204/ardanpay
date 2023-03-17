<?php

require_once("config/db.php");
require_once("config/conexion.php");
require_once("classes/Login.php");

$login = new Login();

if ($login->isUserLoggedIn() == true) {
    header("location: home.php");
} else {

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>ArdanPay</title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!--<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">-->
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="description" content="Xilus Bank el mejor sistema de prestamos">
  <meta name="author" content="ArdanPay">
  <link rel="icon" type="image/png" href="keys/favicon-1.ico">

  <meta name="theme-color" content="#025E93">
  <meta name="MobileOptimized" content="width">
  <meta name="HandheldFriendly" content="true">
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-bar-style" content="black">
  <link rel="shortcut icon" type="image/png" href="keys/logo-2.png">
  <link rel="apple-touch-icon" href="keys/logo-2.png">
  <link rel="apple-touch-startup-image" href="keys/logo-2.png">
  <link rel="manifest" href="./manifest.json">
  
  
  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">
  <link href="css/styles.css" rel="stylesheet">

</head>

<body style="background-image: linear-gradient(-10deg, rgb(26 130 197), rgb(247 247 247))" class="bg-dark">

  <div class="container" style="margin-top:12%;">
    <div class="card card-login mx-auto mt-5">
      <div class="card-header ">
      	   <img src="keys/logo-2.png" class="mx-auto" style="display: block;width: 80%;height: 80px;">
		<!--  <span style="display:inline-block; vertical-align:middle;"><img src="https://xilus.com.do/app-xilus/img/Xilusfavicon.png" width="20"> Iniciar sesión</span>
		-->
		</div>
      <div class="card-body" >
       <?php
          if (isset($login)) {
          if ($login->errors) {
    ?>
      <div class="alert alert-danger alert-dismissible" role="alert" style="width: 100%;">
          <strong>Error!</strong> 
    <?php 
      foreach ($login->errors as $error) {
        echo $error;
      }
    ?>
      </div>
    <?php }
       if ($login->messages) {
    ?>
      <div class="alert alert-success alert-dismissible" role="alert" style="width: 100%;">
          <strong>Aviso!</strong>
    <?php
      foreach ($login->messages as $message) {
          echo $message;
        }
    ?>
      </div> 
    <?php } } ?>
        <form  action="login.php" name="loginform" autocomplete="off" role="form" method="post" >
          <div class="form-group">
            <div class="form-label-group">
              <input type="text"  name="user_name" id="user_name" class="form-control" placeholder="Email address" required="required" autofocus="autofocus">
              <label for="user_name">Usuario</label>
            </div>
          </div>
			<br>
          <div class="form-group">
            <div class="form-label-group">
              <input type="password" name="user_password" id="user_password"  class="form-control" placeholder="Password" required="required">
              <label for="user_password">Contraseña</label>
            </div>
          </div>
			<br>
          <input type="submit" id="IngresoLog" name="login" class="btn btn-success btn-block" value="Iniciar sesión">
        </form>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="./script.js"></script> <!--PAWA-->
  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

</body>

</html>
<?php } ?>