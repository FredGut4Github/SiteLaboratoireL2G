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
	WSListOfMembers::ValidateParameters();
}
catch (Exception $e)
{	// 		Token not valid for many reason
	// or	The member is not allowed to use this web service
	// or	The POST parameters are not valid
	exit;
}

// HERE WE GO... EVERYTHING IS DOING WELL ;-)

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
	$set_request_part = "id_member, ".$set_request_part;
}
else
{
	$set_request_part = "*";
}

if ($result = $dbprotect->query("SELECT $set_request_part FROM MEMBER"))
{	// Request succeded
	// Parse the result and build the JSON response
	$unencodedArray = [];
	$nb_members = 0;
	while($rs = $result->fetch_assoc()) 
	{
		$unencodedMemberArray = [];
		foreach ($rs as $key => $value) 
		{
			if ($key !== 'password') $unencodedMemberArray[$key] = $value;
		}
		$unencodedArray[$rs['id_member']] = $unencodedMemberArray;
		$nb_members += 1;
	}
	echo json_encode($unencodedArray);

	// Returne code 200 OK
	http_response_code(200); // OK
  	LogInfoMessage($dbprotect,$MSG_MODULE_MEMBER,"List of members",$nb_members." members retreived.");
}
else
{	//Impossible de modifier l'entrée, ce qui ne devrait pas arriver
	http_response_code(500); // Internal Server Error
	LogFatalMessage($dbprotect,$MSG_MODULE_DATABASE,"SELECT MEMBER error","SELECT SQL Query failed :\nSELECT ".$set_request_part." FROM MEMBER WHERE id_member = ".$id_member);
}

?>
