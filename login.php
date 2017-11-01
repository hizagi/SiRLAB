<?php 
	include "header.php";
?>
		<script type="text/javascript" src="js/login.js"></script>
		<div id="menu">
			<ul>
				<li><a href="">Home</a></li>
			</ul>
		</div>
		
		<div id="login">
			
			<img id="logo_sirlab_central" class="login_logo" src="imagens/sirlab_logo.png">
			<form method="post" id="form_login">
					<div class="row">					
							<div class="input-group col-12">
								<input type="text" class="form-control" name="email" placeholder="Email" required>
							</div>
					</div>
					<div class="row">						
							<div class="input-group col-12">
								<input type="password" class="form-control" name="senha" placeholder="Senha" required>
							</div>
					</div>
					<div class="row">		
							<div class="col-12">
								<button type="submit" class="btn btn-primary">Entrar</button>
							</div>
					</div>	
			</form>

		</div>
	</main>
</body>
</html>