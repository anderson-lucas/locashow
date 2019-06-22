var id = parseInt(base64dec(getUrlParam('id')));

function getMenu() {
  ajax('menus', {id: id}).then(function (response) {
    populateForm(response.data[0]);
  });
}

function save(data) {
  if (id) data.id = id;
  ajax('menus', data, 'POST').then(function() {
    swalSuccess();
  });
}

function populateForm(data) {
  $("#nome").val(data.nome);
  $("#icone").val(data.icone);
  $("#link").val(data.link);
  $("#ordem").val(data.ordem);
}

if (id) {
  getMenu();
}