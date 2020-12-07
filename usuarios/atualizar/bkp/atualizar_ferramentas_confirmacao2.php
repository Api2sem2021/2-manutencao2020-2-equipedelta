<?php
     //mantendo uma sessão
//header("Content-type: text/html; charset=ISO-8895-1");
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
          //Recebendo Variaveis
          
          $descricao = $_POST["c_descricao"];
          $nome = $_POST["c_nome"];
          $partnumber = $_POST["c_partnumber"];
          $departamento = $_POST["c_departamento"];
          $quantidade = $_POST["c_quantidade"];
		  $imagem = $_FILES["imagem"];
		  $codigo_ferramenta = $_POST["c_codigo_ferramenta"];

     if($_FILES['imagem']['error'] == 4)
	 {	 
               if(empty($descricao))
               {
?>
                    <script language="JavaScript">
                         alert("Descricao Vazio!!!");
                         history.go(-1);
                    </script>
<?php
               }
               else if(empty($nome))
               {
?>
                    <script language="JavaScript">
                         alert("Nome Vazio!!!");
                         history.go(-1);
                    </script>
<?php
               }
               else if(empty($partnumber))
               {
?>
                    <script language="JavaScript">
                            alert("Part Number Vazio!!!");
                            history.go(-1);
                    </script>
<?php
               }
               else if(empty($departamento))
               {
?>
                    <script language="JavaScript">
                         alert("Departamento Vazio!!!");
                         history.go(-1);
                    </script>
<?php
               }
               else if($quantidade == "")
               {
?>
                    <script>
                            alert("Quantidade Vazio!!!");
                            history.go(-1);
                    </script>
<?php
               }
               else
               {
                    //Conectando com o banco de dados
                    
                    require("../../connect.php");
                    
                         //Realizando consulta do partnumber
                         
                         $consulta_part_ferramentas = mysqli_query($link, "SELECT * FROM $table_ferramentas WHERE part_number = '$partnumber' AND codigo != '$codigo_ferramenta'");
                         $quant_part_ferramentas = mysqli_num_rows($consulta_part_ferramentas);
                         
                         //Elaborando resultado da consulta
                         
                         if($quant_part_ferramentas == 1)
                         {
?>
                              <script language="JavaScript">
                                   alert("Partnumber já registrado no Banco de Dados!!!");
                                   history.go(-1);
                              </script>
<?php
                         }
                         else
                         {
                                   //Inserindo dados necessarios na tabela
								   $nome_imagem = "vazio.jpg";
                                   
                                   $atualizar_ferramentas = mysqli_query($link, "UPDATE $table_ferramentas SET nome='$nome',descricao='$descricao',part_number='$partnumber',codigo_departamento='$departamento',quantidade='$quantidade',imagem='$nome_imagem' WHERE codigo = '$codigo_ferramenta'");
                                   
                                   //Verificando se foi cadastrado com sucesso
                                   
                                   if($atualizar_ferramentas == 0)
                                   {
?>
                                        <script language="JavaScript">
                                             alert("Houve Erro No Cadastramento dos Dados!!!");
                                             history.go(-1);
                                        </script>
<?php
                                   }
                                   else
                                   {
                                   
?>
                                        <script language="JavaScript">
                                             alert("Cadastramento de FERRAMENTA Realizado Com Sucesso!!!")
                                             history.go(-2);
                                        </script>
<?php
                                   }

                                   
                              }
                         }
                    }
					else
					{
						//verifico se a imagem respeita as extensões permitidas
						//Dou prosseguimento ao cadastro dando nome da imagem = partnumber da ferramenta
						// Array com as extensões permitidas
						$extensoes_permitidas = array('.jpg');

						// Faz a verificação da extensão do arquivo enviado
						$extensao = strrchr($_FILES['imagem']['name'], '.');

						// Faz a validação do arquivo enviado
						if(in_array($extensao, $extensoes_permitidas) === false)
						{
?>
						<script language="JavaScript">
							alert("Por favor, envie arquivos com as seguintes extensões: jpg");
							history.go(-1);
						</script>
<?php
						}
						else
						{
							//Extensão permitida.
							if(empty($descricao))
               {
?>
                    <script language="JavaScript">
                         alert("Descricao Vazio!!!");
                         history.go(-1);
                    </script>
<?php
               }
               else if(empty($nome))
               {
?>
                    <script language="JavaScript">
                         alert("Nome Vazio!!!");
                         history.go(-1);
                    </script>
<?php
               }
               else if(empty($partnumber))
               {
?>
                    <script language="JavaScript">
                            alert("Part Number Vazio!!!");
                            history.go(-1);
                    </script>
<?php
               }
               else if(empty($departamento))
               {
?>
                    <script language="JavaScript">
                         alert("Departamento Vazio!!!");
                         history.go(-1);
                    </script>
<?php
               }
               else if($quantidade == "")
               {
?>
                    <script>
                            alert("Quantidade Vazio!!!");
                            history.go(-1);
                    </script>
<?php
               }
               else
               {
                    //Conectando com o banco de dados
                    
                    require("../../connect.php");
                    
                         //Realizando consulta do partnumber
                         
                         $consulta_part_ferramentas = mysqli_query($link, "SELECT * FROM $table_ferramentas WHERE part_number = '$partnumber' AND codigo != '$codigo_ferramenta'");
                         $quant_part_ferramentas = mysqli_num_rows($consulta_part_ferramentas);
                         
                         //Elaborando resultado da consulta
                         
                         if($quant_part_ferramentas == 1)
                         {
?>
                              <script language="JavaScript">
                                   alert("Partnumber já registrado no Banco de Dados!!!");
                                   history.go(-1);
                              </script>
<?php
                         }
                         else
                         {
                                   //Inserindo dados necessarios na tabela
								   
								   $nome_imagem = $partnumber.$extensao;
								   
								   echo unlink("../../imagens/$nome_imagem"); //excluindo possível imagem já existente no diretório
								   
								   $nome_imagem2 = $partnumber.$extensao;								   
								   $dir = '../../imagens/';
								   move_uploaded_file($_FILES['imagem']['tmp_name'], $dir.$nome_imagem2); //Fazer upload do arquivo
                                   
                                   $atualizar_ferramentas = mysqli_query($link, "UPDATE $table_ferramentas SET nome='$nome',descricao='$descricao',part_number='$partnumber',codigo_departamento='$departamento',quantidade='$quantidade',imagem='$nome_imagem2' WHERE codigo = '$codigo_ferramenta'");
                                   
                                   //Verificando se foi cadastrado com sucesso
                                   
                                   if($atualizar_ferramentas == 0)
                                   {
?>
                                        <script language="JavaScript">
                                             alert("Houve Erro No Cadastramento dos Dados!!!");
                                             history.go(-1);
                                        </script>
<?php
                                   }
                                   else
                                   {
                                   
?>
                                        <script language="JavaScript">
                                             alert("Cadastramento de FERRAMENTA Realizado Com Sucesso!!!")
                                             history.go(-4);
                                        </script>
<?php
                                   }
								   
								}
						
							}
						}
					}
				}	 
?>
               

