<?php
require_once 'CLASSES/utilizadores.php';
// Instancia da classe
$user = new utilizador;
?>



<!DOCTYPE html>
<html lang="pt">
<head>
	<meta charset="utf-8">
	<title>Projeto Login</title>
	<link rel="stylesheet" type="text/css" href="CSS/estilo.css">
</head>

<body>
<div id="corpo-formulario">
	<!-- Criação de formulario através do método post que é mais seguro do que o GET,temos q enviar email e senha -->
	<h1>ENTRAR</h1>
	<form method="POST">		
		<input type="email" placeholder="Utilizador" name="email">
		<input type="password" placeholder="Senha" name="senha"> 
		<input type="submit" value="ACESSAR">
		<!-- agr fazemos um link para os ñ inscritos -->
		<a href="registar.php">Ainda não é inscrito?<strong> Registe-se já!</strong></a>
	</form>
</div>
<?php

if(isset($_POST['email']))
{
     // addsLashes por prevenção, segurança.
	$email = addslashes($_POST['email']);
	$senha = addslashes($_POST['senha']);

	if (!empty($email) && !empty($senha))
	{

		$user->conectar("projetologin", "localhost","root","");
		if($user->msgErro == "")
		{
			//metodo logar, enviar os parametros email e senha
			if($user->logar($email,$senha))
			{
			// entrar na area privada
				header("location: AreaPrivada.php");
			}
			else
			{
				?>
				<div class="msg-erro">
					Dados incorretos! Insira novamente.
				</div>
				<?php	
			}
		}
		else
		{
			?>
			<div class="msg-erro">
				<?php echo "Erro: ".$user->msgErro;
				?>
			</div>
			<?php
		}
	}
	else
	{
		?>
		<div class="msg-erro">
			Preencha todos os campos!
		</div>
		<?php	
	}	
}

?>
</body>
</html>
