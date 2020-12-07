﻿<?php
     //mantendo uma sessão

     session_start();

     //recuperando as variaveis da sessão

     $system_control = $_SESSION["system_control"];
     $status = $_SESSION["status"];

     //verificando se o usuário realizou o login

     if(!(($system_control == 1)&&($status == 1)))
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
          
          $nome = $_POST["c_nome"];
          
          //Verificando se os campos foram preenchidos
          
          if(empty($nome))
          {
?>
               <script language="JavaScript">
                    alert("Campo NOME Vazio!!!");
                    history.go(-1);
               </script>
<?php
          }
          else
          {
               //Consultar tabela funcoes para encontrar o nome do cargo
               
               require("../../connect.php");
               
               $consulta_nome_departamentos = mysqli_query($link, "SELECT * FROM $table_departamentos WHERE nome = '$nome'");
               $quant_nome_departamentos = mysqli_num_rows($consulta_nome_departamentos);
               
               //Elaborando resultado da pesquisa
               
               if($quant_nome_funcoes == 1)
               {
?>
                    <script language="JavaScript">
                         alert("Departamento Já Existente!!!");
                         history.go(-1)";
                    </script>
<?php
               }
               else
               {
                    //Inserindo os dados na tabela
                    
                    $resultado_inserir_departamentos = mysqli_query($link, "INSERT INTO $table_departamentos(nome) VALUES ('$nome')");
                    
                    //Verificando se os dados foram inseridos com sucesso
                    
                    if($resultado_inserir_departamentos == 0)
                    {
?>
                         <script language="JavaScript">
                              alert("Houve Problema No Cadastramento do Departamento!!!");
                              history.go(-1);
                         </script>
<?php
                    }
                    else
                    {
                         //Cargo cadastrado com sucesso
                         
?>
                         <script language="JavaScript">
                              alert("Cadastro Realizado Com Sucesso!!!");
                              history.go(-1);
                         </script>
<?php
                    }
               }
               
          }
        }
?>
