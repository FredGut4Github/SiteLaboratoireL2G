<?php require_once('../lib/globals.php');?>
<?php require_once('../lib/connexion.php');?>
<?php require_once('../lib/JWT.php');?>
<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

function RenewJSONWebToken($id,$delay,$livetime)
{
	$tokenId    = base64_encode(mcrypt_create_iv(32));
	$issuedAt   = time();
	$notBefore  = $issuedAt + $delay;  //Adding 10 seconds
	$expire     = $notBefore + $livetime; // Adding 60 seconds
	$serverName = 'http://www.laboratoire-gutierrez.com/webservices/'; /// set your domain name 
	 
	/*
	 * Create the token as an array
	 */
	$data = [
	         'iat'  => $issuedAt,         // Issued at: time when the token was generated
	         'jti'  => $tokenId,          // Json Token Id: an unique identifier for the token
	         'iss'  => $serverName,       // Issuer
	         'nbf'  => $notBefore,        // Not before
	         'exp'  => $expire,           // Expire
	         'data' => [                  // Data related to the logged user you can set your required data
	         			'id'   => $id, // id from the users table
	                   ]
	        ];
	$secretKey = base64_decode("Welcome2WebServices4L2G");
	
	/// Here we will transform this array into JWT:
	$jwt = JWT::encode( $data,     //Data to be encoded in the JWT
						$secretKey // The signing key
	                  ); 
	
	return $jwt;
}

if (isset($_POST['email']) && isset($_POST['password']))
{
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
			$jwt = RenewJSONWebToken($r['id_member'],0,3600);
			$unencodedArray = ["jwt" => $jwt];
			echo json_encode($unencodedArray);
		}
		else 
		{	// Wrong login OR password
			// The user is not authorized to loggon 
			http_response_code(401); // Unauthorized 
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
