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
		 
		 $consulta_departamento = mysqli_query($link, "SELECT * FROM $table_departamentos WHERE codigo = '$codigo_departamento'");
		 $vetor_departamento = mysqli_fetch_array($consulta_departamento);
?>
<html>
     <head>
          <title>Atualizar Ferramentas</title>
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
      <center><h1>Atualizar Ferramenta</h1></center>
      <center>
     <form name="f" method="post" action="atualizar_ferramentas_confirmacao2.php" enctype="multipart/form-data">
				<input type="hidden" name="c_codigo_ferramenta" value="<?php print($vetor_ferramenta['codigo']); ?>">
				<input type="hidden" name="c_codigo_departamento" value="<?php print($vetor_departamento['codigo']); ?>">
               </select><br>
               (*)NOME: <input type="text" name="c_nome" value="<?php print($vetor_ferramenta['nome']);?>"><br>
               (*)PART NUMBER: <input type="text" name="c_partnumber" value="<?php print($vetor_ferramenta['part_number']);?>"><br>
               (*)QUANTIDADE: <input type="text" name="c_quantidade" onKeyUp="quantidade();" value="<?php print($vetor_ferramenta['quantidade']);?>"><br>
               (*)DEPARTAMENTO: <select name="c_departamento">
								<option value="<?php print($vetor_departamento['codigo']);?>"><?php print($vetor_departamento['nome']);?></option>
       </select><br><br>
       (*)DESCRIÇÃO(100 caractéres MAX): <br><textarea rows="5" cols="50" style="background-color: #ffffff" wrap="soft" name="c_descricao" maxlength="100"><?php print($vetor_ferramenta['descricao']);?></textarea><br><br>
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
