<div class="text-left">
  <h2>Cadastro de Imóvel</h2>
</div>

<div style="margin-bottom: 20px;">
  <a href="sistema.php?page=imoveis" class="btn"><i class="fas fa-chevron-left"></i> Voltar</a>
</div>

<form id="form_imovel" class="form-default" method="POST" novalidate>

  <div class="form-group">
    <label class="required">Cliente</label>
    <select id="cliente_id" name="cliente_id" class="form-control mT-5" required>
      <option value="" selected>Selecione um cliente</option>
    </select>
  </div>

  <div class="form-group">
    <label class="required">Descrição</label>
    <input type="text" class="form-control mT-5" id="descricao" name="descricao" required>
  </div>

  <div class="form-group">
    <label class="required">CEP</label>
    <input type="text" class="form-control mT-5" id="cep" name="cep" required>
  </div>

  <div class="form-group">
    <label class="required">Logradouro</label>
    <input type="text" class="form-control mT-5" id="logradouro" name="logradouro" required>
  </div>

  <div class="form-group">
    <label>Complemento</label>
    <input type="text" class="form-control mT-5" id="complemento" name="complemento">
  </div>

  <div class="form-group">
    <label class="required">Bairro</label>
    <input type="text" class="form-control mT-5" id="bairro" name="bairro" required>
  </div>

  <div class="form-group">
    <label class="required">Localidade</label>
    <input type="text" class="form-control mT-5" id="localidade" name="localidade" required>
  </div>

  <div class="form-group">
    <label class="required">Estado</label>
    <select id="uf" name="uf" class="form-control mT-5" required>
      <option value="" selected>Selecione</option>
      <option value="AC">Acre</option>
      <option value="AL">Alagoas</option>
      <option value="AP">Amapá</option>
      <option value="AM">Amazonas</option>
      <option value="BA">Bahia</option>
      <option value="CE">Ceará</option>
      <option value="DF">Distrito Federal</option>
      <option value="ES">Espírito Santo</option>
      <option value="GO">Goiás</option>
      <option value="MA">Maranhão</option>
      <option value="MT">Mato Grosso</option>
      <option value="MS">Mato Grosso do Sul</option>
      <option value="MG">Minas Gerais</option>
      <option value="PA">Pará</option>
      <option value="PB">Paraíba</option>
      <option value="PR">Paraná</option>
      <option value="PE">Pernambuco</option>
      <option value="PI">Piauí</option>
      <option value="RJ">Rio de Janeiro</option>
      <option value="RN">Rio Grande do Norte</option>
      <option value="RS">Rio Grande do Sul</option>
      <option value="RO">Rondônia</option>
      <option value="RR">Roraima</option>
      <option value="SC">Santa Catarina</option>
      <option value="SP">São Paulo</option>
      <option value="SE">Sergipe</option>
      <option value="TO">Tocantins</option>
    </select>
  </div>

  <div class="form-group left">
    <button type="button" onclick="submitForm(event)" class="btn btn-save">Salvar</button>
  </div>
</form>

<script src="js/imoveis/cadastroImovel.js"></script>