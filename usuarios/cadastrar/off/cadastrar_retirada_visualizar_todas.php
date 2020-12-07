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
               require("../../connect.php");
               $consulta_usuario = mysqli_query($link, "SELECT * FROM $table_usuarios WHERE codigo_login = '$codigo_login'")
               or die("Problema ao recuperar o login do usuário!!!");
               $resultado_consulta_usuario = mysqli_fetch_array($consulta_usuario);
               $codigo_departamento = $resultado_consulta_usuario["codigo_departamento"];
               $codigo_usuario = $resultado_consulta_usuario["codigo"];

               $consulta_departamento = mysqli_query($link, "SELECT * FROM $table_departamentos WHERE codigo = '$codigo_departamento'")
               or die("Problema em recuperar o nome do departamento");
               $resultado_consulta_departamento = mysqli_fetch_array($consulta_departamento);
               $nome_departamento = $resultado_consulta_departamento["nome"];
               
               $consulta_ferramentas = mysqli_query($link, "SELECT * FROM $table_ferramentas WHERE codigo_departamento = '$codigo_departamento'")
               or die("Problema em encontrar as ferramentas");
               $quant_consulta_ferramentas = mysqli_num_rows($consulta_ferramentas);
          
          if($quant_consulta_ferramentas == 0)
          {
?>
               <script language="JavaScript">
                    alert("Nenhuma FERRAMENTA encontrada!!!");
                    history.go(-1);
               </script>
<?php
          }
          else
          {
?>
               <html>
                    <head>
                         <title>VISUALIZAR FERRAMENTAS</title>
                    </head>
               <body>

                    
                    <table border="1" align="center">
                    <tr>
                         <td align="center"><font color="black">Nome</td>
                         <td align="center"><font color="black">Quantidade</td>
                         <td align="center"><font color="black">Part Number</td>
                         <td align="center"><font color="black">Departamento</td>
                         <td align="center"><font color="black">Descrição</td>
                         <td align="center"><font color="black">Retirada</td>
                    </tr>
<?php
                    for($i=1;$i<=$quant_consulta_ferramentas;$i++)
                    {
                         $vetor_ferramentas = mysqli_fetch_array($consulta_ferramentas);
                         $vetor_ferramentas_codigo_departamento = $vetor_ferramentas["codigo_departamento"];
                         $codigo_ferramenta = $vetor_ferramentas["codigo"];

                         $consulta_departamento2 = mysqli_query($link, "SELECT * FROM $table_departamentos WHERE codigo = '$vetor_ferramentas_codigo_departamento'")
                         or die("Problema em recuperar o nome do departamento");
                         $resultado_consulta_departamento2 = mysqli_fetch_array($consulta_departamento2);
                         $nome_departamento2 = $resultado_consulta_departamento2["nome"];

?>
                         <tr>
                              <td align="center"><font color="black"><?php print($vetor_ferramentas['nome']);?></td>
                              <td align="center"><?php print($vetor_ferramentas['quantidade']);?></td>
                              <td align="center"><?php print($vetor_ferramentas['part_number']);?></td>
                              <td align="center"><?php print($nome_departamento2);?></td>
                              <td align="center"><?php print($vetor_ferramentas['descricao']);?></td>
                              <td align="center"><a href="cadastrar_retirada_ferramenta.php?codigo_ferramenta=<?php print($codigo_ferramenta);?>&codigo_usuario=<?php print($codigo_usuario);?>">Clique aqui</a></td>
                         </tr>
<?php
                    }
?>
                    </table> <br>
                    <center><a href="cadastrar_retirada.php"><input type="button" name="botao" value="VOLTAR"></a></center>
                    </body>
                    </html>
<?php

          }
     }
?>
