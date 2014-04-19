<?php

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
	&& ($_FILES["file"]["size"] < 200000)
	&& in_array($extension, $allowedExts))
	{
		if ($_FILES["file"]["error"] > 0)
		{
			echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
		}
		else
		{
			echo "Upload: " . $_FILES["file"]["name"] . "<br>";
			echo "Type: " . $_FILES["file"]["type"] . "<br>";
			echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
			echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br>";

			if (file_exists("upload/" . $_FILES["file"]["name"]))
			{
				echo $_FILES["file"]["name"] . " already exists. ";
			}
			else
			{
				$tmpFile = $_FILES["file"]["tmp_name"];
				$fileName = "upload/" . $_FILES["file"]["name"];
				list($width, $height) = getimagesize($tmpFile);
				
				if ($width >= 100 && $height >= 100) {
					$image = new Imagick($tmpFile);
					$image->thumbnailImage(100, 100);
					$image->writeImage($fileName);
				}
				else
				{
					move_uploaded_file($tmpFile, $fileName);
				}
				echo "Stored in: " . $fileName;
				echo "<img src=/" . $fileName . " alt=''>";
				
				//$email = $_POST('Contact_Email');
					$email = "joss@actors.com";
					//$result = mysql_query($con,"UPDATE Personnel SET Picture = '$fileName' WHERE Contact_Email = '$email'");
					//if (!$result)
					//	echo "<h1>Did not work</h1>";
					$SQL = "UPDATE Personnel SET Picture = '$fileName' WHERE Contact_Email = '$email'"; 
					$result = mysql_query($SQL);
					if (!$result)
						echo "<h1>fail</h1>";
			}
		}
	}
	else
	{
		echo "Invalid file";
	}
}
else 
{
	print "Database NOT Found ";
	mysql_close($db_handle);
}

?>