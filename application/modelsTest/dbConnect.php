<?php
/*
Test de dbConnect si tout se passe bien on obtient une page avec marqué 
"resource(5, mysql link)"
*/
include("../models/mainModels.php");
define('DS', '/');
define('ADDRESS', '/');
include("../../config/config.php");
var_dump(dbConnect());
?>