<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- todos arquivos css-->
    <link rel="stylesheet" href="resources/libs/bootstrap/css/bootstrap.min.css">

<title>Home</title>
</head>

<body class="bg-dark"> 

<div class="container">
    <ul class="nav nav-pills justify-content-end mt-3">

    <?php
	    if($_SESSION["t"]=="admin"){
    ?>
        <li class="nav-item dropdown btn bg-light" style="margin-right: 5px;">
            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Clientes</a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="frm_cliente.php">Cadastrar</a>
                    <a class="dropdown-item" href="lista_cliente.php">Listar</a>
                    <a class="dropdown-item" href="lista_cliente.php">Alterar</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="lista_cliente.php">Excluir</a>
                </div>
        </li>
    <?php
	}
    ?>

    <li class="nav-item dropdown btn btn-small bg-light">
        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Produtos</a>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="produto/frm_produto.php">Cadastrar</a>
                <a class="dropdown-item" href="produto/lista_produto.php">Listar</a>
                <a class="dropdown-item" href="produto/lista_produto.php">Alterar</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="produto/lista_produto.php">Excluir</a>
            </div>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="sair.php"><svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-box-arrow-right" viewBox="0 0 16 16">
        <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0v2z"/>
        <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z"/>
        </svg></a>
    </li>

    </ul>
</div>
<hr class="bg-light">
<!-- fim nav -->

<main class="container">

    <div class="alert alert-info alert-dismissible fade show text-center" role="alert">

        <?php

            session_start();

            echo "Bem vindo ". $_SESSION["n"] . " você está logado como " . $_SESSION["t"];
            echo "<br>";

        ?>

        <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close">

            <span aria-hidden="true">&times;</span>

        </button>

    </div>

</div>


<script>
    $('.alert').alert('close');
</script>

<?php require_once 'footer.php'; ?>