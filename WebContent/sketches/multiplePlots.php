<?php
// General php variables
$homeDir = '../';
$page = 'grafica';
$keywords = 'processing, p5.js, P5js, openFrameworks, javaScript, grafica, grafica.js, ofxGrafica, examples, plot';
$descriptionText = 'p5.js and grafica.js multiple plots sketch';
$titleText = 'Multiple plots sketch - jagracar';
$addP5js = true;
$addGrafica = true;
$addToxiclibs = false;
$addDatGui = false;
$addThreejs = false;
$addJQuery = false;
$sketch = 'multiplePlots';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php require $homeDir . 'head.php';?>
<script type="text/javascript" src="sourceCode/multiplePlots.js" async></script>
</head>

<body>
	<!-- Navigation bar -->
<?php require $homeDir . 'navBar.php';?>

	<!-- Main content -->
	<main class="main-container">
	<article class="content">
		<header>
			<h2>
				<a href="/grafica.php">Grafica library</a>
			</h2>
		</header>

		<div class="sketches-container">
			<!-- Sketches list -->
<?php require $homeDir . 'graficaSketchesList.php';?>

			<section class="sketch" id="widthRef">
				<div class="sketch-wrapper">
					<div class="sketch-canvas" id="sketch-canvas"></div>
				</div>

				<!-- Run the sketch -->
				<script>
					window.onload = function() {
						var sketch = new p5(multiplePlotsSketch, "sketch-canvas");
					};
				</script>

				<p>This example shows many of the capabilities of the grafica
					library in action. Drag the mouse (+control key) over the first
					plot to pan in any direction. Left click to show the point labels.
					Click left in the second plot to re-center and use the mouse wheel
					to zoom. Click in the third plot to re-center. Click left/right in
					the fourth plot to zoom/un-zoom.</p>

				<p>
					The beer mug image is a slightly modified version of the work by <a
						href="http://www.clker.com/clipart-oktoberfest-beer-mug-1.html">KLARA
						78</a>.
				</p>
				<p>
					For more details, check the <a href="sourceCode/multiplePlots.js">source
						code</a> or play with it at <a
						href="http://jsfiddle.net/jagracar/uvpxnudo/">JSFiddle</a>.
				</p>
			</section>
		</div>
	</article>
	</main>

	<!-- Footer -->
<?php require $homeDir . 'footer.php';?>
</body>
</html>