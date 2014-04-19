<?php

include 'MasterCode.php';
if ($dbFound)
{
	echo "<h1>7</h1>";
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
		echo "<h1>20</h1>";
		if ($_FILES["file"]["error"] > 0)
		{
			echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
		}
		else
		{
			echo "<h1>27</h1>";
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
				echo "<h1>39</h1>";
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
					echo "<h1>51</h1>";
					move_uploaded_file($tmpFile, $fileName);
					//$email = $_POST('Contact_Email');
					$email = "joss@actors.com";
					$result1 = mysql_query($con,"UPDATE Personnel SET Picture = '" . $fileName . "' WHERE Contact_Email = '$email'");
					echo "<h1>56</h1>";
					if (!$result1)
						echo "<h1>Did not work</h1>";
				}
				echo "Stored in: " . $fileName;
				echo "<img src=/" . $fileName . " alt=''>";
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