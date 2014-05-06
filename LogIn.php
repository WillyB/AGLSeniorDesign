<!--	This is the first file that the user will see when navigating to
	http://blue.actors-guild.org/LogIn.php. To gain access to the 
	other web pages, the user must authenticate themself by logging
	in or registering a new account.
-->
<html>
<head>
<title>AGL: Log In</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
include 'MasterCode.php';
$db_field = "";
$role = "";
$email = "";
$Password = "";
$email2 = "";

//If cookies are still set for a user, then just log them in
//Should select in database and compare for password
if(isset($_COOKIE['email']) && isset($_COOKIE['password']) && isset($_COOKIE['role']))
{
		$role = $_COOKIE['role'];
		$email = $_COOKIE['email'];
		$Password = $_COOKIE['password'];
		$db_handle = mysql_connect($server, $user_name, $pass_word);
		$db_found = mysql_select_db($database, $db_handle);
		if ($db_found)
		{
			//this function is used to escape any dangerous strings (SQL injections)
			$email = mysql_real_escape_string($email, $db_handle);
			$password = mysql_real_escape_string($Password, $db_handle);
			
			//query database with entered data
			$SQL = "SELECT password FROM Personnel WHERE Contact_Email='$email'";
			$result = mysql_query($SQL);

			$num_rows1 = mysql_num_rows($result);
			if($num_rows1 > 0)
			{
				$SQL = "SELECT Role FROM Personnel WHERE Contact_Email='$email' AND BINARY password='$Password'";			
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
								setCookie('email',$email);
								setCookie('password',$Password);//delete later
								
								echo "<script type='text/javascript'> window.location.href = 'AdminTools.php';</script>";//redirect to admin page 
								exit;
								
						case 1://director login
							   //save email and password in a cookie
								setCookie('role', $role);
								setCookie('email',$email);
								setCookie('password',$Password);
								
								echo "<script type='text/javascript'> window.location.href = 'AdminTools.php';</script>";//redirect to admin page 
								exit;
								
						case 2://regular user login
						
							   //save email and password in a cookie
								setCookie('role', $role);
								setCookie('email',$email);
								setCookie('password',$Password);
								
								echo "<script type='text/javascript'> window.location.href = 'UserTools.php';</script>";//redirect to user page  
								exit;
					endswitch;							
				}
			}
		}
		else //if DB was not found
		{
			echo '<script type="text/javascript"> 
				  alert("Database is not found");
				  </script>';
		}
		mysql_close($db_handle); 
		exit;
}
	
//RETURNING USER LOGIN PROCEDURE
	if (isset($_POST['LogIn'])) 
	{
		$email = $_POST['email'];
		$Password = $_POST['Password'];
		
		if($email=="" && $Password == "")//display error message in case username and password fields are left blank
		{
			echo "<script type='text/javascript'>
				 alert('Please, make sure you enter your email and password');".
				 "window.location = 'LogIn.php';</script>";//redirect back to login page
			exit;//exit, so that the following code is not executed
		}

		if($email == "")//display error message in case user left username field blank
		{
			echo "<script type='text/javascript'>
				 alert('Please, make sure you enter your email');".
				 "window.location = 'LogIn.php';</script>";//redirect back to login page
			exit;//exit, so that the following code is not executed
		}
		
		if($Password == "")//display error message in case user left password field blank
		{
			echo "<script type='text/javascript'>
				 alert('Please, make sure you enter your password');".
				 "window.location = 'LogIn.php';</script>";//redirect back to login page   
			exit;//exit, so that the following code is not executed
		}
		
		//data to login into mysql server on multilab machine
		//$user_name = 'actorsgu_data';
		//$pass_word = 'cliffy36&winepress';
		//$database = 'actorsgu_data';
		//$server = 'localhost:3306';
		//$server = 'box293.bluehost.com:3306';
		
		$db_handle = mysql_connect($server, $user_name, $pass_word);
		$db_found = mysql_select_db($database, $db_handle);
		if ($db_found)
		{
			//this function is used to escape any dangerous strings (SQL injections)
			$email = mysql_real_escape_string($email, $db_handle);
			$password = mysql_real_escape_string($Password, $db_handle);
			
			//query database with entered data
			$SQL = "SELECT password FROM Personnel WHERE Contact_Email='$email'";
			$dbHashedPassword = mysql_query($SQL);
			
			$num_rows1 = mysql_num_rows($dbHashedPassword);
			if($num_rows1 > 0)
			{
				$cryptresult = crypt($Password, $dbHashedPassword);
				if ($cryptresult == $dbHashedPassword) 
				{
					//authenticated
					$SQL = "SELECT Role FROM Personnel WHERE Contact_Email='$email' AND BINARY password='$Password'";			
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
									setCookie('email',$email);
									setCookie('password',$Password);//delete later
									//setCookie('password',$hashedPassword);//uncomment later
									
									echo "<script type='text/javascript'> window.location.href = 'AdminTools.php';</script>";//redirect to admin page 
									exit;
									
							case 1://director login
							
								   //save email and password in a cookie
									setCookie('role', $role);
									setCookie('email',$email);
									setCookie('password',$Password);//delete later
									//setCookie('password',$hashedPassword); uncomment later
									
									echo "<script type='text/javascript'> window.location.href = 'AdminTools.php';</script>";//redirect to admin page 
									exit;
									
							case 2://regular user login
							
								   //save email and password in a cookie
									setCookie('role', $role);
									setCookie('email',$email);
									setCookie('password',$Password);//delete later
									//setCookie('password',$hashedPassword); uncomment later
									
									echo "<script type='text/javascript'> window.location.href = 'UserTools.php';</script>";//redirect to user page  
									exit;
						endswitch;							
					}
				}
				else
				{
					//not authenticated
					echo '<script type="text/javascript">
						alert("Invalid Password " + $cryptresult + ", " + $dbHashedPassword + ", " + $password + ", " + $Password);
						</script>';
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
		else//if DB was not found
		{
			echo '<script type="text/javascript"> 
				  alert("Database is not found");
				  </script>';
		}
		mysql_close($db_handle);
	}
//NEW USER REGISTRATION PROCEDURE
	if (isset($_POST['register'])) 
	{
		$email2 = $_POST['email2'];

		if($email2 == "")//display error message in case username and password fields are left blank
		{
			echo "<script type='text/javascript'>
				 alert('Please make sure to enter a valid email.');".
				 "window.location = 'LogIn.php';</script>";//redirect back to login page    
			exit;//exit, so that the following code is not executed
		}

		//database login
		$user_name = 'actorsgu_data';
		$pass_word = 'cliffy36&winepress';
		$database = 'actorsgu_data';
		$server = 'localhost:3306';//change back to 'localhost:3306';

		$db_handle = mysql_connect($server, $user_name, $pass_word);
		$db_found = mysql_select_db($database, $db_handle);

		if ($db_found) 
		{
			//this function is used to escape any dangerous strings (SQL injections)
			$email2 = mysql_real_escape_string($email2, $db_handle);	

			//check if user already exist by quering the personnel table
			//change $Password2 to $hashedPassword2 when hash function works
			$sql = ("SELECT Contact_Email FROM Personnel WHERE Contact_Email = '$email2'");
			$result = mysql_query($sql);					 

			$num_rows = mysql_num_rows($result);
			//Even though, it is "Register", still, check if user exists
			if ($num_rows > 0)//if user exists in DB already, redirect back to log in page			
			{
				echo "<script type='text/javascript'>
					 alert('You already have an existing account. Please log in instead.');".
					 "window.location = 'LogIn.php';</script>";//redirect back to login page  					
				exit;//stop execution if this is the case				
			}
			else//if user does not exist in DB, redirect to DB 
			{
				setcookie('email',$email2);
				echo "<script type='text/javascript'>
					 alert('Please fill out the following registration form.');".
					 "window.location = 'Register.php';</script>";  	
				exit;			
			}			
		}
		else//if DB was not found
		{
			echo '<script type="text/javascript"> 
				  alert("Database is not found");
				  </script>';				  
		}	
		mysql_close($db_handle);
	}	
	
?>
</head>
<body bgcolor="#00000" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<!-- Save for Web Slices (LogIn.psd) -->
<form id="form1" name="form1" method="post" action="LogIn.php">
<table width="1401" height="968" border="0" align="center" cellpadding="0" cellspacing="0" id="Table_01">
	<tr>
		<td colspan="11">
			<img src="Assets/LogIn_01.gif" width="1400" height="295" alt="" /></td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="295" alt="" /></td>
	</tr>
	<tr>
		<td rowspan="6">
			<img src="Assets/LogIn_02.gif" width="209" height="672" alt="" /></td>
		<td rowspan="5">
			<img src="Assets/LogIn_03.gif" width="340" height="170" alt="" /></td>
		<td colspan="9">
			<img src="Assets/LogIn_04.gif" width="851" height="45" alt="" /></td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="45" alt="" /></td>
	</tr>
	<tr>
		<td rowspan="5">
			<img src="Assets/LogIn_05.gif" width="185" height="627" alt="" /></td>
		<td width="174" height="37" colspan="2" background="Assets/LogIn_06.gif">&nbsp;
        <input name="email" type="text" id="email" style="color: #FFFFFF;border:none;background-color:transparent;" />
      </td>
		<td rowspan="2">
			<img src="Assets/LogIn_07.gif" width="5" height="81" alt="" /></td>
		<td width="173" height="37" colspan="3" background="Assets/LogIn_08.gif">&nbsp;
        <input type="password" name="Password" id="Password" style="color: #FFFFFF;border:none;background-color:transparent;" />
        </td>
		<td><input type="image" name="LogIn" value="login" src="Assets/LogIn_09.gif" width="66" height="37"/></td>
		<td rowspan="5">
			<img src="Assets/LogIn_10.gif" width="248" height="627" alt="" /></td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="37" alt="" /></td>
	</tr>
	<tr>
		<td colspan="2">
			<img src="Assets/LogIn_11.gif" width="174" height="44" alt="" /></td>
		<td colspan="4">
			<img src="Assets/LogIn_12.gif" width="239" height="44" alt="" /></td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="44" alt="" /></td>
	</tr>
	<tr>
		<td rowspan="3">
			<img src="Assets/LogIn_13.gif" width="67" height="546" alt="" /></td>
		<td width="226" height="38" colspan="3" background="Assets/LogIn_14.gif">&nbsp;
        <input type="text" name="email2" id="email2" style="color: #FFFFFF;border:none;background-color:transparent;" size="28" />
        </td>
		<td rowspan="3">
			<img src="Assets/LogIn_15.gif" width="11" height="546" alt="" /></td>
		<td colspan="2"><input type="image" name="register" value="register" src="Assets/LogIn_16.gif" id="register" /></td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="38" alt="" /></td>
	</tr>
	<tr>
		<td colspan="3" rowspan="2">
			<img src="Assets/LogIn_17.gif" width="226" height="508" alt="" /></td>
		<td colspan="2" rowspan="2">
			<img src="Assets/LogIn_18.gif" width="114" height="508" alt="" /></td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="6" alt="" /></td>
	</tr>
	<tr>
		<td>
			<img src="Assets/LogIn_19.gif" width="340" height="502" alt="" /></td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="502" alt="" /></td>
	</tr>
	<tr>
		<td>
			<img src="Assets/spacer.gif" width="209" height="1" alt="" /></td>
		<td>
			<img src="Assets/spacer.gif" width="340" height="1" alt="" /></td>
		<td>
			<img src="Assets/spacer.gif" width="185" height="1" alt="" /></td>
		<td>
			<img src="Assets/spacer.gif" width="67" height="1" alt="" /></td>
		<td>
			<img src="Assets/spacer.gif" width="107" height="1" alt="" /></td>
		<td>
			<img src="Assets/spacer.gif" width="5" height="1" alt="" /></td>
		<td>
			<img src="Assets/spacer.gif" width="114" height="1" alt="" /></td>
		<td>
			<img src="Assets/spacer.gif" width="11" height="1" alt="" /></td>
		<td>
			<img src="Assets/spacer.gif" width="48" height="1" alt="" /></td>
		<td>
			<img src="Assets/spacer.gif" width="66" height="1" alt="" /></td>
		<td>
			<img src="Assets/spacer.gif" width="248" height="1" alt="" /></td>
		<td></td>
	</tr>
</table>
</form>
<!-- End Save for Web Slices -->
</body>
</html>
