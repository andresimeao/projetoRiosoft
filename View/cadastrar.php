<?php require 'header.php';

session_start();
if (isset($_SESSION['mensagem']))
{
  echo $_SESSION['mensagem'];
  session_destroy();
}

?>

<div class="container">
    <h1 style="text-align: center;">Cadastro</h1>
<form action="../Model/Model_Cadastrar.php" method="post">
    
  <div class="mb-3">
    <label for="email1" class="form-label">Nome:</label>
    <input type="text" name="nome" class="form-control" id="nome" aria-describedby="nome" placeholder="Digite seu nome" autofocus required>
  </div>

  <div class="mb-3">
    <label for="email1" class="form-label">Email:</label>
    <input type="email" class="form-control" id="email" aria-describedby="email" placeholder="Digite seu e-mail" name="email" required>
  </div>

  <div class="mb-3">
    <label for="senha1" class="form-label">Senha</label>
    <input type="password" class="form-control" id="senha1" placeholder="Digite sua senha" name="senha1" required>
  </div>

  <div class="mb-3">
    <label for="senha2" class="form-label">Confirme sua senha</label>
    <input type="password" class="form-control" id="senha2" placeholder="Digite sua senha novamente" name="senha2" required>
  </div>

  <div class="mb-3 form-check">
    <input type="checkbox" class="form-check-input" id="entrar_diretamente" name="entrar_diretamente">
    <label class="form-check-label" for="lembre1">Entrar diretamente</label>
  </div>
 
  <button type="submit" class="btn btn-success" name="cadastrar">Cadastrar</button> <br>
</form>
</div>


<?php require 'footer.php'?>
    
