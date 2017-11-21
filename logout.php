<?php 
    session_start();
    require "conexao.php";
    echo $bd->logout();
    header('Location: login.php'); 
    die();
 ?>