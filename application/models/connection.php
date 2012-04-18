<?php
/* 
Fonction qui permet de se connecter
$error = 1; ---> Pseudo ou Mot de passe incorrect

auteur : Alexandre Arnal.
*/
function connect($pseudo, $pass)
{
	$error = 0;
	
	$S_requete = "SELECT Pseudo,Password FROM Users WHERE Pseudo = '".$pseudo."' AND Password = '".$pass."'";  

	$S_req_exec = mysql_query($S_requete,dbConnect()) or die(mysql_error());

	// Création du tableau associatif du résultat
	$S_resultat = mysql_fetch_assoc($S_req_exec);

	// Les valeurs (si elles existent) sont retournées dans le tableau $resultat;
	if (isset($S_resultat['Pseudo'],$S_resultat['Password']))  
	{
		session_start();
		$_SESSION['User'] = $pseudo;
	}
	else
	{   
		$error = 1;
	}
}
?>