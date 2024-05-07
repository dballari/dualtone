<?php

require_once 'inc/class.theme-settings.php';
require_once 'inc/class.theme.php';
require_once 'inc/data/block-style-variations.php';
require_once 'inc/data/custom-areas.php';
require_once 'inc/data/scripts.php';
require_once 'inc/data/theme-pattern-categories.php';

$textdomain = 'dualtone';

$theme = new DualToneTheme(
    [
        'textdomain' => $textdomain, 
        // text domain
        
        'theme_supports' => [],
        // array of theme supports for instance ['wp-block-styles']
        // do not include the feature 'editor-style' here (see editor-style parameter)
        
        'custom_block_styles_folder' => '/assets/css',
        // folder for custom block styles leave '' if none are added
        
        'style' => '/style.css',
        // theme style, default value is ''
        
        'scripts' => $scripts,
        // array $src $deps leave empty [] if no script needs to be enqueued
        
        'editor_style' => 'style.css',
        // editor style leave '' if no style needs to be enqueued in the editor
        // if an style is added then the feature 'editor-style' is added here (not in theme_supports)
        
        'variations' => $variations,
        // array of block style variations leave empty [] if none are added

        'areas' => $areas,
        // Custom template areas to register
        
        //'pattern_categories' => $categories,
        // array of pattern categories to register leave empty [] if none are added
        
        //'excerpt_more' => '',
        // modifies excerpt more or removes it if left empty '', default value ''
        
        //'load_text_domain' => false
        // wheater or not should load textdomain
    ]
);

if( is_admin() ) {
    $settings_page = new DualToneSettingsPage(
        $textdomain
    );
}

/**
 * Adds dualtine body class to differentiate frontend
 * Used in Structure section of style.css
 */
add_filter( 'body_class', function($classes) {
    $classes[] = 'dualtone';
    return $classes;
} );

if(WP_DEVELOPMENT_MODE == 'theme' && DT_HIGHLIGHT_PARTS) {
    add_filter( 'body_class','highlight_parts' );
}

function highlight_parts( $classes ) {
    $classes[] = 'highlight-parts';
    return $classes;
}

add_filter( 'option_blogdescription', function( $value ){
    if ( false && $value ) {
        $value = str_replace('for creators', '<span class="dt-emphasise">for creators</span>', $value);
    }
    return $value;
}, 10, 1);
