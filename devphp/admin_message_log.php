<?php require_once('../lib/globals.php'); ?>
<?php require_once('../lib/connexion.php'); ?>
<?php require_once('../lib/lib_message_log.php'); ?>
<?php require_once('../lib/lib_member.php');?>
<?php require_once('../lib/lib_mail.php');?>

<html>
<head>
	<title>Message Log Administration</title>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
</head>

<body>
	<style>
		table, th, td 
		{
    		border: 1px solid black;
		}
	</style>

<?php

$result = $dbprotect->query("SELECT * FROM MESSAGE_LOG ORDER BY msg_timestamp DESC");

?>
	<p><?php echo $result->num_rows ?> entries found in MESSAGE_LOG table.</p><br>

	<table>
		<tr>
    		<th>Timestamp</th><th>Type</th><th>Level</th><th>Module</th><th>Title</th><th>Description</th>
		</tr>
<?php

	while ($line_result = $result->fetch_assoc())
	{

?>
		<tr>
			<td><?php echo $line_result['msg_timestamp'] ?></td>
			<td><?php echo $line_result['msg_type'] ?></td>
			<td><?php echo $line_result['msg_level'] ?></td>
			<td><?php echo $line_result['msg_module'] ?></td>
			<td><?php echo $line_result['msg_title'] ?></td>
			<td><?php echo $line_result['msg_description'] ?></td>
		</tr>
<?php

	}

?>
	</table>
<?php

if (isset($_POST['msgtitle']))
{
	switch ($_POST['msgtype'])
	{
		case $MSG_TYPE_USER:
			LogUserMessage($dbprotect,$_POST['msgmodule'],$_POST['msgtitle'],$_POST['msgdescription']);
			break;
		case $MSG_TYPE_SOFTWARE:
			switch ($_POST['msglevel'])
			{
				case $MSG_LEVEL_DEBUG:
					LogDebugMessage($dbprotect,$_POST['msgmodule'],$_POST['msgtitle'],$_POST['msgdescription']);
					break;
				case $MSG_LEVEL_INFO:
					LogInfoMessage($dbprotect,$_POST['msgmodule'],$_POST['msgtitle'],$_POST['msgdescription']);
					break;
				case $MSG_LEVEL_WARNING:
					LogWarningMessage($dbprotect,$_POST['msgmodule'],$_POST['msgtitle'],$_POST['msgdescription']);
					break;
				case $MSG_LEVEL_CRITICAL:
					LogCriticalMessage($dbprotect,$_POST['msgmodule'],$_POST['msgtitle'],$_POST['msgdescription']);
					break;
				case $MSG_LEVEL_FATAL:
					LogFatalMessage($dbprotect,$_POST['msgmodule'],$_POST['msgtitle'],$_POST['msgdescription']);
					break;
			}
			break;
		default:
			LogGenericMessage($dbprotect,$_POST['msgtype'],$_POST['msgmodule'],$_POST['msglevel'],$_POST['msgtitle'],$_POST['msgdescription']);
			break;
	}
	header("Refresh:0");
}
else if (isset($_POST['submitpurge'])) 
{
	$dbprotect->query("DELETE FROM MESSAGE_LOG WHERE msg_level ='$MSG_LEVEL_DEBUG'");
	header("Refresh:0");}
?>
	<div class="login">
		<div class="heading">
			<h2>Add Message Log</h2>

			<form action="" method="post" name="addmsglog">

				<div class="input-group input-group-lg">
					<span class="input-group-addon"><i class="fa fa-user"></i></span>
					<select class="form-control" name="msgtype" id="msgtype">
<?php
	foreach ($MESSAGE_LOG_TYPE as $key => $value) 
	{
?>
						<option value="<?php echo $key ?>"><?php echo $key ?></option>
<?php
	}
?>
					</select>
				</div>
				
				<div class="input-group input-group-lg">
					<span class="input-group-addon"><i class="fa fa-user"></i></span>
					<select class="form-control" name="msglevel" id="msglevel">
<?php
	foreach ($MESSAGE_LOG_LEVEL as $key => $value) 
	{
?>
						<option value="<?php echo $key ?>"><?php echo $key ?></option>
<?php
	}
?>
					</select>
				</div>
				
				<div class="input-group input-group-lg">
					<span class="input-group-addon"><i class="fa fa-user"></i></span>
					<select class="form-control" name="msgmodule" id="msgmodule">
<?php
	$i = 1;
	foreach ($MESSAGE_LOG_MODULE as $key => $value) 
	{
?>
						<option value="<?php echo $key ?>"<?php if ($i==2) { echo " selected"; } ?>><?php echo $key ?></option>
<?php
		$i++;
	}
?>

					</select>
				</div>
				
				<div class="input-group input-group-lg">
					<span class="input-group-addon"><i class="fa fa-user"></i></span>
					<input type="text" class="form-control" name="msgtitle" id="msgtitle" placeholder="Title">
				</div>

				<div class="input-group input-group-lg">
					<span class="input-group-addon"><i class="fa fa-user"></i></span>
					<textarea  class="form-control" id="msgdescription" name="msgdescription" rows="3" placeholder="Description"></textarea>
				</div>

				<button type="submit" name="Submit" class="float">Log Message</button>

			</form>
		
		</div>
	</div>

	<div class="login">
		<div class="heading">
			<h2>Purge</h2>

			<form action="" method="post" name="purgemsglog">

				<button type="submit" name="submitpurge" class="float">Purge Debug Messages</button>

			</form>
		
		</div>
	</div>

</body>
</html>

