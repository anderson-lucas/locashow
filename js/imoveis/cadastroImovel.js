$(function() {
  //set masks
  $("#cep").mask("99999-999");

  //listen cep field
  $("#cep").on('keyup', function (event) {

    cep = this.value.replace("-", "").trim();

    if (cep.length === 8) {
      getViaCep(cep).then(function(data) {
        console.log(data);
        if (!data.erro) {
          $("#cep").removeClass("has-error");
          $("#logradouro").attr('value', data.logradouro);
          $("#complemento").attr('value', data.complemento);
          $("#bairro").attr('value', data.bairro);
          $("#localidade").attr('value', data.localidade);
          $("#uf").attr('value', data.uf);
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

  // $("#btn-submit").click(function(e) {
  //   e.preventDefault();
  //   var data = {};
  //   $("#form_imovel").serializeArray().map(function(x){
  //     data[x.name] = x.value;
  //   });

  //   console.log(data);

  //   // $.ajax({
  //   //   url: API_URL + 'clientes',
  //   //   type: 'post',
  //   //   dataType: 'application/json',
  //   //   data: data
  //   // });

  //   //window.location = 'sistema.php?page=clientes';
  // });

  // console.log('opa');
});