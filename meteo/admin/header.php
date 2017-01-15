<?php session_start(); 

//$username;

	 if(isset($_SESSION['userName']))
	 {
		 $username = $_SESSION['userName'];
	 }else{
		header("Location: index.php");	
	 }
	 echo "te tuka";
echo $username;

$sqlll = "SELECT * FROM users WHERE userName='".$_SESSION['userName']."'";
$resss = $conn->query($sqlll) or die(mysqli_error($conn));
$iteee = $resss->fetch_assoc() or die(mysqli_error($resss));

$isAllowed = $iteee['isAllowed'];

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo $websiteName; ?></title>

<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/datepicker3.css" rel="stylesheet">
<link href="css/styles.css" rel="stylesheet">
<link href="css/bootstrap-table.css" rel="stylesheet">

<!--Icons-->
<script src="js/lumino.glyphs.js"></script>

<!--[if lt IE 9]>
<script src="js/html5shiv.js"></script>
<script src="js/respond.min.js"></script>
<![endif]-->

<link rel="shortcut icon" href="../css/images/favicon.ico" type="image/x-icon">
<link rel="icon" href="../css/images/favicon.ico" type="image/x-icon">

	<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/chart.min.js"></script>
	<script src="js/chart-data.js"></script>
	<script src="js/easypiechart.js"></script>
	<script src="js/easypiechart-data.js"></script>
	<script src="js/bootstrap-datepicker.js"></script>
	<script src="js/bootstrap-table.js"></script>
	

	
	<script>
	!function ($) {
		$(document).on("click","ul.nav li.parent > a > span.icon", function(){		  
			$(this).find('em:first').toggleClass("glyphicon-minus");	  
		}); 
		$(".sidebar span.icon").find('em:first').addClass("glyphicon-plus");
	}(window.jQuery);

	$(window).on('resize', function () {
	  if ($(window).width() > 768) $('#sidebar-collapse').collapse('show')
	})
	$(window).on('resize', function () {
	  if ($(window).width() <= 767) $('#sidebar-collapse').collapse('hide')
	})
	
	
	// $('.navbar li').click(function(e) {
    // $('.navbar li.active').removeClass('active');
    // var $this = $(this);
    // if (!$this.hasClass('active')) {
        // $this.addClass('active');
    // }
    // e.preventDefault();
	// });
	
	
	
	
	$(document).ready(function () {
        $('ul.nav > li').click(function (e) {
            //e.preventDefault();
            $('ul.nav > li').removeClass('active');
            $(this).addClass('active');                
        });            
    });
	</script>	


</head>

<body>





	<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#"><span><?php echo $websiteName; ?></span> Administration</a>
				<ul class="user-menu">
					<li class="dropdown pull-right">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg><?php echo $_SESSION['userName']; ?><span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							<li><a href="profile.php"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg> Profile</a></li>
							<li><a href="logout.php"><svg class="glyph stroked cancel"><use xlink:href="#stroked-cancel"></use></svg> Logout</a></li>
						</ul>
					</li>
				</ul>
			</div>
							
		</div><!-- /.container-fluid -->
	</nav>
		
	<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
		<form role="search">
			<div class="form-group">
				<?php echo'<img src="profilepic/' . $_SESSION['userName'] . '.jpg" width="200px" height="200px" <br>'; ?>
			</div>
		</form>
		<ul class="nav menu">
			<li><a href="welcome.php"><svg class="glyph stroked desktop"><use xlink:href="#stroked-desktop"/></svg> Home</a></li>
			<li><a href="options.php"><svg class="glyph stroked dashboard-dial"><use xlink:href="#stroked-dashboard-dial"></use></svg> Options</a></li>
			<?php if($isAllowed == 1){ ?>
				<li><a href="users.php"><svg class="glyph stroked calendar"><use xlink:href="#stroked-calendar"></use></svg> Admins</a></li>
			<?php } ?>
			<li><a href="images.php"><svg class="glyph stroked line-graph"><use xlink:href="#stroked-line-graph"></use></svg> Charts</a></li>
			<li><a href="tables.php"><svg class="glyph stroked table"><use xlink:href="#stroked-table"></use></svg> Database </a></li>
			<li><a href="menu.php"><svg class="glyph stroked pencil"><use xlink:href="#stroked-pencil"></use></svg> Menu</a></li>
			<li><a href="page.php"><svg class="glyph stroked app-window"><use xlink:href="#stroked-app-window"></use></svg> Pages</a></li>
			<li><a href="records.php"><svg class="glyph stroked star"><use xlink:href="#stroked-star"></use></svg> Records</a></li>
			
		</ul>

	</div><!--/.sidebar-->
	
	
	
		