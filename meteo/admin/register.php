<?php session_start();
include("config.php");

if(isset($_POST['signup']))
{
	$userName = secure($_POST['usernamesignup'],$mysqli);
	$email = secure($_POST['emailsignup'],$mysqli);
	$pass = secure($_POST['passwordsignup'],$mysqli);
	
	$q = "INSERT INTO tbl_members(userName,emailID,pass) VALUES('$userName','$email','$pass')";
	if($mysqli->query($q))
	{
		
		if ($_FILES['photo']['tmp_name']!='')
				{
				
					$target_dir = "profilepic/";
					$target_file = $target_dir . $userName . '.jpg';
					$uploadOk = 1;
					$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
					// Check if image file is a actual image or fake image
					$check = getimagesize($_FILES["photo"]["tmp_name"]);
					if($check !== false) {
						//echo "File is an image - " . $check["mime"] . ".";
						$uploadOk = 1;
					} else {
						echo "<script>alert('Only Image Files are allowed');</script>";
						$uploadOk = 0;
					}
							
					// Allow certain file formats
					if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
					&& $imageFileType != "gif" ) {
						echo "<script>alert('Only Image Files are allowed');</script>";
						$uploadOk = 0;
					}
					
					// Check if $uploadOk is set to 0 by an error
					if ($uploadOk == 0) {
						echo "<script>alert('Sorry file was not uploaded');</script>";
					// if everything is ok, try to upload file
					} else {
						if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
							// upload success
						} else {
							echo "<script>alert('There was a problem in uploading file');</script>";
						}
					}
				}
		
		
		
		$_SESSION['userName'] = $userName;
		header("Location:welcome.php");
		exit;
	}
	else
	{
		echo'<script>alert("Some Error Occured");</script>';
		header("Location:index.php");
		exit;
	}
}
?>