<?php
    session_start();
    require 'header.php';
    require "bd.php";
    $bd = new bd("basesirlab", "localhost", "root", "");
    $professores = $bd->listar_professores(null);
    $professor_atual = array();
    foreach ($professores['data'] as $key => $professor) {
        if ($professor['id']==$_SESSION['id_user']) {
          $professor_atual = $professor;
        }
    }

?>
        <script type="text/javascript" src="js/atualizar_cadastro.js"></script>
              <form id_usr=<?php echo $professor_atual['id']; ?> class="form_atualizar col-sm-8" method="post">
                <h2>Atualizar Cadastro</h2>
                <div class="form-group row">
                    <label for="nome_prof">Nome:</label>
                    <input type="text" class="form-control" name="nome_prof" value=<?php echo $professor_atual['nome']; ?> >
                </div>
                <div class="form-group row">
                    <label for="senha_prof">Senha:</label>
                    <input type="password" pattern=".{8,}" class="form-control" name="senha_prof" value="" >
                    <small id="passwordHelp" class="form-text text-muted">A senha deverá ter no minimo 8 digitos.</small>
                </div>
                <div class="form-group row">
                  <label for="mail_prof">Email:</label>
                  <input class="email_prof form-control" type="email" name="mail_prof" value=<?php echo $professor_atual['email']; ?> >
                </div>
                <div class="form-group row">
                  <label for="matricula_prof">Matricula:</label>
                  <input class="form-control matricula_prof" type="text" name="matricula_prof" value=<?php echo $professor_atual['matricula']; ?> >
                </div>
                <div class="row">
                  <button type="submit" class="btn btn-primary col-sm-3 center">Atualizar</button>
                </div>
              </form>
        </main>
    </body>
</html>
