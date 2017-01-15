<?php //session_start();

include("functions.php");
include("header.php");

    // if (!$_SESSION["userName"]) {
        // header("Location: index.php");
    // }

	 if(isset($_SESSION['userName']))
	 {
		 
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
		
	?>	 
	

	<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
	<script type="text/javascript" src="js/jquery.tempgauge.js"></script>
	
<script type="text/javascript">
	$(function(){
		if(!(/^\?noconvert/gi).test(location.search)){
			$(".tempGauge0").tempGauge({width:200, borderWidth:2, maxTemp:40, minTemp:-10, showLabel:true, showScale:true});
		}
	}
	
	);
	
	
</script>
		
	 <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
				<li class="active">Icons</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Time Now</h1>
			</div>
		</div><!--/.row-->
				
		
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">Last Measurements: <?php echo $item["time"]; ?></div>
					<div class="panel-body">
		
						<p>Permanent link for this page: <b>view.php?now</b></p><br />
						
<?php			 
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
		
	 ?>						
						
						
						
		
		<script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.2/raphael-min.js"></script>
		<script type="text/javascript" src="js/kuma-gauge.jquery.js"></script>
		
		
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
						
						
					</div>
				</div>
			</div>
		</div><!--/.row-->		
		
	</div><!--/.main-->
	 
	 
	 
	 <?php
	 } 
	 else
	 {
	 	// echo 'You are not logged In <br>';
		// echo'<a href="index.php">LOGIN</a>';
		header("Location: index.php");
		
	 }
	 
include("footer.php");
?>