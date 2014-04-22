<!--	This page can be reached by the ListShows.php page or AdminTools.php page.
        The user will be able to create or edit the information pertaining to the selected
        show, and administrative access is required to view this page. The save button will
        redirect the user to the ViewShows.php page.
-->
<html>
<head>
<title>AGL: Edit Show</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<script src="jquery.ui-1.5.2/jquery-1.2.6.js" type="text/javascript"></script>
<script src="jquery.ui-1.5.2/ui/ui.datepicker.js" type="text/javascript"></script>
<link href="jquery.ui-1.5.2/themes/ui.datepicker.css" rel="stylesheet" type="text/css">
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
<table width="1401" height="968" border="0" align="center" cellpadding="0" cellspacing="0" id="Table_01">
	<tr>
		<td colspan="13">
			<img src="Assets/EditShow_01.gif" width="1400" height="70" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="70" alt=""></td>
	</tr>
	<tr>
		<td colspan="11" rowspan="3">
			<img src="Assets/EditShow_02.gif" width="1211" height="162" alt=""></td>
		<td><input type="image" name="home" value="home" src="Assets/EditShow_03.gif" id="home"></td>
		<td rowspan="21">
			<img src="Assets/EditShow_04.gif" width="82" height="897" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="35" alt=""></td>
	</tr>
	<tr>
		<td><input type="image" name="logout" value="logout" src="Assets/EditShow_05.gif" id"logout"></td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="32" alt=""></td>
	</tr>
	<tr>
		<td rowspan="19">
			<img src="Assets/EditShow_06.gif" width="107" height="830" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="95" alt=""></td>
	</tr>
	<tr>
		<td colspan="2" rowspan="6">
			<img src="Assets/EditShow_07.gif" width="506" height="173" alt=""></td>
		<td width="589" height="42" colspan="7" background="Assets/EditShow_08.gif">&nbsp;
        <label for="showtitle"></label>
	    <input type="text" name="showtitle" id="showtitle" style="color: #FFFFFF;border:none;background-color:transparent;" size="85">
        </td>
		<td colspan="2" rowspan="2">
			<img src="Assets/EditShow_09.gif" width="116" height="47" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="42" alt=""></td>
	</tr>
	<tr>
		<td colspan="7">
			<img src="Assets/EditShow_10.gif" width="589" height="5" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="5" alt=""></td>
	</tr>
	<tr>
		<td width="590" height="43" colspan="8" background="Assets/EditShow_11.gif">&nbsp;
        <label for="author"></label>
	    <input type="text" name="author" id="author" style="color: #FFFFFF;border:none;background-color:transparent;" size="85">
        </td>
		<td rowspan="16">
			<img src="Assets/EditShow_12.gif" width="115" height="688" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="43" alt=""></td>
	</tr>
	<tr>
		<td colspan="8">
			<img src="Assets/EditShow_13.gif" width="590" height="4" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="4" alt=""></td>
	</tr>
	<tr>
		<td width="590" height="42" colspan="8" background="Assets/EditShow_14.gif">&nbsp;
        <label for="director"></label>
	    <input type="text" name="director" id="director" style="color: #FFFFFF;border:none;background-color:transparent;" size="85">
        </td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="42" alt=""></td>
	</tr>
	<tr>
		<td colspan="8">
			<img src="Assets/EditShow_15.gif" width="590" height="37" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="37" alt=""></td>
	</tr>
	<tr>
		<td rowspan="12">
			<img src="Assets/EditShow_16.gif" width="327" height="562" alt=""></td>
		<td width="768" height="124" colspan="8" background="Assets/EditShow_17.gif">&nbsp;
        <label for="auditionnotes"></label>
	    <textarea name="auditionnotes" id="auditionnotes" cols="90" rows="5" style="color: #FFFFFF;border:none;background-color:transparent;"></textarea>
        </td>
		<td rowspan="12">
			<img src="Assets/EditShow_18.gif" width="1" height="562" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="124" alt=""></td>
	</tr>
	<tr>
		<td colspan="8">
			<img src="Assets/EditShow_19.gif" width="768" height="46" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="46" alt=""></td>
	</tr>
	<tr>
		<td width="253" height="43" colspan="2" background="Assets/EditShow_20.gif"><input name="" type="text" id="jQueryUICalendar1" size="30"/>
		  <p></p>
	    <script type="text/javascript">
// BeginWebWidget jQuery_UI_Calendar: jQueryUICalendar1
jQuery("#jQueryUICalendar1").datepicker();

// EndWebWidget jQuery_UI_Calendar: jQueryUICalendar1
          </script></td>
		<td rowspan="10">
			<img src="Assets/EditShow_21.gif" width="6" height="392" alt=""></td>
		<td width="254" height="43" background="Assets/EditShow_22.gif"><input name="" type="text" id="jQueryUICalendar2" size="30"/>
		  <p></p>
	    <script type="text/javascript">
// BeginWebWidget jQuery_UI_Calendar: jQueryUICalendar2
jQuery("#jQueryUICalendar2").datepicker();

// EndWebWidget jQuery_UI_Calendar: jQueryUICalendar2
          </script></td>
		<td rowspan="10">
			<img src="Assets/EditShow_23.gif" width="4" height="392" alt=""></td>
		<td width="251" height="43" colspan="3" background="Assets/EditShow_24.gif"><input name="" type="text" id="jQueryUICalendar3" size="30"/>
		  <p></p>
	    <script type="text/javascript">
// BeginWebWidget jQuery_UI_Calendar: jQueryUICalendar3
jQuery("#jQueryUICalendar3").datepicker();

// EndWebWidget jQuery_UI_Calendar: jQueryUICalendar3
          </script></td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="43" alt=""></td>
	</tr>
	<tr>
		<td colspan="2">
			<img src="Assets/EditShow_25.gif" width="253" height="7" alt=""></td>
		<td>
			<img src="Assets/EditShow_26.gif" width="254" height="7" alt=""></td>
		<td colspan="3">
			<img src="Assets/EditShow_27.gif" width="251" height="7" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="7" alt=""></td>
	</tr>
	<tr>
		<td width="253" height="42" colspan="2" background="Assets/EditShow_28.gif"><input name="" type="text" id="jQueryUICalendar4" size="30"/>
		  <p></p>
	    <script type="text/javascript">
// BeginWebWidget jQuery_UI_Calendar: jQueryUICalendar4
jQuery("#jQueryUICalendar4").datepicker();

// EndWebWidget jQuery_UI_Calendar: jQueryUICalendar4
          </script></td>
		<td width="254" height="42" background="Assets/EditShow_29.gif"><input name="" type="text" id="jQueryUICalendar5" size="30"/>
		  <p></p>
	    <script type="text/javascript">
// BeginWebWidget jQuery_UI_Calendar: jQueryUICalendar5
jQuery("#jQueryUICalendar5").datepicker();

// EndWebWidget jQuery_UI_Calendar: jQueryUICalendar5
          </script></td>
		<td width="251" height="42" colspan="3" background="Assets/EditShow_30.gif"><input name="" type="text" id="jQueryUICalendar6" size="30"/>
		  <p></p>
	    <script type="text/javascript">
// BeginWebWidget jQuery_UI_Calendar: jQueryUICalendar6
jQuery("#jQueryUICalendar6").datepicker();

// EndWebWidget jQuery_UI_Calendar: jQueryUICalendar6
          </script></td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="42" alt=""></td>
	</tr>
	<tr>
		<td colspan="2">
			<img src="Assets/EditShow_31.gif" width="253" height="55" alt=""></td>
		<td>
			<img src="Assets/EditShow_32.gif" width="254" height="55" alt=""></td>
		<td colspan="3">
			<img src="Assets/EditShow_33.gif" width="251" height="55" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="55" alt=""></td>
	</tr>
	<tr>
		<td width="253" height="42" colspan="2" background="Assets/EditShow_34.gif"><input name="" type="text" id="jQueryUICalendar7" size="30"/>
		  <p></p>
	    <script type="text/javascript">
// BeginWebWidget jQuery_UI_Calendar: jQueryUICalendar7
jQuery("#jQueryUICalendar7").datepicker();

// EndWebWidget jQuery_UI_Calendar: jQueryUICalendar7
          </script></td>
		<td width="254" height="42" background="Assets/EditShow_35.gif"><input name="" type="text" id="jQueryUICalendar8" size="30"/>
		  <p></p>
	    <script type="text/javascript">
// BeginWebWidget jQuery_UI_Calendar: jQueryUICalendar8
jQuery("#jQueryUICalendar8").datepicker();

// EndWebWidget jQuery_UI_Calendar: jQueryUICalendar8
          </script></td>
		<td width="251" height="42" colspan="3" background="Assets/EditShow_36.gif"><input name="" type="text" id="jQueryUICalendar9" size="30"/>
		  <p></p>
	    <script type="text/javascript">
// BeginWebWidget jQuery_UI_Calendar: jQueryUICalendar9
jQuery("#jQueryUICalendar9").datepicker();

// EndWebWidget jQuery_UI_Calendar: jQueryUICalendar9
          </script></td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="42" alt=""></td>
	</tr>
	<tr>
		<td colspan="2">
			<img src="Assets/EditShow_37.gif" width="253" height="8" alt=""></td>
		<td>
			<img src="Assets/EditShow_38.gif" width="254" height="8" alt=""></td>
		<td colspan="3">
			<img src="Assets/EditShow_39.gif" width="251" height="8" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="8" alt=""></td>
	</tr>
	<tr>
		<td width="253" height="43" colspan="2" background="Assets/EditShow_40.gif"><input name="" type="text" id="jQueryUICalendar10" size="30"/>
		  <p></p>
	    <script type="text/javascript">
// BeginWebWidget jQuery_UI_Calendar: jQueryUICalendar10
jQuery("#jQueryUICalendar10").datepicker();

// EndWebWidget jQuery_UI_Calendar: jQueryUICalendar10
          </script></td>
		<td width="254" height="43" background="Assets/EditShow_41.gif"><input name="" type="text" id="jQueryUICalendar11" size="30"/>
		  <p></p>
	    <script type="text/javascript">
// BeginWebWidget jQuery_UI_Calendar: jQueryUICalendar11
jQuery("#jQueryUICalendar11").datepicker();

// EndWebWidget jQuery_UI_Calendar: jQueryUICalendar11
          </script></td>
		<td width="251" height="43" colspan="3" background="Assets/EditShow_42.gif"><input name="" type="text" id="jQueryUICalendar12" size="30"/>
		  <p></p>
	    <script type="text/javascript">
// BeginWebWidget jQuery_UI_Calendar: jQueryUICalendar12
jQuery("#jQueryUICalendar12").datepicker();

// EndWebWidget jQuery_UI_Calendar: jQueryUICalendar12
          </script></td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="43" alt=""></td>
	</tr>
	<tr>
		<td colspan="2" rowspan="3">
			<img src="Assets/EditShow_43.gif" width="253" height="152" alt=""></td>
		<td rowspan="3">
			<img src="Assets/EditShow_44.gif" width="254" height="152" alt=""></td>
		<td colspan="3">
			<img src="Assets/EditShow_45.gif" width="251" height="28" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="28" alt=""></td>
	</tr>
	<tr>
		<td rowspan="2">
			<img src="Assets/EditShow_46.gif" width="118" height="124" alt=""></td>
		<td><input type="image" name="save" id="save" src="Assets/EditShow_47.gif"></td>
		<td rowspan="2">
			<img src="Assets/EditShow_48.gif" width="14" height="124" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="42" alt=""></td>
	</tr>
	<tr>
		<td>
			<img src="Assets/EditShow_49.gif" width="119" height="82" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="82" alt=""></td>
	</tr>
	<tr>
		<td>
			<img src="Assets/spacer.gif" width="327" height="1" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="179" height="1" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="74" height="1" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="6" height="1" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="254" height="1" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="4" height="1" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="118" height="1" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="119" height="1" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="14" height="1" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="1" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="115" height="1" alt=""></td>
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
