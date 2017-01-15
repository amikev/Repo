<?php 
	require 'config.php';
 		
 		$sqltran = mysqli_query($conn, "SELECT * FROM weatherData")or die(mysqli_error($con));
		$arrVal = array();
 		
		$i=1;
 		while ($rowList = mysqli_fetch_array($sqltran)) {
 								 
						$name = array(
								'id' => $i,
								'time'=> $rowList['time'],
 	 		 	 				'tempIn'=> $rowList['tempIn'],
	 		 	 				'humidityIn'=> $rowList['humidityIn'],
								'tempOut'=> $rowList['tempOut'],
								'humidityOut'=> $rowList['humidityOut'],
								'tempBar'=> $rowList['tempBar'],
								'pressure'=> $rowList['pressure'],
								'rain'=> $rowList['rain'],
 	 		 	 			);		


							array_push($arrVal, $name);	
			$i++;			
	 	}
	 		 echo  json_encode($arrVal);		
 

?>   