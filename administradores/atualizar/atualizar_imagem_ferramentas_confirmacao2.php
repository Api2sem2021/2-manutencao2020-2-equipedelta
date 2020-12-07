<?php
     //mantendo uma sessão
//header("Content-type: text/html; charset=ISO-8895-1");
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
               document.location.href="../../index.php";
          </script>
<?php
     }
     else
     {
          //Recebendo Variaveis
		  $imagem = $_FILES["imagem"];
		  $codigo_ferramenta = $_POST["c_codigo_ferramenta"];

     if($_FILES['imagem']['error'] == 4)
	 {
                    //Conectando com o banco de dados
                    
                    require("../../connect.php");
                    
                                   //Inserindo dados necessarios na tabela
								   $nome_imagem = "vazio.jpg";
                                   
                                   $atualizar_ferramentas = mysqli_query($link, "UPDATE $table_ferramentas SET imagem='$nome_imagem' WHERE codigo = '$codigo_ferramenta'");
                                   
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
                                             document.location.href="atualizar_imagem_ferramentas.php";
                                        </script>
<?php
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
                    //Conectando com o banco de dados
                    
                    require("../../connect.php");
                    
                                   //Inserindo dados necessarios na tabela
								   
								   $consultar_partnumber = "SELECT * FROM $table_ferramentas WHERE codigo = '$codigo_ferramenta'";
								   $resultado_consultar_partnumber = mysqli_query($link, $consultar_partnumber);
								   $vet = mysqli_fetch_array($resultado_consultar_partnumber);
								   $partnumber = $vet['part_number'];
								   $data_imagem = $vet['data_imagem'];
								   $nome_imagem = $partnumber."-".$data_imagem.$extensao;
								   
								   echo unlink("../../imagens/$nome_imagem"); //excluindo possível imagem já existente no diretório
								   
								   $data_imagem2 = date('dmYHis');
								   $nome_imagem2 = $partnumber."-".$data_imagem2.$extensao;								   
								   $dir = '../../imagens/';
								   move_uploaded_file($_FILES['imagem']['tmp_name'], $dir.$nome_imagem2); //Fazer upload do arquivo
                                   
                                   $atualizar_ferramentas = mysqli_query($link, "UPDATE $table_ferramentas SET imagem='$nome_imagem2', data_imagem = '$data_imagem2' WHERE codigo = '$codigo_ferramenta'");
                                   
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
                                             document.location.href="atualizar_imagem_ferramentas.php";
                                        </script>
<?php
                                   }
								   
								}
						
							}
						}	 
?>
               

