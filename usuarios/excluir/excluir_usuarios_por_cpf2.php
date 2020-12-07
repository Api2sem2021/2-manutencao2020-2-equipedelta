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
     function mask($val, $mask)
{
 $maskared = '';
 $k = 0;
 for($i = 0; $i<=strlen($mask)-1; $i++)
 {
 if($mask[$i] == '#')
 {
 if(isset($val[$k]))
 $maskared .= $val[$k++];
 }
 else
 {
 if(isset($mask[$i]))
 $maskared .= $mask[$i];
 }
 }
 return $maskared;
}
          $cpf1 = $_GET['c_cpf1'];
          $cpf2 = $_GET['c_cpf2'];
          $cpf3 = $_GET['c_cpf3'];
          $cpf4 = $_GET['c_cpf4'];
          
          if(empty($cpf1))
          {
?>
               <script language="JavaScript">
                    alert("Campo CPF Incorreto!!!");
                    document.location.href="excluir_usuarios_por_cpf.php";
               </script>
<?php
          }
          else if(empty($cpf2))
          {
?>
               <script language="JavaScript">
                    alert("Campo CPF Incorreto");
                    document.location.href="excluir_usuarios_por_cpf.php";
               </script>
<?php
          }
          else if(empty($cpf3))
          {
?>
               <script language="JavaScript">
                    alert("Campo CPF Incorreto");
                    document.location.href="excluir_usuarios_por_cpf.php";
               </script>
<?php
          }
          else if(empty($cpf4))
          {
?>
               <script language="JavaScript">
                    alert("Campo CPF Incorreto");
                    document.location.href="excluir_usuarios_por_cpf.php";
               </script>
<?php
          }
          else
          {
               $cpf = $cpf1.$cpf2.$cpf3.$cpf4;
               
               //Realizando consultas necessarioas

                    include("../../connect.php");

                    $codigo_log = $_SESSION['codigo'];
					$consultar_usuario = mysqli_query($link, "SELECT * FROM $table_usuarios WHERE codigo_login = '$codigo_log'");
					$resultado_consultar_usuario = mysqli_fetch_array($consultar_usuario);
					$codigo_dep = $resultado_consultar_usuario['codigo_departamento'];
					
					$consultar_usuarios = mysqli_query($link, "SELECT * FROM $table_usuarios WHERE cpf = '$cpf' AND codigo_departamento = '$codigo_dep'");
                    $quant_usuarios = mysqli_num_rows($consultar_usuarios);
                     if($quant_usuarios == 0)
                     {
?>
                          <script language="JavaScript">
                               alert("CPF não encontrado!!!");
                               history.go(-1);
                          </script>
<?php
                     }
                     else
                     {

          
?>
          <html>
               <head>
                    <title>Visualizar Usuários</title>
               </head>
          <body>

				<center><h1> Visualizar usuário por CPF</h1></center>
               <table border="1" align="center">
               <tr>
                    <td align="center"><font color="black">NICKNAME</td>
					<td align="center"><font color="black">DEPARTAMENTO</td>
					<td align="center"><font color="black">NOME</td>
					<td align="center"><font color="black">SOBRENOME</td>
					<td align="center"><font color="black">DATA DE NASCIMENTO</td>
					<td align="center"><font color="black">SEXO</td>
					<td align="center"><font color="black">TELEFONE</td>
					<td align="center"><font color="black">CELULAR</td>
					<td align="center"><font color="black">EMAIL</td>
					<td align="center"><font color="black">CPF</td>
					<td align="center"><font color="black">ENDEREÇO</td>
					<td align="center"><font color="black">CEP</td>
					<td align="center"><font color="black">CIDADE</td>
					<td align="center"><font color="black">ESTADO</td>
					<td align="center"><font color="black">EXCLUIR</td>
               </tr>
<?php
                    for($i = 1;$i<=$quant_usuarios;$i++)
                    {
                         $vetor_usuarios = mysqli_fetch_array($consultar_usuarios);
                         $codigo_login = $vetor_usuarios['codigo_login'];
						 $codigo_departamento = $vetor_usuarios['codigo_departamento'];

                         $consultar_nickname = mysqli_query($link, "SELECT * FROM $table_logins WHERE codigo = '$codigo_login'");
                         $vetor_logins = mysqli_fetch_array($consultar_nickname);
                         $cpf = $vetor_usuarios['cpf'];
						 
						 $consultar_departamento = mysqli_query($link, "SELECT * FROM $table_departamentos WHERE codigo = '$codigo_departamento'");
						 $vetor_departamentos = mysqli_fetch_array($consultar_departamento);
						 $nome_departamento = $vetor_departamentos['nome'];
?>
               <tr>
                    <td align="center"><font color="black"><?php print($vetor_logins['nickname']);?></td>
					<td align="center"><font color="black"><?php print($nome_departamento);?></td>
					<td align="center"><font color="black"><?php print($vetor_usuarios['nome']);?></td>
					<td align="center"><font color="black"><?php print($vetor_usuarios['sobrenome']);?></td>
					<td align="center"><font color="black"><?php print($vetor_usuarios['nascimento']);?></td>
					<td align="center"><font color="black"><?php print($vetor_usuarios['sexo']);?></td>
					<td align="center"><font color="black"><?php echo mask($vetor_usuarios['telefone'],'(##)#### - ####');?></td>
					<td align="center"><font color="black"><?php echo mask($vetor_usuarios['celular'],'(##)##### - ####');?></td>
					<td align="center"><font color="black"><?php print($vetor_logins['email']);?></td>
					<td align="center"><font color="black"><?php echo mask($cpf,'###.###.###-##');?></td>
					<td align="center"><font color="black"><?php print($vetor_usuarios['rua']); ?>, <?php print($vetor_usuarios['numero']); ?>, <?php print($vetor_usuarios['bairro']);?></td>
					<td align="center"><font color="black"><?php echo mask($vetor_usuarios['cep'],'#####-###'); ?></td>
                    <td align="center"><font color="black"><?php print($vetor_usuarios['cidade']); ?></td>
					<td align="center"><font color="black"><?php print($vetor_usuarios['estado']); ?></td>
					<td align="center"><font color="black"><a href="excluir_usuarios_confirmacao.php?codigo_login=<?php print($vetor_logins['codigo']);?>&codigo_usuario=<?php print($vetor_usuarios['codigo']);?>">Clique Aqui</a></td>
               </tr>
<?php
                    }
?>
               </table><br>
               <center><a href="excluir_usuarios_por_cpf.php"><input type="button" name="botao" value="VOLTAR"></a></center>
<?php
		}
     }
}
?>

