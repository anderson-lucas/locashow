const API_URL = '/locashow/api.php/';

var base64enc = function(value) {
  return btoa(value);
}

var base64dec = function (value) {
  return atob(value);
}

var showLoading = function() {
  var row = `<tr id="loading"><td class="text-center" colspan="100"><img width="10%" src="/locashow/assets/loading.gif"></td></tr>`;
  $("table tbody").empty().append(row);
}

var hideLoading = function() {
  $("#loading").hide();
}

var cleanTable = function(table) {
  $(`#${table} tbody`).empty();
}

var md5 = function(value) {
  return CryptoJS.MD5(value);
}

var getViaCep = function(cep) {
  return $.ajax({
    url: `https://viacep.com.br/ws/${cep}/json/`,
    type: 'GET'
  });
}

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

var getFormData = function(form) {
  var data = {};
  $(`${form}`).serializeArray().map(function(x){
    data[x.name] = x.value;
  });
  return data;
}

var getUrlParam = function(param) {
  return new URL(location.href).searchParams.get(param);
}

var validateForm = function() {
  var isValid = true;
  $("[required]").each(function() {
    if (! $(this).val().trim()) {
      $(this).addClass('has-error');
      isValid = false;
    } else {
      $(this).removeClass('has-error');
    }
  });
  return isValid;
}

var submitForm = function(e) {
  e.preventDefault();
  if (! validateForm()) return;
  var data = getFormData('form');
  save(data);
}

var askBeforeDelete = function(id, route) {
  swal({
    title: "Deseja realmente excluir?",
    icon: "warning",
    buttons: ["Cancelar", "Sim"],
    dangerMode: true,
  })
  .then(function(answer) {
    if (answer) {
      $.ajax({
        url: `${API_URL}${route}/${id}`,
        type: 'DELETE'
      }).done(function() {
        getAll();
        swalSuccess();
      }).fail(function(error) {
        swalError(error.responseJSON.data);
      });
    }
  });
}

var ajax = function(route, data = null, method = 'GET', url_param = null) {
  var param = url_param ? `/${url_param}` : '';
  return $.ajax({
    url: `${API_URL}${route}${param}`,
    type: method,
    data: data
  });
}

$(function() {
  $("#search").keyup(function() {
    var search = $(this).val().trim();
    var route = $(this).attr('source');
    ajax(route, {search: search}, 'GET').then(function(data) {
      populateTable(data.data);
    });
  });

  $("#cep").on('keyup', function () {
    cep = this.value.replace("-", "").trim();
    if (cep.length === 8) {
      getViaCep(cep).then(function (data) {
        if (!data.erro) {
          $("#cep").removeClass("has-error");
          $("#logradouro").val(data.logradouro);
          $("#complemento").val(data.complemento);
          $("#bairro").val(data.bairro);
          $("#localidade").val(data.localidade);
          $("#uf").val(data.uf);
        } else {
          $("#cep").addClass("has-error");
          $("#logradouro").val("");
          $("#complemento").val("");
          $("#bairro").val("");
          $("#localidade").val("");
          $("#uf").val("");
        }
      });
    }
  });
});