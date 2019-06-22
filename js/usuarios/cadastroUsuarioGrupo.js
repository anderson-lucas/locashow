var usuario_id = parseInt(base64dec(getUrlParam('usuario_id')));

function getAll() {
  ajax('usuarios', {id: usuario_id}).then(function(response) {
    cliente = response.data[0];
    $("#infoUsuario").html(`${cliente.nome} (${cliente.login})`);
  });

  ajax('usuario-grupo', {usuario_id: usuario_id}).then(function(data) {
    populateTable(data.data);
  });
}
  
function populateTable(data) {
  cleanTable('tabela_usuario_grupo');
  showLoading();
  setTimeout(function() {
    var row = '';
    if (data.length > 0) {
      data.map(function(data, index) {
        var isVinculado = parseInt(data.vinculado);
        row += `
          <tr>
            <td>${data.nome}</td>
            <td class="text-center">
              <label class="switch">
                <input type="checkbox" onclick="toggleGrupo(this.checked, ${data.id})" ${isVinculado?'checked':''}>
                <span class="slider round"></span>
              </label>
            </td>
          </tr>
        `;
      });
    }

    $("#tabela_usuario_grupo tbody").append(row);
    hideLoading();
  }, 1000);
}

function toggleGrupo(checked, grupo_id) {
  return checked ? addGrupo(grupo_id) : deleteGrupo(grupo_id);
}

function deleteGrupo(grupo_id) {
  return ajax('usuario-grupo', null, 'DELETE', `${usuario_id}/${grupo_id}`);
}

function addGrupo(grupo_id) {
  return ajax('usuario-grupo', {usuario_id: usuario_id, grupo_id: grupo_id}, 'POST');
}
  
getAll();