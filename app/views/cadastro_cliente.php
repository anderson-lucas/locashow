<?php 
  if (isset($_GET['id']) && isset($_GET['delete'])) {
    $hash_id = $_GET['id'];
    $sql = "DELETE FROM cliente WHERE md5(id) = '{$hash_id}'";
    if ($result = $mysqli->query($sql)) {
      header('Location: sistema.php?page=clientes');
      exit;
    } else {
      echo "Registro não pode ser excluido, pois tem vínculos ativos no sistema!<br>";
      echo "<a href='sistema.php?page=clientes'>Clique aqui para voltar!</a>";
      exit;
    }

    $mysqli->close();
  }

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
        $row['nome'] = utf8_encode($row['nome']);
        $row['cpf_cnpj'] = utf8_encode($row['cpf_cnpj']);
        $row['email'] = utf8_encode($row['email']);
        $row['telefone'] = utf8_encode($row['telefone']);
        $cliente = $row;
      }
      $result->free();
    }
  }

  $code = 0;
  if (isset($_GET['code'])) {
    $code = $_GET['code'];
  }
?>

<div class="text-left">
  <h2>Cadastro de Cliente</h2>
</div>

<div style="margin-bottom: 20px;">
  <a href="sistema.php?page=clientes" class="btn"><i class="fas fa-chevron-left"></i> Voltar</a>
</div>

<style type="text/css">
  .form-control {
    width: 50%;
  }

  .alert {
    width: 50%;
  }
</style>

<form id="form_cliente" class="form-default" method="POST" action="app/controllers/ClienteController.php">

  <input type="hidden" name="id" value="<?php echo $cliente['id']; ?>">

  <?php if ($code == 2) { ?>
  <div class="form-group text-center alert alert-error">
    <small>CPF / CNPJ informado já cadastrado!</small>
  </div>
  <?php } ?>

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

<script type="text/javascript">
  $(function() {
    $("#btn-submit").click(function(e) {
      e.preventDefault();
      var data = {};
      $("#form_cliente").serializeArray().map(function(x){
        data[x.name] = x.value;
      });

      $.ajax({
        url: API_URL + 'clientes',
        type: 'post',
        dataType: 'application/json',
        data: data
      });

      alert('Successo!');
      window.location = 'sistema.php?page=clientes';
    });
  });
</script>