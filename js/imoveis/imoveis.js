function search() {
  var filter = $("#search").val();
  var promise = $.ajax({
    url: API_URL + 'imoveisSearch/'+filter,
    type: 'GET'
  });

  promise.then(function(data) {
    populateTable(data.data);
  });
}

function cleanTable() {
  $("#tabela_imoveis tbody").empty();
}

function deleteImovel(id) {
  if (confirm('Deseja realmente excluir esse imóvel?')) {
    var promise = $.ajax({
      url: API_URL + 'imoveis/' + id,
      type: 'DELETE'
    });

    promise.then(function() {
      loadTable();
    });
  }
}

function getImoveis() {
  return $.ajax({
    url: API_URL + 'imoveis',
    type: 'GET'
  });
}

function loadTable() {
  getImoveis().then(function(data) {
    populateTable(data.data);
  });
}

function populateTable(data) {
  console.log(data);
  cleanTable();
  showLoading();
  setTimeout(function() {
    var row = '';
    if (data.length > 0) {
      data.map(function(data, index) {
        row += `
          <tr>
            <td class="text-center">${index + 1}</td>
            <td>${data.nome_cliente}</td>
            <td>${data.descricao}</td>
            <td class="text-center">${data.localidade}</td>
            <td class="text-center">${data.logradouro}</td>
            <td class="text-center">${data.created}</td>
            <td class="text-center">
              <a href="sistema.php?page=cadastro_imovel_imagens&id=${md5(data.id)}" class="btn btn-save" title="FOTOS">
                <i class="fas fa-image"></i>
              </a>
              <a href="sistema.php?page=cadastro_imovel&id=${md5(data.id)}" class="btn btn-edit" title="EDITAR">
                <i class="fas fa-pencil-alt"></i>
              </a>
              <a href="sistema.php?page=cadastro_imovel&id=${md5(data.id)}&delete=1" class="btn btn-danger" title="EXCLUIR">
                <i class="fas fa-trash-alt"></i>
              </a>
            </td>
          </tr>
        `;
      });
    } else {
      row = `<tr><td class="text-center" colspan="7">Nenhum registro encontrado</td></tr>`;
    }
    
    $("#tabela_imoveis tbody").append(row);
    hideLoading();
  }, 1000);
}

loadTable();