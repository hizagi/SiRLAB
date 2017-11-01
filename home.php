<?php 
	session_start();
?>
<?php include 'header.php'; ?>
		<script type="text/javascript" src="js/home.js"></script>
		<div id="menu">
			<?php
			if (isset($_SESSION['tipo_user'])) {
						if($_SESSION['tipo_user']==0){
					 ?>
					<ul>
						<li><a href="home.php">Home</a></li>
						<li><a href="gerencia_lab.php">Gerencia de Laboratórios</a></li>
						<li><a href="cadastro_email.php">Cadastrar Professor</a></li>
					</ul>
					<?php 
						}else if($_SESSION['tipo_user']==1){
					 ?>
					<ul>
						<li><a href="home.php">Home</a></li>
						<li><a href="atuaizar.php">Atualizar Cadastro</a></li>
						<li><a href="reserva.php">Reserva Laboratório</a></li>
					</ul>
					<?php 
						}else{
							header("Location: login.php");
							die();
						}
					}else{
						header("Location: login.php");
							die();
					}
					 ?>
		</div>
		<img id="logo_sirlab_central" class="home-logo" src="imagens/sirlab_logo.png">	
		</main>
	</body>
</html>