<?php

// Criar classes e funçoes


Class utilizador
{
	private $pdo;  // palavra global
	public $msgErro = "";  // se está vazia tudo OK



		// Método para conectar com o banco de dados ( criamos funçao e passamos os parametro)
	public function conectar($nome, $host, $utilizador, $senha){

		global $pdo;
		try {
			$pdo=new PDO("mysql:dbname=".$nome.";host=".$host,$utilizador,$senha);	
		} 
		// caso dê algum erro
		catch (PDOException $e) {
			$msgErro=$e->getMessage(); // criação variavel menssagem p receber um possivel erro
		}

		//$pdo=new PDO("mysql:dbname=".$nome.";host=".$host,$utilizador,$senha);  // conexão com o banco
	}


	// Método para conectar com o banco de dados ( criamos funçao e passamos os parametro)
	public function registar($nome, $telefone, $email, $senha){

		global $pdo;
		// Aqui verificamos se já existe o email registado
		// enviar o comando através do prepare
		$sql = $pdo->prepare("SELECT id_utilizador FROM utilizadores
			WHERE email = :e");     // para verificar temos que buscar as informações, buscando pela coluna do id_utilizador

		
		$sql->bindValue(":e",$email);    // fazer a substituiçao do email por "e"
		$sql->execute();

		// funçao que conta as linhas que vieram do banco de dados
		if ($sql->rowCount() >0)
		{
			return false;  // já está registado
		}
		else   // caso não exista, registe.
		{
			$sql = $pdo->prepare("INSERT INTO utilizadores (nome, telefone, email, senha) VALUES (:n, :tel, :e, :pass)");
			$sql->bindValue(":n",$nome);   
			$sql->bindValue(":tel",$telefone);    
			$sql->bindValue(":e",$email);    
			$sql->bindValue(":pass",md5($senha));     // usamos o md5 para criptografar a senha 
			$sql->execute();
			return true;  // registo com sucesso tudo ok
		}
		

	}

	public function logar($email,$senha)
	{

		global $pdo;
		// para fazermos o login, o primeiro passo é verificar se o email e senha estão cadastrados, caso esteja entra numa area privada.

		$sql = $pdo->prepare("SELECT id_utilizador FROM utilizadores WHERE email = :e AND senha = :pass");  // para trazer Selecionamos do banco de dados 

		$sql->bindValue(":e",$email);     
		$sql->bindValue(":pass",md5($senha));     // usamos o md5 para criptografar a senha 
		$sql->execute();
		// após a execução, vamos confirmar se veio o id que queremos através do if abaixo
		if($sql->rowCount()>0)  // se sql sao todos os dados q veio da consulyta for maior que zero o user está registado

		{
			//entrar no sistema 
			// pegar o id que veio da consulta e guarnar numa variavel global, transformando a informação que veio do banco de dado num array, para conseguirmos assim apanhar o id do user, fazemos isso através da funçao fetch

			$dado = $sql->fetch(); //variavel para receber os comando e depois transformaçao num array com os nomes das colunas.
			session_start();  // iniciar sessao
			$_SESSION['id_utilizador'] = $dado['id_utilizador'];
			return true; // registado com sucesso
		}

		else
		{
			return false; // não foi possivel logar
		}	
	}
}


?>