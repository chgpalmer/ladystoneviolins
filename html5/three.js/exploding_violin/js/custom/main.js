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
	camera.position.z = 10;
	scene = new THREE.Scene();

	// create lighting sources
	var lightAmbient = new THREE.AmbientLight( 0xffffff );
	lightAmbient.position.set(-100,200,100 );
	scene.add( lightAmbient );
	var lightPoint = new THREE.PointLight( 0xffffff );
	lightPoint.position.set(-100,200,100 );
	scene.add( lightPoint );

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
	for (i=0;i<objects.length;i++) {
		objects[i].rotation.x += 0.01;
		objects[i].rotation.y += 0.01;
	}

	// update the picking ray with the camera and mouse position	
	raycaster.setFromCamera( mouse, camera );	

	// move objects
	TWEEN.update();
	// render scene
	renderer.render( scene, camera );

	// calculate objects intersecting the picking ray
	intersects = raycaster.intersectObjects( scene.children );

	// mouse intersect objects actions
	if ( intersects.length > 0 ) {
		if ( intersectedMesh != intersects[ 0 ].object ) {
			if ( intersectedMesh )
				intersectedMesh.material.emissive.setHex( intersectedMesh.currentHex );
			intersectedMesh = intersects[ 0 ].object;
			intersectedMesh.currentHex = intersectedMesh.material.emissive.getHex();
			intersectedMesh.material.emissive.setHex( 0xff0000 );
		} else {
			if (mouseDown) {
				intersectedMesh.material.emissive.setHex( 0x00ff00 );
				alert("penis");
			}
			else
				intersectedMesh.material.emissive.setHex( 0xff0000 );
		}
	} else {
		if ( intersectedMesh )
			intersectedMesh.material.emissive.setHex( intersectedMesh.currentHex );
		intersectedMesh = null;
	}
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
	for (var i=0;i<objects.length;i++)
	{
		(function(e) { //wrapping in an anonymous function because of the callback http://stackoverflow.com/questions/4466098/pass-in-local-variable-to-callback-function
			var objx = objects[e].position.x;
			var objy = objects[e].position.y;
			var position = { x:objx, y:objy };
			var target = { x:stretch*objx, y:stretch*objy };
			var tween = new TWEEN.Tween(position).to(target, 2000);
			tweens[e] = tween;
			tweens[e].onUpdate(function(){ //callback
				objects[e].position.x = position.x;
				objects[e].position.y = position.y;
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
