<?php


include("../models/mainModels.php");
define('DS', '/');
define('ADDRESS', '/');
include("../../config/config.php");

//$link = dbConnect();
//$query = sprintf('SELECT * FROM USERS WHERE Pseudo = %s', 'Mackovich');
$result = mysql_query('SELECT * FROM USERS WHERE Pseudo = Mackovich', dbConnect());
var_dump($result);
if (isset($result) )
{
	mysq
}
else
{
	echo('fail');
}

switch 

$psedo.$password
Pseudo, 
?>