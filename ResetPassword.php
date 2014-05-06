<?php
include 'MasterCode.php';

//$con = mysql_connect($server, $user_name, $pass_word, $database);
$db_handle = mysql_connect($server, $user_name, $pass_word);
$db_found = mysql_select_db($database, $db_handle);

$newPassword = $_REQUEST['newPassword'];
$userID      = $_REQUEST['userID'];
echo '<script type="text/javascript"> 
			  alert("New password recieved!");
			  </script>';


?>