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
	if (count($register_password) > 65)
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
	
	if (count($register_email) > 255)
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
				LEFT JOIN Friends AS F ON (U.IdUser = F.IdFriend)
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

auteur : Ludovic Tresson
*/
function requestFriendship($userPseudo, $newFriend)
{
	$userId = getId($userPseudo);
	
	
	$S_query = ("INSERT INTO Friends (IdUser, IdFriend, Status)
					VALUES ('".$userId."','".$newFriend."','0')");
	$S_result = mysql_query($S_query, dbConnect());
	if (!isset($S_result))
	{
		return 1;
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
	$S_query = ("SELECT Pseudo,IdUser FROM Users 
					WHERE IdUser = 
						(SELECT IdFriend 
							FROM Friends 
								WHERE IdUser ='".$idUser."' AND Status = 1)");
	$S_result = mysql_query($S_query, dbConnect());
	if (!isset($S_result) || $S_result == false)
	{
		return -1;
	}
	$S_friend[] = mysql_fetch_assoc($S_result);
	
	if($S_friend[0] == false)
	{
		return -1;
	}
	return $S_friend;
}
function getFriendshipRequest($idUser)
{
	$S_query = ("SELECT Pseudo,IdUser FROM Users 
					WHERE IdUser = 
						(SELECT IdFriend 
							FROM Friends 
								WHERE IdFriend ='".$idUser."' AND Status = 0)");
	$S_result = mysql_query($S_query, dbConnect());
	if (!isset($S_result) || $S_result == false)
	{
		return -1;
	}
	$S_friendRequest[] = mysql_fetch_assoc($S_result);

	//si il n'y a pas de résultat on sort prématurément en retournant -1
	if($S_friendRequest[0] == false)
	{
		return -1;
	}
	
	return $S_friendRequest;
}
?>