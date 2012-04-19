<?php
/*
Test de connect si tout se passe correctement on vois écris Ludovic
*/
include("../models/mainModels.php");
define('DS', '/');
define('ADDRESS', '/');
include("../../config/config.php");
mysql_query("INSERT INTO Users (Pseudo, Password) VALUES ('Ludovic', '123')", dbConnect());

connect("Ludovic", "123");
echo $_SESSION["User"];
?>