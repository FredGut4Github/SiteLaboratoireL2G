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

<?php require('page_header.html'); ?>

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

<?php require('page_footer.html'); ?>
