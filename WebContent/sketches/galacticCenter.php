<?php
	// General php variables
	$page = 'threejs';
	$homeDir = '../';
	$sketch = 'galacticCenter';
?>

<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="keywords"
	content="three.js, javaScript, examples, 3D, galactic center, astronomy, science, dat.GUI, black hole, star">
<meta name="description" content="three.js Galactic center sketch">
<meta name="author" content="Javier Graciá Carpio">
<title>Galactic center sketch - jagracar</title>

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

	<div class="main-container">
		<header>
			<h1>
				<a href="<?php echo $homeDir;?>threejsSketches.php">Three.js sketches</a>
			</h1>
		</header>

		<!-- Sketches list -->
		<?php include_once $homeDir . 'threejsSketchesList.php';?>

		<script id="star-vertexShader" type="x-shader/x-vertex"><?php include_once 'sourceCode/shaders/star.vert';?></script>
		<script id="star-fragmentShader" type="x-shader/x-fragment"><?php include_once 'sourceCode/shaders/star.frag';?></script>
		<script id="bh-vertexShader" type="x-shader/x-vertex"><?php include_once 'sourceCode/shaders/blackHole.vert';?></script>
		<script id="bh-fragmentShader" type="x-shader/x-fragment"><?php include_once 'sourceCode/shaders/blackHole.frag';?></script>

		<div class="sketch-container">
			<div class="sketch" id="widthRef">
				<div class="sketch__wrapper">
					<div class="sketch__canvas" id="sketch__canvas">
						<div class="sketch__gui" id="sketch__gui"></div>
					</div>
				</div>

				<div class="sketch__description">
					<p>
						Some of my colleagues at the <a href="http://www.mpe.mpg.de/ir">MPE IR group</a> have been monitoring for more
						than 20 years the apparent position of the closest stars to the <a
							href="https://en.wikipedia.org/wiki/Galactic_Center">center</a> of the <a
							href="https://en.wikipedia.org/wiki/Milky_Way">Milky Way</a>. From those observations they managed to reconstruct
						their stellar orbits and found that their foci coincide with a single point in the sky, with an estimated mass of
						the order of 4.3 million times the mass of the Sun. The density derived from this mass and the length of the
						closest stellar approach is so high that the only plausible explanation is that a <a
							href="https://en.wikipedia.org/wiki/Supermassive_black_hole">supermassive black hole</a> resides at the center of
						the Milky Way.
					</p>

					<p>
						This sketch tries to simulate the movement of the stars around the Galactic Center black hole. The starting point
						uses the real deprojected stellar positions and velocities at a given moment in time kindly provided by Stefan
						Gillessen. The subsequent positions are calculated using <a
							href="https://en.wikipedia.org/wiki/Newton%27s_law_of_universal_gravitation">Newton's law of universal
							gravitation</a> and the <a href="https://en.wikipedia.org/wiki/Leapfrog_integration">leapfrog algorithm</a>. The
						stellar colors and diameters are not real, as well as the black hole size and the optical effects that it
						produces.
					</p>

					<p>
						The background image is a 70 micron continuum <a
							href="http://archives.esac.esa.int/hsa/aio/jsp/postcardPage.jsp?OBSERVATION_OID=8387907">map</a> of the central 2
						arcminutes of the Milky Way obtained with the <a href="http://www.mpe.mpg.de/ir/Pacs">PACS</a> photometer
						instrument on board of the <a href="http://sci.esa.int/herschel/">Herschel satellite</a>. The map
						was reduced using an automatic data processing pipeline that I have helped to develop as part of my work at MPE.
					</p>

					<p>
						If the sketch doesn't work, you probably need to change your browser to one that <a
							href="https://en.wikipedia.org/wiki/WebGL#Support">supports WebGL</a>.
					</p>

					<p>
						For more details, check the <a href="sourceCode/galacticCenter.js">sketch source code</a>, the star <a
							href="sourceCode/shaders/star.vert">vertex</a> and <a href="sourceCode/shaders/star.frag">fragment</a> shaders,
						and the black hole <a href="sourceCode/shaders/blackHole.vert">vertex</a> and <a
							href="sourceCode/shaders/blackHole.frag">fragment</a> shaders.
					</p>
				</div>
			</div>
		</div>
	</div>

	<!-- Footer -->
	<?php include_once $homeDir . 'footer.php';?>

	<!-- JavaScript files -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/dat-gui/0.5/dat.gui.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/88/three.js"></script>
	<script src="<?php echo $homeDir;?>js/TrackballControls.js"></script>
	<script src="<?php echo $homeDir;?>js/CopyShader.js"></script>
	<script src="<?php echo $homeDir;?>js/MergeShader.js"></script>
	<script src="<?php echo $homeDir;?>js/EffectComposer.js"></script>
	<script src="<?php echo $homeDir;?>js/MaskPass.js"></script>
	<script src="<?php echo $homeDir;?>js/RenderPass.js"></script>
	<script src="<?php echo $homeDir;?>js/ShaderPass.js"></script>
	<script src="sourceCode/galacticCenter.js"></script>

	<!-- Run the sketch -->
	<script>
		var guiContainer = "sketch__gui";
		var sketchContainer = "sketch__canvas";
		window.onload = runSketch;
	</script>
</body>
</html>