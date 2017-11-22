$(function(){
  function isEmail(email) {
    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return regex.test(email);
  }

  $('.matricula_prof').mask('0#');

  $('.form_cadastro').submit(function(event) {
    event.preventDefault();
    valores = $(this).serialize()+"&cadastro_professor=true&codigo="+$(this).attr('codigo');
    $.ajax({
      url: 'conexao.php',
      type: 'POST',
      dataType: 'json',
      data: valores,
      success:function(response) {
        if (response.status=="OK") {

          alert("Cadastro Concluido!");
          window.location.replace('logout.php');
        }else {
          alert(response.status);
        }
      },
      error: function(response, exception, x) {
        console.log(exception);
        console.log(x);
        alert(response);
      }
    })

  });
});
