$(function(){

	$('#logo_sirlab_central').fadeIn({queue: false, duration: 'slow'});

	$('#logo_sirlab_central').animate({'margin-top':'-200px'}, 1000,function() {
			$('#form_login').fadeIn({queue: false, duration: 'slow'});
			// body...
			$('#form_login').animate({'margin-top':'-64px'}, 500);
	});


	$('#form_login').submit(function(event) {
		event.preventDefault();
		/* Act on the event */
		//alert($(this).serialize());
		$.ajax({
		  type: 'POST',
		  url: 'conexao.php',
		  data: $(this).serialize(),
		  dataType: 'json',
		  success: function(response){
		  	if (response.status=="ok") {
		  		window.location.replace("home.php");
		  	}else{
		  		alert("Usuário ou/e Senha incorretos");
		  	}
		  },
		  error: function(response,exception,x) {
		  	console.log(exception);
		  	console.log(x);
		  	console.log(response);
		  }
		});
	});
});
