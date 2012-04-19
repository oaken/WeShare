<?php
/*
Fichier de controle qui traite et redirige le login
*/
if (isset($_POST["pseudo"]) && !empty($_POST["pseudo"]) &&
	isset($_POST["password"])&&  !empty($_POST["password"]) &&
	isset($_POST["retypePassword"]) && !empty($_POST["retypePassword"]) &&
	isset($_POST["email"]) && !empty($_POST["email"]))
{
	$register_pseudo = $_POST["pseudo"];
	$register_password = $_POST["password"];
	$register_retypePassword = $_POST["retypePassword"];
	$register_email = $_POST["email"];
	
	if(isset($_POST["lastName"]) && !empty($_POST["lastName"]))
	{
		$register_lastName = $_POST["lastName"];
	}
	else
	{
		$register_lastName = null;
	}
	
	if(isset($_POST["firstName"]) && !empty($_POST["firstName"]))
	{
		$register_firstName = $_POST["firstName"];
	}
	else
	{
		$register_firstName = null;
	}
	
	if(isset($_POST["day"]) && !empty($_POST["day"]))
	{
		$register_day = $_POST["day"];
	}
	else
	{
		$register_day = null;
	}
	
	if(isset($_POST["month"]) && !empty($_POST["month"]))
	{
		$register_month = $_POST["month"];
	}
	else
	{
		$register_month = null;
	}
	
	if(isset($_POST["year"]) && !empty($_POST["year"]))
	{
		$register_year = $_POST["year"];
	}
	else
	{
		$register_year = null;
	}
	
	if(isset($_POST["phoneNumber"]) && !empty($_POST["phoneNumber"]))
	{
		$register_phoneNumber = $_POST["phoneNumber"];
	}
	else
	{
		$register_phoneNumber = null;
	}
	
	if(isset($_POST["address"]) && !empty($_POST["address"]))
	{
		$register_address = $_POST["address"];
	}
	else
	{
		$register_address = null;
	}
	
	if(isset($_POST["city"]) && !empty($_POST["city"]))
	{
		$register_city = $_POST["city"];
	}
	else
	{
		$register_city = null;
	}
	
	if(isset($_POST["country"]) && !empty($_POST["country"]))
	{
		$register_country = $_POST["country"];
	}
	else
	{
		$register_country = null;
	}
	
	$error_register = register($register_pseudo,
								$register_password, 
								$register_retypePassword,
								$register_email,
								$register_lastName,
								$register_firstName,
								$register_day,
								$register_month,
								$register_year,
								$register_phoneNumber,
								$register_address,
								$register_city,
								$register_country);
	if ($error_register == 0)
	{
		$layout = "login.php";
	}
	else
	{
		$layout = "register.php";
	}
}
else
{
	$layout = "home.php";
}
?>