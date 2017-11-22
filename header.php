<!DOCTYPE>
<html>
<head>
    <meta charset="utf-8">

	<title>SiRLAB</title>
  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/estilo.css">
	<script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>

	<script type="text/javascript" src="js/tether.min.js"></script>
	<script type="text/javascript" src="js/popper.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
  <script type="text/javascript" src="js/jquery.mask.js"></script>
	<script type="text/javascript" src="js/menu.js"></script>
</head>
<body>
		<nav class="navbar" id="menu_nav">
            <a class="navbar-brand" href="#">
      					    <img id="img_menu" class="d-inline-block align-top" src="imagens/icones/menu_maior.png" width="50px" height="50px">
            </a>

            <div class="">
      					   	<img class="mr-auto" id="uesb_menu" src="imagens/uesb.png" height="70px">

      					   	<img class="mr-auto" id="sair" src="imagens/icones/sair_maior.png" width="70px" height="70px">
           </div>


		</nav>
	<main class="container">
	<div id="menu">
			<?php
            $arquivo_atual = basename($_SERVER["REQUEST_URI"]);
   if (isset($_SESSION['tipo_user'])) {
       if($_SESSION['tipo_user']==0) {
        ?>
      <ul>
       <li><a href="home.php">Home</a></li>
       <li><a href="gerencia_lab.php">Gerencia de Laboratórios</a></li>
       <li><a href="cadastro_email.php">Cadastrar Professor</a></li>
      </ul>
        <?php
} else if ($_SESSION['tipo_user']==1) {

                ?>
                       <ul>
                <li><a href="home.php">Home</a></li>
                <li><a href="atualizar_cadastro.php">Atualizar Cadastro</a></li>
                <li><a href="reserva.php">Reservas</a></li>
                       </ul>
                <?php
        }else{
            if ($arquivo_atual != "login.php") {
                header("Location: login.php");
                die();
            }
        }
} else {
        if ($arquivo_atual != "login.php" && strpos($arquivo_atual, 'cadastro.php') === false) {
            header("Location: login.php");
            die();
        }
    }
        ?>
        </div>
