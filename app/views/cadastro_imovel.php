<?php 
  if (isset($_GET['id']) && isset($_GET['delete'])) {
    $hash_id = $_GET['id'];
    $sql = "DELETE FROM imovel WHERE md5(id) = '{$hash_id}'";
    if ($result = $mysqli->query($sql)) {
      header('Location: sistema.php?page=imoveis');
      exit;
    } else {
      echo "Registro não pode ser excluido, pois tem vínculos ativos no sistema!<br>";
      echo "<a href='sistema.php?page=imoveis'>Clique aqui para voltar!</a>";
      exit;
    }

    $mysqli->close();
  }

  $imovel = [
    'id' => 0,
    'cliente_id' => 0,
    'descricao' => '',
    'cep' => '',
    'logradouro' => '',
    'complemento' => '',
    'bairro' => '',
    'localidade' => '',
    'uf' => '',
  ]; 

  if (isset($_GET['id'])) {
    $hash_id = $_GET['id'];
    $sql = "SELECT * FROM imovel WHERE md5(id) = '{$hash_id}'";
    if ($result = $mysqli->query($sql)) {
      if ($result->num_rows == 0) {
        header('Location: sistema.php?page=imoveis');
        exit;
      }
      while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
        $imovel = $row;
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

  $estados = [
    'AC'=>'Acre',
    'AL'=>'Alagoas',
    'AP'=>'Amapá',
    'AM'=>'Amazonas',
    'BA'=>'Bahia',
    'CE'=>'Ceará',
    'DF'=>'Distrito Federal',
    'ES'=>'Espírito Santo',
    'GO'=>'Goiás',
    'MA'=>'Maranhão',
    'MT'=>'Mato Grosso',
    'MS'=>'Mato Grosso do Sul',
    'MG'=>'Minas Gerais',
    'PA'=>'Pará',
    'PB'=>'Paraíba',
    'PR'=>'Paraná',
    'PE'=>'Pernambuco',
    'PI'=>'Piauí',
    'RJ'=>'Rio de Janeiro',
    'RN'=>'Rio Grande do Norte',
    'RS'=>'Rio Grande do Sul',
    'RO'=>'Rondônia',
    'RR'=>'Roraima',
    'SC'=>'Santa Catarina',
    'SP'=>'São Paulo',
    'SE'=>'Sergipe',
    'TO'=>'Tocantins'
  ];
?>

<div class="text-left">
  <h2>Cadastro de Imóvel</h2>
</div>

<div style="margin-bottom: 20px;">
  <a href="sistema.php?page=imoveis" class="btn"><i class="fas fa-chevron-left"></i> Voltar</a>
</div>

<style type="text/css">
  .form-control {
    width: 50%;
  }

  .alert {
    width: 50%;
  }
</style>

<form class="form-default" method="POST" action="app/controllers/ImovelController.php">

  <input type="hidden" name="id" value="<?php echo $imovel['id']; ?>">

  <div class="form-group">
    <label>Cliente</label>
    <select id="cliente_id" name="cliente_id" class="form-control mT-5">
      <?php foreach ($clientes as $c) { ?>
      <option value="<?php echo $c['id']; ?>" <?php echo $c['id']==$imovel['cliente_id'] ? 'selected' : ''; ?>>
        <?php echo $c['nome']; ?>
      </option>
      <?php } ?>
    </select>
  </div>

  <div class="form-group">
    <label>Descrição</label>
    <input type="text" class="form-control mT-5" id="descricao" name="descricao" value="<?php echo $imovel['descricao']; ?>" required>
  </div>

  <div class="form-group">
    <label>CEP</label>
    <input type="text" class="form-control mT-5" id="cep" name="cep" value="<?php echo $imovel['cep']; ?>" required>
  </div>

  <div class="form-group">
    <label>Logradouro</label>
    <input type="text" class="form-control mT-5" id="logradouro" name="logradouro" value="<?php echo $imovel['logradouro']; ?>" required>
  </div>

  <div class="form-group">
    <label>Complemento</label>
    <input type="text" class="form-control mT-5" id="complemento" name="complemento" value="<?php echo $imovel['complemento']; ?>">
  </div>

  <div class="form-group">
    <label>Bairro</label>
    <input type="text" class="form-control mT-5" id="bairro" name="bairro" value="<?php echo $imovel['bairro']; ?>" required>
  </div>

  <div class="form-group">
    <label>Localidade</label>
    <input type="text" class="form-control mT-5" id="localidade" name="localidade" value="<?php echo $imovel['localidade']; ?>" required>
  </div>

  <div class="form-group">
    <label>Estado</label>
    <select id="uf" name="uf" class="form-control mT-5">
      <?php foreach ($estados as $sigla => $e) { ?>
      <option value="<?php echo $sigla; ?>" <?php echo $sigla==$imovel['uf'] ? 'selected' : ''; ?>>
        <?php echo $e; ?>
      </option>
      <?php } ?>
    </select>
  </div>

  <div class="form-group left">
    <button type="submit" class="btn btn-save">Salvar</button> 
  </div>
</form>