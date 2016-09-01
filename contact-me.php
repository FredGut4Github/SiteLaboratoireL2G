<?php
  
$name = $_POST['name'];
$email_address = $_POST['email'];
$message = $_POST['message'];

echo $name;
echo $email_address;
echo $message;
$to = 'yann.btg@gmail.com, frederic@famille-gutierrez.com, hk.yonix@gmail.com'; //Just write your email
$email_subject = "Message de la page de contact de:  $name";
$email_body = "Vous avez reçu un nouveau message ! <br/>".
        "En voici les détails: <br/><br/> Nom:<br/> $name <br/><br/><br/>".
          "Email:<br/> $email_address <br/><br/><br/> Message: <br/> $message";
$headers="From: <$email_address>\n";
$headers.="Content-Type:text/html; charset=UTF-8";
if($email_address != "") {
  mail($to,$email_subject,$email_body,$headers);
  return true;
}

?>