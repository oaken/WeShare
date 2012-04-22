<?php
/*
Fichier de controle qui traite et redirige le login
*/

if(isset($_GET['action'])){
	switch ($_GET['action'])
	{
		case "profil":
			@session_start();
			$user = $_SESSION['User'];
			$layout="profil.php";
			$layoutAdd = 0;
			break;
		case "edit":
			$layout="editProfil.php";
			$layoutAdd = 1;
			break;
		case "amis":
			$userId = getId($user);
			//gestion des ajouts d'amis
			if(isset($_GET['suppr']) && !empty($_GET['suppr']))
			{
				replyToFriendship($userId, $_GET['suppr'], 0);
			}
			if(isset($_GET['add']) && !empty($_GET['add']))
			{
				replyToFriendship($userId, $_GET['add'], 1);
			}
			if((isset($_GET['no']) && !empty($_GET['no'])))
			{
				replyToFriendship($userId, $_GET['no'], 2);
			}
			if((isset($_GET['ignore']) && !empty($_GET['ignore'])))
			{
				replyToFriendship($userId, $_GET['ignore'], 3);
			}
			
			$friend = getFriends($userId);
			$friendRequest = getFriendshipRequest($userId);
			$layout="amisProfil.php";
			$layoutAdd = 2;
			break;
		case "films":
			$layout="filmsProfil.php";
			$layoutAdd = 3;
			break;
		default:
			$layout="profil.php";
			$layoutAdd = 0;
	}
}
else
{
	$layout="profil.php";
	$layoutAdd = 0;
}
$profil = getProfil($user);
?>