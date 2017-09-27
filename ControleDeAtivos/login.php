<?php

session_start();
if(isset($_SESSION['user']))
{
  header("location: /");
}
?>
<!DOCTYPE html>
<html>

<head>

  <meta charset="UTF-8">

  <title>Login - Controle de Ativos</title>

  <link rel="stylesheet" href="css/login.css" media="screen" type="text/css" />
   
</head>

<body>

  <div class="login-card">
      <h1><img src="/img/logo.png"/></h1>
      <br>
      <br>
      <div id="carregando" class="dcarregando">
        <img src="/img/carregando.gif" />
      </div>
 <form method="post" id="login" AUTOCOMPLETE='ON'>
    <input type="text" name="user" placeholder="Login de rede NEOBPO">
    <input type="password" name="pass" placeholder="Senha de rede">
    <input type="submit" id="logar" name="logar" class="login login-submit" value="Logar">
  </form>
  <!--?php include("controller/UsuarioController.php");?-->	

  <div class="login-help">
    <a href="mailto:odilon.silva@tivit.com.br">Odilon Silva - Adminstrador</a>
  </div>
    <!--a href="mailto:guilherme.tahan@tivit.com.br">Guilherme Chafy - Administrador</a>
    <a href="/documentos/Tutorial.docx">Download Tutorial</a>
  </div -->
</div>
    <script src='/js/jquery.min.js'></script>
    <script src='/js/jquery-ui.js'></script>
    <script src="/js/login.js"></script>
</body>

</html>