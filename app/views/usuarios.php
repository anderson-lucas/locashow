<?php
  $sql = "SELECT * FROM usuario ORDER BY nome, created_at DESC";
  $usuarios = [];
  if ($result = $mysqli->query($sql)) {
    while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
      $row['nome'] = utf8_encode($row['nome']);
      $row['email'] = utf8_encode($row['email']);
      $row['login'] = utf8_encode($row['login']);
      $usuarios[] = $row;
    }
    $result->free();
  }

  $mysqli->close();
?>

<div class="text-left">
  <h2>Usuários</h2>
</div>

<div style="margin-bottom: 20px;">
  <a href="sistema.php?page=configuracoes" class="btn"><i class="fas fa-chevron-left"></i> Voltar</a>
  <a href="sistema.php?page=cadastro_usuario" class="btn btn-save"><i class="fas fa-plus"></i> Adicionar</a>
</div>

<table class="table table-default">
  <thead>
    <tr>
      <th width="5%">#</th>
      <th class="text-left">Nome</th>
      <th width="10%">Login</th>
      <th width="12%">E-mail</th>
      <th width="12%">Cadastrado em</th>
      <th width="14%">Opções</th>
    </tr>
  </thead>
  <tbody>
    <?php if (count($usuarios) == 0) { ?>
      <tr><td class="text-center" colspan="7" style="padding: 20px">Nenhum registro encontrado</td></tr>
    <?php } ?>

    <?php foreach ($usuarios as $key => $u) { ?>
      <tr>
        <td class="text-center"><?php echo $key+1; ?></td>
        <td><?php echo $u['nome']; ?></td>
        <td class="text-center"><?php echo $u['login']; ?></td>
        <td class="text-center"><?php echo $u['email']; ?></td>
        <td class="text-center"><?php echo date('d/m/Y H:i', strtotime($u['created_at'])); ?></td>
        <td class="text-center">
          <a href="sistema.php?page=cadastro_usuario_grupo&id=<?php echo md5($u['id']); ?>" class="btn btn-save" title="GRUPOS">
            <i class="fas fa-user-cog"></i>
          </a>
          <a href="sistema.php?page=cadastro_usuario&id=<?php echo md5($u['id']); ?>" class="btn btn-edit" title="EDITAR">
            <i class="fas fa-pencil-alt"></i>
          </a>
          <a href="sistema.php?page=cadastro_usuario&id=<?php echo md5($u['id']); ?>&delete=1" class="btn btn-danger" title="EXCLUIR">
            <i class="fas fa-trash-alt"></i>
          </a>
        </td>
      </tr>
    <?php } ?>
  </tbody>
</table>