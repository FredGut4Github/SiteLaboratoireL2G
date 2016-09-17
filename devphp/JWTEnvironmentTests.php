<?php require_once('../lib/JWT.php'); ?>
<?php require_once('JWTUnitTests.php'); ?>
<?php

	function TestGetAllHeaders()
	{
		echo "<br/>
";	
		foreach (getallheaders() as $name => $value) 
		{
		    echo '<span class="marge">'.$name.': '.$value.'<br/></span>';
		}
	}

	function TestApacheRequestHeaders()
	{
		echo "<br/>
";	
		foreach (apache_request_headers() as $name => $value) 
		{
		    echo '<span class="marge">'.$name.': '.$value.'<br/></span>';
		}
	}

	function CheckFunctionAvailibility($functionname, $testfunction=null)
	{
?>
		<tr>
			<td>function <?php echo $functionname; ?>()<?php if ($testfunction) $testfunction(); ?></td>
			<td style='width:100px; text-align:right; vertical-align: top; color:<?php if (function_exists($functionname)) { echo "green'>installed<br/>"; } else { echo "red'>not installed<br/>"; } ?></td>
		</tr>
<?php
	}
?>
<!DOCTYPE html>
<html>
<head>
<title>JWT Unit Tests</title>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="css/default.css">
<style>
	table, th , td {
	    border: 0px;
	    border-collapse: collapse;
	    padding: 5px;
	}
</style>
</head>
<body>

	<h1>Environment Tests</h1>

	<h2>Package availibility</h2>
	<table>	
<?php

	CheckFunctionAvailibility("json_encode");
	CheckFunctionAvailibility("openssl_encrypt");
	CheckFunctionAvailibility("JWT::encode");
	CheckFunctionAvailibility("getallheaders",TestGetAllHeaders);
	CheckFunctionAvailibility("apache_request_headers",TestApacheRequestHeaders);

?>
	</table>
	<h2>JWT Unit Tests</h2>
	<p>Starting unit tests...</p>
	<table>
<?php

	JWTUnitTest::testEncodeDecode();
	JWTUnitTest::testDecodeFromPython();
	JWTUnitTest::testUrlSafeCharacters();
	JWTUnitTest::testValidToken();

?>
	</table>
	<p>End tests</p>

</body>
</html>
