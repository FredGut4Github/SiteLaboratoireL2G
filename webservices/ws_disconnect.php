<?php require_once('../lib/globals.php');?>
<?php require_once('../lib/connexion.php');?>
<?php require_once('../lib/lib_message_log.php');?>
<?php require_once('../lib/lib_ws.php');?>
<?php

$GROUPS_ALLOWDED = [];

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

try {
	// FIRST VALIDATE THE JWTOKEN
	$payload = ValidateJSONWebToken();
	// VALIDATE THE MEMBER'S RIGHT
	ValidateMemberRights($payload->profile, $GROUPS_ALLOWDED);	
	// VALIDATE THE WEB SERVICE PARAMETERS
	WSDisconnect::ValidateParameters();
}
catch (Exception $e)
{	// 		Token not valid for many reason
	// or	The member is not allowed to use this web service
	// or	The POST parameters are not valid
	exit;
}

// HERE WE GO... EVERYTHING IS DOING WELL ;-)
$id_member = $payload->id;

	// Request succeded
	// Returne code 204 instead of 200 because we have no content to return
	http_response_code(204); // No Content
	LogInfoMessage($dbprotect,$MSG_MODULE_MEMBER,"Member disconnected","Member ".$id_member." disconnected.");


?>
