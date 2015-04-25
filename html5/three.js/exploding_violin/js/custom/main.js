// Point of entry

// global(?) variables
var scene, camera, renderer;
var objects = new Array();
var tweens = new Array();
var stats;
var numObjects = 3;
var currentTweens = 0;
var expand = false;
var radius = 100, theta = 0;

// violin
var violin = new Violin();

// Picking stuff
var mouse = new THREE.Vector2(-999,-999), intersectedMesh, intersects;
var	raycaster = new THREE.Raycaster();
var mouseDown = false;

// User interaction
window.addEventListener( 'mousemove', onMouseMove, false );
window.addEventListener( 'mousedown', onMouseDown, false );
window.addEventListener( 'mouseup', onMouseUp, false );
window.addEventListener( 'resize', onWindowResize, false );

init();
animate();
		
function init() {
	// set up our scene, camera and renderer
	camera = new THREE.PerspectiveCamera( 75, window.innerWidth / window.innerHeight, 0.1, 1000);
	camera.position.set( 10, 10, 10 );
	scene = new THREE.Scene();

	// create lighting sources
	var lightAmbient = new THREE.AmbientLight( 0xffffff );
	lightAmbient.position.set(-100,200,100 );
	scene.add( lightAmbient );
	var lightPoint = new THREE.PointLight( 0xffffff );
	lightPoint.position.set(-100,200,100 );
	scene.add( lightPoint );

	// create our violin
	violin.addPart( 'models/cube.json', 0, 0, 0 );
	violin.addPart( 'models/cube.json', 3, 0, 0 );
	violin.addPart( 'models/cube.json', 3, 3, 0 );
	violin.addPart( 'models/cube.json', 0, 3, 0 );
	violin.addPart( 'models/cube.json', 0, 3, 3 );
	violin.addPart( 'models/cube.json', 0, 0, 3 );
	violin.addPart( 'models/cube.json', 3, 0, 3 );
	violin.addPart( 'models/cube.json', 3, 3, 3 );

	/*
	// create our objects [loop]
	var geometry, material, object;
	var position, target, tween;
	for (var i=0;i<numObjects;i++)
	{
		geometry = new THREE.BoxGeometry( 1, 1, 1 );
		material = new THREE.MeshLambertMaterial( { color: getRandomColor() } );
		objects[i] = new THREE.Mesh( geometry, material );
		scene.add( objects[i] );
		objects[i].position.set(i,i,0); // initial positions
	}
	*/

	//add renderer
	renderer = new THREE.WebGLRenderer();
	renderer.setSize( window.innerWidth, window.innerHeight );
	document.body.appendChild( renderer.domElement );

	// add fps stats
	container = document.createElement( 'div' );
	document.body.appendChild( container );
	stats = new Stats();
	stats.domElement.style.position = 'absolute';
	stats.domElement.style.top = '0px';
	container.appendChild( stats.domElement );

	// add OrbitControls so we can pan around with the mouse
	controls = new THREE.OrbitControls(camera, renderer.domElement);

}

function animate() {
	requestAnimationFrame( animate );
	render();
	stats.update();
}

function render() {
	for (i=0;i<violin.parts.length;i++) {
		if (violin.parts[i].mesh) { // wait until models are loaded in
			violin.parts[i].mesh.rotation.x += 0.01;
			violin.parts[i].mesh.rotation.y += 0.01;
		}
	}

	// update the picking ray with the camera and mouse position	
	raycaster.setFromCamera( mouse, camera );	

	// move objects
	TWEEN.update();

	// calculate objects intersecting the picking ray
	intersects = raycaster.intersectObjects( scene.children );
	// mouse intersect objects actions
	if ( intersects.length > 0 ) {
		if ( intersectedMesh != intersects[ 0 ].object ) {
			if ( intersectedMesh )
				intersectedMesh.material.emissive.setHex( intersectedMesh.currentHex );
			intersectedMesh = intersects[ 0 ].object;
			intersectedMesh.currentHex = intersectedMesh.material.emissive.getHex();
			intersectedMesh.material.emissive.setHex( 0x000000 );
		} else {
			if (mouseDown) {
				intersectedMesh.material.emissive.setHex( 0xffffff );
				console.log("merhaba");
			}
			else
				intersectedMesh.material.emissive.setHex( 0xff0000 );
		}
	} else {
		if ( intersectedMesh )
			intersectedMesh.material.emissive.setHex( intersectedMesh.currentHex );
		intersectedMesh = null;
	}

	// render scene
	renderer.render( scene, camera );
}

function getRandomColor() {
	var letters = '0123456789ABCDEF'.split( '' );
	var color = '#';
	for ( var i = 0; i < 6; i++ ) {
		color += letters[ Math.floor( Math.random() * 16 ) ];
	}
	return color;
}	

function startTween() {
	for (var i=0;i<tweens.length;i++)
	{
		tweens[i].start();
		currentTweens ++;
	}
}

function setupTween(stretch){
	// setup tweening for our array
	for (var i=0;i<violin.parts.length;i++)
	{
		(function(e) { //wrapping in an anonymous function because of the callback http://stackoverflow.com/questions/4466098/pass-in-local-variable-to-callback-function
			var objx = violin.parts[e].mesh.position.x;
			var objy = violin.parts[e].mesh.position.y;
			var objz = violin.parts[e].mesh.position.z;
			var position = { x:objx, y:objy, z:objz };
			var target = { x:stretch*objx, y:stretch*objy, z:stretch*objz };
			var tween = new TWEEN.Tween(position).to(target, 2000);
			tweens[e] = tween;
			tweens[e].onUpdate(function(){ //callback
				violin.parts[e].mesh.position.x = position.x;
				violin.parts[e].mesh.position.y = position.y;
				violin.parts[e].mesh.position.z = position.z;
			});
			tweens[e].onComplete(function(){
				currentTweens --;
			});
		})(i);
	}
}

function onMouseMove( event ) {
	// calculate mouse position in normalized device coordinates
	// (-1 to +1) for both components
	mouse.x = ( event.clientX / window.innerWidth ) * 2 - 1;
	mouse.y = - ( event.clientY / window.innerHeight ) * 2 + 1;		
}

function onWindowResize( event ) {
	// create an event listener that resizes the renderer with the browser window
	renderer.setSize(window.innerWidth, window.innerHeight);
	camera.aspect = window.innerWidth / window.innerHeight;
	camera.updateProjectionMatrix();
}

function onMouseDown( event ) {
	mouseDown = true;
}

function onMouseUp( event ) {
	mouseDown = false;
}
