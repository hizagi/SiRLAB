$(function(){
  $('.horario_lab').mask('00:00-00:00');
  $('#add_horario').on('click', function(event) {
    event.stopPropagation();
    /* Act on the event */
      $("#pop-up-add-horario").fadeIn('slow');
  });

  $(document).on('click', function(event) {
    /* Act on the event */
    if ($('#pop-up-add-horario').css('display') != 'none') {
      $("#pop-up-add-horario").fadeOut('slow');
    }
  });

  $('#pop-up-add-horario').click(function(event) {
    event.stopPropagation();
  });

  $('#pop-up-add-horario form').submit(function(event) {
    event.preventDefault();
    array_hora = $(this).find('input').val().split('-');
    horario_lab = {};
    horario_lab.hora_inicial_lab = array_hora[0];
    horario_lab.hora_final_lab = array_hora[1];
    /* Act on the event */
    horario_lab.dia_lab = $('#myTab').children('.active').text();
    horario_lab.id_sala = $('h3').attr('id_sala');

    teste = JSON.parse(JSON.stringify(horario_lab));

    $.ajax({
      type: 'POST',
      url: 'conexao.php',
      data: teste,
      dataType:'json',
      success: function(response) {
        console.log(response);
        if (response.status == "OK") {
          $('#msg_cadastro_lab').append("<div class='alert alert-success'><strong>Adicionado!</strong>O horário foi adicionada com sucesso.</div>");
          $('#msg_cadastro_lab').slideDown('slow').delay(3000).slideUp('slow',function() {
            $('#msg_cadastro_lab').html(" ");
          });
          classe = "."+response.data.dia_lab.toLowerCase();
          $(classe).append("<li class='list-group-item item_horario' id_horario='"+response.data.id+"'>"+response.data.hora_inicial_lab+" - "+response.data.hora_final_lab+"</li>");

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


    $('.list-group').on('click','.item_horario',function(event) {
      $(this).toggleClass('active');
    });

    $("#remove_horario").click(function(event) {
      if (confirm("Tem certeza que deseja remover esse(s) horário(s)?")) {

        classe = "."+$('#myTab').children('.active').text().toLowerCase();

        deletados = $(classe).find('.active');
        delete_array = [];
        id_sala  = $('h3').attr('id_sala');
        $.each(deletados,function(index, el) {
            delete_array.push( $(el).attr('id_horario') );
        });

        $.ajax({
          url: 'conexao.php',
          type: 'POST',
          data: {deletar_horario: delete_array,id: id_sala},
          dataType:'json',
          success: function(response) {
            console.log(response);
            if (response.status == "OK") {

              $.each(deletados,function(index, el) {
                $(el).slideToggle('fast',function() {
                  $(this).remove();
                })
              });

            }else{
              alert(response.status);
            }
          },
          error: function(response, exception, x) {
            console.log(exception);
            console.log(x);
            console.log(response);
          }
        })

      }




      /*

      */
    });

    $('.select_reserva_professor').on('change', function(event) {
      event.preventDefault();
      id_prof = $(this).val();
      /* Act on the event */
      $.ajax({
        url: 'conexao.php',
        type: 'POST',
        dataType: 'json',
        data: {listar_reservas: id_prof},
        success: function (response) {
          console.log(response);
          if(response.status=='OK'){

            $.each(response.data,function(index, el) {
              console.log("aea");
              $('.select_reserva_horario').append('<option value='+el.id+'>'+el.horario_inicio.substring(0,5)+'-'+el.horario_fim.substring(0,5)+'  -  '+el.data+'</option>')
            });
          }
        },
        error: function (response, exception, x) {
          console.log(exception);
          console.log(x);
          console.log(response);
        }
      })

    });

    $('.reservas_professor_form').on('submit', function(event) {
      event.preventDefault();
      $.ajax({
        url: 'conexao.php',
        type: 'POST',
        dataType: 'json',
        data: $(this).serialize(),
        success: function (response) {
          console.log(response);
          if(response.status=='OK'){
            $('.select_reserva_horario').html("<option value='' disabled selected>Selecionar a reserva</option>");
            $('.select_reserva_professor').val("");
            alert("Reserva cancelada!");
          }
        },
        error: function (response, exception, x) {
          console.log(exception);
          console.log(x);
          console.log(response);
        }
      })

    });

});
