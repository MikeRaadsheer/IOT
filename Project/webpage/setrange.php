<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Set Range</title>
</head>
	<body>
		
		<?php
			$range = $_GET['Range'];
			$color = $_GET['Color'];
		
			$filePath = "rgbValues.json";

			if(isset($range)){
				if($range < 0 || $range > 255){
					die ("given value is not valid! enter a number between 0 and 255.");
				}
				
			}
			else
			{
				die ("enter a range");
			}

			if($color != "r" && $color != "g" && $color != "b"){
				die ("Color not Valid");
			}

			echo '<p><strong>Ranges</strong></p>';
			echo '<br/><p>Range:  ' . $range . '</p>';
			echo '<p>Color:  ' . $color . '</p>';

			echo $color;
			
			$jsonString = file_get_contents($filePath);
			$data = json_decode($jsonString, true);

			$data[$color] = $range;


			$editedJsonString = json_encode($data);
			file_put_contents($filePath, $editedJsonString);
		?>

	</body>
</html>