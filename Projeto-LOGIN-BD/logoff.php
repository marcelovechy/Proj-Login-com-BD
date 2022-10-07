<?php 
session_start();
unset($_SESSION['id_utilizador']);  // para derrubar a sessao
// redirecionar para o ecra de login
header("location: index.php");

?>