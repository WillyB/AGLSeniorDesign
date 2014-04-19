<html>
<head>
<title>AGL: User Home</title>
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

	if (isset($_POST['viewprofile'])) 
	{
	   setcookie('target_email',$email); //So View Profile knows who we are
		echo "<script type='text/javascript'>
	          window.location = 'ViewProfile.php';</script>";
		exit;	
	}
	//remove cookies and redirect to login.php when this button is clicked
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
	//redirect to ListShows.php when this button is clicked
	if (isset($_POST['ListShows'])) 
	{
		echo "<script type='text/javascript'>
	          window.location = 'ListShows.php';</script>";
		exit;	
	}
	//redirect to usertools.php when this button is clicked
	if (isset($_POST['home'])) 
	{
		echo "<script type='text/javascript'>
	          window.location = 'UserTools.php';</script>";
		exit;
	}
?>

</head>
<body bgcolor="#00000" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<!-- Save for Web Slices (UserTools.psd) -->
<form name="form" method="post" action="UserTools.php">
<table width="1401" height="967" border="0" align="center" cellpadding="0" cellspacing="0" id="Table_01">
	<tr>
		<td colspan="7">
			<img src="Assets/UserTools_01.gif" width="1400" height="36" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="36" alt=""></td>
	</tr>
	<tr>
		<td colspan="5" rowspan="3">
			<img src="Assets/UserTools_02.gif" width="1211" height="272" alt=""></td>
		<td><input type="image" name="home" value="home" src="Assets/UserTools_03.gif"></td>
		<td rowspan="5">
			<img src="Assets/UserTools_04.gif" width="83" height="931" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="34" alt=""></td>
	</tr>
	<tr>
		<td><input type="image" name="logout" value="logout" src="Assets/UserTools_05.gif"></td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="35" alt=""></td>
	</tr>
	<tr>
		<td rowspan="3">
			<img src="Assets/UserTools_06.gif" width="106" height="862" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="203" alt=""></td>
	</tr>
	<tr>
		<td rowspan="2">
			<img src="Assets/UserTools_07.gif" width="381" height="659" alt=""></td>
		<td><input type="image" name="viewprofile" value="viewprofile" src="Assets/UserTools_08.gif"></td>
		<td rowspan="2">
			<img src="Assets/UserTools_09.gif" width="173" height="659" alt=""></td>
		<td><input type="image" name="ListShows" value="ListShows" src="Assets/UserTools_10.gif"></td>
		<td rowspan="2">
			<img src="Assets/UserTools_11.gif" width="162" height="659" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="58" alt=""></td>
	</tr>
	<tr>
		<td>
			<img src="Assets/UserTools_12.gif" width="245" height="601" alt=""></td>
		<td>
			<img src="Assets/UserTools_13.gif" width="250" height="601" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="601" alt=""></td>
	</tr>
</table>
<!-- End Save for Web Slices -->
</form>
</body>
</html>
