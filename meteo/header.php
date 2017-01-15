<?PHP
include("admin/functions.php");
?>

<!DOCTYPE HTML>
<html>
	<head>
		<title><?php echo $websiteName; ?></title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800" rel="stylesheet" type="text/css" />
		<!--[if lte IE 8]><script src="js/html5shiv.js"></script><![endif]-->
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
		<script src="js/skel.min.js"></script>
		<script src="js/skel-panels.min.js"></script>
		<script src="js/init.js"></script>
		<noscript>

			<link rel="stylesheet" href="css/style.css" />
			<link rel="stylesheet" href="css/style-desktop.css" />
			
		</noscript>
		<link rel="shortcut icon" href="css/images/favicon.ico" type="image/x-icon">
		<link rel="icon" href="css/images/favicon.ico" type="image/x-icon">
		
		
	<script src="admin/js/jquery-1.11.1.min.js"></script>
	<script src="admin/js/bootstrap.min.js"></script>
	<script src="admin/js/chart.min.js"></script>
	<script src="admin/js/chart-data.js"></script>
	<script src="admin/js/easypiechart.js"></script>
	<script src="admin/js/easypiechart-data.js"></script>
	<script src="admin/js/bootstrap-datepicker.js"></script>
	<script src="admin/js/bootstrap-table.js"></script>
		
		
<link href="admin/css/bootstrap.min.css" rel="stylesheet">
<link href="admin/css/datepicker3.css" rel="stylesheet">
<link href="admin/css/bootstrap-table.css" rel="stylesheet">


<!--Icons-->
<script src="admin/js/lumino.glyphs.js"></script>

<!--[if lt IE 9]>
<script src="admin/js/html5shiv.js"></script>
<script src="admin/js/respond.min.js"></script>
<![endif]-->
		
		
	</head>
	<body class="homepage">
		<div id="wrapper">
			<div id="header-wrapper">
				<div class="container">
					<div id="header">
						<div class="title">
							<h1><a href="index.php"><?php echo $websiteName; ?></a></h1>
						</div>
						<nav id="nav">
						<ul>
						<?php
						$sql = "SELECT * FROM headermenu ORDER BY menuNumber ASC";
						$result = $conn->query($sql) or die(mysqli_error($conn));

						if ($result->num_rows > 0) {
    						while($row = $result->fetch_assoc()) {
								if($row["isActive"] == 1){
									echo "<li><a href='".$row["menuLink"]."'>".$row["menuText"]."</a></li>";
								}
    						}
						} else {
    						echo "0 results";
						}
						?>		
		
						</ul>
					</nav>
					</div>
				</div>
				
					
							
			</div>
			
			
			
			<div id="page">
				<div class="container">
					<div class="row skel-cell-important" id="content">
						<div class="12u">
							

			
<?PHP

?>