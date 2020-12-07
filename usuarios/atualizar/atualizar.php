<?php
//header("Content-type: text/html; charset=ISO-8895-1");
     //mantendo uma sessão

     session_start();

     //recuperando as variaveis da sessão

     $system_control = $_SESSION["system_control"];
     $status = $_SESSION["status"];

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
          <title>ATUALIZAR</title>
          <link rel="stylesheet" href="../css/bootstrap.css">
          <link rel="stylesheet" href="../fonts/ionicons.min.css">
          <link rel="stylesheet" href="../css/styles2.min.css">
     </head>
<body>
      <center><h1>ATUALIZAR</h1><center>
	<div class="menus">
    <div class="menus btn-group-vertical d-flex justify-content-center">
     <a href="atualizar_meus_dados.php" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">MEUS DADOS</a>
     <a href="atualizar_usuarios.php" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">USUÁRIOS</a>
     <a href="atualizar_ferramentas.php" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">FERRAMENTAS</a>
	 <a href="atualizar_imagem_ferramentas.php" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">IMAGEM DE FERRAMENTAS</a>
     <a href="../tela_usuario.php" class="btn btn-secondary btn-lg active" role="button" aria-pressed="true">VOLTAR</a></center></a>
	 </div>
	 </div>

</body>
</html>

<?php
     }
?>
