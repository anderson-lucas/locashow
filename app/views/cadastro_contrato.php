<?php 
  $contrato = [
    'id' => 0,
    'cliente_id' => 0,
    'imovel_id' => 0,
    'tipo' => '',
    'valor' => 0,
    'dt_vencimento' => '',
    'status' => ''
  ]; 

  if (isset($_GET['id'])) {
    $hash_id = $_GET['id'];
    $sql = "SELECT * FROM contrato WHERE md5(id) = '{$hash_id}'";
    if ($result = $mysqli->query($sql)) {
      if ($result->num_rows == 0) {
        header('Location: sistema.php?page=contratos');
        exit;
      }
      while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
        $contrato = $row;
      }
      $result->free();
    }
  }

  $clientes = [];
  $sql = "SELECT * FROM cliente";
  if ($result = $mysqli->query($sql)) {
    while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
      $clientes[] = $row;
    }
    $result->free();
  }

  $imoveis = [];
  $sql = "SELECT upper(left(sha1(id), 8)) as codigo, imovel.* FROM imovel ORDER BY created_at DESC, descricao ASC";
  if ($result = $mysqli->query($sql)) {
    while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
      $imoveis[] = $row;
    }
    $result->free();
  }

?>

<div class="text-left">
  <h2>Cadastro de Contratos</h2>
</div>

<div style="margin-bottom: 20px;">
  <a href="sistema.php?page=contratos" class="btn"><i class="fas fa-chevron-left"></i> Voltar</a>
</div>

<style type="text/css">
  .form-control {
    width: 50%;
  }

  .alert {
    width: 50%;
  }
</style>

<form class="form-default" method="POST" action="app/controllers/ContratoController.php">

  <input type="hidden" name="id" value="<?php echo $contrato['id']; ?>">

  <div class="form-group">
    <label>Cliente</label>
    <select id="cliente_id" name="cliente_id" class="form-control mT-5" required>     
      <?php foreach ($clientes as $c) { ?>
      <option value="<?php echo $c['id']; ?>" <?php echo $c['id']==$contrato['cliente_id'] ? 'selected' : ''; ?>>
        <?php echo $c['nome']; ?>
      </option>
      <?php } ?>
    </select>
  </div>

  <div class="form-group">
    <label>Imóvel</label>
    <select id="imovel_id" name="imovel_id" class="form-control mT-5" required>
      <?php foreach ($imoveis as $c) { ?>
      <option value="<?php echo $c['id']; ?>" <?php echo $c['id']==$contrato['imovel_id'] ? 'selected' : ''; ?>>
        <?php echo $c['descricao']; ?> - <?php echo $c['codigo']; ?>
      </option>
      <?php } ?>
    </select>
  </div>

  <div class="form-group">
    <label>Tipo</label>
    <label style="font-weight: normal;"><input type="radio" name="tipo" value="L" <?php echo 'L'==$contrato['tipo'] ? 'checked' : ''; ?> required checked> Locação </label>
    <label style="font-weight: normal;"><input type="radio" name="tipo" value="V" <?php echo 'V'==$contrato['tipo'] ? 'checked' : ''; ?> required> Venda </label>
  </div>

  <div class="form-group">
    <label>Valor</label>
    <input type="number" class="form-control mT-5" min="0.00" max="1000000.00" step="0.1" id="valor" name="valor" value="<?php echo $contrato['valor']; ?>" required>
  </div>

  <div class="form-group">
    <label>Data vencimento</label>
    <input type="date" class="form-control mT-5" id="dt_vencimento" name="dt_vencimento" value="<?php echo $contrato['dt_vencimento']; ?>">
  </div>

  <div class="form-group">
    <label>Status</label>

    <label style="font-weight: normal;"><input type="radio" name="status" value="A" <?php echo 'A'==$contrato['status'] ? 'checked' : ''; ?> required checked> Ativo</label>
    <label style="font-weight: normal;"><input type="radio" name="status" value="I" <?php echo 'I'==$contrato['status'] ? 'checked' : ''; ?> required> Inativo</label>

  </div>

  <div class="form-group left">
    <button type="submit" class="btn btn-save">Salvar</button> 
  </div>
</form>