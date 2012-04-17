<?php
/* 
La fonction register sert à enregistrer l'utilisateur dans la base de donnée.
$pseudo (E): string
$password (E): string
$password (E): string
$error (S): int : 
1 -> pseudo trop long ;
2 -> password trop long;
3 -> $mail trop long;
4 -> erreur requête invalide/problème avec la BDD;
0 -> OK 


Auteur: Vincent Ricard
Modifié par: Ludovic Tresson(correction indentation)
*/
function register($pseudo, $password, $mail)
{
	$error = 0;
	if (count($pseudo) > 255)
	{
		$error = 1;
	}
	elseif (count($password) > 255)
	{
		$error = 2;
	}
	elseif (count($mail) > 255)
	{
		$error = 3;
	}
	else
	{
		$query = sprintf("INSERT INTO Users
						(RegisterDate, Pseudo, Password, Mail)
						VALUES ('%s', '%s', '%s', '%s')", 
						date=NOW(),
						mysql_real_escape_string($pseudo), 
						mysql_real_escape_string($password), 
						mysql_real_escape_string($mail)
						);
		$result = mysql_query($query, connect_bdd());
		if (empty($result))
			{
				$error = 4;
			}
	}
	return ($error);
}
?>