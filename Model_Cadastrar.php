<?php
require_once "conexao.php";
session_start();

/**
 * Verifica se o email ja está cadastrado
 *
 * @param string $email
 * @return void
 */
function verificaEmail($email)
{
    //criando conexão  
    $conn= Conexao::getConexao();

    $stmt=$conn->prepare("select login from usuario where login='$email'");
    $stmt->execute();
    $resultado=$stmt->fetchAll(PDO::FETCH_ASSOC);

    if(!empty($resultado))
    {
        $_SESSION['mensagem']="usuário ja cadastrado no sistema $email";
        header("Location: cadastrar.php");
    }
}

/**
 * Verifica se as senhas são iguais 
 *
 * @param string $senha1
 * @param string $senha2
 * @return void
 */
function verificaSenha($senha1,$senha2)
{
    if($senha1!=$senha2)
    {
        $_SESSION['mensagem']="Senhas não batem";
        header("Location: cadastrar.php");
    }
    
}

/**
 * Realiza o cadastro do usuário
 *
 * @param string ...$post
 * @return void
 */
function cadastrarUsuario(string ...$post)
{
    $email=$post[0];
    $senha=$post[1];
    $nome=$post[2];
    
    //criando conexão  
    $conn= Conexao::getConexao();

    //preparo a query de inserção
    $stmt=$conn->prepare('insert into usuario(login,senha,nome) values(:log,:sen,:nom)');

    //Passo os parametros
    $stmt->bindParam(':log',$email);
    $stmt->bindParam(":sen",$senha);
    $stmt->bindParam(":nom",$nome);

    //executa a query
    $stmt->execute();

    //redirecionando para a tela de login
    header('Location: login.php');
    
}

//verifica se o POST cadastrar foi enviado
if(isset($_POST['cadastrar']))
{
    //recebendo campos do POST
    $email= $_POST['email'];
    $senha1=$_POST['senha1'];
    $senha2=$_POST['senha2'];
    $nome=$_POST['nome'];
    
    //verificação de email existente
    verificaEmail($email);
 
    //verificação de senhas
    verificaSenha($senha1,$senha2);

    //Cadastrar o Usuário
    cadastrarUsuario($email,$senha2,$nome);
}