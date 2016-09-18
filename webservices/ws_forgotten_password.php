<?php require_once('../lib/globals.php');?>
<?php require_once('../lib/connexion.php');?>
<?php require_once('../lib/lib_member.php');?>
<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
	
if (isset($_POST['email']))
{
	$email = $_POST['email'];
	if ($check_user =  $dbprotect->query("SELECT id_member, title, first_name, last_name FROM MEMBER WHERE email ='$email'"))
	{
		if ($check_user->num_rows > 0)
		{	// One member found
			// Send the email to reset the password
			
			$member_found = $check_user->fetch_assoc();
			$friendly_name = trim($member_found['title']." ".$member_found['first_name']." ".$member_found['last_name']);
			
			if (!SendMailToResetPassword($dbprotect, $email, $friendly_name))
			{	// The mail was not sent... technical problem 
				http_response_code(500); // Internal Server Error
			}
			
			// Request succeded
			// Returne code 204 instead of 200 because we have no content to return
			http_response_code(204); // No Content
		}
		else
		{	// No member found
			// The email is not valid
			http_response_code(404); // Not Found
		}
	}
	else
	{	// The SQL query failed
		// Technical problem
		http_response_code(500); // Internal Server Error
	}
}
else
{	// Bad Web Service Usage
	// No post argument
	http_response_code(501); // Not Implemented
}

?>
