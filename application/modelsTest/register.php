<?php
/*
Test de register si tout se passe correctement on voit écris la date d'inscription, le pseudo, pass, mail

Auteur : Alexandre ARNAL
*/
include("../models/mainModels.php");
define('DS', '/');
define('ADDRESS', '/');
include("../../config/config.php");

$erreur = register("Froutch", "123456", "123456", "froutch@froutch.com", "Alexandre", "ARNAL", "19", "04", "2012", "5 impasse du moulin à vent", "Versailles", "France", "10609922424");
$resultat = mysql_query ("SELECT * FROM Users WHERE Pseudo='Froutch'");
$nbRow[] = mysql_fetch_assoc($resultat);
echo "<p>";
print_r($erreur);
print_r($nbRow);
echo "</p>";
?>