<!--	This is the page that allows a user to upload a picture to their profile.
        It is reached from EditProfile.php and redirects back to EditProfile.php.
-->
<?php
include 'MasterCode.php';
$role = $_COOKIE['role'];
$email = $_COOKIE['email'];
$password = $_COOKIE['password'];

if(isset($_COOKIE['target_email'])&& ($_COOKIE['target_email'] != ''))
    {
        $lookupEmail = $_COOKIE['target_email'];
    }
    else
    {
        $lookupEmail = $_COOKIE['email'];
    }

//No unauthorized access
if(!isset($_COOKIE['email']) || !isset($_COOKIE['password']) || !isset($_COOKIE['role']))
{
	echo "<script type='text/javascript'>
			window.location = 'LogIn.php';</script>";//redirect back to Inventory page    
	exit;
}

$user_name = 'actorsgu_data';
$pass_word = 'cliffy36&winepress';
$database = 'actorsgu_data';
//$server = 'box293.bluehost.com:3306';
$server = 'localhost:3306';

$con = mysql_connect($server, $user_name, $pass_word, $database);
$db_handle = mysql_connect($server, $user_name, $pass_word);
$db_found = mysql_select_db($database, $db_handle);

if ($db_found) {
	$allowedExts = array("gif", "jpeg", "jpg", "png");
	$temp = explode(".", $_FILES["file"]["name"]);
	$extension = end($temp);
	if ((($_FILES["file"]["type"] == "image/gif")
	|| ($_FILES["file"]["type"] == "image/jpeg")
	|| ($_FILES["file"]["type"] == "image/jpg")
	|| ($_FILES["file"]["type"] == "image/pjpeg")
	|| ($_FILES["file"]["type"] == "image/x-png")
	|| ($_FILES["file"]["type"] == "image/png"))
	&& in_array($extension, $allowedExts))
	{
		if ($_FILES["file"]["size"] < 200000)
		{
			if ($_FILES["file"]["error"] > 0)
			{
				//echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
			}
			else
			{
				//echo "Upload: " . $_FILES["file"]["name"] . "<br>";
				//echo "Type: " . $_FILES["file"]["type"] . "<br>";
				//echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
				//echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br>";
				
				//GET Contact_Email and idPersonnel
				$SQL = "SELECT idPersonnel FROM Personnel WHERE Contact_Email='$lookupEmail'";
				$result = mysql_query($SQL);
				$db_field = mysql_fetch_array($result);
				$Contact_id = $db_field['idPersonnel'];

				if (file_exists("upload/" . $_FILES["file"]["name"] . $lookupEmail . $Contact_id))
				{
					echo $_FILES["file"]["name"] . " already exists. ";
				}
				else
				{
					$tmpFile = $_FILES["file"]["tmp_name"];
					$fileName = "upload/" . $_FILES["file"]["name"] . $lookupEmail . $Contact_id;
					
					list($oldWidth, $oldHeight) = getimagesize($tmpFile);
					$width = $oldWidth;
					$height = $oldHeight; // 650, 487
									
					if ($oldWidth >= 335 || $oldHeight >= 415) {
						if ($oldWidth > $oldHeight)
						{
							$width = 335;
							$height = $oldHeight * (415 / $oldWidth);
						}
						if ($oldWidth < $oldHeight)
						{
							$width = $oldWidth * (335 / $oldHeight);
							$height = 415;
						}
						if ($oldWidth == $oldHeight)
						{
							$width = 335;
							$height = 335;
						}
					
						$image = new Imagick($tmpFile);
						$image->thumbnailImage($width, $height);
						$image->writeImage($fileName);
					}
					else
					{
						move_uploaded_file($tmpFile, $fileName);
					}
					//echo "Stored in: " . $fileName;
					//echo "<img src=/" . $fileName . " alt=''>";
					
					$SQL = "UPDATE Personnel SET Picture = '$fileName' WHERE Contact_Email = '$lookupEmail'"; 
					$result = mysql_query($SQL);
					if (!$result)
						echo "<h1>Failed to store changes to database.</h1>";
					setcookie('target_email',$lookupEmail);
					echo "<script type='text/javascript'>
					window.location = 'EditProfile.php';</script>";//redirect back to Edit Profile page    
					exit;
				}
			}
		}
		else
		{
			echo "Uploaded image is too large. Image file size limit is ";
			echo "<script type='text/javascript'>
			window.location = 'browsepicture.php';</script>";//redirect back to browse picture page    
			exit;
		}
	}
	else
	{
		echo "Invalid file type.";
		echo "<script type='text/javascript'>
		window.location = 'browsepicture.php';</script>";//redirect back to browse picture page    
		exit;
	}
}
else 
{
	print "Database NOT Found ";
	mysql_close($db_handle);
}

?>