<?php // content="text/plain; charset=utf-8"
error_reporting(E_ALL);
ini_set('display_errors',1);

require_once ('jpgraph/jpgraph.php');
require_once ('jpgraph/jpgraph_line.php');
require_once ('jpgraph/jpgraph_bar.php');
require_once ('admin/config.php');

////how to call it: 
// image.php?img&var1=pressure&var2=rain&var1min=900&var1max=1000&var2min=0&var2max=1100&var1label=Pressure%20in%20hPa&var2label=Rain Sensor&name=Atmospheric Pressure and Rain&leftname=hPa

// TempIN
// image.php?img&var1=tempIn&var2=humidityIn&var1min=10&var1max=40&var2min=30&var2max=50&var1label=Temperature,&deg;C&var2label=Humidity, %&name=Temperature and Humidity Inside&leftname=T, &deg;C

// TempOut
// image.php?img&var1=tempOut&var2=humidityOut&var1min=-30&var1max=40&var2min=0&var2max=100&var1label=Temperature,&deg;C&var2label=Humidity, %&name=Temperature and Humidity Outside&leftname=T, &deg;C

// one value image
// image.php?img1&var1=pressure&var1min=900&var1max=1000&var1label=Pressure%20in%20hPa&name=Atmospheric Pressure and Rain&leftname=hPa

if(isset($_GET["img"])){

	JpgraphError::SetImageFlag(false);
	JpGraphError::SetLogFile('syslog');

		$result = array();
		$getob="SELECT ".$_GET["var1"]." FROM weatherData";
		$getob2=mysqli_query($conn, $getob) or die("Could not get objects");
		while($getob3=mysqli_fetch_array($getob2, MYSQLI_ASSOC)){
			//$result[] = $getob3["pressure"];
			$result[] = $getob3[$_GET["var1"]];
		}

		$rain = array();
		$getrain="SELECT ".$_GET["var2"]." FROM weatherData";
		$getrain2=mysqli_query($conn, $getrain) or die("Could not get objects");
		while($getrain3=mysqli_fetch_array($getrain2, MYSQLI_ASSOC)){
			//$rain[] = $getrain3["rain"];
			$rain[] = $getrain3[$_GET["var2"]];
		}
	
	// Create the graph. These two calls are always required
	$graph = new Graph(850,450);
	$graph->SetScale('int',$_GET["var1min"],$_GET["var1max"]);
	$graph->SetY2Scale('int',$_GET["var2min"],$_GET["var2max"]);
	$graph->title->Set($_GET["name"]);
	$graph->yaxis->title->Set($_GET["leftname"]);
	$graph->SetMargin(50,50,50,50);
	$graph->xaxis->SetPos("min");
	$graph->xaxis->SetLabelAngle(90);

	// Create the linear plot
	$lineplot=new LinePlot($result);
	$lineplot->SetColor("green");
	$lineplot->SetWeight(2);
	$lineplot->SetLegend($_GET["var1label"]);

	// Create the bar plot
	$lineplot2 = new LinePlot($rain);
	$lineplot2->SetColor("blue");
	$lineplot2->SetLegend($_GET["var2label"]);


	// Add the plot to the graph
	$graph->Add($lineplot);
	$graph->AddY2($lineplot2);

	// Display the graph
	$graph->Stroke();

}else if(isset($_GET["img1"])){

	JpgraphError::SetImageFlag(false);
	JpGraphError::SetLogFile('syslog');

		$result = array();
		$getob="SELECT ".$_GET["var1"]." FROM weatherData";
		$getob2=mysqli_query($conn, $getob) or die("Could not get objects");
		while($getob3=mysqli_fetch_array($getob2, MYSQLI_ASSOC)){
			//$result[] = $getob3["pressure"];
			$result[] = $getob3[$_GET["var1"]];
		}

	
	// Create the graph. These two calls are always required
	$graph = new Graph(850,450);
	$graph->SetScale('textlin',$_GET["var1min"],$_GET["var1max"]);
	//$graph->SetY2Scale('int',$_GET["var2min"],$_GET["var2max"]);
	$graph->title->Set($_GET["name"]);
	$graph->yaxis->title->Set($_GET["leftname"]);
	$graph->SetMargin(50,50,50,50);
	$graph->xaxis->SetLabelAngle(90);

	// Create the linear plot
	$lineplot=new LinePlot($result);
	$lineplot->SetColor("green");
	$lineplot->SetWeight(2);
	$lineplot->SetLegend($_GET["var1label"]);

	// Create the bar plot
	//$lineplot2 = new LinePlot($rain);
	//$lineplot2->SetColor("blue");
	//$lineplot2->SetLegend($_GET["var2label"]);


	// Add the plot to the graph
	$graph->Add($lineplot);
	//$graph->AddY2($lineplot2);

	// Display the graph
	$graph->Stroke();
	
}

?>