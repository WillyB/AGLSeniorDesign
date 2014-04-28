<html>
<head>
<title>AGL: Cast Show</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?php
	$role = $_COOKIE['role'];
	$email = $_COOKIE['email'];
	$password = $_COOKIE['password'];
    
    
	//No unauthorized access
	if(!isset($_COOKIE['email']) || !isset($_COOKIE['password']) || !isset($_COOKIE['role']))
	{
		echo "<script type='text/javascript'>
			 	window.location = 'LogIn.php';</script>";//redirect back to Inventory page    
		exit;
	}
	//redirect to ListUsers.php when "HOME" button is clicked
	if (isset($_POST['home'])) 
	{
		//First check to see which "Home" the user is going to
		if($role == 0 || $role == 1){
			echo "<script type='text/javascript'>
			  window.location = 'AdminTools.php';</script>";
		   exit;
		}
		else if($role == 2){
			echo "<script type='text/javascript'>
			  window.location = 'UserTools.php';</script>";
		   exit;
		}
		
	}
    
    	//remove cookies and redirect to login.php when "LOGOUT" button is clicked
	if (isset($_POST['logout'])) 
	{
		unset($_COOKIE['role']);
		unset($_COOKIE['email']);
		unset($_COOKIE['password']);
	
		setcookie('role', '', time() - 3600);		
		setcookie('email', '', time() - 3600);
		setcookie('password', '', time() - 3600);	
		
		echo "<script type='text/javascript'>
			  alert('Goodbye!');".
			 "window.location = 'LogIn.php';</script>";//redirect to login page
		exit;	
	}
    
    $showID = $_COOKIE['showID'];
    $user_name = 'actorsgu_data';
	$pass_word = 'cliffy36&winepress';
	$database = 'actorsgu_data';
	$server ='localhost:3306';
	$auditionlist = "";
	$castlist = "";
	
	$db_handle = mysql_connect($server, $user_name, $pass_word);
	$db_found = mysql_select_db($database, $db_handle);
	
	if ($db_found) 
	{
		//Load the audition list
		$SQL = "SELECT * FROM Audition WHERE temp_Cast=0 AND Shows_idShows = '$showID'";
		$auditionlist = mysql_query($SQL);
		
		//load the cast list
		$SQL = "SELECT * FROM Audition WHERE temp_Cast=1 AND Shows_idShows = '$showID'";
		$castlist = mysql_query($SQL);
		
		$SQL = "SELECT * FROM Shows WHERE idShows = '$showID'";	
		$result = mysql_query($SQL);
		$num_rows = mysql_num_rows($result);
		$db_field = mysql_fetch_array($result);
		if($num_rows > 0) // if show exists in the data base
		{
		//Fill in that info
			//$First_Name = $db_field['First_Name'];//not there
			$Show_Name = $db_field['Show_Name'];
            $Director  = $db_field['Director'];
            $Playwright = $db_field['Playwright'];
            $Audition_Notes = $db_field['Audition_Notes'];
		}
		else
		{ 
            //First check to see which "Home" the user is going to
 	      if($role == 0 || $role == 1){
                echo "<script type='text/javascript'>
                    alert('There was an error retreiving your information.');".
                    "window.location = 'AdminTools.php';</script>";
		       exit;
            }
		  else if($role == 2){
                echo "<script type='text/javascript'>
                        alert('There was an error retreiving your information.');".
			         "window.location = 'UserTools.php';</script>";
                exit;
                }
		}
	}
    //Move someone from auditionlist to castlist
    if (isset($_POST['cast'])) 
	{
		$UserID = $_POST['UserID'];
		$db_handle = mysql_connect($server, $user_name, $pass_word);
		$db_found = mysql_select_db($database, $db_handle);
	
		if ($db_found) 
		{
			$SQL = "UPDATE Audition SET temp_Cast = 1 WHERE Personnel_idPersonnel = '$UserID' AND Shows_idShows = '$showID'";
			$result = mysql_query($SQL);
		}
		echo "<script type='text/javascript'>
			  window.location = 'CastShow.php';</script>";//Reflect Changes
		exit;	
	}
	//Move someone from castlist to auditionlist
    if (isset($_POST['uncast'])) 
	{
		$UserID = $_POST['UserID'];
		$db_handle = mysql_connect($server, $user_name, $pass_word);
		$db_found = mysql_select_db($database, $db_handle);
	
		if ($db_found) 
		{
			$SQL = "UPDATE Audition SET temp_Cast = 0 WHERE Personnel_idPersonnel = '$UserID' AND Shows_idShows = '$showID'";
			$result = mysql_query($SQL);
		}
		
		echo "<script type='text/javascript'>
			  window.location = 'CastShow.php';</script>";//Reflect Changes
		exit;	
	}
	if (isset($_POST['castshow'])) 
	{
		$db_handle = mysql_connect($server, $user_name, $pass_word);
		$db_found = mysql_select_db($database, $db_handle);
	
		if ($db_found) 
		{
			$SQL = "SELECT * FROM Role WHERE Shows_idShows = '$showID'";
			$result = mysql_query($SQL);
			$num_rows = mysql_num_rows($result);
			if($num_rows > 0)
			{
				echo "<script type='text/javascript'>
		 		 		alert('This show has already been cast.');".
		 				"window.location = 'ListShows.php';</script>";
			}
			else
			{
				$SQL = "SELECT * FROM Audition WHERE temp_Cast=1 AND Shows_idShows = '$showID'";
				$finalcastlist = mysql_query($SQL);
				while($row = mysql_fetch_array($finalcastlist))
				{
					$UserID = $row['Personnel_idPersonnel'];
					$SQL = "INSERT INTO Role (Personnel_idPersonnel, Shows_idShows) VALUES ('$UserID', '$showID')";
					$result = mysql_query($SQL);
				}
				$SQL = "SELECT * FROM Role WHERE Shows_idShows = '$showID'";
				$result = mysql_query($SQL);
				$num_rows = mysql_num_rows($result);
				if($num_rows > 0)
				{
					echo "<script type='text/javascript'>
		 		 		alert('Show has been cast.');".
		 				"window.location = 'ListShows.php';</script>";
				}
				else
				{
					echo "<script type='text/javascript'>
		 		 		alert('No actors have been selected. Show has not been cast.');".
		 				"window.location = 'CastShow.php';</script>";
				}
			}
		}
		else
		{
			echo '<script type="text/javascript"> 
			  alert("Database is not found");
			  </script>';	
			exit;
		}
	}
	mysql_close($db_handle);
?>
</head>
<body bgcolor="#000000" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<!-- Save for Web Slices (CastShow.psd) -->
<form name="form" method="post" action="CastShow.php">
<table width="1401" height="2017" border="0" align="center" cellpadding="0" cellspacing="0" id="Table_01">
	<tr>
		<td colspan="11">
			<img src="Assets/CastShow_01.gif" width="1400" height="71" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="71" alt=""></td>
	</tr>
	<tr>
		<td colspan="8" rowspan="3">
			<img src="Assets/CastShow_02.gif" width="1211" height="138" alt=""></td>
		<td>
			<input type="image" name="home" value="home" src="Assets/CastShow_03.gif" id="home"></td>
		<td colspan="2" rowspan="11">
			<img src="Assets/CastShow_04.gif" width="83" height="1074" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="33" alt=""></td>
	</tr>
	<tr>
		<td>
			<input type="image" name="logout" value="logout" src="Assets/CastShow_05.gif" id"logout"></td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="33" alt=""></td>
	</tr>
	<tr>
		<td rowspan="9">
			<img src="Assets/CastShow_06.gif" width="106" height="1008" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="72" alt=""></td>
	</tr>
	<tr>
		<td colspan="2" rowspan="8">
			<img src="Assets/CastShow_07.gif" width="217" height="936" alt=""></td>
		<td width="938" height="44" colspan="5" background="Assets/CastShow_08.gif">&nbsp;
        <a style="color:#FFFFFF;"><?php echo $Show_Name?></a>
        </td>
		<td rowspan="8">
			<img src="Assets/CastShow_09.gif" width="56" height="936" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="44" alt=""></td>
	</tr>
	<tr>
		<td colspan="5">
			<img src="Assets/CastShow_10.gif" width="938" height="43" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="43" alt=""></td>
	</tr>
	<tr>
		<td width="938" height="121" colspan="5" background="Assets/CastShow_11.gif">&nbsp;
        <textarea name="showdescription" id="showdescription" cols="110" rows="6" style="color: #FFFFFF;border:none;background-color:transparent; resize:none"><?php echo $Audition_Notes ?></textarea>
        </td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="121" alt=""></td>
	</tr>
	<tr>
		<td colspan="5">
			<img src="Assets/CastShow_12.gif" width="938" height="42" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="42" alt=""></td>
	</tr>
	<tr>
		<td width="410" height="566" background="Assets/CastShow_13.gif">&nbsp;
        <?php
				
				echo "<body bgcolor='blue'>";
				echo "
				<table border='1' bordercolor='#FFFFFF' style='color: #FFFFFF;border:none;' align='center' cellpadding='1' >
					<tr>
					<th>First Name</th>
					<th>Last Name</th>
					<th>Age</th>
					<th>Gender</th>
					<th>Cast</th>
					</tr>";
					while($row = mysql_fetch_array($auditionlist))
					{
						$db_handle = mysql_connect($server, $user_name, $pass_word);
						$db_found = mysql_select_db($database, $db_handle);
						
						if ($db_found) 
						{
							//Get info from Personnel
							$id = $row['Personnel_idPersonnel'];
							$SQL = "SELECT * FROM Personnel WHERE idPersonnel='$id'";
							$result = mysql_query($SQL);
							$num_rows = mysql_num_rows($result);
							$db_field = mysql_fetch_array($result);
							
							echo "<tr><td>".$db_field['First_Name']."</td><td>".
										$db_field['Last_Name']."</td><td>".
										$db_field['Age']."</td><td>".
										$db_field['Gender']."</td>".
										"<form action='CastShow.php' method='post'>.
										<td><input type='SUBMIT' name='cast' value='cast'/>
								         <input type='HIDDEN' name='UserID' value='" .$id. "'/></td></tr></form>";
						}
					}
				echo "</table>";
				echo "<br>"."<br>";
				mysql_close($db_handle);
		?>
        </td>
		<td rowspan="4">
			<img src="Assets/CastShow_14.gif" width="120" height="686" alt=""></td>
		<td width="508" height="566" colspan="3" background="Assets/CastShow_15.gif">&nbsp;
        <?php
				
				echo "<body bgcolor='blue'>";
				echo "
				<table border='1' bordercolor='#FFFFFF' style='color: #FFFFFF;border:none;' align='center' cellpadding='1' >
					<tr>
					<th>First Name</th>
					<th>Last Name</th>
					<th>Age</th>
					<th>Gender</th>
					<th>Uncast</th>
					</tr>";
					while($row = mysql_fetch_array($castlist))
					{
						$db_handle = mysql_connect($server, $user_name, $pass_word);
						$db_found = mysql_select_db($database, $db_handle);
						
						if ($db_found) 
						{
							//Get info from Personnel
							$id = $row['Personnel_idPersonnel'];
							$SQL = "SELECT * FROM Personnel WHERE idPersonnel='$id'";
							$result = mysql_query($SQL);
							$num_rows = mysql_num_rows($result);
							$db_field = mysql_fetch_array($result);
							
							echo "<tr><td>".$db_field['First_Name']."</td><td>".
										$db_field['Last_Name']."</td><td>".
										$db_field['Age']."</td><td>".
										$db_field['Gender']."</td>".
										"<form action='CastShow.php' method='post'>.
										<td><input type='SUBMIT' name='uncast' value='uncast'/>
								         <input type='HIDDEN' name='UserID' value='" .$id. "'/></td></tr></form>";
						}
					}
				echo "</table>";
				echo "<br>"."<br>";
				mysql_close($db_handle);
		?>
        </td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="566" alt=""></td>
	</tr>
	<tr>
		<td rowspan="3">
			<img src="Assets/CastShow_16.gif" width="410" height="120" alt=""></td>
		<td colspan="3">
			<img src="Assets/CastShow_17.gif" width="408" height="34" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="34" alt=""></td>
	</tr>
	<tr>
		<td rowspan="2">
			<img src="Assets/CastShow_18.gif" width="241" height="86" alt=""></td>
		<td>
			<input type="image" name="castshow" value="castshow" src="Assets/CastShow_19.gif" id"castshow"></td>
		<td rowspan="2">
			<img src="Assets/CastShow_20.gif" width="56" height="86" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="37" alt=""></td>
	</tr>
	<tr>
		<td>
			<img src="Assets/CastShow_21.gif" width="111" height="49" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="49" alt=""></td>
	</tr>
	<tr>
		<td rowspan="2">
			<img src="Assets/CastShow_22.gif" width="91" height="871" alt=""></td>
		<td width="1249" height="712" colspan="9" background="Assets/CastShow_23.gif">&nbsp;</td>
		<td rowspan="2">
			<img src="Assets/CastShow_24.gif" width="60" height="871" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="712" alt=""></td>
	</tr>
	<tr>
		<td colspan="9">
			<img src="Assets/CastShow_25.gif" width="1249" height="159" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="159" alt=""></td>
	</tr>
	<tr>
		<td>
			<img src="Assets/spacer.gif" width="91" height="1" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="126" height="1" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="410" height="1" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="120" height="1" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="241" height="1" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="111" height="1" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="56" height="1" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="56" height="1" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="106" height="1" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="23" height="1" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="60" height="1" alt=""></td>
		<td></td>
	</tr>
</table>
</form>
<!-- End Save for Web Slices -->
</body>
</html>