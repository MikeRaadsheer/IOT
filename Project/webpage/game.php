<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Run Game</title>
</head>
<body>

        <?php

        $cache = date("s");

        $r = random_int(0,255);
        $g = random_int(0,255);
        $b = random_int(0,255);

		
        $file = fopen("colorVals.json", "w") or die ("Couldn't find File");
        fwrite($file,'{"r":"' . $r . '","g":"' . $g . '","b":"' . $b . '"}');
        fclose($file);
    
		?>

<script>
    function timedRefresh(timeoutPeriod) {
        setTimeout("location.reload(true);",timeoutPeriod);
    }

    window.onload = timedRefresh(60000);
</script>
</body>
</html>
