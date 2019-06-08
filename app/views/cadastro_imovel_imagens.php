<?php 
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
    $sql = "SELECT upper(left(sha1(id), 8)) as codigo, imovel.* FROM imovel WHERE md5(id) = '{$hash_id}'";
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

  $imagens = [];
  $sql = "SELECT * FROM imovel_imagem WHERE md5(imovel_id) = '{$hash_id}'";
  if ($result = $mysqli->query($sql)) {
    while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
      $imagens[] = $row;
    }
    $result->free();
  }
?>

<div class="text-left">
  <h2>Cadastro de Fotos do Imóvel - <?php echo "({$imovel['codigo']}) {$imovel['descricao']}";?></h2>
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

  .fotos {
    margin-bottom: 20px;
    padding: 10px;
    border: 1px solid #c3c3c3;
    border-radius: 5px;
    width: fit-content;
  }

  .div-image img {
    width: 200px;
    height: 200px;
    border: 1px solid #656565;
    margin: 5px;
  }

  .div-image {
    position: relative;
    display: inline-flex;
  }

  .remove-image {
    right: 5px;
    bottom: 5px;
    position: absolute;
    border-radius: 0px;
  }
</style>

<form class="form-default" enctype="multipart/form-data" method="POST" action="app/controllers/ImovelImagemController.php">
  <input type="hidden" name="imovel_id" value="<?php echo $imovel['id']; ?>">
  
  <div class="form-group">
    <label>Inserir nova foto</label>
    <input type="file" accept="image/jpeg" class="form-control mT-5" id="foto" name="foto" required>
  </div>

  <div class="form-group left">
    <button type="submit" class="btn btn-save">Salvar</button> 
  </div>
</form>

<?php if (count($imagens) > 0) { ?>
<div class="fotos">
<?php foreach ($imagens as $key => $foto) { ?>
  <div class="div-image">
    <img src="/locashow/<?php echo $foto['full_path']; ?>">
    <button onclick="deleteFoto(<?php echo $foto['id']; ?>)" class="remove-image btn btn-danger"><i class="fa fa-trash-alt"></i></button>
  </div>
<?php } ?>
</div>
<?php } else { ?>
Nenhuma foto cadastrada para esse imóvel.
<br><br>
<?php } ?>

<script type="text/javascript">
  function deleteFoto(id) {
    if (confirm('Deseja realmente excluir essa foto?')) {
      $.ajax({
        url: API_URL + 'imovel_imagens/'+id,
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
