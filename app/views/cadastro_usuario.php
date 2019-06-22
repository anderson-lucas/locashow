<div class="text-left">
  <h2>Cadastro de Usuário</h2>
</div>

<div style="margin-bottom: 20px;">
  <a href="sistema.php?page=usuarios" class="btn"><i class="fas fa-chevron-left"></i> Voltar</a>
</div>

<form id="form_usuario" class="form-default" method="POST" novalidate>

  <div class="form-group">
    <label class="required">Nome</label>
    <input type="text" class="form-control mT-5" id="nome" name="nome" required>
  </div>

  <div class="form-group">
    <label class="required">Login</label>
    <input type="text" class="form-control mT-5" id="login" name="login" required>
  </div>

  <div class="form-group">
    <label class="required">E-mail</label>
    <input type="email" class="form-control mT-5" id="email" name="email" required>
  </div>
  
  <div class="form-group">
    <button type="button" onclick="submitForm(event)" class="btn btn-save">Salvar</button>
  </div>
</form>

<script src="js/usuarios/cadastroUsuario.js"></script>