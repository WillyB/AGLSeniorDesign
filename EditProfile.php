<html>
<head>
<title>AGL: Edit Profile</title>
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
	//-------------------------
	// Acquire user info from Personnel table
	$user_name = 'actorsgu_data';
	$pass_word = 'cliffy36&winepress';
	$database = 'actorsgu_data';
	$server ='localhost:3306';
		
	$con = mysql_connect($server, $user_name, $pass_word, $database);
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
	
	
	if (isset($_POST['save'])) 
	{
		$user_name = 'actorsgu_data';
		$pass_word = 'cliffy36&winepress';
		$database = 'actorsgu_data';
		$server ='localhost:3306';
		
		//$con = mysql_connect($server, $user_name, $pass_word, $database);
		$db_handle = mysql_connect($server, $user_name, $pass_word);
		$db_found = mysql_select_db($database, $db_handle);
		
		//Read in the fields
			$Street_Address = $_POST['streetaddress'];
			$City = $_POST['city'];
			$State = $_POST['state'];
			$Zip_Code = $_POST['zip'];
			$Contact_Phone = $_POST['phone'];
			$Height = $_POST['height'];	
			$Weight = $_POST['weight'];
			$Age = $_POST['age'];
			$Hair_Color = $_POST['haircolor'];
			$Hair_Style = $_POST['hairstyle'];
			$Eye_Color = $_POST['eyecolor'];
			$Ethnicity = $_POST['ethnicity'];
			$Gender = $_POST['gender'];
			$Previous_Work = $_POST['previousexperience'];
		
		/*if($Contact_Phone == "" || $First_Name == "" || $Last_Name == "" || $Ethnicity == "" || $Gender == "" ||
		   $Height == "" || $Weight == "" || $Hair_Color == "" || $Eye_Color == "" || $Hair_Style == "" ||
		   $Age == "" || $Street_Address == "" || $State == "" || $Zip_Code == "" || $City == "")
		{
			echo "<script type='text/javascript'>
				 alert('Please, make sure you fill out all the fields');".
				 "window.location = 'EditProfile.php';</script>";//redirect back to login page    
			exit;//exit, so that the following code is not executed
		}*/
	
		if ($db_found) 
		{
			//==== USE THE FUNCTION BELOW TO ESCAPE ANY DANGEROUS CHARACTERS
			//==== YOU NEED TO USE OT FOR ALL VALUES YOU WANT TO CHECK
			$Contact_Phone = mysql_real_escape_string($Contact_Phone, $db_handle);	
			$First_Name = mysql_real_escape_string($First_Name, $db_handle);
			$Last_Name = mysql_real_escape_string($Last_Name, $db_handle); 
			$Height = mysql_real_escape_string($Height, $db_handle);	
			$Weight = mysql_real_escape_string($Weight, $db_handle);
			$Hair_Color = mysql_real_escape_string($Hair_Color, $db_handle);
			$Hair_Style = mysql_real_escape_string($Hair_Style, $db_handle);
			$Eye_Color = mysql_real_escape_string($Eye_Color, $db_handle);
			$Previous_Work = mysql_real_escape_string($Previous_Work, $db_handle);
			$Age = mysql_real_escape_string($Age, $db_handle);
			$Street_Address = mysql_real_escape_string($Street_Address, $db_handle);
			$State = mysql_real_escape_string($State, $db_handle);
			$Zip_Code = mysql_real_escape_string($Zip_Code, $db_handle);
			$City = mysql_real_escape_string($City, $db_handle);
			$Ethnicity = mysql_real_escape_string($Ethnicity, $db_handle);
			$Gender = mysql_real_escape_string($Gender, $db_handle);
		
			//$admin = 0;//person who is registering on the website, ALWAYS A USER
					 //registration of admin is internal to the AGL
			$SQL = "SELECT * FROM Personnel WHERE Contact_Email ='$email' AND password = '$password'";
			$result = mysql_query($SQL);
			$num_rows = mysql_num_rows($result);
			if($num_rows > 0)
			{
				//Update the info in the database
				//$SQL = "UPDATE Personnel SET Street_Address = $Street_Address, City = $City, State = $State, Zip_Code = $Zip_Code, Contact_Phone = $Contact_Phone, Height = $Height,Weight = $Weight, Age = $Age, Hair_Color = $Hair_Color, Hair_Style = $Hair_Style, Eye_Color = $Eye_Color, Ethnicity = $Ethnicity, Gender = $Gender, Previous_Work = $Previous_Work WHERE Contact_Email = '$email'";
				$SQL = "UPDATE Personnel SET Street_Address = '$Street_Address', City = '$City', State = '$State', Zip_Code = '$Zip_Code', Contact_Phone = '$Contact_Phone', Height = '$Height', Weight = '$Weight', Age = '$Age', Hair_Color = '$Hair_Color', Hair_Style = '$Hair_Style', Eye_Color = '$Eye_Color', Ethnicity = '$Ethnicity', Gender = '$Gender', Previous_Work = '$Previous_Work' WHERE Contact_Email = '$email'";		
				$result = mysql_query($SQL);
				
				echo "<script type='text/javascript'>
					 alert('Your profile has been updated - $Street_Address.');".
					 "window.location = 'EditProfile.php';</script>";//redirect back to EditProfile.php   
				exit;
			}
			else
			{
				//Unsuccessful Update
				echo "<script type='text/javascript'>
					 alert('There was a problem updating your profile.');".
					 "window.location = 'EditProfile.php';</script>";//redirect back to EditProfile.php   
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
	
	if (isset($_POST['uploadheadshot'])) 
	{
		echo "<script type='text/javascript'>
			  window.location = 'browsepicture.php';</script>";
	}
?>
</head>
<body bgcolor="#00000" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<!-- Save for Web Slices (EditProfile.psd) -->
<form name="form" method="post" action="EditProfile.php">
<table width="1401" height="968" border="0" align="center" cellpadding="0" cellspacing="0" id="Table_01">
	<tr>
		<td colspan="20">
			<img src="Assets/EditProfile_01.gif" width="1400" height="70" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="70" alt=""></td>
	</tr>
	<tr>
		<td colspan="17" rowspan="3">
			<img src="Assets/EditProfile_02.gif" width="1211" height="138" alt=""></td>
		<td colspan="2">
			<input type="image" name="home" value="home" src="Assets/EditProfile_03.gif" id="home"></td>
		<td rowspan="3">
			<img src="Assets/EditProfile_04.gif" width="83" height="138" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="34" alt=""></td>
	</tr>
	<tr>
		<td colspan="2">
			<input type="image" name="logout" value="logout" src="Assets/EditProfile_05.gif" id"logout"></td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="34" alt=""></td>
	</tr>
	<tr>
		<td colspan="2">
			<img src="Assets/EditProfile_06.gif" width="106" height="70" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="70" alt=""></td>
	</tr>
	<tr>
		<td colspan="4" rowspan="5">
			<img src="Assets/EditProfile_07.gif" width="484" height="114" alt=""></td>
		<td width="203" height="42" colspan="4" background="Assets/EditProfile_08.gif">&nbsp;
        <input type="text" name="firstname" id="firstname" style="color: #FFFFFF;border:none;background-color:transparent;" size="26" value="<?php echo $First_Name ?>">
        </td>
		<td width="250" height="42" colspan="6" background="Assets/EditProfile_09.gif">&nbsp;
        <input type="text" name="lastname" id="lastname" style="color: #FFFFFF;border:none;background-color:transparent;" size="30" value="<?php echo $Last_Name ?>">
        </td>
		<td colspan="6" rowspan="2">
			<img src="Assets/EditProfile_10.gif" width="463" height="56" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="42" alt=""></td>
	</tr>
	<tr>
		<td colspan="10" rowspan="2">
			<img src="Assets/EditProfile_11.gif" width="453" height="16" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="14" alt=""></td>
	</tr>
	<tr>
		<td rowspan="20">
			<img src="Assets/EditProfile_12.gif" width="21" height="703" alt=""></td>
		<td width="335" height="415" colspan="3" rowspan="14" background="Assets/EditProfile_13.gif">
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
		<td colspan="2" rowspan="20">
			<img src="Assets/EditProfile_14.gif" width="107" height="703" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="2" alt=""></td>
	</tr>
	<tr>
		<td width="453" height="42" colspan="10" background="Assets/EditProfile_15.gif">&nbsp;
        <input type="text" name="streetaddress" id="streetaddress" style="color: #FFFFFF;border:none;background-color:transparent;" size="65" value="<?php echo $Street_Address ?>">
        </td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="42" alt=""></td>
	</tr>
	<tr>
		<td colspan="10">
			<img src="Assets/EditProfile_16.gif" width="453" height="14" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="14" alt=""></td>
	</tr>
	<tr>
		<td colspan="2" rowspan="10">
			<img src="Assets/EditProfile_17.gif" width="352" height="303" alt=""></td>
		<td width="142" height="42" colspan="3" background="Assets/EditProfile_18.gif">&nbsp;
        <input type="text" name="city" id="city" size="15" style="color: #FFFFFF;border:none;background-color:transparent;" value="<?php echo $City ?>">
        </td>
		<td rowspan="2">
			<img src="Assets/EditProfile_19.gif" width="75" height="57" alt=""></td>
		<td width="145" height="42" colspan="3" background="Assets/EditProfile_20.gif">&nbsp;
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
		<td colspan="2" rowspan="2">
			<img src="Assets/EditProfile_21.gif" width="77" height="57" alt=""></td>
		<td width="146" height="42" colspan="3" background="Assets/EditProfile_22.gif">&nbsp;
        <input type="text" name="zip" id="zip" size="15" style="color: #FFFFFF;border:none;background-color:transparent;" value="<?php echo $Zip_Code ?>">
        </td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="42" alt=""></td>
	</tr>
	<tr>
		<td colspan="3">
			<img src="Assets/EditProfile_23.gif" width="142" height="15" alt=""></td>
		<td colspan="3">
			<img src="Assets/EditProfile_24.gif" width="145" height="15" alt=""></td>
		<td colspan="3">
			<img src="Assets/EditProfile_25.gif" width="146" height="15" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="15" alt=""></td>
	</tr>
	<tr>
		<td colspan="2" rowspan="2">
			<img src="Assets/EditProfile_26.gif" width="132" height="53" alt=""></td>
		<td width="453" height="42" colspan="10" background="Assets/EditProfile_27.gif">&nbsp;
        <input type="text" name="phone" id="phone" size="65" style="color: #FFFFFF;border:none;background-color:transparent;" value="<?php echo $Contact_Phone ?>">
        </td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="42" alt=""></td>
	</tr>
	<tr>
		<td colspan="10">
			<img src="Assets/EditProfile_28.gif" width="453" height="11" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="11" alt=""></td>
	</tr>
	<tr>
		<td width="142" height="42" colspan="3" background="Assets/EditProfile_29.gif">&nbsp;
        <?php
			$heights = array('' => '', 
								'4.00' => '4\'0"',
								'4.01' => '4\'1"',
								'4.02' => '4\'2"',
								'4.03' => '4\'3"',
								'4.04' => '4\'4"',
								'4.05' => '4\'5"',
								'4.06' => '4\'6"',
								'4.07' => '4\'7"',
								'4.08' => '4\'8"',
								'4.09' => '4\'9"',
								'4.10' => '4\'10"',
								'4.11' => '4\'11"',
								'5.00' => '5\'0"',
								'5.01' => '5\'1"',
								'5.02' => '5\'2"',
								'5.03' => '5\'3"',
								'5.04' => '5\'4"',
								'5.05' => '5\'5"',
								'5.06' => '5\'6"',
								'5.07' => '5\'7"',
								'5.08' => '5\'8"',
								'5.09' => '5\'9"',
								'5.10' => '5\'10"',
								'5.11' => '5\'11"',
								'6.00' => '6\'0"',
								'6.01' => '6\'1"',
								'6.02' => '6\'2"',
								'6.03' => '6\'3"',
								'6.04' => '6\'4"',
								'6.05' => '6\'5"',
								'6.06' => '6\'6"',
								'6.07' => '6\'7"',
								'6.08' => '6\'8"',
								'6.09' => '6\'9"',
								'6.10' => '6\'10"',
								'6.11' => '6\'11"',
								'7.00' => '7\'0"',
								'Other' => 'Other');
			$height = $Height;
			echo '<select class="select" name="height">';
			foreach ($heights as $heightKey => $heightName) {
				$line = '<option value="' . $haircolorKey . '"';
				$line .= ($height == $heightKey) ? ' selected="selected">' : '>';
				$line .= $heightName . '</option>';
				echo $line . "\n"; 
			}
			echo '</select>';
		?>
        </td>
		<td rowspan="4">
			<img src="Assets/EditProfile_30.gif" width="75" height="110" alt=""></td>
		<td width="145" height="42" colspan="3" background="Assets/EditProfile_31.gif">&nbsp;
        <input type="text" name="weight" id="weight" size="15" style="color: #FFFFFF;border:none;background-color:transparent;" value="<?php echo $Weight ?>">
        </td>
		<td colspan="2" rowspan="4">
			<img src="Assets/EditProfile_32.gif" width="77" height="110" alt=""></td>
		<td width="146" height="42" colspan="3" background="Assets/EditProfile_33.gif">&nbsp;
        <input type="text" name="age" id="age" size="15" style="color: #FFFFFF;border:none;background-color:transparent;" value="<?php echo $Age ?>">
        </td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="42" alt=""></td>
	</tr>
	<tr>
		<td colspan="3">
			<img src="Assets/EditProfile_34.gif" width="142" height="11" alt=""></td>
		<td colspan="3">
			<img src="Assets/EditProfile_35.gif" width="145" height="11" alt=""></td>
		<td colspan="3">
			<img src="Assets/EditProfile_36.gif" width="146" height="11" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="11" alt=""></td>
	</tr>
	<tr>
		<td width="142" height="43" colspan="3" background="Assets/EditProfile_37.gif">&nbsp;
        <?php
			$haircolors = array('' => '', 
								'Blonde' => 'Blonde',
								'Brown' => 'Brown',
								'Red' => 'Red',
								'Black' => 'Black',
								'Gray' => 'Gray',
								'Other' => 'Other');
			$haircolor = $Hair_Color;
			echo '<select class="select" name="haircolor">';
			foreach ($haircolors as $haircolorKey => $haircolorName) {
				$line = '<option value="' . $haircolorKey . '"';
				$line .= ($haircolor == $haircolorKey) ? ' selected="selected">' : '>';
				$line .= $haircolorName . '</option>';
				echo $line . "\n"; 
			}
			echo '</select>';
		?>
        </td>
		<td width="145" height="43" colspan="3" background="Assets/EditProfile_38.gif">&nbsp;
        <?php
			$hairstyles = array('' => '', 
								'Long' => 'Long',
								'Short' => 'Short',
								'Buzz' => 'Buzz',
								'Bald' => 'Bald',
								'Other' => 'Other');
			$hairstyle = $Hair_Style;
			echo '<select class="select" name="hairstyle">';
			foreach ($hairstyles as $hairstyleKey => $hairstyleName) {
				$line = '<option value="' . $hairstyleKey . '"';
				$line .= ($hairstyle == $hairstyleKey) ? ' selected="selected">' : '>';
				$line .= $hairstyleName . '</option>';
				echo $line . "\n"; 
			}
			echo '</select>';
		?>
        </td>
		<td width="146" height="43" colspan="3" background="Assets/EditProfile_39.gif">&nbsp;
        <?php
			$eyecolors = array('' => '', 
								'Blue' => 'Blue',
								'Brown' => 'Brown',
								'Green' => 'Green',
								'Gray' => 'Gray',
								'Other' => 'Other');
			$eyecolor = $Eye_Color;
			echo '<select class="select" name="eyecolor">';
			foreach ($eyecolors as $eyecolorKey => $eyecolorName) {
				$line = '<option value="' . $eyecolorKey . '"';
				$line .= ($eyecolor == $eyecolorKey) ? ' selected="selected">' : '>';
				$line .= $eyecolorName . '</option>';
				echo $line . "\n"; 
			}
			echo '</select>';
		?>
        </td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="43" alt=""></td>
	</tr>
	<tr>
		<td colspan="3">
			<img src="Assets/EditProfile_40.gif" width="142" height="14" alt=""></td>
		<td colspan="3">
			<img src="Assets/EditProfile_41.gif" width="145" height="14" alt=""></td>
		<td colspan="3">
			<img src="Assets/EditProfile_42.gif" width="146" height="14" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="14" alt=""></td>
	</tr>
	<tr>
		<td rowspan="2">
			<img src="Assets/EditProfile_43.gif" width="38" height="83" alt=""></td>
		<td width="228" height="43" colspan="4" background="Assets/EditProfile_44.gif">&nbsp;
        <?php
			$ethnicities = array('' => '', 
								'Hispanic/Latino' => 'Hispanic/Latino',
								'African American' => 'African American',
								'Asian' => 'Asian',
								'Native Hawaiian/Pacific Islander' => 'Native Hawaiian/Pacific Islander',
								'American Indian' => 'American Indian',
								'Alaskan Native' => 'Alaskan Native',
								'Caucasian' => 'Caucasian',
								'Middle Eastern' => 'Middle Eastern',
								'Other' => 'Other');
			$ethnicity = $Ethnicity;
			echo '<select class="select" name="ethnicity">';
			foreach ($ethnicities as $ethnicityKey => $ethnicityName) {
				$line = '<option value="' . $ethnicityKey . '"';
				$line .= ($ethnicity == $ethnicityKey) ? ' selected="selected">' : '>';
				$line .= $ethnicityName . '</option>';
				echo $line . "\n"; 
			}
			echo '</select>';
		?>
        </td>
		<td colspan="3" rowspan="2">
			<img src="Assets/EditProfile_45.gif" width="105" height="83" alt=""></td>
		<td width="214" height="43" colspan="4" background="Assets/EditProfile_46.gif">&nbsp;
        <!--<select name="gender" id="gender">
		    <option value="" selected> </option>
		    <option value="male">Male</option>
		    <option value="female">Female</option>
        </select>-->
        <?php
			$genders = array('' => '', 'male' => 'Male', 'female' => 'Female');
			$gender = $Gender;
			echo '<select class="select" name="gender">';
			foreach ($genders as $genderKey => $genderName) {
				$line = '<option value="' . $genderKey . '"';
				$line .= ($gender == $genderKey) ? ' selected="selected">' : '>';
				$line .= $genderName . '</option>';
				echo $line . "\n"; 
			}
			echo '</select>';
		?>
        </td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="43" alt=""></td>
	</tr>
	<tr>
		<td colspan="4">
			<img src="Assets/EditProfile_47.gif" width="228" height="40" alt=""></td>
		<td colspan="4">
			<img src="Assets/EditProfile_48.gif" width="214" height="40" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="40" alt=""></td>
	</tr>
	<tr>
		<td rowspan="7">
			<img src="Assets/EditProfile_49.gif" width="286" height="342" alt=""></td>
		<td width="651" height="174" colspan="13" rowspan="4" background="Assets/EditProfile_50.gif">&nbsp;
        <textarea name="previousexperience" id="previousexperience" cols="75" rows="9" style="color: #FFFFFF;border:none;background-color:transparent;" value="<?php echo $Previous_Work ?>"></textarea>
        </td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="54" alt=""></td>
	</tr>
	<tr>
		<td colspan="3">
			<img src="Assets/EditProfile_51.gif" width="335" height="17" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="17" alt=""></td>
	</tr>
	<tr>
		<td rowspan="5">
			<img src="Assets/EditProfile_52.gif" width="180" height="271" alt=""></td>
		<td colspan="2">
			<input type="image" name="uploadheadshot" value="uploadheadshot" src="Assets/EditProfile_53.gif" id"uploadheadshot">
            </td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="37" alt=""></td>
	</tr>
	<tr>
		<td colspan="2" rowspan="4">
			<img src="Assets/EditProfile_54.gif" width="155" height="234" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="66" alt=""></td>
	</tr>
	<tr>
		<td colspan="13">
			<img src="Assets/EditProfile_55.gif" width="651" height="15" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="15" alt=""></td>
	</tr>
	<tr>
		<td colspan="11" rowspan="2">
			<img src="Assets/EditProfile_56.gif" width="577" height="153" alt=""></td>
		<td>
			<input type="image" name="save" value="save" src="Assets/EditProfile_57.gif" id="save"></td>
		<td rowspan="2">
			<img src="Assets/EditProfile_58.gif" width="6" height="153" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="41" alt=""></td>
	</tr>
	<tr>
		<td>
			<img src="Assets/EditProfile_59.gif" width="68" height="112" alt=""></td>
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
			<img src="Assets/spacer.gif" width="21" height="1" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="180" height="1" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="73" height="1" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="82" height="1" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="24" height="1" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="83" height="1" alt=""></td>
		<td></td>
	</tr>
</table>
</form>
<!-- End Save for Web Slices -->
</body>
</html>
