<?php
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

  $grupos = [];
  $sql_menus = "SELECT grupo.id
                       , grupo.nome
                       , COALESCE((SELECT 1 FROM usuario_grupo WHERE usuario_grupo.grupo_id = grupo.id AND usuario_grupo.usuario_id = {$usuario['id']}),0) AS vinculado
                FROM grupo";
  if ($result = $mysqli->query($sql_menus)) {
    while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
      $grupos[] = $row;
    }
    $result->free();
  }
?>

<div class="text-left">
  <h2>Permissões de Grupo - <?php echo $usuario['nome']; ?> (<?php echo $usuario['login']; ?>)</h2>
</div>

<div style="margin-bottom: 20px;">
  <a href="sistema.php?page=usuarios" class="btn"><i class="fas fa-chevron-left"></i> Voltar</a>
</div>

<table class="table table-default">
  <thead>
    <tr>
      <th class="text-left">Grupo</th>
      <th class="text-left" width="10%">Adicionar/Remover</th>
    </tr>
  </thead>
  <tbody>
    <?php if (count($grupos) == 0) { ?>
      <tr><td class="text-center" colspan="7" style="padding: 20px">Nenhum registro encontrado</td></tr>
    <?php } ?>

    <?php foreach ($grupos as $key => $g) { ?>
      <tr>
        <td><?php echo $g['nome']; ?></td>
        <td class="text-center">
          <?php if (! $g['vinculado']) { ?>
          <button class="btn btn-save" title="ADICIONAR" onclick="addGrupo(<?php echo $g['id'] ?>)">
            <i class="fas fa-check"></i>
          </button>
          <?php } else { ?>
          <button class="btn btn-danger" title="EXCLUIR" onclick="deleteGrupo(<?php echo $g['id'] ?>)">
            <i class="fas fa-ban"></i>
          </button>
          <?php } ?>
        </td>
      </tr>
    <?php } ?>
  </tbody>
</table>

<script type="text/javascript">
  var usuario_id = parseInt('<?php echo $usuario['id']; ?>');

  //deletando grupo do usuario
  function deleteGrupo(grupo_id) {
    $.ajax({
      url: API_URL + 'usuario-grupo/'+usuario_id+'/'+grupo_id,
      type: 'DELETE',
      success: function(result) {
        window.location.reload();
      },
      error: function(error) {
        console.error(error);
      }
    });
  }

  //adicionar grupo no usuario
  function addGrupo(grupo_id) {
    $.ajax({
      url: API_URL + 'usuario-grupo',
      type: 'POST',
      data: {usuario_id: usuario_id, grupo_id: grupo_id},
      success: function(result) {
        window.location.reload();
      },
      error: function(error) {
        console.error(error);
      }
    });
  }
</script>