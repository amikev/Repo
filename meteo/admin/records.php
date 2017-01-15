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
				<h1 class="page-header">Records</h1>
			</div>
		</div><!--/.row-->
				
		
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">Weather Records</div>
					<div class="panel-body">
						
						<form role="form" action="records.php" method="post">
							<?php
							echo "<label>Hard coded link for page with records: <br/ ><br/ ><b>view.php?records</b></label><br/ ><br/ >";
							echo "<label>Choose time</label><select name='data' class='form-control'>";
							echo "<option value='24h'>Today (24H)</option><option value='yesterday' >Yesterday</option>";									
							echo "<option value='week'>Last Week</option><option value='month' >Last Month</option>";
							echo "<option value='year'>Last Year</option><option value='alltime' >All Records Ever</option></select><br /><br />";
							
							echo "<button type='submit' name='records' class='btn btn-primary'>Display</button>";
							?>
						</form>
						
						
						
						<?php
						if(isset($_POST["data"])){
							echo "<h2>".labelRecords($_POST['data'])."</h2><br /><br />";
							
							echo '<table class="table table-hover table-bordered"><thead>';
							echo "<tr><th>Time and Date</th><th>TempInMin</th><th>TempInMax</th><th>HumidityInMin</th><th>HumidityInMax</th>";
							echo "<th>TempOutMin</th><th>TempOutMax</th><th>HumidityOutMin</th><th>HumidityOutMax</th>";
							echo "<th>PressureMin</th><th>PressureMax</th><th>RainMin</th><th>RainMax</th></tr></thead><tbody>";


							$sql = "SELECT * FROM records WHERE type = '".$_POST['data']."'";
							$result = $conn->query($sql) or die(mysqli_error($conn));

							if ($result->num_rows > 0) {
								while($row = $result->fetch_assoc()) {
									
									echo "<tr><td>".gmdate("d/m/Y H:i:s", $row['timestamp'])."</td><td>".$row['tempInMin']."</td><td>".$row['tempInMax']."</td><td>".$row['humidityInMin']."</td><td>".$row['humidityInMax']."</td>";
									echo "<td>".$row['tempOutMin']."</td><td>".$row['tempOutMax']."</td><td>".$row['humidityOutMin']."</td><td>".$row['humidityOutMax']."</td>";
									echo "<td>".$row['PressureMin']."</td><td>".$row['PressureMax']."</td><td>".$row['RainMin']."</td><td>".$row['RainMax']."</td></tr>";

								}
							} else {
								echo "0 results";
							}
						
						
						
						}
						echo "</tbody></table>";
						?>
						
						
						

						
					</div>
				</div>
			</div>
		</div><!--/.row-->		
		
	</div><!--/.main-->


<?

include("footer.php");

?>