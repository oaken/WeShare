<?php
/*
Fonction qui trouve si l'utilisateur est connecté

retourne l'utilisateur si il est trouver.
auteur: Ludovic Tresson
*/
function getUser()
{
	session_start();
	if (isset($_SESSION["User"]))
	{
		return $_SESSION["User"];
	}
	else
	{
		return;
	}
}


/* 
Cette fonction sert à se connecter à la base de donnée

$error (S): int : 
0 -> pas d'erreurs
1 -> Connexion impossible à la bdd ;
2 -> Selection impossible de la bdd ;

$link (S) : retourne le lien de mysql_connect()

Auteur: Vincent Ricard
Modifié par: Ludovic Tresson (ajout erreur(0|2)/constantes de la bdd)
*/
function dbConnect ()
{
	static $link = null;
	if ($link === null)
	{
		$error = 0;
		$link = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);
		if (empty($link))
		{
			die("Impossible de se connecter : " . mysql_error());
			$error = 1;
			return ($error);
		}
		else
		{
			$db_selected = mysql_select_db('WeShare', $link);
			if (empty($db_selected))
			{
				die("Impossible de sélectionner la base de données : " 
				. mysql_error());
				$error = 2;
				return ($error);
			}
		}
	}
	return ($link);
}

/* 
La fonction register sert à enregistrer l'utilisateur dans la base de donnée.
$register_pseudo,
$register_password, 
$register_retypePassword,
$register_email,
$register_lastName,
$register_firstName,
$register_day,
$register_month,
$register_year,
$register_address,
$register_city,
$register_country,
$register_phoneNumber

$error[] (S): array 
[0|1|2|3]=>0	: OK 
  [0|1|2]=>1	: trop long ;
      [3]=>1	: erreur requête invalide/problème avec la BDD;
    [0|2]=>2	: pseudo/mail déjà utilisé;
      [1]=>2	: mot de pass ne correspondent pas;


Auteur: Vincent Ricard
Réecriture complète par Ludovic Tresson
*/
function register($register_pseudo,
		$register_password, 
		$register_retypePassword,
		$register_email,
		$register_lastName,
		$register_firstName,
		$register_day,
		$register_month,
		$register_year,
		$register_address,
		$register_city,
		$register_country,
		$register_phoneNumber)
{
	$error[0] = 0;
	$error[1] = 0;
	$error[2] = 0;
	$error[3] = 0;
	
	//verif pseudo
	$S_result = mysql_query("SELECT Pseudo FROM Users
						WHERE Pseudo='" . $register_pseudo . "'", dbConnect());
	$S_isPseudoInUse = mysql_num_rows($S_result);
	if (!isset($S_result))
	{
		$error[3] = 1;
		echo "coucou1";
	}
	
	if (count($register_pseudo) > 33)
	{
		$error[0] = 1;
	}
	elseif ($S_isPseudoInUse == 1)
	{
		$error[0] = 2;
	}
	
	//verif pass
	if (count($register_password) > 61)
	{
		$error[1] = 1;
	}
	elseif($register_password != $register_retypePassword)
	{
		$error[1] = 2;
	}
	
	//verif mail
	$S_result = mysql_query("SELECT Mail FROM Users
						WHERE Mail='" . $register_email . "'", dbConnect());
	$S_isMailInUse = mysql_num_rows($S_result);
	if (!isset($S_result))
	{
		$error[3] = 1;
		echo "coucou2";
	}
	
	if (count($register_email) > 211)
	{
		$error[2] = 1;
	}
	elseif($S_isMailInUse == 1)
	{
		$error[2] = 2;
	}
	
	
	$register_bornDate = '';
	$register_bornDate = $register_year."-".$register_month."-".$register_day;
	//enregistrement dans la bdd
	if($error[0] == 0 && $error[1] == 0 && $error[2] == 0)
	{
		$S_query = sprintf("INSERT INTO Users
						(RegisterDate, Pseudo, Password, Mail, LastName,
							FirstName, BornDate, Address, City, Country, Phone)
						VALUES ('%s', '%s', '%s', '%s', '%s',
								'%s', '%s', '%s', '%s', '%s', '%s')", 
						date("y-m-d"),
						$register_pseudo,
						$register_password,
						$register_email,
						$register_lastName,
						$register_firstName,
						$register_bornDate,
						$register_address,
						$register_city,
						$register_country,
-						$register_phoneNumber);
		$S_result = mysql_query($S_query, dbConnect());
		if (!isset($S_result))
		{
			$error[3] = 1;
		echo "coucou3";
		}
	}
	mysql_close();
	return ($error);
}

/* 
Fonction qui permet de se connecter
$error = 1; ---> Pseudo ou Mot de passe incorrect

auteur : Alexandre Arnal.
*/
function connect($pseudo, $pass)
{
	$error = 0;
	
	$S_query = "SELECT Pseudo, Password FROM Users 
					WHERE Pseudo = '".$pseudo."' AND Password = '".$pass."'";  

	$S_result = mysql_query($S_query,dbConnect()) or die(mysql_error());

	// Création du tableau associatif du résultat
	$S_info = mysql_fetch_assoc($S_result);

	// Les valeurs (si elles existent) sont retournées dans le tableau $info;
	if (isset($S_info['Pseudo']) && isset($S_info['Password'])) 
	{
		@session_start();
		$_SESSION['User'] = $pseudo;
	}
	else
	{   
		$error = 1;
	}
	mysql_close();
	return $error;
}

/*
Fonction permettant de lister les membres

$membres (S): array contenant les pseudo et date d'inscription des membres,
					retourne -1 si il y a une erreur

auteur : Ludovic Tresson
*/
function getMember($userPseudo)
{
	/* on cherche a savoir l'id de la personne qui fais la requete 
		(sert a savoir les liens d'amitié)*/

	$userId = getId($userPseudo);
	
	$S_query = ("SELECT U.IdUser, U.Pseudo, U.RegisterDate, F.Status 
				FROM Users AS U 
				LEFT JOIN Friends AS F ON (U.IdUser = F.IdFriend AND F.IdUser = '".$userId."')
				WHERE U.IdUser != '".$userId."'");
	$S_result = mysql_query($S_query, dbConnect());
	if (!isset($S_result))
	{
		return -1;
	}
	$S_nbRow = mysql_num_rows($S_result);
	for ($i=0;$i< $S_nbRow;$i++)
	{
		$membres[] = mysql_fetch_assoc($S_result);
		$membres[$i]['RegisterDate']= formateDate($membres[$i]['RegisterDate']);
	}
	mysql_close();
	return $membres;
}

/*
focntion qui transforme la date de yyyy-mm-dd a dd/mm/yyyy-mm-dd

auteur : Ludovic Tresson
*/
function formateDate($date)
{
	list($year, $month, $day) = explode('-', $date);
	$newDate = $day."/".$month."/".$year;
	
	return $newDate;
}

/* 
Fonction qui permet de se deconnecter

auteur : Alexandre Arnal.
*/
function disconnect()
{
// On appelle la session 

@session_start(); 
 
// On écrase le tableau de session 

$_SESSION = array(); 
 
// On détruit la session 

session_destroy();  
}

/*
fonction pour faire une demande d'amis

retourne :	0 si ok
			1 si pb de connection bdd
			2 si déjà existant
auteur : Ludovic Tresson
*/
function requestFriendship($userPseudo, $newFriend)
{
	$userId = getId($userPseudo);
	
	//on cherche si l'amis n'est pas déjà rentrer
	$S_query = ("SELECT U.IdUser, F.Status
			FROM Users AS U
			LEFT JOIN Friends AS F ON (F.IdFriend = '".$newFriend."' AND F.IdUser = '".$userId."')
			WHERE U.IdUser = '".$userId."'");
	$S_result = mysql_query($S_query, dbConnect());
	if (!isset($S_result))
	{
		return 1;
	}
	$S_exist[] = mysql_fetch_assoc($S_result);
	
	//si il existe deja alors $S_exist[0] existe 
							//mais $S_exist[0]['Status'] n'existe pas
	if((isset($S_exist[0]) && $S_exist[0]['Status'] == null))
	{
		$S_query = ("INSERT INTO Friends (IdUser, IdFriend, Status)
						VALUES ('".$userId."','".$newFriend."','0')");
		$S_result = mysql_query($S_query, dbConnect());
		if (!isset($S_result))
		{
			return 1;
		}
	}
	else
	{
		return 2;
	}
	return 0;
}

function getProfil($user)
{
	$S_query = ("SELECT * 
				FROM Users
				HAVING Pseudo = '".$user."'");
				
	$S_result = mysql_query($S_query, dbConnect());
	if (!isset($S_result))
	{
		return -1;
	}

	$profil = mysql_fetch_assoc($S_result);
	$profil['RegisterDate'] = formateDate($profil['RegisterDate']);
	$profil['BornDate'] = formateDate($profil['BornDate']);

	mysql_close();
	return $profil;
}


function getId($pseudo)
{
	$S_query = ("SELECT * FROM Users HAVING Pseudo = '".$pseudo."'");
				
	$S_result = mysql_query($S_query, dbConnect());
	if (!isset($S_result))
	{
		return -1;
	}
	$S_user = mysql_fetch_assoc($S_result);
	return $S_user['IdUser'];
}

function getFriends($idUser)
{
	$S_friend = false;
	$S_query = ("SELECT U.Pseudo,U.IdUser FROM Users AS U
					LEFT JOIN Friends AS F
					ON U.IdUser = F.IdFriend AND F.IdUser = '".$idUser."'
					WHERE F.Status = 1");
	$S_result = mysql_query($S_query, dbConnect());
	if (!isset($S_result) || $S_result == false)
	{
		return -1;
	}
	
	$S_nbRow = mysql_num_rows($S_result);
	for ($i=0;$i< $S_nbRow;$i++)
	{
		$S_friend[] = mysql_fetch_assoc($S_result);
	}
	
	if($S_friend == false)
	{
		return -1;
	}
	return $S_friend;
}

function getFriendshipRequest($idUser)
{
	$S_friendRequest = false;
	$S_query = ("SELECT U.Pseudo,U.IdUser FROM Users AS U
					LEFT JOIN Friends AS F
					ON U.IdUser = F.IdUser AND F.IdFriend = '".$idUser."'
					WHERE F.Status = 0");
	$S_result = mysql_query($S_query, dbConnect());
	if (!isset($S_result) || $S_result == false)
	{
		return -1;
	}
	$S_nbRow = mysql_num_rows($S_result);
	for ($i=0;$i< $S_nbRow;$i++)
	{
		$S_friendRequest[] = mysql_fetch_assoc($S_result);
	}
	//si il n'y a pas de résultat on sort prématurément en retournant -1
	if($S_friendRequest == false)
	{
		return -1;
	}
	
	return $S_friendRequest;
}
/*

$type (E) : type de la requete, 0 = tout les films, 
								1 = tout le staff ,
								2 = film en particulier, 
								3 = staff en particulier
*/
function searchData($type, $recherche)
{
	switch($type)
	{
		case "0":
			$S_query = ("SELECT * FROM Movies");
			$S_result = mysql_query($S_query, dbConnect());
			if (!isset($S_result) || $S_result == false)
			{
				return -1;
			}
			$S_data[] = mysql_fetch_assoc($S_result);
			break;
			
		case "1":
			$S_query = ("SELECT * FROM Staff");
			$S_result = mysql_query($S_query, dbConnect());
			if (!isset($S_result) || $S_result == false)
			{
				return -1;
			}
			$S_data[] = mysql_fetch_assoc($S_result);
			break;
		case "2":
			$S_query = ("SELECT * FROM Movies WHERE Name = '".$recherche."' REGEXP '^.*".$recherche.".*$'");
			$S_result = mysql_query($S_query, dbConnect());
			if (!isset($S_result) || $S_result == false)
			{
				return -1;
			}
			$S_data[] = mysql_fetch_assoc($S_result);
			break;
		case "3":
			$S_query = ("SELECT * FROM Staff WHERE Name = '".$recherche."' REGEXP '^.*".$recherche.".*$'");
			$S_result = mysql_query($S_query, dbConnect());
			if (!isset($S_result) || $S_result == false)
			{
				return -1;
			}
			$S_data[] = mysql_fetch_assoc($S_result);
			break;
	}
	return $S_data;
}

function replyToFriendship($userId, $friendId, $status)
{
	$S_query = ("UPDATE Friends
				SET Status = '".$status."'
				WHERE IdUser ='".$friendId."' AND IdFriend = '".$userId."'");
	$S_result = mysql_query($S_query, dbConnect());
	if (!isset($S_result))
	{
		return 1;
	}
	
	//ajout d'une autre entré pour que l'on soit amis des deux cotés
	if($status == 1)
	{
		$S_query = ("INSERT INTO Friends (IdUser, IdFriend, Status)
						VALUES ('".$userId."','".$friendId."','1')");
		$S_result = mysql_query($S_query, dbConnect());
		if (!isset($S_result))
		{
			return 1;
		}
	}
	//suppression d'un ami
	if($status == 0)
	{
		$S_query = ("DELETE FROM Friends
					WHERE IdUser ='".$userId."' AND IdFriend = '".$friendId."'");
		$S_result = mysql_query($S_query, dbConnect());
		if (!isset($S_result))
		{
			return 1;
		}
	}
}

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
		if (!count($FirstName) > 20)
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
			echo('Firstname fourni  : {'.$FirstName.'}<br >');
			echo('Taille : '.count($FirstName).'<br />');
			$error = 1;
		}
	}
	else if (!empty($LastName))
	{
		if (!count(LastName) > 20)
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
		if (!count($Password) > 61)
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
		if (!count($Mail) > 211)
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
		if (!count($Adress) > 211)
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
		if (!count($City) > 60) // voir http://fr.wikipedia.org/wiki/Llanfairpwllgwyngyllgogerychwyrndrobwllllantysiliogogogoch
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
		if (!count($Country) > 31)
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
		if (!count($Phone) > 10)
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