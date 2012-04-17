<?php
/*
Fichier de controle qui traite et redirige le login
Auteur : Ludovic Tresson
*/
if (isset($_POST["pseudo"]) && isset($_POST["password"]))
{
	connect($_POST["pseudo"], 
			$_POST["password"]);
	$layout = "accueil.php";
}
else
{
	$layout = "login.php";
}
?>