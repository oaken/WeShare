<?php
/*
Sous-fichier de control qui traite le(s) changement(s) des données du 
profil de l'utilisateur.

Auteur : Vincent Ricard
Aide : Ludovic Tresson
*/

if(isset($_POST["lastName"]) && !empty($_POST["lastName"]))
{
	$change_lastName = $_POST["lastName"];
}
else
{
	$change_lastName = null;
}

if(isset($_POST["firstName"]) && !empty($_POST["firstName"]))
{
	$change_firstName = $_POST["firstName"];
}
else
{
	$change_firstName = null;
}

if(isset($_POST["day"]) && !empty($_POST["day"]))
{
	$change_day = $_POST["day"];
}
else
{
	$change_day = null;
}

if(isset($_POST["month"]) && !empty($_POST["month"]))
{
	$change_month = $_POST["month"];
}
else
{
	$change_month = null;
}

if(isset($_POST["year"]) && !empty($_POST["year"]))
{
	$change_year = $_POST["year"];
}
else
{
	$change_year = null;
}

if(isset($_POST["phoneNumber"]) && !empty($_POST["phoneNumber"]))
{
	$change_phoneNumber = $_POST["phoneNumber"];
}
else
{
	$change_phoneNumber = null;
}

if(isset($_POST["address"]) && !empty($_POST["address"]))
{
	$change_address = $_POST["address"];
}
else
{
	$change_address = null;
}

if(isset($_POST["city"]) && !empty($_POST["city"]))
{
	$change_city = $_POST["city"];
}
else
{
	$change_city = null;
}

if(isset($_POST["country"]) && !empty($_POST["country"]))
{
	$change_country = $_POST["country"];
}
else
{
	$change_country = null;
}
if(isset($_POST["avatar"]) && !empty($_POST["avatar"]))
{
	$change_avatar = $_POST["avatar"];
}
else
{
	$change_avatar = null;
}

if(isset($_POST["password"]) && !empty($_POST["password"]))
{
	$change_password = $_POST["password"];
}
else
{
	$change_password = null;
}

if(isset($_POST["retypePassword"]) && !empty($_POST["retypePassword"]))
{
	$change_retypePassword = $_POST["retypePassword"];
}
else
{
	$change_retypePassword = null;
}
if(isset($_POST["email"]) && !empty($_POST["email"]))
{
	$change_email = $_POST["email"];
}
else
{
	$change_email = null;
}

$change_bornDate = '';
$change_bornDate = $change_year."-".$change_month."-".$change_day;

/*changeProfil($IdUser, $FirstName, $LastName, $Password, $RetypePwd, $Mail, 
					   	 $BornDate, $address, $City, $Country, $Phone, $Avatar)*/
$error_changeprofil = changeProfil($IdUser,
							$change_firstName,
							$change_lastName,
							$change_password, 
							$change_retypePassword,
							$change_email,
							$change_bornDate,
							$change_address,
							$change_city,
							$change_country,
							$change_phoneNumber,
							$change_avatar);
if ($error_changeprofil != 0)
{
	$layout="editProfil.php";
	$layoutAdd = 1;
}
else
{
	$layout="profil.php";
	$layoutAdd = 0;
}
?>