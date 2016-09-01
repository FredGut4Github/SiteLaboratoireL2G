<?php require_once('../lib/connexion.php'); ?>
<?php require_once('../lib/lib_member.php');?>
<?php require_once('../lib/lib_mail.php');?>

<html>
<head>
<title>TABLEAU</title>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
</head>

<body>
<style>
table, th, td 
{
    border: 1px solid black;
}
</style>


<?php

$result = $dbprotect->query("SELECT * FROM MEMBER");

?>
<p>Il y a  <?php echo $result->num_rows ?> entrées dans la table MEMBER.</p><br>

<table>
  <tr>
    <th>ID</th><th>Prénom</th><th>Nom</th><th>Email</th><th>URL Part</th><th>ValidityDate</th><th>Supprimer</th>
  </tr>

<?php
while ($line_result = $result->fetch_assoc())
{
  $link_result_id_link = "";
  $link_result_validity_date = "";
  //echo "SELECT * FROM LINK WHERE id_member='".$line_result['id_member']."'";
  $str_query = "SELECT * FROM LINK WHERE id_member='".$line_result['id_member']."'";
 // echo $str_query;
  if (($link_search = $dbprotect->query($str_query)) && ( $link_search->num_rows > 0 ))
  {
    $link_result=$link_search->fetch_assoc();
    $link_result_id_link = $link_result['id_link'];
    $link_result_validity_date = $link_result['validity_date'];
   // echo "lien trouvé ". $link_result_id_link ." " .$link_result_validity_date;
    $array_link_result_validity_date = getdate($link_result_validity_date);
    $str_link_result_validity_date = $array_link_result_validity_date['year']."/".$array_link_result_validity_date['mon']."/".$array_link_result_validity_date['mday']." ".
                                    $array_link_result_validity_date['hours'].":".$array_link_result_validity_date['minutes'];
  }
	?>

	<tr>
	<td><?php echo $line_result['id_member'] ?></td><td><?php echo $line_result['first_name'] ?></td><td><?php echo $line_result['last_name'] ?></td><td><?php echo $line_result['email'] ?></td>
  <td><?php echo $link_result_id_link ?></td><td><?php echo $str_link_result_validity_date ?></td>
	<td>
		<form action="" method="post" name="deletemember">
			<input type="hidden" name="idmember" value="<?php echo $line_result['id_member']?>">
			<button type="submit" name="Delete" class="float">Supprimer</button>
		</form>
	</td>
  	</tr>
<?php
}
?>
</table>






<?php
if (isset($_POST['email']))
{

// on passe toutes les variables $POST en variables
    $email = $_POST['email'];
    $char = 'abcdefghijklmnopqrstuvwxyz0123456789';
    $password = md5(str_shuffle($char));
    $last_name = $_POST['last_name'];
    $first_name = $_POST['first_name'];

// on fait l'INSERT dans la base de données
    if ($add_user =  $dbprotect->query("INSERT INTO MEMBER (email, password, last_name, first_name) VALUES ('$email', '$password', '$last_name', '$first_name')"))
    {
    	
    	?><p>L'opération s'est bien déroulée, le membre <?php echo $add_user ?> a été créé et le mot de passe généré est<?php echo $password ?></p>
    	<?php
    	if (!SendMailToNewMember($dbprotect, $email,$first_name." ".$last_name))
    	{
    		?><p>Une erreur s'est produite lors de l'envoi du mail de notification à <?php echo $email ?></p>
    		<?php
    	}
    }
    else
    {
    	?><p>Une erreur s'est produite</p>
    	<?php
    }
}
else if (isset($_POST['idmember']))
{
	if (!DeleteMember($dbprotect,$_POST['idmember']))
    {
		?><p>Une erreur s'est produite lors de l'envoi du mail de notification à <?php echo $email ?></p>
		<?php
    }
    else
    {
    	?><p>Le membre  <?php echo $_POST['idmember'] ?>a été supprimé</p>
    	<?php
    }
}
?>


<div class="login">
<div class="heading">
  <h2>Ajouter Membre</h2>

    <form action="" method="post" name="addmember">
      

      <div class="input-group input-group-lg">
        <span class="input-group-addon"><i class="fa fa-user"></i></span>
        <input type="text" class="form-control" name="email" id="email" placeholder="Adresse email">
      </div>

      <div class="input-group input-group-lg">
        <span class="input-group-addon"><i class="fa fa-lock"></i></span>
        <input type="text" class="form-control" name="last_name" id="last_name" placeholder="Nom">
      </div>


      <div class="input-group input-group-lg">
        <span class="input-group-addon"><i class="fa fa-lock"></i></span>
        <input type="text" class="form-control" name="first_name" id="first_name" placeholder="Prénom">
      </div>


      <button type="submit" name="Submit" class="float">Ajouter Membre</button>
     </form>

</div>
</div>

</body>
</html>
