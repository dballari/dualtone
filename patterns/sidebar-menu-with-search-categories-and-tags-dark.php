<?php
/**
 * Title: Sidebar demo menu dark
 * Slug: dualtone/sidebar-menu-with-search-categories-and-tags-dark
 * Categories: header
 * Block Types: core/template-part/header
 * Viewport Width: 260
 * Inserter: no
 */
?>
<!-- wp:group {"tagName":"aside","metadata":{"name":"header-wrap"},"style":{"position":{"type":""}},"layout":{"type":"constrained"}} -->
<aside class="wp-block-group"><!-- wp:group {"layout":{"type":"flex","flexWrap":"wrap","justifyContent":"center"}} -->
<div class="wp-block-group">
<!-- wp:image {"align":"center","width":40,"height":40,"sizeSlug":"full","linkDestination":"custom"} -->
<figure class="wp-block-image aligncenter size-full is-resized"><a href="#"><img src="<?php echo esc_url( get_template_directory_uri() ) . '/assets/images/dualtone-logo-futuristicdark.svg'; ?>" alt="DualTone site logo" width="40" height="40"/></a></figure>
<!-- /wp:image -->
<!-- wp:site-title {"fontSize":"large"} /--></div>
<!-- /wp:group -->

<!-- wp:group {"metadata":{"name":"navigation-wrap"},"style":{"spacing":{"padding":{"top":"var:preset|spacing|050"}}},"layout":{"type":"default"}} -->
<div class="wp-block-group" style="padding-top:var(--wp--preset--spacing--050)">
    <!-- wp:navigation {"hasIcon":false,"className":"is-style-sidebar-navigation","layout":{"type":"flex","orientation":"vertical","justifyContent":"left"},"style":{"spacing":{"blockGap":"var:preset|spacing|050"}}} -->
        <!-- wp:navigation-link {"label":"<?php esc_html_e( 'About', 'dualtone' ); ?>","url":"#"} /-->
        <!-- wp:navigation-link {"label":"<?php esc_html_e( 'Services', 'dualtone' ); ?>","url":"#"} /-->
        <!-- wp:navigation-link {"label":"<?php esc_html_e( 'Contact', 'dualtone' ); ?>","url":"#"} /-->
        <!-- wp:navigation-link {"label":"<?php esc_html_e( 'Privacy', 'dualtone' ); ?>","url":"#"} /-->

        <!-- wp:spacer {"height":"0px","style":{"layout":{"flexSize":"8px","selfStretch":"fixed"}}} -->
        <div style="height:0px" aria-hidden="true" class="wp-block-spacer"></div>
        <!-- /wp:spacer -->

        <!-- wp:search {"showLabel":false,"placeholder":"<?php esc_html_e( 'type to find ...', 'dualtone' ); ?>","widthUnit":"%","buttonText":"Search","buttonPosition":"button-inside","buttonUseIcon":true,"style":{"layout":{"selfStretch":"fit","flexSize":null}}} /-->

        <!-- wp:spacer {"height":"0px","style":{"layout":{"flexSize":"8px","selfStretch":"fixed"}}} -->
        <div style="height:0px" aria-hidden="true" class="wp-block-spacer"></div>
        <!-- /wp:spacer -->

        <!-- wp:navigation-link {"label":"<?php esc_html_e( 'Categories', 'dualtone' ); ?>","url":"##","className":"menu-section"} /-->
        <!-- wp:navigation-link {"label":"<?php esc_html_e( 'Marketing online', 'dualtone' ); ?>","url":"#","className":"is-item-secondary"} /-->
        <!-- wp:navigation-link {"label":"<?php esc_html_e( 'Productivity tips', 'dualtone' ); ?>","url":"#","className":"is-item-secondary"} /-->
        <!-- wp:navigation-link {"label":"<?php esc_html_e( 'Web design', 'dualtone' ); ?>","url":"#","className":"is-item-secondary"} /-->

        <!-- wp:spacer {"height":"0px","style":{"layout":{"flexSize":"8px","selfStretch":"fixed"}}} -->
        <div style="height:0px" aria-hidden="true" class="wp-block-spacer"></div>
        <!-- /wp:spacer -->
        
        <!-- wp:navigation-link {"label":"<?php esc_html_e( 'Tags', 'dualtone' ); ?>","url":"##","className":"menu-section"} /-->
        <!-- wp:navigation-link {"label":"<?php esc_html_e( 'WordPress', 'dualtone' ); ?>","url":"#","className":"is-item-secondary"} /-->
        <!-- wp:navigation-link {"label":"<?php esc_html_e( 'Gutenberg', 'dualtone' ); ?>","url":"#","className":"is-item-secondary"} /-->
        <!-- wp:navigation-link {"label":"<?php esc_html_e( 'Patterns', 'dualtone' ); ?>","url":"#","className":"is-item-secondary"} /-->

        <!-- wp:spacer {"height":"0px","style":{"layout":{"flexSize":"8px","selfStretch":"fixed"}}} -->
        <div style="height:0px" aria-hidden="true" class="wp-block-spacer"></div>
        <!-- /wp:spacer -->

        <!-- wp:navigation-link {"label":"<?php esc_html_e( 'Error 404', 'dualtone' ); ?>","url":"/lalala"} /-->
    <!-- /wp:navigation -->
</div>
<!-- /wp:group --></aside>
<!-- /wp:group -->