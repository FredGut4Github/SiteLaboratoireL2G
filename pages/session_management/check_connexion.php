<?php require_once('../../lib/globals.php'); ?>
<?php require_once('../../lib/connexion.php'); ?>
<?php

session_start(); // D�but de session

if (isset($_POST['email']))
{ // Ex�cution uniquement apr�s envoi du formulaire (test si la variable POST existe)
	$email = addslashes($_POST['email']); // Mise en variable du nom d'utilisateur
	$password = addslashes(md5($_POST['password'])); // Mise en variable du mot de passe chiffr� � l'aide de md5
	


// Requete sur la table administrateurs (on r�cup�re les infos de la personne)
  if ($result = $dbprotect->query("SELECT * FROM MEMBER WHERE email='$email' AND password='$password'"))
  {
    if ( $result->num_rows == 1 ) // Si une seule et unique adresse mail et pass correspondent (pas 0, pas 2)
    {
      $r = $result->fetch_assoc(); // On r�cup�re la ligne en cours
      // D�claration des variables de session
      $_SESSION['email'] = $r['email']; // Son Login
      $_SESSION['first_name'] = $r['first_name']; // Son Pr�nom
      $_SESSION['last_name'] = $r['last_name']; // Son Nom de Famille
      $_SESSION['title'] = $r['title']; // Dr. Mr. Mme...
      $_SESSION['id_member'] = $r['id_member']; // Son iD
     
      header("Location:accueil.php"); // redirection si OK
    }
    else 
    {
      header("Location:redirection_wrong_login.php"); // redirection si utilisateur non reconnu
    }
  }
  else 
  {
    header("Location:redirection_wrong_login.php"); // redirection si utilisateur non reconnu
  }
}

?>