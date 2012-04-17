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
Modifié par: Ludovic Tresson(correction indentation/ maj sprintf et verifs)
*/
function register($pseudo, $password, $retypePassword, $mail, $lastName, $firstName, $day, $mounth, $year, $phone, $address, $city, $country)
{
	$error = 0;
	$errorPs = 0;
	$errorPa = 0;
	$errorMa = 0;
	
	if (count($pseudo) > 33)
	{
		$errorPs = 1;
		$error++;
	}
	else
	{
		$S_query = "SELECT Pseudo FROM Users WHERE Pseudo=\"".$pseudo."\"";
		if(mysql_num_rows(mysql_query($S_query, dbConnect())) != 0)
		{
			$errorPs = 2;
			$error++;
		}
	}
	
	if (count($password) > 65)
	{
		$errorPa = 1;
		$error++;
	}
	elseif (count($password) < 6)
	{
		$errorPa = 2;
		$error++;
	}
	else
	{
		if($password != $retypePassword)
		{
			$errorPa = 3;
			$error++;
		}
	}
	if (count($mail) > 255)
	{
		$errorMa = 1;
		$error++;
	}
	
	if($error == 0)
	{
		$S_query = sprintf("INSERT INTO Users
						(RegisterDate, Pseudo, Password, Mail, LastName,
							FirstName, BornDate, Address, City, Country, Phone)
						VALUES ('%s', '%s', '%s', '%s')", 
						date("y-m-d"), trim($pseudo), trim($password), $mail, $lastName,
							$firstName, $bornDate, $address,$city, $country, $phone);
		$S_result = mysql_query($query, dbConnect());
		if (empty($S_result))
		{
			$error++;
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
}
?>