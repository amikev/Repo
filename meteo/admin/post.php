<?php
include("functions.php");
include("header.php");

$time = time();
$inserttime = $time + $timezone;


function uploadAvatar($link, $userName){
	
	if ($_FILES['photo']['tmp_name']!=''){
			
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
			echo '<script type="text/javascript">alert("Only images are allowed!"); window.location = "'.$link.'";</script>';
			$uploadOk = 0;
		}
				
		// Allow certain file formats
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
		&& $imageFileType != "gif" ) {
			echo '<script type="text/javascript">alert("Only images are allowed!"); window.location = "'.$link.'";</script>';
			$uploadOk = 0;
		}
		
		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {
			echo '<script type="text/javascript">alert("Sorry file was not uploaded"); window.location = "'.$link.'";</script>';
		// if everything is ok, try to upload file
		} else {
			if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
				// upload success
			} else {
				echo '<script type="text/javascript">alert("There was a problem in uploading file"); window.location = "'.$link.'";</script>';
			}
		}
	}
	
}



if(isset($_POST["submit"])){

	if(is_numeric($_POST["menu_number"])){

		$sql = "INSERT INTO headermenu (isActive, timestamp, menuLink, menuNumber, menuText) VALUES ('".$_POST["menu_active"]."','".$inserttime."','".$_POST["menu_link"]."','".$_POST["menu_number"]."','".$_POST["menu_name"]."')";
		mysqli_query($conn, $sql) or die(mysqli_error($conn));
		echo '<script type="text/javascript">window.location = "menu.php"</script>';		
	}


}else if(isset($_POST["submit_edit"])){
	
	if(is_numeric($_POST["menu_number"])){
		$sql = "UPDATE headermenu SET isActive='".$_POST["menu_active"]."', timestamp='".$inserttime."', menuLink='".$_POST["menu_link"]."', menuNumber='".$_POST["menu_number"]."', menuText='".$_POST["menu_name"]."' WHERE ID='".$_POST["ID"]."'";
		mysqli_query($conn, $sql) or die(mysqli_error($conn));
		echo '<script type="text/javascript">window.location = "menu.php"</script>';
	}
		
}else if(isset($_POST["submit_page_add"])){

	$sql = "INSERT INTO pagecontent (isActive, timestamp, pageLink, pageLabel, pageText) VALUES ('".$_POST["page_active"]."','".$inserttime."','".$_POST["page_link"]."','".$_POST["page_label"]."','".$_POST["page_text"]."')";
	mysqli_query($conn, $sql) or die(mysqli_error($conn));
	echo '<script type="text/javascript">window.location = "page.php"</script>';		
	
}else if(isset($_POST["submit_edit_page"])){
	
	$sql = "UPDATE pagecontent SET isActive='".$_POST["page_active"]."', timestamp='".$inserttime."', pageLink='".$_POST["page_link"]."', pageLabel='".$_POST["page_label"]."', pageText='".$_POST["page_text"]."' WHERE ID='".$_POST["ID"]."'";
	mysqli_query($conn, $sql) or die(mysqli_error($conn));
	echo '<script type="text/javascript">window.location = "page.php"</script>';

}else if(isset($_POST["submit_options"])){
	
	$sql = "UPDATE siteOptions SET timestamp='".$inserttime."', siteName='".$_POST["site_name"]."', addTime='".$_POST["timezone"]."', credits='".$_POST["credits"]."' WHERE slot='options1'";
	mysqli_query($conn, $sql) or die(mysqli_error($conn));
	echo '<script type="text/javascript">window.location = "options.php"</script>';	

}else if(isset($_POST['signup'])){
	
	$isActive = secure($_POST['users_active'],$conn);
	$isAllowed = secure($_POST['users_allowed'],$conn);
	$userName = secure($_POST['userName'],$conn);
	$email = secure($_POST['emailID'],$conn);
	$pass1 = secure($_POST['password'],$conn);
	$pass = hash('sha256', $pass1);
	
	$q = "INSERT INTO users(isActive,isAllowed,timestamp,userName,emailID,pass) VALUES('$isActive','$isAllowed','$inserttime','$userName','$email','$pass')";
	$conn->query($q) or die(mysqli_error($conn));
		
	uploadAvatar("users.php", $userName);	
	
	echo '<script type="text/javascript">window.location = "users.php"</script>';

}else if(isset($_POST["edit_admin"])){
	
	$userName = $_POST["userName"];
	
	if(empty($_POST["pass"])){
		$sql = "UPDATE users SET isActive='".$_POST["admin_active"]."', isAllowed='".$_POST["admin_allowed"]."', timestamp='".$inserttime."', userName='".$userName."', emailID='".$_POST["emailID"]."' WHERE ID='".$_POST["ID"]."'";
	}else{
		$pass = hash('sha256', $_POST["pass"]);
		$sql = "UPDATE users SET isActive='".$_POST["admin_active"]."', isAllowed='".$_POST["admin_allowed"]."', timestamp='".$inserttime."', userName='".$userName."', emailID='".$_POST["emailID"]."', pass='".$pass."' WHERE ID='".$_POST["ID"]."'";

	}
	
	mysqli_query($conn, $sql) or die(mysqli_error($conn));
	
	
	uploadAvatar("users.php", $userName);	
	
	echo '<script type="text/javascript">window.location = "users.php"</script>';

}else if(isset($_POST["profile"])){
	
	$userName = $_POST["userName"];
	if(empty($_POST["pass"])){
		$sql = "UPDATE users SET timestamp='".$inserttime."', emailID='".$_POST["emailID"]."' WHERE ID='".$_POST["ID"]."'";
	}else{
		$pass = hash('sha256', $_POST["pass"]);
		$sql = "UPDATE users SET timestamp='".$inserttime."', emailID='".$_POST["emailID"]."', pass='".$pass."' WHERE ID='".$_POST["ID"]."'";

	}
	mysqli_query($conn, $sql) or die(mysqli_error($conn));
	
	uploadAvatar("profile.php", $userName);
	
	echo '<script type="text/javascript">window.location = "profile.php"</script>';
	
}else{
	echo '<script type="text/javascript">window.location = "welcome.php"</script>';
}

include("footer.php");

?>