<?php
/*
Fichier principale de controle redirigeant les requètes sur les fichiers
concernées et traitant les information.
Auteur : Ludovic Tresson

requiert au minimum les fichiers suivants pour fonctionner:
-config.php
-mainModels.php
-smallHeader.php
-footer.php
-login.php
*/

/*
obtention des configurations et des modèles
*/
require_once("./config/config.php");
require_once(DIR_MODELS."/mainModels.php");

/*
traitement des informations
*/
$user = getUser();
if (isset($_POST["page"]))
{
	switch($_POST["page"])
	{
		case "login.php":
			$layout = "login.php";
			break;
		case "register.php":
			$layout = "register.php";
			break;
		case "login":
			include_once("loginCTRL.php");
			$layout = "accueil.php";
			break;
		case "register":
			include_once("registerCTRL.php");
			$layout = "login.php";
			break;
	}
}
elseif ($user == null)
{
	$layout = "home.php";
}
else
{
	include_once("pageCTRL.php");
}
/*
affichage
*/
if ($layout == "register.php")
{
	include_once(DIR_VIEWS."/smallHeader.php");
}
else
{
	include_once(DIR_VIEWS."/header.php");
}
require_once(DIR_VIEWS."/".$layout);
require_once(DIR_VIEWS."/footer.php");

//$_SERVER['SCRIPT_NAME']}?news_id={$_POST['news_id']}
?>