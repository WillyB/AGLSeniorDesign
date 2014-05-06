<?php
include MasterCode.php;
		$user_name = 'actorsgu_data';
       	$pass_word = 'cliffy36&winepress';
		$database = 'actorsgu_data';
		//$server = 'box293.bluehost.com:3306';
		$server = 'localhost:3306';
        
		//$con = mysql_connect($server, $user_name, $pass_word, $database);
		$db_handle = mysql_connect($server, $user_name, $pass_word);
		$db_found = mysql_select_db($database, $db_handle);


$showID = $_REQUEST['showID'];
//First we drop all the previous events connected to the show:
$SQL = "DELETE FROM Show_Events WHERE Shows_idShows = $showID";
$result = mysql_query($SQL);
?>