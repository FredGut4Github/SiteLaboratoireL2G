<?php require_once('../lib/globals.php');?>
<?php require_once('../lib/connexion.php');?>
<?php require_once('../lib/lib_member.php');?>
<?php require_once('../lib/lib_message_log.php');?>
<?php require_once('../lib/lib_ws.php');?>
<?php

$GROUPS_ALLOWDED = [];

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
	
try {
	// VALIDATE THE WEB SERVICE PARAMETERS
	WSForgottenPassword::ValidateParameters();
}
catch (Exception $e)
{	// 		Token not valid for many reason
	// or	The member is not allowed to use this web service
	// or	The POST parameters are not valid
	exit;
}

// HERE WE GO... EVERYTHING IS DOING WELL ;-)

$email = $_POST['email'];
if ($check_user =  $dbprotect->query("SELECT id_member, title, first_name, last_name FROM MEMBER WHERE email ='$email'"))
{
	if ($check_user->num_rows > 0)
	{	// One member found
		// Send the email to reset the password
		
		$member_found = $check_user->fetch_assoc();
		$friendly_name = trim($member_found['title']." ".$member_found['first_name']." ".$member_found['last_name']);
		
		if (SendMailToResetPassword($dbprotect, $email, $friendly_name))
		{	// Request succeded
			// Returne code 204 instead of 200 because we have no content to return
			http_response_code(204); // No Content
	      	LogInfoMessage($dbprotect,$MSG_MODULE_MEMBER,"Password request","An email has been sent to ".$email);
		}
		else
		{	// The mail was not sent... technical problem 
			http_response_code(500); // Internal Server Error
			LogWarningMessage($dbprotect,$MSG_MODULE_MEMBER,"Password request","Cannot send an email to ".$email);
		}
	}
	else
	{	// No member found
		// The email is not valid
		http_response_code(404); // Not Found
		LogWarningMessage($dbprotect,$MSG_MODULE_MEMBER,"Password request","No member found with email ".$email);
	}
}
else
{	// The SQL query failed
	// Technical problem
	http_response_code(500); // Internal Server Error
	$q = "SELECT id_member, title, first_name, last_name FROM MEMBER WHERE email =\'".$email."\'";
    LogFatalMessage($dbprotect,$MSG_MODULE_DATABASE,"Insert MEMBER error","SELECT SQL Query failed :\n".$q);
}

?>
