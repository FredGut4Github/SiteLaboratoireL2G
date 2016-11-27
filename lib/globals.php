<?php

$MSG_TYPE_SOFTWARE 	= 'software';
$MSG_TYPE_USER		= 'user';

$MESSAGE_LOG_TYPE[$MSG_TYPE_SOFTWARE] 	= TRUE;			/// Set to FALSE to stop to store software type message
$MESSAGE_LOG_TYPE[$MSG_TYPE_USER] 		= TRUE;			/// Set to FALSE to stop to store user type message

$MSG_LEVEL_DEBUG 	= 'debug';
$MSG_LEVEL_INFO 	= 'info';
$MSG_LEVEL_WARNING 	= 'warning';
$MSG_LEVEL_CRITICAL = 'critical';
$MSG_LEVEL_FATAL 	= 'fatal';

$MESSAGE_LOG_LEVEL[$MSG_LEVEL_DEBUG] 	= TRUE;			/// Set to FALSE to stop to store debug level message
$MESSAGE_LOG_LEVEL[$MSG_LEVEL_INFO] 	= TRUE;			/// Set to FALSE to stop to store info level message
$MESSAGE_LOG_LEVEL[$MSG_LEVEL_WARNING] 	= TRUE;			/// Set to FALSE to stop to store warning level message
$MESSAGE_LOG_LEVEL[$MSG_LEVEL_CRITICAL]	= TRUE;			/// Set to FALSE to stop to store critical level message
$MESSAGE_LOG_LEVEL[$MSG_LEVEL_FATAL] 	= TRUE;			/// Set to FALSE to stop to store fatal level message

$MSG_MODULE_DATABASE 	= 'DATABASE';
$MSG_MODULE_EMAIL 		= 'EMAIL';
$MSG_MODULE_MEMBER 		= 'MEMBER';

$MESSAGE_LOG_MODULE[$MSG_MODULE_DATABASE] 	= TRUE;		/// Set to FALSE to stop to store message for module DATABASE
$MESSAGE_LOG_MODULE[$MSG_MODULE_EMAIL] 		= TRUE;		/// Set to FALSE to stop to store message for module EMAIL
$MESSAGE_LOG_MODULE[$MSG_MODULE_MEMBER] 	= TRUE;		/// Set to FALSE to stop to store message for module MEMBER

$ADMINISTRATION_EMAILS = "fred.gut@gmail.com, yann.btg@gmail.com";

$HTTP_URL = "http://www.laboratoire-gutierrez.com/" ;

$HTTPS_URL = "https://www.laboratoire-gutierrez.com/" ;

?>
