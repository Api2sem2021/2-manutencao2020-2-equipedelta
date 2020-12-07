<?php
//header("Content-type: text/html; charset=ISO-8895-1");
     //mantendo uma sessão

     session_start();

     //recuperando as variaveis da sessão

     $system_control = $_SESSION["system_control"];
     $status = $_SESSION["status"];
	 $codigo_usuario = $_GET["codigo_usuario"];
	 $codigo_login = $_GET["codigo_login"];

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
		require("../../connect.php");

     $consulta_usuario = mysqli_query($link, "SELECT * FROM $table_usuarios WHERE codigo = $codigo_usuario");
     $quantos_usuario = mysqli_num_rows($consulta_usuario);
     $vetor_usuario = mysqli_fetch_array($consulta_usuario);

     $consulta_login = mysqli_query($link, "SELECT * FROM $table_logins WHERE codigo = $codigo_login");
     $quantos_login = mysqli_num_rows($consulta_login);
     $vetor_login = mysqli_fetch_array($consulta_login);
?>
<html>
      <head><title>Excluir Usuário</title></head>
<body>
      <form name="f" action="excluir_usuarios_confirmacao2.php" method="get">

       <center><h1>EXCLUIR USUÁRIO</h1></center>
      
	  <input type="hidden" name="c_codigo_login" value="<?php print($codigo_login); ?>">
      <input type="hidden" name="c_codigo_usuario" value="<?php print($codigo_usuario);?>">
	  <table align="center">
	  <tr>
				<td>Tem certeza que deseja excluir o(a) usuário(a) <?php print($vetor_usuario['nome']);?> <?php print($vetor_usuario['sobrenome']);?> do sistema?</td>     
	  </tr>
	 </table><br>
      <center><input type="submit" name="botao" value="ENVIAR"> <input type="button" name="botao" value="VOLTAR" onclick="history.go(-1)"></a></center> <br></form>
      
</body>


</html>

<?php
     }
?>