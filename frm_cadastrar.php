<?php require_once 'header.php'?>

    <title>Cadastra-se</title>
</head>
<body>
<div class="container">
    <div class="form-signin">
        <form action="" method="POST">

            <center><img class="mb-4" src="images/riosoft.png" alt="" width="200"></center>

            <div class="form-floating">
                <input type="text" class="form-control" placeholder="Nome" name="nome" id="nome" required autofocus>
                <label for="Nome">*Nome</label>
            </div>

            <div class="form-floating">
                <input type="text" class="form-control" placeholder="Email" name="login" id="login" required>
                <label for="Login">*Email</label>
            </div>

            <div class="form-floating">
                <input type="password" class="form-control" name="senha" id="senha" placeholder="Senha" required>
                <label for="Senha">*Senha</label>
            </div>

            <div class="form-floating">
                <input type="password" class="form-control" name="senha" id="senha" placeholder="Confirmar Senha" required>
                <label for="confirmarSenha">*Confirmar Senha</label>
            </div>

            <div>
            <center><label for="Login">
                <a href="login.php">Já possuo cadastro!</a>
            </center></label>
            </div>

            <button class="w-100 btn btn-lg btn-dark mt-3" type="submit" name="btnCadastrar" id="btnCadastrar">CADASTRAR</button>


        </form>
    </div>
</div>

<?php require_once 'footer.php'?>