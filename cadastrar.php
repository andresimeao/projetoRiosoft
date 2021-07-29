<?php require 'header.php'?>

<div class="container">
    <h1 style="text-align: center;">Cadastro</h1>
<form action="index.php" method="post">
    
  <div class="mb-3">
    <label for="email1" class="form-label">Nome:</label>
    <input type="email" name="email" class="form-control" id="nome" aria-describedby="nome" placeholder="Digite seu nome" autofocus>
  </div>

  <div class="mb-3">
    <label for="email1" class="form-label">Email:</label>
    <input type="email" class="form-control" id="email" aria-describedby="email" placeholder="Digite seu e-mail" autofocus>
  </div>

  <div class="mb-3">
    <label for="senha1" class="form-label">Senha</label>
    <input type="password" class="form-control" id="senha1" placeholder="Digite sua senha">
  </div>

  <div class="mb-3">
    <label for="senha2" class="form-label">Confirme sua senha</label>
    <input type="password" class="form-control" id="senha2" placeholder="Digite sua senha novamente">
  </div>

  <div class="mb-3 form-check">
    <input type="checkbox" class="form-check-input" id="Entrar">
    <label class="form-check-label" for="lembre1">Entrar diretamente</label>
  </div>
 
  <button type="submit" class="btn btn-success" name="cadastrar">Cadastrar</button> <br>
</form>
</div>


<?php require 'footer.php'?>
    
