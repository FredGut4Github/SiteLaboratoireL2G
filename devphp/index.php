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

// Gestion de la  déconnexion
if(isset($_GET['error']) && $_GET['error'] == 'logout'){ // Test sur les paramètres d'URL qui permettront d'identifier un contexte de déconnexion
	$first_name = $_SESSION['first_name']; // On garde le prénom en variable pour dire au revoir
	session_unset("authentification");
	header("Location:index.php?error=delog&first_name=$first_name");
}
?>

<html>
<head>
<title>AUTHENTIFICATION</title>

<link href="login-form.css" rel="stylesheet" type="text/css">

</head>
<body>

  <div class="login">
    <div class="heading">
      <h2>Se connecter</h2>

        <form action="" method="post" name="connect">

          <p align="center" class="title">
            <?php if(isset($_GET['error']) && ($_GET['error'] == "email")) { // Affiche l'error  ?>
            <strong class="error">Echec d'authentification !!! &gt; email ou mot de passe incorrect</strong>
            <?php } ?>
            <?php if(isset($_GET['error']) && ($_GET['error'] == "delog")) { // Affiche l'error ?>
            <strong class="reussite">Déconnexion réussie... A bientôt <?php echo $_GET['first_name'];?> !</strong>
            <?php } ?>
            <?php if(isset($_GET['error']) && ($_GET['error'] == "intru")) { // Affiche l'error ?>
            <strong class="error">Echec d'authentification !!! &gt; Aucune session n'est ouverte ou vous n'avez pas les droits pour afficher cette page</strong>
            <?php } ?>
          </p>
          

          <div class="input-group input-group-lg">
            <span class="input-group-addon"><i class="fa fa-user"></i></span>
            <input type="text" class="form-control" name="email" id="email" placeholder="Adresse email">
          </div>

          <div class="input-group input-group-lg">
            <span class="input-group-addon"><i class="fa fa-lock"></i></span>
            <input type="password" name="password" id="password" class="form-control" placeholder="Mot de passe">
          </div>

          <button type="submit" name="Submit" class="float">Login</button>
         </form>

    </div>
  </div>
</body>
</html>