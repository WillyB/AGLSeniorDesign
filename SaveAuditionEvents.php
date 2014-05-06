<?php
//SaveAuditionEvents
		$user_name = 'actorsgu_data';
       	$pass_word = 'cliffy36&winepress';
		$database = 'actorsgu_data';
		//$server = 'box293.bluehost.com:3306';
		$server = 'localhost:3306';
        
		//$con = mysql_connect($server, $user_name, $pass_word, $database);
		$db_handle = mysql_connect($server, $user_name, $pass_word);
		$db_found = mysql_select_db($database, $db_handle);


$eventArray = $_REQUEST['eventData'];
$title = $eventArray[0];
$startDate = $eventArray[1];
$endDate = $eventArray[2];
$allDay     = $eventArray[3];
$firstName = $eventArray[4];
$lastName = $eventArray[5];
$backColor = $eventArray[6];
$foreColor = $eventArray[7];
$showID    = $eventArray[8];
$personnelID = $eventArray[9];
$auditionID = $eventArray[10];

                
$SQL = ("INSERT INTO Audition_Events (Audition_Shows_idShows, Audition_idAudition, Audition_Personnel_idPersonnel, Title, Start_Date, End_Date, All_Day, First_Name, Last_Name, Background_Color, Foreground_Color) 
                         VALUES ($showID, $auditionID, $personnelID, '$title', '$startDate', '$endDate', '$allDay', '$firstName', '$lastName', '$backColor', '$foreColor')");

$result = mysql_query($SQL);
$num_rows = mysql_num_rows($result);


?>