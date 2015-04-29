<!DOCTYPE html>
<html lang="en">
<head>

<meta name="viewport" content="width=device-width, initial-scale=1">

<style>

/*--------------------------------------------------------------
 General
--------------------------------------------------------------*/

* {
	box-sizing: border-box;
}
body {
	margin: 0;
}

#site-header {
	background: #fdd;
}
#site-content {
	background: #ddf;
	min-height: 250px;
}
#site-footer {
	height: 150px;
	background: #fdf;
}

/*--------------------------------------------------------------
 Navigational Menu
--------------------------------------------------------------*/

#page {
	position: relative;
	left: 0;
	-webkit-transition: all 1s;
	-moz-transition: all 1s ;
	-o-transition: all 1s ;
	transition: all 1s ;
}
#page.nav-expand {
	left: 100px;
}
#page #site-nav {
	position: absolute;
	width: 100px;
	height: 100%;
	left: -100px;
	top: 0px;
	background: #dfd;
}
#page.nav-expand #site-nav {
	position: absolute;
}

#menu-toggle {
	float: left;
}

/*--------------------------------------------------------------
 Media Queries
--------------------------------------------------------------*/

@media screen and (min-width: 768px) {
	/* General */
	header {
		height: 100px;
	}

	/* Navigational Menu */
	#page #site-nav, #page.nav-expand #site-nav {
		position: relative;
		width: 100%;
		height: 50px;
		left: 0px;
		transition: none;
	}
	#page, #page.nav-expand {
		left: 0px;
		transition: none;
	}
	#site-nav-toggle {
		display: none;
	}

	/* Shrinking Fixed Navigational Menu */
	#nav-push {
		height: 0px;
	}
	#page.nav-shrink #nav-push, #page.nav-shrink #site-nav {
		height: 40px;
	}
	#page.nav-shrink #site-nav {
		position: fixed;
		-webkit-transition: all 1s;
		-moz-transition: all 1s ;
		-o-transition: all 1s ;
		transition: all 1s ;
	}
	
}

</style>

<script>
</script>
</head>

<body>
	<div id="page">
		<header id="site-header">
			<div id="menu-toggle">
				<button id="site-nav-toggle">toggle</button>
			</div>
			<div>
				Ladystone violins
			</div>
		</header>
		<nav id="site-nav">
			menu
			li
			li
			li
		</nav>
		<div id="nav-push"></div>
		<div id="site-content">
			content
		</div>
		<footer id="site-footer">
			footer
		</footer>
	</div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script>
// Mobile - Off Canvas Menu
// http://dbushell.com/demos/viewport/menu1
$( '#menu-toggle' ).click( function(){
	if ( $( '#page' ).hasClass( 'nav-expand' ) )
		$( '#page' ).removeClass( 'nav-expand' );
	else
		$( '#page' ).addClass( 'nav-expand' );
} );

// Desktop - nav-shrinking Navbar 
// http://stackoverflow.com/questions/24765155/nav-shrinking-navigation-bar-when-scrolling-down-bootstrap3
$( window ).scroll( function() {
	if ( $( document ).scrollTop() > $( '#site-header' ).height() ) 
		$( '#page' ).addClass( 'nav-shrink' );
	else
		$( '#page' ).removeClass( 'nav-shrink' );
} );
</script>
</body>
