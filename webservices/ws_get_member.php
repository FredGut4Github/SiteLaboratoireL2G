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
	WSGetMember::ValidateParameters();
}
catch (Exception $e)
{	// 		Token not valid for many reason
	// or	The member is not allowed to use this web service
	// or	The POST parameters are not valid
	exit;
}

// HERE WE GO... EVERYTHING IS DOING WELL ;-)

// Mandatory parameters
$id_member = $_POST['id_member'];
if (MemberExists($dbprotect,$id_member))
{
	$set_request_part = "";
	
	// optional parameters
	if (isset($_POST['phone_number']))
	{
		$opt_param_names = "phone_number";
		$set_request_part = $set_request_part.$opt_param_names;
	}
	if (isset($_POST['email']))
	{
		if ($set_request_part !== "") $set_request_part = $set_request_part.", ";
		$opt_param_names = "email";
		$set_request_part = $set_request_part.$opt_param_names;
	}
	if (isset($_POST['title']))
	{
		if ($set_request_part !== "") $set_request_part = $set_request_part.", ";
		$opt_param_names = "title";
		$set_request_part = $set_request_part.$opt_param_names;
	}
	if (isset($_POST['first_name']))
	{
		if ($set_request_part !== "") $set_request_part = $set_request_part.", ";
		$opt_param_names = "first_name";
		$set_request_part = $set_request_part.$opt_param_names;
	}
	if (isset($_POST['last_name']))
	{
		if ($set_request_part !== "") $set_request_part = $set_request_part.", ";
		$opt_param_names = "last_name";
		$set_request_part = $set_request_part.$opt_param_names;
	}
	if (isset($_POST['id_profile']))
	{
		if ($set_request_part !== "") $set_request_part = $set_request_part.", ";
		$opt_param_names = "id_profile";
		$set_request_part = $set_request_part.$opt_param_names;
	}

	if ($set_request_part !== "")
	{
		if ( (!($result = $dbprotect->query("SELECT $set_request_part FROM MEMBER WHERE id_member ='$id_member'"))) || ($result->num_rows != 1) )
		{	//Impossible de modifier l'entrée, ce qui ne devrait pas arriver
			http_response_code(500); // Internal Server Error
			LogFatalMessage($dbprotect,$MSG_MODULE_DATABASE,"SELECT MEMBER error","SELECT SQL Query failed :\nSELECT ".$set_request_part." FROM MEMBER WHERE id_member = ".$id_member);
			exit;
		}
		// Request succeded
		// Build the JSON response
		$r = $result->fetch_assoc();
		
		$unencodedArray = [];
		if (isset($_POST['phone_number']))
		{
			$unencodedArray['phone_number'] = $r['phone_number'];
		}
		if (isset($_POST['email']))
		{
			$unencodedArray['email'] = $r['email'];
		}
		if (isset($_POST['title']))
		{
			$unencodedArray['title'] = $r['title'];
		}
		if (isset($_POST['first_name']))
		{
			$unencodedArray['first_name'] = $r['first_name'];
		}
		if (isset($_POST['last_name']))
		{
			$unencodedArray['last_name'] = $r['last_name'];
		}
		if (isset($_POST['id_profile']))
		{
			$unencodedArray['id_profile'] = $r['id_profile'];
		}
		echo json_encode($unencodedArray);

		// Returne code 200 OK
		http_response_code(200); // OK
      	LogInfoMessage($dbprotect,$MSG_MODULE_MEMBER,"Get personal info updated","The member (".$id_member.") has been retreived.");
	}
	else
	{	// Nothing to get
		http_response_code(204); // Not Content
		LogInfoMessage($dbprotect,$MSG_MODULE_MEMBER,"Get personal info request","Nothing to get for member ".$id_member);
	}
}
else 
{	// Member doesn't exist
	http_response_code(404); // Not Found
	LogCriticalMessage($dbprotect,$MSG_MODULE_MEMBER,"Get personal info request","No member found with id_member ".$id_member);
}

?>
