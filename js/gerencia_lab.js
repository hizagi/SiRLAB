$(function(){
        $('#add_lab').on('click', function(event) {
          event.stopPropagation();
          /* Act on the event */
            $("#pop-up").fadeIn('slow');
        });

        $(document).on('click', function(event) {
          /* Act on the event */
          if ($('#pop-up').css('display') != 'none') {
            $("#pop-up").fadeOut('slow');
          }
        });

        $('#pop-up').click(function(event) {
          event.stopPropagation();
        });

        $('#pop-up form').submit(function(event) {
          event.preventDefault();
          /* Act on the event */
          //alert($(this).serialize());
          $.ajax({
            type: 'POST',
            url: 'conexao.php',
            data: $(this).serialize(),
            dataType: 'json',
            success: function(response) {
              console.log(response.data);
              if (response.status == "OK") {
                $('#msg_cadastro_lab').append("<div class='alert alert-success'><strong>Adicionada!</strong> A sala \""+response.data.nome+"\" foi adicionada com sucesso.</div>");
                $('#msg_cadastro_lab').slideDown('slow').delay(3000).slideUp('slow',function() {
                  $('#msg_cadastro_lab').html(" ");
                });
                $('#lista_lab').append("<li id_sala="+response.data.id+"><a href=sala_edit.php?id="+response.data.id+" >"+response.data.nome+" - Nº "+response.data.codigo+"</a> <a> <img class='icon_delete' src='imagens/icones/delete.png'> </a></li>");
              }else{
                $('#msg_cadastro_lab').append("<div class='alert alert-danger'><strong>Falhou!</strong>"+response.status+".</div>");
                $('#msg_cadastro_lab').fadeIn('slow').delay(3000).fadeOut('slow',function() {
                  $('#msg_cadastro_lab').html(" ");
                });
              }
            },
            error: function(response, exception, x) {
              console.log(exception);
              console.log(x);
              console.log(response);
            }
          });
        });

        $('#lista_lab').on('click','.icon_delete',function(event) {
          /* Act on the event */
          id_sala = $(this).parent().parent().attr('id_sala');
          console.log(id_sala);
          if (confirm('Tem certeza que deseja que deletar essa sala?')) {

            $.ajax({
              url: 'conexao.php',
              type: 'POST',
              dataType: 'json',
              data: {deletar_sala: id_sala},
              success:function (response) {
                if (response.status=="OK") {
                  $('li[id_sala*='+id_sala+']').slideToggle('slow',function() {
                      $('li[id_sala*='+id_sala+']').remove();
                  })
                }
              },
              error:function (response, exception, x) {
                console.log(exception);
                console.log(x);
                console.log(response);
              }
            })



          }
        });
});
