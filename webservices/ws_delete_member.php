<?php require_once('../lib/globals.php');?>
<?php require_once('../lib/connexion.php');?>
<?php require_once('../lib/lib_member.php');?>
<?php require_once('../lib/lib_message_log.php');?>
<?php require_once('../lib/lib_ws.php');?>
<?php

$GROUPS_ALLOWDED = ['Director'];

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
	
try {
	// FIRST VALIDATE THE JWTOKEN
	$payload = ValidateJSONWebToken();
	// VALIDATE THE MEMBER'S RIGHT
	ValidateMemberRights($payload->profile, $GROUPS_ALLOWDED);	
	// VALIDATE THE WEB SERVICE PARAMETERS
	WSDeleteMember::ValidateParameters();
}
catch (Exception $e)
{	// 		Token not valid for many reason
	// or	The member is not allowed to use this web service
	// or	The POST parameters are not valid
	exit;
}

// HERE WE GO... EVERYTHING IS DOING WELL ;-)

$id_member = $_POST['id_member'];
if (MemberExists($dbprotect,$id_member))
{
	if ($id_member != $payload->id)
	{
		if (DeleteMember($dbprotect,$id_member))
		{	// Request succeded
			// Return code 204 instead of 200 because we have no content to return
			http_response_code(204); // No Content
		  	LogInfoMessage($dbprotect,$MSG_MODULE_MEMBER,"Member deleted","The member ".$id_member." has been deleted.");
		}
		else
		{	// Member not deleted
			// Technical problem
			http_response_code(500); // Internal Server Error
			// DB Log done in DeleteMember function
		}
	}
	else
	{	// The member to delete is the one who is connected
		// The user is not authorized to loggon 
		http_response_code(401); // Unauthorized 
      	LogWarningMessage($dbprotect,$MSG_MODULE_MEMBER,"Delete member request","Cannot delete yourself: id_member(".$id_member.")");
	}
}
else 
{	// Member doesn't exist
	http_response_code(404); // Not Found
	LogWarningMessage($dbprotect,$MSG_MODULE_MEMBER,"Delete member request","No member found with id_member ".$id_member);	
}

?>
