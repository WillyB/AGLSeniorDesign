<html>
<head>
<title>AGL: Edit Profile</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?php
$role = $_COOKIE['role'];
$email = $_COOKIE['email'];
$password = $_COOKIE['password'];

//redirect to ListUsers.php when "HOME" button is clicked
if (isset($_POST['home'])) 
{
	echo "<script type='text/javascript'>
		  window.location = 'AdminTools.php';</script>";
	exit;
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

if (isset($_POST['save'])) 
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
		$idPersonnel = $result1 + 1;//increment maximum user id and assign it to the registering user
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
<!-- Save for Web Slices (CreateProfile_Layout2.psd) -->
<form name="form" method="post" action="EditProfile.php">
<table width="1401" height="968" border="0" align="center" cellpadding="0" cellspacing="0" id="Table_01">
	<tr>
		<td colspan="19">
			<img src="Assets/EditProfile_01.gif" width="1400" height="70" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="70" alt=""></td>
	</tr>
	<tr>
		<td colspan="16" rowspan="3">
			<img src="Assets/EditProfile_02.gif" width="1211" height="138" alt=""></td>
		<td><input type="image" name="home" value="home" src="Assets/EditProfile_03.gif" id="home"></td>
		<td colspan="2" rowspan="3">
			<img src="Assets/EditProfile_04.gif" width="83" height="138" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="34" alt=""></td>
	</tr>
	<tr>
		<td><input type="image" name="logout" value="logout" src="Assets/EditProfile_05.gif" id"logout"></td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="34" alt=""></td>
	</tr>
	<tr>
		<td>
			<img src="Assets/EditProfile_06.gif" width="106" height="70" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="70" alt=""></td>
	</tr>
	<tr>
		<td colspan="4" rowspan="4">
			<img src="Assets/EditProfile_07.gif" width="484" height="114" alt=""></td>
		<td width="203" height="42" colspan="4" background="Assets/EditProfile_08.gif">&nbsp;
        <label for="firstname"></label>
	   <input type="text" name="firstname" id="firstname" style="color: #FFFFFF;border:none;background-color:transparent;" size="26">
        </td>
		<td width="250" height="42" colspan="6" background="Assets/EditProfile_09.gif">&nbsp;
        <label for="lastname"></label>
	      <input type="text" name="lastname" id="lastname" style="color: #FFFFFF;border:none;background-color:transparent;" size="30">
        </td>
		<td colspan="5" rowspan="5">
			<img src="Assets/EditProfile_10.gif" width="463" height="116" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="42" alt=""></td>
	</tr>
	<tr>
		<td colspan="10">
			<img src="Assets/EditProfile_11.gif" width="453" height="16" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="16" alt=""></td>
	</tr>
	<tr>
		<td width="453" height="42" colspan="10" background="Assets/EditProfile_12.gif">&nbsp;
        <label for="streetaddress"></label>
	    <input type="text" name="streetaddress" id="streetaddress" style="color: #FFFFFF;border:none;background-color:transparent;" size="65">
        </td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="42" alt=""></td>
	</tr>
	<tr>
		<td colspan="10">
			<img src="Assets/EditProfile_13.gif" width="453" height="14" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="14" alt=""></td>
	</tr>
	<tr>
		<td colspan="2" rowspan="16">
			<img src="Assets/EditProfile_14.gif" width="352" height="303" alt=""></td>
		<td width="142" height="42" colspan="3" rowspan="2" background="Assets/EditProfile_15.gif">&nbsp;
        <label for="city"></label>
	    <input type="text" name="city" id="city" size="15" style="color: #FFFFFF;border:none;background-color:transparent;">
        </td>
		<td rowspan="5">
			<img src="Assets/EditProfile_16.gif" width="75" height="57" alt=""></td>
		<td width="145" height="42" colspan="3" rowspan="2" background="Assets/EditProfile_17.gif">&nbsp;
        <label for="state"></label>
		  <select name="state" id="state">
		    <option value="" selected> </option>
		    <option value="AL">AL</option>
		    <option value="AK">AK</option>
		    <option value="AZ">AZ</option>
		    <option value="AR">AR</option>
		    <option value="CA">CA</option>
		    <option value="CO">CO</option>
		    <option value="CT">CT</option>
		    <option value="DE">DE</option>
		    <option value="DC">DC</option>
		    <option value="FL">FL</option>
		    <option value="GA">GA</option>
		    <option value="HI">HI</option>
		    <option value="ID">ID</option>
		    <option value="IL">IL</option>
		    <option value="IN">IN</option>
		    <option value="IA">IA</option>
		    <option value="KS">KS</option>
		    <option value="KY">KY</option>
		    <option value="LA">LA</option>
		    <option value="ME">ME</option>
		    <option value="MD">MD</option>
		    <option value="MA">MA</option>
		    <option value="MI">MI</option>
		    <option value="MN">MN</option>
		    <option value="MS">MS</option>
		    <option value="MO">MO</option>
		    <option value="MT">MT</option>
		    <option value="NE">NE</option>
		    <option value="NV">NV</option>
		    <option value="NH">NH</option>
		    <option value="NJ">NJ</option>
		    <option value="NM">NM</option>
		    <option value="NY">NY</option>
		    <option value="NC">NC</option>
		    <option value="ND">ND</option>
		    <option value="OH">OH</option>
		    <option value="OK">OK</option>
		    <option value="OR">OR</option>
		    <option value="PA">PA</option>
		    <option value="RI">RI</option>
		    <option value="SC">SC</option>
		    <option value="SD">SD</option>
		    <option value="TN">TN</option>
		    <option value="TX">TX</option>
		    <option value="UT">UT</option>
		    <option value="VT">VT</option>
		    <option value="VA">VA</option>
		    <option value="WA">WA</option>
		    <option value="WV">WV</option>
		    <option value="WI">WI</option>
		    <option value="WY">WY</option>
        </select>
        </td>
		<td colspan="2" rowspan="5">
			<img src="Assets/EditProfile_18.gif" width="77" height="57" alt=""></td>
		<td width="146" height="42" colspan="3" rowspan="2" background="Assets/EditProfile_19.gif">&nbsp;
        <label for="zip"></label>
	    <input type="text" name="zip" id="zip" size="15" style="color: #FFFFFF;border:none;background-color:transparent;">
        </td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="2" alt=""></td>
	</tr>
	<tr>
		<td rowspan="19">
			<img src="Assets/EditProfile_20.gif" width="142" height="643" alt=""></td>
		<td width="249" height="42" colspan="3" rowspan="2" background="Assets/EditProfile_21.gif">&nbsp;
        <label for="email"></label>
	   <input type="text" name="email" id="email" style="color: #FFFFFF;border:none;background-color:transparent;" size="30">
        </td>
		<td rowspan="19">
			<img src="Assets/EditProfile_22.gif" width="72" height="643" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="40" alt=""></td>
	</tr>
	<tr>
		<td colspan="3" rowspan="3">
			<img src="Assets/EditProfile_23.gif" width="142" height="15" alt=""></td>
		<td colspan="3" rowspan="3">
			<img src="Assets/EditProfile_24.gif" width="145" height="15" alt=""></td>
		<td colspan="3" rowspan="3">
			<img src="Assets/EditProfile_25.gif" width="146" height="15" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="2" alt=""></td>
	</tr>
	<tr>
		<td colspan="3">
			<img src="Assets/EditProfile_26.gif" width="249" height="10" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="10" alt=""></td>
	</tr>
	<tr>
		<td width="249" height="40" colspan="3" rowspan="2" background="Assets/EditProfile_27.gif">&nbsp;
         <label for="password"></label>
	   <input type="password" name="password" id="password" style="color: #FFFFFF;border:none;background-color:transparent;" size="30">
        </td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="3" alt=""></td>
	</tr>
	<tr>
		<td colspan="2" rowspan="4">
			<img src="Assets/EditProfile_28.gif" width="132" height="53" alt=""></td>
		<td width="453" height="42" colspan="10" rowspan="2" background="Assets/EditProfile_29.gif">&nbsp;
        <label for="phone"></label>
	    <input type="text" name="phone" id="phone" size="65" style="color: #FFFFFF;border:none;background-color:transparent;">
        </td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="37" alt=""></td>
	</tr>
	<tr>
		<td colspan="3" rowspan="2">
			<img src="Assets/EditProfile_30.gif" width="249" height="12" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="5" alt=""></td>
	</tr>
	<tr>
		<td colspan="10" rowspan="2">
			<img src="Assets/EditProfile_31.gif" width="453" height="11" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="7" alt=""></td>
	</tr>
	<tr>
		<td width="249" height="39" colspan="3" rowspan="2" background="Assets/EditProfile_32.gif">&nbsp;
         <label for="confirmpassword"></label>
	   <input type="password" name="confirmpassword" id="confirmpassword" style="color: #FFFFFF;border:none;background-color:transparent;" size="30">
        </td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="4" alt=""></td>
	</tr>
	<tr>
		<td width="142" height="42" colspan="3" rowspan="2" background="Assets/EditProfile_33.gif">&nbsp;
        <label for="height"></label>
        <select name="height" id="height">
          <option value="" selected> </option>
          <option value="4.00">4'0&quot;</option>
          <option value="4.01">4'1&quot;</option>
          <option value="4.02">4'2&quot;</option>
          <option value="4.03">4'3&quot;</option>
          <option value="4.04">4'4&quot;</option>
          <option value="4.05">4'5&quot;</option>
          <option value="4.06">4'6&quot;</option>
          <option value="4.07">4'7&quot;</option>
          <option value="4.08">4'8&quot;</option>
          <option value="4.09">4'9&quot;</option>
          <option value="4.10">4'10&quot;</option>
          <option value="4.11">4'11&quot;</option>
          <option value="5.00">5'0&quot;</option>
          <option value="5.01">5'1&quot;</option>
          <option value="5.02">5'2&quot;</option>
          <option value="5.03">5'3&quot;</option>
          <option value="5.04">5'4&quot;</option>
          <option value="5.05">5'5&quot;</option>
          <option value="5.06">5'6&quot;</option>
          <option value="5.07">5'7&quot;</option>
          <option value="5.08">5'8&quot;</option>
          <option value="5.09">5'9&quot;</option>
          <option value="5.10">5'10&quot;</option>
          <option value="5.11">5'11&quot;</option>
          <option value="6.00">6'0&quot;</option>
          <option value="6.01">6'1&quot;</option>
          <option value="6.02">6'2&quot;</option>
          <option value="6.03">6'3&quot;</option>
          <option value="6.04">6'4&quot;</option>
          <option value="6.05">6'5&quot;</option>
          <option value="6.06">6'6&quot;</option>
          <option value="6.07">6'7&quot;</option>
          <option value="6.08">6'8&quot;</option>
          <option value="6.09">6'9&quot;</option>
          <option value="6.10">6'10&quot;</option>
          <option value="6.11">6'11&quot;</option>
          <option value="7.00">7'0&quot;</option>
        </select>
        </td>
		<td rowspan="5">
			<img src="Assets/EditProfile_34.gif" width="75" height="110" alt=""></td>
		<td width="145" height="42" colspan="3" rowspan="2" background="Assets/EditProfile_35.gif">&nbsp;
        <label for="weight"></label>
	    <input type="text" name="weight" id="weight" size="15" style="color: #FFFFFF;border:none;background-color:transparent;">
        </td>
		<td colspan="2" rowspan="5">
			<img src="Assets/EditProfile_36.gif" width="77" height="110" alt=""></td>
		<td width="146" height="42" colspan="3" rowspan="2" background="Assets/EditProfile_37.gif">&nbsp;
        <label for="age"></label>
	    <input type="text" name="age" id="age" size="15" style="color: #FFFFFF;border:none;background-color:transparent;">
        </td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="35" alt=""></td>
	</tr>
	<tr>
		<td colspan="3" rowspan="10">
			<img src="Assets/EditProfile_38.gif" width="249" height="500" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="7" alt=""></td>
	</tr>
	<tr>
		<td colspan="3">
			<img src="Assets/EditProfile_39.gif" width="142" height="11" alt=""></td>
		<td colspan="3">
			<img src="Assets/EditProfile_40.gif" width="145" height="11" alt=""></td>
		<td colspan="3">
			<img src="Assets/EditProfile_41.gif" width="146" height="11" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="11" alt=""></td>
	</tr>
	<tr>
		<td width="142" height="43" colspan="3" background="Assets/EditProfile_42.gif">&nbsp;
        <label for="haircolor"></label>
        <select name="haircolor" id="haircolor">
          <option value="" selected> </option>
          <option value="blonde">Blonde</option>
          <option value="brown">Brown</option>
          <option value="red">Red</option>
          <option value="black">Black</option>
          <option value="gray">Gray</option>
          <option value="other">Other</option>
        </select>
        </td>
		<td width="145" height="43" colspan="3" background="Assets/EditProfile_43.gif">&nbsp;
        <label for="hairstyle"></label>
        <select name="hairstyle" id="hairstyle">
          <option value="" selected> </option>
          <option value="long">Long</option>
          <option value="short">Short</option>
          <option value="buzz">Buzz</option>
          <option value="blad">Bald</option>
          <option value="other">Other</option>
        </select>
        </td>
		<td width="146" height="43" colspan="3" background="Assets/EditProfile_44.gif">&nbsp;
        <label for="eyecolor"></label>
		  <select name="eyecolor" id="eyecolor">
		    <option value="" selected> </option>
		    <option value="blue">Blue</option>
		    <option value="brown">Brown</option>
		    <option value="green">Green</option>
		    <option value="gray">Gray</option>
		    <option value="other">Other</option>
        </select>
        </td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="43" alt=""></td>
	</tr>
	<tr>
		<td colspan="3">
			<img src="Assets/EditProfile_45.gif" width="142" height="14" alt=""></td>
		<td colspan="3">
			<img src="Assets/EditProfile_46.gif" width="145" height="14" alt=""></td>
		<td colspan="3">
			<img src="Assets/EditProfile_47.gif" width="146" height="14" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="14" alt=""></td>
	</tr>
	<tr>
		<td rowspan="2">
			<img src="Assets/EditProfile_48.gif" width="38" height="83" alt=""></td>
		<td width="228" height="43" colspan="4" background="Assets/EditProfile_49.gif">&nbsp;
        <label for="ethnicity"></label>
		  <select name="ethnicity" id="ethnicity">
		    <option value="" selected> </option>
		    <option value="hispanic">Hispanic/Latino</option>
		    <option value="african american">African American</option>
		    <option value="asian">Asian</option>
		    <option value="oceania">Native Hawaiian/Pacific Islander</option>
		    <option value="american indian">American Indian</option>
		    <option value="alaskan native">Alaskan Native</option>
		    <option value="caucasian">Caucasian</option>
		    <option value="middle eastern">Middle Eastern</option>
		    <option value="other">Other</option>
        </select>
        </td>
		<td colspan="3" rowspan="2">
			<img src="Assets/EditProfile_50.gif" width="105" height="83" alt=""></td>
		<td width="214" height="43" colspan="4" background="Assets/EditProfile_51.gif">&nbsp;
        <label for="gender"></label>
		  <select name="gender" id="gender">
		    <option value="" selected> </option>
		    <option value="male">Male</option>
		    <option value="female">Female</option>
        </select>
        </td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="43" alt=""></td>
	</tr>
	<tr>
		<td colspan="4">
			<img src="Assets/EditProfile_52.gif" width="228" height="40" alt=""></td>
		<td colspan="4">
			<img src="Assets/EditProfile_53.gif" width="214" height="40" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="40" alt=""></td>
	</tr>
	<tr>
		<td rowspan="4">
			<img src="Assets/EditProfile_54.gif" width="286" height="342" alt=""></td>
		<td width="651" height="174" colspan="13" background="Assets/EditProfile_55.gif">&nbsp;
        <label for="previousexperience"></label>
	    <textarea name="previousexperience" id="previousexperience" cols="75" rows="9" style="color: #FFFFFF;border:none;background-color:transparent;"></textarea>
        </td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="174" alt=""></td>
	</tr>
	<tr>
		<td colspan="13">
			<img src="Assets/EditProfile_56.gif" width="651" height="15" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="15" alt=""></td>
	</tr>
	<tr>
		<td colspan="11" rowspan="2">
			<img src="Assets/EditProfile_57.gif" width="577" height="153" alt=""></td>
		<td><input type="image" name="save" value="save" src="Assets/EditProfile_58.gif" id="save"></td>
		<td rowspan="2">
			<img src="Assets/EditProfile_59.gif" width="6" height="153" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="41" alt=""></td>
	</tr>
	<tr>
		<td>
			<img src="Assets/EditProfile_60.gif" width="68" height="112" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="112" alt=""></td>
	</tr>
	<tr>
		<td>
			<img src="Assets/spacer.gif" width="286" height="1" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="66" height="1" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="38" height="1" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="94" height="1" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="10" height="1" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="75" height="1" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="49" height="1" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="69" height="1" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="27" height="1" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="9" height="1" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="68" height="1" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="72" height="1" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="68" height="1" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="6" height="1" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="142" height="1" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="132" height="1" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="106" height="1" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="11" height="1" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="72" height="1" alt=""></td>
		<td></td>
	</tr>
</table>
</form>
<!-- End Save for Web Slices -->
</body>
</html>
