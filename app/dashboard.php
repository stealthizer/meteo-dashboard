<?php
	ob_start();

	define(LANGUAGE, "english");
	include("connect.php");
	$link=Connection();
	$result=mysql_query("SELECT * FROM `data` ORDER BY `date` DESC limit 1",$link);
	if($result!==FALSE){
		             while($row = mysql_fetch_array($result)) {
				     $temp = $row["temperature"];
				     $humidity = $row["humidity"];
			     }
	}



	$uptimedata = shell_exec('uptime');
	$uptime = explode(' up ', $uptimedata);
	$uptime = explode(',', $uptime[1]);
	$uptime = $uptime[0].', '.$uptime[1];

	include 'localization/'.LANGUAGE.'.lang.php';

?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Meteo Dashboard</title>
		<link rel="stylesheet" href="stylesheets/main.css">
		<link rel="stylesheet" href="stylesheets/button.css">
		<script src="javascript/raphael.2.1.0.min.js"></script>
	    <script src="javascript/justgage.1.0.1.min.js"></script>

	    <script>
	    	function checkAction(action){
				if (confirm('<?php echo TXT_CONFIRM; ?> ' + action + '?'))
				{
					return true;
				}
				else
				{
					return false;
				}
	    	}

			window.onload = doLoad;

			function doLoad()
			{
			setTimeout( "refresh()", 60*1000 );
			}

			function refresh()
			{
			window.location.reload( false );
			}
	    </script>
	</head>

	<body>
		<div id="container">
				<img id="logo" src="images/sun.png">
				<div id="title">Temperature Dashboard</div>
				<?php if(isset($uptime)){ ?>
					<div id="uptime"><b><?php echo TXT_RUNTIME; ?></b>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $uptime; ?> <span STYLE="font-size: 8px;">(hh:mm)</span></div>
				<?php } ?>

				<?php if(isset($temp) && is_numeric($temp)){ ?>
					<div id="tempgauge"></div>
					<script>
						var t = new JustGage({
						    id: "tempgauge",
						    value: <?php echo $temp; ?>,
						    min: -15,
						    max: 50,
						    title: "<?php echo TXT_TEMPERATURE; ?>",
						    levelColors: ["#0b52d7", "#0bd76d", "#d70b0b"],
						    label: "°C"
					    });
					</script>
				<?php } ?>

				<?php if(isset($humidity) && is_numeric($humidity)){ ?>
					<div id="humgauge"></div>
					<script>
						var h = new JustGage({
							id: "humgauge",
							value: <?php echo $humidity; ?>,
							min: 0,
							max: 100,
							title: "<?php echo TXT_HUMIDITY; ?>",
							levelColors: ["#d7930b", "#d70b0b"],
							label: "%H"
						});
					</script>
				<?php } ?>
		</div>
	</body>
</html>
