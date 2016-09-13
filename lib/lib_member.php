<?php require_once('globals.php');?>
<?php require_once('lib_message_log.php');?>
<?php require_once('lib_mail.php');?>
<?php

function GenerateHyperLinkResetPassword($dbconnection, $emailmember)
{
  global $MSG_MODULE_DATABASE;
  global $HTTP_URL;
  $char = 'abcdefghijklmnopqrstuvwxyz0123456789';
  $urlpart = str_shuffle($char);
  if (($result = $dbconnection->query("SELECT id_member FROM MEMBER WHERE email ='$emailmember'")) && ($result->num_rows > 0))
  {
    $line_result = $result->fetch_assoc();
    $id_mbr = $line_result['id_member'];
    $now = getdate();
    $validity_date = $now[0] + (3600*24);
    $str_validity_date = $now['year']."/".$now['mon']."/".$now['mday']." ".$now['hours'].":".$now['minutes'];
    if (($link_result = $dbconnection->query("SELECT * FROM LINK WHERE id_member ='$id_mbr'")) && ($link_result->num_rows > 0))
    {
      $line_result = $link_result->fetch_assoc();
      $urlpart = $line_result['id_link'];
      if (!($link_creation = $dbconnection->query("UPDATE LINK SET validity_date = '$validity_date' WHERE id_member ='$id_mbr'")))
      {
        //Impossible de créer l'entrée, ce qui ne devrait pas arriver
        LogFatalMessage($dbconnection,$MSG_MODULE_DATABASE,"Update LINK error","UPDATE SQL Query failed :\nUPDATE LINK SET validity_date = ".$validity_date." WHERE id_member = ".$id_mbr);
        return $HTTP_URL."pages/session_management/reset_password.php?arg=1";
      }
      LogInfoMessage($dbconnection,$MSG_MODULE_DATABASE,"Member link updated","The link validity date for the member ".$id_mbr." is updated: ".$str_validity_date);
    }
    else
    {
      while (($link_result = $dbconnection->query("SELECT * FROM LINK WHERE id_link ='$urlpart'")) && ($link_result->num_rows > 0))
      {
        $urlpart = str_shuffle($char);
      }
      if (!($link_creation = $dbconnection->query("INSERT INTO LINK (id_link, id_member, validity_date) VALUES ('$urlpart', '$id_mbr', '$validity_date')")))
      {
        //Impossible de créer l'entrée, ce qui ne devrait pas arriver
        LogFatalMessage($dbconnection,$MSG_MODULE_DATABASE,"Insert LINK error","INSERT SQL Query failed :\nINSERT INTO LINK (id_link, id_member, validity_date) VALUES (".$urlpart.", ".$id_mbr.", ".$validity_date.")");
        return  $HTTP_URL."pages/session_management/reset_password.php?arg=2";
      }
      LogInfoMessage($dbconnection,$MSG_MODULE_DATABASE,"Member link created","A new link for the member ".$id_mbr." is created: validity date = ".$str_validity_date);
    }
  }
  else
  { // Cas où le membre avec le mail $emailmember n'existe pas
    // Ne devrait pas arriver
    LogFatalMessage($dbconnection,$MSG_MODULE_DATABASE,"Select LINK error","SELECT SQL Query failed :\nSELECT * FROM LINK WHERE id_member =".$id_mbr);
    return  $HTTP_URL."pages/session_management/reset_password.php?arg=3";
  }
  return  $HTTP_URL."pages/session_management/reset_password.php?id=".$urlpart;
}

function SendMailToNewMember($dbconnection, $sendtoemail, $sendtoname)
{
     // Sujet
     $subject = "Vos informations d'identification";

     // Message
     $message = '
     <html>
      <head>
      <title>Finalisation de votre compte</title>
      '. MailHeader() .'
                                        <!-- TEXT -->
                                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                            <tr>
                                                <td align="center" style="font-size: 25px; font-family: Helvetica, Arial, sans-serif; color: #333333; padding-top: 30px;" class="padding">Finalisation de votre inscription</td>
                                            </tr>
                                            <tr>
                                                <td align="center" style="padding: 20px 0 0 0; font-size: 16px; line-height: 25px; font-family: Helvetica, Arial, sans-serif; color: #666666;" class="padding">Bonjour '.$sendtoname.',<br>
                                                Voici votre identifiant : '.$sendtoemail.'<br><br>
                                                Veuillez cliquer dans les 24 heures sur le lien suivant afin de finaliser la création de votre compte en initialisant votre mot de passe :<br></td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="center">
                                        <!-- BULLETPROOF BUTTON -->
                                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                            <tr>
                                                <td align="center" style="padding-top: 25px;" class="padding">
                                                    <table border="0" cellspacing="0" cellpadding="0" class="mobile-button-container">
                                                        <tr>
                                                            <td align="center" style="border-radius: 3px;" bgcolor="#256F9C"><a href="'. GenerateHyperLinkResetPassword($dbconnection, $sendtoemail) .'" target="_blank" style="font-size: 16px; font-family: Helvetica, Arial, sans-serif; color: #ffffff; text-decoration: none; color: #ffffff; text-decoration: none; border-radius: 3px; padding: 15px 25px; border: 1px solid #256F9C; display: inline-block;" class="mobile-button">C\'est parti &rarr;</a></td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
                <!--[if (gte mso 9)|(IE)]>
                </td>
                </tr>
                </table>
                <![endif]-->
            </td>
        </tr>

       '. MailFooter() .'
</body>
</html>

     ';

     // Pour envoyer un mail HTML, l'en-tête Content-type doit être défini
     $headers  = 'MIME-Version: 1.0' . "\r\n";
     $headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";

     // En-têtes additionnels
     $headers .= 'From: Laboratoire Gutierrez <ghislaine@laboratoire-gutierrez.com>';

     // Envoi
     return mail($sendtoemail, $subject, $message, $headers);
}

function SendMailToResetPassword($dbconnection, $sendtoemail, $sendtoname)
{
     // Sujet
     $subject = 'Réinitialisation de mot de passe';

     // Message
     $message = '
     <html>
      <head>
      <title>Demande de réinitialisation de mot de passe</title>
      '. MailHeader() .'
                                        <!-- TEXT -->
                                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                            <tr>
                                                <td align="center" style="font-size: 25px; font-family: Helvetica, Arial, sans-serif; color: #333333; padding-top: 30px;" class="padding">Réinitialisation de mot de passe</td>
                                            </tr>
                                            <tr>
                                                <td align="center" style="padding: 20px 0 0 0; font-size: 16px; line-height: 25px; font-family: Helvetica, Arial, sans-serif; color: #666666;" class="padding">Bonjour '.$sendtoname.',<br>
                                                Pour rappel, voici votre identifiant : '.$sendtoemail.'<br><br>
                                                Veuillez cliquer dans les 24 heures sur le lien suivant afin de pouvoir réinitialiser votre mot de passe :<br></td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="center">
                                        <!-- BULLETPROOF BUTTON -->
                                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                            <tr>
                                                <td align="center" style="padding-top: 25px;" class="padding">
                                                    <table border="0" cellspacing="0" cellpadding="0" class="mobile-button-container">
                                                        <tr>
                                                            <td align="center" style="border-radius: 3px;" bgcolor="#256F9C"><a href="'. GenerateHyperLinkResetPassword($dbconnection, $sendtoemail) .'" target="_blank" style="font-size: 16px; font-family: Helvetica, Arial, sans-serif; color: #ffffff; text-decoration: none; color: #ffffff; text-decoration: none; border-radius: 3px; padding: 15px 25px; border: 1px solid #256F9C; display: inline-block;" class="mobile-button">C\'est parti &rarr;</a></td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
                <!--[if (gte mso 9)|(IE)]>
                </td>
                </tr>
                </table>
                <![endif]-->
            </td>
        </tr>

       '. MailFooter() .'
</body>
</html>
     ';

     // Pour envoyer un mail HTML, l'en-tête Content-type doit être défini
     $headers  = 'MIME-Version: 1.0' . "\r\n";
     $headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";

     // En-têtes additionnels
     $headers .= 'From: Laboratoire Gutierrez <ghislaine@laboratoire-gutierrez.com>';

     // Envoi
     return mail($sendtoemail, $subject, $message, $headers);
}

function DeleteMember($dbconnection, $idmember)
{
	if ($dbconnection->query("DELETE FROM MEMBER WHERE id_member = '$idmember'"))
	{
		LogInfoMessage($dbconnection,$MSG_MODULE_DATABASE,"Member deleted","The member ".$idmember." is deleted.");
		return true;
	}
	LogCriticalMessage($dbconnection,$MSG_MODULE_DATABASE,"Member not deleted","The member ".$idmember." was not deleted.");
	return false;
}

?>
