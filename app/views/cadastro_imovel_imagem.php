<div class="text-left">
  <h2>Cadastro de Fotos do Imóvel - <span id="nomeImovel"></span></h2>
</div>

<div style="margin-bottom: 20px;">
  <a href="sistema.php?page=imoveis" class="btn"><i class="fas fa-chevron-left"></i> Voltar</a>
</div>

<form id="form_imovel_imagem" class="form-default" enctype="multipart/form-data" method="POST" novalidate>
  <div class="form-group">
    <label>Inserir nova foto</label>
    <input type="file" accept="image/jpeg" class="form-control mT-5" id="foto" name="foto" required>
  </div>

  <div class="form-group">
    <button type="button" onclick="submitForm(event)" class="btn btn-save">Salvar</button> 
  </div>
</form>

<div id="fotos" hidden></div>

<script src="js/imoveis/cadastroImovelImagem.js"></script>

<style type="text/css">
  .form-control {
    width: 50%;
  }

  .alert {
    width: 50%;
  }

  #fotos {
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