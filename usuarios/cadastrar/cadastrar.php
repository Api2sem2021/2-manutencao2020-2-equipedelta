<?php
//header("Content-type: text/html; charset=ISO-8895-1");
     //mantendo uma sessão

     session_start();

     //recuperando as variaveis da sessão

     $system_control = $_SESSION["system_control"];
     $status = $_SESSION["status"];
     $codigo_login = $_SESSION["codigo"];

     //verificando se o usuário realizou o login

     if(!(($system_control == 1)&&($status == 2)))
     {
          //acesso inválido
?>
          <script>
               alert("Acesso Inválido");
               history.go(-1);
          </script>
<?php
     }
     else
     {
?>
<html>
     <head>
          <meta charset="utf-8">
          <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
          <title>CADASTRAR</title>
          <link rel="stylesheet" href="../css/bootstrap.css">
          <link rel="stylesheet" href="../fonts/ionicons.min.css">
          <link rel="stylesheet" href="../css/styles.min.css">
     </head>
<body>
      <center><h1>CADASTRAR</h1><center>
     <div class="menus">
	 <div class="menus btn-group-vertical d-flex justify-content-center">
     <a href="cadastrar_usuarios.php" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">USUÁRIOS</a>
     <a href="cadastrar_ferramentas.php" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">FERRAMENTAS</a>
     <a href="../tela_usuario.php" class="btn btn-secondary btn-lg active" role="button" aria-pressed="true">VOLTAR</a></center></a>
	 </div>
	 </div>

</body>
</html>

<?php
     }
?>
