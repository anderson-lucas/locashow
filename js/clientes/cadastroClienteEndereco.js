var cliente_id = parseInt(base64dec(getUrlParam('cliente_id')));
var id_endereco = null;
var editing = false;

function getAll() {
  ajax('clientes', { id: cliente_id }).then(function (response) {
    cliente = response.data[0];
    $("#nomeCliente").html(cliente.nome);
  });

  ajax('cliente-endereco', { cliente_id: cliente_id }).then(function (response) {
    populateTable(response.data);
  });
}

function populateTable(data) {
  cleanTable('tabela_enderecos');
  showLoading();
  setTimeout(function () {
    var row = '';
    if (data.length > 0) {
      data.map(function (data, index) {
        row += `
          <tr>
            <td class="text-center">${index + 1}</td>
            <td>${data.cep}</td>
            <td class="text-center cpf_cnpj">${data.logradouro}</td>
            <td class="text-center">${data.complemento ? data.complemento : '-'}</td>
            <td class="text-center">${data.bairro}</td>
            <td class="text-center">${data.localidade}</td>
            <td class="text-center">${data.uf}</td>
            <td class="text-center">
              <button class="btn btn-edit" title="EDITAR" onclick="edit(${data.id})">
                <i class="fas fa-pencil-alt"></i>
              </button> 
              <button class="btn btn-danger" title="EXCLUIR" onclick="askBeforeDelete(${data.id}, 'cliente-endereco')">
                <i class="fas fa-trash-alt"></i>
              </button>
            </td>
          </tr>
        `;
      });
    } else {
      row = `<tr><td class="text-center" colspan="8">Nenhum registro encontrado</td></tr>`;
    }

    cleanTable('tabela_enderecos');
    $("#tabela_enderecos tbody").append(row);
    hideLoading();
  }, 1000);
}

function save(data) {
  data.cliente_id = cliente_id;
  if (editing) data.id = id_endereco;
  ajax('cliente-endereco', data, 'POST').then(function() {
    $("#form_cliente_endereco")[0].reset();
    swalSuccess();
    getAll();
  });
}

function edit(id) {
  editing = true;
  ajax('cliente-endereco', {id: id}).then(function (response) {
    id_endereco = id;
    populateForm(response.data[0]);
  });
  id_endereco = id;
}

function setMasks() {
  $("#cep").mask("99999-999");
}

function populateForm(data) {
  $("#cep").val(data.cep);
  $("#logradouro").val(data.logradouro);
  $("#complemento").val(data.complemento);
  $("#bairro").val(data.bairro);
  $("#localidade").val(data.localidade);
  $("#uf").val(data.uf);
}

if (cliente_id) {
  getAll();
} else {
  window.location.href = '/locashow/sistema.php?page=clientes';
}

setMasks();
