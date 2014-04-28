<?php
		$user_name = 'actorsgu_data';
       	$pass_word = 'cliffy36&winepress';
		$database = 'actorsgu_data';
		//$server = 'box293.bluehost.com:3306';
		$server = 'localhost:3306';
        
		//$con = mysql_connect($server, $user_name, $pass_word, $database);
		$db_handle = mysql_connect($server, $user_name, $pass_word);
		$db_found = mysql_select_db($database, $db_handle);
//SaveShowEdit

$eventArray = $_REQUEST['eventData'];

// [entry.title, lsStartDate, lsEndDate, entry.allDay, entry.data.fname, entry.data.lname, lsBackgroundColor, lsForegroundColor];
$title = $eventArray[0];
$startDate = $eventArray[1];
$endDate = $eventArray[2];
$allDay     = $eventArray[3];
$firstName = $eventArray[4];
$lastName = $eventArray[5];
$backColor = $eventArray[6];
$foreColor = $eventArray[7];
$showID    = $eventArray[8];

//$db_handle = mysql_connect($server, $user_name, $pass_word);
//$db_found = mysql_select_db($database, $db_handle);
                
$SQL = ("INSERT INTO Show_Events (Shows_idShows, Title, Start_Date, End_Date, All_Day, First_Name, Last_Name, Background_Color, Foreground_Color) 
                         VALUES ($showID, '$title', '$startDate', '$endDate', '$allDay', '$firstName', '$lastName', '$backColor', '$foreColor')");

//$SQL = ("INSERT INTO Show_Events (Shows_idShows, Title, Start_Date, End_Date, All_Day, First_Name, Last_Name, Background_Color, Foreground_Color) VALUES (11, 'FooBar', 'tomorrow', 'yesterday', 'true', 'Mr', 'RainMan', 'Mauve', 'LimeYellow')");
$result = mysql_query($SQL);
$num_rows = mysql_num_rows($result);

?>