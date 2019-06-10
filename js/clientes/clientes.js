function search() {
  var filter = $("#search").val();

  var promise = $.ajax({
    url: API_URL + 'clientesSearch/'+filter,
    type: 'GET'
  });

  promise.then(function(data) {
    populateTable(data.data);
  });
}

function cleanTable() {
  $("#tabela_clientes tbody").empty();
}

function deleteCliente(id) {
  if (confirm('Deseja realmente excluir esse cliente?')) {
    var promise = $.ajax({
      url: API_URL + 'clientes/' + id,
      type: 'DELETE'
    });

    promise.then(function() {
      loadTable();
    }, function(error) {
      alert(error.responseJSON.data);
    });
  }
}

//buscando todos os clientes
function getClientes() {
  return $.ajax({
    url: API_URL + 'clientes',
    type: 'GET'
  });
}

function loadTable() {
  getClientes().then(function(data) {
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
            <td>${data.nome}</td>
            <td class="text-center">${data.cpf_cnpj}</td>
            <td class="text-center">${data.email ? data.email : '-'}</td>
            <td class="text-center">${data.telefone ? data.telefone : '-'}</td>
            <td class="text-center">${data.created}</td>
            <td class="text-center">
              <a href="sistema.php?page=cadastro_cliente_endereco&id=${md5(data.id)}" class="btn btn-save" title="ENDEREÇOS">
                <i class="fas fa-list"></i>
              </a>
              <a href="sistema.php?page=cadastro_cliente&id=${md5(data.id)}" class="btn btn-edit" title="EDITAR">
                <i class="fas fa-pencil-alt"></i>
              </a>
              <button class="btn btn-danger" title="EXCLUIR" onClick="deleteCliente(${data.id})">
                <i class="fas fa-trash-alt"></i>
              </button> 
            </td>
          </tr>
        `;
      });
    } else {
      row = `<tr><td class="text-center" colspan="7">Nenhum registro encontrado</td></tr>`;
    }
    
    $("#tabela_clientes tbody").append(row);
    hideLoading();
  }, 1000);
}

loadTable();