var id = parseInt(base64dec(getUrlParam('id')));
var clientes = [];

function getClientes() {
  ajax('clientes').then(function (response) {
    clientes = response.data;
    populateComboClientes(clientes);
  });
}

function getImovel() {
  ajax('imoveis', {id: id}).then(function (response) {
    setTimeout(function() {
      populateForm(response.data[0]);
    }, 100);
  });
}

function save(data) {
  if (id) data.id = id;
  ajax('imoveis', data, 'POST').then(function() {
    swalSuccess();
  });
}

function setMasks() {
  $("#cep").mask("99999-999");
}

function populateForm(data) {
  $("#cliente_id").val(data.cliente_id);
  $("#descricao").val(data.descricao);
  $("#cep").val(data.cep);
  $("#logradouro").val(data.logradouro);
  $("#complemento").val(data.complemento);
  $("#bairro").val(data.bairro);
  $("#localidade").val(data.localidade);
  $("#uf").val(data.uf);
}

function populateComboClientes(clientes) {
  var row = '';
  clientes.map(function(cliente, index) {
    row += `<option value="${cliente.id}">${cliente.nome}</option>`;
  });
  $("#cliente_id").append(row);
}

if (id) {
  getImovel();
} else {
  setMasks();
}

getClientes();
