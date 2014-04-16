<html>
<head>
<title>AGL: Search Database</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<?php
//redirect to AdminTools.php when "HOME" button is clicked
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

	echo "<script type='text/javascript'>
		  alert('Goodbye!');".
		 "window.location = 'LogIn.php';</script>";//redirect to login page
	exit;	
}

?>

</head>
<body bgcolor="#00000" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<!-- Save for Web Slices (SearchDB_Layout.psd) -->
<form name="form" method="post" action="SearchDB.php">
<table width="1401" height="1048" border="0" align="center" cellpadding="0" cellspacing="0" id="Table_01">
	<tr>
		<td colspan="21">
			<img src="Assets/SearchDB_01.gif" width="1400" height="70" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="70" alt=""></td>
	</tr>
	<tr>
		<td colspan="18" rowspan="3">
			<img src="Assets/SearchDB_02.gif" width="1211" height="238" alt=""></td>
		<td>
			<input type="image" name="home" value="home" src="Assets/SearchDB_03.gif"></td>
		<td colspan="2" rowspan="13">
			<img src="Assets/SearchDB_04.gif" width="83" height="628" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="35" alt=""></td>
	</tr>
	<tr>
		<td>
			<img src="Assets/SearchDB_05.gif" width="106" height="32" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="32" alt=""></td>
	</tr>
	<tr>
		<td rowspan="11">
			<img src="Assets/SearchDB_06.gif" width="106" height="561" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="171" alt=""></td>
	</tr>
	<tr>
		<td colspan="5" rowspan="2">
			<img src="Assets/SearchDB_07.gif" width="580" height="56" alt=""></td>
		<td width="207" height="43" colspan="7" background="Assets/SearchDB_08.gif">&nbsp;
        <input type="text" name="firstname" id="firstname" style="color: #FFFFFF;border:none;background-color:transparent;" size="26">
        </td>
		<td width="248" height="43" colspan="5" background="Assets/SearchDB_09.gif">&nbsp;
        <input type="text" name="lastname" id="lastname" style="color: #FFFFFF;border:none;background-color:transparent;" size="30">
        </td>
		<td rowspan="10">
			<img src="Assets/SearchDB_10.gif" width="176" height="390" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="43" alt=""></td>
	</tr>
	<tr>
		<td colspan="12">
			<img src="Assets/SearchDB_11.gif" width="455" height="13" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="13" alt=""></td>
	</tr>
	<tr>
		<td colspan="2" rowspan="8">
			<img src="Assets/SearchDB_12.gif" width="449" height="334" alt=""></td>
		<td width="71" height="43" colspan="2" background="Assets/SearchDB_13.gif">&nbsp;
        <label for="heightf"></label>
        <select name="heightf" id="heightf">
          <option value="" selected> </option>
          <option value="4.00">4'0&quot;</option>
          <option value="4.01">4'1&quot;</option>
          <option value="4.02">4'2&quot;</option>
          <option value="4.03">4'3&quot;</option>
          <option value="4.04">4'4&quot;</option>
          <option value="4.05">4'5&quot;</option>
          <option value="4.06">4'6&quot;</option>
          <option value="4.07">4'7&quot;</option>
          <option value="4.08">4'8&quot;</option>
          <option value="4.09">4'9&quot;</option>
          <option value="4.10">4'10&quot;</option>
          <option value="4.11">4'11&quot;</option>
          <option value="5.00">5'0&quot;</option>
          <option value="5.01">5'1&quot;</option>
          <option value="5.02">5'2&quot;</option>
          <option value="5.03">5'3&quot;</option>
          <option value="5.04">5'4&quot;</option>
          <option value="5.05">5'5&quot;</option>
          <option value="5.06">5'6&quot;</option>
          <option value="5.07">5'7&quot;</option>
          <option value="5.08">5'8&quot;</option>
          <option value="5.09">5'9&quot;</option>
          <option value="5.10">5'10&quot;</option>
          <option value="5.11">5'11&quot;</option>
          <option value="6.00">6'0&quot;</option>
          <option value="6.01">6'1&quot;</option>
          <option value="6.02">6'2&quot;</option>
          <option value="6.03">6'3&quot;</option>

          <option value="6.04">6'4&quot;</option>
          <option value="6.05">6'5&quot;</option>
          <option value="6.06">6'6&quot;</option>
          <option value="6.07">6'7&quot;</option>
          <option value="6.08">6'8&quot;</option>
          <option value="6.09">6'9&quot;</option>
          <option value="6.10">6'10&quot;</option>
          <option value="6.11">6'11&quot;</option>
          <option value="7.00">7'0&quot;</option>
        </select>
        </td>
		<td width="72" height="43" colspan="2" background="Assets/SearchDB_14.gif">&nbsp;
        <label for="heightt"></label>
        <select name="heightt" id="heightt">
          <option value="" selected> </option>
          <option value="4.00">4'0&quot;</option>
          <option value="4.01">4'1&quot;</option>
          <option value="4.02">4'2&quot;</option>
          <option value="4.03">4'3&quot;</option>
          <option value="4.04">4'4&quot;</option>
          <option value="4.05">4'5&quot;</option>
          <option value="4.06">4'6&quot;</option>
          <option value="4.07">4'7&quot;</option>
          <option value="4.08">4'8&quot;</option>
          <option value="4.09">4'9&quot;</option>
          <option value="4.10">4'10&quot;</option>
          <option value="4.11">4'11&quot;</option>
          <option value="5.00">5'0&quot;</option>
          <option value="5.01">5'1&quot;</option>
          <option value="5.02">5'2&quot;</option>
          <option value="5.03">5'3&quot;</option>
          <option value="5.04">5'4&quot;</option>
          <option value="5.05">5'5&quot;</option>
          <option value="5.06">5'6&quot;</option>
          <option value="5.07">5'7&quot;</option>
          <option value="5.08">5'8&quot;</option>
          <option value="5.09">5'9&quot;</option>
          <option value="5.10">5'10&quot;</option>
          <option value="5.11">5'11&quot;</option>
          <option value="6.00">6'0&quot;</option>
          <option value="6.01">6'1&quot;</option>
          <option value="6.02">6'2&quot;</option>
          <option value="6.03">6'3&quot;</option>
          <option value="6.04">6'4&quot;</option>
          <option value="6.05">6'5&quot;</option>
          <option value="6.06">6'6&quot;</option>
          <option value="6.07">6'7&quot;</option>
          <option value="6.08">6'8&quot;</option>
          <option value="6.09">6'9&quot;</option>
          <option value="6.10">6'10&quot;</option>
          <option value="6.11">6'11&quot;</option>
          <option value="7.00">7'0&quot;</option>
        </select>
        </td>
		<td colspan="2" rowspan="4">
			<img src="Assets/SearchDB_15.gif" width="74" height="110" alt=""></td>
		<td width="75" height="43" colspan="2" background="Assets/SearchDB_16.gif">&nbsp;
        <input type="text" name="weightf" id="weightf" size="4" style="color: #FFFFFF;border:none;background-color:transparent;">
        </td>
		<td width="72" height="43" colspan="3" background="Assets/SearchDB_17.gif">&nbsp;
        <input type="text" name="weightt" id="weightt" size="4" style="color: #FFFFFF;border:none;background-color:transparent;">
        </td>
		<td colspan="2" rowspan="4">
			<img src="Assets/SearchDB_18.gif" width="76" height="110" alt=""></td>
		<td width="70" height="43" background="Assets/SearchDB_19.gif">&nbsp;
        <input type="text" name="agef" id="agef" size="4" style="color: #FFFFFF;border:none;background-color:transparent;">
        </td>
		<td width="76" height="43" background="Assets/SearchDB_20.gif">&nbsp;
        <input type="text" name="aget" id="aget" size="4" style="color: #FFFFFF;border:none;background-color:transparent;">
        </td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="43" alt=""></td>
	</tr>
	<tr>
		<td colspan="4">
			<img src="Assets/SearchDB_21.gif" width="143" height="12" alt=""></td>
		<td colspan="5">
			<img src="Assets/SearchDB_22.gif" width="147" height="12" alt=""></td>
		<td colspan="2">
			<img src="Assets/SearchDB_23.gif" width="146" height="12" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="12" alt=""></td>
	</tr>
	<tr>
		<td width="143" height="42" colspan="4" background="Assets/SearchDB_24.gif">&nbsp;
        <label for="haircolor"></label>
        <select name="haircolor" id="haircolor">
          <option selected> </option>
          <option id="blonde">Blonde</option>
          <option id="brown">Brown</option>
          <option id="red">Red</option>
          <option id="black">Black</option>
          <option id="gray">Gray</option>
          <option id="other">Other</option>
        </select>
        </td>
		<td width="147" height="42" colspan="5" background="Assets/SearchDB_25.gif">&nbsp;
        <label for="hairstyle"></label>
        <select name="hairstyle" id="hairstyle">
          <option selected> </option>
          <option id="long">Long</option>
          <option id="short">Short</option>
          <option id="buzz">Buzz</option>
          <option id="blad">Bald</option>
          <option id="other">Other</option>
        </select>
        </td>
		<td width="146" height="42" colspan="2" background="Assets/SearchDB_26.gif">&nbsp;
        <label for="eyecolor"></label>
		  <select name="eyecolor" id="eyecolor">
		    <option selected> </option>
		    <option id="blue">Blue</option>
		    <option id="brown">Brown</option>
		    <option id="green">Green</option>
		    <option id="gray">Gray</option>
		    <option id="other">Other</option>
        </select>
        </td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="42" alt=""></td>
	</tr>
	<tr>
		<td colspan="4">
			<img src="Assets/SearchDB_27.gif" width="143" height="13" alt=""></td>
		<td colspan="5">
			<img src="Assets/SearchDB_28.gif" width="147" height="13" alt=""></td>
		<td colspan="2">
			<img src="Assets/SearchDB_29.gif" width="146" height="13" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="13" alt=""></td>
	</tr>
	<tr>
		<td rowspan="4">
			<img src="Assets/SearchDB_30.gif" width="39" height="224" alt=""></td>
		<td width="232" height="42" colspan="6" background="Assets/SearchDB_31.gif">&nbsp;
        <label for="ethnicity"></label>
		  <select name="ethnicity" id="ethnicity">
		    <option selected> </option>
		    <option id="hispanic">Hispanic/Latino</option>
		    <option id="african american">African American</option>
		    <option id="asian">Asian</option>
		    <option id="oceania">Native Hawaiian/Pacific Islander</option>
		    <option id="american indian">American Indian</option>
		    <option id="alaskan native">Alaskan Native</option>
		    <option id="caucasian">Caucasian</option>
		    <option id="middle eastern">Middle Eastern</option>
		    <option id="other">Other</option>
        </select>
        </td>
		<td colspan="5" rowspan="2">
			<img src="Assets/SearchDB_32.gif" width="101" height="62" alt=""></td>
		<td width="214" height="42" colspan="3" background="Assets/SearchDB_33.gif">&nbsp;
        <label for="gender"></label>
		  <select name="gender" id="gender">
		    <option> </option>
		    <option id="male">Male</option>
		    <option id="female">Female</option>
        </select>
        </td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="42" alt=""></td>
	</tr>
	<tr>
		<td colspan="6">
			<img src="Assets/SearchDB_34.gif" width="232" height="20" alt=""></td>
		<td colspan="3" rowspan="3">
			<img src="Assets/SearchDB_35.gif" width="214" height="182" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="20" alt=""></td>
	</tr>
	<tr>
		<td colspan="4" rowspan="2">
			<img src="Assets/SearchDB_36.gif" width="164" height="162" alt=""></td>
		<td colspan="4">
			<input type="image" name="Search" value="Search" src="Assets/SearchDB_37.gif" width="119" height="42" alt=""></td>
		<td colspan="3" rowspan="2">
			<img src="Assets/SearchDB_38.gif" width="50" height="162" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="42" alt=""></td>
	</tr>
	<tr>
		<td colspan="4">
			<img src="Assets/SearchDB_39.gif" width="119" height="120" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="120" alt=""></td>
	</tr>
	<tr>
		<td colspan="21">
			<img src="Assets/SearchDB_40.gif" width="1400" height="35" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="35" alt=""></td>
	</tr>
	<tr>
		<td rowspan="2">
			<img src="Assets/SearchDB_41.gif" width="74" height="314" alt=""></td>
		<td width="1267" height="233" colspan="19" background="Assets/SearchDB_42.gif">&nbsp;
        <?php
if (isset($_POST['Search'])) 
{
	$firstname = $_POST['firstname'];
	$lastname = $_POST['lastname'];
	$heightf = $_POST['heightf'];
	$heightt = $_POST['heightt'];
	$weightf = $_POST['weightf'];
	$weightt = $_POST['weightt'];
	$agef = $_POST['agef'];
	$aget = $_POST['aget'];
	$haircolor = $_POST['haircolor'];
	$hairstyle = $_POST['hairstyle'];
	$eyecolor = $_POST['eyecolor'];
	$ethnicity = $_POST['ethnicity'];
	$gender = $_POST['gender'];

	if($firstname == "" && $lastname == "" && $heightf == "" && $heightt == "" && 
       $weightf == "" && $weightt == "" && $agef == "" && $aget == "" &&	
	   $haircolor == "" && $hairstyle == "" && $eyecolor == "" && $ethnicity == "" &&
	   $gender == "")
	{
		//user has to choose at least one parameter of the search
		echo "<script type='text/javascript'>
			 alert('Please, select at least one parameter for the search');".
			 "window.location = 'SearchDB.php';</script>";//redirect back to search page
		exit;//exit, so that the following code is not executed
	}
	else
	{
		//data to login into mysql server on multilab machine
		$user_name = 'actorsgu_data';
		$pass_word = 'cliffy36&winepress';
		$database = 'actorsgu_data';
		//$server = 'box293.bluehost.com:3306';
		$server = 'localhost:3306';

		$db_handle = mysql_connect($server, $user_name, $pass_word);
		$db_found = mysql_select_db($database, $db_handle);

		if ($db_found) 
		{
			//this function is used to escape any dangerous strings (SQL injections)
			$firstname = mysql_real_escape_string($firstname, $db_handle);
			$lastname = mysql_real_escape_string($lastname, $db_handle);
			$heightf = mysql_real_escape_string($heightf, $db_handle); 
			$heightt = mysql_real_escape_string($heightt, $db_handle); 
			$weightf = mysql_real_escape_string($weightf, $db_handle); 
			$weightt = mysql_real_escape_string($weightt, $db_handle); 
			$agef = mysql_real_escape_string($agef, $db_handle); 
			$aget = mysql_real_escape_string($aget, $db_handle); 
			$haircolor = mysql_real_escape_string($haircolor, $db_handle); 
			$hairstyle = mysql_real_escape_string($hairstyle, $db_handle); 
			$eyecolor = mysql_real_escape_string($eyecolor, $db_handle); 
			$ethnicity = mysql_real_escape_string($ethnicity, $db_handle); 
			$gender = mysql_real_escape_string($gender, $db_handle); 	

			//construct the query usign user specified parameters
			$query = 'SELECT * FROM Personnel WHERE ';
			if($firstname!="")
				{
					$query.= 'First_Name="'.$firstname.'" AND ';
				}    
			if($lastname!="")
			{       
					$query.= 'Last_Name="'.$lastname.'" AND ';
			}
			if($haircolor!="")
			{       
					$query.= 'Hair_Color="'.$haircolor.'" AND ';
			}		 
			if($hairstyle!="")
			{       
					$query.= 'Hair_Style="'.$hairstyle.'" AND ';
			}		 
			if($eyecolor!="")
			{       
					$query.= 'Eye_Color="'.$eyecolor.'" AND ';
			}		 
			if($ethnicity!="")
			{       
					$query.= 'Ethnicity="'.$ethnicity.'" AND ';
			}		 
			if($gender!="")
			{       
					$query.= 'Gender="'.$gender.'" AND ';
			}		 
			if($heightf !="" && $heightt !="")
			{       
					$query.= 'Height >=' .$heightf. ' AND Height <=' .$heightt. ' AND ';
			}		 
			if($weightf !="" && $weightt !="")
			{       
					$query.= 'Weight >=' .$weightf. ' AND Weight <=' .$weightt. ' AND ';
			}	
			if($agef !="" && $aget !="")
			{       
					$query.= 'Age >=' .$agef. ' AND Age <=' .$aget. ' AND ';
			}	

			$result = substr($query,0,-5);
			$result.=';';

			//echo $result;

			//query the DB with received attributes
			$final = mysql_query($result);
			$num_rows = mysql_num_rows($final);

			//print out results if query returned result
			if($num_rows > 0)
			{
				echo "<body bgcolor='silver'>";
				echo "<h2 style='color: #ffffff;' align='center'>Search Results:</h2>";
				echo "
				<table border='1' bordercolor='#ffffff' style='color: #ffffff;border:none;background-color:#transparent;' align='center' cellpadding='20' >
					<tr>
					<th>first name</th>
					<th>last name</th>
					<th>email</th>
					<th>phone</th>
					<th>height</th>
					<th>weight</th>
					<th>age</th>
					</tr>";
					while($row = mysql_fetch_array($final))
					{
						echo "<tr><td>".$row['First_Name']."</td><td>".
										$row['Last_Name']."</td><td>".
										$row['Contact_Email']."</td><td>".
										$row['Contact_Phone']."</td><td>".
										$row['Height']."</td><td>".
										$row['Weight']."</td><td>".
										$row['Age']."</td></tr>";
					}
				echo "</table>";
				echo "<br>"."<br>";

			}
			else//if there is no specified user found in DB
			{							
				echo "<script type='text/javascript'>
					 alert('NO ACTOR FOUND. Try choosing different search criteria');".
					 "window.location = 'SearchDB.php';</script>";//redirect back to SearchDB.php page 
				exit;			
			}
		}//end of if DB was found
		else//if DB was not found
		{
			echo '<script type="text/javascript"> 
				  alert("Database is not found");
				  </script>';				  
		}	
		mysql_close($db_handle);
	}//end of if at least one search parameter was received
}//end of if search button was clicked	
		?>
        </td>
		<td rowspan="2">
			<img src="Assets/SearchDB_43.gif" width="59" height="314" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="233" alt=""></td>
	</tr>
	<tr>
		<td colspan="19">
			<img src="Assets/SearchDB_44.gif" width="1267" height="81" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="1" height="81" alt=""></td>
	</tr>
	<tr>
		<td>
			<img src="Assets/spacer.gif" width="74" height="1" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="375" height="1" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="39" height="1" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="32" height="1" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="60" height="1" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="12" height="1" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="60" height="1" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="14" height="1" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="54" height="1" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="21" height="1" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="30" height="1" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="16" height="1" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="26" height="1" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="8" height="1" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="68" height="1" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="70" height="1" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="76" height="1" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="176" height="1" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="106" height="1" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="24" height="1" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="59" height="1" alt=""></td>
		<td></td>
	</tr>
</table>
</form>
<!-- End Save for Web Slices -->
</body>
</html>
