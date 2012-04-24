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

$error (S): unsigned_int 
0	: OK 
1	: trop long ;
2	: erreur requête invalide/problème avec la BDD;

Auteur: Vincent Ricard
*/

function	changeProfil($Pseudo, $FirstName, $LastName, $Password, /*, $RetypePwd*/$Mail, 
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
			var_dump($FirstName);
			echo('<br />Firstname fourni  : {'.$FirstName.'}<br >');
			echo('Taille : '.strlen($FirstName).'<br />');
			$error = 1;
		}
	}
	else if (!empty($LastName))
	{
		if (strlen(LastName) < 20)
		{
			$query = sprintf("UPDATE USERS SET LastName = '%s' 
							WHERE IdUSer = %d",
							$LasName, getId($Pseudo));
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
	else if (!empty($Password))
	{
		/*
			if ($Password != $RetypePwd)
			{
				$error;
			}
		*/
		if (strlen($Password) < 61)
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
		else
		{
			$error = 1;
		}
	}
	else if (!empty($Mail))
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
	else if (!empty($BornDate))
	{
		$query = sprintf("UPDATE USERS SET BorDate = %d 
						 WHERE IdUSer = %d",
						$BornDate, getId($Pseudo));
		$result = mysql_query($query, dbConnect());
			if (!isset($result))
			{
				$error = 1;
			}
	}
	else if (!empty($Adress))
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
	else if (!empty($City))
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
	else if (!empty($Country))
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
	else if (!empty($Phone))
	{
		if (count($Phone) < 10)
		{
			$query = sprintf("UPDATE USERS SET $Phone = %d 
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
			$error = 1;
		}
	}
	else if (!empty($Avatar))
	{
		/* */
	}
return ($error);
}
?>