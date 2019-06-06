<?php
  $sql = "SELECT * FROM menu ORDER BY ordem, nome";

  $menus = [];
  if ($result = $mysqli->query($sql)) {
    while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
      $menus[] = $row;
    }
    $result->free();
  }

  $mysqli->close();
?>

<div class="text-left">
  <h2>Menus</h2>
</div>

<div style="margin-bottom: 20px;">
  <a href="sistema.php?page=configuracoes" class="btn"><i class="fas fa-chevron-left"></i> Voltar</a>
  <a href="sistema.php?page=cadastro_menu" class="btn btn-save"><i class="fas fa-plus"></i> Adicionar</a>
</div>

<table class="table table-default">
  <thead>
    <tr>
      <th width="5%">#</th>
      <th class="text-left">Nome</th>
      <th class="text-left">Link</th>
      <th class="text-center">Ícone</th>
      <th class="text-center">Ordem</th>
      <th width="12%">Cadastrado em</th>
      <th width="14%">Opções</th>
    </tr>
  </thead>
  <tbody>
    <?php if (count($menus) == 0) { ?>
      <tr><td class="text-center" colspan="7" style="padding: 20px">Nenhum registro encontrado</td></tr>
    <?php } ?>

    <?php foreach ($menus as $key => $m) { ?>
      <tr>
        <td class="text-center"><?php echo $key+1; ?></td>
        <td><?php echo $m['nome']; ?></td>
        <td><?php echo $m['link']; ?></td>
        <td class="text-center"><?php echo $m['icone']; ?></td>
        <td class="text-center"><?php echo $m['ordem']; ?></td>
        <td class="text-center"><?php echo date('d/m/Y H:i', strtotime($m['created_at'])); ?></td>
        <td class="text-center">
          <a href="sistema.php?page=cadastro_menu&id=<?php echo md5($m['id']); ?>" class="btn btn-edit" title="EDITAR">
            <i class="fas fa-pencil-alt"></i>
          </a>
          <a href="sistema.php?page=cadastro_menu&id=<?php echo md5($m['id']); ?>&delete=1" class="btn btn-danger" title="EXCLUIR">
            <i class="fas fa-trash-alt"></i>
          </a>
        </td>
      </tr>
    <?php } ?>
  </tbody>
</table>