<?php require 'header.php'?>

<div class="container">
    <h1 style="text-align: center;">Login</h1>

<form action="logar.php" method="POST">
  <div class="mb-3">
    <label for="email1" class="form-label">Email:</label>
    <input type="email" name="email" class="form-control" id="email" aria-describedby="email" placeholder="Digite seu e-mail" autofocus>
  </div>

  <div class="mb-3">
    <label for="senha1" class="form-label">Senha</label>
    <input type="password" name="senha" class="form-control" id="senha" placeholder="Digite sua senha">
  </div>

  <div class="mb-3 form-check">
    <input type="checkbox" class="form-check-input" id="lembre">
    <label class="form-check-label" name="lembrar" for="lembre1">Lembre de mim</label>

  </div>
 
  <button type="submit" name="logar" class="btn btn-primary">Login</button> <br>
  <a href="cadastrar.php">Não possui cadastro clique aqui !</a>
</form>
</div>


<?php require 'footer.php'?>
    
