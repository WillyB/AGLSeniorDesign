<html>
<head>
<title>AGL Actors DB</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?php
$email = "";
$Password = "";
$email2 = "";
$Password2 = "";
//RETURNING USER LOGIN PROCEDURE
	if (isset($_POST['LogIn'])) 
	{
		$email = $_POST['email'];
		$Password = $_POST['Password'];

		//data to login into mysql server on multilab machine
		$user_name = 'actorsgu_data';
		$pass_word = 'cliffy36&winepress';
		$database = 'actorsgu_data';
		$server ='127.0.0.1';

		$db_handle = mysql_connect($server, $user_name, $pass_word);
		$db_found = mysql_select_db($database, $db_handle);
		
		if($email=="" && $Password == "")//display error message in case username and password fields are left blank
		{
			echo "<script type='text/javascript'>
				 alert('Please, make sure you enter your email and password');".
				 "window.location = 'LogIn1.php';</script>";//redirect back to login page    
			exit;//exit, so that the following code is not executed
		}

		if($email == "")//display error message in case user left username field blank
		{
			echo "<script type='text/javascript'>
				 alert('Please, make sure you enter your email');".
				 "window.location = 'LogIn1.php';</script>";//redirect back to login page
			exit;//exit, so that the following code is not executed
		}
		
		if($Password == "")//display error message in case user left password field blank
		{
			echo "<script type='text/javascript'>
				 alert('Please, make sure you enter your password');".
				 "window.location = 'LogIn1.php';</script>";//redirect back to login page   
			exit;//exit, so that the following code is not executed
		}

		if ($db_found) 
		{
			//this function is used to escape any dangerous strings (SQL injections)
			$email = mysql_real_escape_string($email, $db_handle);
			$Password = mysql_real_escape_string($Password, $db_handle);
			//query database with entered data
			$SQL = "SELECT who FROM users WHERE username='$email' AND password ='$Password'";			
			$result = mysql_query($SQL);			
			
			if(mysql_num_rows($result) > 0)//if there is a result for the query
			{
				while($row = mysql_fetch_assoc($result)) 
				{							
					$who = $row['who'];//get the number that identifies user as admin or regular user
					switch ($who)://and redirect depending on value of $who.
						case 0:
								echo "<script type='text/javascript'>
									 alert('Case 0 - admin');".							
									  "window.location = 'admin.php';</script>";//redirect back to login page  
								exit;//exit, so the following code is not executed
						case 1:
								echo "<script type='text/javascript'>
									 alert('Case 1 - users');".
									  "window.location = 'users.php';</script>";//redirect back to login page  
								exit;//exit, so the following code is not executed
					endswitch;//END OF SWITCH
					exit;//exit, so the following code is not executed
				}
			}
			else
			{
				echo "<script type='text/javascript'>
					 alert('Error has occured. Try to login again or register as a new user');".
					 "window.location = 'LogIn1.php';</script>";//redirect back to login page 
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
	if (isset($_POST['CreateProfile'])) 
	{
		$email2 = $_POST['email2'];
		$Password2 = $_POST['Password2'];

		//data to login into mysql server on multilab machine
		$user_name = 'actorsgu_data';
		$pass_word = 'cliffy36&winepress';
		$database = 'actorsgu_data';
		$server ='box293.bluehost.com';

		$db_handle = mysql_connect($server, $user_name, $pass_word);
		$db_found = mysql_select_db($database, $db_handle);
		
		if($email2 == "" && $Password2 == "")//display error message in case username and password fields are left blank
		{
			echo "<script type='text/javascript'>
				 alert('Please, make sure you enter your email and password');".
				 "window.location = 'LogIn1.php';</script>";//redirect back to login page    
			exit;//exit, so that the following code is not executed
		}

		if($email2 == "")//display error message in case user left username field blank
		{
			echo "<script type='text/javascript'>
				 alert('Please, make sure you enter your email');".
				 "window.location = 'LogIn1.php';</script>";//redirect back to login page
			exit;//exit, so that the following code is not executed
		}
		
		if($Password2 == "")//display error message in case user left password field blank
		{
			echo "<script type='text/javascript'>
				 alert('Please, make sure you enter your password');".
				 "window.location = 'LogIn1.php';</script>";//redirect back to login page   
			exit;//exit, so that the following code is not executed
		}

		if ($db_found) 
		{
			//this function is used to escape any dangerous strings (SQL injections)
			$email2 = mysql_real_escape_string($email2, $db_handle);
			$Password2 = mysql_real_escape_string($Password2, $db_handle);		

			//check if user already exist
			$result3 = mysql_query("SELECT CID 
										   FROM users
										  WHERE username = '$email2'
											AND password = '$Password2'
								  ");//TODO: will need to add user id
								 
			$row = mysql_fetch_assoc($result3);
			
			if(mysql_num_rows($result3) > 0)//if there is a result for the query
			{
				echo "<script type='text/javascript'>
					 alert('You are an existing user, please go back and login using your email and password');".
					 "window.location = 'LogIn1.php';</script>";//redirect back to login page  					
				exit;//stop execution if this is the case
			}
			else //redirect to registration page
			{
					header("Location: register.php");//TODO: this page is in process of creation
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
<form name="form1" method="post" action="LogIn1.php">
<table width="1401" height="968" border="0" align="center" cellpadding="0" cellspacing="0" id="Table_01">
	<tr>
		<td colspan="10">
			<img src="LogIn_01.gif" width="1400" height="295" alt=""></td>
		<td>
			<img src="spacer.gif" width="1" height="295" alt=""></td>
	</tr>
	<tr>
		<td rowspan="10">
			<img src="LogIn_02.gif" width="209" height="672" alt=""></td>
		<td rowspan="6">
			<img src="LogIn_03.gif" width="340" height="170" alt=""></td>
		<td colspan="8">
			<img src="LogIn_04.gif" width="851" height="39" alt=""></td>
		<td>
			<img src="spacer.gif" width="1" height="39" alt=""></td>
	</tr>
	<tr>
		<td rowspan="9">
			<img src="LogIn_05.gif" width="185" height="633" alt=""></td>
	  <td width="174" height="51" colspan="2" rowspan="3" background="LogIn_06.gif">&nbsp;
	    <label for="email"></label>
		<!--RETURNING USER LOGIN -->
	    <input name="email" type="text" id="email" style="color: #FFFFFF;border:none;background-color:transparent;"></td>
		<td width="178" height="51" colspan="3" rowspan="3" background="LogIn_07.gif">&nbsp;
		  <label for="Password"></label>
	    <input type="password" name="Password" id="Password" style="color: #FFFFFF;border:none;background-color:transparent;"></td>
		<td colspan="2">
			<img src="LogIn_08.gif" width="314" height="6" alt=""></td>
		<td>
			<img src="spacer.gif" width="1" height="6" alt=""></td>
	</tr>
	<tr>
		<td>
			<!-- CALL TO JAVASCRIPT EXECUTE() --> 
            <input type="image" name="LogIn" value="login" src="LogIn_09.gif" width="66" height="37"/></td>
		<td rowspan="8">
			<img src="LogIn_10.gif" width="248" height="627" alt=""></td>
		<td>
			<img src="spacer.gif" width="1" height="37" alt=""></td>
	</tr>
	<tr>
		<td rowspan="2">
			<img src="LogIn_11.gif" width="66" height="38" alt=""></td>
		<td>
			<img src="spacer.gif" width="1" height="8" alt=""></td>
	</tr>
	<tr>
		<td colspan="5">
			<img src="LogIn_12.gif" width="352" height="30" alt=""></td>
		<td>
			<img src="spacer.gif" width="1" height="30" alt=""></td>
	</tr>
	<tr>
		<td rowspan="5">
			<img src="LogIn_13.gif" width="67" height="552" alt=""></td>
		<td width="351" height="50" colspan="5" background="LogIn_14.gif">&nbsp;
		  <label for="email2"></label>
	    <input type="text" name="email2" id="email2" style="color: #FFFFFF;border:none;background-color:transparent;"></td>
		<td>
			<img src="spacer.gif" width="1" height="50" alt=""></td>
	</tr>
	<tr>
		<td rowspan="4">
			<img src="LogIn_15.gif" width="340" height="502" alt=""></td>
		<td width="226" height="51" colspan="2" rowspan="3" background="LogIn_16.gif">&nbsp;
		  <label for="password2"></label>
	    <input type="password" name="Password2" id="password2" style="color: #FFFFFF;border:none;background-color:transparent;"></td>
		<td colspan="3">
			<img src="LogIn_17.gif" width="125" height="6" alt=""></td>
		<td>
			<img src="spacer.gif" width="1" height="6" alt=""></td>
	</tr>
	<tr>
		<td rowspan="3">
			<img src="LogIn_18.gif" width="11" height="496" alt=""></td>
		<td colspan="2">
			<!-- NEW USER REGISTRATION-->
            <input type="image" name="CreateProfile" value="createprofile" src="LogIn_19.gif" width="114" height="38"/>
            </td>
		<td>
			<img src="spacer.gif" width="1" height="38" alt=""></td>
	</tr>
	<tr>
		<td colspan="2" rowspan="2">
			<img src="LogIn_20.gif" width="114" height="458" alt=""></td>
		<td>
			<img src="spacer.gif" width="1" height="7" alt=""></td>
	</tr>
	<tr>
		<td colspan="2">
			<img src="LogIn_21.gif" width="226" height="451" alt=""></td>
		<td>
			<img src="spacer.gif" width="1" height="451" alt=""></td>
	</tr>
	<tr>
		<td>
			<img src="spacer.gif" width="209" height="1" alt=""></td>
		<td>
			<img src="spacer.gif" width="340" height="1" alt=""></td>
		<td>
			<img src="spacer.gif" width="185" height="1" alt=""></td>
		<td>
			<img src="spacer.gif" width="67" height="1" alt=""></td>
		<td>
			<img src="spacer.gif" width="107" height="1" alt=""></td>
		<td>
			<img src="spacer.gif" width="119" height="1" alt=""></td>
		<td>
			<img src="spacer.gif" width="11" height="1" alt=""></td>
		<td>
			<img src="spacer.gif" width="48" height="1" alt=""></td>
		<td>
			<img src="spacer.gif" width="66" height="1" alt=""></td>
		<td>
			<img src="spacer.gif" width="248" height="1" alt=""></td>
		<td></td>
	</tr>
</table>
</form>
<!-- End Save for Web Slices -->
</body>
</html>
