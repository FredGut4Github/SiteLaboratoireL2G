<?php require_once('../lib/globals.php'); ?>
<?php 
session_start(); // Début de session


if (isset($_SESSION['email'])) 
{ // vérification sur la session authentification (la session est elle enregistrée ?)
  ?>

  <!-- [ CONNEXION PAGE ] -->
<div id="contact" class="anim s01 pg-wrp">
  <div class="container">
    
    <!-- [ TITLE ] -->
    <section class="title-wrapper anim fadeInUp s01 delay-0-5s">
      <h1 class="h1 title">Connexion en cours</h1>
      <span class="line"></span>
      <p>
       Veuillez patienter . . . 
      </p>
    </section>

  <script type="text/javascript">
      function RedirectionJavascript(){
        document.location.href="<?php echo $HTTP_URL ?>pages/session_management/accueil.php";
      }
      setTimeout('RedirectionJavascript()', 2000);
   </script>

  </div>
</div>
<!-- [ CONNEXION PAGE END ]-->

<?php
  //header("Location:$HTTP_URL.'pages/session_management/accueil.php'"); // redirection en cas d'echec
}
else 
{

?>



<!-- [ CONNEXION PAGE ] -->
<div id="contact" class="anim s01 pg-wrp">
  <div class="container">
    
    <!-- [ TITLE ] -->
    <section class="title-wrapper anim fadeInUp s01 delay-0-5s">
      <h1 class="h1 title">Restons connectés !</h1>
      <span class="line"></span>
      <p>
        Si ce n'est pas encore fait, contactez le laboratoire pour pouvoir bénéficier d'un espace personnel !
      </p>
    </section>
    
      
    <form id="cntForm" class="contact-form" action="pages/session_management/check_connexion.php" method="post" accept-charset="utf-8" style="max-width:300px; margin-left:auto; margin-right:auto;">

        <div class="anim fadeInUp s01 delay-1s">
          <div class="input-area">
            <input  type="email" id="email" name="email" class="form-control" placeholder="Identifiant" required>
          </div>
        </div>


        <div class="anim fadeInUp s01 delay-0-9s">
          <div class="input-area">
            <input  type="password" id="password" name="password" class="form-control"  placeholder="Mot de passe" required>
          </div>
        </div>


        <div class="anim fadeInUp s01 delay-1-3s">
          <div class="button-wrp">
            <button type="submit" class="btn btn-color" id="submit-1">Se Connecter</button><br><br><br>

            <a style="color:white; margin-left:auto; margin-right:auto;" data-page="pages/session_management/forgot_password.php" href="pages/session_management/forgot_password.php" >Mot de passe oublié ?</a>
            
          </div>      
        </div>

    </form>

  </div>
</div>
<!-- [ CONNEXION PAGE END ]-->


<?php

}

?>