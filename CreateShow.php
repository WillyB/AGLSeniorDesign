<html>
<head>
<title>AGL: Create Show</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?php
	include 'MasterCode.php';
	
	$role = $_COOKIE['role'];
	$email = $_COOKIE['email'];
	$password = $_COOKIE['password'];

	//No unauthorized access
	if(!isset($_COOKIE['email']) || !isset($_COOKIE['password']) || !isset($_COOKIE['role']))
	{
		echo "<script type='text/javascript'>
			 	window.location = 'LogIn.php';</script>";//redirect back to log in page    
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
	if (isset($_POST['create'])) 
	{
		$db_handle = mysql_connect($server, $user_name, $pass_word);
		$db_found = mysql_select_db($database, $db_handle);
		
		if ($db_found)
		{
			$showname = $_POST['showtitle'];
			$director = $_POST['director'];
			$playwright = $_POST['author'];
			$SQL = "SELECT * FROM Shows WHERE Show_Name = '$showname'";
			$result = mysql_query($SQL);
			$num_rows = mysql_num_rows($result);
			if ($num_rows > 0)//if there is no result returned, display error message
			{					
				echo "<script type='text/javascript'>
					 	alert('$showname already exists.');".
						 "window.location = 'CreateShow.php';</script>";//redirect back to Create Show page 
				exit;
			}
			else
			{
				$SQL = "INSERT INTO Shows (Show_Name, Director, Playwright) 
									VALUES ('$showname', '$director', '$author')";
				$result = mysql_query($SQL);
				$SQL = "SELECT * FROM Shows WHERE Show_Name = '$showname'";
				$result = mysql_query($SQL);
				$db_field = mysql_fetch_array($result);
				$num_rows = mysql_num_rows($result);
				if($num_rows > 0)
				{
					$showID = $db_field['idShows'];
					setcookie('showID',$showID);
					//redirect to EditShow.php
					echo "<script type='text/javascript'>
						 window.location = 'EditShow.php';</script>";
				}
				else
				{
					echo "<script type='text/javascript'>
						 alert('An error has occured. Show was not created.');".
						 "window.location = 'CreateShow.php';</script>";//redirect back to Create Show   
					exit;//exit, so that the following code is not executed
				}
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
<body bgcolor="#000000" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<!-- Save for Web Slices (CreateShow.psd) -->
<form name="form1" method="post" action="CreateShow.php">
<table width="1401" height="892" border="0" align="center" cellpadding="0" cellspacing="0" id="Table_01">
	<tr>
		<td colspan="8">
			<img src="Assets/CreateShow_01.gif" width="1400" height="71" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="71" alt=""></td>
	</tr>
	<tr>
		<td colspan="6" rowspan="3">
			<img src="Assets/CreateShow_02.gif" width="1211" height="162" alt=""></td>
		<td>
			<input type="image" name="home" value="home" src="Assets/CreateShow_03.gif" id="home"></td>
		<td rowspan="11">
			<img src="Assets/CreateShow_04.gif" width="82" height="820" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="35" alt=""></td>
	</tr>
	<tr>
		<td>
			<input type="image" name="logout" value="logout" src="Assets/CreateShow_05.gif" id"logout"></td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="32" alt=""></td>
	</tr>
	<tr>
		<td rowspan="9">
			<img src="Assets/CreateShow_06.gif" width="107" height="753" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="95" alt=""></td>
	</tr>
	<tr>
		<td rowspan="8">
			<img src="Assets/CreateShow_07.gif" width="506" height="658" alt=""></td>
		<td width="589" height="42" colspan="2" background="Assets/CreateShow_08.gif">&nbsp;
        <input type="text" name="showtitle" id="showtitle" style="color: #FFFFFF;border:none;background-color:transparent;" size="85">
        </td>
		<td colspan="3" rowspan="2">
			<img src="Assets/CreateShow_09.gif" width="116" height="47" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="42" alt=""></td>
	</tr>
	<tr>
		<td colspan="2">
			<img src="Assets/CreateShow_10.gif" width="589" height="5" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="5" alt=""></td>
	</tr>
	<tr>
		<td width="590" height="43" colspan="3" background="Assets/CreateShow_11.gif">&nbsp;
        <input type="text" name="author" id="author" style="color: #FFFFFF;border:none;background-color:transparent;" size="85">
        </td>
		<td colspan="2" rowspan="4">
			<img src="Assets/CreateShow_12.gif" width="115" height="129" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="43" alt=""></td>
	</tr>
	<tr>
		<td colspan="3">
			<img src="Assets/CreateShow_13.gif" width="590" height="4" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="4" alt=""></td>
	</tr>
	<tr>
		<td width="590" height="42" colspan="3" background="Assets/CreateShow_14.gif">&nbsp;
        <input type="text" name="director" id="director" style="color: #FFFFFF;border:none;background-color:transparent;" size="85">
        </td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="42" alt=""></td>
	</tr>
	<tr>
		<td colspan="3">
			<img src="Assets/CreateShow_15.gif" width="590" height="40" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="40" alt=""></td>
	</tr>
	<tr>
		<td rowspan="2">
			<img src="Assets/CreateShow_16.gif" width="475" height="482" alt=""></td>
		<td colspan="3">
			<input type="image" name="create" value="create" src="Assets/CreateShow_17.gif" id"create"></td>
		<td rowspan="2">
			<img src="Assets/CreateShow_18.gif" width="114" height="482" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="37" alt=""></td>
	</tr>
	<tr>
		<td colspan="3">
			<img src="Assets/CreateShow_19.gif" width="116" height="445" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="445" alt=""></td>
	</tr>
	<tr>
		<td>
			<img src="Assets/spacer.gif" width="506" height="1" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="475" height="1" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="114" height="1" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="1" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="1" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="114" height="1" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="107" height="1" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="82" height="1" alt=""></td>
		<td></td>
	</tr>
</table>
</form>
<!-- End Save for Web Slices -->
</body>
</html>