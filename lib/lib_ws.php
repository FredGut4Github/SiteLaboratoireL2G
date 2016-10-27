<?php require_once('../lib/JWT.php');?>
<?php 

function RenewJSONWebToken($id,$profile,$delay,$livetime)
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
	         			'id'   		=> $id,			// id from the users table
	         			'profile'	=> $profile,	// id_profile from the users table
	                   ]
	        ];
	$secretKey = base64_decode("Welcome2WebServices4L2G");
	
	/// Here we will transform this array into JWT:
	$jwt = JWT::encode( $data,     //Data to be encoded in the JWT
						$secretKey // The signing key
	                  ); 
	
	return $jwt;
}

function ValidateJSONWebToken()
{
	$allheaders = getallheaders();
	if(isset($allheaders['Jwt']))
	{
		$token = $allheaders['Jwt'];
		$secretKey = base64_decode("Welcome2WebServices4L2G");
	
		try
		{
			$payload = JWT::decode($token,$secretKey,array('HS256'));
			return $payload->data;
		}
		catch (SignatureInvalidException $e)
		{	// WEARED... Token has a wrong signature format
			// Maybe we should do something special here:
			//	- Log in DB
			//  - Send a email
			//	- ...
			http_response_code(401);	// Unauthorized.
			throw $e;
		}
		catch (ExpiredException $e)
		{	// Token has expired
			http_response_code(403); 	// Forbidden. Le serveur a compris la requête, mais refuse de l'exécuter.
			throw $e;
		}
		catch (BeforeValidException $e)
		{	// Token is not operational yet
			http_response_code(449);	// Retry with.
			throw $e;
		}
		catch (Exception $e)
		{	// Token is not valid
			http_response_code(401);	// Unauthorized.
			throw $e;
		}
	}
	else
	{	// No token provided
		http_response_code(401);	// Unauthorized.
		throw new Exception();
	}
}

function ValidateMemberRights($profile,$rightsneeded)
{
	if (empty($rightsneeded))
	{	// No rights defined so anybody is allowed
		return true;
	} 
	elseif (!in_array($profile, $rightsneeded))
	{	// Rights defined but the user pofile is not in
		http_response_code(403);	// Forbidden.
		throw new Excpetion();
	}
	else
	{
		return true;
	}
}


class WSCommonService 
{
		
	protected static function ValidateParameter($method,$param)
	{
		if (!isset($method[$param])) throw new Exception();	
		return true;
	}
	
	
}

class WSForgottenPassword extends WSCommonService
{
	
	public static function ValidateParameters()
	{
		try {
			parent::ValidateParameter($_POST,'email');
			return true;
		}
		catch(Exception $e)
		{	// A mandatory parameter is missing
			http_response_code(501);	// Not Implemented
			throw $e;
		}
	}
	
}

class WSConnect extends WSCommonService
{
	
	public static function ValidateParameters()
	{
		try {
			parent::ValidateParameter($_POST,'email');
			parent::ValidateParameter($_POST,'password');
			return true;
		}
		catch(Exception $e)
		{	// A mandatory parameter is missing
			http_response_code(501);	// Not Implemented
			throw $e;
		}
	}
	
}

class WSDisconnect extends WSCommonService
{
	
	public static function ValidateParameters()
	{
		try {
			return true;
		}
		catch(Exception $e)
		{	// A mandatory parameter is missing
			http_response_code(501);	// Not Implemented
			throw $e;
		}
	}
	
}

class WSAddMember extends WSCommonService
{
	
	public static function ValidateParameters()
	{
		try {
			parent::ValidateParameter($_POST,'email');
			parent::ValidateParameter($_POST,'title');
			parent::ValidateParameter($_POST,'first_name');
			parent::ValidateParameter($_POST,'last_name');
			parent::ValidateParameter($_POST,'id_profile');
			return true;
		}
		catch(Exception $e)
		{	// A mandatory parameter is missing
			http_response_code(501);	// Not Implemented
			throw $e;
		}
	}
	
}

class WSGetMember extends WSCommonService
{
	
	public static function ValidateParameters()
	{
		try {
			parent::ValidateParameter($_POST,'id_member');
			return true;
		}
		catch(Exception $e)
		{	// A mandatory parameter is missing
			http_response_code(501);	// Not Implemented
			throw $e;
		}
	}
	
}

class WSDeleteMember extends WSCommonService
{
	
	public static function ValidateParameters()
	{
		try {
			parent::ValidateParameter($_POST,'id_member');
			return true;
		}
		catch(Exception $e)
		{	// A mandatory parameter is missing
			http_response_code(501);	// Not Implemented
			throw $e;
		}
	}
	
}

class WSUpdateMember extends WSCommonService
{
	
	public static function ValidateParameters()
	{
		try {
			parent::ValidateParameter($_POST,'id_member');
			return true;
		}
		catch(Exception $e)
		{	// A mandatory parameter is missing
			http_response_code(501);	// Not Implemented
			throw $e;
		}
	}
	
}

class WSUpdatePersonalInfo extends WSCommonService
{
	
	public static function ValidateParameters()
	{
		try {
			return true;
		}
		catch(Exception $e)
		{	// A mandatory parameter is missing
			http_response_code(501);	// Not Implemented
			throw $e;
		}
	}
	
}

class WSGetPersonalInfo extends WSCommonService
{
	
	public static function ValidateParameters()
	{
		try {
			return true;
		}
		catch(Exception $e)
		{	// A mandatory parameter is missing
			http_response_code(501);	// Not Implemented
			throw $e;
		}
	}
	
}

class WSListOfMembers extends WSCommonService
{
	
	public static function ValidateParameters()
	{
		try {
			return true;
		}
		catch(Exception $e)
		{	// A mandatory parameter is missing
			http_response_code(501);	// Not Implemented
			throw $e;
		}
	}
	
}

?>
