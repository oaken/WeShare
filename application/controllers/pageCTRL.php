<?php
/*
Fichier qui redirige sur les différentes pages
Auteur : Ludovic Tresson
*/
if (isset($_POST["page"]))
{
	switch ($_POST["page"])
	{
		case "accueil.php":
			$layout = "accueil.php";
			break;
		case "film.php":
			include_once("filmCTRL.php");
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