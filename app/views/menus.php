<div class="text-left">
  <h2>Menus</h2>
</div>

<div style="margin-bottom: 20px;">
  <a href="sistema.php?page=configuracoes" class="btn"><i class="fas fa-chevron-left"></i> Voltar</a>
  <a href="sistema.php?page=cadastro_menu" class="btn btn-save"><i class="fas fa-plus"></i> Adicionar</a>

  <div class="search" style="float: right;">
    <input type="text" id="search" class="form-control" source="menus" placeholder="Pesquisar">
  </div>
</div>

<table class="table table-default" id="tabela_menus">
  <thead>
    <tr>
      <th width="5%">#</th>
      <th class="text-left">Nome</th>
      <th class="text-left">Link</th>
      <th class="text-center">Ícone</th>
      <th class="text-center">Ordem</th>
      <th width="12%">Cadastrado em</th>
      <th width="14%">Opções</th>
    </tr>
  </thead>
  <tbody></tbody>
</table>

<script src="js/menus/menus.js"></script>