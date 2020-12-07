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
          $codigo_ferramenta = $_GET["codigo_ferramenta"];
          $codigo_usuario = $_GET["codigo_usuario"];

          require("../../connect.php");
          $consulta_ferramentas = mysqli_query($link, "SELECT * FROM $table_ferramentas WHERE codigo = '$codigo_ferramenta'")
          or die("Problema em encontrar as ferramentas");
          
          $vetor_ferramentas = mysqli_fetch_array($consulta_ferramentas);
          $nome_ferramenta = $vetor_ferramentas["nome"];
          $quantidade_ferramenta = $vetor_ferramentas["quantidade"];
?>
          <html>
               <head>
                    <title>Cadastrar Retirada de ferramenta</title>
                    <script>
          function quantidade()
                    {
                         var retorno;

                         retorno = isNaN(f.c_quantidade.value);

                         if(retorno==1)
                         {
                              alert("Dígito Inválido");
                              f.c_quantidade.value = "";
                              f.c_quantidade.focus();
                         }
                    }
          </script>
               </head>
          <body>

          <center><h1>CADASTRAR RETIRADA DE FERRAMENTAS</h2></center>
          <table border="0" align="center">
          <form name="f" method="post" action="cadastrar_retirada_ferramenta2.php">
          <tr>
               <td><font color="black"><center>(*)Quantas unidades da ferramenta <?php print($nome_ferramenta);?> deseja solicitar?: <input type="text" name="c_quantidade" onKeyUp="quantidade();"><br><br><input type="submit" name="botao" value="RETIRAR"> <input type="reset" name="botao" value="LIMPAR"> <input type="button" name="botao" value="VOLTAR" onclick="history.go(-1);"></a><br><br>

               <font color="white"><center>(*)CAMPOS OBRIGATÓRIOS
               </td>
          </tr>
          </form>
          </table>
          
          </body>
          </html>
<?php

     }
?>
