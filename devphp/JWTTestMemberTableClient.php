<?php require_once('../lib/globals.php');?>
<?php

session_start();

?>
<!DOCTYPE html>
<html>

<head>
<title>JWT Member Table Acces</title>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="css/default.css">
</head>

<body>

<h1>Members</h1>
<div id="id01"></div>

<script>
var xmlhttp = new XMLHttpRequest();
var url = "<?php echo $HTTP_URL . "devphp/JWTTestMemberTableServer.php"; ?>";

xmlhttp.onreadystatechange=function() {
	/* readyState values : see http://www.w3schools.com/ajax/ajax_xmlhttprequest_onreadystatechange.asp
	 *                     for more information
	 * 
	 * 0: request not initialized
	 * 1: server connection established
	 * 2: request received
	 * 3: processing request
	 * 4: request finished and response is ready
	 */
    if (this.readyState == 4)
    {
    	switch (this.status)
    	{
    		case 200:
        		myFunction(this.responseText);
        		break;
        	case 401:
				document.getElementById("id01").innerHTML = "<p>You are not authorized to access this page. Please log on first.</p>";
        		break;
        	case 403:
				document.getElementById("id01").innerHTML = "<p>You are session has expired. Please log on.</p>";
        		break;
        	case 449:
				document.getElementById("id01").innerHTML = "<p>Please wait. Your session will start soon...</p>";
        		break;
        	case 404:
				document.getElementById("id01").innerHTML = "<p>Temporary technical problem. Sorry for the inconveniance...</p>";
        		break;
        	default:
				document.getElementById("id01").innerHTML = "<p>Oups... unknown error("+this.status+")</p>";
    	}
    }
}

xmlhttp.open("GET", url, true);
xmlhttp.setRequestHeader("Jwt","<?php echo $_SESSION["jwt"]; ?>");
xmlhttp.send();

function myFunction(response) {
    //document.getElementById("id01").innerHTML = response;
	//return;
	
	var arr = JSON.parse(response);
    var i;
    var out = "<table>";
    out += "<tr><th></th><th>E-Mail</th><th></th><th>First Name</th><th>Last Name</th><th>Phone</th><th>Profile</th></tr>";

    for(i = 0; i < arr.length; i++) {
        out += "<tr><td>" +
        arr[i].Id         + "</td><td>" +
        arr[i].EMail      + "</td><td>" +
        arr[i].Title      + "</td><td>" +
        arr[i].FirstName  + "</td><td>" +
        arr[i].LastName   + "</td><td>" +
        arr[i].Phone      + "</td><td>" +
        arr[i].Profile    +
        "</td></tr>";
    }
    out += "</table>";
    document.getElementById("id01").innerHTML = out;
	
}
</script>

</body>
</html> 
