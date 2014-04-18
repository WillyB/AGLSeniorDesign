<?php
$allowedExts = array("gif", "jpeg", "jpg", "png");
$temp = explode(".", $_FILES["file"]["name"]);
$extension = end($temp);
if ((($_FILES["file"]["type"] == "image/gif")
|| ($_FILES["file"]["type"] == "image/jpeg")
|| ($_FILES["file"]["type"] == "image/jpg")
|| ($_FILES["file"]["type"] == "image/pjpeg")
|| ($_FILES["file"]["type"] == "image/x-png")
|| ($_FILES["file"]["type"] == "image/png"))
&& ($_FILES["file"]["size"] < 20000)
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
				echo "<h1>bigger than 400x400</h1>";
				$image = new Imagick($tmpFile);
				$image->thumbnailImage(100, 100);
				$image->writeImage($fileName);
			}
			
			move_uploaded_file($tmpFile, $fileName);
			echo "Stored in: " . $fileName;
			echo "<img src=/" . $fileName . "alt="">";  
		}
	}
}
else
{
	echo "Invalid file";
}
?>