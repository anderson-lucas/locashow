const API_URL = '/locashow/api.php/';

var showLoading = function() {
  var row = `<tr id="loading"><td class="text-center" colspan="100"><img width="10%" src="/locashow/assets/loading.gif"></td></tr>`; 
  $("table tbody").append(row);
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

var swalSuccess = function() {
  swal({
    icon: "success",
    title: "Sucesso!",
    timer: 2000,
  });
}

var swalError = function(text) {
  swal({
    icon: "error",
    title: "Ops!",
    text: text
  });
}

var getFormData = function(form_id) {
  var data = {};
  $(`#${form_id}`).serializeArray().map(function(x){
    data[x.name] = x.value;
  });
  return data;
}

var getUrlParam = function(param) {
  return new URL(location.href).searchParams.get(param);
}