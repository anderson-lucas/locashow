<?php
  $sql = "SELECT upper(left(sha1(id), 8)) as codigo, imovel.* FROM imovel ORDER BY created_at DESC, descricao ASC";

  $imoveis = [];
  if ($result = $mysqli->query($sql)) {
    while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
      $imoveis[] = $row;
    }
    $result->free();
  }

  $mysqli->close();
?>

<div class="text-left">
  <h2>Imóveis</h2>
</div>

<div style="margin-bottom: 20px;">
  <a href="sistema.php?page=cadastro_imovel" class="btn btn-save"><i class="fas fa-plus"></i> Adicionar</a>
</div>

<table class="table table-default">
  <thead>
    <tr>
      <th width="5%">Código</th>
      <th class="text-left">Descrição</th>
      <th width="10%">Localidade</th>
      <th width="12%">Rua</th>
      <th width="12%">Cadastrado em</th>
      <th width="14%">Opções</th>
    </tr>
  </thead>
  <tbody>
    <?php if (count($imoveis) == 0) { ?>
      <tr><td class="text-center" colspan="7" style="padding: 20px">Nenhum registro encontrado</td></tr>
    <?php } ?>

    <?php foreach ($imoveis as $key => $v) { ?>
      <tr>
        <td class="text-center"><?php echo $v['codigo']; ?></td>
        <td><?php echo $v['descricao']; ?></td>
        <td class="text-center"><?php echo $v['localidade']; ?></td>
        <td class="text-center"><?php echo $v['logradouro']; ?></td>
        <td class="text-center"><?php echo date('d/m/Y H:i', strtotime($v['created_at'])); ?></td>
        <td class="text-center">
          <a href="sistema.php?page=cadastro_imovel_imagens&id=<?php echo md5($v['id']); ?>" class="btn btn-save" title="FOTOS">
            <i class="fas fa-image"></i>
          </a>
          <a href="sistema.php?page=cadastro_imovel&id=<?php echo md5($v['id']); ?>" class="btn btn-edit" title="EDITAR">
            <i class="fas fa-pencil-alt"></i>
          </a>
          <a href="sistema.php?page=cadastro_imovel&id=<?php echo md5($v['id']); ?>&delete=1" class="btn btn-danger" title="EXCLUIR">
            <i class="fas fa-trash-alt"></i>
          </a>
        </td>
      </tr>
    <?php } ?>
  </tbody>
</table>