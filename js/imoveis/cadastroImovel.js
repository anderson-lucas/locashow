$(function() {
  //set masks
  $("#cep").mask("99999-999");

  //listen cep field
  $("#cep").on('keyup', function (event) {

    cep = this.value.replace("-", "").trim();

    if (cep.length === 8) {
      getViaCep(cep).then(function(data) {
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
  //   //   data: data
  //   // });

  //   //window.location = 'sistema.php?page=clientes';
  // });

  // console.log('opa');
});