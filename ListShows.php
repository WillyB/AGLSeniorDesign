<!--	This page can be reached from the UserTools.php or AdminTools.php page
        and displays a list of all the shows that are in the database. The user
        will have the option to View the information about the show and those
        with admin access can cast their show, edit the information, or delete
        the show.
-->
<html>
<head>
<title>AGL: List Shows</title>
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

//data to login into mysql server on multilab machine
$user_name = 'actorsgu_data';
$pass_word = 'cliffy36&winepress';
$database = 'actorsgu_data';
//$server = 'box293.bluehost.com:3306';
$server = 'localhost:3306';

	
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
	
	mysql_close($db_handle);
	
	echo "<script type='text/javascript'>
		  alert('Goodbye!');".
		 "window.location = 'LogIn.php';</script>";//redirect to login page
	exit;	
}

if(isset($_POST['Delete']))
{
	$user_name = 'actorsgu_data';
	$pass_word = 'cliffy36&winepress';
	$database = 'actorsgu_data';
	$server = 'localhost:3306';
	//$server = 'box293.bluehost.com:3306';

	$db_handle = mysql_connect($server, $user_name, $pass_word);
	$db_found = mysql_select_db($database, $db_handle);
	
	if ($db_found)
	{
		$showID = $_POST['ShowID1'];		
		$SQL2 = "DELETE FROM Shows WHERE idShows='$showID'";
		$result2 = mysql_query($SQL2);
		echo "<script type='text/javascript'>
			  window.location='ListShows.php';</script>";		
		exit;	
    }
	else//if DB was not found
	{
		echo '<script type="text/javascript"> 
			  alert("Database is not found");
			  </script>';	
		exit;
	}
	mysql_close($db_handle);
}

//If "EDIT" button was pressed
if(isset($_POST['Edit']))
{
	$showID = $_POST['ShowID2'];
	setCookie('showID', $showID);//set cookie to pass use on the next page
	echo  "<script type='text/javascript'>
			window.location = 'EditShow.php';</script>";
	exit;
}

if(isset($_POST['View']))
{
	$showID = $_POST['ShowID'];
	setCookie('showID', $showID);//set cookie to pass use on the next page
	echo  "<script type='text/javascript'>
			window.location = 'ViewShow.php';</script>";
	exit;
}
if(isset($_POST['Edit']))
{
	$showID = $_POST['ShowID'];
	setCookie('showID', $showID);//set cookie to pass use on the next page
	echo  "<script type='text/javascript'>
			window.location = 'EditShow.php';</script>";
	exit;
}

if(isset($_POST['Cast']))
{
	$showID = $_POST['ShowID'];
	
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
		 			"window.location = 'ListShows.php';</script>";
		}
		else
		{
			setcookie('showID', $showID);
			echo  "<script type='text/javascript'>
					window.location = 'CastShow.php';</script>";
			exit;
		}
	}
	else//if DB was not found
	{
		echo '<script type="text/javascript"> 
			  alert("Database is not found");
			  </script>';	
		exit;
	}
	mysql_close($db_handle);
}		
?>

</head>
<body bgcolor="#00000" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<!-- Save for Web Slices (ListShows.psd) -->
<form name="form" method="post" action="ListShows.php">
<table width="1400" height="968" border="0" align="center" cellpadding="0" cellspacing="0" id="Table_01">
	<tr>
		<td colspan="5">
			<img src="Assets/ListShows_01.gif" width="1400" height="70" alt=""></td>
	</tr>
	<tr>
		<td colspan="3" rowspan="3">
			<img src="Assets/ListShows_02.gif" width="1211" height="150" alt=""></td>
		<td>
			<input type="image" name="home" value="home" src="Assets/ListShows_03.gif" id="home"></td>
		<td rowspan="3">
			<img src="Assets/ListShows_04.gif" width="83" height="150" alt=""></td>
	</tr>
	<tr>
		<td>
			<input type="image" name="logout" value="logout" src="Assets/ListShows_05.gif" id="logout"></td>
	</tr>
	<tr>
		<td>
			<img src="Assets/ListShows_06.gif" width="106" height="83" alt=""></td>
	</tr>
	<tr>
		<td colspan="5">
			<img src="Assets/ListShows_07.gif" width="1400" height="35" alt=""></td>
	</tr>
	<tr>
		<td rowspan="2">
			<img src="Assets/ListShows_08.gif" width="384" height="712" alt=""></td>
		<td width="654" height="564" background="Assets/ListShows_09.gif">
        <?php
			$db_handle = mysql_connect($server, $user_name, $pass_word);
			$db_found = mysql_select_db($database, $db_handle);

			if ($db_found) 
			{
				$SQL = 'SELECT * FROM Shows';
				$result = mysql_query($SQL);
				$num_rows = mysql_num_rows($result);
	
				//print out results if query returned result
				if($num_rows > 0)
				{	
					echo "<body bgcolor='silver'>";
					echo "<table border='1' bordercolor='#ffffff' style='color: #ffffff;border:none;background-color:#transparent;' align='left' cellpadding='20' >
					<tr>
							<th>Title</th>			
							<th>Director</th>";
					if ($role == 0 || $role == 1){
					   echo "<th>View</th>
					   		<th>Edit</th>
                            <th>Cast</th></tr>";
					}
                    else
                        "<th>View</th></tr>";
                            
							
					while($row = mysql_fetch_array($result))
					{
						$value = $row['idShows'];
						echo "<tr><td>".$row['Show_Name']."</td><td>".
										$row['Director']."</td>";
						echo "<form action='ListShows.php' method='post'>";
                                 if ($role == 0 || $role == 1){
                                    echo "<td><input type='SUBMIT' name='View' value='View'/>
								         <input type='HIDDEN' name='ShowID' value='" .$value. "'/></td>
										 
										 <td><input type='SUBMIT' name='Edit' value='Edit'/>
								         <input type='HIDDEN' name='ShowID' value='" .$value. "'/></td>
                                        
                                        <td><input type='SUBMIT' name='Cast' value='Cast Show'/>
								        <input type='HIDDEN' name='ShowID' value='" .$value. "'/></td></form>";
                                 }
                                 else{
                                    echo "<td><input type='SUBMIT' name='View' value='View'/>
								            <input type='HIDDEN' name='ShowID' value='" .$value. "'/></td></form>";
                                 }
                                 
                                 
                                 
                                 //<td><input type='SUBMIT' name='Cast' value='Cast Show'/>
								 //<input type='HIDDEN' name='ShowID3' value='" .$value. "'/></td>
								 
								 //<td><input type='SUBMIT' name='Edit' value='Edit'/>
								 //<input type='HIDDEN' name='ShowID2' value='" .$value. "'/></td>
								 
								 
								 //<td><input type='SUBMIT' name='Delete' value='Delete'/>
								 //<input type='HIDDEN' name='ShowID1' value='" .$value. "'/></td></td></form>";	 						
					}
					echo "</table>";
					echo "<br>"."<br>";
				}
				else//if there is no specified user found in DB
				{							
					echo "<script type='text/javascript'>
						 alert('NO SHOWS FOUND');".
						 "window.location = 'AdminTools.php';</script>";//redirect back to SearchDB.php page 
					exit;			
				}			
			}
			else//if DB was not found
			{
				echo '<script type="text/javascript"> 
					  alert("Database is not found");
					  </script>';				  
			}	
			mysql_close($db_handle);
		?>
        </td>
		<td colspan="3" rowspan="2">
			<img src="Assets/ListShows_10.gif" width="362" height="712" alt=""></td>
	</tr>
	<tr>
		<td>
			<img src="Assets/ListShows_11.gif" width="654" height="148" alt=""></td>
	</tr>
	<tr>
		<td>
			<img src="Assets/spacer.gif" width="384" height="1" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="654" height="1" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="173" height="1" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="106" height="1" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="83" height="1" alt=""></td>
	</tr>
</table>
</form>
<!-- End Save for Web Slices -->
</body>
</html>
