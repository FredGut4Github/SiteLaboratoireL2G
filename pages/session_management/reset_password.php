<?php require_once('../../lib/globals.php');?>
<?php require_once('../../lib/connexion.php');?>
<?php session_start(); ?>

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
                    if (isset($_GET['id'])) 
                    {
                        $id_link = $_GET['id'];
                        ?>
                        <!-- <p>Le link id = (<)?php echo $id_link ?></p> -->
                        <?php
                        if (($link_result = $dbprotect->query("SELECT * FROM LINK WHERE id_link ='$id_link'")) && ($link_result->num_rows > 0))
                        {
                            $line_result = $link_result->fetch_assoc();
                            $validity_date = $line_result['validity_date'];
                            $now = getdate();
                            if ($now[0] > $validity_date)
                            {
                                //Lien plus valide
                              ?>
                                  <section class="title-wrapper anim fadeInUp s01 delay-0-5s">
                                    <h1 class="h1 title">Veuillez nous excuser <?php echo $line_member['title']." ".$line_member['first_name']." ".$line_member['last_name']?>
                                    <span class="line"></span>
                                    <p>
                                    Votre lien n'est plus valide, nous allons en recréer un.
                                    </p>
                                </section>
                                <?php
                                /*echo ("Lien plus valide".$now[0]." > ".$validity_date);*/
                            }
                            else
                            {
                                $id_member = $line_result['id_member'];
                                if (($member_result = $dbprotect->query("SELECT * FROM MEMBER WHERE id_member = '$id_member'")) && ($member_result->num_rows > 0))
                                {
                                    $line_member = $member_result->fetch_assoc();
                                    if (isset($_POST['pass1']))
                                    {
                                        $str_query = "UPDATE MEMBER SET password='".md5($_POST['pass1'])."' WHERE id_member = '".$id_member."'";
                                        if ($update_member = $dbprotect->query($str_query))
                                        {
                                            ?>
                                            <section class="title-wrapper anim fadeInUp s01 delay-0-5s">
                                              <h1 class="h1 title">Félicitations <?php echo $line_member['title']." ".$line_member['first_name']." ".$line_member['last_name']?>
                                              <span class="line"></span>
                                              <p>
                                              Votre inscription est maintenant terminée !<br>
                                              Rendez-vous sur la partie <a style="color:#9EBF85" href="<?php echo $HTTP_URL ?>">Connexion</a>  !
                                              </p>
                                            </section>

                                            <script type="text/javascript">
                                              function RedirectionJavascript(){
                                                document.location.href="<?php echo $HTTP_URL ?>";
                                              }
                                              setTimeout('RedirectionJavascript()', 5000);
                                           </script>

                                            <?php
                                            if (!($delete_link = $dbprotect->query("DELETE FROM LINK WHERE id_member='$id_member'")))
                                            {
                                              ?>
                                              <section class="title-wrapper anim fadeInUp s01 delay-0-5s">
                                                <h1 class="h1 title">Veuillez nous excuser <?php echo $line_member['title']." ".$line_member['first_name']." ".$line_member['last_name']?>
                                                <span class="line"></span>
                                                <p>
                                                Nous rencontrons actuellement des problèmes techniques, veuillez réessayer ultérieurement.
                                                </p>
                                            </section>

                                            <script type="text/javascript">
                                              function RedirectionJavascript(){
                                                document.location.href="<?php echo $HTTP_URL ?>";
                                              }
                                              setTimeout('RedirectionJavascript()', 5000);
                                           </script>
                                            <?php
                                            /*echo "Problème pour détruire le lien du membre ".$id_member;*/
                                            }
                                        }
                                        else
                                        {
                                            ?>
                                            <section class="title-wrapper anim fadeInUp s01 delay-0-5s">
                                              <h1 class="h1 title">Veuillez nous excuser <?php echo $line_member['title']." ".$line_member['first_name']." ".$line_member['last_name']?>
                                              <span class="line"></span>
                                              <p>
                                              Nous rencontrons actuellement des problèmes techniques, veuillez réessayer ultérieurement.
                                              </p>
                                            </section>

                                            <script type="text/javascript">
                                              function RedirectionJavascript(){
                                                document.location.href="<?php echo $HTTP_URL ?>";
                                              }
                                              setTimeout('RedirectionJavascript()', 5000);
                                           </script>

                                            <?php
                                            /*echo "Impossible de mettre à jour le mot de passe du membre ".$id_member;*/
                                        }

                                        // Détruire le lien de LINK
                                        // UPDATE password de la table MEMBER pour l'id_member récupéré
                                        /*echo "seconde passss";*/
                                    }
                                    else
                                    {
                                        ?>
                                        <div id="contact" class="anim s01 pg-wrp">
                                          <div class="container">
                                            
                                            <!-- [ TITLE ] -->
                                            <section class="title-wrapper anim fadeInUp s01 delay-0-5s">
                                              <h1 class="h1 title">Mettre à jour votre mot de passe</h1>
                                              <span class="line"></span>
                                              <p>
                                                Bonjour <?php echo $line_member['title']." ".$line_member['first_name']." ".$line_member['last_name']?>,<br>
                                                Veuillez rentrer votre nouveau mot de passe, gardez le précieusement !
                                              </p>
                                            </section>


                                        <form id="cntForm" class="contact-form" action="" method="post" name="updatepassword" accept-charset="utf-8" onsubmit="return validatepasswords(this)" style="max-width:300px; margin-left:auto; margin-right:auto;">
                                            <div class="anim fadeInUp s01 delay-1s">
                                                <div class="input-area">
                                                    <input type="password" name="pass1" id="pass1" class="form-control" placeholder="Mot de passe" required>
                                                </div>
                                            </div>

                                            <div class="anim fadeInUp s01 delay-1-2s">
                                                <div class="input-area">
                                                    <input type="password" name="pass2" id="pass2" class="form-control" onblur="verifpass2(this)" placeholder="Confirmation" required>
                                                </div>
                                            </div>

                                            <div class="anim fadeInUp s01 delay-1-4s">
                                                <div class="button-wrp">
                                                    <button type="submit" name="update" class="btn btn-color" id="submit-1">Mettre à jour</button>
                                                </div>
                                            </div>
                                        </form>
                                        <?php 
                                    }
                                }
                                else
                                {
                                    // Bizarrerie impossible de retrouver le membre demandé
                                    // Peut-être une db corrompue
                                    echo "db corrompue impossible de trouver le membre ".$id_member;
                                }
                            }
                        }
                        else
                        {
                          ?>
                            <section class="title-wrapper anim fadeInUp s01 delay-0-5s">
                              <h1 class="h1 title">Le lien que vous venez de demander n'est plus valide
                              <span class="line"></span>
                              <p>
                              Si vous désirez retrouver votre mot de passe ou le réinitialiser, veuillez renouveler la demande.
                              </p>
                            </section>

                            <script type="text/javascript">
                              function RedirectionJavascript(){
                                document.location.href="<?php echo $HTTP_URL ?>";
                              }
                              setTimeout('RedirectionJavascript()', 7000);
                           </script>

                            <?php
                        }


                        // SELECT entrée table LINK correspond à $id_link
                        // Récupère l'id_member de l'entrée selectionnée 
                        // 
                        // UPDATE password de la table MEMBER pour l'id_member récupéré
                    }
                    else
                    {
                        ?><p>Cette page n'est pas accessible.</p><?php
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
  <script src="../../js/alert_password.js"></script>

</body>
</html>