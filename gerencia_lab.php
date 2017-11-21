<?php
    session_start();
    require "header.php";
    require "bd.php";
    $bd = new bd("basesirlab", "localhost", "root", "");
?>
        <script type="text/javascript" src="js/gerencia_lab.js"></script>
        <img src="imagens/icones/add1.png" alt="add" id="add_lab">
        <?php
            $salas = $bd->listar_salas()['data'];
            echo "<ul id=lista_lab>";
        foreach ($salas as $sala) {
            echo "<li id_sala=".$sala->getId()."><a href=sala_edit.php?id=".$sala->getId()." >".$sala->getNome()." - "."Nº ".$sala->getCodigo()."</a> <a> <img class='icon_delete' src='imagens/icones/delete.png'> </a></li>";
        }
            echo "</ul>";
        ?>

        <div id="pop-up">
            <h2>Cadastrar Laboratório</h2>
            <div id="msg_cadastro_lab">

            </div>
            <form method="post">
                <div class="form-group">
                    <label for="nome_lab">Nome:</label>
                    <input type="text" class="form-control" name="nome_lab" value="" placeholder="Nome do Laboratório" required>
                </div>
                <div class="form-group">
                    <label for="codigo_lab">Código:</label>
                    <input type="text" class="form-control" name="codigo_lab" value="" placeholder="Código do Laboratório" required>
                </div>
                <button type="submit" class="btn btn-primary">OK</button>
            </form>
        </div>
        </main>
    </body>
</html>
