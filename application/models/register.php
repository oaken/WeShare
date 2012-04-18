<?php
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
								WHERE Pseudo='" . $register_pseudo . "'",dbConnect());
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
								WHERE Pseudo='" . $register_email . "'",dbConnect());
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
	
	//enregistrement dans la bdd
	if($error[0] == 0 && $error[1] == 0 && $error[2] == 0)
	{
		$query = sprintf("INSERT INTO Users
						(RegisterDate, Pseudo, Password, Mail)
						VALUES ('%s', '%s', '%s', '%s')", 
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
			$error[3] = 4;
		}
	}
	return ($error);
?>