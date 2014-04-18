<?php
// max file size (Kb)
define ("MAX_SIZE","100"); 
 
// read file extension
function getExtension($str) {
         $i = strrpos($str,".");
         if (!$i) { return ""; }
         $l = strlen($str) - $i;
         $ext = substr($str,$i+1,$l);
         return $ext;
 }
 
// error flag
$errors=0;
echo "<h1> v8 test </h1>";

$user_name = 'actorsgu_data';
$pass_word = 'cliffy36&winepress';
$database = 'actorsgu_data';
$server ='localhost:3306';

$con = mysql_connect($server, $user_name, $pass_word, $database);
$db_handle = mysql_connect($server, $user_name, $pass_word);
$db_found = mysql_select_db($database, $db_handle);

if ($db_found) 
{
	// check if the form has been submitted
	if(isset($_POST['Submit'])) 
	{
		//reads the name of the file the user submitted for uploading
		$image = $_FILES['image']['name'];
		
		//if it is not empty
		if ($image) 
		{
			// get the original name of the file from the clients machine
			$filename = stripslashes($_FILES['image']['name']);
			
			// get file extension (lower case)
			$extension = getExtension($filename);
			$extension = strtolower($extension);
			
			// ensure known file extension
			if (($extension != "jpg") && ($extension != "jpeg") && ($extension != "png") && ($extension != "gif")) 
				{
					//print error message
					echo '<h1>Unknown extension!</h1>';
					$errors = 1;
				}
			else
			{
				//get the size of the image in bytes
				//$_FILES['image']['tmp_name'] is the temporary filename of the file
				//in which the uploaded file was stored on the server
				$size = filesize($_FILES['image']['tmp_name']);
				echo $_FILES['image']['tmp_name'];
				//compare the size with the maxim size we defined and print error if bigger
				if ($size > MAX_SIZE*1024)
				{
					echo '<h1>You have exceeded the size limit!</h1>';
					$errors = 1;
				}
				else
				{
					//the new name will be containing the full path where will be stored (images folder)
					$temp = resizeImage($_FILES['image']['tmp_name'],200,200);
					$imgfile = "images/".$image;
		 
					//$email = $_POST('Contact_Email');
					imagejpeg ( $temp, $imgfile );
					//$result = "UPDATE Personnel SET Picture = '$imgfile' WHERE Contact_Email = '$email'";
				}
			}
		}
		else
		{
			echo "<h1>Select Image File</h1>";
			$errors=1;
		}
	}
	 
	//If no errors registered, print the success message
	if(isset($_POST['Submit']))
	{
		if (!$errors) 
		{
			echo "<h1>File Uploaded Successfully!</h1>";
		}
	}	 
}

function resizeImage($imgSrc,$thumbnail_width,$thumbnail_height) { //$imgSrc is a FILE - Returns an image resource.
    //getting the image dimensions  
    list($width_orig, $height_orig) = getimagesize($imgSrc);   
    $myImage = imagecreatefromjpeg($imgSrc);
    $ratio_orig = $width_orig/$height_orig;
     
    if ($thumbnail_width/$thumbnail_height > $ratio_orig) {
       $new_height = $thumbnail_width/$ratio_orig;
       $new_width = $thumbnail_width;
    } else {
       $new_width = $thumbnail_height*$ratio_orig;
       $new_height = $thumbnail_height;
    }
     
    $x_mid = $new_width/2;  //horizontal middle
    $y_mid = $new_height/2; //vertical middle
     
    $process = imagecreatetruecolor(round($new_width), round($new_height)); 
     
    imagecopyresampled($process, $myImage, 0, 0, 0, 0, $new_width, $new_height, $width_orig, $height_orig);
    $thumb = imagecreatetruecolor($thumbnail_width, $thumbnail_height); 
    imagecopyresampled($thumb, $process, 0, 0, ($x_mid-($thumbnail_width/2)), ($y_mid-($thumbnail_height/2)), $thumbnail_width, $thumbnail_height, $thumbnail_width, $thumbnail_height);
 
    imagedestroy($process);
    imagedestroy($myImage);
    return $thumb;
}
 ?>
 
 <!--next comes the form, you must set the enctype to "multipart/frm-data" and use an input type "file" -->
 <form name="newad" method="post" enctype="multipart/form-data"  action="">
 <table>
    <tr><td><input type="file" name="image"></td></tr>
    <tr><td><input name="Submit" type="submit" value="Upload image"></td></tr>
 </table> 
 </form>