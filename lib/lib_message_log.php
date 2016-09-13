<?php require_once('globals.php');?>
<?php

function LogGenericMessage($dbconnection, $msgtype, $msgmodule, $msglevel, $msgtitle, $msgdescription)
{
	global $MESSAGE_LOG_TYPE;
	global $MESSAGE_LOG_LEVEL;
	global $MESSAGE_LOG_MODULE;
	if ($MESSAGE_LOG_TYPE[$msgtype] && $MESSAGE_LOG_MODULE[$msgmodule] && $MESSAGE_LOG_LEVEL[$msglevel])
	{
		if (!($dbconnection->query("INSERT INTO MESSAGE_LOG (msg_type, msg_level, msg_module, msg_title, msg_description) VALUES('$msgtype','$msglevel','$msgmodule','$msgtitle','$msgdescription')")))
		{	// SHOULD NEVER HAPPENED
			// A mail will be sent to the admin
			return FALSE;
		}
	}
	return TRUE;
}

function LogDebugMessage($dbconnection, $msgmodule, $msgtitle, $msgdescription)
{
	global $MSG_TYPE_SOFTWARE;
	global $MSG_LEVEL_DEBUG;
	return LogGenericMessage($dbconnection,$MSG_TYPE_SOFTWARE,$msgmodule,$MSG_LEVEL_DEBUG,$msgtitle,$msgdescription);
}

function LogInfoMessage($dbconnection, $msgmodule, $msgtitle, $msgdescription)
{
	global $MSG_TYPE_SOFTWARE;
	global $MSG_LEVEL_INFO;
	return LogGenericMessage($dbconnection,$MSG_TYPE_SOFTWARE,$msgmodule,$MSG_LEVEL_INFO,$msgtitle,$msgdescription);
}

function LogWarningMessage($dbconnection, $msgmodule, $msgtitle, $msgdescription)
{
	global $MSG_TYPE_SOFTWARE;
	global $MSG_LEVEL_WARNING;
	return LogGenericMessage($dbconnection,$MSG_TYPE_SOFTWARE,$msgmodule,$MSG_LEVEL_WARNING,$msgtitle,$msgdescription);
}

function LogCriticalMessage($dbconnection, $msgmodule, $msgtitle, $msgdescription)
{
	global $MSG_TYPE_SOFTWARE;
	global $MSG_LEVEL_CRITICAL;
	return LogGenericMessage($dbconnection,$MSG_TYPE_SOFTWARE,$msgmodule,$MSG_LEVEL_CRITICAL,$msgtitle,$msgdescription);
}

function LogFatalMessage($dbconnection, $msgmodule, $msgtitle, $msgdescription)
{
	global $MSG_TYPE_SOFTWARE;
	global $MSG_LEVEL_FATAL;
	return LogGenericMessage($dbconnection,$MSG_TYPE_SOFTWARE,$msgmodule,$MSG_LEVEL_FATAL,$msgtitle,$msgdescription);
}

function LogUserMessage($dbconnection, $msgmodule, $msgtitle, $msgdescription)
{
	global $MSG_TYPE_USER;
	global $MSG_LEVEL_INFO;
	return LogGenericMessage($dbconnection,$MSG_TYPE_USER,$msgmodule,$MSG_LEVEL_INFO,$msgtitle,$msgdescription);
}

?>
