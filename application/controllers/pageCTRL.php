<?php
/*
Fichier qui redirige sur les différentes pages
Auteur : Ludovic Tresson
*/
if (isset($_GET["page"]))
{
	switch ($_GET["page"])
	{
		case "accueil.php":
			$layout = "accueil.php";
			break;
		case "film.php":
			include_once("filmCTRL.php");
			break;
		case "membres.php":
			if(isset($_GET['addFriend']) && !empty($_GET['addFriend']))
			{
				requestFriendship($_SESSION['User'], $_GET['addFriend'])
			}
			$membres = getMember();
			$layout = "membres.php";
			break;
		case "deconnection":
			disconnect();
			$layout = "home.php";
			break;
		default:
			$layout = "erreur.php";
		
	}
}
else
{
	$layout = "accueil.php";
}
?>