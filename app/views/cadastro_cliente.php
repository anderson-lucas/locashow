<div class="text-left">
  <h2>Cadastro de Cliente</h2>
</div>

<div style="margin-bottom: 20px;">
  <a href="sistema.php?page=clientes" class="btn"><i class="fas fa-chevron-left"></i> Voltar</a>
</div>

<form id="form_cliente" class="form-default" method="POST" novalidate>

  <div class="form-group text-center alert alert-error" hidden>
    <small>CPF / CNPJ informado já cadastrado!</small>
  </div>

  <div class="form-group">
    <label class="required">Nome</label>
    <input type="text" class="form-control mT-5" id="nome" name="nome" required>
  </div>

  <div class="form-group">
    <label class="required">CPF / CNPJ</label>
    <input type="text" class="form-control mT-5" id="cpf_cnpj" name="cpf_cnpj" required>
  </div>

  <div class="form-group">
    <label>E-mail</label>
    <input type="email" class="form-control mT-5" id="email" name="email">
  </div>

  <div class="form-group">
    <label>Telefone</label>
    <input type="text" class="form-control mT-5" id="telefone" name="telefone">
  </div>
  
  <div class="form-group">
    <button type="button" onclick="submitForm(event)" class="btn btn-save">Salvar</button>
  </div>
</form>

<script src="js/clientes/cadastroCliente.js"></script>