const API_URL = '/locashow/api.php/';

var showLoading = function() {
  var row = `<tr id="loading"><td class="text-center" colspan="100"><img width="10%" src="/locashow/assets/loading.gif"></td></tr>`; 
  $("#tabela_clientes tbody").append(row);
}

var hideLoading = function() {
  $("#loading").hide();
}

var md5 = function(value) {
  return CryptoJS.MD5(value);
}

var getViaCep = function(cep) {
  var promise = $.ajax({
    url: `https://viacep.com.br/ws/${cep}/json/`,
    type: 'GET'
  });

  return promise;
}

$(function () {
  $("#search").keypress(function(event) {
    if (event.keyCode === 13) search();
  });
});
