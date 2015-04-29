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

