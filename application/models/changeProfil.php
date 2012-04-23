<?php


include("../models/mainModels.php");
define('DS', '/');
define('ADDRESS', '/');
include("../../config/config.php");

$query_0 = sprintf(
$query = sprintf('SELECT * FROM USERS WHERE IdUSer = %d', getId("Mackovich"));
$result = mysql_query($query, dbConnect());
$row = mysql_fetch_row($result);
if (isset($result) )
{
	$it = 0;
	while (isset($row[$it]))
	{
		echo($row[$it++].'<br />');
	}
}
else
{
	echo('fail');
}
/*
RegisterDate		DATE			NOT NULL,
Pseudo			 	VARCHAR(255) 	NOT NULL,
Password			VARCHAR(255) 	NOT NULL,
Mail			 	VARCHAR(255) 	NOT NULL,
LastName			VARCHAR(255),
FirstName			VARCHAR(255),
BornDate			DATE,
Address			 	VARCHAR(255),
City			 	VARCHAR(255),
Country			 	VARCHAR(255),
Phone				DECIMAL(12,0),
Avatar
*/
// ------------------------------------------------------- //
function	changeProfil($Pseudo, $FirstName, $LastName, $Password, $Mail, 
						$BornDate, $Adress, $City, $Country, $Phone, $Avatar)
{
	if (!empty($FirstName))
	{
		$query = sprintf('UPDATE USERS SET FirstName = %s 
						  WHERE Pseudo = %s 
						  AND IdUSer = %d', 
						  $FirstName, $Pseudo, $getId($Pseudo));
		mysql_query();
	}
	else if (!empty())
	{
	
	}
}

?>