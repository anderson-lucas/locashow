<?php
  if (isset($_GET['id']) && isset($_GET['delete'])) {
    $hash_id = $_GET['id'];
    $sql = "DELETE FROM grupo WHERE md5(id) = '{$hash_id}'";
    if ($result = $mysqli->query($sql)) {
      header('Location: sistema.php?page=grupos');
      exit;
    } else {
      echo "Registro não pode ser excluido, pois tem vínculos ativos no sistema!<br>";
      echo "<a href='sistema.php?page=grupos'>Clique aqui para voltar!</a>";
      exit;
    }

    $mysqli->close();
  }

  $grupo = [
    'id' => 0,
    'nome' => '',
  ]; 

  if (isset($_GET['id'])) {
    $hash_id = $_GET['id'];
    $sql = "SELECT * FROM grupo WHERE md5(id) = '{$hash_id}'";
    if ($result = $mysqli->query($sql)) {
      if ($result->num_rows == 0) {
        header('Location: sistema.php?page=grupos');
        exit;
      }
      while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
        $grupo = $row;
      }
      $result->free();
    }
  }
?>

<div class="text-left">
  <h2>Cadastro de Grupo</h2>
</div>

<div style="margin-bottom: 20px;">
  <a href="sistema.php?page=grupos" class="btn"><i class="fas fa-chevron-left"></i> Voltar</a>
</div>

<form id="form_cliente" class="form-default" method="POST" action="app/controllers/GrupoController.php">

  <input type="hidden" name="id" value="<?php echo $grupo['id']; ?>">

  <div class="form-group">
    <label>Nome</label>
    <input type="text" class="form-control mT-5" id="nome" name="nome" value="<?php echo $grupo['nome']; ?>" required>
  </div>

  <div class="form-group left">
    <button type="submit" class="btn btn-save">Salvar</button> 
  </div>
</form>