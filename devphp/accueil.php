<?php require_once('connexion.php'); ?>
<?php

session_start(); // On relaye la session
if (isset($_SESSION['authentification'])){ // v�rification sur la session authentification (la session est elle enregistr�e ?)
// ici les �ventuelles actions en cas de r�ussite de la connexion
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
<p>Bienvenue dans votre espace s�curis�. <br>
Vous �tes connect� en tant que &quot;<span class="donnee"><?php echo $_SESSION['email']; ?></span>&quot;.<br>
Votre mot de passe est &quot;<span class="donnee"><?php echo $_SESSION['password']; ?></span>&quot; (chiffr� par MD5 &gt; ne peut donc �tre vivible en clair).</p>



<p align="center"><a href="index.php?error=logout"><strong>Vous d�connecter</strong></a></p>
</body>
</html>
