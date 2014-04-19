<html>
<head>
<title>AGL: View Profile</title>
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
	//Redirect to EditProfile.php
	if (isset($_POST['editprofile'])) 
	{
		echo "<script type='text/javascript'>
			window.location = 'EditProfile.php';</script>";
		
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
	//-------------------------
	// Acquire user info from Personnel table
	$user_name = 'actorsgu_data';
	$pass_word = 'cliffy36&winepress';
	$database = 'actorsgu_data';
	$server ='localhost:3306';
		
	$db_handle = mysql_connect($server, $user_name, $pass_word);
	$db_found = mysql_select_db($database, $db_handle);
	
	if ($db_found) 
	{
		$SQL = "SELECT * FROM Personnel WHERE Contact_Email = '$email' AND password = '$password'";	
		$result = mysql_query($SQL);
		$num_rows = mysql_num_rows($result);
		$db_field = mysql_fetch_array($result);
		if($num_rows > 0) // if user exists in the data base
		{
		//Fill in that info
			$First_Name = $db_field['First_Name'];//not there
			$Last_Name = $db_field['Last_Name'];//not there
			$Street_Address = $db_field['Street_Address'];
			$City = $db_field['City'];
			$State = $db_field['State'];
			$Zip_Code = $db_field['Zip_Code'];
			$Contact_Phone = $db_field['Contact_Phone'];
			$Height = $db_field['Height'];	
			$Weight = $db_field['Weight'];
			$Age = $db_field['Age'];
			$Hair_Color = $db_field['Hair_Color'];
			$Hair_Style = $db_field['Hair_Style'];
			$Eye_Color = $db_field['Eye_Color'];
			$Ethnicity = $db_field['Ethnicity'];
			$Gender = $db_field['Gender'];
			$Previous_Work = $db_field['Previous_Work'];//need to fix
		}
		else
		{
			echo "<script type='text/javascript'>
				 alert('There was an error retreiving your information.');".
				 "window.location = 'EditProfile.php';</script>";//redirect back to login page    
			exit;//exit, so that the following code is not executed
		}
	}
	mysql_close($db_handle);
	
	//--------------------------------------------
?>
</head>
<body bgcolor="#00000" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<!-- Save for Web Slices (ViewProfile.psd) -->
<form name="form" method="post" action="ViewProfile.php">
<table width="1401" height="1681" border="0" align="center" cellpadding="0" cellspacing="0" id="Table_01">
	<tr>
		<td colspan="9">
			<img src="images/ViewProfile_01.gif" width="1400" height="71" alt=""></td>
		<td>
			<img src="images/spacer.gif" width="1" height="71" alt=""></td>
	</tr>
	<tr>
		<td colspan="6" rowspan="3">
			<img src="images/ViewProfile_02.gif" width="1211" height="180" alt=""></td>
		<td colspan="2">
			<input type="image" name="home" value="home" src="Assets/ViewProfile_03.gif" id="home"></td>
		<td rowspan="41">
			<img src="images/ViewProfile_04.gif" width="83" height="1609" alt=""></td>
		<td>
			<img src="images/spacer.gif" width="1" height="33" alt=""></td>
	</tr>
	<tr>
		<td colspan="2">
			<input type="image" name="logout" value="logout" src="Assets/ViewProfile_05.gif" id"logout"></td>
		<td>
			<img src="images/spacer.gif" width="1" height="33" alt=""></td>
	</tr>
	<tr>
		<td colspan="2" rowspan="2">
			<img src="images/ViewProfile_06.gif" width="106" height="121" alt=""></td>
		<td>
			<img src="images/spacer.gif" width="1" height="114" alt=""></td>
	</tr>
	<tr>
		<td rowspan="38">
			<img src="images/ViewProfile_07.gif" width="233" height="1429" alt=""></td>
		<td width="335" height="413" colspan="2" rowspan="8" background="images/ViewProfile_08.gif">
        <img src=
			<?php
				$user_name = 'actorsgu_data';
				$pass_word = 'cliffy36&winepress';
				$database = 'actorsgu_data';
				$server ='localhost:3306';
					
				$db_handle = mysql_connect($server, $user_name, $pass_word);
				$db_found = mysql_select_db($database, $db_handle);
				
				if($db_found)
				{
					$SQL = "SELECT * FROM Personnel WHERE Contact_Email = '$email'";	
					$result = mysql_query($SQL);
					$db_field = mysql_fetch_array($result);
					$num_rows = mysql_num_rows($result);
					if($num_rows > 0)
					{
						$pic = $db_field['Picture'];
						echo $pic;
					}
				}
				mysql_close($db_handle);
				
				
		   ?> 
		width="335" height="415" alt="Headshot"></img>
        </td>
		<td colspan="3">
			<img src="images/ViewProfile_09.gif" width="643" height="7" alt=""></td>
		<td>
			<img src="images/spacer.gif" width="1" height="7" alt=""></td>
	</tr>
	<tr>
		<td rowspan="37">
			<img src="images/ViewProfile_10.gif" width="21" height="1422" alt=""></td>
		<td width="676" height="245" colspan="3" background="images/ViewProfile_11.gif">&nbsp;
        <textarea name="previousexperience" id="previousexperience" cols="75" rows="13" style="color: #FFFFFF;border:none;background-color:transparent;"><?php echo $Previous_Work ?></textarea>
        </td>
		<td rowspan="37">
			<img src="images/ViewProfile_12.gif" width="52" height="1422" alt=""></td>
		<td>
			<img src="images/spacer.gif" width="1" height="245" alt=""></td>
	</tr>
	<tr>
		<td colspan="3">
			<img src="images/ViewProfile_13.gif" width="676" height="61" alt=""></td>
		<td>
			<img src="images/spacer.gif" width="1" height="61" alt=""></td>
	</tr>
	<tr>
		<td rowspan="35">
			<img src="images/ViewProfile_14.gif" width="167" height="1116" alt=""></td>
		<td width="509" height="34" colspan="2" background="images/ViewProfile_15.gif">&nbsp;
        <input name="firstname" type="text" id="firstname" style="color: #FFFFFF;border:none;background-color:transparent;" size="75" value="<?php echo $First_Name ?>" readonly>
        </td>
		<td>
			<img src="images/spacer.gif" width="1" height="34" alt=""></td>
	</tr>
	<tr>
		<td colspan="2">
			<img src="images/ViewProfile_16.gif" width="509" height="5" alt=""></td>
		<td>
			<img src="images/spacer.gif" width="1" height="5" alt=""></td>
	</tr>
	<tr>
		<td width="509" height="34" colspan="2" background="images/ViewProfile_17.gif">&nbsp;
        <input name="lastname" type="text" id="lastname" style="color: #FFFFFF;border:none;background-color:transparent;" size="75" value="<?php echo $Last_Name ?>" readonly>
        </td>
		<td>
			<img src="images/spacer.gif" width="1" height="34" alt=""></td>
	</tr>
	<tr>
		<td colspan="2">
			<img src="images/ViewProfile_18.gif" width="509" height="5" alt=""></td>
		<td>
			<img src="images/spacer.gif" width="1" height="5" alt=""></td>
	</tr>
	<tr>
		<td width="509" height="34" colspan="2" rowspan="2" background="images/ViewProfile_19.gif">&nbsp;
        <input name="address" type="text" id="address" style="color: #FFFFFF;border:none;background-color:transparent;" size="75" value="<?php echo $Street_Address ?>" readonly>
        </td>
		<td>
			<img src="images/spacer.gif" width="1" height="22" alt=""></td>
	</tr>
	<tr>
		<td colspan="2" rowspan="3">
			<img src="images/ViewProfile_20.gif" width="335" height="20" alt=""></td>
		<td>
			<img src="images/spacer.gif" width="1" height="12" alt=""></td>
	</tr>
	<tr>
		<td colspan="2">
			<img src="images/ViewProfile_21.gif" width="509" height="5" alt=""></td>
		<td>
			<img src="images/spacer.gif" width="1" height="5" alt=""></td>
	</tr>
	<tr>
		<td width="509" height="34" colspan="2" rowspan="2" background="images/ViewProfile_22.gif">&nbsp;
        <input name="city" type="text" id="city" style="color: #FFFFFF;border:none;background-color:transparent;" size="75" value="<?php echo $City ?>" readonly>
        </td>
		<td>
			<img src="images/spacer.gif" width="1" height="3" alt=""></td>
	</tr>
	<tr>
		<td rowspan="27">
			<img src="images/ViewProfile_23.gif" width="232" height="996" alt=""></td>
		<td rowspan="3">
			<input type="image" name="editprofile" value="editprofile" src="Assets/ViewProfile_24.gif" id"editprofile"></td>
		<td>
			<img src="images/spacer.gif" width="1" height="31" alt=""></td>
	</tr>
	<tr>
		<td colspan="2">
			<img src="images/ViewProfile_25.gif" width="509" height="5" alt=""></td>
		<td>
			<img src="images/spacer.gif" width="1" height="5" alt=""></td>
	</tr>
	<tr>
		<td width="509" height="34" colspan="2" rowspan="2" background="images/ViewProfile_26.gif">&nbsp;
        <input name="state" type="text" id="state" style="color: #FFFFFF;border:none;background-color:transparent;" size="75" value="<?php echo $State ?>" readonly>
        </td>
		<td>
			<img src="images/spacer.gif" width="1" height="4" alt=""></td>
	</tr>
	<tr>
		<td rowspan="24">
			<img src="images/ViewProfile_27.gif" width="103" height="956" alt=""></td>
		<td>
			<img src="images/spacer.gif" width="1" height="30" alt=""></td>
	</tr>
	<tr>
		<td colspan="2">
			<img src="images/ViewProfile_28.gif" width="509" height="4" alt=""></td>
		<td>
			<img src="images/spacer.gif" width="1" height="4" alt=""></td>
	</tr>
	<tr>
		<td width="509" height="34" colspan="2" background="images/ViewProfile_29.gif">&nbsp;
        <input name="zipcode" type="text" id="zipcode" style="color: #FFFFFF;border:none;background-color:transparent;" size="75" value="<?php echo $Zip_Code ?>" readonly>
        </td>
		<td>
			<img src="images/spacer.gif" width="1" height="34" alt=""></td>
	</tr>
	<tr>
		<td colspan="2">
			<img src="images/ViewProfile_30.gif" width="509" height="5" alt=""></td>
		<td>
			<img src="images/spacer.gif" width="1" height="5" alt=""></td>
	</tr>
	<tr>
		<td width="509" height="34" colspan="2" background="images/ViewProfile_31.gif">&nbsp;
        <input name="phonenumber" type="text" id="phonenumber" style="color: #FFFFFF;border:none;background-color:transparent;" size="75" value="<?php echo $Contact_Phone ?>" readonly>
        </td>
		<td>
			<img src="images/spacer.gif" width="1" height="34" alt=""></td>
	</tr>
	<tr>
		<td colspan="2">
			<img src="images/ViewProfile_32.gif" width="509" height="5" alt=""></td>
		<td>
			<img src="images/spacer.gif" width="1" height="5" alt=""></td>
	</tr>
	<tr>
		<td width="509" height="34" colspan="2" background="images/ViewProfile_33.gif">&nbsp;
        <input name="email" type="text" id="email" style="color: #FFFFFF;border:none;background-color:transparent;" size="75" value="<?php echo $email ?>" readonly>
        </td>
		<td>
			<img src="images/spacer.gif" width="1" height="34" alt=""></td>
	</tr>
	<tr>
		<td colspan="2">
			<img src="images/ViewProfile_34.gif" width="509" height="68" alt=""></td>
		<td>
			<img src="images/spacer.gif" width="1" height="68" alt=""></td>
	</tr>
	<tr>
		<td width="509" height="34" colspan="2" background="images/ViewProfile_35.gif">&nbsp;
        <input name="gender" type="text" id="gender" style="color: #FFFFFF;border:none;background-color:transparent;" size="75" value="<?php echo $Gender ?>" readonly>
        </td>
		<td>
			<img src="images/spacer.gif" width="1" height="34" alt=""></td>
	</tr>
	<tr>
		<td colspan="2">
			<img src="images/ViewProfile_36.gif" width="509" height="6" alt=""></td>
		<td>
			<img src="images/spacer.gif" width="1" height="6" alt=""></td>
	</tr>
	<tr>
		<td width="509" height="34" colspan="2" background="images/ViewProfile_37.gif">&nbsp;
        <input name="ethnicity" type="text" id="ethnicity" style="color: #FFFFFF;border:none;background-color:transparent;" size="75" value="<?php echo $Ethnicity ?>" readonly>
        </td>
		<td>
			<img src="images/spacer.gif" width="1" height="34" alt=""></td>
	</tr>
	<tr>
		<td colspan="2">
			<img src="images/ViewProfile_38.gif" width="509" height="5" alt=""></td>
		<td>
			<img src="images/spacer.gif" width="1" height="5" alt=""></td>
	</tr>
	<tr>
		<td width="509" height="34" colspan="2" background="images/ViewProfile_39.gif">&nbsp;
        <input name="height" type="text" id="height" style="color: #FFFFFF;border:none;background-color:transparent;" size="75" value="<?php echo $Height ?>" readonly>
        </td>
		<td>
			<img src="images/spacer.gif" width="1" height="34" alt=""></td>
	</tr>
	<tr>
		<td colspan="2">
			<img src="images/ViewProfile_40.gif" width="509" height="6" alt=""></td>
		<td>
			<img src="images/spacer.gif" width="1" height="6" alt=""></td>
	</tr>
	<tr>
		<td width="509" height="34" colspan="2" background="images/ViewProfile_41.gif">&nbsp;
        <input name="weight" type="text" id="weight" style="color: #FFFFFF;border:none;background-color:transparent;" size="75" value="<?php echo $Weight ?>" readonly>
        </td>
		<td>
			<img src="images/spacer.gif" width="1" height="34" alt=""></td>
	</tr>
	<tr>
		<td colspan="2">
			<img src="images/ViewProfile_42.gif" width="509" height="6" alt=""></td>
		<td>
			<img src="images/spacer.gif" width="1" height="6" alt=""></td>
	</tr>
	<tr>
		<td width="509" height="34" colspan="2" background="images/ViewProfile_43.gif">&nbsp;
        <input name="age" type="text" id="age" style="color: #FFFFFF;border:none;background-color:transparent;" size="75" value="<?php echo $Age ?>" readonly>
        </td>
		<td>
			<img src="images/spacer.gif" width="1" height="34" alt=""></td>
	</tr>
	<tr>
		<td colspan="2">
			<img src="images/ViewProfile_44.gif" width="509" height="5" alt=""></td>
		<td>
			<img src="images/spacer.gif" width="1" height="5" alt=""></td>
	</tr>
	<tr>
		<td width="509" height="34" colspan="2" background="images/ViewProfile_45.gif">&nbsp;
        <input name="eyecolor" type="text" id="eyecolor" style="color: #FFFFFF;border:none;background-color:transparent;" size="75" value="<?php echo $Eye_Color ?>" readonly>
        </td>
		<td>
			<img src="images/spacer.gif" width="1" height="34" alt=""></td>
	</tr>
	<tr>
		<td colspan="2">
			<img src="images/ViewProfile_46.gif" width="509" height="5" alt=""></td>
		<td>
			<img src="images/spacer.gif" width="1" height="5" alt=""></td>
	</tr>
	<tr>
		<td width="509" height="34" colspan="2" background="images/ViewProfile_47.gif">&nbsp;
        <input name="haircolor" type="text" id="haircolor" style="color: #FFFFFF;border:none;background-color:transparent;" size="75" value="<?php echo $Hair_Color ?>" readonly>
        </td>
		<td>
			<img src="images/spacer.gif" width="1" height="34" alt=""></td>
	</tr>
	<tr>
		<td colspan="2">
			<img src="images/ViewProfile_48.gif" width="509" height="6" alt=""></td>
		<td>
			<img src="images/spacer.gif" width="1" height="6" alt=""></td>
	</tr>
	<tr>
		<td width="509" height="34" colspan="2" background="images/ViewProfile_49.gif">&nbsp;
        <input name="hairstyle" type="text" id="hairstyle" style="color: #FFFFFF;border:none;background-color:transparent;" size="75" value="<?php echo $Hair_Style ?>" readonly>
        </td>
		<td>
			<img src="images/spacer.gif" width="1" height="34" alt=""></td>
	</tr>
	<tr>
		<td colspan="2">
			<img src="images/ViewProfile_50.gif" width="509" height="431" alt=""></td>
		<td>
			<img src="images/spacer.gif" width="1" height="431" alt=""></td>
	</tr>
	<tr>
		<td>
			<img src="images/spacer.gif" width="233" height="1" alt=""></td>
		<td>
			<img src="images/spacer.gif" width="232" height="1" alt=""></td>
		<td>
			<img src="images/spacer.gif" width="103" height="1" alt=""></td>
		<td>
			<img src="images/spacer.gif" width="21" height="1" alt=""></td>
		<td>
			<img src="images/spacer.gif" width="167" height="1" alt=""></td>
		<td>
			<img src="images/spacer.gif" width="455" height="1" alt=""></td>
		<td>
			<img src="images/spacer.gif" width="54" height="1" alt=""></td>
		<td>
			<img src="images/spacer.gif" width="52" height="1" alt=""></td>
		<td>
			<img src="images/spacer.gif" width="83" height="1" alt=""></td>
		<td></td>
	</tr>
</table>
</form>
<!-- End Save for Web Slices -->
</body>
</html>
