<html>
<head>
<title>AGL: Registration</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?php
$db_field = "";
$email = $_COOKIE["email"];
$role = 2; //Any new registration starts as a regular user
			 //and then can be promoted by an admin to either
			 //Director or another admin access. 
if (isset($_POST['register'])) 
{
	$firstname = $_POST['firstname'];
	$lastname = $_POST['lastname'];
	$password = $_POST['password'];
	$confirmpassword = $_POST['confirmpassword'];
	
	if($firstname == "" || $lastname == "" || $password == " " ||
	   $confirmpassword == "")
	{
		echo "<script type='text/javascript'>
			 alert('Please, make sure you fill out all the fields.');".
			 "window.location = 'Register.php';</script>";//redirect back to login page    
		exit;//exit, so that the following code is not executed
	}
	if($password != $confirmpassword)
	{
		echo "<script type='text/javascript'>
			 alert('Password and Confirm Password don't match.');".
			 "window.location = 'Register.php';</script>";//redirect back to login page    
		exit;//exit, so that the following code is not executed
	}
	//data to login into mysql server on multilab machine
	$user_name = 'actorsgu_data';
	$pass_word = 'cliffy36&winepress';
	$database = 'actorsgu_data';
	$server = 'localhost:3306';//change back to 'localhost:3306';

	$con = mysql_connect($server, $user_name, $pass_word, $database);
	$db_handle = mysql_connect($server, $user_name, $pass_word);
	$db_found = mysql_select_db($database, $db_handle);
		
	if ($db_found)
	{
		//this function is used to escape any dangerous strings (SQL injections)
		$password = mysql_real_escape_string($password, $db_handle);
		$confirmpassword = mysql_real_escape_string($confirmpassword, $db_handle);
		$firstname = mysql_real_escape_string($firstname, $db_handle);
		$lastname = mysql_real_escape_string($lastname, $db_handle);
			
		$SQL = "INSERT INTO Personnel (First_Name, Last_Name, Contact_Email, password) 
								VALUES ('$firstname', '$lastname', '$email', '$password')";
		$result = mysql_query($SQL);
		$SQL = "SELECT * FROM Personnel WHERE Contact_Email = '$email' AND password = '$password'";
		$result = mysql_query($SQL);
		$num_rows = mysql_num_rows($result);
		if ($num_rows > 0)//if there is no result returned, display error message
		{
			echo "<script type='text/javascript'>
				 alert('An error has occured. $email already exists.');".
				 "window.location = 'Register.php';</script>";//redirect back to Register page    
			exit;//exit, so that the following code is not executed
		}
		else
		{
			//after successful registration, display "thank you" message
			echo "<script type='text/javascript'>
				 alert('Thank you for registering. You may log in now using your entered information.');".
				 "window.location = 'LogIn.php';</script>";//redirect back to LogIn.php   
			exit;//exit, so that the following code is not executed
		}			
		
	}
	else//if DB was not found
	{
		echo '<script type="text/javascript"> 
			  alert("Database was not found");
			  </script>';
	}
	mysql_close($db_handle);
}
?>
</head>
<body bgcolor="#00000" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<!-- Save for Web Slices (Register.psd) -->
<form name="form" method="post" action="Register.php">
<table width="1400" height="968" border="0" align="center" cellpadding="0" cellspacing="0" id="Table_01">
	<tr>
		<td colspan="8">
			<img src="Assets/Register_01.gif" width="1400" height="70" alt=""></td>
	</tr>
	<tr>
		<td colspan="6" rowspan="3">
			<img src="Assets/Register_02.gif" width="1211" height="138" alt=""></td>
		<td>
			<input type="image" name="home" value="home" src="Assets/Register_03.gif" id="home"></td>
		<td rowspan="3">
			<img src="Assets/Register_04.gif" width="83" height="138" alt=""></td>
	</tr>
	<tr>
		<td>
			<input type="image" name="logout" value="logout" src="Assets/Register_05.gif" id="logout"></td>
	</tr>
	<tr>
		<td>
			<img src="Assets/Register_06.gif" width="106" height="70" alt=""></td>
	</tr>
	<tr>
		<td colspan="8">
			<img src="Assets/Register_07.gif" width="1400" height="70" alt=""></td>
	</tr>
	<tr>
		<td rowspan="10">
			<img src="Assets/Register_08.gif" width="619" height="689" alt=""></td>
		<td width="203" height="40" background="Assets/Register_09.gif">&nbsp;
        <input type="text" name="firstname" id="firstname" style="color: #FFFFFF;border:none;background-color:transparent;" size="26">
        </td>
		<td width="248" height="40" colspan="3" background="Assets/Register_10.gif">&nbsp;
        <input type="text" name="lastname" id="lastname" style="color: #FFFFFF;border:none;background-color:transparent;" size="30">
        </td>
		<td colspan="3" rowspan="10">
			<img src="Assets/Register_11.gif" width="330" height="689" alt=""></td>
	</tr>
	<tr>
		<td colspan="4">
			<img src="Assets/Register_12.gif" width="451" height="17" alt=""></td>
	</tr>
	<tr>
		<td width="451" height="41" colspan="4" background="Assets/Register_13.gif">&nbsp;
        <input type="text" name="email" id="email" style="color: #FFFFFF;border:none;background-color:transparent;" size="60" value="<?php echo $email ?>" readonly>
        </td>
	</tr>
	<tr>
		<td colspan="4">
			<img src="Assets/Register_14.gif" width="451" height="17" alt=""></td>
	</tr>
	<tr>
		<td width="451" height="42" colspan="4" background="Assets/Register_15.gif">&nbsp;
        <input type="text" name="password" id="password" style="color: #FFFFFF;border:none;background-color:transparent;" size="60">
        </td>
	</tr>
	<tr>
		<td colspan="4">
			<img src="Assets/Register_16.gif" width="451" height="12" alt=""></td>
	</tr>
	<tr>
		<td width="451" height="42" colspan="4" background="Assets/Register_17.gif">&nbsp;
        <input type="text" name="confirmpassword" id="confirmpassword" style="color: #FFFFFF;border:none;background-color:transparent;" size="60">
        </td>
	</tr>
	<tr>
		<td colspan="4">
			<img src="Assets/Register_18.gif" width="451" height="20" alt=""></td>
	</tr>
	<tr>
		<td colspan="2" rowspan="2">
			<img src="Assets/Register_19.gif" width="349" height="458" alt=""></td>
		<td>
			<input type="image" name="register" value="register" src="Assets/Register_20.gif" id="register"></td>
		<td rowspan="2">
			<img src="Assets/Register_21.gif" width="4" height="458" alt=""></td>
	</tr>
	<tr>
		<td>
			<img src="Assets/Register_22.gif" width="98" height="421" alt=""></td>
	</tr>
	<tr>
		<td>
			<img src="Assets/spacer.gif" width="619" height="1" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="203" height="1" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="146" height="1" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="98" height="1" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="4" height="1" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="141" height="1" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="106" height="1" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="83" height="1" alt=""></td>
	</tr>
</table>
</form>
<!-- End Save for Web Slices -->
</body>
</html>