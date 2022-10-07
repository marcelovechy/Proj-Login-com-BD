<!--
<?php

// verificaçao pq não é qualquer pessoa que pode entrar aqui
	
	//ob_start();
	//session_start(); // iniciar sessao

	//require 'connection.php';
	//se não estiver setado a variavel global idutilizador ela será encaminhada para a pag de login
	//if (!isset($_SESSION['id_utilizador'])) 
	//{
	//	header("location: index.php");
	//	exit;  //exit para nao executar nada além dessa linha
		
	//}

//?> 
-->


<?php
	ob_start();
	session_start();

	require 'connection.php';

	// sessao do login (user id)
	$_SESSION['user_id'] = 1;

	$UserBlocked = 0;
	$UserId = $_SESSION['user_id'];
	// Se a sessao Call não existir for == a vazio recebe 0, caso contrario recele ela mesma
	$ChatUser = ($_SESSION['Call'] == '' ? '0' : $_SESSION['Call']);

	// Verificação da sessoes criadas até agr
	if (!$_SESSION['user_id']) {
		session_destroy();
		header('location: index.php');
	}
?>



<!doctype html>
<html lang="pt-br">
	<head>
		<meta charset="utf-8">
		<title>Chat In RealTime</title>
		
		<link rel="stylesheet" href="style2.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
	</head>
	
	<body>
		<?php require 'modals.php'; ?>
		<div class="result"></div>
		
		<section class="container">
			<article class="container_top_header">
				
				<div class="container_top">
					<?php
						$ReadTop = $pdo->prepare("SELECT id_utilizador")
					?>				
					<div class="container_top_left">
						<img src="images/mestres-do-php.png" alt="Foto do Usuário Mestres do PHP" title="Foto do Usuário Mestres do PHP" class="border_gray">
					</div>
					
					<div class="container_top_center">
						<p class="container_top_center_firstLine">Mestres do PHP</p>
						<p class="container_top_center_secondLine"><span class="gray fa fa-circle"></span> OFFLINE</p>
					</div>
					<div class="clear"></div>
				</div>
				
				<div class="container_top_right">
					<p>
						<a title="Procurar amigos" class="bg_green btn_search"><span class="fa fa-plus-circle"></span></a>
						<a title="Sair do Chat" class="bg_red btn_logout"><span class="fa fa-times-circle"></span> </a>
					</p>
					
				</div>
				<div class="clear"></div>
			</article>
			
			<div class="separator"></div>
			
			<article class="container_content">
				
				<div class="loaderHeader">

					<div class="container_content_margin">
						<div class="container_main_left">
							<img src="images/mestres-do-php.png" alt="Foto do Usuário Mestres do PHP" title="Foto do Usuário Mestres do PHP" class="border_gray">
						</div>
						
						<div class="mobile">
							<div class="container_main_center">
								<p class="container_main_center_firstLine">Mestres do PHP</p>
								<p class="container_main_center_secondLine"><span class="gray fa fa-circle"></span> OFFLINE </p>
							</div>
							
							<div class="container_main_right">
								<p>
									<a title="Chamar este usuário para o Chat" class="bg_gray btn_call" ><span class="fa fa-comments"></span> Chamar</a>
								</p>
							</div>
						</div>
						<div class="clear"></div>
					</div>
				</div>
				
				<div class="space_margin"></div>
			</article>
		</section>
		
		<section class="content">
			<article class="content_top">
				
				<div class="contentLoader">

					<div class="content_top_left">
						<img src="images/mestres-do-php.png" alt="Foto do Usuário Mestres do PHP" title="Foto do Usuário Mestres do PHP" class="border_gray">
					</div>
					
					<div class="content_top_center ">
						<p class="content_top_center_firstLine">Mestres do PHP</p>
						<p class="content_top_center_secondLine"><span class="green fa fa-circle"></span> ONLINE </p>
					</div>

				</div>
					
				<div class="content_top_right">
					<div class="topLoader">
					
						<p>
							<a title="Banir usuário" class="bg_gray btn_disabled"><span class="fa fa-times-circle"></span> </a>
						</p>

						<p>
							<a title="Aceitar pedido de amizade" class="bg_green btn_request_approved" ><span class="fa fa-thumbs-up"></span></a>
							<a title="Rejeitar pedido de amizade" class="bg_red btn_request_remove"><span class="fa fa-thumbs-down"></span> </a>
						</p>
						
					</div>
				</div>
				
				
				<div class="clear"></div>
			</article>
			
			<div class="separator"></div>
			
			<article class="content_header">
				
				<div class="loaderChat">
					
					<div class="content_header_margin">
						<div class="content_header_margin_img">
							<img src="images/mestres-do-php.png" alt="Foto do Usuário Mestres do PHP" title="Foto do Usuário Mestres do PHP" class="border_gray">
						</div>
						
						<div class="content_header_margin_text">
							<p class="content_main_center_chat">
							<span class="datetime">Mensagem ficará aqui</p>
						</div>
						
						<div class="clear"></div>
					</div>
					
				</div>
				<div class="text"></div>
				<div class="space_margin"></div>
			</article>
			
			<article class="content_form">
				<form method="post" id="form_chat">
					<div class="content_left">
						<input type="text" name="chat_text" disabled placeholder="Digite sua mensagem...">
					</div>
					
					<div class="content_right">
						<button class="bg_gray btn_disabled"><i class="fa fa-paper-plane"></i></button>
					</div>
					<div class="clear"></div>
				</form>
			</article>
		</section>
		
		<script src="jquery.js"></script>
		<script src="script.js"></script>
	</body>
</html>

<?php
	ob_end_flush();
?>

<a href="logoff.php"> Sair </a>