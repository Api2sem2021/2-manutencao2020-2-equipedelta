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
?>
<html>
     <head>
          <title>CADASTRAR</title>
     </head>
<body>
<?php
          require("../../connect.php");
          $consulta_usuario = mysqli_query($link, "SELECT * FROM $table_usuarios WHERE codigo_login = '$codigo_login'")
          or die("Problema ao recuperar o login do usuário!!!");
          $resultado_consulta_usuario = mysqli_fetch_array($consulta_usuario);
          $codigo_departamento = $resultado_consulta_usuario["codigo_departamento"];
          
          $consulta_departamento = mysqli_query($link, "SELECT * FROM $table_departamentos WHERE codigo = '$codigo_departamento'")
          or die("Problema em recuperar o nome do departamento");
          $resultado_consulta_departamento = mysqli_fetch_array($consulta_departamento);
          $nome_departamento = $resultado_consulta_departamento["nome"];
?>
      <center><h1>CADASTRAR</h1><center>
      <font size="4">
     <center></center><br>
     <center><a href="cadastrar_retirada_visualizar_todas.php">VISUALIZAR TODAS FERRAMENTAS DO DEPARTAMENTO <?php print($nome_departamento);?></a></center><br>
     <center><a href="cadastrar_retirada_por_nome.php">VISUALIZAR FERRAMENTAS DO DEPARTAMENTO <?php print($nome_departamento);?> POR NOME</a></center><br>
     <center><a href="cadastrar_retirada_por_partnumber.php">VISUALIZAR FERRAMENTAS DO DEPARTAMENTO <?php print($nome_departamento);?> POR PART NUMBER</a></center><br>
     <center><a href="cadastrar.php"><input type="button" name="botao" value="VOLTAR"></a></center></a>

</body>
</html>

<?php
     }
?>
