﻿<?php
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
                    <title>Atualizar Ferramentas</title>
               </head>
          <body>

          <center><h1>Atualizar por Partnumber</h2></center>
          <table border="0" align="center">
          <form name="f" method="get" action="atualizar_ferramentas_por_partnumber2.php">
          <tr>
               <td><font color="black"><center>(*)PART NUMBER: <input type="text" name="c_partnumber"><br><br><input type="submit" name="botao" value="ENVIAR"> <input type="reset" name="botao" value="LIMPAR"> <a href="atualizar_ferramentas.php"><input type="button" name="botao" value="VOLTAR"></a><br><br>

               <font color="black"><center>(*)CAMPOS OBRIGATÓRIOS
               </td>
          </tr>
          </form>
          </table>
          
          </body>
          </html>
<?php

     }
?>
