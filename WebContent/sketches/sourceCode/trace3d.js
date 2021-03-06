function runSketch() {
	var scene, renderer, camera, controls, light, guiControlKeys, trace;

	init();
	animate();

	/*
	 * Initializes the sketch
	 */
	function init() {
		// Scene setup
		scene = new THREE.Scene();

		// Add the WebGL renderer
		renderer = addWebGLRenderer(800,450);
		renderer.setClearColor(new THREE.Color(0.93, 0.93, 0.93));

		// Camera setup
		camera = new THREE.PerspectiveCamera(45, renderer.getSize().width / renderer.getSize().height, 0.1, 2000);
		camera.position.set(300, 200, -400);

		// Initialize the camera controls
		controls = new THREE.OrbitControls(camera, renderer.domElement);
		controls.enablePan = false;
		controls.rotateSpeed = 2.0;
		controls.zoomSpeed = 0.6;
		controls.minDistance = 10;
		controls.maxDistance = 1500;

		// Initialize the directional light
		light = new THREE.DirectionalLight();
		scene.add(light);

		// Create the GUI and initialize the GUI control keys
		createGUI();

		// Read the trace
		readTraceAndAddMeshToScene("trace1");
	}

	/*
	 * Animates the sketch
	 */
	function animate() {
		// Request the next animation frame
		requestAnimationFrame(animate);

		// Update the camera controls
		controls.rotateSpeed = Math.min(0.02 * camera.position.length() / controls.minDistance, 0.5);
		
		// Update the light position
		light.position.copy(camera.position);

		// Render the scene
		renderer.render(scene, camera);
	}

	/*
	 * Creates and adds the webGL renderer
	 */
	function addWebGLRenderer(canvasWidth, canvasHeight) {
		var referenceElement, maxCanvasWidth, webGLRenderer;

		// Calculate the renderer dimensions
		referenceElement = document.getElementById("widthRef");
		maxCanvasWidth = referenceElement.clientWidth - 1;

		if (canvasWidth > maxCanvasWidth) {
			canvasHeight = maxCanvasWidth * canvasHeight / canvasWidth;
			canvasWidth = maxCanvasWidth;
		}

		// Create the webGL renderer with the correct dimensions
		webGLRenderer = new THREE.WebGLRenderer({
			antialias : true
		});
		webGLRenderer.setSize(canvasWidth, canvasHeight);

		// Add the renderer to the sketch container
		document.getElementById(sketchContainer).appendChild(webGLRenderer.domElement);

		// Resize the renderer if necessary
		maxCanvasWidth = referenceElement.clientWidth - 1;

		if (canvasWidth > maxCanvasWidth) {
			webGLRenderer.setSize(maxCanvasWidth, maxCanvasWidth * canvasHeight / canvasWidth);
		}

		return webGLRenderer;
	}

	/*
	 * Creates the sketch GUI
	 */
	function createGUI() {
		var gui, controller, i, hueElements;

		// Initialize the control keys
		guiControlKeys = {
			"Color" : [ 150, 150, 255 ],
			"Tightness" : 0.2,
			"Subdivissions" : 10,
			"Sides" : 10,
			"Radius" : 15,
			"Flat shading" : true,
			"Show lines" : false
		};

		// Create the GUI
		gui = new dat.GUI({
			autoPlace : false
		});
		gui.close();

		// Add the GUI controllers
		controller = gui.addColor(guiControlKeys, "Color");
		controller.onChange(function(value) {
			if (trace) {
				trace.mesh.material.color.setRGB(value[0] / 255, value[1] / 255, value[2] / 255);
			}
		});

		controller = gui.add(guiControlKeys, "Tightness", 0, 0.5);
		controller.onFinishChange(updateTraceMesh);

		controller = gui.add(guiControlKeys, "Subdivissions", 1, 30).step(1);
		controller.onFinishChange(updateTraceMesh);

		controller = gui.add(guiControlKeys, "Sides", 1, 20).step(1);
		controller.onFinishChange(updateTraceMesh);

		controller = gui.add(guiControlKeys, "Radius", 1, 20);
		controller.onFinishChange(updateTraceMesh);

		controller = gui.add(guiControlKeys, "Flat shading");
		controller.onFinishChange(function(value) {
			if (trace) {
				trace.mesh.material.flatShading = value;
				trace.mesh.material.needsUpdate = true;
			}
		});

		controller = gui.add(guiControlKeys, "Show lines");
		controller.onFinishChange(function(value) {
			if (trace) {
				trace.mesh.material.wireframe = value;
			}
		});

		// Add the GUI to the correct DOM element
		document.getElementById(guiContainer).appendChild(gui.domElement);

		// Fix a bug with the dat.GUI hue color selector
		hueElements = document.getElementsByClassName("hue-field");

		for (i = 0; i < hueElements.length; i++) {
			hueElements[i].style.width = "10px";
		}
	}

	/*
	 * Loads the trace file from the server and adds the trace mesh to the scene
	 */
	function readTraceAndAddMeshToScene(fileName) {
		var request = new XMLHttpRequest();
		request.onload = addTraceMesh;
		request.open("get", "data/" + fileName + ".trace", true);
		request.send();
	}

	/*
	 * This function will be executed when the trace file is loaded
	 */
	function addTraceMesh() {
		// If it exists, remove the previous trace mesh from the scene
		if (trace) {
			scene.remove(trace.mesh);
		}

		// Create a new trace object and initialize it with the file content
		trace = new Trace();
		trace.initFromFile(this.responseText);

		// Center the trace points and reduce the size a bit
		trace.center();
		trace.scale(0.3);

		// Create the trace mesh
		trace.createMesh(guiControlKeys.Tightness, guiControlKeys.Subdivissions, guiControlKeys.Radius,
				guiControlKeys.Sides, guiControlKeys.Color, guiControlKeys["Flat shading"],
				guiControlKeys["Show lines"]);

		// Add the mesh to the scene
		scene.add(trace.mesh);
	}

	/*
	 * Updates the trace mesh when the user modifies them with the GUI
	 */
	function updateTraceMesh() {
		if (trace) {
			// Remove the previous trace mesh from the scene
			scene.remove(trace.mesh);

			// Create the trace mesh
			trace.createMesh(guiControlKeys.Tightness, guiControlKeys.Subdivissions, guiControlKeys.Radius,
					guiControlKeys.Sides, guiControlKeys.Color, guiControlKeys["Flat shading"],
					guiControlKeys["Show lines"]);

			// Add the mesh to the scene
			scene.add(trace.mesh);
		}
	}
}