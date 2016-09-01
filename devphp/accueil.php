<?php require_once('connexion.php'); ?>
<?php

session_start(); // On relaye la session
if (isset($_SESSION['authentification'])){ // vérification sur la session authentification (la session est elle enregistrée ?)
// ici les éventuelles actions en cas de réussite de la connexion
}
else {
header("Location:index.php?error=intru"); // redirection en cas d'echec
}
?>
<html>
<head>
<title>ESPACE PRIVE</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="login-form.css" rel="stylesheet" type="text/css">
</head>
<body>
<p align="center" class="titre"><strong>- : : : VOTRE ESPACE PRIVE : : : -</strong></p>
<p>Bienvenue dans votre espace sécurisé. <br>
Vous êtes connecté en tant que &quot;<span class="donnee"><?php echo $_SESSION['email']; ?></span>&quot;.<br>
Votre mot de passe est &quot;<span class="donnee"><?php echo $_SESSION['password']; ?></span>&quot; (chiffré par MD5 &gt; ne peut donc être vivible en clair).</p>



<p align="center"><a href="index.php?error=logout"><strong>Vous déconnecter</strong></a></p>
</body>
</html>
