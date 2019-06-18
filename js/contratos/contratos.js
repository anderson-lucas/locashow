function getAll() {
  ajax('contratos').then(function(data) {
    populateTable(data.data);
  });
}

function populateTable(data) {
  cleanTable('tabela_contratos');
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
            <td class="text-center">${data.desc_tipo}</td>
            <td class="text-right">R$ ${data.valor}</td>
            <td class="text-center">${data.created}</td>
            <td class="text-center">
              <a href="sistema.php?page=boletos_clientes&contrato_id=${base64enc(data.id)}" class="btn btn-save" title="BOLETOS">
                <i class="fas fa-dollar-sign"></i>
              </a>
              <a href="sistema.php?page=cadastro_contrato&id=${base64enc(data.id)}" class="btn btn-warning" title="VISUALIZAR">
                <i class="fas fa-eye"></i>
              </a>
            </td>
          </tr>
        `;
      });
    } else {
      row = `<tr><td class="text-center" colspan="7">Nenhum registro encontrado</td></tr>`;
    }
    
    cleanTable('tabela_contratos');
    $("#tabela_contratos tbody").append(row);
    hideLoading();
  }, 1000);
}

getAll();