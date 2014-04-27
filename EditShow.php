<html>
<head>
<title>AGL: Edit Show</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<!-- Include CSS for JQuery Frontier Calendar plugin (Required for calendar plugin) -->
<link rel="stylesheet" type="text/css" href="css/frontierCalendar/jquery-frontier-cal-1.3.2.css" />

<!-- Include CSS for color picker plugin (Not required for calendar plugin. Used for example.) -->
<link rel="stylesheet" type="text/css" href="css/colorpicker/colorpicker.css" />

<!-- Include CSS for JQuery UI (Required for calendar plugin.) -->
<link rel="stylesheet" type="text/css" href="css/jquery-ui/smoothness/jquery-ui-1.8.1.custom.css" />

<!--
Include JQuery Core (Required for calendar plugin)
** This is our IE fix version which enables drag-and-drop to work correctly in IE. See README file in js/jquery-core folder. **
-->
<script type="text/javascript" src="js/jquery-core/jquery-1.4.2-ie-fix.min.js"></script>

<!-- Include JQuery UI (Required for calendar plugin.) -->
<script type="text/javascript" src="js/jquery-ui/smoothness/jquery-ui-1.8.1.custom.min.js"></script>

<!-- Include color picker plugin (Not required for calendar plugin. Used for example.) -->
<script type="text/javascript" src="js/colorpicker/colorpicker.js"></script>

<!-- Include jquery tooltip plugin (Not required for calendar plugin. Used for example.) -->
<script type="text/javascript" src="js/jquery-qtip-1.0.0-rc3140944/jquery.qtip-1.0.js"></script>

<!--
	(Required for plugin)
	Dependancies for JQuery Frontier Calendar plugin.
    ** THESE MUST BE INCLUDED BEFORE THE FRONTIER CALENDAR PLUGIN. **
-->
<script type="text/javascript" src="js/lib/jshashtable-2.1.js"></script>

<!-- Include JQuery Frontier Calendar plugin -->
<script type="text/javascript" src="js/frontierCalendar/jquery-frontier-cal-1.3.2.min.js"></script>

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

<script src="Calendar.js"></script>

<script type="text/javascript">
//    title = "Summer Bash";
//    var start   =   new Date(2014,3,14,12,0,0,0);
//    var end     =   new Date(2014,3,15,12,00,0,0);
//    dayBool = false;
//    var dataArray = Array{
//    fname: "Santa",
//    lname: "Claus",
//    leadReindeer: "Rudolph"
//    };
//    var colorArray = Array{
//    backgroundColor: "#FF0F00",
//    foregroundColor: "#FFFFFF"
//    };
//    addGivenAgenda(title,start,end,dayBool,dataArray,colorArray);
</script>
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
        <textarea name="auditionnotes" id="auditionnotes" cols="90" rows="5" style="color: #FFFFFF;border:none;background-color:transparent; resize:none"></textarea>
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
        <div id="example" style="margin: auto; width:100%;">
		

		<div id="toolbar" class="ui-widget-header ui-corner-all" style="padding:3px; vertical-align: middle; white-space:nowrap; overflow: hidden;">
			<button id="BtnPreviousMonth">Previous Month</button>
			<button id="BtnNextMonth">Next Month</button>
			&nbsp;&nbsp;&nbsp;
			Date: <input type="text" id="dateSelect" size="20"/>
			&nbsp;&nbsp;&nbsp;
			<button id="BtnDeleteAll">Delete All</button>
		</div>

		<!--
		You can use pixel widths or percentages. Calendar will auto resize all sub elements.
		Height will be calculated by aspect ratio. Basically all day cells will be as tall
		as they are wide.
		-->
		<div id="mycal"></div>

		</div>

		<!-- debugging-->
		<div id="calDebug"></div>

		<!-- Add event modal form -->
		<style type="text/css">
			//label, input.text, select { display:block; }
			fieldset { padding:0; border:0; margin-top:25px; }
			.ui-dialog .ui-state-error { padding: .3em; }
			.validateTips { border: 1px solid transparent; padding: 0.3em; }
		</style>
		<div id="add-event-form" title="Add New Event">
			<p class="validateTips">All form fields are required.</p>
			<form>
			<fieldset>
				<label for="name">What?</label>
				<input type="text" name="what" id="what" class="text ui-widget-content ui-corner-all" style="margin-bottom:12px; width:95%; padding: .4em;"/>
				<table style="width:100%; padding:5px;">
					<tr>
						<td>
							<label>Start Date</label>
							<input type="text" name="startDate" id="startDate" value="" class="text ui-widget-content ui-corner-all" style="margin-bottom:12px; width:95%; padding: .4em;"/>				
						</td>
						<td>&nbsp;</td>
						<td>
							<label>Start Hour</label>
							<select id="startHour" class="text ui-widget-content ui-corner-all" style="margin-bottom:12px; width:95%; padding: .4em;">
								<option value="12" SELECTED>12</option>
								<option value="1">1</option>
								<option value="2">2</option>
								<option value="3">3</option>
								<option value="4">4</option>
								<option value="5">5</option>
								<option value="6">6</option>
								<option value="7">7</option>
								<option value="8">8</option>
								<option value="9">9</option>
								<option value="10">10</option>
								<option value="11">11</option>
							</select>				
						<td>
						<td>
							<label>Start Minute</label>
							<select id="startMin" class="text ui-widget-content ui-corner-all" style="margin-bottom:12px; width:95%; padding: .4em;">
								<option value="00" SELECTED>00</option>
								<option value="10">10</option>
								<option value="20">20</option>
								<option value="30">30</option>
								<option value="40">40</option>
								<option value="50">50</option>
							</select>				
						<td>
						<td>
							<label>Start AM/PM</label>
							<select id="startMeridiem" class="text ui-widget-content ui-corner-all" style="margin-bottom:12px; width:95%; padding: .4em;">
								<option value="AM" SELECTED>AM</option>
								<option value="PM">PM</option>
							</select>				
						</td>
					</tr>
					<tr>
						<td>
							<label>End Date</label>
							<input type="text" name="endDate" id="endDate" value="" class="text ui-widget-content ui-corner-all" style="margin-bottom:12px; width:95%; padding: .4em;"/>				
						</td>
						<td>&nbsp;</td>
						<td>
							<label>End Hour</label>
							<select id="endHour" class="text ui-widget-content ui-corner-all" style="margin-bottom:12px; width:95%; padding: .4em;">
								<option value="12" SELECTED>12</option>
								<option value="1">1</option>
								<option value="2">2</option>
								<option value="3">3</option>
								<option value="4">4</option>
								<option value="5">5</option>
								<option value="6">6</option>
								<option value="7">7</option>
								<option value="8">8</option>
								<option value="9">9</option>
								<option value="10">10</option>
								<option value="11">11</option>
							</select>				
						<td>
						<td>
							<label>End Minute</label>
							<select id="endMin" class="text ui-widget-content ui-corner-all" style="margin-bottom:12px; width:95%; padding: .4em;">
								<option value="00" SELECTED>00</option>
								<option value="10">10</option>
								<option value="20">20</option>
								<option value="30">30</option>
								<option value="40">40</option>
								<option value="50">50</option>
							</select>				
						<td>
						<td>
							<label>End AM/PM</label>
							<select id="endMeridiem" class="text ui-widget-content ui-corner-all" style="margin-bottom:12px; width:95%; padding: .4em;">
								<option value="AM" SELECTED>AM</option>
								<option value="PM">PM</option>
							</select>				
						</td>				
					</tr>			
				</table>
				<table>
					<tr>
						<td>
							<label>Background Color</label>
						</td>
						<td>
							<div id="colorSelectorBackground"><div style="background-color: #333333; width:30px; height:30px; border: 2px solid #000000;"></div></div>
							<input type="hidden" id="colorBackground" value="#333333">
						</td>
						<td>&nbsp;&nbsp;&nbsp;</td>
						<td>
							<label>Text Color</label>
						</td>
						<td>
							<div id="colorSelectorForeground"><div style="background-color: #ffffff; width:30px; height:30px; border: 2px solid #000000;"></div></div>
							<input type="hidden" id="colorForeground" value="#ffffff">
						</td>						
					</tr>				
				</table>
			</fieldset>
			</form>
		</div>
		
		<div id="display-event-form" title="View Agenda Item">
			
		</div>		

		<p>&nbsp;</p>
        <!--End Calendar Slice -->
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