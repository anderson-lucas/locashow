var contrato_id = parseInt(base64dec(getUrlParam('contrato_id')));

function getAll() {
  ajax('boletos', {contrato_id: contrato_id}).then(function(data) {
    var info = data.data[0];
    $("#info").html(`${info.nome} - Contrato: ${info.contrato_id}`);
    populateTable(data.data);
  });
}

function populateTable(data) {
  cleanTable('tabela_boletos');
  showLoading();
  setTimeout(function() {
    var row = '';
    if (data.length > 0) {
      data.map(function(data, index) {
        row += `
          <tr>
            <td class="text-center">${index + 1}</td>
            <td class="text-center">${data.valor}</td>
            <td class="text-center">${data.dt_vencimento}</td>
            <td class="text-center">${data.created}</td>
            <td class="text-center">
              <a href="/locashow/app/views/boleto.php?id=${md5(data.boleto_id)}" target="_blank" class="btn btn-save" title="ABRIR BOLETO">
                <i class="fas fa-download"></i>
              </a>
            </td>
          </tr>
        `;
      });
    } else {
      row = `<tr><td class="text-center" colspan="7">Nenhum registro encontrado</td></tr>`;
    }

    cleanTable('tabela_boletos');
    $("#tabela_boletos tbody").append(row);
    hideLoading();
  }, 1000);
}

getAll();