<html>
<head>
<title>AGL: Edit Profile</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?php

if (isset($_POST['Submit'])) 
{
	$idPersonnel = "";
	$Contact_Phone = $_POST['phone'];	
	$Contact_Email = $_POST['email'];
	$Notes = $_POST['fullname'];//fix that
	$First_Name = $_POST['fname'];//not there
	$Last_Name = $_POST['lname'];//not there
	$admin = $_POST['admin'];//not there
	$Height = $_POST['height'];	
	$Weight = $_POST['weight'];
	$Hair_Color = $_POST['hair'];
	$Eye_Color = $_POST['eyecolor'];
	$Previous_Work = $_POST['previousexperience'];//need to fix
	$username = $_POST['username'];//use sessions to save login data
	$password = $_POST['password'];//use sessions to save login data
	$Age = $_POST['age'];
	$Street_Address = $_POST['streetaddress'];
	$State = $_POST['state'];
	$Zip_Code = $_POST['zip'];
	$City = $_POST['city'];
 
	$user_name = 'actorsgu_data';
	$pass_word = 'cliffy36&winepress';
	$database = 'actorsgu_data';
	$server ='localhost:3306';
	
    $con = mysql_connect($server, $user_name, $pass_word, $database);
	$db_handle = mysql_connect($server, $user_name, $pass_word);
	$db_found = mysql_select_db($database, $db_handle);
	
	if($Contact_Phone = "" || $Contact_Email = "" || $Notes = "" ||
	   $First_Name = "" || $Last_Name = "" || $admin = "" ||
	   $Height = "" || $Weight = "" || $Hair_Color = "" || $Eye_Color = "" ||
       $Previous_Work = "" || $username = "" || $passwork = "" || $Age = "" ||
	   $Street_Address = "" || $State = "" || $Zip_Code = "" || $City = "")
	{
		echo "<script type='text/javascript'>
			 alert('Please, make sure you fill out all the fields');".
			 "window.location = 'EditProfile.php';</script>";//redirect back to login page    
		exit;//exit, so that the following code is not executed
	}

	if ($db_found) 
	{
		//==== USE THE FUNCTION BELOW TO ESCAPE ANY DANGEROUS CHARACTERS
		//==== YOU NEED TO USE OT FOR ALL VALUES YOU WANT TO CHECK
	$Contact_Phone = mysql_real_escape_string($Contact_Phone, $db_handle);	
	$Contact_Email = mysql_real_escape_string($Contact_Email, $db_handle);
	$Notes = mysql_real_escape_string($Notes, $db_handle);
	$First_Name = mysql_real_escape_string($First_Name, $db_handle);
	$Last_Name = mysql_real_escape_string($Last_Name, $db_handle); 
	$admin = mysql_real_escape_string($admin, $db_handle);
	$Height = mysql_real_escape_string($Height, $db_handle);	
	$Weight = mysql_real_escape_string($Weight, $db_handle);
	$Hair_Color = mysql_real_escape_string($Hair_Color, $db_handle);
	$Eye_Color = mysql_real_escape_string($Eye_Color, $db_handle);
	$Previous_Work = mysql_real_escape_string($Previous_Work, $db_handle);
	$username = mysql_real_escape_string($username, $db_handle);
	$password = mysql_real_escape_string($password, $db_handle);
	$Age = mysql_real_escape_string($Age, $db_handle);
	$Street_Address = mysql_real_escape_string($Street_Address, $db_handle);
	$State = mysql_real_escape_string($State, $db_handle);
	$Zip_Code = mysql_real_escape_string($Zip_Code, $db_handle);
	$City = mysql_real_escape_string($City, $db_handle);
	
		$admin = 0;//person who is registering on the website, ALWAYS A USER
				 //registration of admin is internal to the AGL
		//check if uset already exist
        $SQL1 = "SELECT MAX(idPersonnel) FROM Personnel";//find maximum of user's id
		$result1 = mysql_query($con,$SQL1);
		$idPersonnel = $result1 + 1;//increment maximum user id and assign it to the regestering user
		$hashedPassword = password_hash($password, PASSWORD_BCRYPT);
		$result1 = mysql_query($con,"INSERT INTO Personnel(admin, idPersonnel,Contact_Phone, Contact_Email, Notes, 
                                                           First_Name, Last_Name, Height, Weight, Hair_Color,
                                                           Eye_Color, Previous_Work, username, password, Age,
                                                           Street_Address, State, Zip_Code, City)
									                VALUES ('admin','idPersonnel','Contact_Phone', 'Contact_Email', 'Notes', 
                                                            'First_Name', 'Last_Name', 'Height', 'Weight', 'Hair_Color',
                                                            'Eye_Color', 'Previous_Work', 'username', 'hashedPassword', 'Age',
                                                            'Street_Address', 'State', 'Zip_Code', 'City')");
		$result2 = mysql_query($con,"SELECT * 
										FROM Personnel
									   WHERE username = '$username'
									     AND password = '$hashedPassword'
							   ");									
					
		if (!$result2)//if there is no result returned, display error message
		{
			echo "<script type='text/javascript'>
				 alert('Error has occured, try again to submit your data');".
				 "window.location = 'EditProfile.php';</script>";//redirect back to login page    
			exit;//exit, so that the following code is not executed
		}
		else
		{
			//after successful registration, display "thank you" message
			print "<h2>Thank you for regestering</h2>";
			echo "<script type='text/javascript'>
				 alert('Thank you for regestering');".
				 "window.location = 'ViewProfile.php';</script>";//redirect back to ViewProfile.php   
			exit;//exit, so that the following code is not executed
		}
	mysql_close($db_handle);
    }
	else 
	{
		print "Database NOT Found ";
		mysql_close($db_handle);
    }
}
?>


</head>
<body bgcolor="#00000" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<!-- Save for Web Slices (CreateProfile_Layout.psd) -->
<table width="1400" height="968" border="0" align="center" cellpadding="0" cellspacing="0" id="Table_01">
	<tr>
		<td colspan="14">
			<img src="Assets/Assets/EditProfile_01.gif" width="1400" height="208" alt=""></td>
	</tr>
	<tr>
		<td colspan="6" rowspan="4">
			<img src="Assets/EditProfile_02.gif" width="484" height="114" alt=""></td>
		<td width="453" height="42" colspan="7" background="EditProfile_03.gif"><label for="name"></label>
      .
      <input type="text" name="name" id="name" style="color: #FFFFFF;border:none;background-color:transparent;" size="65"></td>
		<td rowspan="18">
			<img src="Assets/EditProfile_04.gif" width="463" height="759" alt=""></td>
	</tr>
	<tr>
		<td colspan="7">
			<img src="Assets/EditProfile_05.gif" width="453" height="16" alt=""></td>
	</tr>
	<tr>
		<td width="453" height="42" colspan="7" background="EditProfile_06.gif">.
		  <label for="streetaddress"></label>
	    <input type="text" name="streetaddress" id="streetaddress" style="color: #FFFFFF;border:none;background-color:transparent;" size="65"></td>
	</tr>
	<tr>
		<td colspan="7">
			<img src="Assets/EditProfile_07.gif" width="453" height="14" alt=""></td>
	</tr>
	<tr>
		<td colspan="4" rowspan="10">
			<img src="Assets/EditProfile_08.gif" width="352" height="313" alt=""></td>
		<td width="142" height="42" colspan="3" background="EditProfile_09.gif"><label for="city"></label>
	    .
	    <input type="text" name="city" id="city" size="15" style="color: #FFFFFF;border:none;background-color:transparent;"></td>
		<td rowspan="2">
			<img src="Assets/EditProfile_10.gif" width="75" height="56" alt=""></td>
		<td width="145" height="42" colspan="2" background="EditProfile_11.gif">.
		  <label for="state"></label>
	    <input type="text" name="state" id="state" size="15" style="color: #FFFFFF;border:none;background-color:transparent;"></td>
		<td colspan="2" rowspan="2">
			<img src="Assets/EditProfile_12.gif" width="77" height="56" alt=""></td>
		<td width="146" height="42" background="EditProfile_13.gif">.
		  <label for="zip"></label>
	    <input type="text" name="zip" id="zip" size="15" style="color: #FFFFFF;border:none;background-color:transparent;"></td>
	</tr>
	<tr>
		<td colspan="3">
			<img src="Assets/EditProfile_14.gif" width="142" height="14" alt=""></td>
		<td colspan="2">
			<img src="Assets/EditProfile_15.gif" width="145" height="14" alt=""></td>
		<td>
			<img src="Assets/EditProfile_16.gif" width="146" height="14" alt=""></td>
	</tr>
	<tr>
		<td colspan="2" rowspan="4">
			<img src="Assets/EditProfile_17.gif" width="132" height="107" alt=""></td>
		<td width="453" height="42" colspan="7" background="EditProfile_18.gif">.
		  <label for="email"></label>
	    <input type="text" name="email" id="email" size="65" style="color: #FFFFFF;border:none;background-color:transparent;"></td>
	</tr>
	<tr>
		<td colspan="7">
			<img src="Assets/EditProfile_19.gif" width="453" height="12" alt=""></td>
	</tr>
	<tr>
		<td width="453" height="42" colspan="7" background="EditProfile_20.gif">.
		  <label for="phone"></label>
	    <input type="text" name="phone" id="phone" size="65" style="color: #FFFFFF;border:none;background-color:transparent;"></td>
	</tr>
	<tr>
		<td colspan="7">
			<img src="Assets/EditProfile_21.gif" width="453" height="11" alt=""></td>
	</tr>
	<tr>
		<td width="142" height="42" colspan="3" background="EditProfile_22.gif">.
		  <label for="height"></label>
	    <input type="text" name="height" id="height" size="15" style="color: #FFFFFF;border:none;background-color:transparent;"></td>
		<td rowspan="2">
			<img src="Assets/EditProfile_23.gif" width="75" height="56" alt=""></td>
		<td width="145" height="42" colspan="2" background="EditProfile_24.gif"><label for="weight"></label>
	    .
	    <input type="text" name="weight" id="weight" size="15" style="color: #FFFFFF;border:none;background-color:transparent;"></td>
		<td colspan="2" rowspan="2">
			<img src="Assets/EditProfile_25.gif" width="77" height="56" alt=""></td>
		<td width="146" height="42" background="EditProfile_26.gif">.
		  <label for="age"></label>
	    <input type="text" name="age" id="age" size="15" style="color: #FFFFFF;border:none;background-color:transparent;"></td>
	</tr>
	<tr>
		<td colspan="3">
			<img src="Assets/EditProfile_27.gif" width="142" height="14" alt=""></td>
		<td colspan="2">
			<img src="Assets/EditProfile_28.gif" width="145" height="14" alt=""></td>
		<td>
			<img src="Assets/EditProfile_29.gif" width="146" height="14" alt=""></td>
	</tr>
	<tr>
		<td rowspan="2">
			<img src="Assets/EditProfile_30.gif" width="38" height="94" alt=""></td>
		<td width="218" height="42" colspan="4" background="EditProfile_31.gif">.
		  <label for="hair"></label>
	    <input type="text" name="hair" id="hair" size="25" style="color: #FFFFFF;border:none;background-color:transparent;"></td>
		<td colspan="2" rowspan="2">
			<img src="Assets/EditProfile_32.gif" width="115" height="94" alt=""></td>
		<td width="214" height="42" colspan="2" background="EditProfile_33.gif">.
		  <label for="eyecolor"></label>
	    <input type="text" name="eyecolor" id="eyecolor" size="25" style="color: #FFFFFF;border:none;background-color:transparent;"></td>
	</tr>
	<tr>
		<td colspan="4">
			<img src="Assets/EditProfile_34.gif" width="218" height="52" alt=""></td>
		<td colspan="2">
			<img src="Assets/EditProfile_35.gif" width="214" height="52" alt=""></td>
	</tr>
	<tr>
		<td rowspan="4">
			<img src="Assets/EditProfile_36.gif" width="286" height="332" alt=""></td>
		<td width="651" height="173" colspan="12" background="EditProfile_37.gif"><label for="previousexperience"></label>
	    .
	    <textarea name="previousexperience" id="previousexperience" cols="75" rows="9" style="color: #FFFFFF;border:none;background-color:transparent;"></textarea></td>
	</tr>
	<tr>
		<td colspan="12">
			<img src="Assets/EditProfile_38.gif" width="651" height="15" alt=""></td>
	</tr>
	<tr>
		<td rowspan="2">
			<img src="Assets/EditProfile_39.gif" width="16" height="144" alt=""></td>
		<td width="30" height="28" background="EditProfile_40.gif"><input type="checkbox" name="notifications" id="notifications">
	    <label for="notifications"></label></td>
		<td colspan="10" rowspan="2">
			<img src="Assets/EditProfile_41.gif" width="605" height="144" alt=""></td>
	</tr>
	<tr>
		<td>
			<img src="Assets/EditProfile_42.gif" width="30" height="116" alt=""></td>
	</tr>
	<tr>
		<td>
			<img src="Assets/spacer.gif" width="286" height="1" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="16" height="1" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="30" height="1" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="20" height="1" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="38" height="1" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="94" height="1" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="10" height="1" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="75" height="1" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="39" height="1" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="106" height="1" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="9" height="1" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="68" height="1" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="146" height="1" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="463" height="1" alt=""></td>
	</tr>
</table>
<!-- End Save for Web Slices -->
</body>
</html>
