<!--	This page displays the information that is stored for the show.
-->
<html>
<head>
<title>AGL: View Show</title>
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
		
	$db_handle = mysql_connect($server, $user_name, $pass_word);
	$db_found = mysql_select_db($database, $db_handle);
	
	if ($db_found) 
	{
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
    
	if (isset($_POST['audition'])) 
	{
		$showtitle = $_POST['title'];
		setcookie('showtitle', $showtitle);
		setcookie('showID', $showID);
		echo "<script type='text/javascript'>
			  window.location = 'Audition.php';</script>";//redirect to login page
		exit;	
	}
    mysql_close($db_handle);
?>
<style type="text/css">
#apDiv1 {
	position: absolute;
	left: 255px;
	top: 884px;
	width: 1157px;
	height: 383px;
	z-index: 1;
}
</style>
</head>
<body bgcolor="#000000" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<!-- Save for Web Slices (ViewShow.psd) -->
<div id="castDiv" style="overflow: scroll; alignment-adjust: central;">
<?php
	$db_handle = mysql_connect($server, $user_name, $pass_word);
	$db_found = mysql_select_db($database, $db_handle);
	
	if ($db_found) 
	{
		$SQL = "SELECT * FROM Role WHERE Shows_idShows = '$showID'";
		$result = mysql_query($SQL);
		$num_rows = mysql_num_rows($result);
		if($num_rows > 0)
		{			
				echo "<body bgcolor='blue'>";
				echo "
				<table border='1' bordercolor='#FFFFFF' style='color: #FFFFFF;border:none;' align='center' cellpadding='1' >
					<tr>
					<th>First Name</th>
					<th>Last Name</th>
					<th>Age</th>
					<th>Gender</th>
					</tr>";
					while($row = mysql_fetch_array($result))
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
										$db_field['Gender']."</td></tr>";
						}
					}
				echo "</table>";
				echo "<br>"."<br>";
				mysql_close($db_handle);
		}
		else
		{
			
		}
	}
	else
	{
		echo '<script type="text/javascript"> 
		  alert("Database is not found");
		  </script>';	
		exit;
	}
	mysql_close($db_handle);
?>
</div>
<form name="form" method="post" action="ViewShow.php">
<table width="1401" height="2161" border="0" align="center" cellpadding="0" cellspacing="0" id="Table_01">
	<tr>
		<td colspan="9">
			<img src="Assets/ViewShow_01.gif" width="1400" height="71" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="71" alt=""></td>
	</tr>
	<tr>
		<td colspan="6" rowspan="3">
			<img src="Assets/ViewShow_02.gif" width="1211" height="187" alt=""></td>
		<td colspan="2">
			<input type="image" name="home" value="home" src="Assets/ViewShow_03.gif" id="home"></td>
		<td rowspan="21">
			<img src="Assets/ViewShow_04.gif" width="83" height="2089" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="33" alt=""></td>
	</tr>
	<tr>
		<td colspan="2">
			<input type="image" name="logout" value="logout" src="Assets/ViewShow_05.gif" id"logout"></td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="33" alt=""></td>
	</tr>
	<tr>
		<td colspan="2" rowspan="15">
			<img src="Assets/ViewShow_06.gif" width="106" height="743" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="121" alt=""></td>
	</tr>
	<tr>
		<td colspan="2" rowspan="14">
			<img src="Assets/ViewShow_07.gif" width="396" height="622" alt=""></td>
		<td width="676" height="245" colspan="3" background="Assets/ViewShow_08.gif">&nbsp;
        <textarea name="showdescription" cols="81" rows="13" disabled readonly id="showdescription" style="color: #FFFFFF;border:none;background-color:transparent; resize:none"><?php echo $Audition_Notes ?></textarea>
        </td>
		<td rowspan="14">
			<img src="Assets/ViewShow_09.gif" width="139" height="622" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="245" alt=""></td>
	</tr>
	<tr>
		<td colspan="3">
			<img src="Assets/ViewShow_10.gif" width="676" height="61" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="61" alt=""></td>
	</tr>
	<tr>
		<td rowspan="12">
			<img src="Assets/ViewShow_11.gif" width="167" height="316" alt=""></td>
		<td width="509" height="34" colspan="2" background="Assets/ViewShow_12.gif">&nbsp;
        <input name="title" type="text" id="title" style="color: #FFFFFF;border:none;background-color:transparent;" size="70" value="<?php echo $Show_Name ?>" readonly>
        </td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="34" alt=""></td>
	</tr>
	<tr>
		<td colspan="2">
			<img src="Assets/ViewShow_13.gif" width="509" height="5" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="5" alt=""></td>
	</tr>
	<tr>
		<td width="509" height="34" colspan="2" background="Assets/ViewShow_14.gif">&nbsp;
        <input name="playwright" type="text" id="playwright" style="color: #FFFFFF;border:none;background-color:transparent;" size="70" value="<?php echo $Playwright ?>" readonly>
        </td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="34" alt=""></td>
	</tr>
	<tr>
		<td colspan="2">
			<img src="Assets/ViewShow_15.gif" width="509" height="5" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="5" alt=""></td>
	</tr>
	<tr>
		<td width="509" height="34" colspan="2" background="Assets/ViewShow_16.gif">&nbsp;
        <input name="director" type="text" id="director" style="color: #FFFFFF;border:none;background-color:transparent;" size="70" value="<?php echo $Director ?>" readonly>
        </td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="34" alt=""></td>
	</tr>
	<tr>
		<td colspan="2">
			<img src="Assets/ViewShow_17.gif" width="509" height="5" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="5" alt=""></td>
	</tr>
	<tr>
		<td width="509" height="34" colspan="2" background="Assets/ViewShow_18.gif">&nbsp;
        <input name="auditiondates" type="text" id="auditiondates" style="color: #FFFFFF;border:none;background-color:transparent;" size="70" readonly>
        </td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="34" alt=""></td>
	</tr>
	<tr>
		<td colspan="2">
			<img src="Assets/ViewShow_19.gif" width="509" height="5" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="5" alt=""></td>
	</tr>
	<tr>
		<td width="509" height="34" colspan="2" background="Assets/ViewShow_20.gif">&nbsp;
        <input name="showdates" type="text" id="showdates" style="color: #FFFFFF;border:none;background-color:transparent;" size="70" readonly>
        </td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="34" alt=""></td>
	</tr>
	<tr>
		<td colspan="2">
			<img src="Assets/ViewShow_21.gif" width="509" height="18" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="18" alt=""></td>
	</tr>
	<tr>
		<td rowspan="2">
			<img src="Assets/ViewShow_22.gif" width="419" height="108" alt=""></td>
		<td>
			<input type="image" name="audition" value="audition" src="Assets/ViewShow_23.gif" id"audition"></td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="37" alt=""></td>
	</tr>
	<tr>
		<td>
			<img src="Assets/ViewShow_24.gif" width="90" height="71" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="71" alt=""></td>
	</tr>
	<tr>
		<td rowspan="4">
			<img src="Assets/ViewShow_25.gif" width="118" height="1280" alt=""></td>
		<td width="1163" height="395" colspan="6" background="Assets/ViewShow_26.gif">&nbsp;</td>
		<td rowspan="4">
			<img src="Assets/ViewShow_27.gif" width="36" height="1280" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="395" alt=""></td>
	</tr>
	<tr>
		<td colspan="6">
			<img src="Assets/ViewShow_28.gif" width="1163" height="64" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="64" alt=""></td>
	</tr>
	<tr>
		<td width="1163" height="712" colspan="6" background="Assets/ViewShow_29.gif">&nbsp;</td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="712" alt=""></td>
	</tr>
	<tr>
		<td colspan="6">
			<img src="Assets/ViewShow_30.gif" width="1163" height="109" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="109" alt=""></td>
	</tr>
	<tr>
		<td>
			<img src="Assets/spacer.gif" width="118" height="1" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="278" height="1" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="167" height="1" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="419" height="1" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="90" height="1" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="139" height="1" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="70" height="1" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="36" height="1" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="83" height="1" alt=""></td>
		<td></td>
	</tr>
</table>
</form>
<!-- End Save for Web Slices -->
</body>
</html>