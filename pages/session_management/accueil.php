<?php require_once('../../lib/globals.php'); ?>
<?php require_once('../../lib/connexion.php'); ?>
<?php

session_start(); // On relaye la session
if (isset($_SESSION['email'])) 
{ // vérification sur la session authentification (la session est elle enregistrée ?)
// ici les éventuelles actions en cas de réussite de la connexion
}
else 
{
header("Location:$HTTP_URL"); // redirection en cas d'echec
}

?>


<!DOCTYPE html>

<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="description" content="Spécialisé dans la prothèse complète amovible, le laboratoire Gutierrez a plus de 50 ans d'expérience. Il est situé sur Grenoble et livre dans toute la région.">
  <meta name="keywords" content="laboratoire, gutierrez, prothésiste, dentaire, dents, prothèses, dentier, amovible, complète, grenoble, isère, ghislaine, robert, spécialiste, spécialisé, laboratoire gutierrez,
    équipe, contact, informations">
  <meta name="author" content="Pug-IT France">

  <title>Laboratoire Gutierrez</title>
  
  <!-- [ FONT-AWESOME ICON ] -->
  <link rel="stylesheet" type="text/css" href="../../lib/font-awesome-4.3.0/css/font-awesome.min.css">
  
  <!-- [ PLUGIN STYLESHEET ] -->
  <link rel="stylesheet" type="text/css" href="../../css/animate.css">
  <link rel="stylesheet" type="text/css" href="../../css/owl.carousel.css">
  <link rel="stylesheet" type="text/css" href="../../css/magnific-popup.css">
  <link rel="stylesheet" type="text/css" href="../../css/jquery.mCustomScrollbar.min.css">

  <!-- [ DEFAULT STYLESHEET ] -->
  <link rel="shortcut icon" type="image/x-icon" href="../../images/favicon.ico">
  <link rel="stylesheet" type="text/css" href="../../lib/bootstrap/css/bootstrap-theme.min.css">
  <link rel="stylesheet" type="text/css" href="../../lib/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="../../css/reset.css">
  <link rel="stylesheet" type="text/css" href="../../css/structure.css">
  <link rel="stylesheet" type="text/css" href="../../css/main-style.css">
  <link rel="stylesheet" type="text/css" href="../../css/responsive.css">
</head>


<body class="single-image">
	
	<div class="page-loader-wrapper">
		<div class="loader"></div>
	</div>

	<!-- [ MAIN-WRAPPER ] -->
	<div id="main-wrapper">

	<!-- [ MENU-ICON ] -->
    <a href="<?php echo $HTTP_URL ?>" class="nc-menu-trigger-home"><span>Menu</span></a>
    <!-- [ MENU-ICON END ] -->

		<!-- [ PAGE-SECTION ] -->
		<main id="main" class="background" data-image="../../images/intro-bg-blur.jpg">

			<!-- [ BACKGROUND-OVERLAY ] -->
			<div class="overlay"></div>
			<!-- [ BACKGROUND-OVERLAY END ] -->


				<!-- [ LEFT ] -->
				<div id="nc-left-cell" class="nc-cell vhm layout-4">
					<div class="inner-container vhm-item">
						
						<!-- [ LOGO ] -->
						<div class="logo ac anim fadeInUp s01 delay-0-5s">
							<div class="logo-wrp">
								<a href="<?php echo $HTTP_URL ?>">
								<img src="../../images/Logos/logo.png" alt="Logo Laboratoire Gutierrez">
								</a> 
							</div>
						</div>
						<!-- [ LOGO END ] -->


						<!-- [ REGULAR-BOX ] -->
						<div id="reguar-box">

							<!-- [ SUBSCRIBE ] -->
							<div class="subscribe ac anim fadeInUp s01 delay-0-8s">
								<form id="notifyMe" class="subscription-form clear form-field-wrapper" method="POST" action="subscribe.php">
									<input type="text" class="form-control" name="email" placeholder="Email">
									<button type="submit" id="submit" class="icon vhm"><i class="fa fa-envelope-o vhm-item"></i></button>
								</form>
								<p>Recevez notre actualité<br>en saisissant votre email ci-dessus.</p>
							</div>

							<!-- [ SUBSCRIBE END ] -->

							<!-- [ ADRESS ] -->
							<div class="social-icon ac anim fadeInUp s01 delay-0-9s">
								<p><a style="color:white;" href="https://goo.gl/maps/pkCrwVhwDzv" target="_blank">4 rue Nestor Cornier,<br>
								38100 Grenoble<br></a><br>
								04 76 46 92 67
								</p>
							</div>
							<!-- [ ADRESS END ] -->

							<!-- [ COPYRIGHT ] -->
							<div class="copyrights ac anim fadeInUp s01 delay-1s">
								<span><i class="fa fa-copyright"></i></span> 2016 &bull; Pug-IT France
							</div>
							<!-- [ COPYRIGHT END ] -->

						</div>
						<!-- [ REGULAR-BOX END ] -->
						

					</div>
				</div>
				<!-- [ LEFT END ] -->

				<!-- [ RIGHT ] -->
				<div id="nc-right-cell" class="nc-cell vhm">
					
					<!-- [ HOME-PAGE ] -->
					<div id="home-page" class="page-wrapper vhm-item active-home anim s01">
						<div class="container">

							<!-- [ MOBILE-CLOCK ] -->
							<div id="mobile-clock" class="layout-4">
								
							</div>
							<!-- [ MOBILE-CLOCK END ] -->

							<div id="contact" class="anim s01 pg-wrp">
							  <div class="container">
				
							    <!-- [ TITLE ] -->
							    <section class="title-wrapper anim fadeInUp s01 delay-0-5s">
							      <h1 class="h1 title">Bienvenue dans votre espace !</h1>
							      <span class="line"></span>
							      <p>
							        Vous êtes connecté en tant que : <?php echo $_SESSION['email']; ?>.<br>
									Votre mot de passe est : <?php echo $_SESSION['password']; ?>> (chiffré par MD5 : ne peut donc être vivible en clair).<br>
									</p>

									<p align="center"><a style="color:#9EBF85" href="../../pages/session_management/logout.php"><strong>Vous déconnecter</strong></a></p>
							    </section>






							<!-- [ MOBILE-BOX ] -->
							<div id="mobile-box">
							</div>
							<!-- [ MOBILE-BOX END ] -->
						</div>
					</div>
					<!-- [ HOME-PAGE END ] -->
				</div>
				<!-- [ RIGHT END ] -->
			</div>
		</main>
		<!-- [ PAGE-SECTION END ] -->

	</div>
	<!-- [ MAIN-WRAPPER END ] -->

	<!-- [ DEFAULT SCRIPT ] -->
	<script src="../../js/jquery-1.11.3.min.js"></script>

	<!-- [ PLUGIN SCRIPT ] -->
	<script src="../../js/plugins.js"></script>

	<!-- [ COMMON SCRIPT ] -->
	<script src="../../js/common.js"></script>
	<script src="../../js/responsive.js"></script>

</body>
</html>