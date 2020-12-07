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
		 $partnumber = $_GET['c_partnumber'];
		 
		 if(empty($partnumber))
		 {
?>
			<script>
				alert("Campo Part Number vazio!!!");
				history.go(-1);
			</script>
<?php
		 }
		 else
		 {
		 
		 require("../../connect.php");
		 
		 $codigo_log = $_SESSION['codigo'];
		 $consultar_usuario = mysqli_query($link, "SELECT * FROM $table_usuarios WHERE codigo_login = '$codigo_log'");
		 $resultado_consultar_usuario = mysqli_fetch_array($consultar_usuario);
		 $codigo_dep = $resultado_consultar_usuario['codigo_departamento'];
		 
		 $consulta_partnumber = "SELECT * FROM $table_ferramentas WHERE part_number = '$partnumber' AND codigo_departamento = '$codigo_dep'";
		 $resultado_consulta_partnumber = mysqli_query($link, $consulta_partnumber);
		 $quant_partnumber = mysqli_num_rows($resultado_consulta_partnumber);
		 
		 if($quant_partnumber == 0)
		 {
?>
			<script>
				alert("Part Number não encontrado em nosso banco de dados!!!");
				history.go(-1);
			</script>
<?php
		 }
		 else
		 {
?>
          <html>
               <head>
                    <title>Visualizar Ferramenta</title>
               </head>
          <body>
			   <center><h1> Visualizar Ferramenta</h1></center>
               <table border="1" align="center">
               <tr>
                    <td align="center"><font color="black">NOME</td>
					<td align="center"><font color="black">PART NUMBER</td>
					<td align="center"><font color="black">QUANTIDADE</td>
					<td align="center"><font color="black">DESCRIÇÃO</td>
					<td align="center"><font color="black">DEPARTAMENTO</td>
					<td align="center"><font color="black">IMAGEM</td>
					<td align="center"><font color="black">EXCLUIR</td>
               </tr>
<?php
                    //Realizando consultas necessarioas

                         $vetor_ferramentas = mysqli_fetch_array($resultado_consulta_partnumber);
                         $codigo_departamento = $vetor_ferramentas['codigo_departamento'];

                         $consultar_departamento = mysqli_query($link, "SELECT * FROM $table_departamentos WHERE codigo = '$codigo_departamento'");
                         $vetor_departamento = mysqli_fetch_array($consultar_departamento);
                         $nome_departamento = $vetor_departamento['nome'];
						 $imagem = $vetor_ferramentas['imagem'];
?>
               <tr>
                    <td align="center"><font color="black"><?php print($vetor_ferramentas['nome']);?></td>
					<td align="center"><font color="black"><?php print($vetor_ferramentas['part_number']);?></td>
					<td align="center"><font color="black"><?php print($vetor_ferramentas['quantidade']);?></td>
					<td align="center"><font color="black"><?php print($vetor_ferramentas['descricao']);?></td>
					<td align="center"><font color="black"><?php print($nome_departamento);?></td>
					<td align="center"><font color="black"><img src="../../imagens/<?php print($imagem);?>" width="150" height="150"></td>
					<td align="center"><font color="black"><a href="excluir_ferramentas_confirmacao.php?codigo_ferramenta=<?php print($vetor_ferramentas['codigo']);?>&codigo_departamento=<?php print($vetor_departamento['codigo']);?>">Clique Aqui</a></td>
               </tr>
               </table><br>
               <center><a href="excluir_ferramentas_por_partnumber.php"><input type="button" name="botao" value="VOLTAR"></a></center>
<?php
		 }
     }
	} 
?>

