<html>
<head>
<title>AGL: View Shows</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<?php
$role = $_COOKIE['role'];
$email = $_COOKIE['email'];
$password = $_COOKIE['password'];

	echo "<script type='text/javascript'>
		  alert('Goodbye!');".
		 "window.location = 'ViewUsers.php';</script>";//redirect to login page
	exit;	
//redirect to ViewUsers.php when "HOME" button is clicked
if (isset($_POST['home'])) 
{
	echo "<script type='text/javascript'>
		  window.location = 'AdminTools.php';</script>";
	exit;
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
	
	mysql_close($db_handle);
	
	echo "<script type='text/javascript'>
		  alert('Goodbye!');".
		 "window.location = 'LogIn.php';</script>";//redirect to login page
	exit;	
}
?>
</head>
<body bgcolor="#00000" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<!-- Save for Web Slices (ViewShows.psd) -->
<form name="form" method="post" action="ViewShows.php">
<table width="1401" height="967" border="0" align="center" cellpadding="0" cellspacing="0" id="Table_01">
	<tr>
		<td colspan="5">
			<img src="Assets/ViewShows_01.gif" width="1400" height="70" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="70" alt=""></td>
	</tr>
	<tr>
		<td colspan="3" rowspan="3">
			<img src="Assets/ViewShows_02.gif" width="1211" height="185" alt=""></td>
		<td><input type="image" name="home" value="home" src="Assets/ViewShows_03.gif"></td>
		<td rowspan="5">
			<img src="Assets/ViewShows_04.gif" width="83" height="897" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="35" alt=""></td>
	</tr>
	<tr>
		<td><input type="image" name="logout" value="logout" src="Assets/ViewShows_05.gif"></td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="32" alt=""></td>
	</tr>
	<tr>
		<td rowspan="3">
			<img src="Assets/ViewShows_06.gif" width="106" height="830" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="118" alt=""></td>
	</tr>
	<tr>
		<td rowspan="2">
			<img src="Assets/ViewShows_07.gif" width="384" height="712" alt=""></td>
		<td width="654" height="564" background="Assets/ViewShows_08.gif">&nbsp;
        <label for="users"></label>
	    <textarea name="users" id="users" cols="76" rows="33" style="color: #FFFFFF;border:none;background-color:transparent;"></textarea>
        </td>
		<td rowspan="2">
			<img src="Assets/ViewShows_09.gif" width="173" height="712" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="564" alt=""></td>
	</tr>
	<tr>
		<td>
			<img src="Assets/ViewShows_10.gif" width="654" height="148" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="148" alt=""></td>
	</tr>
</table>
<!-- End Save for Web Slices -->
</body>
</html>