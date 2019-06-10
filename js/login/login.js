$(function() {
	$("#btn-submit").click(function(e) {
	  e.preventDefault();
	  var data = {};
	  
	  $("#form_login").serializeArray().map(function(x){
	    data[x.name] = x.value;
	  });

	  if (data.login.trim() != '' && data.password.trim() != '') {
		  $.ajax({
		    url: API_URL + 'authenticate',
		    type: 'POST',
		    data: data
		  }).done(function(result) {
		  	$("#btn-submit").html(`<div class="fa-1x"><i class="fas fa-spinner fa-spin"></i></div>`);
		  	setTimeout(function() { window.location.href = 'sistema.php?page=home'; }, 1500);
		  }).fail(function(result) {
		  	$("input").addClass('has-error');
		  	$("#invalid-login").show();
		  });
	  } else {
	  	if (! data.login.trim()) {
	  		$("#small_login").show();
	  		$("#login").addClass('has-error');
	  	}

	  	if (! data.password.trim()) {
	  		$("#small_password").show();
	  		$("#password").addClass('has-error');
	  	}
	  }
	});

	$("#login").keydown(function() {
		$("#small_login").hide();
	  $("#login").removeClass('has-error');
	});

	$("#password").keydown(function() {
		$("#small_password").hide();
	  $("#password").removeClass('has-error');
	});
});