<?php
include 'MasterCode.php';
//Add element on save
	$db_handle = mysql_connect($server, $user_name, $pass_word);
	$db_found = mysql_select_db($database, $db_handle);
	
	if ($db_found)
	{	
		$SQL = "SELECT * FROM Personnel WHERE Contact_Email = '$email' AND password = '$password'";
		$result = mysql_query($SQL);
		$db_field = mysql_fetch_array($result);
		$num_rows = mysql_num_rows($result);
		if($num_rows > 0)
		{
			$personnelID = $db_field['idPersonnel'];
			
			$SQL = "SELECT * FROM Audition WHERE Personnel_idPersonnel = '$personnelID' AND Shows_idShows = '$showID'";
			$result = mysql_query($SQL);
			$num_rows = mysql_num_rows($result);
			if($num_rows > 0)
			{
				echo "<script type='text/javascript'>
		 		 		alert('You have already auditioned for this show!');".
		 				"window.location = 'ListShows.php';</script>";
			}
			else
			{
				$SQL = "INSERT INTO Audition (Personnel_idPersonnel, Shows_idShows) VALUES ('$personnelID', '$showID') ";
				$result = mysql_query($SQL);
                $auditionID = mysql_insert_id();
			}
		}
		else
		{
			echo "<script type='text/javascript'>
				 alert('An error has occured.');".
				 "window.location = 'Audition.php';</script>";//redirect back to Create Show   
			exit;//exit, so that the following code is not executed
		}
				
		echo "<script type='text/javascript'>
			  window.location='ListShows.php';</script>";		
		exit;	
    }
	else//if DB was not found
	{
		echo '<script type="text/javascript"> 
			  alert("Database is not found");
			  </script>';	
		exit;
	}


?>