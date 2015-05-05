var Part = function ( url, x, y, z ) {
	var self = this;
	this.focus = false;
	this.mesh;

	var loader = new THREE.JSONLoader();
	loader.load( url, function(geometry){
			var material = new THREE.MeshLambertMaterial({color: 0x98652B});
			var mesh = new THREE.Mesh(geometry, material);
			mesh.position.set( x, y, z );
			self.mesh = mesh;
			scene.add(self.mesh);
	});


};
