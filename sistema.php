<?php
  require 'app/auth/validate.php';
  require 'app/database.php';
  require 'api/MenuService.php';

  $menus = getMenus();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <title>LOCASHOW | <?php echo @strtoupper($_GET['page']); ?></title>
  <link rel="icon" href="assets/favicon.ico" type="image/x-icon">
  <link rel="stylesheet" type="text/css" media="screen" href="css/utils.css?v=<?php echo date('YmdHis'); ?>">
  <link rel="stylesheet" type="text/css" media="screen" href="css/interface.css?v=<?php echo date('YmdHis'); ?>">
  <link rel="stylesheet" type="text/css" media="screen" href="css/fontawesome/css/all.min.css">
</head>
<body>

  <header class="bg-interface">
    <img src="assets/ls-logo-dark.png" class="logo">
    <div style="display: inline-block; padding-top: 5px; vertical-align: middle;">
      <h1>LOCASHOW</h1>
    </div>
    <div class="menu-right">
      <a href="sistema.php?page=perfil&id=<?php echo $_SESSION['id']; ?>" title="PERFIL"><i class="fas fa-user"></i> <?php echo strtoupper($_SESSION['nome']); ?></a>
      <a href="logout.php" title="SAIR"><i class="fas fa-sign-out-alt" style="padding-right: 13px;"></i></a>
    </div>
  </header>

  <div class="sidenav bg-interface">
    <ul class="ul-menu">
    <?php foreach ($menus as $menu) { ?>
      <a href="sistema.php?page=<?php echo $menu['link'] ?>"><li><i class="<?php echo $menu['icone']; ?>"></i> <?php echo $menu['nome']; ?></li></a>
    <?php } ?>
    </ul>
  </div>

  <script src="assets/js/jquery.min.js"></script>
  <script src="assets/js/md5.js"></script>
  <script src="js/main.js"></script>

  <div class="main">
    <div class="content">
      <?php
        if (isset($_GET['page'])) {
          if (is_file('app/views/'.$_GET['page'].'.php')) {
            @include('app/views/'.$_GET['page'].'.php');
          } else {
            echo "Menu não existe.";
          }
        } 
      ?>
    </div>
  </div>
</body>
</html>