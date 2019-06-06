<?php 
  if (isset($_GET['id']) && isset($_GET['delete'])) {
    $hash_id = $_GET['id'];
    $sql = "DELETE FROM usuario WHERE md5(id) = '{$hash_id}'";
    if ($result = $mysqli->query($sql)) {
      header('Location: sistema.php?page=usuarios');
      exit;
    } else {
      echo "Registro não pode ser excluido, pois tem vínculos ativos no sistema!<br>";
      echo "<a href='sistema.php?page=usuarios'>Clique aqui para voltar!</a>";
      exit;
    }

    $mysqli->close();
  }

  $usuario = [
    'id' => 0,
    'login' => '',
    'email' => '',
    'nome' => '',
  ]; 

  if (isset($_GET['id'])) {
    $hash_id = $_GET['id'];
    $sql = "SELECT * FROM usuario WHERE md5(id) = '{$hash_id}'";
    if ($result = $mysqli->query($sql)) {
      if ($result->num_rows == 0) {
        header('Location: sistema.php?page=usuarios');
        exit;
      }
      while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
        $usuario = $row;
      }
      $result->free();
    }
  }

  $code = 0;
  if (isset($_GET['code'])) {
    $code = $_GET['code'];
  }
?>

<div class="text-left">
  <h2>Cadastro de Usuário</h2>
</div>

<div style="margin-bottom: 20px;">
  <a href="sistema.php?page=usuarios" class="btn"><i class="fas fa-chevron-left"></i> Voltar</a>
</div>

<style type="text/css">
  .form-control {
    width: 50%;
  }

  .alert {
    width: 50%;
  }
</style>

<form class="form-default" method="POST" action="app/controllers/UsuarioController.php">

  <input type="hidden" name="id" value="<?php echo $usuario['id']; ?>">

  <?php if ($code == 2) { ?>
  <div class="form-group text-center alert alert-error">
    <small>Email ou login informado já cadastrado!</small>
  </div>
  <?php } ?>

  <div class="form-group">
    <label>Nome</label>
    <input type="text" class="form-control mT-5" id="nome" name="nome" value="<?php echo $usuario['nome']; ?>" required>
  </div>

  <div class="form-group">
    <label>Login</label>
    <input type="text" class="form-control mT-5" id="login" name="login" value="<?php echo $usuario['login']; ?>" required>
  </div>

  <div class="form-group">
    <label>E-mail</label>
    <input type="email" class="form-control mT-5" id="email" name="email" value="<?php echo $usuario['email']; ?>">
  </div>
  
  <div class="form-group left">
    <button type="submit" id="btn-submit" class="btn btn-save">Salvar</button> 
  </div>
</form>