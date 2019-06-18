<style>
  @import url('https://fonts.googleapis.com/css?family=Open+Sans&display=swap');

  .div-json {
    padding: 5px 20px 15px 20px;
    border-radius: 5px;
    height: 350px;
    overflow: auto;
    background-color: #232020;
    margin-top: 25px;
  }

  #json {
    color: #fff700;
    font-weight: 500;
    font-size: 14px;
  }

  #tabela_api thead tr th {
    text-transform: uppercase;
  }
</style>

<div class="text-left">
  <h2>Teste Api - Consultas</h2>
</div>

<div style="margin-bottom: 20px;">
  <button class="btn" onclick="getJson('clientes');"><i class="fas fa-play"></i> Clientes</button>
  <button class="btn" onclick="getJson('imoveis');"><i class="fas fa-play"></i> Imóveis</button>
  <button class="btn" onclick="getJson('contratos');"><i class="fas fa-play"></i> Contratos</button>
</div>

<table id="tabela_api" class="table table-default hidden">
  <thead></thead>
  <tbody></tbody>
</table>

<div class="div-json">
  <p id="placeholder" style="color: #fff700;">Resultado em JSON</p>
  <pre id="json"></pre>
</div>

<script>
function getJson(route) {
  $("#json").html("");
  $("#placeholder").hide();
  
  $.ajax({
    url: API_URL + route,
    type: 'GET'
  }).done(function(result) {
    
    $(".div-json").css("background", "url('assets/loading.gif') no-repeat center center");
    populateTable(result.data);

    setTimeout(function() {
      $("#json").html(JSON.stringify(result.data, undefined, 2));
      $(".div-json").css("background", "");
    }, 1000);
  });
}

function cleanTable() {
  $("#tabela_api tbody").empty();
  $("#tabela_api thead").empty();
}

function cleanHead() {
  $("#tabela_api thead").empty();
}

function cleanBody() {
  $("#tabela_api tbody").empty();
}

function populateTable(data) {
  cleanTable();
  setTimeout(function() {
    var row = '';
    if (data.length > 0) {
      $("#tabela_api").removeClass('hidden');
      var keys = Object.keys(data[0]);
      row = '<tr>';
      $.each(keys, function(index, attr) {
        row += `<th>${attr}</th>`;
      });
      row += '</tr>';

      cleanHead()
      $("#tabela_api thead").append(row);

      row = '';

      data.map(function(obj, idx) {
        row += '<tr>';
        $.each(keys, function(index, attr) {
          row += `<td>${obj[attr]}</td>`;
        });
        row += '</tr>';
      });
    }

    cleanBody();
    $("#tabela_api tbody").append(row);
  }, 1000);
}
</script>

