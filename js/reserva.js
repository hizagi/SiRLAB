$(function(){

  $('.datepicker').datepicker({
    dateFormat: 'dd-mm-yy',
    minDate: 0,
    onSelect: function(dateText) {
        $('#select_horario').html("<option value='' disabled selected>Selecionar Horario</option>");
        var dia = $( this ).datepicker( "getDate" );
        var dia_da_semana = dia.getUTCDay();
        var dia  = dia.toISOString();
        console.log(dia);
        switch (dia_da_semana) {
          case 1:
              dia_da_semana = 'Segunda-feira';
            break;
          case 2:
              dia_da_semana = 'Terça-feira';

            break;
          case 3:
              dia_da_semana = 'Quarta-feira';

            break;
          case 4:
              dia_da_semana = 'Quinta-feira';

            break;
          case 5:
                dia_da_semana = 'Sexta-feira';

            break;
          case 6:
                dia_da_semana = 'Sabado';

            break;
          default:
              alert('Data invalida');
              $( this ).val("");
              return false;
        }
        id = $('#select_lab').val();
        valores = [];
        valores.push(id);
        valores.push(dia_da_semana);
        valores.push(dia);
        $.ajax({
          url: 'conexao.php',
          type: 'POST',
          dataType: 'json',
          data: {reserva_sala: valores,},
          success: function(response){
            $.each(response.data,function(index, el) {
              $('#select_horario').append('<option value='+el.id+'>'+el.horario_inicio.substring(0,5)+'-'+el.horario_fim.substring(0,5)+'</option>');
            });
          },
          error: function(response, exception, x) {
            console.log(exception);
            console.log(x);
            console.log(response);
          }
        });
     }
});



  $('#select_lab').change(function(event) {
    $('#select_horario').html("<option value='' disabled selected>Selecionar Horario</option>");
    $(".datepicker").val("");
    if(this.value != ""){
      $(".datepicker").prop('disabled', false);
    }else {
      $(".datepicker").prop('disabled', true);
    }


  });


  $('#form_reserva').submit(function(event) {
    event.preventDefault();
    valores = {};
    valores.lab = $("#select_lab").val();
    valores.horario = $("#select_horario").val();
    valores.data = $("#data_reserva").val();
    console.log(valores);
    $.ajax({
      url: 'conexao.php',
      type: 'POST',
      dataType: 'json',
      data: {add_reserva: valores},
      success: function(response){
        console.log(response);
        $(".tabela_reserva tbody").append('<tr> <td>'+response.data[0].nome+'-'+response.data[0].codigo+'</td> <td>'+response.data[0].horario_inicio.substring(0,5)+'-'+response.data[0].horario_fim.substring(0,5)+'</td> <td>'+response.data[0].data+'</td> <td><img class="cancelar_reserva" id_reserva='+response.data[0].id+' src="imagens/icones/delete.png" height="30" alt=""></td></tr>')
        $('#select_horario').html("<option value='' disabled selected>Selecionar Horario</option>");
        $(".datepicker").val("");
      },
      error: function(response, exception, x) {
        console.log(exception);
        console.log(x);
        console.log(response);
      }
    });

  });

  $('.tabela_reserva tbody').on('click','.cancelar_reserva',function(event) {
    if(confirm("Tem certeza que deseja cancelar a reserva?")){

        alvo = $(this);
        $.ajax({
          url: 'conexao.php',
          type: 'POST',
          dataType: 'json',
          data: {deletar_reserva: alvo.attr('id_reserva')},
          success: function(response){
            console.log(response);
            if (response.status=="OK") {
              alvo.parent().parent().fadeOut('slow',function () {
                $(this).remove();
              });
            }
          },
          error: function(response, exception, x) {
            console.log(exception);
            console.log(x);
            console.log(response);
          }
        })
      }

    });



});
