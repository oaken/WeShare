<?php
/* 
$error = 1; ---> Pseudo ou Mot de passe incorrect
$error = 2; ---> Les champs Pseudo et Mot de passe doivent être remplis
*/


// Indique le bon format des entêtes (par défaut apache risque de les envoyer au standard ISO-8859-1)
header('Content-type: text/html; charset=UTF-8');

function Verif_magicquotes ($chaine)
{
if (get_magic_quotes_gpc()) $chaine = stripslashes($chaine);

return $chaine;
}

// Initialisation du message de réponse
$message = null;


// Si le formulaire est envoyé
if (isset($_POST['pseudo']))
{

    /* Récupération des variables issues du formulaire
    Teste l'existence les données post en vérifiant qu'elles existent, qu'elles sont non vides et non composées uniquement d'espaces.
    (Ce dernier point est facultatif et l'on pourrait se passer d'utiliser la fonction trim())
    En cas de succès, on applique notre fonction Verif_magicquotes pour (éventuellement) nettoyer la variable */
    $pseudo = (isset($_POST['pseudo']) && trim($_POST['pseudo']) != '')? Verif_magicquotes($_POST['pseudo']) : null;
    $pass = (isset($_POST['pass']) && trim($_POST['pass']) != '')? Verif_magicquotes($_POST['pass']) : null;
   

    // Si $pseudo et $pass différents de null
    if(isset($pseudo,$pass))
    {
         // Indique à mySql de travailler en UTF-8 (par défaut mySql risque de travailler au standard ISO-8859-1)
         mysql_query("SET NAMES 'utf8'",dbConnect());
   
         // Préparation des données pour les requêtes à l'aide de la fonction mysql_real_escape_string
         $nom = ($pseudo);
         $password = ($pass);
   
   
         /* Requête pour récupérer les enregistrements répondant à la clause :
         champ du pseudo et champ du mdp de la table = pseudo et mdp postés dans le formulaire*/
        $S_requete = "SELECT * FROM membres WHERE pseudo = '".$nom."' AND pass = '".$password."'";  
   
         // Exécution de la requête
         $S_req_exec = mysql_query($S_requete,dbConnect()) or die(mysql_error());
   
         // Création du tableau associatif du résultat
         $S_resultat = mysql_fetch_assoc($S_req_exec);

         // Les valeurs (si elles existent) sont retournées dans le tableau $resultat;
         if (isset($S_resultat['pseudo'],$S_resultat['pass']))  
               {
                 session_start();
                 $_SESSION['login'] = $pseudo;
                }
                else
                {   
                $error = 1;
                }

    }
    else
    { 
    $error = 2;
    }
}
?>