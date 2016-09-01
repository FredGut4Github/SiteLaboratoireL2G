function surligne(champ, erreur)
{
   if(erreur)
      champ.style.backgroundColor = "#ff4343";
   else
      champ.style.backgroundColor = "#01dd1b";
}
 
function verifpass2(champ)
{  
   if(champ.value != document.getElementById('pass1').value)
   {
      alert("Vos mots de passe ne sont pas identiques !");
      surligne(champ, true);
      return false;
   }
   else
   {
      surligne(champ, false);
      return true;
   }
}


function validatepasswords(champ)
{
   return verifpass2(document.getElementById('pass2'));
}