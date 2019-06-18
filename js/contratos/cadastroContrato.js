var id = parseInt(base64dec(getUrlParam('id')));
var displaying = false;

function getCombos() {
  ajax('clientes').then(function (response) {
    clientes = response.data;
    ajax('imoveis').then(function (res) {
      imoveis = res.data;
      populateCombos(clientes, imoveis);
    });
  });
}

function save(data) {
  if (!validateDtVencimento()) return;
  data.valor = data.valor.replace('.', '');
  data.valor = data.valor.replace(',', '.');
  if (data.dt_vencimento) data.dt_vencimento = moment(data.dt_vencimento, 'DD/MM/YYYY').format('DD-MM-YYYY');
  ajax('contratos', data, 'POST').then(function() {
    swalSuccess();
    window.location.href = '/locashow/sistema.php?page=contratos';
  });
}

function getContrato() {
  displaying = true;
  $("#form_contrato :input").prop("disabled", true);
  ajax('contratos', {id: id}).then(function (response) {
    setTimeout(function() {
      populateForm(response.data[0]);
    }, 200);
  });
}

function setMasks() {
  $("#valor").mask("#.##0,00", {reverse: true});
  $("#dt_vencimento").val(moment().add('1', 'year').format('L'));
  $("#dt_vencimento").mask("00/00/0000", {placeholder: "__/__/____"});
}

function populateForm(data) {
  $("#cliente_id").val(data.cliente_id);
  $("#imovel_id").val(data.imovel_id);
  $("[name=tipo]").val([data.tipo]);
  if (data.tipo == 'L') {
    $("#dt_vencimento").val(data.dt_vencimento).trigger('input');
  } else {
    $("#form-group-vencimento").hide();
  }
  $("#valor").val(data.valor).trigger('input');
  $("[name=status]").val([data.status]);
}

function populateCombos(clientes, imoveis) {
  var row = '';
  clientes.map(function(cliente) {
    row += `<option value="${cliente.id}">${cliente.nome}</option>`;
  });
  $("#cliente_id").append(row);

  var row = '';
  imoveis.map(function(imovel) {
    row += `<option value="${imovel.id}">${imovel.codigo} - ${imovel.descricao}</option>`;
  });
  $("#imovel_id").append(row);
}

function validateDtVencimento() {
  if (!moment($("#dt_vencimento").val(), 'DD/MM/YYYY').isValid() ||
      !moment($("#dt_vencimento").val(), 'DD/MM/YYYY').isSameOrAfter(moment().add(1, 'M'))) {
    $("#dt_vencimento").addClass('has-error');
    return false;
  } else {
    $("#dt_vencimento").removeClass('has-error');
  }
  return true;
}

$("[name=tipo]").change(function() {
  if ($(this).val() == 'L') {
    $("#form-group-vencimento").show();
  } else {
    $("#form-group-vencimento").hide();
  }
});

$("#dt_vencimento").blur(function() {
  validateDtVencimento();
});

if (id) {
  getContrato();
}

setMasks();
getCombos();
