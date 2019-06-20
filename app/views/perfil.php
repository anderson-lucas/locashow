<div class="text-left">
  <h2>Meu perfil</h2>
</div>

<div class="tab">
  <button class="tablinks active" onclick="openTab('dados_pessoais')" id="dados_pessoais">Dados pessoais</button>
  <button class="tablinks" onclick="openTab('atualizar_senha')" id="atualizar_senha">Atualizar senha</button>
</div>

<form id="form_perfil" class="form-default" method="POST" novalidate>

  <div class="div_tab" id="tab_dados_pessoais">
    <div class="form-group">
      <label class="required">Nome</label>
      <input type="text" class="form-control mT-5" id="nome" name="nome" required>
    </div>

    <div class="form-group">
      <label class="required">E-mail</label>
      <input type="email" class="form-control mT-5" id="email" name="email" required>
    </div>
  </div>

  <div class="div_tab" id="tab_atualizar_senha" hidden>
    <div class="form-group">
      <label class="required">Senha atual</label>
      <input type="password" class="form-control mT-5" id="senha_atual" name="senha_atual">
    </div>

    <div class="form-group">
      <label class="required">Nova senha</label>
      <input type="password" class="form-control mT-5" id="senha_nova" name="senha_nova">
    </div>
  </div>
  
  <div class="form-group">
    <button type="button" onclick="submitForm(event)" class="btn btn-save">Salvar</button>
  </div>
</form>

<script>
  var id = parseInt('<?php echo $_SESSION['id']; ?>');
</script>

<script src="js/perfil/perfil.js"></script>

<style>
  /* Style the tab */
  .tab {
    display: inline-block;
    margin-bottom: 10px;
  }

  /* Style the buttons inside the tab */
  .tab button {
    background-color: inherit;
    float: left;
    border: none;
    outline: none;
    cursor: pointer;
    padding: 10px 12px;
    font-size: 16px;
    font-family: unset;
    text-transform: uppercase;
  }

  /* Change background color of buttons on hover */
  .tab button:hover {
    background-color: #ddd;
  }

  .active {
    border-bottom: 2px solid !important;
    transition: color .28s ease;
  }
</style>