function getAll() {
  ajax('clientes').then(function(data) {
    populateTable(data.data);
  });
}

function populateTable(data) {
  cleanTable('tabela_clientes');
  showLoading();
  setTimeout(function() {
    var row = '';
    if (data.length > 0) {
      data.map(function(data, index) {
        row += `
          <tr>
            <td class="text-center">${index + 1}</td>
            <td>${data.nome}</td>
            <td class="text-center cpf_cnpj">${data.cpf_cnpj}</td>
            <td class="text-center">${data.email ? data.email : '-'}</td>
            <td class="text-center">${data.telefone ? data.telefone : '-'}</td>
            <td class="text-center">${data.created}</td>
            <td class="text-center">
              <a href="sistema.php?page=cadastro_cliente_endereco&cliente_id=${base64enc(data.id)}" class="btn btn-save" title="ENDEREÇOS">
                <i class="fas fa-list"></i>
              </a>
              <a href="sistema.php?page=cadastro_cliente&id=${base64enc(data.id)}" class="btn btn-edit" title="EDITAR">
                <i class="fas fa-pencil-alt"></i>
              </a>
              <button class="btn btn-danger" title="EXCLUIR" onclick="askBeforeDelete(${data.id}, 'clientes')">
                <i class="fas fa-trash-alt"></i>
              </button> 
            </td>
          </tr>
        `;
      });
    } else {
      row = `<tr><td class="text-center" colspan="7">Nenhum registro encontrado</td></tr>`;
    }

    cleanTable('tabela_clientes');
    $("#tabela_clientes tbody").append(row);
    hideLoading();
  }, 1000);
}

getAll();