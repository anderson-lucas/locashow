<div class="text-left">
  <h2>Imóveis</h2>
</div>

<div style="margin-bottom: 20px;">
  <a href="sistema.php?page=cadastro_imovel" class="btn btn-save"><i class="fas fa-plus"></i> Adicionar</a>

  <div class="search" style="float: right;">
    <input type="text" id="search" class="form-control" placeholder="Pesquisar">
    <button class="btn btn-edit" onclick="search()"><i class="fas fa-search"></i></button>
  </div>
</div>

<table id="tabela_imoveis" class="table table-default">
  <thead>
    <tr>
      <th width="5%">Código</th>
      <th class="text-left">Cliente</th>
      <th class="text-left">Descrição</th>
      <th width="10%">Localidade</th>
      <th width="12%">Rua</th>
      <th width="12%">Cadastrado em</th>
      <th width="14%">Opções</th>
    </tr>
  </thead>
  <tbody></tbody>
</table>

<script src="js/imoveis/imoveis.js"></script>