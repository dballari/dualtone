<?php
/**
 * This file adds functions to the DualTone WordPress theme.
 *
 * @package DualTone
 * @author  David Ballarin Prunera
 * @license GNU General Public License v2
 * @link    https://ballarinconsulting.com/dualtone
 */


/**
 * Include required files from inc folder
 */
require_once 'inc/theme/class-dualtone-theme.php';
require_once 'inc/settings/class-dualtone-settings.php';
require_once 'inc/data/block-style-variations.php';
require_once 'inc/data/custom-template-areas.php';
require_once 'inc/data/scripts.php';
require_once 'inc/data/theme-pattern-categories.php';

$styles = ['style.css'];

/**
 * Add theme development utilities
 */
if( defined( "DT_HIGHLIGHT_PARTS") ) {
    if( WP_DEVELOPMENT_MODE == 'theme' && DT_HIGHLIGHT_PARTS ) {
        add_filter( 'body_class','dualtone_highlight_parts' );
        $styles = ['style.css', 'style-debug.css'];
    }
}
function dualtone_highlight_parts( $classes ) {
    $classes[] = 'highlight-parts';
    return $classes;
}
if ( defined( "WP_ENVIRONMENT_TYPE" ) ) {
    if( WP_ENVIRONMENT_TYPE =='demo' || WP_ENVIRONMENT_TYPE =='local' ) {
        add_filter( 'body_class', function( $classes ) {
            $classes[] = 'demo';
            return $classes;
        });
    }
}


/**
 * Creates an instance of the DualTone_Theme class
 */
$dualtone_theme = new DualTone_Theme(
    [
        'textdomain' => 'dualtone',
        'styles' => $styles,
        'editor_styles' => ['style.css', 'style-editor.css'],
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
    $settings_page = new DualTone_Settings( 'dualtone' );
}
