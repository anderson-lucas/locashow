<?php
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

  $menus = [];
  $sql_menus = "SELECT menu.id
                      , menu.nome
                      , COALESCE((SELECT 1 FROM grupo_menu WHERE grupo_menu.menu_id = menu.id AND grupo_menu.grupo_id = {$grupo['id']}),0) AS vinculado
                FROM menu";
  if ($result = $mysqli->query($sql_menus)) {
    while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
      $menus[] = $row;
    }
    $result->free();
  }
?>

<div class="text-left">
  <h2>Permissões de Menu - <?php echo $grupo['nome']; ?></h2>
</div>

<div style="margin-bottom: 20px;">
  <a href="sistema.php?page=grupos" class="btn"><i class="fas fa-chevron-left"></i> Voltar</a>
</div>

<table class="table table-default">
  <thead>
    <tr>
      <th class="text-left">Menu</th>
      <th class="text-left" width="10%">Adicionar/Remover</th>
    </tr>
  </thead>
  <tbody>
    <?php if (count($menus) == 0) { ?>
      <tr><td class="text-center" colspan="7" style="padding: 20px">Nenhum registro encontrado</td></tr>
    <?php } ?>

    <?php foreach ($menus as $key => $m) { ?>
      <tr>
        <td><?php echo $m['nome']; ?></td>
        <td class="text-center">
          <?php if (! $m['vinculado']) { ?>
          <button class="btn btn-save" title="ADICIONAR" onclick="addMenu(<?php echo $m['id'] ?>)">
            <i class="fas fa-plus"></i>
          </button>
          <?php } else { ?>
          <button class="btn btn-danger" title="EXCLUIR" onclick="deleteMenu(<?php echo $m['id'] ?>)">
            <i class="fas fa-trash-alt"></i>
          </button>
          <?php } ?>
        </td>
      </tr>
    <?php } ?>
  </tbody>
</table>

<script type="text/javascript">
  var grupo_id = parseInt('<?php echo $grupo['id']; ?>');

  //deletando menu do grupo
  function deleteMenu(menu_id) {
    $.ajax({
      url: API_URL + 'grupo-menu/'+grupo_id+'/'+menu_id,
      type: 'DELETE',
      success: function(result) {
        window.location.reload();
      },
      error: function(error) {
        console.error(error);
      }
    });
  }

  //adicionar menu no grupo
  function addMenu(menu_id) {
    $.ajax({
      url: API_URL + 'grupo-menu',
      type: 'POST',
      data: {grupo_id: grupo_id, menu_id: menu_id},
      success: function(result) {
        window.location.reload();
      },
      error: function(error) {
        console.error(error);
      }
    });
  }
</script>