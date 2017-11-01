<?php 
	session_start();
?>
<?php include 'header.php'; ?>
		
		<div id="menu">
			<?php 
				if($_SESSION['tipo_user']==0){
			 ?>
			<ul>
				<li><a href="home.php">Home</a></li>
				<li><a href="gerencia_lab.php">Gerencia de Laboratórios</a></li>
				<li><a href="cadastro_email.php">Cadastrar Professor</a></li>
			</ul>
			<?php 
				}else{
					header("Location: home.php");
					die();
				}
			 ?>
		</div>
			
			<div id="form_email_cadastro">
			<br>
			 	Preencha o campo com o email do professor a ser convidado.
			 	<br>
			 	<br>
				<form method="post">
						<div class="row">					
								<div class="input-group col-8">
									<input type="text" class="form-control" name="email" placeholder="Email" required>
								</div>
						</div>
						<br>
						<div class="row">		
									<div class="col-12">
										<button type="submit" class="btn btn-primary">Enviar</button>
									</div>
						</div>
				</form>

			</div>


		</main>
	</body>
</html>