<?php require_once('connexion.php'); ?>
<?php

session_start(); // Début de session

if (isset($_POST['email']))
{ // Exécution uniquement après envoi du formulaire (test si la variable POST existe)
	$email = addslashes($_POST['email']); // Mise en variable du nom d'utilisateur
	$password = addslashes(md5($_POST['password'])); // Mise en variable du mot de passe chiffré à l'aide de md5
	

// Requete sur la table administrateurs (on récupère les infos de la personne)
  if ($result = $dbprotect->query("SELECT * FROM MEMBER WHERE email='$email' AND password='$password'"))
  {
    if ( $result->num_rows == 1 ) // Si une seule et unique adresse mail et pass correspondent (pas 0, pas 2)
    {
      $_SESSION["authentification"] = 'authentification'; // Enregistrement de la session
      $r = $result->fetch_assoc(); // On récupère la ligne en cours
      // Déclaration des variables de session
      $_SESSION['email'] = $r['email']; // Son Login
      $_SESSION['password'] = $r['password']; // Son mot de passe (à éviter)
     
      header("Location:accueil.php"); // redirection si OK
    }
    else 
    {
      header("Location:index.php?error=email"); // redirection si utilisateur non reconnu
    }
  }
  else 
  {
    header("Location:index.php?error=email"); // redirection si utilisateur non reconnu
  }
}

?>