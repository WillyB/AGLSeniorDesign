<html>
<head>
<title>AGL: Edit Show</title>
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
?>
</head>
<body bgcolor="#00000" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<!-- Save for Web Slices (EditShow.psd) -->
<form name="form1" method="post" action="EditShow.php">
<table width="1401" height="1441" border="0" align="center" cellpadding="0" cellspacing="0" id="Table_01">
	<tr>
		<td colspan="10">
			<img src="Assets/EditShow_01.gif" width="1400" height="71" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="71" alt=""></td>
	</tr>
	<tr>
		<td colspan="7" rowspan="3">
			<img src="Assets/EditShow_02.gif" width="1211" height="162" alt=""></td>
		<td colspan="2">
			<input type="image" name="home" value="home" src="Assets/EditShow_03.gif" id="home"></td>
		<td rowspan="10">
			<img src="Assets/EditShow_04.gif" width="82" height="459" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="35" alt=""></td>
	</tr>
	<tr>
		<td colspan="2">
			<input type="image" name="logout" value="logout" src="Assets/EditShow_05.gif" id"logout"></td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="32" alt=""></td>
	</tr>
	<tr>
		<td colspan="2" rowspan="8">
			<img src="Assets/EditShow_06.gif" width="107" height="392" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="95" alt=""></td>
	</tr>
	<tr>
		<td colspan="3" rowspan="6">
			<img src="Assets/EditShow_07.gif" width="506" height="173" alt=""></td>
		<td width="589" height="42" background="Assets/EditShow_08.gif">&nbsp;
        <input type="text" name="showtitle" id="showtitle" style="color: #FFFFFF;border:none;background-color:transparent;" size="85">
        </td>
		<td colspan="3" rowspan="2">
			<img src="Assets/EditShow_09.gif" width="116" height="47" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="42" alt=""></td>
	</tr>
	<tr>
		<td>
			<img src="Assets/EditShow_10.gif" width="589" height="5" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="5" alt=""></td>
	</tr>
	<tr>
		<td width="590" height="43" colspan="2" background="Assets/EditShow_11.gif">&nbsp;
        <input type="text" name="author" id="author" style="color: #FFFFFF;border:none;background-color:transparent;" size="85">
        </td>
		<td colspan="2" rowspan="5">
			<img src="Assets/EditShow_12.gif" width="115" height="250" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="43" alt=""></td>
	</tr>
	<tr>
		<td colspan="2">
			<img src="Assets/EditShow_13.gif" width="590" height="4" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="4" alt=""></td>
	</tr>
	<tr>
		<td width="590" height="42" colspan="2" background="Assets/EditShow_14.gif">&nbsp;
        <input type="text" name="director" id="director" style="color: #FFFFFF;border:none;background-color:transparent;" size="85">
        </td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="42" alt=""></td>
	</tr>
	<tr>
		<td colspan="2">
			<img src="Assets/EditShow_15.gif" width="590" height="37" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="37" alt=""></td>
	</tr>
	<tr>
		<td colspan="2">
			<img src="Assets/EditShow_16.gif" width="327" height="124" alt=""></td>
		<td width="768" height="124" colspan="2" background="Assets/EditShow_17.gif">&nbsp;
        <textarea name="auditionnotes" id="auditionnotes" cols="90" rows="5" style="color: #FFFFFF;border:none;background-color:transparent;"></textarea>
        </td>
		<td>
			<img src="Assets/EditShow_18.gif" width="1" height="124" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="124" alt=""></td>
	</tr>
	<tr>
		<td width="1400" height="57" colspan="10" background="Assets/EditShow_19.gif">&nbsp;</td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="57" alt=""></td>
	</tr>
	<tr>
		<td rowspan="4">
			<img src="Assets/EditShow_20.gif" width="116" height="853" alt=""></td>
		<td width="1163" height="712" colspan="7" background="Assets/EditShow_21.gif">
        <!--
        CALENDAR SPACE
        -->
        </td>
		<td colspan="2" rowspan="4">
			<img src="Assets/EditShow_22.gif" width="121" height="853" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="712" alt=""></td>
	</tr>
	<tr>
		<td colspan="7">
			<img src="Assets/EditShow_23.gif" width="1163" height="31" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="31" alt=""></td>
	</tr>
	<tr>
		<td colspan="5" rowspan="2">
			<img src="Assets/EditShow_24.gif" width="1047" height="110" alt=""></td>
		<td colspan="2">
			<input type="image" name="home" value="home" src="Assets/EditShow_25.gif" id="home"></td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="37" alt=""></td>
	</tr>
	<tr>
		<td colspan="2">
			<img src="Assets/EditShow_26.gif" width="116" height="73" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="73" alt=""></td>
	</tr>
	<tr>
		<td>
			<img src="Assets/spacer.gif" width="116" height="1" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="211" height="1" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="179" height="1" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="589" height="1" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="1" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="67" height="1" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="48" height="1" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="68" height="1" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="39" height="1" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="82" height="1" alt=""></td>
		<td></td>
	</tr>
</table>
</form>
<!-- End Save for Web Slices -->
</body>
</html>