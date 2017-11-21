<?php
    session_start();
    require "header.php";
    require "bd.php";
    $bd = new bd("basesirlab", "localhost", "root", "");
?>
    <link rel="stylesheet" href="css/jquery-ui.min.css">
    <script type="text/javascript" src="js/reserva.js"></script>
    <script type="text/javascript" src="js/jquery-ui.min.js"></script>
    <script type="text/javascript" src="js/ui.datepicker-pt-BR.js"></script>
    <h1>Reservar Laboratório</h1>
    <br>
    <div class="container">
       <div class="row">

          <form id="form_reserva" style="padding: 0px;" class="col-sm-6" method="post">
            <div class="form-group row">
              <select class="form-control col-sm-7" id="select_lab" required>
                <option value="" disabled selected>Selecionar Laboratório</option>
                <?php
                $salas = $bd->listar_salas()['data'];
                foreach($salas as $sala){ ?>
                  <option value=<?php echo $sala->getId(); ?>> <?php echo $sala->getNome(); ?> </option>
                <?php  }?>
              </select>
            </div>
            <div class="form-group row">
              <input id="data_reserva" class="datepicker form-control col-sm-4" data-date-format="mm/dd/yyyy" placeholder="Data da reserva dd/mm/aaaa" disabled required>
            </div>
            <div class="form-group row">
              <select id="select_horario" class="form-control col-sm-4" required="required">
                <option value="" disabled selected>Selecionar Horario</option>

              </select>
            </div>
            <div class="row">
              <button type="submit" class="col-sm-4 btn btn-primary">Reservar</button>

            </div>
          </form>
          <div class="col-sm-6 table-responsive">

            <table class="table tabela_reserva">
              <thead>
                <tr>
                  <th>Laboratório</th>
                  <th>Horário</th>
                  <th>Data</th>
                  <th></th>
                </tr>

              </thead>
              <tbody>
                <?php
                  $horarios_prof = $bd->listar_reservas(new professor(  $_SESSION['id_user'],$_SESSION['name_user'],$_SESSION['email_user'],$_SESSION['matricula_user'],null ) );
                  //var_dump($horarios_prof);
                  foreach($horarios_prof['data'] as $horario){ ?>

                   <tr>
                     <td><?php echo $horario['nome']."-".$horario['codigo'] ?></td>
                     <td><?php echo substr($horario['horario_inicio'],0,5)."-".substr($horario['horario_fim'],0,5); ?></td>
                     <td><?php   $data = date( "d-m-Y", strtotime($horario['data']) );
                                 echo $data;
                      ?></td>
                      <td> <img class="cancelar_reserva" id_reserva=<?php echo $horario['id'] ?> src="imagens/icones/delete.png" height="30" alt=""> </td>
                   </tr>

                <?php } ?>
              </tbody>
            </table>
          </div>

        </div>

    </div>



    </main>
  </body>
</html>
