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
  <link rel="stylesheet" type="text/css" media="screen" href="css/utils.css?v=<?php echo date('YmdHis'); ?>">
  <link rel="stylesheet" type="text/css" media="screen" href="css/login.css?v=<?php echo date('YmdHis'); ?>"> 
</head>
<body>
  <form class="form-login" method="POST" action="app/auth/authenticate.php">
    <?php if ($erro_login) { ?>
    <div class="form-group text-center alert alert-error">
      <small class="erro-login">Usuário ou senha incorretos!</small>
    </div>
    <?php } ?>

    <div class="text-center">
      <p class="titulo-login">Acessar o sistema</p>
    </div>

    <div class="form-group">
      <input type="text" class="form-control" id="login" name="login" placeholder="Usuário" required>
    </div>

    <div class="form-group">
      <input type="password" class="form-control" id="password" name="password" placeholder="Senha" required>
    </div>
    
    <div class="form-group text-center">
      <button type="submit" class="btn">Entrar</button> 
    </div>
  </form>
</body>
</html>