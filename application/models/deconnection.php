<?php
/* 
Fonction qui permet de se deconnecter

auteur : Alexandre Arnal.
*/
function deconnect()
{
// On appelle la session 

session_start(); 
 
// On écrase le tableau de session 

$_SESSION = array(); 
 
// On détruit la session 

session_destroy();  
}
?>