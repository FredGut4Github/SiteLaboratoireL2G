<?php require_once('../lib/connexion.php'); ?>
<?php require_once('../lib/JWT.php'); ?>
<?php

session_start();

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
	
$allheaders = getallheaders();
if(isset($allheaders['Jwt']))
{
	$token = $allheaders['Jwt'];
	$secretKey = base64_decode("SECRETKEY");

	try
	{
		$payload = JWT::decode($token,$secretKey,array('HS256'));
	}
	catch (SignatureInvalidException $e)
	{	// WEARED... Token has a wrong signature format
		// Maybe we should do something special here:
		//	- Log in DB
		//  - Send a email
		//	- ...
		http_response_code(401);	// Unauthorized.
		exit;
	}
	catch (ExpiredException $e)
	{	// Token has expired
		http_response_code(403); 	// Forbidden. Le serveur a compris la requête, mais refuse de l'exécuter.
		exit;
	}
	catch (BeforeValidException $e)
	{	// Token is not operational yet
		http_response_code(449);			// Retry with.
		exit;
	}
	catch (Exception $e)
	{	// Token is not valid
		http_response_code(401);	// Unauthorized.
		exit;
	}

	$result = $dbprotect->query("SELECT * FROM MEMBER ORDER BY last_name");
	
	$outp = "[";
	while($rs = $result->fetch_assoc()) 
	{
	    if ($outp != "[") {$outp .= ",";}
	    $outp .= '{"Id":"'       . $rs["id_member"]  . '",';
	    $outp .= '"EMail":"'     . $rs["email"]      . '",';
	    $outp .= '"Title":"'     . $rs["title"]      . '",';
	    $outp .= '"FirstName":"' . $rs["first_name"] . '",';
	    $outp .= '"LastName":"'  . $rs["last_name"]  . '",';
	    $outp .= '"Phone":"'     . $rs["phone"]      . '",';
	    $outp .= '"Profile":"'   . $rs["id_profile"] . '"}';
	}
	$outp .="]";
	
	echo($outp);
}
else 
{
	http_response_code(404);
	echo "Page not found...\n";
}

?>
