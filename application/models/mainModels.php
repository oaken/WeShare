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
	$result = mysql_query("SELECT Pseudo FROM Users
						WHERE Pseudo='" . $register_pseudo . "'", dbConnect());
	$isPseudoInUse = mysql_num_rows($result);
	if (!isset($result))
	{
		$error[3] = 1;
	}
	
	if (count($register_pseudo) > 33)
	{
		$error[0] = 1;
	}
	elseif ($isPseudoInUse == 1)
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
	$result = mysql_query("SELECT Mail FROM Users
						WHERE Mail='" . $register_email . "'", dbConnect());
	$isMailInUse = mysql_num_rows($result);
	if (!isset($result))
	{
		$error[3] = 1;
	}
	
	if (count($register_email) > 255)
	{
		$error[2] = 1;
	}
	elseif($isMailInUse == 1)
	{
		$error[2] = 2;
	}
	
	
	$register_bornDate = '';
	$register_bornDate = $register_year."-".$register_month."-".$register_day;
	//enregistrement dans la bdd
	if($error[0] == 0 && $error[1] == 0 && $error[2] == 0)
	{
		$query = sprintf("INSERT INTO Users
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
		$result = mysql_query($query, dbConnect());
		if (!isset($result))
		{
			$error[3] = 1;
		}
	}
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
	return $error;
}
?>