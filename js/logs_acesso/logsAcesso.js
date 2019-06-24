function getAll() {
  ajax('logs_acesso').then(function(data) {
    populateTable(data.data);
  });
}

function populateTable(data) {
  cleanTable('tabela_logs_acesso');
  showLoading();
  setTimeout(function() {
    var row = '';
    if (data.length > 0) {
      data.map(function(data, index) {
        row += `
          <tr>
            <td class="text-center">${index + 1}</td>
            <td>${data.nome}</td>
            <td class="text-center cpf_cnpj">${data.created}</td>
            <td class="text-center">${data.qtd}</td>
          </tr>
        `;
      });
    } else {
      row = `<tr><td class="text-center" colspan="7">Nenhum registro encontrado</td></tr>`;
    }

    cleanTable('tabela_logs_acesso');
    $("#tabela_logs_acesso tbody").append(row);
    hideLoading();
  }, 1000);
}

getAll();