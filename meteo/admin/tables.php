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
				<h1 class="page-header">Tables</h1>
			</div>
		</div><!--/.row-->
				
		
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">Advanced Table</div>
					<div class="panel-body">
						
<table data-toggle="table" data-url="list-table.php"  data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name" data-sort-order="desc">
<thead><tr>
<th data-field="state" data-checkbox="true" >Item ID</th>
<th data-field="id" data-sortable="true">ID</th>
<th data-field="time" data-sortable="true">TimeStamp</th>
<th data-field="tempIn"  data-sortable="true">Temperature In</th>
<th data-field="humidityIn" data-sortable="true">Humidity In</th>
<th data-field="tempOut" data-sortable="true">Temperature Out</th>
<th data-field="humidityOut" data-sortable="true">Humidity Out</th>
<th data-field="tempBar" data-sortable="true">TemperatureBarometer</th>
<th data-field="pressure" data-sortable="true">Pressure</th>
<th data-field="rain" data-sortable="true">Rain Sensor</th>
</tr></thead></table>
						
					</div>
				</div>
			</div>
		</div><!--/.row-->		
		
	</div><!--/.main-->


<?

include("footer.php");

?>