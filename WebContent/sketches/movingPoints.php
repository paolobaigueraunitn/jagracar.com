<?php
	// General php variables
	$page = 'grafica';
	$homeDir = '../';
	$sketch = 'movingPoints';
?>

<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="keywords" content="processing, p5.js, P5js, javaScript, grafica, grafica.js, examples, plot">
<meta name="description" content="p5.js and grafica.js moving points sketch">
<meta name="author" content="Javier Graciá Carpio">
<title>Moving points sketch - jagracar</title>

<!-- CSS files -->
<link rel="stylesheet" href="<?php echo $homeDir;?>css/styles.css" />

<!-- Useful JavaScript files -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body>
	<!-- Navigation bar -->
	<?php include_once $homeDir . 'navBar.php';?>

	<div class=main-container>
		<header>
			<h1>
				<a href="<?php echo $homeDir;?>grafica.php">Grafica library</a>
			</h1>
		</header>

		<!-- Examples side bar -->
		<?php include_once $homeDir . 'graficaSketchesList.php';?>

		<div class="sketch-container">
			<div class="sketch" id="widthRef">
				<div class="sketch__wrapper">
					<div class="sketch__canvas" id="sketch__canvas"></div>
				</div>

				<div class="sketch__description">
					<p>It's possible to have multiple data sets (layers) in the same plot. It's also possible to display them with
						different properties.</p>

					<p>In this example we have two layers. We are drawing the points from the first layer as red circles, and those
						in the second layer as a closed filled contour. The points from the first layer are updated every few frames. Drag
						the plot area with the mouse to pan. Click to change the point rotation.</p>

					<p>
						For more details, check the <a href="sourceCode/movingPoints.js">source code</a> or play with it at <a
							href="http://jsfiddle.net/jagracar/sjutpjks/">JSFiddle</a>.
					</p>
				</div>
			</div>
		</div>
	</div>

	<!-- Footer -->
	<?php include_once $homeDir . 'footer.php';?>

	<!-- JavaScript files -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/p5.js/0.4.4/p5.min.js"></script>
	<script src="<?php echo $homeDir;?>js/grafica.min.js"></script>
	<script src="sourceCode/movingPoints.js"></script>

	<!-- Run the sketch -->
	<script>
		var sketch = new p5(movingPointsSketch, "sketch__canvas");
	</script>
</body>
</html>