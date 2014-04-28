<?php
//SaveShowMetrics
		$user_name = 'actorsgu_data';
       	$pass_word = 'cliffy36&winepress';
		$database = 'actorsgu_data';
		//$server = 'box293.bluehost.com:3306';
		$server = 'localhost:3306';
        
		//$con = mysql_connect($server, $user_name, $pass_word, $database);
		$db_handle = mysql_connect($server, $user_name, $pass_word);
		$db_found = mysql_select_db($database, $db_handle);


$showID = $_REQUEST['showID'];
$title = $_REQUEST['title'];
$director = $_REQUEST['director'];
$author   = $_REQUEST['author'];
$notes    = $_REQUEST['notes'];

                
//$SQL = ("INSERT INTO Show_Events (Shows_idShows, Title, Start_Date, End_Date, All_Day, First_Name, Last_Name, Background_Color, Foreground_Color) 
//                         VALUES ($showID, '$title', '$startDate', '$endDate', '$allDay', '$firstName', '$lastName', '$backColor', '$foreColor')");
$SQL = "UPDATE Shows SET Show_Name = '$title', Director = '$director', Playwright = '$author', Audition_Notes = '$notes' WHERE idShows = $showID";

$result = mysql_query($SQL);
$num_rows = mysql_num_rows($result);



?>