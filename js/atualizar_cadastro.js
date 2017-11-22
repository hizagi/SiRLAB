$(function() {

  $('.form_atualizar').submit(function(event) {
    event.preventDefault();
    valores = $(this).serialize()+"&atualizar_cadastro=true&id="+$(this).attr('id_usr');;
    $.ajax({
      url: 'conexao.php',
      type: 'POST',
      dataType: 'json',
      data: valores,
      success:function(response) {
        console.log(response);
        if (response.status=="OK") {

          alert("Dados Atualizados!");
          window.location.replace('home.php');
        }else {
          alert(response.status);
        }
      },
      error: function(response, exception, x) {
        console.log(exception);
        console.log(x);
        console.log(response);
      }
    })

  });

});
