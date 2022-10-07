<?php
// trazer o documento para esta página antes de instanciar
	require_once 'CLASSES/utilizadores.php';
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
<div id="corpo-formulario-regis">
<!-- Criação de formulario através do método post que é mais seguro do que o GET,temos q enviar email e senha -->
	<h1>Registar</h1>
	<form method="POST">	
		<input type="text" name="nome" placeholder="Nome Completo" maxlength="30">
		<input type="text" name="telefone" placeholder="Telefone" maxlength="30">
		<input type="email" name="email" placeholder="Utilizador" maxlength="40">
		<input type="password" name="senha" placeholder="Senha" maxlength="15">
		<input type="password" name="confirmarSenha" placeholder="Confirmar senha" maxlength="15">
		<input type="submit" value="Registar">
		<!-- agr fazemos um link para os ñ inscritos -->
	</form>
</div>

<?php
//Verificar se o utilizador clicou no botao registar através do metodo POST / isset  (ReadLine)

if(isset($_POST['nome']))
{

	$nome = addslashes($_POST['nome']); // addsLashes por prevenção, segurança.
	$telefone = addslashes($_POST['telefone']);
	$email = addslashes($_POST['email']);
	$senha = addslashes($_POST['senha']);
	$confirmarSenha = addslashes($_POST['confirmarSenha']);

	// Verificar se esta preenchido pois o utilizador pode deixar um campo em branco e queremos todas as informações
	// através da funcao empty SE NAO ESTA VAZIO NAS VARIAVEIS
	if (!empty($nome) && !empty($telefone) && !empty($email) && !empty($senha) && !empty($confirmarSenha)) {

		// chamamos a var user acessando o metodo conectar, que pede alguns parametros
		$user->conectar("projetologin", "localhost","root","");
		if($user->msgErro == "") // se a variavel msgerro estiver vazia, está tudo ok
		{ 
			if ($senha == $confirmarSenha) // verificação se a senha e o confirmar senha estão iguais
			{
				if($user->registar($nome,$telefone,$email,$senha))   // funcao e parametros do registar em utilizadores.php,  ( retorna esta tudo ok)
				{
					// fechar e depois abrir o php para criarmos uma div e formatar a mensagem.
					?> 
					<div id="msg-ok">
					Registado com sucesso. Estás pronto para entrar!;
					</div>
					<?php
				}
				else 
				{
					// como temos várias vamos criar uma classe
					?>
					<div class="msg-erro">   
					Email já registado!
					</div>
					<?php
				}
			}
			else // caso contrario o utilizador digitou errado
			{
				// como temos várias vamos criar uma classe
				?>
				<div class="msg-erro">   
				Senhas não correspondem!
				</div>
				<?php
				
			}
		}
		else // caso contrario, ela esta preenchida e deu erro
		{
			// como temos várias vamos criar uma classe
			?>
			<div class="msg-erro">   
				<?php echo "Erro:".$user->msgErro;?>
			</div>
			<?php
			
		}
	}

	else // caso contrário
	{
		// como temos várias vamos criar uma classe
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