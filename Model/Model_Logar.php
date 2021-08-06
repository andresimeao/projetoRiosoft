<?php
require_once 'conexao.php';

session_start();

if(isset($_POST['logar']))
{
    //Recebendo variaeis do POST
    $email= $_POST['email'];
    $senha=$_POST['senha'];
    $lembrar=isset($_POST['lembrar']) ? true :false;

    //conexão
    $conn=Conexao::getConexao();
    $stmt=$conn->prepare("select * from usuario where login='$email' and senha='$senha'");
    $stmt->execute();
    $resultado=$stmt->fetchAll(PDO::FETCH_ASSOC);

    if(!empty($resultado))
    {
        $resultado['continuar']=$lembrar;
        $_SESSION['usuario']=$resultado;
        header('location: ../index.php');
    
    }
    else
    {
        echo "usuário e senha invalidos";
    }
}
