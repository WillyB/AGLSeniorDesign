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
?>
</head>
<body bgcolor="#00000" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<!-- Save for Web Slices (CastShow.psd) -->
<form name="form" method="post" action="CastShow.php">
<table width="1401" height="1152" border="0" align="center" cellpadding="0" cellspacing="0" id="Table_01">
	<tr>
		<td colspan="11">
			<img src="Assets/CastShow_01.gif" width="1400" height="71" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="71" alt=""></td>
	</tr>
	<tr>
		<td colspan="9" rowspan="3">
			<img src="Assets/CastShow_02.gif" width="1211" height="138" alt=""></td>
		<td>
			<input type="image" name="home" value="home" src="Assets/CastShow_03.gif" id="home"></td>
		<td rowspan="15">
			<img src="Assets/CastShow_04.gif" width="83" height="1050" alt=""></td>
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
		<td rowspan="13">
			<img src="Assets/CastShow_06.gif" width="106" height="984" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="72" alt=""></td>
	</tr>
	<tr>
		<td rowspan="12">
			<img src="Assets/CastShow_07.gif" width="217" height="912" alt=""></td>
		<td width="938" height="44" colspan="7" background="Assets/CastShow_08.gif">&nbsp;
        <a style="color:#FFFFFF;"><?php echo $Show_Name?></a>
        </td>
		<td rowspan="12">
			<img src="Assets/CastShow_09.gif" width="56" height="912" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="44" alt=""></td>
	</tr>
	<tr>
		<td colspan="7">
			<img src="Assets/CastShow_10.gif" width="938" height="43" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="43" alt=""></td>
	</tr>
	<tr>
		<td width="938" height="121" colspan="7" background="Assets/CastShow_11.gif">&nbsp;
        <textarea name="showdescription" id="showdescription" cols="110" rows="6" style="color: #FFFFFF;border:none;background-color:transparent; resize:none"><?php echo $Audition_Notes ?></textarea>
        </td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="121" alt=""></td>
	</tr>
	<tr>
		<td colspan="7">
			<img src="Assets/CastShow_12.gif" width="938" height="42" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="42" alt=""></td>
	</tr>
	<tr>
		<td width="410" height="566" rowspan="5" background="Assets/CastShow_13.gif">&nbsp;
        <?php
				
				echo "<body bgcolor='blue'>";
				echo "
				<table border='1' bordercolor='#FFFFFF' style='color: #FFFFFF;border:none;' align='center' cellpadding='1' >
					<tr>
					<th>First Name</th>
					<th>Last Name</th>
					<th>Age</th>
					<th>Gender</th>
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
										"<td><input type='SUBMIT' name='cast' value='cast'/>
								         <input type='HIDDEN' name='UserID' value='" .$id. "'/></td></tr>";
						}
					}
				echo "</table>";
				echo "<br>"."<br>";
		?>
        </td>
		<td colspan="3">
			<img src="Assets/CastShow_14.gif" width="120" height="171" alt=""></td>
		<td width="408" height="566" colspan="3" rowspan="5" background="Assets/CastShow_15.gif">&nbsp;
        <?php
				
				echo "<body bgcolor='blue'>";
				echo "
				<table border='1' bordercolor='#FFFFFF' style='color: #FFFFFF;border:none;' align='center' cellpadding='1' >
					<tr>
					<th>First Name</th>
					<th>Last Name</th>
					<th>Age</th>
					<th>Gender</th>
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
										"<td><input type='SUBMIT' name='uncast' value='uncast'/>
								         <input type='HIDDEN' name='UserID' value='" .$id. "'/></td></tr>";
						}
					}
				echo "</table>";
				echo "<br>"."<br>";
		?>
        </td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="171" alt=""></td>
	</tr>
	<tr>
		<td rowspan="7">
			<img src="Assets/CastShow_16.gif" width="14" height="491" alt=""></td>
		<td>&nbsp;</td>
		<td rowspan="7">
			<img src="Assets/CastShow_18.gif" width="16" height="491" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="38" alt=""></td>
	</tr>
	<tr>
		<td>
			<img src="Assets/CastShow_19.gif" width="90" height="111" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="111" alt=""></td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="37" alt=""></td>
	</tr>
	<tr>
		<td rowspan="4">
			<img src="Assets/CastShow_21.gif" width="90" height="305" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="209" alt=""></td>
	</tr>
	<tr>
		<td rowspan="3">
			<img src="Assets/CastShow_22.gif" width="410" height="96" alt=""></td>
		<td colspan="3">
			<img src="Assets/CastShow_23.gif" width="408" height="34" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="34" alt=""></td>
	</tr>
	<tr>
		<td rowspan="2">
			<img src="Assets/CastShow_24.gif" width="241" height="62" alt=""></td>
		<td>
			<input type="image" name="castshow" value="castshow" src="Assets/CastShow_25.gif" id"castshow"></td>
		<td rowspan="2">
			<img src="Assets/CastShow_26.gif" width="56" height="62" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="37" alt=""></td>
	</tr>
	<tr>
		<td>
			<img src="Assets/CastShow_27.gif" width="111" height="25" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="25" alt=""></td>
	</tr>
	<tr>
		<td colspan="11">
			<img src="Assets/CastShow_28.gif" width="1400" height="31" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="31" alt=""></td>
	</tr>
</table>
</form>
<!-- End Save for Web Slices -->
</body>
</html>