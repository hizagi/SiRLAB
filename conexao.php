<?php
	include_once("bd.php");
	include_once("sala.php");
	include_once("professor.php");

	$bd = new bd("basesirlab", "localhost", "root", "");

	if (!empty($_POST)) {
		
		if (isset($_POST['email']) && isset($_POST['senha'])) {
			
			echo json_encode( $bd->login( $_POST['email'], $_POST['senha'] ) );
		}

	}


?>