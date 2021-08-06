<?php 
require_once ('View/header.php');

session_start();
if(!isset($_SESSION['usuario']))
{
    header("Location: View/login.php");
}
var_dump($_SESSION);

    echo "<br>";
    echo "Bem vindo :".$_SESSION['usuario'][0]['nome'];
    echo "<br>";
    echo "Email :".$_SESSION['usuario'][0]['login'];
    echo "<br>";

 require_once ('View/footer.php');?>
    
