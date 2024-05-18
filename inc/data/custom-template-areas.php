<?php

/**
 * DualTone WordPress theme custom template areas
 * https://developer.wordpress.org/themes/templates/template-parts/#registering-custom-areas
 * 
 * Appart from these areas there are the default ones: footer, header and uncategorized (General)
 *
 * @package	DualTone Theme Data
 * @author	David Ballarin Prunera
 * @license	GNU General Public License v2
 * @link	https://ballarinconsulting.com/themes
 */

 $areas = [
    [
        'area' => 'sidebar',
        'area_tag' => 'aside',
        'label' => __( 'Sidebar', 'dualtone' ),
        'description' => __( 'Secondary area where logo, site title and navigation could be moved to on a multiple column layout page.',
            'dualtone' ),
        'icon' => 'sidebar'
    ],
    [
        'area' => 'loop',
        'area_tag' => 'main',
        'label' => __( 'Loop', 'dualtone' ),
        'description' => __( 'Area with a loop of posts in the index or an archive tempate', 'dualtone' ),
        'icon' => 'sidebar'
    ],
    [
        'area' => 'title',
        'area_tag' => 'header',
        'label' => __( 'Title', 'dualtone' ),
        'description' => __( 'The title defines the place where the page title may be placed.', 'dualtone' ),
        'icon' => 'sidebar'
    ],
    [
        'area' => 'message',
        'area_tag' => 'section',
        'label' => __( 'Message', 'dualtone' ),
        'description' => __( 'Area where the Error 404 message is displayed', 'dualtone' ),
        'icon' => 'sidebar'
    ]
];
