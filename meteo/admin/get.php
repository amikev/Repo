<?php
include("functions.php");
include("header.php");

if(isset($_GET["del"])){
	
	$sql = "DELETE FROM headermenu WHERE ID = ".$_GET["ID"];
	mysqli_query($conn, $sql) or die(mysqli_error($conn));		
	header("Location: menu.php");
	
}else if(isset($_GET["delpage"])){
	
	$sql = "DELETE FROM pagecontent WHERE ID = ".$_GET["ID"];
	mysqli_query($conn, $sql) or die(mysqli_error($conn));		
	header("Location: page.php");
	
}else if(isset($_GET["delarede"])){
	
	if($isAllowed == 1){
		$sql = "DELETE FROM users WHERE ID = ".$_GET["ID"];
		mysqli_query($conn, $sql) or die(mysqli_error($conn));		
		header("Location: users.php");
	}else{
		echo '<script type="text/javascript">alert("You shall not pass!"); window.location = "welcome.php";</script>';
	}
	
}else{
	header("Location: index.php");
}

include("footer.php");

?>