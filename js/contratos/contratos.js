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
  swal({
    title: "Deseja realmente excluir?",
    icon: "warning",
    buttons: ["Cancelar", "Sim"],
    dangerMode: true,
  })
  .then(function(answer) {
    if (answer) {
      $.ajax({
        url: API_URL + 'contratos/' + id,
        type: 'DELETE'
      }).done(function() {
        loadTable();
        swalSuccess();
      }).fail(function(error) {
        swalError(error.responseJSON.data);
      });
    }
  });
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
              <button class="btn btn-danger" title="EXCLUIR" onClick="deleteContrato(${data.id})">
                <i class="fas fa-trash-alt"></i>
              </button>
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