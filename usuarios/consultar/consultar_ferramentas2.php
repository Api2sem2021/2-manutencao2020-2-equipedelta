﻿<?php
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
          //Recebendo Variaveis

          $opcao = $_POST["c_opcao"];
               //Verificando qual opcao selecionada para redirecionar para area correta

               if($opcao == "visualizar_todas")
               {
?>
                    <script language="JavaScript">
                         document.location.href="consultar_ferramentas_por_todas.php";
                    </script>
<?php
               }
               else if($opcao == "por_partnumber")
               {
?>
                    <script language="JavaScript">
                         document.location.href="consultar_ferramentas_por_partnumber.php";
                    </script>
<?php
               }
			   else if($opcao == "por_departamento")
               {
?>
                    <script language="JavaScript">
                         document.location.href="consultar_ferramentas_por_departamento.php";
                    </script>
<?php
               }
               else
               {
?>
                    <script language="JavaScript">
                         document.location.href="consultar_ferramentas_por_nome.php";
                    </script>
<?php
               }
          }
?>
