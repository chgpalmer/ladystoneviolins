var Violin = function () {
	var self = this;
	this.state = 'collapse';
	this.parts = [];
	this.bounds = {
		x	: 0,
		y	: 0,
		z	: 0,
		X	: 0,
		Y	: 0,
		Z	: 0,
	};
	this.maxDist = 0;
	this.focusedPart = null;
	this.focus = false;

	Violin.prototype.changeState = function ( state ) {
		this.state = state;
	}

	Violin.prototype.addPart = function ( url, x, y, z ) {
		var part = new Part( url, x, y, z);
		this.parts.push( part );
		this.updateMinMax( x, y, z );
		this.updateMaxDist();
	};

	Violin.prototype.updateMinMax = function( x, y, z ) {
		if(this.bounds.x > x) this.bounds.x = x;
		if(this.bounds.y > y) this.bounds.y = y;
		if(this.bounds.z > z) this.bounds.z = z;
		if(this.bounds.X < x) this.bounds.X = x;
		if(this.bounds.Y < y) this.bounds.Y = y;
		if(this.bounds.Z < z) this.bounds.Z = z;
	};
	Violin.prototype.updateMaxDist = function() {
		var max = 0;
		var min = 0;
		for( var k in this.bounds ) {
			if( this.bounds[k] > max ) max = this.bounds[k];
			if( this.bounds[k] < min ) min = this.bounds[k];
		}
		this.maxDist = max - min;
	};

	Violin.prototype.setupTween = function ( stretch ){
		// setup tweening for our array
		for ( var i = 0; i < this.parts.length; i++ )
		{
			( function( e ) { //wrapping in an anonymous function because of the callback http://stackoverflow.com/questions/4466098/pass-in-local-variable-to-callback-function
				var objx = self.parts[e].mesh.position.x;
				var objy = self.parts[e].mesh.position.y;
				var objz = self.parts[e].mesh.position.z;
				var position = { x:objx, y:objy, z:objz };
				var target = { x:stretch*objx, y:stretch*objy, z:stretch*objz };
				var tween = new TWEEN.Tween( position ).to( target, 2000 );
				tweens[e] = tween;
				tweens[e].onUpdate( function(){ //callback
					self.parts[e].mesh.position.x = position.x;
					self.parts[e].mesh.position.y = position.y;
					self.parts[e].mesh.position.z = position.z;
				});
				tweens[e].onComplete( function(){
					currentTweens --;
				});
			})(i);
		}
	};

	Violin.prototype.uuidToPart = function( uuid ){
		for( var i = 0; i < this.parts.length; i++ )
			if( this.parts[i].mesh.uuid === uuid )
				return this.parts[i];
	};

	Violin.prototype.checkFocus = function(){
		for( var i = 0; i < this.parts.length; i++ )
			if( this.parts[i].focus === true )
				console.log(true);
	};

	Violin.prototype.defocusAll = function(){
		for( var i = 0; i < this.parts.length; i++ )
			if( this.parts[i].focus === true )
				this.parts[i].focus = false;
	};

	Violin.prototype.focusOnPart = function( uuid ){
		this.focus = true;
		this.focusedPart = this.uuidToPart( uuid );

		// tween camera from whereever it is to zoom in on the part.	
		var position = { x:camera.position.x, y:camera.position.y, z:camera.position.z };
		var e = 10*Math.atan(violin.maxDist/2)
		var target = { x:this.focusedPart.mesh.position.x + e, y:this.focusedPart.mesh.position.x + e, z:this.focusedPart.mesh.position.x + e };
		var tween = new TWEEN.Tween( position ).to( target, 2000 );
		tween.onUpdate( function(){
			camera.position.x = position.x;
			camera.position.y = position.y;
			camera.position.z = position.z;
		});
		tween.onComplete( function(){
			currentTweens --;
		});
		tween.start();
		currentTweens ++;
	}
};


