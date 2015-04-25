$('#expand').click(function(){
	if (currentTweens == 0 && expand == false) {
		setupTween(4);
		startTween();
		expand = true;
	}
});

$('#contract').click(function(){
	if (currentTweens == 0 && expand == true) {
		setupTween(1/4);
		startTween();
		expand = false;
	}
});
