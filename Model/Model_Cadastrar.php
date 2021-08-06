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
        $_SESSION['mensagem']='<br>
        <div class="container">
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Holy guacamole!</strong> You should check in on some of those fields below.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        </div>'; 
    
        header("Location: ../View/cadastrar.php");
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
 * Undocumented function
 *
 * @param string $email
 * @param string $senha
 * @param string $nome
 * @return void
 */
function cadastrarUsuario($email,$senha,$nome)
{   
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
    if($_SESSION['entrar_diretamente'])
    {
        header("Location: index.php");
        die('entrou aqui');
    }
    header("Location: login.php");
    
}

//verifica se o POST cadastrar foi enviado
if(isset($_POST['cadastrar']))
{
    $email= $_POST['email'];
    $senha1=$_POST['senha1'];
    $senha2=$_POST['senha2'];
    $nome=$_POST['nome'];

    if(isset($_POST['entrar_diretamente']))
    {
        $_SESSION['entrar_diretamente']=true;
        echo"entrar direto";
    }
    else
    {
        $_SESSION['entrar_diretamente']=false;
        echo"não entrar direto";
    }

    //verificação de email existente
    verificaEmail($email);
 
    //verificação de senhas
    verificaSenha($senha1,$senha2);

    //Cadastrar o Usuário
    cadastrarUsuario($email,$senha2,$nome);
}

