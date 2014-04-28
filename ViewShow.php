<!--	This page displays the information that is stored for the show.
-->
<html>
<head>
<title>AGL: View Show</title>
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

<!--this function limits characters possible to enter in the note field -->
<script language="javascript" type="text/javascript">
function limitText(limitField, limitCount, limitNum) {
	if (limitField.value.length > limitNum) {
		limitField.value = limitField.value.substring(0, limitNum);
	} else {
		limitCount.value = limitNum - limitField.value.length;
	}
}
</script>
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
    
    $showID = $_COOKIE['showID'];
    $user_name = 'actorsgu_data';
	$pass_word = 'cliffy36&winepress';
	$database = 'actorsgu_data';
	$server ='localhost:3306';
		
	$db_handle = mysql_connect($server, $user_name, $pass_word);
	$db_found = mysql_select_db($database, $db_handle);
	
	if ($db_found) 
	{
		$SQL = "SELECT * FROM Shows WHERE idShows = '$showID'";	
		$result = mysql_query($SQL);
		$num_rows = mysql_num_rows($result);
		$db_field = mysql_fetch_array($result);
		if($num_rows > 0) // if show exists in the data base
		{
		//Fill in that info
			//$First_Name = $db_field['First_Name'];//not there
			$Show_Name = $db_field['Show_Name'];
            $Director  = $db_field['Director'];
            $Playwright = $db_field['Playwright'];
            $Audition_Notes = $db_field['Audition_Notes'];
		}
		else
		{ 
            //First check to see which "Home" the user is going to
 	      if($role == 0 || $role == 1){
                echo "<script type='text/javascript'>
                    alert('There was an error retreiving your information.');".
                    "window.location = 'AdminTools.php';</script>";
		       exit;
            }
		  else if($role == 2){
                echo "<script type='text/javascript'>
                        alert('There was an error retreiving your information.');".
			         "window.location = 'UserTools.php';</script>";
                exit;
                }
		}
	}
    
	if (isset($_POST['audition'])) 
	{
		$db_handle = mysql_connect($server, $user_name, $pass_word);
		$db_found = mysql_select_db($database, $db_handle);
		
		if ($db_found) 
		{
			$SQL = "SELECT * FROM Role WHERE Shows_idShows = '$showID'";	
			$result = mysql_query($SQL);
			$num_rows = mysql_num_rows($result);
			if($num_rows > 0)
			{
				echo "<script type='text/javascript'>
							alert('This show has already been cast.');".
						 "window.location = 'ViewShow.php';</script>";
				   exit;
			}
			else
			{
				$showtitle = $_POST['title'];
				setcookie('showtitle', $showtitle);
				setcookie('showID', $showID);
				echo "<script type='text/javascript'>
					  window.location = 'Audition.php';</script>";//redirect to login page
				exit;
			}
		}
	}
    
            //Load in any Show_Events
    $SQL = "SELECT * FROM Show_Events WHERE Shows_idShows = $showID";
    $result = mysql_query($SQL);
	$num_rows = mysql_num_rows($result);
    //$db_field = mysql_fetch_array($result);
    $laMegaShowEventArray = array();
    while($row = mysql_fetch_array($result))
    {
        $laSingleShowEvent = array (
            'title' => $row['Title'],
            'startDate' => $row['Start_Date'],
            'endDate' => $row['End_Date'],
            'allDay' => $row['All_Day'],
            'firstName' => $row['First_Name'],
            'lastName' => $row['Last_Name'],
            'backgroundColor' => $row['Background_Color'],
            'foregroundColor' => $row['Foreground_Color']
        );
        $laSingleTitle = $laSingleShowEvent['title'];
        $laMegaShowEventArray[] = $laSingleShowEvent;
    }
    //print_r($laMegaShowEventArray);
?>
<style type="text/css">
#castDiv {
	position: absolute;
	left: 389px;
	top: 884px;
	width: 1129px;
	height: 383px;
	z-index: 1;
}
</style>
</head>
<body bgcolor="#000000" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<!-- Save for Web Slices (ViewShow.psd) -->
<div id="castDiv" style="overflow: scroll; alignment-adjust: central;">
<?php
	$db_handle = mysql_connect($server, $user_name, $pass_word);
	$db_found = mysql_select_db($database, $db_handle);
	
	if ($db_found) 
	{
		$SQL = "SELECT * FROM Role WHERE Shows_idShows = '$showID'";
		$castlist = mysql_query($SQL);
		$num_rows = mysql_num_rows($castlist);
		if($num_rows > 0)
		{			
				echo "<body bgcolor='blue'>";
				echo "
				<table border='1' bordercolor='#FFFFFF' style='color: #FFFFFF;border:none;' cellpadding='20' >
					<tr>
					<th>First Name</th>
					<th>Last Name</th>
					<th>Age</th>
					<th>Gender</th>
					</tr>";
					while($row = mysql_fetch_array($castlist))
					{
							//Get info from Personnel
							$id = $row['Personnel_idPersonnel'];
							$SQL = "SELECT * FROM Personnel WHERE idPersonnel='$id'";
							$result = mysql_query($SQL);
							$num_rows = mysql_num_rows($result);
							$db_field = mysql_fetch_array($result);
							
							echo "<tr><td>".$db_field['First_Name']."</td><td>".
										$db_field['Last_Name']."</td><td>".
										$db_field['Age']."</td><td>".
										$db_field['Gender']."</td></tr>";
					}
				echo "</table>";
				echo "<br>"."<br>";
				mysql_close($db_handle);
		}
		else
		{
			
		}
	}
	else
	{
		echo '<script type="text/javascript"> 
		  alert("Database is not found");
		  </script>';	
		exit;
	}
	mysql_close($db_handle);
?>
</div>
<form name="form" method="post" action="ViewShow.php">
<table width="1401" height="2161" border="0" align="center" cellpadding="0" cellspacing="0" id="Table_01">
	<tr>
		<td colspan="9">
			<img src="Assets/ViewShow_01.gif" width="1400" height="71" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="71" alt=""></td>
	</tr>
	<tr>
		<td colspan="6" rowspan="3">
			<img src="Assets/ViewShow_02.gif" width="1211" height="187" alt=""></td>
		<td colspan="2">
			<input type="image" name="home" value="home" src="Assets/ViewShow_03.gif" id="home"></td>
		<td rowspan="21">
			<img src="Assets/ViewShow_04.gif" width="83" height="2089" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="33" alt=""></td>
	</tr>
	<tr>
		<td colspan="2">
			<input type="image" name="logout" value="logout" src="Assets/ViewShow_05.gif" id"logout"></td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="33" alt=""></td>
	</tr>
	<tr>
		<td colspan="2" rowspan="15">
			<img src="Assets/ViewShow_06.gif" width="106" height="743" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="121" alt=""></td>
	</tr>
	<tr>
		<td colspan="2" rowspan="14">
			<img src="Assets/ViewShow_07.gif" width="396" height="622" alt=""></td>
		<td width="676" height="245" colspan="3" background="Assets/ViewShow_08.gif">&nbsp;
        <textarea name="showdescription" cols="81" rows="13" disabled readonly id="showdescription" style="color: #FFFFFF;border:none;background-color:transparent; resize:none"><?php echo $Audition_Notes ?></textarea>
        </td>
		<td rowspan="14">
			<img src="Assets/ViewShow_09.gif" width="139" height="622" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="245" alt=""></td>
	</tr>
	<tr>
		<td colspan="3">
			<img src="Assets/ViewShow_10.gif" width="676" height="61" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="61" alt=""></td>
	</tr>
	<tr>
		<td rowspan="12">
			<img src="Assets/ViewShow_11.gif" width="167" height="316" alt=""></td>
		<td width="509" height="34" colspan="2" background="Assets/ViewShow_12.gif">&nbsp;
        <input name="title" type="text" id="title" style="color: #FFFFFF;border:none;background-color:transparent;" size="70" value="<?php echo $Show_Name ?>" readonly>
        </td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="34" alt=""></td>
	</tr>
	<tr>
		<td colspan="2">
			<img src="Assets/ViewShow_13.gif" width="509" height="5" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="5" alt=""></td>
	</tr>
	<tr>
		<td width="509" height="34" colspan="2" background="Assets/ViewShow_14.gif">&nbsp;
        <input name="playwright" type="text" id="playwright" style="color: #FFFFFF;border:none;background-color:transparent;" size="70" value="<?php echo $Playwright ?>" readonly>
        </td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="34" alt=""></td>
	</tr>
	<tr>
		<td colspan="2">
			<img src="Assets/ViewShow_15.gif" width="509" height="5" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="5" alt=""></td>
	</tr>
	<tr>
		<td width="509" height="34" colspan="2" background="Assets/ViewShow_16.gif">&nbsp;
        <input name="director" type="text" id="director" style="color: #FFFFFF;border:none;background-color:transparent;" size="70" value="<?php echo $Director ?>" readonly>
        </td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="34" alt=""></td>
	</tr>
	<tr>
		<td colspan="2">
			<img src="Assets/ViewShow_17.gif" width="509" height="5" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="5" alt=""></td>
	</tr>
	<tr>
		<td width="509" height="34" colspan="2" background="Assets/ViewShow_18.gif">&nbsp;
        <input name="auditiondates" type="text" id="auditiondates" style="color: #FFFFFF;border:none;background-color:transparent;" size="70" readonly>
        </td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="34" alt=""></td>
	</tr>
	<tr>
		<td colspan="2">
			<img src="Assets/ViewShow_19.gif" width="509" height="5" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="5" alt=""></td>
	</tr>
	<tr>
		<td width="509" height="34" colspan="2" background="Assets/ViewShow_20.gif">&nbsp;
        <input name="showdates" type="text" id="showdates" style="color: #FFFFFF;border:none;background-color:transparent;" size="70" readonly>
        </td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="34" alt=""></td>
	</tr>
	<tr>
		<td colspan="2">
			<img src="Assets/ViewShow_21.gif" width="509" height="18" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="18" alt=""></td>
	</tr>
	<tr>
		<td rowspan="2">
			<img src="Assets/ViewShow_22.gif" width="419" height="108" alt=""></td>
		<td>
			<input type="image" name="audition" value="audition" src="Assets/ViewShow_23.gif" id"audition"></td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="37" alt=""></td>
	</tr>
	<tr>
		<td>
			<img src="Assets/ViewShow_24.gif" width="90" height="71" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="71" alt=""></td>
	</tr>
	<tr>
		<td rowspan="4">
			<img src="Assets/ViewShow_25.gif" width="118" height="1280" alt=""></td>
		<td width="1163" height="395" colspan="6" background="Assets/ViewShow_26.gif">&nbsp;</td>
		<td rowspan="4">
			<img src="Assets/ViewShow_27.gif" width="36" height="1280" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="395" alt=""></td>
	</tr>
	<tr>
		<td colspan="6">
			<img src="Assets/ViewShow_28.gif" width="1163" height="64" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="64" alt=""></td>
	</tr>
	<tr>
		<td width="1163" height="712" colspan="6" background="Assets/ViewShow_29.gif">
        <!--
        CALENDAR SPACE
        -->
        <div id="example" style="margin: auto; width:100%;">
		

		<div id="toolbar" class="ui-widget-header ui-corner-all" style="padding:3px; vertical-align: middle; white-space:nowrap; overflow: hidden;">
			<button id="BtnPreviousMonth">Previous Month</button>
			<button id="BtnNextMonth">Next Month</button>
			&nbsp;&nbsp;&nbsp;
			Date: <input type="text" id="dateSelect" size="20"/>
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

		
		<div id="display-event-form" title="View Agenda Item">
			
		</div>		

		<p>&nbsp;</p>
        <!--End Calendar Slice -->
        
        </td>
		
        
        <td>
			<img src="Assets/spacer.gif" width="1" height="712" alt=""></td>
	</tr>
	<tr>
		<td colspan="6">
			<img src="Assets/ViewShow_30.gif" width="1163" height="109" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="109" alt=""></td>
	</tr>
	<tr>
		<td>
			<img src="Assets/spacer.gif" width="118" height="1" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="278" height="1" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="167" height="1" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="419" height="1" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="90" height="1" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="139" height="1" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="70" height="1" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="36" height="1" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="83" height="1" alt=""></td>
		<td></td>
	</tr>
</table>
</form>
<!-- End Save for Web Slices -->
<script type="text/javascript">	
$(document).ready(function(){	
    var clickDate = "";
var clickAgendaItem = "";

        
	
	/**
	 * Initializes calendar with current year & month
	 * specifies the callbacks for day click & agenda item click events
	 * then returns instance of plugin object
	 */
	var jfcalplugin = $("#mycal").jFrontierCal({
		date: new Date(),
		dayClickCallback: myDayClickHandler,
		agendaClickCallback: myAgendaClickHandler,
		agendaDropCallback: myAgendaDropHandler,
		agendaMouseoverCallback: myAgendaMouseoverHandler,
		applyAgendaTooltipCallback: myApplyTooltip,
		agendaDragStartCallback : myAgendaDragStart,
		agendaDragStopCallback : myAgendaDragStop,
		dragAndDropEnabled: true
	}).data("plugin");
	
	/**
	 * Do something when dragging starts on agenda div
	 */
	function myAgendaDragStart(eventObj,divElm,agendaItem){
		// destroy our qtip tooltip
		if(divElm.data("qtip")){
			divElm.qtip("destroy");
		}	
	};
	
	/**
	 * Do something when dragging stops on agenda div
	 */
	function myAgendaDragStop(eventObj,divElm,agendaItem){
		//alert("drag stop");
	};
	
	/**
	 * Custom tooltip - use any tooltip library you want to display the agenda data.
	 * for this example we use qTip - http://craigsworks.com/projects/qtip/
	 *
	 * @param divElm - jquery object for agenda div element
	 * @param agendaItem - javascript object containing agenda data.
	 */
	function myApplyTooltip(divElm,agendaItem){

		// Destroy currrent tooltip if present
		if(divElm.data("qtip")){
			divElm.qtip("destroy");
		}
		
		var displayData = "";
		
		var title = agendaItem.title;
		var startDate = agendaItem.startDate;
		var endDate = agendaItem.endDate;
		var allDay = agendaItem.allDay;
		var data = agendaItem.data;
		displayData += "<br><b>" + title+ "</b><br><br>";
		if(allDay){
			displayData += "(All day event)<br><br>";
		}else{
			displayData += "<b>Starts:</b> " + startDate + "<br>" + "<b>Ends:</b> " + endDate + "<br><br>";
		}
		for (var propertyName in data) {
			displayData += "<b>" + propertyName + ":</b> " + data[propertyName] + "<br>"
		}
		// use the user specified colors from the agenda item.
		var backgroundColor = agendaItem.displayProp.backgroundColor;
		var foregroundColor = agendaItem.displayProp.foregroundColor;
		var myStyle = {
			border: {
				width: 5,
				radius: 10
			},
			padding: 10, 
			textAlign: "left",
			tip: true,
			name: "dark" // other style properties are inherited from dark theme		
		};
		if(backgroundColor != null && backgroundColor != ""){
			myStyle["backgroundColor"] = backgroundColor;
		}
		if(foregroundColor != null && foregroundColor != ""){
			myStyle["color"] = foregroundColor;
		}
		// apply tooltip
		divElm.qtip({
			content: displayData,
			position: {
				corner: {
					tooltip: "bottomMiddle",
					target: "topMiddle"			
				},
				adjust: { 
					mouse: true,
					x: 0,
					y: -15
				},
				target: "mouse"
			},
			show: { 
				when: { 
					event: 'mouseover'
				}
			},
			style: myStyle
		});

	};

	/**
	 * Make the day cells roughly 3/4th as tall as they are wide. this makes our calendar wider than it is tall. 
	 */
	jfcalplugin.setAspectRatio("#mycal",0.75);

	/**
	 * Called when user clicks day cell
	 * use reference to plugin object to add agenda item
	 */
	function myDayClickHandler(eventObj){
		// Get the Date of the day that was clicked from the event object
		var date = eventObj.data.calDayDate;
		// store date in our global js variable for access later
		clickDate = date.getFullYear() + "-" + (date.getMonth()+1) + "-" + date.getDate();
		// open our add event dialog
		$('#add-event-form').dialog('open');
	};
	
	/**
	 * Called when user clicks and agenda item
	 * use reference to plugin object to edit agenda item
	 */
	function myAgendaClickHandler(eventObj){
		// Get ID of the agenda item from the event object
		var agendaId = eventObj.data.agendaId;		
		// pull agenda item from calendar
		var agendaItem = jfcalplugin.getAgendaItemById("#mycal",agendaId);
		clickAgendaItem = agendaItem;
		$("#display-event-form").dialog('open');
	};
	
	/**
	 * Called when user drops an agenda item into a day cell.
	 */
	function myAgendaDropHandler(eventObj){
		// Get ID of the agenda item from the event object
		var agendaId = eventObj.data.agendaId;
		// date agenda item was dropped onto
		var date = eventObj.data.calDayDate;
		// Pull agenda item from calendar
		var agendaItem = jfcalplugin.getAgendaItemById("#mycal",agendaId);		
		alert("You dropped agenda item " + agendaItem.title + 
			" onto " + date.toString() + ". Here is where you can make an AJAX call to update your database.");
	};
	
	/**
	 * Called when a user mouses over an agenda item	
	 */
	function myAgendaMouseoverHandler(eventObj){
		var agendaId = eventObj.data.agendaId;
		var agendaItem = jfcalplugin.getAgendaItemById("#mycal",agendaId);
		//alert("You moused over agenda item " + agendaItem.title + " at location (X=" + eventObj.pageX + ", Y=" + eventObj.pageY + ")");
	};
	/**
	 * Initialize jquery ui datepicker. set date format to yyyy-mm-dd for easy parsing
	 */
	$("#dateSelect").datepicker({
		showOtherMonths: true,
		selectOtherMonths: true,
		changeMonth: true,
		changeYear: true,
		showButtonPanel: true,
		dateFormat: 'yy-mm-dd'
	});
	
	/**
	 * Set datepicker to current date
	 */
	$("#dateSelect").datepicker('setDate', new Date());
	/**
	 * Use reference to plugin object to a specific year/month
	 */
	$("#dateSelect").bind('change', function() {
		var selectedDate = $("#dateSelect").val();
		var dtArray = selectedDate.split("-");
		var year = dtArray[0];
		// jquery datepicker months start at 1 (1=January)		
		var month = dtArray[1];
		// strip any preceeding 0's		
		month = month.replace(/^[0]+/g,"")		
		var day = dtArray[2];
		// plugin uses 0-based months so we subtrac 1
		jfcalplugin.showMonth("#mycal",year,parseInt(month-1).toString());
	});	
	/**
	 * Initialize previous month button
	 */
	$("#BtnPreviousMonth").button();
	$("#BtnPreviousMonth").click(function() {
		jfcalplugin.showPreviousMonth("#mycal");
		// update the jqeury datepicker value
		var calDate = jfcalplugin.getCurrentDate("#mycal"); // returns Date object
		var cyear = calDate.getFullYear();
		// Date month 0-based (0=January)
		var cmonth = calDate.getMonth();
		var cday = calDate.getDate();
		// jquery datepicker month starts at 1 (1=January) so we add 1
		$("#dateSelect").datepicker("setDate",cyear+"-"+(cmonth+1)+"-"+cday);
		return false;
	});
	/**
	 * Initialize next month button
	 */
	$("#BtnNextMonth").button();
	$("#BtnNextMonth").click(function() {
		jfcalplugin.showNextMonth("#mycal");
		// update the jqeury datepicker value
		var calDate = jfcalplugin.getCurrentDate("#mycal"); // returns Date object
		var cyear = calDate.getFullYear();
		// Date month 0-based (0=January)
		var cmonth = calDate.getMonth();
		var cday = calDate.getDate();
		// jquery datepicker month starts at 1 (1=January) so we add 1
		$("#dateSelect").datepicker("setDate",cyear+"-"+(cmonth+1)+"-"+cday);		
		return false;
	});
	
	/**
	 * Initialize delete all agenda items button
	 */
	$("#BtnDeleteAll").button();
	$("#BtnDeleteAll").click(function() {	
		jfcalplugin.deleteAllAgendaItems("#mycal");	
		return false;
	});		
	
	/**
	 * Initialize iCal test button
	 */
	$("#BtnICalTest").button();
	$("#BtnICalTest").click(function() {
		// Please note that in Google Chrome this will not work with a local file. Chrome prevents AJAX calls
		// from reading local files on disk.		
		jfcalplugin.loadICalSource("#mycal",$("#iCalSource").val(),"html");	
		return false;
	});	
    
    $("#addKnownEvent").button();
    $("#addKnownEvent").click(function() {
        addGivenAgenda();
        return false;
    });
    
    $("#save").button();
    $("#save").click(function() {
       saveEvent();
       return false; 
    });

	/**
	 * Initialize add event modal form
	 */
	$("#add-event-form").dialog({
		autoOpen: false,
		height: 400,
		width: 400,
		modal: true,
		buttons: {
			'Add Event': function() {

				var what = jQuery.trim($("#what").val());
			
				if(what == ""){
					alert("Please enter a short event description into the \"what\" field.");
				}else{
				
					var startDate = $("#startDate").val();
					var startDtArray = startDate.split("-");
					var startYear = startDtArray[0];
					// jquery datepicker months start at 1 (1=January)		
					var startMonth = startDtArray[1];		
					var startDay = startDtArray[2];
					// strip any preceeding 0's		
					startMonth = startMonth.replace(/^[0]+/g,"");
					startDay = startDay.replace(/^[0]+/g,"");
					var startHour = jQuery.trim($("#startHour").val());
					var startMin = jQuery.trim($("#startMin").val());
					var startMeridiem = jQuery.trim($("#startMeridiem").val());
					startHour = parseInt(startHour.replace(/^[0]+/g,""));
					if(startMin == "0" || startMin == "00"){
						startMin = 0;
					}else{
						startMin = parseInt(startMin.replace(/^[0]+/g,""));
					}
					if(startMeridiem == "AM" && startHour == 12){
						startHour = 0;
					}else if(startMeridiem == "PM" && startHour < 12){
						startHour = parseInt(startHour) + 12;
					}

					var endDate = $("#endDate").val();
					var endDtArray = endDate.split("-");
					var endYear = endDtArray[0];
					// jquery datepicker months start at 1 (1=January)		
					var endMonth = endDtArray[1];		
					var endDay = endDtArray[2];
					// strip any preceeding 0's		
					endMonth = endMonth.replace(/^[0]+/g,"");

					endDay = endDay.replace(/^[0]+/g,"");
					var endHour = jQuery.trim($("#endHour").val());
					var endMin = jQuery.trim($("#endMin").val());
					var endMeridiem = jQuery.trim($("#endMeridiem").val());
					endHour = parseInt(endHour.replace(/^[0]+/g,""));
					if(endMin == "0" || endMin == "00"){
						endMin = 0;
					}else{
						endMin = parseInt(endMin.replace(/^[0]+/g,""));
					}
					if(endMeridiem == "AM" && endHour == 12){
						endHour = 0;
					}else if(endMeridiem == "PM" && endHour < 12){
						endHour = parseInt(endHour) + 12;
					}
					
					//alert("Start time: " + startHour + ":" + startMin + " " + startMeridiem + ", End time: " + endHour + ":" + endMin + " " + endMeridiem);

					// Dates use integers
					var startDateObj = new Date(parseInt(startYear),parseInt(startMonth)-1,parseInt(startDay),startHour,startMin,0,0);
					var endDateObj = new Date(parseInt(endYear),parseInt(endMonth)-1,parseInt(endDay),endHour,endMin,0,0);

					// add new event to the calendar
					jfcalplugin.addAgendaItem(
						"#mycal",
						what,
						startDateObj,
						endDateObj,
						false,
						{
							fname: "Santa",
							lname: "Claus",
							myDate: new Date(),
							myNum: 42
						},
						{
							backgroundColor: $("#colorBackground").val(),
							foregroundColor: $("#colorForeground").val()
						}
					);

					$(this).dialog('close');

				}
				
			},
			Cancel: function() {
				$(this).dialog('close');
			}
		},
		open: function(event, ui){
			// initialize start date picker
			$("#startDate").datepicker({
				showOtherMonths: true,
				selectOtherMonths: true,
				changeMonth: true,
				changeYear: true,
				showButtonPanel: true,
				dateFormat: 'yy-mm-dd'
			});
			// initialize end date picker
			$("#endDate").datepicker({
				showOtherMonths: true,
				selectOtherMonths: true,
				changeMonth: true,
				changeYear: true,
				showButtonPanel: true,
				dateFormat: 'yy-mm-dd'
			});
			// initialize with the date that was clicked
			$("#startDate").val(clickDate);
			$("#endDate").val(clickDate);
			// initialize color pickers
			$("#colorSelectorBackground").ColorPicker({
				color: "#333333",
				onShow: function (colpkr) {
					$(colpkr).css("z-index","10000");
					$(colpkr).fadeIn(500);
					return false;
				},
				onHide: function (colpkr) {
					$(colpkr).fadeOut(500);
					return false;
				},
				onChange: function (hsb, hex, rgb) {
					$("#colorSelectorBackground div").css("backgroundColor", "#" + hex);
					$("#colorBackground").val("#" + hex);
				}
			});
			//$("#colorBackground").val("#1040b0");		
			$("#colorSelectorForeground").ColorPicker({
				color: "#ffffff",
				onShow: function (colpkr) {
					$(colpkr).css("z-index","10000");
					$(colpkr).fadeIn(500);
					return false;
				},
				onHide: function (colpkr) {
					$(colpkr).fadeOut(500);
					return false;
				},
				onChange: function (hsb, hex, rgb) {
					$("#colorSelectorForeground div").css("backgroundColor", "#" + hex);
					$("#colorForeground").val("#" + hex);
				}
			});
			//$("#colorForeground").val("#ffffff");				
			// put focus on first form input element
			$("#what").focus();
		},
		close: function() {
			// reset form elements when we close so they are fresh when the dialog is opened again.
			$("#startDate").datepicker("destroy");
			$("#endDate").datepicker("destroy");
			$("#startDate").val("");
			$("#endDate").val("");
			$("#startHour option:eq(0)").attr("selected", "selected");
			$("#startMin option:eq(0)").attr("selected", "selected");
			$("#startMeridiem option:eq(0)").attr("selected", "selected");
			$("#endHour option:eq(0)").attr("selected", "selected");
			$("#endMin option:eq(0)").attr("selected", "selected");
			$("#endMeridiem option:eq(0)").attr("selected", "selected");			
			$("#what").val("");
			//$("#colorBackground").val("#1040b0");
			//$("#colorForeground").val("#ffffff");
		}
	});
	
	/**
	 * Initialize display event form.
	 */
	$("#display-event-form").dialog({
		autoOpen: false,
		height: 400,
		width: 400,
		modal: true,
		buttons: {		
			Cancel: function() {
				$(this).dialog('close');
			},
			'Edit': function() {
				alert("Make your own edit screen or dialog!");
			},
			'Delete': function() {
				if(confirm("Are you sure you want to delete this agenda item?")){
					if(clickAgendaItem != null){
						jfcalplugin.deleteAgendaItemById("#mycal",clickAgendaItem.agendaId);
						//jfcalplugin.deleteAgendaItemByDataAttr("#mycal","myNum",42);
					}
					$(this).dialog('close');
				}
			}			
		},
		open: function(event, ui){
			if(clickAgendaItem != null){
				var title = clickAgendaItem.title;
				var startDate = clickAgendaItem.startDate;
				var endDate = clickAgendaItem.endDate;
				var allDay = clickAgendaItem.allDay;
				var data = clickAgendaItem.data;
				// in our example add agenda modal form we put some fake data in the agenda data. we can retrieve it here.
				$("#display-event-form").append(
					"<br><b>" + title+ "</b><br><br>"		
				);				
				if(allDay){
					$("#display-event-form").append(
						"(All day event)<br><br>"				
					);				
				}else{
					$("#display-event-form").append(
						"<b>Starts:</b> " + startDate + "<br>" +
						"<b>Ends:</b> " + endDate + "<br><br>"				
					);				
				}
				for (var propertyName in data) {
					$("#display-event-form").append("<b>" + propertyName + ":</b> " + data[propertyName] + "<br>");
				}			
			}		
		},
		close: function() {
			// clear agenda data
			$("#display-event-form").html("");
		}
	});	 

	/**
	 * Initialize our tabs
	 */
	$("#tabs").tabs({
		/*
		 * Our calendar is initialized in a closed tab so we need to resize it when the example tab opens.
		 */
		show: function(event, ui){
			if(ui.index == 1){
				jfcalplugin.doResize("#mycal");
			}
		}	
	});
    
    function saveEvent(){
        var laItems = jfcalplugin.getAllAgendaItems("#mycal");
        laItems.forEach(function(entry) {
            lsStartDate =   entry['startDate'].toJSON();
            lsEndDate   =   entry['endDate'].toJSON();
            lsBackgroundColor    =   entry.displayProp.backgroundColor;
            lsForegroundColor   =   entry.displayProp.foregroundColor;
            lsShowID            =   <?php echo $showID; ?>;
            lsAllDay            =   entry.allDay.toString();
            var laSingleEvent = new Array();
            laSingleEvent[0]    = entry.title;
            laSingleEvent[1]    = lsStartDate;
            laSingleEvent[2]    = lsEndDate;
            laSingleEvent[3]    = lsAllDay;
            laSingleEvent[4]    = entry.data.fname;
            laSingleEvent[5]    = entry.data.lname;
            laSingleEvent[6]    = lsBackgroundColor;
            laSingleEvent[7]    = lsForegroundColor;
            laSingleEvent[8]    = lsShowID;
            //laSingleEvent   =   [entry.title, lsStartDate, lsEndDate, lsAllDay, entry.data.fname, entry.data.lname, lsBackgroundColor, lsForegroundColor, lsShowID];
            alert(entry.displayProp.backgroundColor);
            $.ajax({
                type:   "POST",
                url:    "SaveShowEdit.php",
                data:   { eventData : laSingleEvent },
                success: function() {
                    alert('Save successful!');
                }
            });
        });
    }
    
    
//    function addGivenAgenda() {
//        //Won't do a goddamn thing
//        //var c = a + b;
//        //vsTitle, vaStartDate, vaEndDate, vbAllDay, vaDataArray, vaColorArray
//        jfcalplugin.addAgendaItem(
//	       "#mycal",
//	       "Christmas Eve",
//	       new Date(2014,3,14,20,0,0,0),
//	       new Date(2014,3,24,23,59,59,0),
//	       false,
//	       {
//		      fname: "Santa",
//		      lname: "Claus",
//		      leadReindeer: "Rudolph",
//		      randomness: newVariable
//	       },
//	       {
//		      backgroundColor: "#FF0F00",
//		      foregroundColor: "#FFFFFF"
//	       }	
//        );
//    }
    //Load our events from any previous edits:
    function addGivenAgenda() {
        alert('Now attempting load');
        var laEventList = new Array();
        laEventList = <?php echo json_encode($laMegaShowEventArray)?>;
        laEventList.forEach(function(singleEvent) {
         //alert(JSON.stringify(singleEvent, null, 4))   
        //Parse out all our variables
        
//        $laSingleShowEvent = array (
//            'title' => $row['Title'],
//            'startDate' => $row['Start_Date'],
//            'endDate' => $row['End_Date'],
//            'allDay' => $row['All_Day'],
//            'firstName' => $row['First_Name'],
//            'lastName' => $row['Last_Name'],
//            'backgroundColor' => $row['Background_Color'],
//            'foregroundColor' => $row['Foreground_Color']
//        );
        lsTitle = singleEvent['title'];
        ldStartDate = new Date(singleEvent['startDate']);
        ldEndDate   = new Date(singleEvent['endDate']);
        firstName = singleEvent['firstName'];
        lastName  = singleEvent['lastName'];
        fullName = firstName + " " + lastName;
        backColor = singleEvent['backgroundColor'];
        foreColor = singleEvent['foregroundColor'];
        //alert('Entry found for title ' + $lsTitle + ' with color ' + backColor );
        
        jfcalplugin.addAgendaItem(
	       "#mycal",
	       lsTitle,
	       ldStartDate,
	       ldEndDate,
	       false,
	       {
		      Entered_By: fullName
	       },
	       {
		      backgroundColor: backColor,
		      foregroundColor: foreColor
	       }	
        );
        });
    }
    
    addGivenAgenda();
    
});    
</script>
</body>
</html>