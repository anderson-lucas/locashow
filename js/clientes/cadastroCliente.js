$(function() {
  $("#btn-submit").click(function(e) {
    e.preventDefault();

    var data = getFormData('form_cliente');

    data.cpf_cnpj = data.cpf_cnpj.replace(/\D/g,'');

    $.ajax({
      url: API_URL + 'clientes',
      type: 'post',
      data: data
    }).done(function() {
      swalSuccess();
      $("#cpf_cnpj").removeClass("has-error");
      $(".alert").hide();
    }).fail(function() {
      $("#cpf_cnpj").addClass("has-error");
      $(".alert").show();
    });
  });

  function setMasks() {
    var options = {
      onKeyPress: function (cpf, ev, el, op) {
        var masks = ['000.000.000-000', '00.000.000/0000-00'];
        $('#cpf_cnpj').mask((cpf.length > 14) ? masks[1] : masks[0], op);
      }
    }
    $('#cpf_cnpj').length > 11 ? $('#cpf_cnpj').mask('00.000.000/0000-00', options) : $('#cpf_cnpj').mask('000.000.000-00#', options);

    $('#telefone').mask('(00) 00000-0000');
  }

  setMasks();
});