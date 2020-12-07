<?php
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
                    <title>Excluir Usuários</title>
               </head>
          <body>

				<center><h1>Excluir Usuários</h1></center>
               <form name="f" method="get" action="excluir_usuarios_por_nome2.php">

               <table border="0" align="center">
               <tr>
                    <td><font color="black">Insira o Nome que deseja consultar: <input type="text" name="c_nome" size="10"><br><br>
					<center><input type="submit" name="botao" value="ENVIAR"> <input type="reset" name="limpar" value="LIMPAR"> <a href="excluir_usuarios.php"><input type="button" name="voltar" value="VOLTAR"></a></center></td>
               </tr>
               </table>
               </form>
<?php
     }
?>
