var imovel_id = parseInt(base64dec(getUrlParam('imovel_id')));

function getAll() {
  ajax('imoveis', { id: imovel_id }).then(function (response) {
    imovel = response.data[0];
    $("#nomeImovel").html(`(${imovel.codigo}) - ${imovel.descricao}`);
  });

  ajax('imovel-imagem', { imovel_id: imovel_id }).then(function (response) {
    populateImages(response.data);
  });
}

function populateImages(data) {
  var row = '';
  data.map(function (data) {
    row += `
    <div class="div-image">
      <img src="/locashow/${data.full_path}">
      <button onclick="askBeforeDelete(${data.id}, 'imovel-imagem')" class="remove-image btn btn-danger">
        <i class="fa fa-trash-alt"></i>
      </button>
    </div>
    `;
  });
  if (row) {
    $("#fotos").show().html(row);
  }
}

function save(data) {
  var formData = new FormData($("#form_imovel_imagem")[0]);
  formData.append('imovel_id', imovel_id);

  $.ajax({
    url: `${API_URL}imovel-imagem`,
    type: 'POST',
    dataType: 'json',
    data: formData,
    contentType: false,
    processData: false
  }).then(function() {
    swalSuccess();
    getAll();
  });
}

if (imovel_id) {
  getAll();
} else {
  window.location.href = '/locashow/sistema.php?page=imoveis';
}
