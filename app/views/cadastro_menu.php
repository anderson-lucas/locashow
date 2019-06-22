<div class="text-left">
  <h2>Cadastro de Menu</h2>
</div>

<div style="margin-bottom: 20px;">
  <a href="sistema.php?page=menus" class="btn"><i class="fas fa-chevron-left"></i> Voltar</a>
</div>

<form id="form_menu" class="form-default" method="POST" novalidate>

  <div class="form-group">
    <label class="required">Nome</label>
    <input type="text" class="form-control mT-5" id="nome" name="nome" required>
  </div>

  <div class="form-group">
    <label class="required">Link</label>
    <input type="text" class="form-control mT-5" id="link" name="link" required>
  </div>

  <div class="form-group">
    <label class="required">Ícone</label>
    <input type="text" class="form-control mT-5" id="icone" name="icone" required>
  </div>

  <div class="form-group">
    <label class="required">Ordem</label>
    <input type="number" min="1" class="form-control mT-5" id="ordem" name="ordem" required>
  </div>
  
  <div class="form-group">
    <button type="button" onclick="submitForm(event)" class="btn btn-save">Salvar</button>
  </div>
</form>

<script src="js/menus/cadastroMenu.js"></script>