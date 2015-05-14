var exponentialTrendSketch = function(p) {
	// Global variables
	var plot, logScale;

	// Initial setup
	p.setup = function() {
		var maxCanvasWidth, canvasWidth, canvasHeight, canvas;
		var points, i, x, y, xErr, yErr;

		// Resize the canvas if necessary
		maxCanvasWidth = document.getElementById("widthRef").clientWidth - 20;
		canvasWidth = 450;
		canvasHeight = canvasWidth;

		if (canvasWidth > maxCanvasWidth) {
			canvasHeight = canvasHeight * maxCanvasWidth / canvasWidth;
			canvasWidth = maxCanvasWidth;
		}

		// Create the canvas
		canvas = p.createCanvas(canvasWidth, canvasHeight);

		// Prepare the points for the plot
		points = [];

		for ( i = 0; i < 1000; i++) {
			x = 10 + p.random(200);
			y = 10 * p.exp(0.015 * x);
			xErr = p.randomGaussian(0, 2);
			yErr = p.randomGaussian(0, 2);
			points[i] = new GPoint(x + xErr, y + yErr);
		}

		// Create the plot
		plot = new GPlot(p);
		plot.setPos(0, 0);
		plot.setOuterDim(p.width, p.height);

		// Set the plot title and the axis labels
		plot.setTitleText("Exponential law");
		plot.getXAxis().setAxisLabelText("x");

		if (logScale) {
			plot.setLogScale("y");
			plot.getYAxis().setAxisLabelText("log y");
		} else {
			plot.setLogScale("");
			plot.getYAxis().setAxisLabelText("y");
		}

		// Add the points to the plot
		plot.setPoints(points);
		plot.setPointColor(p.color(100, 100, 255, 50));
	};

	// Execute the sketch
	p.draw = function() {
		// Clean the canvas
		p.background(255);

		// Draw the plot
		plot.beginDraw();
		plot.drawBackground();
		plot.drawBox();
		plot.drawXAxis();
		plot.drawYAxis();
		plot.drawTopAxis();
		plot.drawRightAxis();
		plot.drawTitle();
		plot.drawPoints();
		plot.endDraw();
	};

	p.mouseClicked = function() {
		if (plot.isOverBox(p.mouseX, p.mouseY)) {
			// Change the log scale
			logScale = !logScale;

			if (logScale) {
				plot.setLogScale("y");
				plot.getYAxis().setAxisLabelText("log y");
			} else {
				plot.setLogScale("");
				plot.getYAxis().setAxisLabelText("y");
			}
		}
	};
};
