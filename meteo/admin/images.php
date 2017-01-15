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
				<h1 class="page-header">Menu</h1>
			</div>
		</div><!--/.row-->
				
		
		
		
		<div class="row">
			<div class="col-md-6">
				<div class="panel panel-default">
					<div class="panel-heading">URL Generator 2 values</div>
					<div class="panel-body">
						
						<script type="text/JavaScript">
						function showMessage(){
							var var1 = document.getElementById("var1").value;
							var var2 = document.getElementById("var2").value;
							var var1min = document.getElementById("var1min").value;
							var var1max = document.getElementById("var1max").value;
							var var2min = document.getElementById("var2min").value;
							var var2max = document.getElementById("var2max").value;
							var var1label = document.getElementById("var1label").value;
							var var2label = document.getElementById("var2label").value;
							var name = document.getElementById("name").value;
							var leftname = document.getElementById("leftname").value;
							var imgsrc = "image.php?img&var1=" + var1 + "&var2=" + var2 + "&var1min=" + var1min + "&var1max=" + var1max+ "&var2min=" + var2min + "&var2max=" + var2max + "&var1label=" + var1label + "&var2label=" + var2label + "&name=" + name + "&leftname=" + leftname;
							
							display_message.innerHTML = imgsrc;
							document.getElementById("img2value").src = "../" + imgsrc;
						}
						</script>

						<label>Select First Value</label>
							<select class="form-control" id='var1'>
								<option value='tempIn'>Temperature Inside</option>
								<option value='humidityIn'>Humidity Inside</option>
								<option value='tempOut'>Temperature Outside</option>
								<option value='humidityOut'>Humidity Outside</option>
								<option value='tempBar'>Temperature from Barometer Sensor</option>
								<option value='pressure'>Pressure</option>
								<option value='rain'>Rain Sensor</option>
							</select>
						<label>Select Second Value</label>
							<select class="form-control" id='var2'>
								<option value='tempIn'>Temperature Inside</option>
								<option value='humidityIn'>Humidity Inside</option>
								<option value='tempOut'>Temperature Outside</option>
								<option value='humidityOut'>Humidity Outside</option>
								<option value='tempBar'>Temperature from Barometer Sensor</option>
								<option value='pressure'>Pressure</option>
								<option value='rain'>Rain Sensor</option>
							</select>
						<label>First value (left) minimum value</label><input class='form-control' id='var1min' placeholder='900' />
						<label>First value (left) maximum value</label><input class='form-control' id='var1max' placeholder='1000' />
						<label>Second value (right) minimum value</label><input class='form-control' id='var2min' placeholder='0' />
						<label>Second value (right) maximum value</label><input class='form-control' id='var2max' placeholder='1100' />
						<label>First value label</label><input class='form-control' id='var1label' placeholder='Pressure in hPa' />
						<label>Second value label</label><input class='form-control' id='var2label' placeholder='Rain Sensor' />
						<label>Image Label</label><input class='form-control' id='name' placeholder='Atmospheric Pressure and Rain' />
						<label>First value (left) Label</label><input class='form-control' id='leftname' placeholder='hPa' />
						
						<button type='submit' onclick="showMessage()" class='btn btn-primary'>Display</button>
						
						<p> Image source: <br /><span id = "display_message"></span> </p><br />
						
						<img id='img2value' src='images/bg.jpg' alt='sam ting wong' />


					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="panel panel-default">
				
				
					<div class="panel-heading">URL Generator for Image with one value</div>
					<div class="panel-body">
					

						<script type="text/JavaScript">
						function showMessage1(){
							var var1_val1 = document.getElementById("var1_val1").value;
							var var1min_val1 = document.getElementById("var1min_val1").value;
							var var1max_val1 = document.getElementById("var1max_val1").value;
							var var1label_val1 = document.getElementById("var1label_val1").value;
							var name_val1 = document.getElementById("name_val1").value;
							var leftname_val1 = document.getElementById("leftname_val1").value;
							var imgsrc2 = "image.php?img1&var1=" + var1_val1 + "&var1min=" + var1min_val1 + "&var1max=" + var1max_val1 + "&var1label=" + var1label_val1 + "&name=" + name_val1 + "&leftname=" + leftname_val1;
							
							display_message1.innerHTML = imgsrc2;
							document.getElementById("img1value").src = "../" + imgsrc2;
						}
						</script>

						<label>Select Value</label>
							<select class="form-control" id='var1_val1'>
								<option value='tempIn'>Temperature Inside</option>
								<option value='humidityIn'>Humidity Inside</option>
								<option value='tempOut'>Temperature Outside</option>
								<option value='humidityOut'>Humidity Outside</option>
								<option value='tempBar'>Temperature from Barometer Sensor</option>
								<option value='pressure'>Pressure</option>
								<option value='rain'>Rain Sensor</option>
							</select>
						<label>Minimum value</label><input class='form-control' id='var1min_val1' placeholder='10' />
						<label>Maximum value</label><input class='form-control' id='var1max_val1' placeholder='30' />
						<label>Value label</label><input class='form-control' id='var1label_val1' placeholder='Temperature, &deg;C' />
						<label>Image Label</label><input class='form-control' id='name_val1' placeholder='Inside Temperature' />
						<label>Value (left) Label</label><input class='form-control' id='leftname_val1' placeholder='&deg;C' />
						
						<button type='submit' onclick="showMessage1()" class='btn btn-primary'>Display</button>
						
						<p> Image source: <br /><span id = "display_message1"></span> </p><br />
						
						<img id='img1value' src='images/bg.jpg' alt='wi to lo' />	

						

					</div>
					
				
					
				</div>
			</div>
		</div><!--/.row-->	
		
		
		

		
	</div><!--/.main-->

<?

include("footer.php");

?>