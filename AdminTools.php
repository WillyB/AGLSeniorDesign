<html>
<head>
<title>AGL: Admin Tools</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?php
$role = $_COOKIE['role'];
$email = $_COOKIE['email'];
$password = $_COOKIE['password'];

	if (isset($_POST['myprofile'])) 
	{
		header("Location: EditProfile.php");//DO WE HAVe SAME PHP FOR VIEW AND EDIT PROFILE???
		exit;
	}
	
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
	//redirect to viewusers.php when this button is clicked
	if (isset($_POST['viewusers'])) 
	{
		header("Location: ViewUsers.php");
		exit;
	}
	//redirect to viewshows.php when this button is clicked
	if (isset($_POST['viewshows'])) 
	{
		header("Location: ViewShows.php");
		exit;	
	}
	if (isset($_POST['createshow'])) 
	{
		header("Location: CreateShow.php");
		exit;	
	}
	if (isset($_POST['search'])) 
	{
		header("Location: SearchDB.php");
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

		<td><input type="image" name="myprofile" value="myprofile" src="Assets/AdminTools_03.gif"></td>

		<td rowspan="7">
			<img src="Assets/AdminTools_04.gif" width="83" height="931" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="34" alt=""></td>
	</tr>
	<tr>

		<td><input type="image" name="logout" value="logout" src="Assets/AdminTools_05.gif"></td>

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

		<td><input type="image" name="viewusers" value="viewusers" src="Assets/AdminTools_08.gif"></td>
		<td rowspan="4">
			<img src="Assets/AdminTools_09.gif" width="173" height="659" alt=""></td>
		<td><input type="image" name="viewshows" value="viewshows" src="Assets/AdminTools_10.gif"></td>

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

		<td><input type="image" name="createshow" value="createshow" src="Assets/AdminTools_14.gif"></td>
		<td><input type="image" name="search" value="search" src="Assets/AdminTools_15.gif"></td>

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