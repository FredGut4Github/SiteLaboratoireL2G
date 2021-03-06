<?php

session_start();

?>
<!DOCTYPE html>

<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<link rel="stylesheet" type="text/css" href="css/default.css">
	<style>
		table, th , td {
		    border: 0px;
		    border-collapse: collapse;
		    padding: 5px;
		}
		#WSPostParams{
			width: 500px;
		}
		#idTable {
			width: 100%;
		}
		#idTable tr:nth-child(odd) {
    		background-color: #ffffff;
		}
		#idTable th {
			font-size: smaller;
			text-align: left;
		}
		#idTable input {
			width: 100%;
		}
		#WSPostButton {
			float: right;
		}
		#WSAnswerCodeLine{
			display: none;
		}
		#WSAnswerContentLine{
			display: none;
		}
		.WSAnswerLine {
		  	clear:both;
		}
		.WSAnswerLabel {
		  	float:left;
		  	width:150px;
			padding: 2px;
			margin: 5px;
		}
		.WSAnswerValue {
		  	float:left;
		  	word-wrap: break-word;
			width: 1000px;
			padding: 2px;
			margin: 5px;
			border: 1px solid lightgray;
		}
	</style>

	<title>Web Services</title>

	<script type="text/javascript">

	function createCookie(name,value,days) {
	    if (days) {
	        var date = new Date();
	        date.setTime(date.getTime()+(days*24*60*60*1000));
	        var expires = "; expires="+date.toGMTString();
	    }
	    else var expires = "";
	    document.cookie = name+"="+value+expires+"; path=/";
	}
	
	function readCookie(name) {
	    var nameEQ = name + "=";
	    var ca = document.cookie.split(';');
	    for(var i=0;i < ca.length;i++) {
	        var c = ca[i];
	        while (c.charAt(0)==' ') c = c.substring(1,c.length);
	        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
	    }
	    return null;
	}
	
	function eraseCookie(name) {
	    createCookie(name,"",-1);
	}

	function friendly_http_response_code(code)
	{
		var code_table = {
			100 : 'Continue',						//	Waiting for the end part of the request.
													//	The initial part of the request has been received and the client may continue with its request.
			101 : 'Switching Protocols',			//	The server is complying with a client request to switch protocols to the one specified in the Upgrade header field.
													//	The client asked the server to use another protocol than the one actually used, and the server complied this request.
			200 : 'OK',								//	The HTTP request has succeeded.
													//	The information returned with the response is dependent on the method used in the request. For example the response to a standard GET request issued by a web browser is the requested resource (i.e. an HTML page, an image, etc).
			201 : 'Created',						//	The request has been fulfilled and resulted in a new resource being created.
													//	The newly created resource can be referenced by the URI(s) returned in the entity of the response, with the most specific URL for the resource given by a Location header field.
			202 : 'Accepted',						//	The request has been accepted for processing, but the processing has not been completed.
													//	This code is used instead of 201 when the processing of the request cannot be carried out immediately, leaving the result undetermined.
			203 : 'Non-Authoritative Information',	//	Usually the preliminary information sent from a server to a browser comes directly from the server. If it does not, then this code might also be sent to indicate that information did not come from a known source.
			204 : 'No Content',						//	The request was accepted and filled but no new information is being sent back.
													//	The browser receiving this response should not change its screen display (although new, and changed, private header information may be sent).
			205 : 'Reset Content',					//	The browser should clear the form used for this transaction for additional input.
													//	Appropriate for data-entry CGI applications.
			206 : 'Partial Content',				//	The server is returning partial data of the size requested.
													//	Used in response to a request specifying a Range header. The server must specify the range included in the response with the Content-Range header.
			300 : 'Multiple Choices',				//	The requested URI refers to more than one resource.
													//	For example, the URI could refer to a document that has been translated into many languages. The entity body returned by the server could have a list of more specific data about how to choose the correct resource.
			301 : 'Moved Permanently',				//	The requested resource has been assigned a new permanent address (URI).
													//	Any future references to this resource should be done using one of the returned URIs. Web browsers should automatically load the requested resource using its new address.
			302 : 'Moved Temporarily',				//	The requested resource resides temporarily under a different URI.
													//	Since the redirection may be altered on occasion, the client should continue to use the Request-URI for future requests.
			303 : 'See Other',						//	The requested URI can be found at a different URI (specified in the Location header) and should be retrieved by a GET on that resource.
			304 : 'Not Modified',					//	The web browser has performed a conditional GET request and access is allowed, but the document has not been modified.
													//	This classic response means you have configured your web browser to use an HTTP cache (proxy) in which a copy of the requested document is already stored. The cache proxy thus asked the server if the original document was modified, and received this response, so it will use the local copy instead of loading it from the server.
			305 : 'Use Proxy',						//	The requested URI must be accessed through the proxy in the Location header.
			400 : 'Bad Request',					//	The HTTP request could not be understood by the server due to malformed syntax.
													//	The web browser may be too recent, or the HTTP server may be too old.
			401 : 'Unauthorized',					//	The request requires user authentication.
													//	This means that all or a part of the requested server is protected by a password that should be given to the server to allow access to its contents.
			402 : 'Payment Required',				//	This code is not yet implemented in HTTP.
			403 : 'Forbidden',						//	The HTTP server understood the request, but is refusing to fulfill it.
													//	This status code is commonly used when the server does not wish to reveal exactly why the request has been refused, or when no other response is applicable (for example the server is an Intranet and only the LAN machines are authorized to connect).
			404 : 'Not Found',						//	The server has not found anything matching the requested address (URI) ( not found ).
													//	This means the URL you have typed or cliked on is wrong or obsolete and does not match any document existing on the server (you may try to gradualy remove the URL components from the right to the left to eventualy retrieve an existing path).
			405 : 'Method Not Allowed',				//	This code is given with the Allow header and indicates that the method used by the client is not supported for this URI.
			406 : 'Not Acceptable',					//	The URI specified by the client exists, but not in a format preferred by the client.
													//	Along with this code, the server provides the Content-Language, Content-Encoding, and Content-Type headers.
			407 : 'Proxy Authentication Required',	//	The proxy server needs to authorize the request before forwarding it.
			408 : 'Request Time-out',				//	This response code means the client did not produce a full request within some predetermined time (usually specified in the server's configuration), and the server is disconnecting the network connection.
			409 : 'Conflict',						//	This code indicates that the request conflicts with another request or with the server's configuration.
													//	Information about the conflict should be returned in the data portion of the reply.
			410 : 'Gone',							//	This code indicates that the requested URI no longer exists and has been permanently removed from the server.
			411 : 'Length Required',				//	The server will not accept the request without a Content-Length header supplied in the request.
			412 : 'Precondition Failed',			//	The condition specified by one or more If... headers in the request evaluated to false.
			413 : 'Request Entity Too Large',		//	The server will not process the request because its entity body is too large.
			414 : 'Request-URI Too Long',			//	The server will not process the request because its request URI is too large.
			415 : 'Unsupported Media Type',			//	The server will not process the request because its entity body is in an unsupported format.
			416 : 'Requested range unsatifiable',	//	The server will not process the request because the requested range is invalid.
			417 : 'Expectation failed',				//	The behavior expected fot the server is not supported.
			500 : 'Internal Server Error',			//	The HTTP server encountered an unexpected condition which prevented it from fulfilling the request.
													//	For example this error can be caused by a serveur misconfiguration, or a resource exhausted or denied to the server on the host machine.
			501 : 'Not Implemented',				//	The HTTP server does not support the functionality required to fulfill the request.
													//	This is the appropriate response when the server does not recognize the request method and is not capable of supporting it for any resource (either the web browser is too recent, or the HTTP server is too old).
			502 : 'Bad Gateway',					//	The gateway server returned an invalid response.
													//	The HTTP server, while acting as a gateway or proxy, received an invalid response from the upstream server it accessed in attempting to fulfill the request.
			503 : 'Service Unavailable',			//	The HTTP server is currently unable to handle the request due to a temporary overloading or maintenance of the server.
													//	The implication is that this is a temporary condition which will be alleviated after some delay.
			504 : 'Gateway Time-out',				//	This response is like 408 (Request Time-out) except that a gateway or proxy has timed out.
			505 : 'HTTP Version not supported'		//	The server will not support the HTTP protocol version used in the request.
		};
		if (code_table.hasOwnProperty(code))
			return "HTTP/1.1 " + code + " " + code_table[code];
		else
			return "HTTP/1.1 " + code + " Unknown HTTP return code... please log a GitHub issue to resolve the problem.";
	}
	
	function insererLigne_Fin()
	{
	    var cell, ligne;
	 
	    // on récupère l'identifiant (id) de la table qui sera modifiée
	    var tableau = document.getElementById("idTable");
	    // nombre de lignes dans la table (avant ajout de la ligne)
	    var nbLignes = tableau.rows.length;
	    var newLigne = nbLignes; // due to header
	 
	    ligne = tableau.insertRow(-1); // création d'une ligne pour ajout en fin de table
	                                   // le paramètre est dans ce cas (-1)
	 
	    // création et insertion des cellules dans la nouvelle ligne créée
	    cell = ligne.insertCell(0);
	    cell.innerHTML = "<input id=\"varname" + newLigne + "\" name=\"varname" + newLigne + "\" type=\"text\" placeholder=\"parameter name\" onchange=\"onVarNameChange(" + newLigne + ")\" />";
	 
	    cell = ligne.insertCell(1);
	    cell.innerHTML = "<input id=\"varvalue" + newLigne + "\" name=\"toreplace" + newLigne + "\" type=\"text\" placeholder=\"parameter value\"/>";
	}
	
	function onSelectChange()
	{
    	//document.wsform.action = document.getElementById("wsselect").value;
	}
	
	function onVarNameChange(i)
	{
		//document.getElementById("varvalue"+i).name = document.getElementById("varname"+i).value;
	}
	
	function postOnClick()
	{
	    var http = new XMLHttpRequest();
	
	    // on récupère l'identifiant (id) de la table qui sera modifiée
	    var tableau = document.getElementById("idTable");
	    var nbLignes = tableau.rows.length;

		var params = "";
		for (var i = 1; i <= nbLignes-1; i++) {
			params += document.getElementById("varname"+i).value + "=" + document.getElementById("varvalue"+i).value;
			if (i < nbLignes-1) params += "&";
		}
	
	    http.open("POST", document.getElementById("wsselect").value, true);
	
	    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	    http.setRequestHeader("Content-length", params.length);
	    http.setRequestHeader("Connection", "close");
<?php
		if (isset($_SESSION["jwt"]))
		{
?>
		http.setRequestHeader("Jwt","<?php echo $_SESSION["jwt"]; ?>");
<?php
		}
?>
	
	    http.onreadystatechange = function() {
	        if (http.readyState == 4)
	        {
	        	document.getElementById("WSAnswerCodeLine").style.display = 'block';
	        	document.getElementById("WSResponseCode").innerHTML = friendly_http_response_code(http.status);
	        	switch (http.status)
	        	{
	        		case 200:
			        	document.getElementById("WSAnswerContentLine").style.display = 'block';
	        			document.getElementById("WSResponseContent").innerHTML = http.responseText;
	        			break;
	        		default:
			        	document.getElementById("WSAnswerContentLine").style.display = 'none';
	        			break;
	        	}
	        }
	    }
	
	    http.send(params);
	}

	</script>
</head>

<body>
	<h1>Web Services</h1>
<?php
		if (isset($_SESSION["id_profile"]))
		{
?>
	<?php echo $_SESSION["id_profile"]; ?>
<?php
		}
?>
	<h2>Request</h2>
	<p>Select the web service to call
		<select name="wsselect" id="wsselect" onchange="onSelectChange()">
			<option value="../webservices/ws_forgotten_password.php">ws_forgotten_password</option>
			<option value="../webservices/ws_connect.php" selected>ws_connect</option> 
			<option value="../webservices/ws_list_of_members.php">ws_list_of_members</option>
			<option value="../webservices/ws_add_member.php">ws_add_member</option>
			<option value="../webservices/ws_get_personal_info.php">ws_get_personal_info</option>
			<option value="../webservices/ws_update_personal_info.php">ws_update_personal_info</option>
			<option value="../webservices/ws_get_member.php">ws_get_member</option>
			<option value="../webservices/ws_update_member.php">ws_update_member</option>
			<option value="../webservices/ws_delete_member.php">ws_delete_member</option>
			<option value="../webservices/ws_disconnect.php">ws_disconnect</option>
		</select>
	</p>
	<div id="WSPostParams">
		<table id="idTable">
			<tr>
				<th>Name</th>
				<th>Value</th>
			</tr>
			<tr>
				<td><input id="varname1" name="varname1" type="text" placeholder="parameter name" onchange="onVarNameChange(1)" /></td>
				<td><input id="varvalue1" name="toreplace1" type="text" placeholder="parameter value"/></td>
			</tr>
		</table>
		<input id="WSAddParamButton" type="button" value="Add POST Parameter" onclick="insererLigne_Fin()" />
		<button id="WSPostButton" type="submit" onclick="postOnClick()">POST</button>
	</div>

	<br/><br/><br/>
	
	<h2>Response</h2>
	<div>
		<div id="WSAnswerCodeLine" class="WSAnswerLine">
			<span class="WSAnswerLabel">Return Code</span>
			<div class="WSAnswerValue" id="WSResponseCode"></div>
		</div>
		<div id="WSAnswerContentLine" class="WSAnswerLine">
			<span class="WSAnswerLabel">Answer Content</span>
			<div class="WSAnswerValue" id="WSResponseContent"></div>
		</div>
	</div>
	
</body>
</html>

