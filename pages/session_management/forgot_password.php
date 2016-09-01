<?php require_once('../../lib/globals.php');?>
<?php require_once('../../lib/connexion.php');?>
<?php require_once('../../lib/lib_member.php');?>
<?php require_once('../../lib/lib_mail.php');?>

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