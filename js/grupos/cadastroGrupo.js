var id = parseInt(base64dec(getUrlParam('id')));

function getGrupo() {
  ajax('grupos', {id: id}).then(function (response) {
    populateForm(response.data[0]);
  });
}

function save(data) {
  if (id) data.id = id;
  ajax('grupos', data, 'POST').then(function() {
    swalSuccess();
  });
}

function populateForm(data) {
  $("#nome").val(data.nome);
}

if (id) {
  getGrupo();
}