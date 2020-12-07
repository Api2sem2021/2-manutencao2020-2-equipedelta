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
		 $codigo_ferramenta = $_GET['codigo_ferramenta'];
		 $codigo_departamento = $_GET['codigo_departamento'];
		 
		 require("../../connect.php");
		 $consulta_ferramenta = mysqli_query($link, "SELECT * FROM $table_ferramentas WHERE codigo = '$codigo_ferramenta'");
		 $vetor_ferramenta = mysqli_fetch_array($consulta_ferramenta);
		 
		 $partnumber1 = substr($vetor_ferramenta['part_number'],0,3);
		 $partnumber2 = $vetor_ferramenta['numeral'];
		 
		 $consulta_departamento = mysqli_query($link, "SELECT * FROM $table_departamentos WHERE codigo = '$codigo_departamento'");
		 $vetor_departamento = mysqli_fetch_array($consulta_departamento);
?>
<html>
     <head>
          <meta charset="utf-8">
          <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
          <title>Atualizar Ferramenta</title>
          <link rel="stylesheet" href="../css/bootstrap.css">
          <link rel="stylesheet" href="../fonts/ionicons.min.css">
          <link rel="stylesheet" href="../css/style.min.css">
     </head>
<body>
      <center><h1>Atualizar Ferramenta</h1></center>
      <center>
     <form name="f" method="post" action="atualizar_imagem_ferramentas_confirmacao2.php" enctype="multipart/form-data">
				<input type="hidden" name="c_codigo_ferramenta" value="<?php print($vetor_ferramenta['codigo']); ?>">
				<input type="hidden" name="c_codigo_departamento" value="<?php print($vetor_departamento['codigo']); ?>">
				
	   IMAGEM: <input type="file" name="imagem"><br> **(Para atualização, é necessário carregar a imagem novamente)<br><br>

               <input type="submit" name="botao" value="ENVIAR"> <input type="reset" name="botao" value="LIMPAR"> <input type="button" name="botao" value="VOLTAR" onclick="history.go(-1);"></a><br><br>

               (*)CAMPOS OBRIGATÓRIOS
               </td>
          </tr>
          </table>

     </form>
</body>
</html>
<?php
     }
?>
