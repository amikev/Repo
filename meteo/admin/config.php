<?php
$db_username = 'meteo';
$db_password = 'meteostring12';
$db_name = 'login';
$db_host = 'localhost';

	//$mysqli = new mysqli($db_host, $db_username, $db_password,$db_name);
	

$conn = new mysqli($db_host, $db_username, $db_password,'weather_station');

$sqlquery = "SELECT * FROM siteOptions WHERE slot='options1'";
$reso = $conn->query($sqlquery) or die(mysqli_error($conn));
$opt = $reso->fetch_assoc() or die(mysqli_error($reso));

$timezone = $opt['addTime'];
$websiteName = $opt['siteName'];
$creditsFooter = $opt['credits'];

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
	
	function secure($str,$sqlHandle)
	{
		$secured = strip_tags($str);
		$secured = htmlspecialchars($secured);
		$secured = mysqli_real_escape_string($sqlHandle,$secured);
		
		return $secured;
	}
?>