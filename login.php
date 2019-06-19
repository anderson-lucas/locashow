<?php
  session_start();
  if (isset($_SESSION['id'])) header('Location: sistema.php?page=home');
  $erro_login = isset($_GET['error']) ? true : false;
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>LOCASHOW | Login</title>
  <link rel="icon" href="assets/favicon.ico" type="image/x-icon">
  <link rel="stylesheet" type="text/css" href="css/interface.css?v=<?php echo date('YmdHis'); ?>">
  <link rel="stylesheet" type="text/css" href="css/utils.css?v=<?php echo date('YmdHis'); ?>">
  <link rel="stylesheet" type="text/css" href="css/login.css?v=<?php echo date('YmdHis'); ?>">
  <link rel="stylesheet" type="text/css" href="css/fontawesome/css/all.min.css">
</head>
<body>
  <form id="form_login" class="form-login" method="POST">

    <div class="text-center">
      <img src="assets/ls-logo-dark.png" class="img-logo">
    </div>

    <small id="invalid-login" hidden class="text-center mB-10" style="font-size: 14px;">Usuário ou senha incorretos!</small>

    <div class="form-group">
      <input type="text" class="form-control" id="login" name="login" placeholder="Usuário" required autocomplete="off">
      <small id="small_login" hidden>* Preencha esse campo</small>
    </div>

    <div class="form-group">
      <input type="password" class="form-control" id="password" name="password" placeholder="Senha" required autocomplete="off">
      <small id="small_password" hidden>* Preencha esse campo</small>
    </div>
    
    <div class="form-group text-center">
      <button id="btn-submit" class="btn btn-login">Acessar</button> 
    </div>
  </form>

  <script src="assets/js/jquery.min.js"></script>
  <script src="assets/js/moment-with-locales.js"></script>
  <script src="js/main.js"></script>
  <script src="js/login/login.js"></script>
</body>
</html>