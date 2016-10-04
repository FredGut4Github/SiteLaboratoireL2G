<?php require_once('../lib/globals.php');?>
<?php require_once('../lib/connexion.php');?>
<?php require_once('../lib/lib_message_log.php');?>
<?php require_once('../lib/lib_ws.php');?>
<?php

$GROUPS_ALLOWDED = [];

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

try {
	// VALIDATE THE WEB SERVICE PARAMETERS
	WSConnect::ValidateParameters();
}
catch (Exception $e)
{	// 		Token not valid for many reason
	// or	The member is not allowed to use this web service
	// or	The POST parameters are not valid
	exit;
}

// HERE WE GO... EVERYTHING IS DOING WELL ;-)

$email 		= addslashes($_POST['email']); 			// The member's email
$password 	= addslashes(md5($_POST['password'])); 	// The member's password to check

if ($result = $dbprotect->query("SELECT * FROM MEMBER WHERE email='$email' AND password='$password'"))
{
	if ( $result->num_rows == 1 ) 
	{	// We found only 1 member AND the password is OK
		// Let's continue and deal with JSON Web Token
		
		// Retrieve member's data
		$r = $result->fetch_assoc();
		
		// Create a new JWT and send it
		$jwt = RenewJSONWebToken($r['id_member'],$r['id_profile'],0,3600);
		$unencodedArray = ["jwt" => $jwt];
		echo json_encode($unencodedArray);
      	LogInfoMessage($dbprotect,$MSG_MODULE_MEMBER,"Member connected","Member ".$r['id_member'].": profile(".$r['id_profile'].")");
	}
	else 
	{	// Wrong login OR password
		// The user is not authorized to loggon 
		http_response_code(401); // Unauthorized 
      	LogWarningMessage($dbprotect,$MSG_MODULE_MEMBER,"Member connection failed","Someone try to connect with email: ".$email);
	}
}
else
{	// The SQL query failed
	// Technical problem
	http_response_code(500); // Internal Server Error
    LogFatalMessage($dbconnection,$MSG_MODULE_DATABASE,"Select MEMBER error","SELECT SQL Query failed :\nSELECT * FROM MEMBER WHERE email =".$email);
}

?>
