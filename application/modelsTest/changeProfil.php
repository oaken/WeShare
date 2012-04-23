<?php
/* Fonction de test permettant de voir si le profil d'un utilisateur a bien été modifié. 

Auteur : Vincent Ricard

*/
include("../models/mainModels.php");
define('DS', '/');
define('ADDRESS', '/');
include("../../config/config.php");

$query = sprintf("SELECT * FROM USERS WHERE IdUSer = %d", getId("Mackovich"));
$result = mysql_query($query, dbConnect());
$row = mysql_fetch_assoc($result);

echo('Avant la modification, pour l\'utilisateur \'Mackovich\', on a :<br />');
if ($result == FALSE)
{ 
	echo('Erreur : <br />'.mysql_error());
}
else 
{
	echo($row['Pseudo'].'<br />');
	echo($row['Password'].'<br />');
	echo($row['Mail'].'<br />');
	echo($row['LastName'].'<br />');
	echo($row['FirstName'].'<br />');
	echo($row['BornDate'].'<br />');
	echo($row['Address'].'<br />');
	echo($row['City'].'<br />');
	echo($row['Country'].'<br />');
	echo($row['Phone'].'<br />');
}
changeProfil();
?>