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

/* obtention des configurations et des modèles */

require_once(ROOT."config".DS."config.php");
require_once(DIR_MODELS.DS."mainModels.php");

/* traitement des informations */
$user = getUser();
if (isset($_GET["page"]) && $user == null)
{
	switch($_GET["page"])
	{
		case "login.php":
			$errorConnect = 0;
			$layout = "login.php";
			break;
		case "register.php":
			$layout = "register.php";
			break;
		case "login":
			include_once("loginCTRL.php");
			break;
		case "register":
			include_once("registerCTRL.php");
			break;
		case "deconnection":
			disconnect();
			$layout = "home.php";
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
/* affichage */
if ($layout == "register.php")
{
	include_once(DIR_VIEWS."/smallHeader.php");
}
else
{
	include_once(DIR_VIEWS."/header.php");
}
if(isset($layoutAdd))
{
	include_once(DIR_VIEWS."/profilHeader.php");
}
require_once(DIR_VIEWS."/".$layout);
require_once(DIR_VIEWS."/footer.php");
?>