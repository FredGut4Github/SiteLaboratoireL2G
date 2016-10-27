<?php require_once('../../lib/globals.php'); ?>
<?php require_once('../../lib/connexion.php'); ?>
<?php
session_start();
?>

<?php require('page_header.html'); ?>

				<!-- [ RIGHT ] -->
				<div id="nc-right-cell" class="nc-cell vhm">
					
					<!-- [ HOME-PAGE ] -->
					<div id="home-page" class="page-wrapper vhm-item active-home anim s01">
						<div class="container">

			            </div>

			          </div>
			          <!-- [ HOME-PAGE END ] -->

			          <!-- [ AJAX-PAGE ] -->
			          <div id="ajax-page" class="page-wrapper vhm-item layout4">

			            <div class="container">
			            
							<div id="contact" class="anim s01 pg-wrp">
							  <div class="container">
				
							    <!-- [ TITLE ] -->
							    <section class="title-wrapper anim fadeInUp s01 delay-0-5s">
							      <h1 class="h1 title">Vous vous êtes bien déconnectés !</h1>
							      <span class="line"></span>
							      <p>
							        Au revoir <?php echo $_SESSION['email']; ?>.<br>
								  </p>

									<p align="center"><a style="color:#9EBF85" href="<?php echo $HTTP_URL ?>"><strong>Retour vers l'accueil</strong></a></p>
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

<?php

session_unset();
session_destroy();

?>