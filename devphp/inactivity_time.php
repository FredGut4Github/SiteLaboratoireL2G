<?php
session_start();
if(isset($_SESSION['email']))
{ // si le membre est connecté
     if(isset($_SESSION['timestamp']))
     { // si $_SESSION['timestamp'] existe
             if($_SESSION['timestamp'] + 3600 > time())
             {
                    $_SESSION['timestamp'] = time();
             }
             else
             	{ 
             		session_unset();
             		session_destroy(); 
             	}
     }
     else
     	{ 
     		$_SESSION['timestamp'] = time(); 
     	}
}