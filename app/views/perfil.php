<?php
  if (! isset($_GET['id'])) header('Location: sistema.php?page=home');

  $hash_id = $_GET['id'];

  $sql = "SELECT * FROM usuario WHERE md5(id) = '{$hash_id}'";

  $usuario = [];
  if ($result = $mysqli->query($sql)) {
    while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
      $usuario = $row;
    }
  }

  if (count($usuario) == 0) header('Location: sistema.php?page=home');

  $code = 0;
  if (isset($_GET['code'])) {
    $code = $_GET['code'];
  }

  $mysqli->close();
?>

<style type="text/css">
  .form-control {
    width: 50%;
  }

  .alert {
    width: 50%;
  }
</style>

<form class="form-default" method="POST" action="app/controllers/PerfilController.php">
  <div class="text-left">
    <h2>Meu perfil</h2>
  </div>

  <?php

    $text_code = '';

    if ($code == 1) {
      $alert = 'success';
      $text_code = 'Salvo com sucesso!';
    } else if ($code == 2) {
      $alert = 'error';
      $text_code = 'Erro ao salvar!';
    } else if ($code == 3) {
      $alert = 'success';
      $text_code = 'Senha atualizada com sucesso!';
    }
  ?>

  <?php if ($text_code != '') { ?>
  <div class="form-group text-center alert alert-<?php echo $alert; ?>">
    <small><?php echo $text_code; ?></small>
  </div>

  <?php } ?>

  <input type="hidden" name="id" value="<?php echo $usuario['id']; ?>">

  <div class="form-group">
    <label>Nome</label>
    <input type="text" class="form-control mT-5" id="nome" name="nome" value="<?php echo $usuario['nome']; ?>" required>
  </div>

  <div class="form-group">
    <label>E-mail</label>
    <input type="email" class="form-control mT-5" id="email" name="email" value="<?php echo $usuario['email']; ?>" required>
  </div>

  <div class="form-group">
    <label>Senha atual</label>
    <input type="password" class="form-control mT-5" id="senha_atual" name="senha_atual">
  </div>

  <div class="form-group">
    <label>Nova senha</label>
    <input type="password" class="form-control mT-5" id="senha_nova" name="senha_nova">
  </div>
  
  <div class="form-group left">
    <button type="submit" class="btn btn-save">Salvar</button> 
  </div>
</form>