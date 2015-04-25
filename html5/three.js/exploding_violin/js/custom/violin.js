var Violin = function () {
	this.state = 'collapse';
	this.parts = [];

	Violin.prototype.changeState = function ( state ) {
		this.state = state;
	}

	Violin.prototype.addPart = function ( url, x, y, z ) {
		var part = new Part( url, x, y, z);
		this.parts.push( part );
	};
};
