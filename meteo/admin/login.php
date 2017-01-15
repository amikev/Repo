<?php session_start();
include("config.php");
if(isset($_POST['login']))
{
	$userName = secure($_POST['username'], $conn);
	$pass1 =  secure($_POST['password'], $conn);
	$pass = hash('sha256', $pass1);
	
	$q = "SELECT * FROM users WHERE username = '$userName' AND pass = '$pass'";
	if($res = $conn->query($q))
	{
		if($res->num_rows > 0)			
		{
			$item = $res->fetch_assoc() or die(mysqli_error($res));
			if ($item['isActive'] == 1){
				$_SESSION['userName'] = $userName;
				header("Location:welcome.php");
				exit;
			}else{
				echo'<script type="text/javascript">alert("Your user has been blocked by the administrators!"); window.location = "index.php";</script>';
			}
		}
		else
		{
			echo'<script type="text/javascript">alert("INVALID USERNAME OR PASSWORD"); window.location = "index.php";</script>';
		}
	}
}
?>