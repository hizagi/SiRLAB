<?php
    include "bd.php";

    $bd = new bd("basesirlab", "localhost", "root", "");
if (!empty($_POST)) {

  if (isset($_POST['email']) && isset($_POST['senha'])) {
        echo json_encode($bd->login($_POST['email'], $_POST['senha']));
    } elseif (isset($_POST['nome_lab']) && isset($_POST['codigo_lab'])) {
        echo json_encode($bd->adicionar_sala(new sala(null, $_POST['nome_lab'], $_POST['codigo_lab'])));
    } elseif (isset($_POST['deletar_sala'])) {
        echo json_encode($bd->remover_sala(new sala($_POST['deletar_sala'], null, null)));
    }elseif (isset($_POST['hora_inicial_lab']) && isset($_POST['hora_final_lab']) && isset($_POST['dia_lab'])) {
        echo json_encode($bd->adicionar_horario(new sala($_POST['id_sala'],null,null),$_POST));
    }elseif (isset($_POST['deletar_horario'])) {

        $resposta['status'] = "";
        foreach ($_POST['deletar_horario'] as $key => $horario_del) {
            $pre_resp = $bd->remover_horario(new sala($_POST['id'],null,null),$horario_del);
            if ($pre_resp['status'] == "OK") {
              $resposta['status'] = "OK";
            }else{
              $resposta['status'] =+ $pre_resp['status']."<br>";
            }
        }
        echo json_encode($resposta);
    }elseif (isset($_POST['reserva_sala'])) {
      echo json_encode($bd->getHorarios($_POST['reserva_sala'][0],'sala',$_POST['reserva_sala'][1],$_POST['reserva_sala'][2]));
    }elseif (isset($_POST['add_reserva'])) {
      session_start();
      echo json_encode( $bd->adicionar_reserva( new professor(  $_SESSION['id_user'],$_SESSION['name_user'],$_SESSION['email_user'],$_SESSION['matricula_user'],null ) ,$_POST['add_reserva']['horario'],$_POST['add_reserva']['data'] ) );
    }elseif (isset($_POST['listar_reservas'])) {
      echo json_encode( $bd->listar_reservas(new professor($_POST['listar_reservas'],null,null,null,null)));
    }elseif (isset($_POST['deletar_reserva'])) {
      session_start();
      echo json_encode( $bd->remover_reserva( $_POST['deletar_reserva'],new professor(  $_SESSION['id_user'],$_SESSION['name_user'],$_SESSION['email_user'],$_SESSION['matricula_user'],null ) ) );
    }elseif ( isset($_POST['sel_prof_res']) && isset($_POST['sel_hora_res']) ) {
      echo json_encode( $bd->remover_reserva($_POST['sel_hora_res'],new professor($_POST['sel_prof_res'],null,null,null,null)) );
    }

}else{
  $resposta['status'] = "Vazio";
  echo json_encode($resposta);
}
