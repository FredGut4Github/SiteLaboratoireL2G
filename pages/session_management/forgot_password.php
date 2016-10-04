<?php require_once('../../lib/globals.php');?>
<?php require_once('../../lib/connexion.php');?>
<?php require_once('../../lib/lib_member.php');?>
<?php require_once('../../lib/lib_mail.php');?>

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

              <!-- [ TAGLINE ] -->
              
          <?php
          global $HTTP_URL;
          if (isset($_POST['email']))
          {
          // on passe toutes les variables $POST en variables
            $email = $_POST['email'];
          
              if ($check_user =  $dbprotect->query("SELECT id_member, first_name, last_name FROM MEMBER WHERE email ='$email'"))
              {
                if ($check_user->num_rows > 0)
                {
                  $member_found = $check_user->fetch_assoc();
                  ?>
                  <section class="title-wrapper anim fadeInUp s01 delay-0-5s">
                    <h1 class="h1 title">L'opération s'est bien déroulée 
                    <span class="line"></span>
                    <p>
                    Vous avez reçu un email !<br><br><br>
                    Redirection en cours ...
                    </p>
                  </section>

                  <script type="text/javascript">
                    function RedirectionJavascript(){
                      document.location.href="<?php echo $HTTP_URL ?>";
                    }
                    setTimeout('RedirectionJavascript()', 5000);
                  </script>

                  <?php
                  if (!SendMailToResetPassword($dbprotect, $email, $member_found['first_name']." ".$member_found['last_name']))
                  {
                    ?>
                  <section class="title-wrapper anim fadeInUp s01 delay-0-5s">
                    <h1 class="h1 title">Veuillez nous excuser...
                    <span class="line"></span>
                    <p>
                    Une erreur s'est produite lors de l'envoi du mail
                    </p>
                  </section>

                    <?php
                  }
                  
                }
                else
                {
                ?>

                  <section class="title-wrapper anim fadeInUp s01 delay-0-5s">
                    <h1 class="h1 title">Aucun compte n'est enregistré avec cet identifiant
                    <span class="line"></span>
                    <p>
                    Veuillez réessayer en vérifiant bien que l'adresse rentrée est correcte en <a style="color:#9EBF85" href="<?php echo $HTTP_URL ?>pages/session_management/forgot_password.php">cliquant ici</a>
                    </p>
                  </section>
                <?php

                }
              }
              else
              {
                ?><p>Une erreur technique (BDD) s'est produite</p>
                <?php
              }
              
          }
          else
          {


          ?>

                <!-- [ CONNEXION PAGE ] -->
                <div id="contact" class="anim s01 pg-wrp">
                  <div class="container">
                    
                    <!-- [ TITLE ] -->
                    <section class="title-wrapper anim fadeInUp s01 delay-0-5s">
                      <h1 class="h1 title">Mot de passe oublié ?</h1>
                      <span class="line"></span>
                      <p>
                        Un email vous sera envoyé, vous n'aurez qu'à cliquer sur le lien, afin de rentrer un nouveau mot de passe.
                      </p>
                    </section>
 
                    <form id="cntForm" class="contact-form" action="" method="post" accept-charset="utf-8" style="max-width:300px; margin-left:auto; margin-right:auto;">

                        <div class="anim fadeInUp s01 delay-1s">
                          <div class="input-area">
                            <input  type="email" id="email" name="email" class="form-control" placeholder="Adresse email" required>
                          </div>
                        </div>

                        <div class="anim fadeInUp s01 delay-1-3s">
                          <div class="button-wrp">
                            <button type="submit" class="btn btn-color" id="submit-1">Envoyer</button><br><br><br><br>
                          </div>
                        </div>

                    </form>

                  </div>
                </div>

                <?php
                }
                ?>

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
