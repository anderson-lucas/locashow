function getAll() {
  ajax('grupos').then(function(data) {
    populateTable(data.data);
  });
}

function populateTable(data) {
  cleanTable('tabela_grupos');
  showLoading();
  setTimeout(function() {
    var row = '';
    if (data.length > 0) {
      data.map(function(data, index) {
        row += `
          <tr>
            <td class="text-center">${index + 1}</td>
            <td>${data.nome}</td>
            <td class="text-center">${data.created}</td>
            <td class="text-center">
              <a href="sistema.php?page=cadastro_grupo_menu&grupo_id=${base64enc(data.id)}" class="btn btn-warning" title="PERMISSÕES">
                <i class="fas fa-unlock-alt"></i>
              </a>
              <a href="sistema.php?page=cadastro_grupo&id=${base64enc(data.id)}" class="btn btn-edit" title="EDITAR">
                <i class="fas fa-pencil-alt"></i>
              </a>
              <button class="btn btn-danger" title="EXCLUIR" onclick="askBeforeDelete(${data.id}, 'grupos')">
                <i class="fas fa-trash-alt"></i>
              </button>
            </td>
          </tr>
        `;
      });
    } else {
      row = `<tr><td class="text-center" colspan="7">Nenhum registro encontrado</td></tr>`;
    }

    cleanTable('tabela_grupos');
    $("#tabela_grupos tbody").append(row);
    hideLoading();
  }, 1000);
}

getAll();