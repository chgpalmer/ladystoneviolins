$('#expand').click(function(){
	if (currentTweens == 0 && expand == false) {
		setupTween(stretch);
		startTween();
		expand = true;
	}
});

$('#contract').click(function(){
	if (currentTweens == 0 && expand == true) {
		setupTween(1/stretch);
		startTween();
		expand = false;
	}
});
