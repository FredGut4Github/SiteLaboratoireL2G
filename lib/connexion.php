<?php require_once('lib_message_log.php');?>
<?php

// Paramêtres de connexion
$hostname_dbprotect = "localhost"; // nom ou ip de votre serveur
$database_dbprotect = "u865896097_labog"; // nom de votre base de données
$username_dbprotect = "u865896097_yann"; // nom d'utilisateur (root par défaut) !!! ATTENTION, en utilisant root, vos visiteurs on tous les droits sur la base
$password_dbprotect = "WebSyde1313"; // mot de passe (aucun par défaut mais il est fortement recommandé d'en mettre un ... sinon à quoi bon la sécurité ?)

$dbprotect = new mysqli($hostname_dbprotect, $username_dbprotect, $password_dbprotect, $database_dbprotect);

if ($dbprotect->connect_errno) 
{
	// FATAL ERROR
	// Should send an eamil to the administrators
	
	// And redirect the page to a specific webpage that notify a temporary technical problem
    echo "Echec lors de la connexion à MySQL : (" . $dbprotect->connect_errno . ") " . $dbprotect->connect_error;
}

?>
