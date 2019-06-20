function getAll() {
  ajax('usuarios').then(function(data) {
    populateTable(data.data);
  });
}

function populateTable(data) {
  cleanTable('tabela_usuarios');
  showLoading();
  setTimeout(function() {
    var row = '';
    if (data.length > 0) {
      data.map(function(data, index) {
        row += `
          <tr>
            <td class="text-center">${index + 1}</td>
            <td>${data.nome}</td>
            <td class="text-center">${data.login}</td>
            <td class="text-center">${data.email}</td>
            <td class="text-center">${data.created}</td>
            <td class="text-center">
              <a href="sistema.php?page=cadastro_usuario_grupo&id=${md5(data.id)}" class="btn btn-warning" title="GRUPOS">
                <i class="fas fa-user-cog"></i>
              </a>
              <a href="sistema.php?page=cadastro_usuario&id=${base64enc(data.id)}" class="btn btn-edit" title="EDITAR">
                <i class="fas fa-pencil-alt"></i>
              </a>
              <button class="btn btn-danger" title="EXCLUIR" onclick="askBeforeDelete(${data.id}, 'usuarios')">
                <i class="fas fa-trash-alt"></i>
              </button>
            </td>
          </tr>
        `;
      });
    } else {
      row = `<tr><td class="text-center" colspan="7">Nenhum registro encontrado</td></tr>`;
    }

    cleanTable('tabela_usuarios');
    $("#tabela_usuarios tbody").append(row);
    hideLoading();
  }, 1000);
}

getAll();