<?php 
  $endereco = [
    'id' => 0,
    'cliente_id' => $_GET['id'],
    'cep' => '',
    'logradouro' => '',
    'complemento' => '',
    'bairro' => '',
    'localidade' => ''
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

  $enderecos = [];
  $sql = "SELECT * FROM cliente_endereco WHERE md5(cliente_id) = '{$hash_id}'";
  if ($result = $mysqli->query($sql)) {
    while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
      $row['logradouro'] = utf8_encode($row['logradouro']);
      $row['complemento'] = utf8_encode($row['complemento']);
      $row['bairro'] = utf8_encode($row['bairro']);
      $row['localidade'] = utf8_encode($row['localidade']);
      $enderecos[] = $row;
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
  <h2>Cadastro de Endereços - <?php echo $cliente['nome']; ?></h2>
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

<form class="form-default" method="POST" action="app/controllers/ClienteEnderecoController.php">

  <input type="hidden" name="id" value="<?php echo $endereco['id']; ?>">
  <input type="hidden" name="cliente_id" value="<?php echo $cliente['id']; ?>">

  <div class="form-group">
    <label>CEP</label>
    <input type="text" class="form-control mT-5" id="cep" name="cep" value="<?php echo $endereco['cep']; ?>" required>
  </div>

  <div class="form-group">
    <label>Logradouro</label>
    <input type="text" class="form-control mT-5" id="logradouro" name="logradouro" value="<?php echo $endereco['logradouro']; ?>" required>
  </div>

  <div class="form-group">
    <label>Complemento</label>
    <input type="text" class="form-control mT-5" id="complemento" name="complemento" value="<?php echo $endereco['complemento']; ?>" required>
  </div>

  <div class="form-group">
    <label>Bairro</label>
    <input type="text" class="form-control mT-5" id="bairro" name="bairro" value="<?php echo $endereco['bairro']; ?>" required>
  </div>

  <div class="form-group">
    <label>Localidade</label>
    <input type="text" class="form-control mT-5" id="localidade" name="localidade" value="<?php echo $endereco['localidade']; ?>" required>
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


<table class="table table-default">
  <thead>
    <tr>
      <th width="5%">#</th>
      <th class="text-left">CEP</th>
      <th width="10%">Logradouro</th>
      <th width="12%">Complemento</th>
      <th width="12%">Bairro</th>
      <th width="12%">Localidade</th>
      <th width="12%">UF</th>
      <th width="14%">Opções</th>
    </tr>
  </thead>
  <tbody>
    <?php if (count($enderecos) == 0) { ?>
      <tr><td class="text-center" colspan="8" style="padding: 20px">Nenhum registro encontrado</td></tr>
    <?php } ?>
    <?php foreach ($enderecos as $key => $c) { ?>
      <tr>
        <td class="text-center"><?php echo $key+1; ?></td>
        <td class="text-center"><?php echo $c['cep']; ?></td>
        <td class="text-center"><?php echo empty($c['logradouro']) ? '-' : $c['logradouro']; ?></td>
        <td class="text-center"><?php echo empty($c['complemento']) ? '-' : $c['complemento']; ?></td>
        <td class="text-center"><?php echo empty($c['bairro']) ? '-' : $c['bairro']; ?></td>
        <td class="text-center"><?php echo empty($c['localidade']) ? '-' : $c['localidade']; ?></td>
        <td class="text-center"><?php echo empty($c['uf']) ? '-' : $c['uf']; ?></td>
        <td class="text-center">
          <button class="btn btn-danger" title="EXCLUIR" onclick="deleteEndereco(<?php echo $c['id']; ?>)">
            <i class="fas fa-trash-alt"></i>
          </button> 
        </td>
      </tr>
    <?php } ?>
  </tbody>
</table>


<script type="text/javascript">
  function deleteEndereco(id) {
    if (confirm('Deseja realmente excluir esse endereço?')) {
      $.ajax({
        url: API_URL + 'cliente_endereco/'+id,
        type: 'DELETE',
        success: function(result) {
          alert('Excluído com sucesso!');
          window.location.reload();
        },
        error: function(error) {
          console.error(error);
        }
      });
    }
  } 
</script>