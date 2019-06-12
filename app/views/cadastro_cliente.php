<?php
  $cliente = [
    'id' => 0,
    'nome' => '',
    'cpf_cnpj' => '',
    'email' => '',
    'telefone' => '',
  ]; 

  if (isset($_GET['id'])) {
    $hash_id = $_GET['id'];
    $sql = "SELECT * FROM cliente WHERE md5(id) = '{$hash_id}'";
    if ($result = $mysqli->query($sql)) {
      if ($result->num_rows == 0) {
        header('Location: sistema.php?page=clientes');
        exit;
      }
      while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
        $cliente = $row;
      }
      $result->free();
    }
  }
?>

<div class="text-left">
  <h2>Cadastro de Cliente</h2>
</div>

<div style="margin-bottom: 20px;">
  <a href="sistema.php?page=clientes" class="btn"><i class="fas fa-chevron-left"></i> Voltar</a>
</div>

<style type="text/css">
  .form-control, .alert {
    width: 50%;
  }

  .alert {
    width: 50%;
  }
</style>

<form id="form_cliente" class="form-default" method="POST">

  <input type="hidden" name="id" value="<?php echo $cliente['id']; ?>">

  <div class="form-group text-center alert alert-error" hidden>
    <small>CPF / CNPJ informado já cadastrado!</small>
  </div>

  <div class="form-group">
    <label>Nome</label>
    <input type="text" class="form-control mT-5" id="nome" name="nome" value="<?php echo $cliente['nome']; ?>" required>
  </div>

  <div class="form-group">
    <label>CPF / CNPJ</label>
    <input type="text" class="form-control mT-5" id="cpf_cnpj" name="cpf_cnpj" value="<?php echo $cliente['cpf_cnpj']; ?>" required>
  </div>

  <div class="form-group">
    <label>E-mail</label>
    <input type="email" class="form-control mT-5" id="email" name="email" value="<?php echo $cliente['email']; ?>">
  </div>

  <div class="form-group">
    <label>Telefone</label>
    <input type="text" class="form-control mT-5" id="telefone" name="telefone" value="<?php echo $cliente['telefone']; ?>">
  </div>
  
  <div class="form-group left">
    <button type="submit" id="btn-submit" class="btn btn-save">Salvar</button> 
  </div>
</form>

<script src="js/clientes/cadastroCliente.js"></script>