﻿<?php
     //mantendo uma sessão

     session_start();

     //recuperando as variaveis da sessão

     $system_control = $_SESSION["system_control"];
     $status = $_SESSION["status"];
	 $cod_log = $_SESSION["codigo"];

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
                    <title>Visualizar Todas</title>
               </head>
          <body>
			   <center><h1> Visualizar todas ferramentas</h1></center>
               <table border="1" align="center">
               <tr>
                    <td align="center"><font color="black">NOME</td>
					<td align="center"><font color="black">PART NUMBER</td>
					<td align="center"><font color="black">QUANTIDADE</td>
					<td align="center"><font color="black">DESCRIÇÃO</td>
					<td align="center"><font color="black">DEPARTAMENTO</td>
					<td align="center"><font color="black">IMAGEM</td>
					<td align="center"><font color="black">ATUALIZAR</td>
               </tr>
<?php
                    //Realizando consultas necessarioas

                    require("../../connect.php");
					
					$consulta_usuario = mysqli_query($link, "SELECT * FROM $table_usuarios WHERE codigo_login = '$cod_log'");
					$resultado_consulta_usuario = mysqli_fetch_array($consulta_usuario);
					$cod_dep = $resultado_consulta_usuario['codigo_departamento'];

                    $consultar_ferramentas = mysqli_query($link, "SELECT * FROM $table_ferramentas WHERE codigo_departamento = '$cod_dep'");
                    $quant_ferramentas = mysqli_num_rows($consultar_ferramentas);

                    for($i = 1;$i<=$quant_ferramentas;$i++)
                    {
                         $vetor_ferramentas = mysqli_fetch_array($consultar_ferramentas);
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
					<td align="center"><font color="black"><a href="atualizar_ferramentas_confirmacao.php?codigo_ferramenta=<?php print($vetor_ferramentas['codigo']);?>&codigo_departamento=<?php print($vetor_departamento['codigo']);?>">Clique Aqui</a></td>
               </tr>
<?php
                    }
?>
               </table><br>
               <center><a href="atualizar_ferramentas.php"><input type="button" name="botao" value="VOLTAR"></a></center>
<?php
     }
?>

