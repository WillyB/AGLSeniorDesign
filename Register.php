<!-- 	When a new user attempts to register from the LogIn.php, they will be
	directed to this page where they will enter a fist name, last name, and
	password for the account.  When the user submits the changes they will be
	directed to the EditProfile.php page to enter their personal information for
	the new profile.
-->
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
			 
	//No unauthorized access
	if(!isset($_COOKIE['email']))
	{
		echo "<script type='text/javascript'>
			 	window.location = 'LogIn.php';</script>";//redirect back to log in page    
		exit;
	}
//remove cookies and redirect to login.php when "LOGOUT" button is clicked
if (isset($_POST['logout'])) 
{
	unset($_COOKIE['email']);
		
	setcookie('email', '', time() - 3600);
	
	echo "<script type='text/javascript'>
		  alert('Goodbye!');".
		 "window.location = 'LogIn.php';</script>";//redirect to login page
	exit;	
}

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
	//Redirect to terms of use
	setcookie('temp_email', $email);
	setcookie('temp_fname', $firstname);
	setcookie('temp_lname', $lastname);
	setcookie('temp_password', $password);
	echo "<script type='text/javascript'>
			 	window.location = 'TermsOfUse.php';</script>";//redirect back to Terms Of Use page    
		exit;
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
        <input type="password" name="password" id="password" style="color: #FFFFFF;border:none;background-color:transparent;" size="60">
        </td>
	</tr>
	<tr>
		<td colspan="4">
			<img src="Assets/Register_16.gif" width="451" height="12" alt=""></td>
	</tr>
	<tr>
		<td width="451" height="42" colspan="4" background="Assets/Register_17.gif">&nbsp;
        <input type="password" name="confirmpassword" id="confirmpassword" style="color: #FFFFFF;border:none;background-color:transparent;" size="60">
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
