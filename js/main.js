const API_URL = '/api.php/';
moment.locale('pt-br');

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
    }
  });
  return isValid;
}

var submitForm = function(e) {
  e.preventDefault();
  if (!validateForm()) return;
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

var validaCnpj = function(cnpj) {
  if(cnpj == '') return false;

  if (cnpj.length != 14) return false;

  // Elimina CNPJs invalidos conhecidos
  if (cnpj == "00000000000000" || 
    cnpj == "11111111111111" || 
    cnpj == "22222222222222" || 
    cnpj == "33333333333333" || 
    cnpj == "44444444444444" || 
    cnpj == "55555555555555" || 
    cnpj == "66666666666666" || 
    cnpj == "77777777777777" || 
    cnpj == "88888888888888" || 
    cnpj == "99999999999999") return false;
       
  // Valida DVs
  tamanho = cnpj.length - 2
  numeros = cnpj.substring(0,tamanho);
  digitos = cnpj.substring(tamanho);
  soma = 0;
  pos = tamanho - 7;
  for (i = tamanho; i >= 1; i--) {
    soma += numeros.charAt(tamanho - i) * pos--;
    if (pos < 2) pos = 9;
  }
  resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
  if (resultado != digitos.charAt(0)) return false;
       
  tamanho = tamanho + 1;
  numeros = cnpj.substring(0,tamanho);
  soma = 0;
  pos = tamanho - 7;
  for (i = tamanho; i >= 1; i--) {
    soma += numeros.charAt(tamanho - i) * pos--;
    if (pos < 2) pos = 9;
  }
  resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
  if (resultado != digitos.charAt(1)) return false;
         
  return true;
}

var validaCpf = function(cpf){
  var numeros, digitos, soma, i, resultado, digitos_iguais;
  digitos_iguais = 1;
  if (cpf.length < 11) return false;
  for (i = 0; i < cpf.length - 1; i++) {
    if (cpf.charAt(i) != cpf.charAt(i + 1)) {
      digitos_iguais = 0;
      break;
    }
  }

  if (!digitos_iguais) {
    numeros = cpf.substring(0,9);
    digitos = cpf.substring(9);
    soma = 0;
    for (i = 10; i > 1; i--) {
      soma += numeros.charAt(10 - i) * i;
    }
    resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
    if (resultado != digitos.charAt(0)) return false;
    numeros = cpf.substring(0,10);
    soma = 0;
    for (i = 11; i > 1; i--) soma += numeros.charAt(11 - i) * i;
    resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
    if (resultado != digitos.charAt(1)) return false;
    return true;
  } else {
    return false;
  }
}

var validaCpfCnpj = function(cpf_cnpj) {
  cpf_cnpj = cpf_cnpj.replace(/[^\d]+/g,'');

  if (cpf_cnpj.length > 11) {
    return validaCnpj(cpf_cnpj);
  } else {
    return validaCpf(cpf_cnpj);
  }
}