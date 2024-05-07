<?php
/**
 * This file adds functions to the DualTone WordPress theme.
 *
 * @package DualTone
 * @author  David Ballarin Prunera
 * @license GNU General Public License v2 or later
 * @link    https://ballarinconsulting.com/dualtone
 */

/**
 * Include required files from inc folder
 */
require_once 'inc/class-dualtone-theme.php';
require_once 'inc/class-dualtone-settings.php';
require_once 'inc/data/block-style-variations.php';
require_once 'inc/data/custom-template-areas.php';
require_once 'inc/data/scripts.php';
require_once 'inc/data/theme-pattern-categories.php';

/**
 * Textdomain to be used
 */
$textdomain = 'dualtone';

/**
 * Creates an instance of the DualTone_Theme class
 */
$dualtone_theme = new DualTone_Theme(
    [
        'textdomain' => '$textdomain',
        'style' => 'style.css',
        'editor_style' => 'style.css',
        'scripts' => $scripts,
        'variations' => $variations,
        'areas' => $areas,
        'pattern_categories' => $categories
    ]
    );

/**
 * Adds the theme settings page
 */
if( is_admin() ) {
    $settings_page = new DualTone_Settings(
        $textdomain
    );
    if( isset( $_GET['page'] ) && $_GET['page'] == 'dualtone' ) {
        add_filter( 'admin_footer_text', function($text) use ( $textdomain ) {
            return '<span id="footer-thankyou">' . $text . 
            __( ' And thank you for using the <a href="https://ballarinconsulting.com/dualtone">DualTone</a> theme.</span>', $textdomain );
        }, 10, 1 );
    }
}

if(WP_DEVELOPMENT_MODE == 'theme' && DT_HIGHLIGHT_PARTS) {
    add_filter( 'body_class','highlight_parts' );
}

function highlight_parts( $classes ) {
    $classes[] = 'highlight-parts';
    return $classes;
}
