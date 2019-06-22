var grupo_id = parseInt(base64dec(getUrlParam('grupo_id')));

function getAll() {
  ajax('grupos', {id: grupo_id}).then(function(response) {
    grupo = response.data[0];
    $("#infoGrupo").html(grupo.nome);
  });

  ajax('grupo-menu', {grupo_id: grupo_id}).then(function(data) {
    populateTable(data.data);
  });
}
  
function populateTable(data) {
  cleanTable('tabela_grupo_menu');
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
                <input type="checkbox" onclick="toggleMenu(this.checked, ${data.id})" ${isVinculado?'checked':''}>
                <span class="slider round"></span>
              </label>
            </td>
          </tr>
        `;
      });
    }

    $("#tabela_grupo_menu tbody").append(row);
    hideLoading();
  }, 1000);
}

function toggleMenu(checked, menu_id) {
  return checked ? addMenu(menu_id) : deleteMenu(menu_id);
}

function deleteMenu(menu_id) {
  return ajax('grupo-menu', null, 'DELETE', `${grupo_id}/${menu_id}`);
}

function addMenu(menu_id) {
  return ajax('grupo-menu', {grupo_id: grupo_id, menu_id: menu_id}, 'POST');
}

getAll();