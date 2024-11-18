<?php
/**
 * Title: Sidebar menu with buttons dark
 * Slug: dualtone/sidebar-menu-with-buttons-dark
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
        <!-- wp:navigation-link {"label":"<?php esc_html_e( 'Typography', 'dualtone' ); ?>","url":"#"} /-->
        <!-- wp:navigation-link {"label":"<?php esc_html_e( 'Colors', 'dualtone' ); ?>","url":"#"} /-->
        <!-- wp:navigation-link {"label":"<?php esc_html_e( 'Spacings', 'dualtone' ); ?>","url":"#"} /-->

        <!-- wp:spacer {"height":"0px","style":{"layout":{"flexSize":"8px","selfStretch":"fixed"}}} -->
        <div style="height:0px" aria-hidden="true" class="wp-block-spacer"></div>
        <!-- /wp:spacer -->

        <!-- wp:navigation-link {"label":"<?php esc_html_e( 'Patterns', 'dualtone' ); ?>","url":"#"} /-->
        <!-- wp:navigation-link {"label":"<?php esc_html_e( 'Styles', 'dualtone' ); ?>","url":"#"} /-->
        <!-- wp:navigation-link {"label":"<?php esc_html_e( 'Toole', 'dualtone' ); ?>","url":"#"} /-->
        <!-- wp:navigation-link {"label":"<?php esc_html_e( 'Privacy', 'dualtone' ); ?>","url":"#"} /-->

        <!-- wp:spacer {"height":"0px","style":{"layout":{"flexSize":"8px","selfStretch":"fixed"}}} -->
        <div style="height:0px" aria-hidden="true" class="wp-block-spacer"></div>
        <!-- /wp:spacer -->

        <!-- wp:buttons {"layout":{"type":"flex","justifyContent":"left"}} -->
            <div class="wp-block-buttons"><!-- wp:button {"width":75,"style":{"typography":{"fontStyle":"normal","fontWeight":"300"}},"fontSize":"small"} -->
            <div class="wp-block-button has-custom-width wp-block-button__width-75 has-custom-font-size has-small-font-size" style="font-style:normal;font-weight:300"><a class="wp-block-button__link wp-element-button">Contact</a></div>
            <!-- /wp:button -->

            <!-- wp:button {"width":75,"style":{"typography":{"fontStyle":"normal","fontWeight":"300"}},"className":"is-style-accent","fontSize":"small"} -->
            <div class="wp-block-button has-custom-width wp-block-button__width-75 has-custom-font-size is-style-accent has-small-font-size" style="font-style:normal;font-weight:300"><a class="wp-block-button__link wp-element-button">Download</a></div>
            <!-- /wp:button --></div>
        <!-- /wp:buttons -->
    <!-- /wp:navigation -->
</div>
<!-- /wp:group --></aside>
<!-- /wp:group -->