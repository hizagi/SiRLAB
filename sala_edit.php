<?php
    session_start();
    require "header.php";
    require "bd.php";
    $bd = new bd("basesirlab", "localhost", "root", "");
    $salas = $bd->listar_salas()['data'];
    foreach ($salas as $key => $sala) {
        if($sala->getId() == $_GET['id']){
          $sala_atual = $sala;
        }
    }

?>
<script type="text/javascript" src="js/sala_edit.js"></script>
      <h1 ><?php echo $sala_atual->getNome()." - ".$sala_atual->getCodigo(); ?></h1>
      <br>
      <h3 id_sala=<?php echo $sala_atual->getId(); ?>>Cadastro de horários livres</h3>

      <div id="pop-up-add-horario">
          <h2>Cadastrar Horário</h2>
          <div id="msg_cadastro_lab">

          </div>
          <form method="post">
              <div class="form-group">
                  <label for="horario_lab">Horário(apenas insira os números):</label>
                  <input type="text" class="form-control horario_lab" name="horario_lab" value="" placeholder="00:00-00:00" required>
              </div>
              <button type="submit" class="btn btn-primary">OK</button>
          </form>
      </div>

      <br>

      <div class="controle_horario">
        <img src="imagens/icones/add1.png" alt="add" id="add_horario">
        <br>
        <img src="imagens/icones/remove.png" alt="add" id="remove_horario">
      </div>

      <nav class="nav nav-tabs" id="myTab" role="tablist">
        <a class="nav-item nav-link active" id="nav-segunda-tab" data-toggle="tab" href="#nav-segunda" role="tab" aria-controls="nav-segunda" aria-selected="true">Segunda-feira</a>
        <a class="nav-item nav-link" id="nav-terca-tab" data-toggle="tab" href="#nav-terca" role="tab" aria-controls="nav-terca" aria-selected="false">Terça-feira</a>
        <a class="nav-item nav-link" id="nav-quarta-tab" data-toggle="tab" href="#nav-quarta" role="tab" aria-controls="nav-quarta" aria-selected="false">Quarta-feira</a>
        <a class="nav-item nav-link" id="nav-quinta-tab" data-toggle="tab" href="#nav-quinta" role="tab" aria-controls="nav-quinta" aria-selected="false">Quinta-feira</a>
        <a class="nav-item nav-link" id="nav-sexta-tab" data-toggle="tab" href="#nav-sexta" role="tab" aria-controls="nav-sexta" aria-selected="false">Sexta-feira</a>
        <a class="nav-item nav-link" id="nav-sabado-tab" data-toggle="tab" href="#nav-sabado" role="tab" aria-controls="nav-sabado" aria-selected="false">Sábado</a>
      </nav>
      <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade show active" id="nav-segunda" role="tabpanel" aria-labelledby="nav-segunda-tab">
          <ul class="list-group segunda-feira">
              <?php
                $horarios = $bd->listar_horarios($sala_atual->getId(),'Segunda-feira');
                foreach ($horarios as $key => $horario) {
               ?>


                 <li class="list-group-item item_horario" id_horario=<?php echo $horario['id']; ?>>
                   <?php echo substr($horario['horario_inicio'],0,5)." - ".substr($horario['horario_fim'],0,5); ?>
                 </li>

               <?php
                }
                ?>
          </ul>
        </div>
        <div class="tab-pane fade" id="nav-terca" role="tabpanel" aria-labelledby="nav-terca-tab">
          <ul class="list-group terça-feira">
            <?php
              $horarios = $bd->listar_horarios($sala_atual->getId(),'Terça-feira');
              foreach ($horarios as $key => $horario) {
             ?>


               <li class="list-group-item item_horario">
                 <?php echo substr($horario['horario_inicio'],0,5)." - ".substr($horario['horario_fim'],0,5); ?>
               </li>

             <?php
              }
              ?>
          </ul>
        </div>
        <div class="tab-pane fade" id="nav-quarta" role="tabpanel" aria-labelledby="nav-quarta-tab">
          <ul class="list-group quarta-feira">
            <?php
              $horarios = $bd->listar_horarios($sala_atual->getId(),'Quarta-feira');
              foreach ($horarios as $key => $horario) {
             ?>


               <li class="list-group-item item_horario">
                 <?php echo substr($horario['horario_inicio'],0,5)." - ".substr($horario['horario_fim'],0,5); ?>
               </li>

             <?php
              }
              ?>
          </ul>
        </div>
        <div class="tab-pane fade" id="nav-quinta" role="tabpanel" aria-labelledby="nav-quinta-tab">
          <ul class="list-group quinta-feira">
            <?php
              $horarios = $bd->listar_horarios($sala_atual->getId(),'Quinta-feira');
              foreach ($horarios as $key => $horario) {
             ?>


               <li class="list-group-item item_horario">
                 <?php echo substr($horario['horario_inicio'],0,5)." - ".substr($horario['horario_fim'],0,5); ?>
               </li>

             <?php
              }
              ?>
          </ul>
        </div>
        <div class="tab-pane fade" id="nav-sexta" role="tabpanel" aria-labelledby="nav-sexta-tab">
          <ul class="list-group sexta-feira">
            <?php
              $horarios = $bd->listar_horarios($sala_atual->getId(),'Sexta-feira');
              foreach ($horarios as $key => $horario) {
             ?>


               <li class="list-group-item item_horario">
                 <?php echo substr($horario['horario_inicio'],0,5)." - ".substr($horario['horario_fim'],0,5); ?>
               </li>

             <?php
              }
              ?>
          </ul>
        </div>
        <div class="tab-pane fade" id="nav-sabado" role="tabpanel" aria-labelledby="nav-sabado-tab">
          <ul class="list-group sabado">
            <?php
              $horarios = $bd->listar_horarios($sala_atual->getId(),'Sabado');
              foreach ($horarios as $key => $horario) {
             ?>


               <li class="list-group-item item_horario">
                 <?php echo substr($horario['horario_inicio'],0,5)." - ".substr($horario['horario_fim'],0,5); ?>
               </li>

             <?php
              }
              ?>
          </ul>
        </div>
      </div>
      <br>
      <br>
      <div class="reservas_professor_wrap">
        <h3>Gerenciar Reservas</h3>
        <form class="reservas_professor_form" action="index.html" method="post">
          <div class="form-group row">
            <select class="select_reserva_professor form-control col-sm-4" name="sel_prof_res" required>
              <option selected disabled value="">Selecione o professor</option>
              <?php
                  $reservas = $bd->listar_professores($sala_atual)['data'];
                  foreach ($reservas as $key => $reserva) {
                    echo "<option value=".$reserva['id_usuario'].">".$reserva['nome']."</option>";
                  }
              ?>
            </select>
          </div>
          <div class="form-group row">
            <select class="select_reserva_horario form-control col-sm-4" name="sel_hora_res" required>
              <option selected disabled value="">Selecione a reserva</option>

            </select>
          </div>
          <div class="row">
            <button type="submit" class="col-sm-4 btn btn-primary">Cancelar Reserva</button>

          </div>
        </form>
      </div>
    </main>
  </body>
</html>
