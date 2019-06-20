<div class="text-left">
  <h2>Cadastro de Contratos</h2>
</div>

<div style="margin-bottom: 20px;">
  <a href="sistema.php?page=contratos" class="btn"><i class="fas fa-chevron-left"></i> Voltar</a>
</div>

<form id="form_contrato" class="form-default" method="POST" novalidate>

  <div class="form-group">
    <label class="required">Cliente</label>
    <select id="cliente_id" name="cliente_id" class="form-control mT-5" required>
      <option value="" selected>Selecione um cliente</option>
    </select>
  </div>

  <div class="form-group">
    <label class="required">Imóvel</label>
    <select id="imovel_id" name="imovel_id" class="form-control mT-5" required>
      <option value="" selected>Selecione um imóvel</option>
    </select>
  </div>

  <div class="form-group">
    <label class="required">Tipo</label>
    <label style="font-weight: normal;"><input type="radio" name="tipo" value="L" required checked> Locação </label>
    <label style="font-weight: normal;"><input type="radio" name="tipo" value="V" required> Venda </label>
  </div>

  <div id="form-group-vencimento" class="form-group">
    <label>Data vencimento</label>
    <input type="text" class="form-control mT-5" id="dt_vencimento" name="dt_vencimento">
  </div>

  <div class="form-group">
    <label class="required">Valor</label>
    <input type="text" class="form-control mT-5" id="valor" name="valor" required>
  </div>

  <div class="form-group">
    <label class="required">Status</label>
    <label style="font-weight: normal;"><input type="radio" name="status" value="A" required checked> Ativo</label>
    <label style="font-weight: normal;"><input type="radio" name="status" value="I" required> Inativo</label>
  </div>

  <div class="form-group">
    <button type="button" onclick="submitForm(event)" class="btn btn-save">Salvar</button>
  </div>
</form>

<script src="js/contratos/cadastroContrato.js"></script>