<?php require_once('../../lib/globals.php');?>
<?php require_once('../../lib/connexion.php');?>
<?php session_start(); ?>

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

<?php require('page_footer.html'); ?>
