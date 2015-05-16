// Mobile - Off Canvas Menu
function toggleMenu(){
    if ( $( '#page' ).hasClass( 'nav-expand' ) ) 
        $( '#page' ).removeClass( 'nav-expand' );
    else
        $( '#page' ).addClass( 'nav-expand' );
};
// Menu button press
$( '#menu-toggle' ).click( function(){
	toggleMenu();
} );
// Page swipe
Hammer( document.body ).on("swipe", function() {
	toggleMenu();
});


// Desktop - nav-shrinking Navbar 
// http://stackoverflow.com/questions/24765155/nav-shrinking-navigation-bar-when-scrolling-down-bootstrap3
$( window ).scroll( function() {
    if ( $( document ).scrollTop() > $( '#site-header' ).outerHeight() ) 
        $( '#page' ).addClass( 'nav-shrink' );
    else
        $( '#page' ).removeClass( 'nav-shrink' );
} );

