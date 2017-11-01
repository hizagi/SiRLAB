<?php
	include("bd.php");
	include("professor.php");
	include("sala.php");
	
	//$professor = new professor("", "Lucas Amaral", "maiara@gmail.com", "000", 'arielsoarescosta');
	
	$sala  = new sala( '11', 'Laboratório EAD', '10');
	$bd = new bd("basesirlab", "localhost", "root", "");
	
	
	echo json_encode( $bd->login( 'lucasamaral@gmail.com', 'teste' ) );
	
	$professor = new professor($_SESSION['id_user'], $_SESSION['name_user'], $_SESSION['email_user'], $_SESSION['matricula_user'], '');
	
	echo json_encode( $professor->getNome() );
	
	echo json_encode( $bd->logout( ) );
	
	
	//echo json_encode( $bd->adicionar_reserva( $professor, '6' ));
	
	//echo json_encode( $bd->remover_horario( $sala, '15:00-16:00' ));
	
	
	//echo json_encode( $bd->atualizar_horario( $sala, '16:00-17:00', '16:30-17:00' ));
	//echo json_encode( $bd->adicionar_horario( $sala, '16:00-17:00' ));
	
	//echo json_encode( $bd->adicionar_sala( $sala ));
	
	//echo json_encode( $professor->getHorarios('1', 'tipo') );
	
	//echo json_encode( $bd->adicionar_professor( $professor) );
	//echo json_encode( $bd->adicionar_professor( $professor ) );
?>