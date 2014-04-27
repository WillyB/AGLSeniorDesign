<html>
<head>
<title>AGL: List Users</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?php
include 'MasterCode.php';
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

if(isset($_POST['View']))
{
    $target_email = $_POST['UserEmail0'];
	setCookie('target_email', $target_email);//set cookie to pass use on the next page
	echo  "<script type='text/javascript'>
			window.location = 'ViewProfile.php';</script>";
	exit;
}

if(isset($_POST['Admin_Options']))
{
    $who = $_POST['UserEmail1'];
	//setCookie('who', $who);//set cookie to pass use on the next page
	$action = $_POST['options'];
	
	$db_handle = mysql_connect($server, $user_name, $pass_word);
	$db_found = mysql_select_db($database, $db_handle);

	if ($db_found) 
	{	
		if($email == $who)
		{
			echo "<script type='text/javascript'>
			  	alert('You cannot modify your own profile!');</script>";
		}
		elseif($action == "deleteuser")
		{
			$SQL = "DELETE FROM Personnel WHERE Contact_Email = '$who'";
			$result = mysql_query($SQL);
		}
		elseif($action == "makeactor")
		{
			$SQL = "UPDATE Personnel SET Role = 2 WHERE Contact_Email = '$who'";
			$result = mysql_query($SQL);	
		}
		elseif($action == "makedirector")
		{
			$SQL = "UPDATE Personnel SET Role = 1 WHERE Contact_Email = '$who'";
			$result = mysql_query($SQL);
		}
		elseif($action == "makeadmin")
		{
			$SQL = "UPDATE Personnel SET Role = 0 WHERE Contact_Email = '$who'";
			$result = mysql_query($SQL);
		}
	}
	else//if DB was not found
	{
		echo '<script type="text/javascript"> 
			  alert("Database is not found");
			  </script>';				  
	}	
	mysql_close($db_handle);
	
	echo "<script type='text/javascript'>
			 window.location = 'ListUsers.php';</script>"; // reload to reflect changes
	
	exit;
}

if(isset($_POST['Delete']))
{
	$who = $_POST['UserEmail0'];

	if($who == $email)
	{
		echo "<script type='text/javascript'>
			  alert('You cannot delete your own profile');".
			 "window.location = 'ListUsers.php';</script>";		
		exit;			
	}
//	//data to login into mysql server on multilab machine
//	$user_name = 'actorsgu_data';
//	$pass_word = 'cliffy36&winepress';
//	$database = 'actorsgu_data';
//	//$server = 'box293.bluehost.com:3306';
//	$server = 'localhost:3306';

	$db_handle = mysql_connect($server, $user_name, $pass_word);
	$db_found = mysql_select_db($database, $db_handle);

	if ($db_found) 
	{		
		$SQL1 = "SELECT Role FROM Personnel WHERE Contact_Email='$who'";
		$result1 = mysql_query($SQL1);	
		$num_rows1 = mysql_num_rows($result1);

		if($num_rows1 > 0)
		{
			$row1 = mysql_fetch_array($result1);
			$role1 = $row1['Role'];
			if($role1 == '0')
			{
				echo "<script type='text/javascript'>
					  alert('User is ADMIN. Cannot delete user who is Admin');".
					 "window.location = 'ListUsers.php';</script>";		
				exit;
			}
			else
			{
				$SQL2 = "DELETE FROM Personnel where Contact_Email='$who'";
				$result2 = mysql_query($SQL2);
				echo "<script type='text/javascript'>
					  window.location = 'ListUsers.php';</script>";		
				exit;			
			}
		}
	}
	else//if DB was not found
	{
		echo '<script type="text/javascript"> 
			  alert("Database is not found");
			  </script>';				  
	}	
	mysql_close($db_handle);	
}

//If "EDIT" button was pressed
if(isset($_POST['Edit']))
{
	$who = $_POST['UserEmail1'];
	setCookie('who', $who);//set cookie to pass use on the next page
	echo  "<script type='text/javascript'>
			window.location = 'EditProfile.php';</script>";
	exit;
}

//if "Promote" button was pressed
if(isset($_POST['Promote']))
{
	$who = $_POST['UserEmail2'];

//	//data to login into mysql server on multilab machine
//	$user_name = 'actorsgu_data';
//	$pass_word = 'cliffy36&winepress';
//	$database = 'actorsgu_data';
//	//$server = 'box293.bluehost.com:3306';
//	$server = 'localhost:3306';

	$db_handle = mysql_connect($server, $user_name, $pass_word);
	$db_found = mysql_select_db($database, $db_handle);

	if ($db_found) 
	{
		$SQL1 = "SELECT Role FROM Personnel WHERE Contact_Email='$who'";
		$result1 = mysql_query($SQL1);	
		$num_rows1 = mysql_num_rows($result1);	

		if($num_rows1 > 0)
		{
			$row1 = mysql_fetch_array($result1);
			$role1 = $row1['Role'];
			
			if($role1 == '0')
			{
			echo "<script type='text/javascript'>
				  alert('User is ADMIN. Cannot promote Admin to Director');".
				 "window.location = 'ListUsers.php';</script>";		
			exit;
			}
			
			if($role1 == '1')
			{
			echo "<script type='text/javascript'>
				  alert('User is already a DIRECTOR');".
				 "window.location = 'ListUsers.php';</script>";				
			exit;
			}
			else
			{
				$SQL2 = "UPDATE Personnel SET Role='1' WHERE Contact_Email='$who'";
				$result2 = mysql_query($SQL2);
				echo "<script type='text/javascript'>
					  window.location = 'ListUsers.php';</script>";		
				exit;			
			}
		}
	}
	else//if DB was not found
	{
		echo '<script type="text/javascript"> 
			  alert("Database is not found");
			  </script>';				  
	}	
	mysql_close($db_handle);
}

if(isset($_POST['Demote']))
{
    $who = $_POST['UserEmail3'];
	if($who == $email)
	{
		echo "<script type='text/javascript'>
			  alert('You cannot demote yourself');".
			 "window.location = 'ListUsers.php';</script>";		
		exit;			
	}
	//data to login into mysql server on multilab machine
//	$user_name = 'actorsgu_data';
//	$pass_word = 'cliffy36&winepress';
//	$database = 'actorsgu_data';
//	//$server = 'box293.bluehost.com:3306';
//	$server = 'localhost:3306';

	$db_handle = mysql_connect($server, $user_name, $pass_word);
	$db_found = mysql_select_db($database, $db_handle);

	if ($db_found) 
	{
		$SQL1 = "SELECT Role FROM Personnel WHERE Contact_Email='$who'";
		$result1 = mysql_query($SQL1);
		$num_rows1 = mysql_num_rows($result1);

		if($num_rows1 > 0)
		{
			$row1 = mysql_fetch_array($result1);	
			$role1 = $row1['Role'];
			
			if($role1 == '0')
			{
			echo "<script type='text/javascript'>
				  alert('User is ADMIN. Cannot demote Admin');".
				 "window.location = 'ListUsers.php';</script>";		
			exit;
			}
			
			if($role1 == '2')
			{
			echo "<script type='text/javascript'>
				  alert('User is already a regular user');".
				 "window.location = 'ListUsers.php';</script>";				
			exit;
			}
			else
			{
				$SQL2 = "UPDATE Personnel SET Role='2' WHERE Contact_Email='$who'";
				$result2 = mysql_query($SQL2);
				echo "<script type='text/javascript'>
					  window.location = 'ListUsers.php';</script>";		
				exit;			
			}
		}
	}
	else//if DB was not found
	{
		echo '<script type="text/javascript"> 
			  alert("Database is not found");
			  </script>';				  
	}	
	mysql_close($db_handle);	
} 



?>
<style type="text/css">
#apDiv1 {
	position: absolute;
	left: 652px;
	top: 258px;
	width: 630px;
	height: 551px;
	z-index: 1;
}
</style>
</head>
<body bgcolor="#000000" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<!-- Save for Web Slices (ListUsers.psd) -->
<div id="apDiv1" style="overflow: scroll; alignment-adjust: central;">
<?php
            include 'MasterCode.php';
        	if($role == 0 || $role == 1)//check, just in case, if user is a director or admin to execute following actions
			{
			     //Establish the initial connection:
				$db_handle = mysql_connect($server, $user_name, $pass_word);
				$db_found = mysql_select_db($database, $db_handle);
			
				if ($db_found) 
				{
					$SQL = 'SELECT First_Name, Last_Name, Contact_Email, Role FROM Personnel';
					$result = mysql_query($SQL);
					$num_rows = mysql_num_rows($result);
					
					//print out results if query returned result
					if($num_rows > 0)
					{
							echo "<body bgcolor='silver'>";
							echo "
							<table border='1' bordercolor='#ffffff' style='color: #ffffff;border:none;background-color:#transparent;' align='center' cellpadding='2' >
								<tr>
                                <th>Email</th>
								<th>Name</th>
								<th>Access Level</th>
                                <th>View</th>";
                                if($role == 0) //Only show the admin column if they are an admin
                                {
                                   echo "<th>Admin Options</th>
								    </tr>"; 
                                }
                                else{
                                    echo "</tr>";
                                }
								
								while($row = mysql_fetch_array($result))
								{
								    if ($row['Role'] == 0)
                                    {
                                        $StringRole = "Admin";
                                    }
                                    else if ($row['Role'] == 1)
                                    {
                                        $StringRole = "Director";
                                    }
                                    else 
                                    {
                                        $StringRole = "Actor"; 
                                    }
                                    
									$value = $row['Contact_Email'];
									echo "<tr><td>".$row['Contact_Email']."</td><td>".
                                                    $row['First_Name']." ".$row['Last_Name']."</td><td>".
													$StringRole."</td>";
                                    echo "<form action='ListUsers.php' method='post'>
                                            <td><input type='SUBMIT' name='View' value='View'/>
											<input type='HIDDEN' name='UserEmail0' value='" .$value. "'/></td>";
                                            
                                    if($role == 0) //If the user is an admin, show them the admin options
                                    {
										echo "<td>
												<select name='options' id='options'>
												    <option value='' selected></option>
  													<option value='deleteuser'>Delete User</option>
													  <option value='makeactor'>Make Actor</option>
													  <option value='makedirector'>Make Director</option>
													  <option value='makeadmin'>Make Admin</option>
													</select>";
                                        echo "<input type='SUBMIT' name='Admin_Options' value='submit'/>
										    <input type='HIDDEN' name='UserEmail1' value='" .$value. "'</td></td></form>";
                                    }
                                    else //Otherwise, we close the field
                                    {
                                        echo "</td></form>";
                                    }
                                            
									//echo "<form action='ListUsers.php' method='post'>
									//	 <td><input type='SUBMIT' name='Delete' value='Delete'/>
										//	 <input type='HIDDEN' name='UserEmail0' value='" .$value. "'/></td>
											
//											 <td><input type='SUBMIT' name='Edit' value='Edit'/>
//											 <input type='HIDDEN' name='UserEmail1' value='" .$value. "'/></td>
//											 
//											 <td><input type='SUBMIT' name='Promote' value='Promote to Director'/>
//											 <input type='HIDDEN' name='UserEmail2' value='" .$value. "'/></td>
//											 
//											 <td><input type='SUBMIT' name='Demote' value='Demote to User'/>
//											 <input type='HIDDEN' name='UserEmail3' value='" .$value. "'/></td></td></form>";	 						
								}
								echo "</table>";
								echo "<br>"."<br>";

					}


					else//if there is no specified user found in DB
					{							
						echo "<script type='text/javascript'>
							 alert('NO USERS FOUND');".
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
			}
		?>
</div>
<form name="form" method="post" action="ListUsers.php">
<table width="1400" height="968" border="0" align="center" cellpadding="0" cellspacing="0" id="Table_01">
	<tr>
		<td colspan="5">
			<img src="Assets/ListUsers_01.gif" width="1400" height="70" alt=""></td>
	</tr>
	<tr>
		<td colspan="3" rowspan="3">
			<img src="Assets/ListUsers_02.gif" width="1211" height="150" alt=""></td>
		<td>
			<input type="image" name="home" value="home" src="Assets/ListUsers_03.gif" id="home"></td>
		<td rowspan="3">
			<img src="Assets/ListUsers_04.gif" width="83" height="150" alt=""></td>
	</tr>
	<tr>
		<td>
			<input type="image" name="logout" value="logout" src="Assets/ListUsers_05.gif" id"logout"></td>
	</tr>
	<tr>
		<td>
			<img src="Assets/ListUsers_06.gif" width="106" height="83" alt=""></td>
	</tr>
	<tr>
		<td colspan="5">
			<img src="Assets/ListUsers_07.gif" width="1400" height="35" alt=""></td>
	</tr>
	<tr>
		<td rowspan="2">
			<img src="Assets/ListUsers_08.gif" width="384" height="712" alt=""></td>
		<td width="654" height="564" background="Assets/ListUsers_09.gif">&nbsp;
		
      </td>
		<td colspan="3" rowspan="2">
			<img src="Assets/ListUsers_10.gif" width="362" height="712" alt=""></td>
	</tr>
	<tr>
		<td>
			<img src="Assets/ListUsers_11.gif" width="654" height="148" alt=""></td>
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