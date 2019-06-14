<div class="text-left">
  <h2>Clientes</h2>
</div>

<div style="margin-bottom: 20px;">
  <a href="sistema.php?page=cadastro_cliente" class="btn btn-save"><i class="fas fa-plus"></i> Adicionar</a>

  <div class="search" style="float: right;">
    <input type="text" id="search" class="form-control" source="clientesSearch" placeholder="Pesquisar">
  </div>
</div>

<table class="table table-default" id="tabela_clientes">
  <thead>
    <tr>
      <th width="5%">#</th>
      <th class="text-left">Nome</th>
      <th width="10%">CPF / CPNJ</th>
      <th width="12%">E-mail</th>
      <th width="12%">Telefone</th>
      <th width="12%">Cadastrado em</th>
      <th width="14%">Opções</th>
    </tr>
  </thead>
  <tbody></tbody>
</table>

<script src="js/clientes/clientes.js"></script>