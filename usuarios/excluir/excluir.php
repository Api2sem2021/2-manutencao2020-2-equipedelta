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
          <title>EXCLUIR</title>
     </head>
<body>
      <center><h1>EXCLUIR</h1><center>
      <font size="4">
     <center></center><br>
     <center><a href="excluir_usuarios.php">USUÁRIOS</a></center><br>
     <center><a href="excluir_ferramentas.php">FERRAMENTAS</a></center><br>
     <center><a href="../tela_usuario.php"><input type="button" name="botao" value="VOLTAR"></a></center></a>

</body>
</html>

<?php
     }
?>
