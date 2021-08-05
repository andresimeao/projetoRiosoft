<?php require_once 'header.php'?>

    <title>Login - Riosoft</title>
</head>
<body>
<div class="container">
    <div class="form-signin">
        <form action="" method="POST">

            <center><img class="mb-4" src="images/riosoft.png" alt="" width="200"></center>

            <div class="form-floating">
                <input type="email" class="form-control" name="login" id="login" placeholder="Email">
                <label for="login">*Email</label>
            </div>

            <div class="form-floating">
                <input type="password" class="form-control mt-1" name="senha" id="senha" placeholder="Senha">
                <label for="senha">*Senha</label>
            </div>

            <div class="text-center">
            <label for="Cadastro">
                <a href="frm_cadastrar.php">Não tenho conta!</a>
            </label>
            </div>

            <div name="divCheck" class="checkbox mb-3 text-center">
            <label for="CheckBox">
                <input type="checkbox">Lembrar-me!</input>
            </label>
            </div>

            <button class="w-100 btn btn-lg btn-dark" type="submit" name="btnEntrar" id="btnEntrar">CONECTAR</button>


        </form>

        <table>
        <th><img src="images/logotipo_riosoft.png" alt="" width="150"></th>
        <th><p>Copyright © 2021 | Cia Brasileira de Software e Serviços LTDA.</p>
        <p>Todos os direitos reservados. http://www.riosoft.com.br</p>
        <p>Compilação: 03/05/2021 12:38:30 - Build: 275 (MIX) (Riosoft)</p></th>
        </table>

    </div>
</div>

<?php require_once 'footer.php'?>