var changePassword = false;

function getUsuario() {
  ajax('usuarios', {id: id}).then(function (response) {
    populateForm(response.data[0]);
  });
}

function save(data) {
  if (!changePassword) {
    data = {id: id, nome: data.nome, email: data.email, self_edit: true};
    ajax('usuarios', data, 'POST').then(function() {
      swalSuccess();
      $("#usuario_logado").html(data.nome.toUpperCase());
      $("#email").removeClass("has-error");
    }).fail(function() {
      swalError('E-mail informado já cadastrado no sistema!');
      $("#email").addClass("has-error");
    });
  } else {
    if (! validateChangePassowrd()) return;
    data = {id: id, senha_atual: data.senha_atual, senha_nova: data.senha_nova};
    ajax('usuario-change-password', data, 'POST').then(function() {
      swalSuccess();
    }).fail(function(error) {
      swalError(error.responseJSON.data);
      $("#senha_atual").addClass("has-error");
    });
  }
}

function populateForm(data) {
  $("#nome").val(data.nome);
  $("#email").val(data.email);
}

function openTab(tab) {
  changePassword = !changePassword;
  $(".tablinks").removeClass('active');
  $(".div_tab").hide();
  $(`#${tab}`).addClass('active');
  $(`#tab_${tab}`).show();

  if (changePassword) {
    $("#senha_atual").val('');
    $("#senha_nova").val('');
  }
}

function validateChangePassowrd() {
  var senha_atual = $("#senha_atual");
  var senha_nova = $("#senha_nova");

  if (!senha_atual.val().trim() || !senha_nova.val().trim()) {
    if (!senha_atual.val().trim()) senha_atual.addClass('has-error');
    if (!senha_nova.val().trim()) senha_nova.addClass('has-error');
    return false;
  }

  senha_atual.removeClass('has-error');
  senha_nova.removeClass('has-error');
  return true;
}

if (id) {
  getUsuario();
}