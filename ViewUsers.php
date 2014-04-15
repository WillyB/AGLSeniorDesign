<html>
<head>
<title>AGL: View Users</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<?php
$role = $_COOKIE['role'];
$email = $_COOKIE['email'];
$password = $_COOKIE['password'];

//redirect to ViewUsers.php when "HOME" button is clicked
if (isset($_POST['home'])) 
{
	echo "<script type='text/javascript'>
		  window.location = 'ViewUsers.php';</script>";
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
	
	echo "<script type='text/javascript'>
		  alert('Goodbye!');".
		 "window.location = 'LogIn.php';</script>";//redirect to login page
	exit;	
}

if(isset($_POST['Delete']))
{
	$who = $_POST['UserEmail0'];
	echo $who."<br>";

	if($who == $email)
	{
		echo "<script type='text/javascript'>
			  alert('You cannot delete your own profile');".
			 "window.location = 'ViewUsers.php';</script>";		
		exit;			
	}
	//data to login into mysql server on multilab machine
	$user_name = 'actorsgu_data';
	$pass_word = 'cliffy36&winepress';
	$database = 'actorsgu_data';
	$server = 'box293.bluehost.com:3306';
	//$server = 'localhost:3306';

	$db_handle = mysql_connect($server, $user_name, $pass_word);
	$db_found = mysql_select_db($database, $db_handle);

	if ($db_found) 
	{		
		$SQL1 = "SELECT Role FROM Personnel WHERE Contact_Email='$who'";
		echo "SQL=".$SQL1."<br>";
		$result1 = mysql_query($SQL1);	
		echo "result1=".$result1;
		$num_rows1 = mysql_num_rows($result1);

		if($num_rows1 > 0)
		{
			$row1 = mysql_fetch_array($result1);
			$role1 = $row1['Role'];
			echo $role1;
			if($role1 == '0')
			{
				echo "<script type='text/javascript'>
					  alert('User is ADMIN. Cannot delete user who is Admin');".
					 "window.location = 'ViewUsers.php';</script>";		
				exit;
			}
			else
			{
				$SQL2 = "DELETE FROM Personnel where Contact_Email='$who'";
				$result2 = mysql_query($SQL2);
				echo "<script type='text/javascript'>
					  window.location = 'ViewUsers.php';</script>";		
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

	//data to login into mysql server on multilab machine
	$user_name = 'actorsgu_data';
	$pass_word = 'cliffy36&winepress';
	$database = 'actorsgu_data';
	$server = 'box293.bluehost.com:3306';
	//$server = 'localhost:3306';

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
				 "window.location = 'ViewUsers.php';</script>";		
			exit;
			}
			
			if($role1 == '1')
			{
			echo "<script type='text/javascript'>
				  alert('User is already a DIRECTOR');".
				 "window.location = 'ViewUsers.php';</script>";				
			exit;
			}
			else
			{
				$SQL2 = "UPDATE Personnel SET Role='1' WHERE Contact_Email='$who'";
				$result2 = mysql_query($SQL2);
				echo "<script type='text/javascript'>
					  window.location = 'ViewUsers.php';</script>";		
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
			 "window.location = 'ViewUsers.php';</script>";		
		exit;			
	}
	//data to login into mysql server on multilab machine
	$user_name = 'actorsgu_data';
	$pass_word = 'cliffy36&winepress';
	$database = 'actorsgu_data';
	$server = 'box293.bluehost.com:3306';
	//$server = 'localhost:3306';

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
				 "window.location = 'ViewUsers.php';</script>";		
			exit;
			}
			
			if($role1 == '2')
			{
			echo "<script type='text/javascript'>
				  alert('User is already a regular user');".
				 "window.location = 'ViewUsers.php';</script>";				
			exit;
			}
			else
			{
				$SQL2 = "UPDATE Personnel SET Role='2' WHERE Contact_Email='$who'";
				$result2 = mysql_query($SQL2);
				echo "<script type='text/javascript'>
					  window.location = 'ViewUsers.php';</script>";		
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

if($role == 0 || $role == 1)//check, just in case, if user is a director or admin to execute following actions
{
	//data to login into mysql server on multilab machine
	$user_name = 'actorsgu_data';
	$pass_word = 'cliffy36&winepress';
	$database = 'actorsgu_data';
	$server = 'box293.bluehost.com:3306';
	//$server = 'localhost:3306';

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
				echo "<h2>All Users:</h2>";
				echo "
				<table border='1'>
					<tr>
					<th>first name</th>
					<th>last name</th>
					<th>email</th>
					<th>role</th>
					<th>Delete</th>
					<th>Edit</th>
					<th>Promote</th>
					<th>Demote</th>
					</tr>";
					while($row = mysql_fetch_array($result))
					{
						$value = $row['Contact_Email'];
						echo "<tr><td>".$row['First_Name']."</td><td>".
										$row['Last_Name']."</td><td>".
										$row['Contact_Email']."</td><td>".
										$row['Role']."</td>";
						echo "<form action='ViewUsers.php' method='post'>
							 <td><input type='SUBMIT' name='Delete' value='Delete'/>
							     <input type='HIDDEN' name='UserEmail0' value='" .$value. "'/></td>
								 
								 <td><input type='SUBMIT' name='Edit' value='Edit'/>
								 <input type='HIDDEN' name='UserEmail1' value='" .$value. "'/></td>
								 
								 <td><input type='SUBMIT' name='Promote' value='Promote to Director'/>
								 <input type='HIDDEN' name='UserEmail2' value='" .$value. "'/></td>
								 
								 <td><input type='SUBMIT' name='Demote' value='Demote to User'/>
								 <input type='HIDDEN' name='UserEmail3' value='" .$value. "'/></td></td></form>";	 						
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

</head>
<body bgcolor="#00000" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<!-- Save for Web Slices (ViewUsers.psd) -->
<form name="form" method="post" action="ViewUsers.php">
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
		<td><input type="image" name="home" value="home" src="Assets/ViewUsers_03.gif"></td>
		<td rowspan="5">
			<img src="Assets/ViewUsers_04.gif" width="83" height="897" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="35" alt=""></td>
	</tr>
	<tr>
		<td><input type="image" name="logout" value="logout" src="Assets/ViewUsers_05.gif"></td>
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
		<td width="654" height="564" background="Assets/ViewUsers_08.gif">&nbsp;
        <label for="users"></label>
	    <textarea name="users" id="users" cols="76" rows="33" style="color: #FFFFFF;border:none;background-color:transparent;"></textarea>
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
</form>
<!-- End Save for Web Slices -->
</body>
</html>