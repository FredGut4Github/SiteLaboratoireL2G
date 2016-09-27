<?php require_once('../lib/globals.php');?>
<?php require_once('../lib/connexion.php');?>
<?php require_once('../lib/JWT.php');?>
<?php require_once('../lib/lib_member.php');?>
<?php require_once('../lib/lib_ws.php');?>
<?php require_once('../lib/lib_message_log.php');?>
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
	WSAddMember::ValidateParameters();
}
catch (Exception $e)
{	// 		Token not valid for many reason
	// or	The member is not allowed to use this web service
	// or	The POST parameters are not valid
	exit;
}

// HERE WE GO... EVERYTHING IS DOING WELL ;-)

// Generate a new password
$char = 'abcdefghijklmnopqrstuvwxyz0123456789';
$password = md5(str_shuffle($char));

// Mandatory parameters
$email = $_POST['email'];
$title = $_POST['title'];
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$profile = $_POST['id_profile'];

// optional parameters
$opt_param_names = "";
$opt_param_values = "";
if (isset($_POST['phone_number']))
{
	$opt_param_names = "phone_number,";
	$opt_param_values = "'".$_POST['phone_number']."',";
}

// Create the new member 
if ($add_user =  $dbprotect->query("INSERT INTO MEMBER ($opt_param_names email, password, title, last_name, first_name, id_profile) VALUES ($opt_param_values '$email', '$password', '$title', '$last_name', '$first_name', '$profile')"))
{
	$friendly_name = trim($title." ".$first_name." ".$last_name);
   	if (SendMailToNewMember($dbprotect, $email, $friendly_name))
   	{	// Request succeded
		// Returne code 204 instead of 200 because we have no content to return
		http_response_code(204); // No Content
      	LogInfoMessage($dbprotect,$MSG_MODULE_MEMBER,"Member created","Member ".$friendly_name." is created and a mail has been sent to ".$email);
   	}
	else
	{	// Request partialy succeded
   		http_response_code(202); // Accepted
		LogWarningMessage($dbprotect,$MSG_MODULE_MEMBER,"No mail sent","Member ".$friendly_name." is created but no mail sent to ".$email);
	}
}
else
{	// A user with the same email already exists
	// OR technical problem with the DB
	http_response_code(409); // Conflict
	$q = "INSERT INTO MEMBER (".$opt_param_name." email, title, last_name, first_name, id_profile) VALUES (".
								$opt_param_values." \'".$email."\', \'".$title."\', \'".$last_name."\', \'".$first_name."\', \'".$profile."\')";
    LogFatalMessage($dbprotect,$MSG_MODULE_DATABASE,"Insert MEMBER error","INSERT INTO SQL Query failed :\n".$q);
}

?>
