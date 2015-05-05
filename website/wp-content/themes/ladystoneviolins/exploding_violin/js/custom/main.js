// Point of entry

// global(?) variables
var scene, camera, renderer;
var tweens = new Array();
var stats;
var currentTweens = 0;
var expand = false;
var radius = 100, theta = 0;
var stretch = 1.8;

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
	violin.addPart( currentPath + '/exploding_violin/models/cube.json', -1, -1, -1 );
	violin.addPart( currentPath + '/exploding_violin/models/cube.json', 1, -1, -1 );
	violin.addPart( currentPath + '/exploding_violin/models/cube.json', 1, 1, -1 );
	violin.addPart( currentPath + '/exploding_violin/models/cube.json', -1, 1, -1 );
	violin.addPart( currentPath + '/exploding_violin/models/cube.json', -1, 1, 1 );
	violin.addPart( currentPath + '/exploding_violin/models/cube.json', -1, -1, 1 );
	violin.addPart( currentPath + '/exploding_violin/models/cube.json', 10, -1, 1 );

	// position camera relative to violin
	var e = 10*Math.atan(violin.maxDist/2)
	camera.position.set( e, e, e );

	//add renderer
	var container = document.getElementById("site-content").getElementsByClassName( 'wrapper' )[0];
	renderer = new THREE.WebGLRenderer({ alpha: true });
	renderer.setSize( container.clientWidth-20, (container.clientWidth-20)/2 );
	renderer.setClearColor( 0xffffff, 1);
	container.appendChild( renderer.domElement );
	//document.body.appendChild( renderer.domElement );

/*
	// add fps stats
	stats = new Stats();
	stats.domElement.style.position = 'absolute';
	stats.domElement.style.top = '0px';
	container.appendChild( stats.domElement );
*/

	// add OrbitControls so we can pan around with the mouse
	//controls = new THREE.OrbitControls(camera, renderer.domElement);
	//controls.noZoom = true;

}

function animate() {
	requestAnimationFrame( animate );
	render();
	stats.update();
}

function render() {
  	// orbit camera around (0,0,0)
	if( violin.focus === true ) {
		camera.lookAt( violin.focusedPart.mesh.position );
		var origin = new THREE.Vector3 ( 0, 0, 0 );
		var target = { x:violin.focusedPart.mesh.position.x, y:violin.focusedPart.mesh.position.x, z:violin.focusedPart.mesh.position.x };
		var tween = new TWEEN.Tween( origin ).to( target, 200 );
		tween.onUpdate( function(){
			camera.lookAt( origin );
		});
		tween.start();
	} else {
		if( !mouseDown ) orbit( camera );
		camera.lookAt( new THREE.Vector3 ( 0.0, 0.0, 0.0 ) );
	}


	// update the picking ray with the camera and mouse position	
	raycaster.setFromCamera( mouse, camera );	

	// move objects
	TWEEN.update();

	// calculate objects intersecting the picking ray
	intersects = raycaster.intersectObjects( scene.children );
	// mouse intersect objects actions
	if( intersects.length > 0 ) {
		if( intersectedMesh != intersects[ 0 ].object ) {
			if( intersectedMesh )
				intersectedMesh.material.emissive.setHex( intersectedMesh.currentHex );
			intersectedMesh = intersects[ 0 ].object;
			intersectedMesh.currentHex = intersectedMesh.material.emissive.getHex();
			intersectedMesh.material.emissive.setHex( 0x000000 );
		} else {
			if(mouseDown) {
				violin.uuidToPart( intersectedMesh.uuid ).focus = true;
				violin.focusOnPart( intersectedMesh.uuid );
				intersectedMesh.material.emissive.setHex( 0x0000ff );
			}
			else
				intersectedMesh.material.emissive.setHex( 0xff0000 );
		}
	} else {
		if( intersectedMesh ) {
			violin.uuidToPart( intersectedMesh.uuid ).focus = false;
			intersectedMesh.material.emissive.setHex( intersectedMesh.currentHex );
		}
		intersectedMesh = null;
		violin.defocusAll();
	}

	violin.checkFocus();

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

function onMouseMove( event ) {
	// calculate mouse position in normalized device coordinates
	// (-1 to +1) for both components
	mouse.x = ( event.clientX / window.innerWidth ) * 2 - 1;
	mouse.y = - ( event.clientY / window.innerHeight ) * 2 + 1;		
}

function onWindowResize( event ) {
	// create an event listener self resizes the renderer with the browser window
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

function orbit( camera, angle ) {
	var origin = {
		x	: 0,
		y	: 0,
	}
	var radius = Math.sqrt( Math.sqrt(Math.pow(camera.position.x,2)+Math.pow(camera.position.y,2)) + Math.pow(camera.position.z,2) );
	var angle = Math.atan( camera.position.y / camera.position.x );
	var newAngle = angle + 0.01;


	camera.position.setX( radius * Math.cos( newAngle ) );
	camera.position.setY( radius * Math.sin( newAngle ) );



}
