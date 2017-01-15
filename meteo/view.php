<?PHP
include("header.php");


if(isset($_GET["view"])){
	
	$sql = "SELECT * FROM pagecontent WHERE pageLink='".$_GET["link"]."'";
	$result = $conn->query($sql) or die(mysqli_error($conn));
	$item = $result->fetch_assoc() or die(mysqli_error($result));

	if($item['isActive'] == 1){
		echo $item['pageText'];
	}

	
}else if(isset($_GET["records"])){
	
	?>
	<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">View for records in time defined by user</div>
					<div class="panel-body">
			
						
						<form role="form" action="view.php?records" method="post">
							<?php
							
							echo "<label>Choose time</label><select name='data' class='form-control'>";
							echo "<option value='24h'>Today (24H)</option><option value='yesterday' >Yesterday</option>";									
							echo "<option value='week'>Last Week</option><option value='month' >Last Month</option>";
							echo "<option value='year'>Last Year</option><option value='alltime' >All Records Ever</option></select><br /><br />";
							
							echo "<button type='submit' name='records' class='btn btn-primary'>Display</button>";
							?>
						</form>

						
					</div>
				</div>
			</div>
		</div><!--/.row-->	
		
		<?php
		if(isset($_POST["data"])){
			echo "<h2>".labelRecords($_POST['data'])."</h2><br /><br />";
			
			echo '<div class="container"><table class="table table-hover table-bordered"><thead>';
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
		echo "</tbody></table></div>";
	
	
}else if(isset($_GET["now"])){	

?>

<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="admin/js/jquery.tempgauge.js"></script>

<script type="text/javascript">
	$(function(){
		if(!(/^\?noconvert/gi).test(location.search)){
			$(".tempGauge0").tempGauge({width:200, borderWidth:2, maxTemp:40, minTemp:-10, showLabel:true, showScale:true});
			$(".tempGauge1").tempGauge({width:40, borderWidth:3, showLabel:false});
			$(".tempGauge2").tempGauge({width:50, borderWidth:4, borderColor:"#adadad", fillColor:"#dcdcdc", showLabel:true});
			$(".tempGauge3").tempGauge({width:160, borderWidth:2, fillColor:"green"});
		}
	}
	
	);
	
	
</script>

<?php
	
		$sql1 = 'SELECT * FROM weatherData ORDER BY ID DESC LIMIT 1';							
		$result1 = $conn->query($sql1) or die(mysqli_error($sql1));
		$item = $result1->fetch_assoc() or die(mysqli_error($result1));
		
		$tempOut = round($item['tempOut'], 2);
		$dewPointOut = number_format(((pow($item['humidityOut']/100,1/8))*(112+(0.9*$tempOut))+0.1*$tempOut-112), 2, ',', '');
		$dewPointIn = number_format(((pow($item['humidityIn']/100,1/8))*(112+(0.9*$item['tempIn']))+0.1*$item['tempIn']-112), 2, ',', '');
		
		$tempIn = round($item['tempIn']);
		$humidityIn = round($item['humidityIn']);
		$humidityOut = round($item['humidityOut'], 2);
		$pressure = round($item['pressure'], 2);
		$rain = round($item['rain']);
	
		echo "<table class='table'><thead><th>Temperature Inside, &deg;C</th><th>Temperature Outside, &deg;C</th><th>Humidity, %</th></tr></thead>";
		echo "<tbody><tr><td rowspan='2'><div class='tempGauge0'>".$item["tempIn"]."</div></td>";
		echo "<td rowspan='2'><div class='tempGauge0'>".$item["tempOut"]."</div></td><td><center><div class='js-gauge js-gauge--1 gauge'></div><br />Inside</center></td>";
		//echo "";
		echo "<tr><td><center><div class='js-gauge js-gauge--2 gauge'></div><br />Outside</center></td></tr>";
		//echo "";
		echo "</tbody></table><br /><br />";
		
		
		
		echo "<h3>Simple values display:</h3>";
		
		echo "<table class='table table-hover'><thead>";
		echo "<tr><th>Info</th><th>Value</th><th>Unit</th></tr>";
		echo "</thead><tbody>";

		echo "<tr><td>Temperature Inside</td><td>".$tempIn."</td><td> &deg;C</td></tr>";
		echo "<tr><td>Humidity Inside</td><td>".$humidityIn."</td><td> % </td></tr>";
		echo "<tr><td>Temperature Outside</td><td>".$tempOut."</td><td> &deg;C</td></tr>";
		echo "<tr><td>Humidity Outside</td><td>".$humidityOut."</td><td> % </td></tr>";
		echo "<tr><td>Dew Point Temperature Inside</td><td>".$dewPointIn."</td><td> &deg;C</td></tr>";
		echo "<tr><td>Dew Point Temperature Outside</td><td>".$dewPointOut."</td><td> &deg;C</td></tr>";
		echo "<tr><td>Atmospheric Pressure</td><td>".$pressure."</td><td> hPa</td></tr>";
		echo "<tr><td>Rain Sensor Value</td><td>".$rain."</td><td>(0 - 1023)</td></tr>";

		echo "</tbody></table><br /><br />";
		
	
	
}else{
	header("Location: index.php");
	
}


include("footer.php");
?>

		<script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.2/raphael-min.js"></script>
		<script type="text/javascript" src="admin/js/kuma-gauge.jquery.js"></script>
		
		
		<script>
			$('.js-gauge--1').kumaGauge({
				value : Math.floor((Math.random() * 99) + 1),
				
				label : {
		            display : true,
		            left : '0%',
		            right : '100%',
		            fontFamily : 'Helvetica',
		            fontColor : '#1E4147',
		            fontSize : '11',
		            fontWeight : 'bold'
		        }
			});

			$('.js-gauge--1').kumaGauge('update', {
				value : Math.floor((Math.random() * 99) + 1)
			});

			$('.js-gauge--2').kumaGauge({
				value : Math.floor((Math.random() * 99) + 1),
				
				label : {
		            display : true,
		            left : '0%',
		            right : '100%',
		            fontFamily : 'Helvetica',
		            fontColor : '#1E4147',
		            fontSize : '11',
		            fontWeight : 'bold'
		        }
			});
	

			var update = setInterval(function() {
				var newVal = Math.floor((Math.random() * 99) + 1);
				$('.js-gauge--1').kumaGauge('update',{
					value : <?php echo $item["humidityIn"]; ?>
				});	
				
				$('.js-gauge--2').kumaGauge('update',{
					value : <?php echo $item["humidityOut"]; ?>
				});		
			}, 1000);
		</script>