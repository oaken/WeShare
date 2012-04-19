<?php
/*
Test de register si tout se passe correctement on voit écris la date d'inscription, le pseudo, pass, mail

Auteur : Alexandre ARNAL
*/
include("../models/mainModels.php");
define('DS', '/');
define('ADDRESS', '/');
include("../../config/config.php");
mysql_query("INSERT INTO Users (RegisterDate, Pseudo, Password, Mail) VALUES ('19/04/2012', 'Froutch', '123456', 'froutch@froutch.com)", dbConnect());

register("19/04/2012", "Froutch", "123456", "froutch@froutch.com");
echo $_SESSION["User"];
?>