<?php

// Param�tres de connexion
$hostname_dbprotect = "localhost"; // nom ou ip de votre serveur
$database_dbprotect = "u865896097_labog"; // nom de votre base de donn�es
$username_dbprotect = "u865896097_yann"; // nom d'utilisateur (root par d�faut) !!! ATTENTION, en utilisant root, vos visiteurs on tous les droits sur la base
$password_dbprotect = "Nasri1313"; // mot de passe (aucun par d�faut mais il est fortement recommand� d'en mettre un ... sinon, � quoi bon la s�curit� ?)
$dbprotect = new mysqli($hostname_dbprotect, $username_dbprotect, $password_dbprotect, $database_dbprotect);

if ($dbprotect->connect_errno) {
    echo "Echec lors de la connexion � MySQL : (" . $dbprotect->connect_errno . ") " . $dbprotect->connect_error;
}

?>