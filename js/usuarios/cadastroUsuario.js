var id = parseInt(base64dec(getUrlParam('id')));

function getUsuario() {
  ajax('usuarios', {id: id}).then(function (response) {
    populateForm(response.data[0]);
  });
}

function save(data) {
  if (id) data.id = id;
  ajax('usuarios', data, 'POST').then(function() {
    swalSuccess();
    $("#email").removeClass("has-error");
  }).fail(function(error) {
    $("#email").addClass("has-error");
    swalError('E-mail informado já cadastrado no sistema!');
  });
}

function populateForm(data) {
  $("#nome").val(data.nome);
  $("#login").val(data.login);
  $("#email").val(data.email);
}

if (id) {
  getUsuario();
}