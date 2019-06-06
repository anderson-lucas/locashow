<?php
  $sql = "SELECT * FROM grupo ORDER BY nome, created_at DESC";

  $grupos = [];
  if ($result = $mysqli->query($sql)) {
    while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
      $row['nome'] = utf8_encode($row['nome']);
      $grupos[] = $row;
    }
    $result->free();
  }

  $mysqli->close();
?>

<div class="text-left">
  <h2>Grupos</h2>
</div>

<div style="margin-bottom: 20px;">
  <a href="sistema.php?page=configuracoes" class="btn"><i class="fas fa-chevron-left"></i> Voltar</a>
  <a href="sistema.php?page=cadastro_grupo" class="btn btn-save"><i class="fas fa-plus"></i> Adicionar</a>
</div>

<table class="table table-default">
  <thead>
    <tr>
      <th width="5%">#</th>
      <th class="text-left">Nome</th>
      <th width="12%">Cadastrado em</th>
      <th width="14%">Opções</th>
    </tr>
  </thead>
  <tbody>
    <?php if (count($grupos) == 0) { ?>
      <tr><td class="text-center" colspan="7" style="padding: 20px">Nenhum registro encontrado</td></tr>
    <?php } ?>

    <?php foreach ($grupos as $key => $g) { ?>
      <tr>
        <td class="text-center"><?php echo $key+1; ?></td>
        <td><?php echo $g['nome']; ?></td>
        <td class="text-center"><?php echo date('d/m/Y H:i', strtotime($g['created_at'])); ?></td>
        <td class="text-center">
          <a href="sistema.php?page=cadastro_grupo_menu&id=<?php echo md5($g['id']); ?>" class="btn btn-save" title="PERMISSÕES">
            <i class="fas fa-unlock-alt"></i>
          </a>
          <a href="sistema.php?page=cadastro_grupo&id=<?php echo md5($g['id']); ?>" class="btn btn-edit" title="EDITAR">
            <i class="fas fa-pencil-alt"></i>
          </a>
          <a href="sistema.php?page=cadastro_grupo&id=<?php echo md5($g['id']); ?>&delete=1" class="btn btn-danger" title="EXCLUIR">
            <i class="fas fa-trash-alt"></i>
          </a>
        </td>
      </tr>
    <?php } ?>
  </tbody>
</table>