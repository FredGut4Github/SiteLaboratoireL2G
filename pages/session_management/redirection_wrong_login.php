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

							<!-- [ MOBILE-CLOCK ] -->
							<div id="mobile-clock" class="layout-4">
								
							</div>
							<!-- [ MOBILE-CLOCK END ] -->

							<div id="contact" class="anim s01 pg-wrp">
							  <div class="container">
				
							    <!-- [ TITLE ] -->
							    <section class="title-wrapper anim fadeInUp s01 delay-0-5s">
							      <h1 class="h1 title">Identifiant ou mot de passe erroné</h1>
							      <span class="line"></span>
							      <p>
							        Veuillez réessaye ... Redirection en cours ...<br>
								  </p>
							    </section>

							    <script type="text/javascript">
							      function RedirectionJavascript(){
							        document.location.href="<?php echo $HTTP_URL ?>";
							      }
							      setTimeout('RedirectionJavascript()', 3000);
							   </script>




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