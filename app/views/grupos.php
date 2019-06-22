<div class="text-left">
  <h2>Grupos</h2>
</div>

<div style="margin-bottom: 20px;">
  <a href="sistema.php?page=configuracoes" class="btn"><i class="fas fa-chevron-left"></i> Voltar</a>
  <a href="sistema.php?page=cadastro_grupo" class="btn btn-save"><i class="fas fa-plus"></i> Adicionar</a>

  <div class="search" style="float: right;">
    <input type="text" id="search" class="form-control" source="grupos" placeholder="Pesquisar">
  </div>
</div>

<table class="table table-default" id="tabela_grupos">
  <thead>
    <tr>
      <th width="5%">#</th>
      <th class="text-left">Nome</th>
      <th width="12%">Cadastrado em</th>
      <th width="14%">Opções</th>
    </tr>
  </thead>
  <tbody></tbody>
</table>

<script src="js/grupos/grupos.js"></script>