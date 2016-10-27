<?php require_once('../lib/connexion.php'); ?>
<?php require_once('../lib/JWT.php'); ?>
<?php require_once('../lib/lib_ws.php'); ?>
<?php

session_start(); // Début de session

?>
<!DOCTYPE html>
<html>
<head>
<title>JWT Connection &amp; Token Test</title>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="css/default.css">
<style>
	#JWTContainer {
		width: auto; 
  		height: 400px;
  		clear: both;
	}
	#JWTToken {
  		width: 400px; 
  		height: 100%;
  		float: left; 
  		margin: 0px;
  		padding: 5px;
  		border: 1px solid grey;
		word-wrap: break-word;
	}
	#JWTArrows {
  		width: 200px; 
  		height: 100%;
  		float: left; 
  		height: 100%;
	}
	#JWTArrows img {
    	display: block;
    	margin-top: 180px;
    	margin-left: auto;
    	margin-right: auto
	}
	#JWTDecodedContainer {
  		width: 400px; 
  		height: 100%;
  		float: left; 
  		margin:0px; 
	}
	#JWTHeaderArea {
  		border: 1px solid grey;
		word-wrap: break-word;
	    height: 120px;
	    padding: 5px;
	}
	#JWTPayloadArea {
  		border: 1px solid grey;
		word-wrap: break-word;
		height: 200px;
		padding: 5px;
		margin-top: 10px;
	}
	#JWTSignatureArea {
  		border: 1px solid grey;
		word-wrap: break-word;
		margin-top: 10px;
		padding: 5px;
		height: 35px;
	}
</style>
</head>
<body>

	<h1>JWT Connection &amp; Token Test</h1>

	<h2>WEB Session</h2>
<?php




if (isset($_POST['onActionDisconnect']))
{
	session_unset();
	session_destroy();
}
else if (isset($_POST['onActionRenewToken']))
{
	if (isset($_SESSION['jwt']))
	{
		RenewJSONWebToken($_SESSION['id_member'],$_SESSION['id_profile'],0,3600);
		// Déclaration des variables de session
		$_SESSION['jwt'] = $jwt;
	}
}
else if (isset($_POST['onActionConnect']))
{
	$email = addslashes($_POST['email']); 				// Mise en variable du nom d'utilisateur
	$password = addslashes(md5($_POST['password'])); 	// Mise en variable du mot de passe chiffré à l'aide de md5
	
	// Requete sur la table administrateurs (on récupère les infos de la personne)
	if ($result = $dbprotect->query("SELECT * FROM MEMBER WHERE email='$email' AND password='$password'"))
	{
		if ( $result->num_rows == 1 ) // Si une seule et unique adresse mail et pass correspondent (pas 0, pas 2)
		{
			$r = $result->fetch_assoc(); // On récupère la ligne en cours
			 
			RenewJSONWebToken($r['id_member'],$r['id_profile'],0,3600);
			// Déclaration des variables de session
			$_SESSION['jwt'] = $jwt;

			// Déclaration des variables de session
			$_SESSION['id_member'] 	= $r['id_member']; 
			$_SESSION['email'] 		= $r['email'];
			$_SESSION['title'] 		= $r['title'];
			$_SESSION['first_name']	= $r['first_name'];
			$_SESSION['last_name'] 	= $r['last_name'];
			$_SESSION['id_profile']	= $r['id_profile'];
		}
		else 
		{
			http_response_code(401);

?>
	<p>Member not found. Please retry...</p>
<?php			

		}
	}
	else
	{
		http_response_code(404);

?>
	<p>Technical problem. Please retry later...</p>
<?php			

	}
}



if (isset($_SESSION['jwt']))
{
	$member_name = trim($_SESSION['title'].' '.$_SESSION['first_name'].' '.$_SESSION['last_name']);
	$jwt = $_SESSION['jwt'];
	
    $tks = explode('.', $jwt);
    if (count($tks) != 3) {
        throw new UnexpectedValueException('Wrong number of segments');
    }
    list($headb64, $bodyb64, $cryptob64) = $tks;
    if (null === ($header = JWT::jsonDecode(JWT::urlsafeB64Decode($headb64)))) {
        throw new UnexpectedValueException('Invalid header encoding');
    }
    if (null === $payload = JWT::jsonDecode(JWT::urlsafeB64Decode($bodyb64))) {
        throw new UnexpectedValueException('Invalid claims encoding');
    }
	
?>
	<form action="" method="post">
		<p>Welcome <?php echo $member_name; ?> ... please <input name="onActionDisconnect" type="submit" class="submitLink" value="disconnect"/> when you want or <input name="onActionRenewToken" type="submit" class="submitLink" value="renew"/> your JSON Web Token.</p>
	</form>

	<h2>JSON Web Token</h2>
	<div id="JWTContainer">
		<div id="JWTToken">
			<code contenteditable="true"><span style="color: blue"><?php echo $headb64; ?></span>.<span style="color: green"><?php echo $bodyb64; ?></span>.<span style="color: red"><?php echo $cryptob64; ?></span></code>
		</div>
		<div id="JWTArrows">
			<img src="../images/Divers/49149.jpg" />
		</div>
		<div id="JWTDecodedContainer">
			<div id="JWTHeaderArea">
				<code contenteditable="true"><span style="color: blue"><?php var_dump($header); ?></span></code>
			</div>
			<div id="JWTPayloadArea">
				<code contenteditable="true"><span style="color: green"><?php var_dump($payload); ?></span></code>
			</div>
			<div id="JWTSignatureArea">
				<code contenteditable="true"><span style="color: red"><?php echo $cryptob64; ?></span></code>
			</div>
		</div>
	</div>
<?php

}
else
{
	
?>
	<form action="" method="post">
		<input name="email" type="text" placeholder="email"/>
		<input name="password" type="password" placeholder="password"/>
		<input name="onActionConnect" type="submit" value="Connect"/>
	</form>	
<?php

}

?>
</body>
</html> 
