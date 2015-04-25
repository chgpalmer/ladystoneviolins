var Violin = function () {
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
		if (this.bounds.x > x) this.bounds.x = x;
		if (this.bounds.y > y) this.bounds.y = y;
		if (this.bounds.z > z) this.bounds.z = z;
		if (this.bounds.X < x) this.bounds.X = x;
		if (this.bounds.Y < y) this.bounds.Y = y;
		if (this.bounds.Z < z) this.bounds.Z = z;
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
};
