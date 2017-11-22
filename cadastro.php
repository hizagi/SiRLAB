<?php
    session_start();
    require 'header.php';
    require "bd.php";
    $bd = new bd("basesirlab", "localhost", "root", "");
    if (!isset($_GET['codigo'])) {
      header("Location: login.php");
      die();
    }else {
      if (!$bd->checar_codigo($_GET['codigo'])) {
        header("Location: login.php");
        die();
      }
    }
?>
        <script type="text/javascript" src="js/cadastro.js"></script>
              <form  codigo=<?php echo $_GET['codigo']; ?> class="form_cadastro col-sm-8" method="post">
                <h2>Formulário de Cadastro</h2>
                <div class="form-group row">
                    <label for="nome_prof">Nome:</label>
                    <input type="text" class="form-control" name="nome_prof" value="" required>
                </div>
                <div class="form-group row">
                    <label for="senha_prof">Senha:</label>
                    <input type="password" pattern=".{8,}" class="form-control" name="senha_prof" value="" required>
                    <small id="passwordHelp" class="form-text text-muted">A senha deverá ter no minimo 8 digitos.</small>
                </div>
                <div class="form-group row">
                  <label for="mail_prof">Email:</label>
                  <input class="email_prof form-control" type="email" name="mail_prof" value="" required>
                </div>
                <div class="form-group row">
                  <label for="matricula_prof">Matricula:</label>
                  <input class="form-control matricula_prof" type="text" name="matricula_prof" value="" required>
                </div>
                <div class="row">
                  <button type="submit" class="btn btn-primary col-sm-3 center">Enviar</button>
                </div>
              </form>
        </main>
    </body>
</html>
