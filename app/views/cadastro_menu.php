<?php
  if (isset($_GET['id']) && isset($_GET['delete'])) {
    $hash_id = $_GET['id'];
    $sql = "DELETE FROM menu WHERE md5(id) = '{$hash_id}'";
    if ($result = $mysqli->query($sql)) {
      header('Location: sistema.php?page=menus');
      exit;
    } else {
      echo "Registro não pode ser excluido, pois tem vínculos ativos no sistema!<br>";
      echo "<a href='sistema.php?page=menus'>Clique aqui para voltar!</a>";
      exit;
    }

    $mysqli->close();
  }

  $menu = [
    'id' => 0,
    'nome' => '',
    'link' => '',
    'icone' => '',
    'ordem' => '',
  ]; 

  if (isset($_GET['id'])) {
    $hash_id = $_GET['id'];
    $sql = "SELECT * FROM menu WHERE md5(id) = '{$hash_id}'";
    if ($result = $mysqli->query($sql)) {
      if ($result->num_rows == 0) {
        header('Location: sistema.php?page=menus');
        exit;
      }
      while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
        $menu = $row;
      }
      $result->free();
    }
  }
?>

<div class="text-left">
  <h2>Cadastro de Menu</h2>
</div>

<div style="margin-bottom: 20px;">
  <a href="sistema.php?page=menus" class="btn"><i class="fas fa-chevron-left"></i> Voltar</a>
</div>

<form id="form_cliente" class="form-default" method="POST" action="app/controllers/MenuController.php">

  <input type="hidden" name="id" value="<?php echo $menu['id']; ?>">

  <div class="form-group">
    <label>Nome</label>
    <input type="text" class="form-control mT-5" id="nome" name="nome" value="<?php echo $menu['nome']; ?>" required>
  </div>

  <div class="form-group">
    <label>Link</label>
    <input type="text" class="form-control mT-5" id="link" name="link" value="<?php echo $menu['link']; ?>" required>
  </div>

  <div class="form-group">
    <label>Ícone</label>
    <input type="text" class="form-control mT-5" id="icone" name="icone" value="<?php echo $menu['icone']; ?>" required>
  </div>

  <div class="form-group">
    <label>Ordem</label>
    <input type="number" min="1" class="form-control mT-5" id="ordem" name="ordem" value="<?php echo $menu['ordem']; ?>" required>
  </div>
  
  <div class="form-group left">
    <button type="submit" class="btn btn-save">Salvar</button> 
  </div>
</form>