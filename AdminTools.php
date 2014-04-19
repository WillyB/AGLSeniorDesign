<html>
<head>
<title>AGL: Admin Tools</title>
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

	if (isset($_POST['myprofile'])) 
	{
		echo "<script type='text/javascript'>
	          window.location = 'ViewProfile.php';</script>";		
		exit;
	}
	
        //delete the cookies and redirect to login.php when this button is clicked
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
			 "window.location = 'LogIn.php';</script>";
		exit;	
	}
	//redirect to ListUsers.php when this button is clicked
	if (isset($_POST['ListUsers'])) 
	{
		echo "<script type='text/javascript'>
	          window.location = 'ListUsers.php';</script>";
		exit;
	}
	//redirect to ListShows.php when this button is clicked
	if (isset($_POST['ListShows'])) 
	{
		echo "<script type='text/javascript'>
	          window.location = 'ListShows.php';</script>";
		exit;	
	}
        //redirect to editshow.php when this button is clicked
	if (isset($_POST['createshow'])) 
	{
		echo "<script type='text/javascript'>
	          window.location = 'EditShow.php';</script>";
		exit;	
	}
        //redirect to searchdb.php when this button is clicked
	if (isset($_POST['search'])) 
	{
		echo "<script type='text/javascript'>
	          window.location = 'SearchDB.php';</script>";
		exit;	
	}
?>
</head>
<body bgcolor="#00000" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<!-- Save for Web Slices (AdminTools.psd) -->
<form name="form" method="post" action="AdminTools.php">
<table width="1401" height="967" border="0" align="center" cellpadding="0" cellspacing="0" id="Table_01">
	<tr>
		<td colspan="7">
			<img src="Assets/AdminTools_01.gif" width="1400" height="36" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="36" alt=""></td>
	</tr>
	<tr>
		<td colspan="5" rowspan="3">
			<img src="Assets/AdminTools_02.gif" width="1211" height="272" alt=""></td>
		<td><input type="image" name="myprofile" value="myprofile" src="Assets/AdminTools_03.gif" id="myprofile"></td>
		<td rowspan="7">
			<img src="Assets/AdminTools_04.gif" width="83" height="931" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="34" alt=""></td>
	</tr>
	<tr>
		<td><input type="image" name="logout" value="logout" src="Assets/AdminTools_05.gif" id="logout"></td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="35" alt=""></td>
	</tr>
	<tr>
		<td rowspan="5">
			<img src="Assets/AdminTools_06.gif" width="106" height="862" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="203" alt=""></td>
	</tr>
	<tr>
		<td rowspan="4">
			<img src="Assets/AdminTools_07.gif" width="381" height="659" alt=""></td>
		<td><input type="image" name="ListUsers" value="ListUsers" src="Assets/AdminTools_08.gif" id="ListUsers"></td>
		<td rowspan="4">
			<img src="Assets/AdminTools_09.gif" width="173" height="659" alt=""></td>
		<td><input type="image" name="ListShows" value="ListShows" src="Assets/AdminTools_10.gif" id="ListShows"></td>
		<td rowspan="4">
			<img src="Assets/AdminTools_11.gif" width="162" height="659" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="58" alt=""></td>
	</tr>
	<tr>
		<td>
			<img src="Assets/AdminTools_12.gif" width="245" height="44" alt=""></td>
		<td>
			<img src="Assets/AdminTools_13.gif" width="250" height="44" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="44" alt=""></td>
	</tr>
	<tr>
		<td><input type="image" name="createshow" value="createshow" src="Assets/AdminTools_14.gif" id="createshow"></td>
		<td><input type="image" name="search" value="search" src="Assets/AdminTools_15.gif" id="search"></td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="59" alt=""></td>
	</tr>
	<tr>
		<td>
			<img src="Assets/AdminTools_16.gif" width="245" height="498" alt=""></td>
		<td>
			<img src="Assets/AdminTools_17.gif" width="250" height="498" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="498" alt=""></td>
	</tr>
</table>
</form>
<!-- End Save for Web Slices -->
</body>
</html>
