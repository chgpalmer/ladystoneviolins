$('#expand').click(function(){
	if ( currentTweens == 0 && violin.state != 'expand' ) {
		violin.setupTween(stretch);
		startTween();
		violin.state = 'expand';
	}
});

$('#contract').click(function(){
	if ( currentTweens == 0 && violin.state != 'collapse' ) {
		violin.setupTween(1/stretch);
		startTween();
		violin.state = 'collapse';
	}
});
