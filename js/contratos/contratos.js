function search() {
  var filter = $("#search").val();

  var promise = $.ajax({
    url: API_URL + 'contratosSearch/'+filter,
    type: 'GET'
  });

  promise.then(function(data) {
    populateTable(data.data);
  });
}

function cleanTable() {
  $("#tabela_contratos tbody").empty();
}

function deleteContrato(id) {
  if (confirm('Deseja realmente excluir esse contrato?')) {
    var promise = $.ajax({
      url: API_URL + 'contratos/' + id,
      type: 'DELETE'
    });

    promise.then(function() {
      loadTable();
    });
  }
}

//buscando todos os contratos
function getContratos() {
  return $.ajax({
    url: API_URL + 'contratos',
    type: 'GET'
  });
}

function loadTable() {
  getContratos().then(function(data) {
    populateTable(data.data);
  });
}

function populateTable(data) {
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
            <td class="text-center">${data.descricao}</td>
            <td class="text-center">${data.tipo}</td>
            <td class="text-right">R$ ${data.valor}</td>
            <td class="text-center">${data.created}</td>
            <td class="text-center">
              <a href="sistema.php?page=cadastro_contrato&id=${md5(data.id)}" class="btn btn-edit" title="EDITAR">
                <i class="fas fa-pencil-alt"></i>
              </a>
              <a href="sistema.php?page=cadastro_contrato&id=${md5(data.id)}&delete=1" class="btn btn-danger" title="EXCLUIR">
                <i class="fas fa-trash-alt"></i>
              </a>
            </td>
          </tr>
        `;
      });
    } else {
      row = `<tr><td class="text-center" colspan="7">Nenhum registro encontrado</td></tr>`;
    }
    
    $("#tabela_contratos tbody").append(row);
    hideLoading();
  }, 1000);
}

loadTable();