<div class="text-left">
  <h2>Contratos</h2>
</div>

<div style="margin-bottom: 20px;">
  <a href="sistema.php?page=cadastro_contrato" class="btn btn-save"><i class="fas fa-plus"></i> Adicionar</a>

  <div class="search" style="float: right;">
  <input type="text" id="search" class="form-control" source="contratos" placeholder="Pesquisar">
  </div>
</div>

<table id="tabela_contratos" class="table table-default">
  <thead>
    <tr>
      <th width="5%">#</th>
      <th class="text-left">Cliente</th>
      <th width="10%">Imóvel</th>
      <th width="10%">Tipo</th>
      <th width="12%">Valor</th>
      <th width="12%">Cadastrado em</th>
      <th width="14%">Opções</th>
    </tr>
  </thead>
  <tbody></tbody>
</table>

<script src="js/contratos/contratos.js"></script>