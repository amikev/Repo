<?php //session_start();

include("functions.php");
include("header.php");

?>

		
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
				<li class="active">Icons</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Web Site Options</h1>
			</div>
		</div><!--/.row-->
				
		
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">General Web Site Options</div>
					<div class="panel-body">
						
						<form role="form" action="post.php" method="post">
							<?php
							$sql1 = "SELECT * FROM siteOptions WHERE slot = 'options1'";							
							$result1 = $conn->query($sql1) or die(mysqli_error($sql1));
							$item = $result1->fetch_assoc() or die(mysqli_error($result1));
							
							echo "<label>Last change: ".gmdate("d/m/Y H:i:s", $item['timestamp'])."</label><br />";
							echo "<label>Site Name</label><input class='form-control' name='site_name' value='".$item['siteName']."'>";								
							echo "<label>Timezone from UTC (+/-seconds) </label><input class='form-control' name='timezone' value='".$item['addTime']."'>";
							echo "<label>Credits (in the bottom of the page)</label><textarea class='form-control' name='credits' rows='3'>".$item['credits']."</textarea>";
							
							echo "<button type='submit' name='submit_options' class='btn btn-primary'>Save</button>";
							echo "<button type='reset' class='btn btn-default'>Reset</button><br /><br />";
							?>
						</form>

						
					</div>
				</div>
			</div>
		</div><!--/.row-->		
		
	</div><!--/.main-->


<?

include("footer.php");

?>