//////////////////////////////////////////////////////
//	A template THREE.js scene for easy instancing
//	init is called some time on window.onload
//	it gets passed a setup, update, and (optional) render functions
//////////////////////////////////////////////////////

var scene, camera, renderer, update, container, renderStep;
var fov = 30;

function init( callback, updateFunction, renderFunction ){
	var _fov = fov;

	scene = new THREE.Scene();

	camera = new THREE.PerspectiveCamera( _fov, window.innerWidth / window.innerHeight, 1, 1000000 );
	scene.add(camera);

	renderer = new THREE.WebGLRenderer( {antialias: true} );
	renderer.setSize( window.innerWidth, window.innerHeight );

	container = document.getElementById('container');	
	if( container === undefined || container === null ){
		container = document.createElement('div');
		document.body.appendChild( container );
	}

	container.appendChild( renderer.domElement );

	container.style.position = 'absolute';
	container.style.zIndex = '-10';
	// container.style.top = '256px';

	if( container !== undefined )
		callback( scene, camera, renderer, container);

	update = updateFunction;
	renderStep = renderFunction;
	animate( renderStep );
}

function animate(){


	if( update !== undefined )
		update( renderer, camera, scene );

	if( renderStep !== undefined ){
		renderStep( scene, camera );
	}
	else{
		renderer.render( scene, camera );
	}	

	for( var i=0; i<markers.length; i++ ){
		markers[i].updateMarker();
	}
		
	requestAnimationFrame( animate );	
}

init();
animate();
