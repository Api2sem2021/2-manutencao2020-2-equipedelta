﻿<?php
//header("Content-type: text/html; charset=ISO-8895-1");
     //mantendo uma sessão

     session_start();

     //recuperando as variaveis da sessão

     $system_control = $_SESSION["system_control"];
     $status = $_SESSION["status"];
	 $codigo_usuario = $_GET["codigo_usuario"];
	 $codigo_login = $_GET["codigo_login"];
	 
	 require("../../connect.php");
	 $consulta_usuario = "SELECT * FROM $table_usuarios WHERE codigo = '$codigo_usuario'";
	 $resultado_consulta_usuario = mysqli_query($link, $consulta_usuario);
	 $vetor_usuario = mysqli_fetch_array($resultado_consulta_usuario);
	 $codigo_departamento = $vetor_usuario['codigo_departamento'];
	 
	 $consulta_login = "SELECT * FROM $table_logins WHERE codigo = '$codigo_login'";
	 $resultado_consulta_login = mysqli_query($link, $consulta_login);
	 $vetor_login = mysqli_fetch_array($resultado_consulta_login);
	 
	 $consulta_departamento = "SELECT * FROM $table_departamentos WHERE codigo = '$codigo_departamento'";
	 $resultado_consulta_departamento = mysqli_query($link, $consulta_departamento);
	 $vetor_departamento = mysqli_fetch_array($resultado_consulta_departamento);
	 
	 //desconcatenando cpf

     $cpf1 = substr($vetor_usuario['cpf'],0,3);
     $cpf2 = substr($vetor_usuario['cpf'],3,3);
     $cpf3 = substr($vetor_usuario['cpf'],6,3);
     $cpf4 = substr($vetor_usuario['cpf'],9,3);

     //desconcatenando telefone

     $telefone1 = substr($vetor_usuario['telefone'],0,2);
     $telefone2 = substr($vetor_usuario['telefone'],2,4);
     $telefone3 = substr($vetor_usuario['telefone'],6,4);

     //desconcatenando celular

     $celular1 = substr($vetor_usuario['celular'],0,2);
     $celular2 = substr($vetor_usuario['celular'],2,5);
     $celular3 = substr($vetor_usuario['celular'],7,4);

     //verificando se o usuário realizou o login

     if(!(($system_control == 1)&&($status == 1)))
     {
          //acesso inválido
?>
          <script>
               alert("Acesso Inválido");
               document.location.href="../../index.php";
          </script>
<?php
     }
     else
     {
?>
<html>
      <head>
		  <meta charset="utf-8">
          <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
          <title>Atualizar Usuário</title>
          <link rel="stylesheet" href="../css/bootstrap.css">
          <link rel="stylesheet" href="../fonts/ionicons.min.css">
          <link rel="stylesheet" href="../css/style.min.css">
      <script>
                    //tabs automaticos e etc
                    function cpf1()
                    {
                         var tamanho;
                         var retorno;

                         retorno = isNaN(f.c_cpf1.value);

                         if(retorno==1)
                         {
                              alert("Dígito Inválido");
                              f.c_cpf1.value = "";
                              f.c_cpf1.focus();
                         }

                         tamanho = f.c_cpf1.value.length;

                         if(tamanho == 3)
                         {
                              f.c_cpf2.focus();
                         }
                     }
                     //segunda caixa cpf
                    function cpf2()
                    {
                         var tamanho;
                         var retorno;

                         retorno = isNaN(f.c_cpf2.value);

                         if(retorno==1)
                         {
                              alert("Dígito Inválido");
                              f.c_cpf2.value = "";
                              f.c_cpf2.focus();
                         }

                         tamanho = f.c_cpf2.value.length;

                         if(tamanho == 3)
                         {
                              f.c_cpf3.focus();
                         }
                     }
                     //terceira caixa do cpf
                     function cpf3()
                    {
                         var tamanho;
                         var retorno;

                         retorno = isNaN(f.c_cpf3.value);

                         if(retorno==1)
                         {
                              alert("Dígito Inválido");
                              f.c_cpf3.value = "";
                              f.c_cpf3.focus();
                         }

                         tamanho = f.c_cpf3.value.length;

                         if(tamanho == 3)
                         {
                              f.c_cpf4.focus();
                         }
                     }
                     //quarta caixa do cpf
                     function cpf4()
                     {
                         var tamanho;
                         var retorno;

                         retorno = isNaN(f.c_cpf4.value);

                         if(retorno==1)
                         {
                              alert("Dígito Inválido");
                              f.c_cpf4.value = "";
                              f.c_cpf4.focus();
                         }

                         tamanho = f.c_cpf4.value.length;

                         if(tamanho == 2)
                         {
                              f.c_telefone1.focus();
                         }
                      }
                      function telefone1()
                     {
                         var tamanho;
                         var retorno;

                         retorno = isNaN(f.c_telefone1.value);

                         if(retorno==1)
                         {
                              alert("Dígito Inválido");
                              f.c_telefone1.value = "";
                              f.c_telefone1.focus();
                         }

                         tamanho = f.c_telefone1.value.length;

                         if(tamanho == 2)
                         {
                              f.c_telefone2.focus();
                         }
                      }
                      function telefone2()
                     {
                         var tamanho;
                         var retorno;

                         retorno = isNaN(f.c_telefone2.value);

                         if(retorno==1)
                         {
                              alert("Dígito Inválido");
                              f.c_telefone2.value = "";
                              f.c_telefone2.focus();
                         }

                         tamanho = f.c_telefone2.value.length;

                         if(tamanho == 4)
                         {
                              f.c_telefone3.focus();
                         }
                      }
                      function telefone3()
                     {
                         var tamanho;
                         var retorno;

                         retorno = isNaN(f.c_telefone3.value);

                         if(retorno==1)
                         {
                              alert("Dígito Inválido");
                              f.c_telefone3.value = "";
                              f.c_telefone3.focus();
                         }

                         tamanho = f.c_telefone3.value.length;

                         if(tamanho == 4)
                         {
                              f.c_celular1.focus();
                         }
                      }
                      function celular1()
                     {
                         var tamanho;
                         var retorno;

                         retorno = isNaN(f.c_cpf4.value);

                         if(retorno==1)
                         {
                              alert("Dígito Inválido");
                              f.c_celular1.value = "";
                              f.c_celular1.focus();
                         }

                         tamanho = f.c_celular1.value.length;

                         if(tamanho == 2)
                         {
                              f.c_celular2.focus();
                         }
                      }
                      function celular2()
                     {
                         var tamanho;
                         var retorno;

                         retorno = isNaN(f.c_celular2.value);

                         if(retorno==1)
                         {
                              alert("Dígito Inválido");
                              f.c_celular2.value = "";
                              f.c_celular2.focus();
                         }

                         tamanho = f.c_celular2.value.length;

                         if(tamanho == 5)
                         {
                              f.c_celular3.focus();
                         }
                      }
                      function celular3()
                     {
                         var tamanho;
                         var retorno;

                         retorno = isNaN(f.c_celular3.value);

                         if(retorno==1)
                         {
                              alert("Dígito Inválido");
                              f.c_celular3.value = "";
                              f.c_celular3.focus();
                         }

                         tamanho = f.c_celular3.value.length;

                         if(tamanho == 4)
                         {
                              f.c_cep.focus();
                         }
                      }
                      function cepcompleto()
                      {
                         var tamanho;
                         var retorno;

                         retorno = isNaN(f.cep.value);

                         if(retorno==1)
                         {
                              alert("Dígito Inválido");
                              f.cep.value = "";
                              f.cep.focus();
                         }

                         tamanho = f.cep.value.length;

                         if(tamanho == 8)
                         {
                              f.c_numero.focus();
                         }
                       }
                    
      </script>
      <!-- Adicionando JQuery -->
      <script src="https://code.jquery.com/jquery-3.4.1.min.js"
            integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
            crossorigin="anonymous"></script>

    <!-- Adicionando Javascript -->
    <script>

        $(document).ready(function() {

            function limpa_formulário_cep() {
                // Limpa valores do formulário de cep.
                $("#rua").val("");
                $("#bairro").val("");
                $("#cidade").val("");
                $("#uf").val("");
                $("#ibge").val("");
            }

            //Quando o campo cep perde o foco.
            $("#cep").blur(function() {

                //Nova variável "cep" somente com dágitos.
                var cep = $(this).val().replace(/\D/g, '');

                //Verifica se campo cep possui valor informado.
                if (cep != "") {

                    //Expressão regular para validar o CEP.
                    var validacep = /^[0-9]{8}$/;

                    //Valida o formato do CEP.
                    if(validacep.test(cep)) {

                        //Preenche os campos com "..." enquanto consulta webservice.
                        $("#rua").val("...");
                        $("#bairro").val("...");
                        $("#cidade").val("...");
                        $("#uf").val("...");
                        $("#ibge").val("...");

                        //Consulta o webservice viacep.com.br/
                        $.getJSON("https://viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {

                            if (!("erro" in dados)) {
                                //Atualiza os campos com os valores da consulta.
                                $("#rua").val(dados.logradouro);
                                $("#bairro").val(dados.bairro);
                                $("#cidade").val(dados.localidade);
                                $("#uf").val(dados.uf);
                                $("#ibge").val(dados.ibge);
                            } //end if.
                            else {
                                //CEP pesquisado não foi encontrado.
                                limpa_formulário_cep();
                                alert("CEP não encontrado.");
                                f.c_cep.value = "";
                                f.c_cep.focus()
                            }
                        });
                    } //end if.
                    else {
                        //cep é inválido.
                        limpa_formulário_cep();
                        alert("Formato de CEP inválido.");
                    }
                } //end if.
                else {
                    //cep sem valor, limpa formulário.
                    limpa_formulário_cep();
                }
            });
        });

    </script>
                     
      </head>
<body>
      <form name="f" action="atualizar_usuarios_confirmacao2.php" method="post">
	  <input type="hidden" name="c_codigo_login" value="<?php print($codigo_login); ?>">
      <input type="hidden" name="c_codigo_usuario" value="<?php print($codigo_usuario); ?>">

       DADOS PARA A ATUALIZAÇÃO DE USUÁRIO NO SISTEMA:<br><br>
      
      (*)NOME: <input type="text" name="c_nome" value="<?php print($vetor_usuario['nome']);?>"><br>
      (*)SOBRENOME: <input type="text" name="c_sobrenome" value="<?php print($vetor_usuario['sobrenome']);?>"><br>
      (*)SEXO: <select name="c_sexo"><br>
	  <option value="<?php print($vetor_usuario['sexo']);?>"><?php print($vetor_usuario['sexo']);?></option>
      <option value="MASCULINO">MASCULINO</option>
      <option value="FEMININO">FEMININO</option>
      </select><br>
      (*)DATA DE NASCIMENTO:<input type="date" name="c_nasc" max="<?php echo date('Y-m-d');?>" value="<?php print($vetor_usuario['nascimento']);?>"><br>
      (*)DEPARTAMENTO: <select name="c_departamento">
	  <option value="<?php print($vetor_usuario['codigo_departamento']);?>"><?php print($vetor_departamento['nome']);?></option>
      <?php
           //Realizando consulta para recuperar dados de fornecedores cadastrados

               require("../../connect.php");
               
               $consulta_departamentos = mysqli_query($link, "SELECT * FROM $table_departamentos");
               $quant_nome_departamentos = mysqli_num_rows($consulta_departamentos);

               for($i=1;$i<=$quant_nome_departamentos;$i++)
               {
                    $vetor_departamentos = mysqli_fetch_array($consulta_departamentos);
?>
                    <option value="<?php print($vetor_departamentos['codigo']);?>"><?php print($vetor_departamentos['nome']);?></option>
<?php

               }
?>
       </select><br>
      (*)CPF: <input type="text" name="c_cpf1" size="3" maxlength="3" onKeyUp="cpf1();" value="<?php print($cpf1);?>">.<input type="text" name="c_cpf2" size="3" maxlength="3" onKeyUp="cpf2();" value="<?php print($cpf2);?>">.<input type="text" name="c_cpf3" size="3" maxlength="3" onKeyUp="cpf3();" value="<?php print($cpf3);?>">-<input type="text" name="c_cpf4" size="2" maxlength="2" onKeyUp="cpf4();" value="<?php print($cpf4);?>"><br>
         TELEFONE: (<input type="text" name="c_telefone1" size="2" maxlength="2" onKeyUp="telefone1();" value="<?php print($telefone1);?>">) <input type="text" name="c_telefone2" size="4" maxlength="4" onKeyUp="telefone2();" value="<?php print($telefone2);?>">-<input type="text" name="c_telefone3" size="4" maxlength="4" onKeyUp="telefone3();" value="<?php print($telefone3);?>"><br>
      (*)CELULAR: (<input type="text" name="c_celular1" size="2" maxlength="2" onKeyUp="celular1();" value="<?php print($celular1);?>">) <input type="text" name="c_celular2" size="5" maxlength="5" onKeyUp="celular2();" value="<?php print($celular2);?>">-<input type="text" name="c_celular3" size="4" maxlength="4" onKeyUp="celular3();" value="<?php print($celular3);?>"><br>
      <form method="get" action=".">
        <label>(*)CEP:
        <input name="c_cep" type="text" id="cep" size="8" maxlength="8" onKeyUp="cepcompleto();" value="<?php print($vetor_usuario['cep']);?>" /><br>
        <label>(*)RUA:
        <input name="c_rua" type="text" id="rua" size="60" readonly="true" value="<?php print($vetor_usuario['rua']);?>"><br>
        <label>(*)BAIRRO:
        <input name="c_bairro" type="text" id="bairro" size="40" readonly="true" value="<?php print($vetor_usuario['bairro']);?>"><br>
        (*)CIDADE:
        <input name="c_cidade" type="text" id="cidade" size="40" readonly="true" value="<?php print($vetor_usuario['cidade']);?>"><br>
        (*)ESTADO:
        <input name="c_uf" type="text" id="uf" size="2" value="<?php print($vetor_usuario['estado']);?>"><br>
      </form>
      (*)NÚMERO: <input type="text" name="c_numero" size="4" maxlength="8" value="<?php print($vetor_usuario['numero']);?>"><br><br>
       DADOS PARA USO NO SITE:<br>
      
      (*)NICKNAME: <input type="text" name="c_nickname" value="<?php print($vetor_login['nickname']);?>"><br>
      (*)EMAIL: <input type="text" name="c_email" value="<?php print($vetor_login['email']);?>"><br>
      (*)CONFIRME O EMAIL: <input type="text" name="c_email2" value="<?php print($vetor_login['email']);?>"><br>
      (*)SENHA: <input type="password" name="c_senha" value="<?php print($vetor_login['senha']);?>"><br>
      (*)CONFIRME SENHA <input type="password" name="c_senha2" value="<?php print($vetor_login['senha']);?>"><br><br>
      

      <input type="submit" name="botao" value="ATUALIZAR">  <input type="reset" name="botao" value="LIMPAR"> <input type="button" name="botao" value="VOLTAR" onclick="history.go(-1)"></a> <br></form>
      
      (*)CAMPOS OBRIGATÓRIOS
</body>


</html>

<?php
     }
?>

      
