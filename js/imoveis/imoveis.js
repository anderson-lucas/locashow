function getAll() {
  ajax('imoveis').then(function(data) {
    populateTable(data.data);
  });
}

function populateTable(data) {
  cleanTable('tabela_imoveis');
  showLoading();
  setTimeout(function() {
    var row = '';
    if (data.length > 0) {
      data.map(function(data, index) {
        row += `
          <tr>
            <td class="text-center">${data.codigo}</td>
            <td>${data.nome_cliente}</td>
            <td>${data.descricao}</td>
            <td class="text-center">${data.localidade}</td>
            <td class="text-center">${data.logradouro}</td>
            <td class="text-center">${data.created}</td>
            <td class="text-center">
              <a href="sistema.php?page=cadastro_imovel_imagem&imovel_id=${base64enc(data.id)}" class="btn btn-save" title="FOTOS">
                <i class="fas fa-image"></i>
              </a>
              <a href="sistema.php?page=cadastro_imovel&id=${base64enc(data.id)}" class="btn btn-edit" title="EDITAR">
                <i class="fas fa-pencil-alt"></i>
              </a>
              <button class="btn btn-danger" title="EXCLUIR" onclick="askBeforeDelete(${data.id}, 'imoveis')">
                <i class="fas fa-trash-alt"></i>
              </button> 
            </td>
          </tr>
        `;
      });
    } else {
      row = `<tr><td class="text-center" colspan="7">Nenhum registro encontrado</td></tr>`;
    }
    
    cleanTable('tabela_imoveis');
    $("#tabela_imoveis tbody").append(row);
    hideLoading();
  }, 1000);
}

getAll();