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
	echo('Pseudo : '.$row['Pseudo'].'<br />');
	echo('Password : '.$row['Password'].'<br />');
	echo('Mail : '.$row['Mail'].'<br />');
	echo('LastName : '.$row['LastName'].'<br />');
	echo('FirstName : '.$row['FirstName'].'<br />');
	echo('BornDate : '.$row['BornDate'].'<br />');
	echo('Adress : '.$row['Address'].'<br />');
	echo('City : '.$row['City'].'<br />');
	echo('Country : '.$row['Country'].'<br />');
	echo('Phone : '.$row['Phone'].'<br />');
	echo('---FIN---<br /><br />');
}

$error = changeProfil('Mackovich', 'Vincent', 'Ricard', 'mdp-qui-tue', 'ricard@intechinfo', '', '', 'Paris', 'France', 0699348986, '');

if ($error == 0)
{
	$result = mysql_query($query, dbConnect());
	$row = mysql_fetch_assoc($result);

	echo('Après la modification, pour l\'utilisateur \'Mackovich\', on a :<br />');
	if ($result == FALSE)
	{ 
		echo('Erreur : <br />'.mysql_error());
	}
	else 
	{
		echo('Pseudo : '.$row['Pseudo'].'<br />');
		echo('Password : '.$row['Password'].'<br />');
		echo('Mail : '.$row['Mail'].'<br />');
		echo('LastName : '.$row['LastName'].'<br />');
		echo('FirstName : '.$row['FirstName'].'<br />');
		echo('BornDate : '.$row['BornDate'].'<br />');
		echo('Adress : '.$row['Address'].'<br />');
		echo('City : '.$row['City'].'<br />');
		echo('Country : '.$row['Country'].'<br />');
		echo('Phone : '.$row['Phone'].'<br />');
		echo('---FIN---<br /><br />');
	}
}
else
{
	echo('Retour error de la fonction : '.$error);
}
?>