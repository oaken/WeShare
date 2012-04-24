<?php
/* 
La fonction changeProfil sert à entrer le(s) modification(s) des données utilisateur, faite(s) par lui-même, dans la base de donnée.
$Pseudo, 
$FirstName, 
$LastName, 
$Password, 
$RetypePwd, 
$Mail, 
$BornDate, 
$Adress, 
$City, 
$Country, 
$Phone, 
$Avatarr

$error (S): int 
0	: OK 
1	: trop long ;
2	: erreur requête invalide/problème avec la BDD;
3	: numéro de téléphone trop long ou trop court
4	: erreur format image avatar invalide
5	: la confirmation du mot de passe à échouer
Auteur: Vincent Ricard avec l^heureuse participation partielle mais utile de Tresson. Merci à lui.
*/

function	changeProfil($Pseudo, $FirstName, $LastName, $Password, $RetypePwd, $Mail, 
					   	 $BornDate, $Adress, $City, $Country, $Phone, $Avatar)
{
	$error = 0;
	if (!empty($FirstName))
	{	
		if (strlen($FirstName) < 20)
		{
			$query = sprintf("UPDATE USERS SET FirstName = '%s' 
							 WHERE IdUSer = %d",
							 $FirstName, getId($Pseudo));
			$result = mysql_query($query, dbConnect());
			if (!isset($result))
			{
				$error = 2;
			}
		}
		else
		{
			$error = 1;
		}
	}
	if (isset($LastName))
	{
		if (strlen($LastName) < 20)
		{
			$query = sprintf("UPDATE USERS SET LastName = '%s' 
							WHERE IdUSer = %d",
							$LastName, getId($Pseudo));
			$result = mysql_query($query, dbConnect());
			if (!isset($result))
			{
				$error = 2;
			}
		}
		else
		{
			$error = 1;
		}
	}
	if (!empty($Password))
	{
		if (strlen($Password) < 61)
		{
			if ($Password != $RetypePwd)
			{
				$error = 5;
			}
			else
			{
				$query = sprintf("UPDATE USERS SET Password = '%s'
								 WHERE IdUSer = %d",
								$Password, getId($Pseudo));
				$result = mysql_query($query, dbConnect());
				if (!isset($result))
				{
					$error = 2;
				}
			}
		}
		else
		{
			$error = 1;
		}
	}
	if (!empty($Mail))
	{
		if (strlen($Mail) < 211)
		{
			$query = sprintf("UPDATE USERS SET Mail = '%s' 
							 WHERE IdUSer = %d",
							$Mail, getId($Pseudo));
			$result = mysql_query($query, dbConnect());
			if (!isset($result))
			{
				$error = 2;
			}
		}
		else
		{
			$error = 1;
		}
	}
	if (!empty($BornDate))
	{
		$query = sprintf("UPDATE USERS SET BornDate = '%s' 
						 WHERE IdUSer = %d",
						$BornDate, getId($Pseudo));
		$result = mysql_query($query, dbConnect());
			if (!isset($result))
			{
				$error = 1;
			}
	}
	if (!empty($Adress))
	{
		if (strlen($Adress) < 211)
		{
			$query = sprintf("UPDATE USERS SET Adress = '%s' 
							WHERE IdUSer = %d",
							$Adress, getId($Pseudo));
			$result = mysql_query($query, dbConnect());
			if (!isset($result))
			{
				$error = 2;
			}
		}
		else
		{
			$error = 1;
		}
	}
	if (!empty($City))
	{
		if (strlen($City) < 60) // voir http://fr.wikipedia.org/wiki/Llanfairpwllgwyngyllgogerychwyrndrobwllllantysiliogogogoch
		{
			$query = sprintf("UPDATE USERS SET City = '%s' 
							 WHERE IdUSer = %d",
							$City, getId($Pseudo));
			$result = mysql_query($query, dbConnect());
			if (!isset($result))
			{
				$error = 2;
			}
		}
		else
		{
			$error = 1;
		}
	}
	if (!empty($Country))
	{
		if (strlen($Country) < 31)
		{
			$query = sprintf("UPDATE USERS SET Country = '%s' 
							 WHERE IdUSer = %d",
							$Country, getId($Pseudo));
			$result = mysql_query($query, dbConnect());
			if (!isset($result))
			{
				$error = 2;
			}
		}
		else
		{
			$error = 1;
		}
	}
	if (!empty($Phone))
	{
		if (strlen($Phone) == 10)
		{
			$query = sprintf("UPDATE USERS SET $Phone = '%s' 
							 WHERE IdUSer = %d",
							 $Phone, getId($Pseudo));
			$result = mysql_query($query, dbConnect());
			if (!isset($result))
			{
				$error = 2;
			}
		}
		else
		{
			$error = 3;
		}
	}
	if (!empty($Avatar))
	{
		if (stristr($Avatar, ".jpg") || stristr($Avatar, ".jpeg") 
		 || stristr($Avatar, ".gif") || stristr($Avatar, ".png")
		 || stristr($Avatar, ".bmp"))
		{
			$query = sprintf("UPDATE USERS SET $Avatar = '%s' 
							 WHERE IdUSer = %d",
							 $Avatar, getId($Pseudo));
			$result = mysql_query($query, dbConnect());
			if (!isset($result))
			{
				$error = 2;
			}
		}
		else
		{
			$error = 4;
		}
	}
return ($error);
}