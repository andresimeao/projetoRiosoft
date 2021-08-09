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
<div class="container bg-dark text-light">
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand text-light" href="#">Riosoft</a>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active text-light" aria-current="page" href="#">Home</a>
                    </li>
                    <div>
                        <li class="nav-item">
                            <a class="nav-link text-light dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">Link</a>
                        </li>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        <li><a class="dropdown-item" href="#">Action</a></li>
                        <li><a class="dropdown-item" href="#">Another action</a></li>
                        <li><a class="dropdown-item" href="#">Something else here</a></li>
                    </ul>
                    </div>
                    <li class="nav-item">
                        <a class="nav-link text-light dropdown-toggle" href="#">Disabled</a>
                    </li>
                </ul>
                <form class="d-flex">
                    <button class="btn btn-outline-danger" type="submit">Sair</button>
                </form>
        </div>
        </div>
    </nav>
</div>
<!-- fim nav -->

<div class="container">

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