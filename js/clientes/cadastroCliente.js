var id = parseInt(base64dec(getUrlParam('id')));

function getCliente() {
  ajax('clientes', {id: id}).then(function (response) {
    populateForm(response.data);
  });
}

function save(data) {
  data.cpf_cnpj = data.cpf_cnpj.replace(/\D/g,'');
  if (id) data.id = id;
  ajax('clientes', data, 'POST').then(function() {
    swalSuccess();
    $("#cpf_cnpj").removeClass("has-error");
    $(".alert").hide();
  }).fail(function() {
    $("#cpf_cnpj").addClass("has-error");
    $(".alert").show();
  });
}

function setMasks() {
  var options = {
    onKeyPress: function (cpf, ev, el, op) {
      var masks = ['000.000.000-000', '00.000.000/0000-00'];
      $('#cpf_cnpj').mask((cpf.length > 14) ? masks[1] : masks[0], op);
    }
  }
  $('#cpf_cnpj').val().length > 11 ? $('#cpf_cnpj').mask('00.000.000/0000-00', options) : $('#cpf_cnpj').mask('000.000.000-00#', options);
  $('#telefone').mask('(00) 00000-0000');
}

function populateForm(data) {
  $("#nome").val(data.nome);
  $("#cpf_cnpj").val(data.cpf_cnpj);
  $("#email").val(data.email);
  $("#telefone").val(data.telefone);
  setMasks();
}

if (id) {
  getCliente();
} else {
  setMasks();
}
