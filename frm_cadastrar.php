<?php require_once 'header.php'?>

    <title>Cadastra-se</title>
</head>
<body>
<div class="container">
    <div class="form-signin">
        <form action="" method="POST">

            <center><img class="mb-4" src="images/riosoft.png" alt="" width="200"></center>

            <div class="form-floating">
                <input type="text" class="form-control mt-1" name="nome" id="nome" placeholder="Nome" required autofocus>
                <label for="Nome">*Nome</label>
            </div>

            <div class="form-floating">
                <input type="email" class="form-control mt-1" name="login" id="login" placeholder="Email" required>
                <label for="Login">*Email</label>
            </div>

            <div class="form-floating">
                <input type="password" class="form-control mt-1" name="senha" id="senha" placeholder="Senha" required>
                <label for="Senha">*Senha</label>
            </div>

            <div class="form-floating">
                <input type="password" class="form-control" name="senha" id="senha" placeholder="Confirmar Senha" required>
                <label for="confirmarSenha">*Confirmar Senha</label>
            </div>

            <div>
            <center><label for="Login" class="text-center">
                <a href="index.php">Já possuo cadastro!</a>
            </center></label>
            </div>

            <button class="w-100 btn btn-lg btn-dark mt-3" type="submit" name="btnCadastrar" id="btnCadastrar">CADASTRAR</button>


        </form>

        <table>
        <th><img src="images/logotipo_riosoft.png" alt="" width="150"></th>
        <th class="font-footer"><p>Copyright © 2021 | Cia Brasileira de Software e Serviços LTDA.</p>
        <p>Todos os direitos reservados. http://www.riosoft.com.br</p>
        <p>Compilação: 03/05/2021 12:38:30 - Build: 275 (MIX) (Riosoft)</p></th>
        </table>

    </div>
</div>

<?php require_once 'footer.php'?>