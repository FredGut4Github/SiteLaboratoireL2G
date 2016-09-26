<?php require_once('../lib/globals.php');?>
<?php require_once('../lib/connexion.php');?>
<?php require_once('../lib/JWT.php');?>
<?php require_once('../lib/lib_member.php');?>
<?php require_once('../lib/lib_ws.php');?>
<?php require_once('../lib/lib_message_log.php');?>
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
	WSUpdatePersonalInfo::ValidateParameters();
}
catch (Exception $e)
{	// 		Token not valid for many reason
	// or	The member is not allowed to use this web service
	// or	The POST parameters are not valid
	exit;
}

// HERE WE GO... EVERYTHING IS DOING WELL ;-)

// Mandatory parameters
$id_member = $payload->id;
if (MemberExists($dbprotect,$id_member))
{
	$set_request_part = "";
	
	// optional parameters
	if (isset($_POST['phone_number']))
	{
		$opt_param_names = "phone_number";
		$opt_param_values = "'".$_POST['phone_number']."'";
		$set_request_part = $set_request_part.$opt_param_names."=".$opt_param_values;
	}
	if (isset($_POST['email']))
	{
		if ($set_request_part !== "") $set_request_part = $set_request_part.", ";
		$opt_param_names = "email";
		$opt_param_values = "'".$_POST['email']."'";
		$set_request_part = $set_request_part.$opt_param_names."=".$opt_param_values;
	}
	if (isset($_POST['title']))
	{
		if ($set_request_part !== "") $set_request_part = $set_request_part.", ";
		$opt_param_names = "title";
		$opt_param_values = "'".$_POST['title']."'";
		$set_request_part = $set_request_part.$opt_param_names."=".$opt_param_values;
	}
	if (isset($_POST['first_name']))
	{
		if ($set_request_part !== "") $set_request_part = $set_request_part.", ";
		$opt_param_names = "first_name";
		$opt_param_values = "'".$_POST['first_name']."'";
		$set_request_part = $set_request_part.$opt_param_names."=".$opt_param_values;
	}
	if (isset($_POST['last_name']))
	{
		if ($set_request_part !== "") $set_request_part = $set_request_part.", ";
		$opt_param_names = "last_name";
		$opt_param_values = "'".$_POST['last_name']."'";
		$set_request_part = $set_request_part.$opt_param_names."=".$opt_param_values;
	}

	if ($set_request_part !== "")
	{
		if (!($result = $dbprotect->query("UPDATE MEMBER SET $set_request_part WHERE id_member ='$id_member'")))
		{	//Impossible de modifier l'entrée, ce qui ne devrait pas arriver
			http_response_code(500); // Internal Server Error
			LogFatalMessage($dbprotect,$MSG_MODULE_DATABASE,"Update MEMBER error","UPDATE SQL Query failed :\nUPDATE MEMBER SET ".$set_request_part." WHERE id_member = ".$id_member);
		}
		// Request succeded
		// Returne code 204 instead of 200 because we have no content to return
		http_response_code(204); // No Content
      	LogInfoMessage($dbprotect,$MSG_MODULE_MEMBER,"Personal info updated","The member (".$id_member.") has been updated");
	}
	else
	{	// Nothing to update
		http_response_code(304); // Not Modified
		LogInfoMessage($dbprotect,$MSG_MODULE_MEMBER,"Update personal info request","Nothing to update for member ".$id_member);
	}
}
else 
{	// Member doesn't exist
	http_response_code(404); // Not Found
	LogCriticalMessage($dbprotect,$MSG_MODULE_MEMBER,"Update personal info request","No member found with id_member ".$id_member);
}

?>
