<?php
/**
 * Functions file
 * @package Ladystoneviolins
 */


register_nav_menu( 'primary', __( 'Primary Menu', 'ladystoneviolins' ) );

// https://css-tricks.com/snippets/wordpress/move-wordpress-admin-bar-to-the-bottom/
function fb_move_admin_bar() {
    echo '
    <style type="text/css">
    body {
    margin-top: -28px;
    padding-bottom: 28px;
    }
    body.admin-bar #wphead {
       padding-top: 0;
    }
    body.admin-bar #footer {
       padding-bottom: 28px;
    }
    #wpadminbar {
        top: auto !important;
        bottom: 0;
    }
    #wpadminbar .quicklinks .menupop ul {
        bottom: 28px;
    }
    </style>';
}
// on frontend area
add_action( 'wp_head', 'fb_move_admin_bar' );

?>
