<?php
  $sql = "SELECT 
            co.id as id,
            cl.nome as nome,
            im.descricao as descricao,
            CASE co.tipo 
              WHEN 'L' THEN 'Locação'
              WHEN 'V' THEN 'Venda'
            END as tipo,
            co.valor,
            co.created_at as created_at
          FROM 
            contrato as co  
          INNER JOIN 
            cliente as cl
          ON
            cl.id = co.cliente_id
          LEFT JOIN
            imovel as im
          ON
            im.id = co.imovel_id
          ORDER BY 
            im.created_at 
          DESC";

  $contratos = [];
  if ($result = $mysqli->query($sql)) {
    while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
      $row['nome'] = utf8_encode($row['nome']);
      $row['descricao'] = utf8_encode($row['descricao']);
      $row['tipo'] = $row['tipo'];
      $contratos[] = $row;
    }
    $result->free();
  }

  $mysqli->close();
?>

<div class="text-left">
  <h2>Contratos</h2>
</div>

<div style="margin-bottom: 20px;">
  <a href="sistema.php?page=cadastro_contrato" class="btn btn-save"><i class="fas fa-plus"></i> Adicionar</a>
</div>

<table class="table table-default">
  <thead>
    <tr>
      <th width="5%">#</th>
      <th class="text-left">Cliente</th>
      <th width="10%">Imovel</th>
      <th width="10%">Tipo</th>
      <th width="12%">Valor</th>
      <th width="12%">Cadastrado em</th>
      <th width="14%">Opções</th>
    </tr>
  </thead>
  <tbody>
    <?php if (count($contratos) == 0) { ?>
      <tr><td class="text-center" colspan="7" style="padding: 20px">Nenhum registro encontrado</td></tr>
    <?php } ?>

    <?php foreach ($contratos as $key => $c) { ?>
      <tr>
        <td class="text-center"><?php echo $key+1; ?></td>
        <td><?php echo $c['nome']; ?></td>
        <td class="text-center"><?php echo $c['descricao']; ?></td>
        <td class="text-center"><?php echo $c['tipo']; ?></td>
        <td class="text-right">R$ <?php echo number_format($c['valor'], 2, ',', '.'); ?></td>
        <td class="text-center"><?php echo date('d/m/Y H:i', strtotime($c['created_at'])); ?></td>
        <td class="text-center">
          <a href="sistema.php?page=cadastro_contrato&id=<?php echo md5($c['id']); ?>" class="btn btn-edit" title="EDITAR">
            <i class="fas fa-pencil-alt"></i>
          </a>
          <a href="sistema.php?page=cadastro_contrato&id=<?php echo md5($c['id']); ?>&delete=1" class="btn btn-danger" title="EXCLUIR">
            <i class="fas fa-trash-alt"></i>
          </a>
        </td>
      </tr>
    <?php } ?>
  </tbody>
</table>