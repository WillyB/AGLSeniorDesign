<html>
<head>
<title>AGL: View Users</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?php

        //Arrays to hold all our database results:
        $asFirstName = array();
        $asLastName = array();
        $asEmail = array();
        
        //data to login into mysql server on multilab machine
		$user_name = 'actorsgu_data';
		$pass_word = 'cliffy36&winepress';
		$database = 'actorsgu_data';
		$server = 'localhost:3306';//change back to 'localhost:3306';

		$db_handle = mysql_connect($server, $user_name, $pass_word);
		$db_found = mysql_select_db($database, $db_handle);
        
        if ($db_found)
        {
            //$SQL = "SELECT First_Name, Last_Name FROM Personnel";
//            $result = mysql_query($SQL);
            
            $rs = mysql_query("SELECT First_Name, Last_Name, Contact_Email FROM Personnel") or die(mysql_error());

            
            while($row = mysql_fetch_assoc($rs))
            {
                $asFirstName[] = $rs['First_Name'];
                $asLastName[] = $rs['Last_Name'];
                $asEmail[] = $rs['Contact_Email'];
            }
                
            
        }
?>
<script type="text/javascript">
    var asFirstName = <?php echo json_encode($asFirstName); ?>;
    var asLastName = <?php echo json_encode($asLasttName); ?>;
    var asEmail = <?php echo json_encode($asEmail); ?>;
    
//    function userLists() {
//     var addList = document.getElementById(UserList);
//     var docstyle = addList.style.display   
//        
//    }
    $(document).ready(function(){
       var list = "";
       for(i=0, i<asFirstName.length; i++){
        list +="<li>"+asFirstname[i]+"</li>"
       } 
        $("#UserTableList").append(list);
        
    });
    
</script>
</head>
<body bgcolor="#00000" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<!-- Save for Web Slices (ViewUsers.psd) -->
<table width="1401" height="967" border="0" align="center" cellpadding="0" cellspacing="0" id="Table_01">
	<tr>
		<td colspan="5">
			<img src="Assets/ViewUsers_01.gif" width="1400" height="70" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="70" alt=""></td>
	</tr>
	<tr>
		<td colspan="3" rowspan="3">
			<img src="Assets/ViewUsers_02.gif" width="1211" height="185" alt=""></td>
		<td><input type="image" name="home" id="home" src="Assets/ViewUsers_03.gif"></td>
		<td rowspan="5">
			<img src="Assets/ViewUsers_04.gif" width="83" height="897" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="35" alt=""></td>
	</tr>
	<tr>
		<td><input type="image" name="logout" id="logout" src="Assets/ViewUsers_05.gif"></td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="32" alt=""></td>
	</tr>
	<tr>
		<td rowspan="3">
			<img src="Assets/ViewUsers_06.gif" width="106" height="830" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="118" alt=""></td>
	</tr>
	<tr>
		<td rowspan="2">
			<img src="Assets/ViewUsers_07.gif" width="384" height="712" alt=""></td>
		<td width="654" height="564" background="Assets/ViewShows_08.gif">&nbsp;
        <div id="UserList">
            overflow:auto;
            <ul id="UserTableList" style="padding: 0;">
            </ul>
        </div>
        <!--
        <label for="users"></label>
	    <textarea name="users" id="users" cols="76" rows="33" style="color: #FFFFFF;border:none;background-color:transparent;"></textarea>
        -->
        </td>
		<td rowspan="2">
			<img src="Assets/ViewUsers_09.gif" width="173" height="712" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="564" alt=""></td>
	</tr>
	<tr>
		<td>
			<img src="Assets/ViewUsers_10.gif" width="654" height="148" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="148" alt=""></td>
	</tr>
</table>
<!-- End Save for Web Slices -->
</body>
</html>