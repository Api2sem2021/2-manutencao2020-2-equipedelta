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
                    <title>Atualizar Ferramentas</title>
               </head>
          <body>

		  <center><h1>Atualizar Ferramentas</h1></center>	
          <table border="0" align="center">
          <form name="f" method="post" action="atualizar_ferramentas2.php">
          <tr>
               <td><font color="black"><input type="radio" name="c_opcao" value="visualizar_todas" checked>Visualizar Todas<br><input type="radio" name="c_opcao" value="por_partnumber">Por Part Number
               <br><input type="radio" name="c_opcao" value="por_nome">Por Nome<br><br><input type="submit" name="botao" value="ENVIAR"> <a href="atualizar.php"><input type="button" name="botao" value="VOLTAR"></a></td>
          </tr>
          </form>
          </table>
          </body>
          </html>
<?php
     }
?>
