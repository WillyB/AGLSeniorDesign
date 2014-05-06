<html>
<head>
<title>AGL: Terms of Use</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?php
$db_field = "";

$temp_email = $_COOKIE["temp_email"];
$temp_password = $_COOKIE["temp_password"];
$temp_salt = $_COOKIE["temp_salt"];
$temp_fname = $_COOKIE["temp_fname"];
$temp_lname = $_COOKIE["temp_lname"];
$role = 2; //Any new registration starts as a regular user
			 //and then can be promoted by an admin to either
			 //Director or another admin access. 
			 
	//No unauthorized access
	if(!isset($_COOKIE['temp_email']))
	{
		echo "<script type='text/javascript'>
			 	window.location = 'LogIn.php';</script>";//redirect back to Inventory page    
		exit;
	}

if (isset($_POST['accept'])) 
{
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
		$SQL = "INSERT INTO Personnel (First_Name, Last_Name, Contact_Email, password, Salt, Role) 
								VALUES ('$temp_fname', '$temp_lname', '$temp_email', '$temp_password', $temp_salt, 2)";
		$result = mysql_query($SQL);
		$SQL = "SELECT * FROM Personnel WHERE Contact_Email = '$temp_email' AND password = '$temp_password'";
		$result = mysql_query($SQL);
		$num_rows = mysql_num_rows($result);
		if ($num_rows > 0)//if there is no result returned, display error message
		{
			//query database with entered data
			$SQL = "SELECT password FROM Personnel WHERE Contact_Email='$temp_email'";
			$result = mysql_query($SQL);//delete this statement later 
			$num_rows1 = mysql_num_rows($result);
			if($num_rows1 > 0)
			{
				$SQL = "SELECT Role FROM Personnel WHERE Contact_Email='$temp_email' AND BINARY password='$temp_password'";			
				$result = mysql_query($SQL);
				$num_rows = mysql_num_rows($result);
				$db_field = mysql_fetch_array($result);
				if ($num_rows > 0)//if user exists in the DB, log in => go to user's profile page
				{	
					$role = $db_field['Role'];
					switch ($role):
						case 0://admin login
							   //save role, email, and password in a cookie
							    setCookie('role', $role);
								setCookie('email',$temp_email);
								setCookie('password',$temp_password);//delete later
								setcookie('temp_email', '', time() - 3600);
								setcookie('temp_password', '', time() - 3600);
								setcookie('temp_salt', '', time() - 3600);
								setcookie('temp_fname', '', time() - 3600);
								setcookie('temp_lname', '', time() - 3600);
								
								echo "<script type='text/javascript'>
									 alert('admin has logged in');".//debug statement
									  "window.location = 'AdminTools.php';</script>";//redirect to admin page 
								exit;
								
						case 1://director login
							   //save email and password in a cookie
							    setCookie('role', $role);
								setCookie('email',$temp_email);
								setCookie('password',$temp_password);//delete later
								setcookie('temp_email', '', time() - 3600);
								setcookie('temp_password', '', time() - 3600);
								setcookie('temp_salt', '', time() - 3600);
								setcookie('temp_fname', '', time() - 3600);
								setcookie('temp_lname', '', time() - 3600);
								
								echo "<script type='text/javascript'>
									 alert('director has logged in');".//debug statement
									  "window.location = 'AdminTools.php';</script>";//redirect to admin page 
								exit;
								
						case 2://regular user login
							   //save email and password in a cookie
							    setCookie('role', $role);
								setCookie('email',$temp_email);
								setCookie('password',$temp_password);//delete later
								setcookie('temp_email', '', time() - 3600);
								setcookie('temp_password', '', time() - 3600);
								setcookie('temp_salt', '', time() - 3600);
								setcookie('temp_fname', '', time() - 3600);
								setcookie('temp_lname', '', time() - 3600);
								
								echo "<script type='text/javascript'>
									 alert('User has logged in');".//debug statement
									  "window.location = 'UserTools.php';</script>";//redirect to user page  
								exit;
					endswitch;							
				}
			}
			else //if user is not in DB, redirect to LogIn page
			{							
				echo "<script type='text/javascript'>
					 alert('Error has occurred. Try to login again or register as a new user');".
					 "window.location = 'LogIn.php';</script>";//redirect back to login page 
				exit;
			}
		}
		else
		{
			//after successful registration, display "thank you" message
			echo "<script type='text/javascript'>
				 alert('An error has occured. $email already exists.');".
				 "window.location = 'Register.php';</script>";//redirect back to LogIn.php   
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
if (isset($_POST['decline'])) 
{
	setcookie('role', '', time() - 3600);		
	setcookie('temp_email', '', time() - 3600);
	setcookie('temp_password', '', time() - 3600);
	setcookie('temp_salt', '', time() - 3600);
	setcookie('temp_fname', '', time() - 3600);
	setcookie('temp_lname', '', time() - 3600);	
	
	echo "<script type='text/javascript'>
		  alert('Goodbye!');".
		 "window.location = 'LogIn.php';</script>";//redirect to login page
	exit;	
}
?>
</head>
<body bgcolor="#00000" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<!-- Save for Web Slices (TermsOfUse.psd) -->
<form name="form" method="post" action="TermsOfUse.php">
<table width="1400" height="967" border="0" align="center" cellpadding="0" cellspacing="0" id="Table_01">
	<tr>
		<td colspan="7">
			<img src="Assets/TermsOfUse_01.gif" width="1400" height="255" alt=""></td>
	</tr>
	<tr>
		<td rowspan="4">
			<img src="Assets/TermsOfUse_02.gif" width="384" height="712" alt=""></td>
		<td width="654" height="564" colspan="5" background="Assets/TermsOfUse_03.gif">&nbsp;
        <textarea name="previousexperience" id="previousexperience" cols="77" rows="34" style="color: #FFFFFF;border:none;background-color:transparent; resize:none" readonly></textarea>
        </td>
		<td rowspan="4">
			<img src="Assets/TermsOfUse_04.gif" width="362" height="712" alt=""></td>
	</tr>
	<tr>
		<td colspan="5">
			<img src="Assets/TermsOfUse_05.gif" width="654" height="25" alt=""></td>
	</tr>
	<tr>
		<td rowspan="2">
			<img src="Assets/TermsOfUse_06.gif" width="133" height="123" alt=""></td>
		<td>
			<input type="image" name="accept" value="accept" src="Assets/TermsOfUse_07.gif" id="accept"></td>
		<td rowspan="2">
			<img src="Assets/TermsOfUse_08.gif" width="200" height="123" alt=""></td>
		<td>
			<input type="image" name="decline" value="decline" src="Assets/TermsOfUse_09.gif" id="decline"></td>
		<td rowspan="2">
			<img src="Assets/TermsOfUse_10.gif" width="139" height="123" alt=""></td>
	</tr>
	<tr>
		<td>
			<img src="Assets/TermsOfUse_11.gif" width="91" height="86" alt=""></td>
		<td>
			<img src="Assets/TermsOfUse_12.gif" width="91" height="86" alt=""></td>
	</tr>
</table>
</form>
<!-- End Save for Web Slices -->
</body>
</html>