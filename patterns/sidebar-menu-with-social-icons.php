<?php
/**
 * Title: Menu with ssocial icons
 * Slug: dualtone/sidebar-menu-with-social-icons
 * Categories: sidebar
 */
?>
<!-- wp:group {"tagName":"aside","metadata":{"name":"header-wrap"},"style":{"position":{"type":""}},"layout":{"type":"constrained"}} -->
<aside class="wp-block-group"><!-- wp:group {"layout":{"type":"flex","flexWrap":"wrap","justifyContent":"center"}} -->
<div class="wp-block-group"><!-- wp:site-logo {"width":60,"shouldSyncIcon":false} /-->

<!-- wp:site-title {"fontSize":"large"} /--></div>
<!-- /wp:group -->

<!-- wp:group {"metadata":{"name":"navigation-wrap"},"style":{"spacing":{"padding":{"top":"var:preset|spacing|050"}}},"layout":{"type":"default"}} -->
<div class="wp-block-group" style="padding-top:var(--wp--preset--spacing--050)">
    <!-- wp:navigation {"hasIcon":false,"className":"is-style-sidebar-navigation","layout":{"type":"flex","orientation":"vertical","justifyContent":"left"},"style":{"spacing":{"blockGap":"var:preset|spacing|050"}}} -->
        
        <!-- wp:navigation-link {"label":"<?php esc_html_e( 'About', 'dualtone' ); ?>","url":"#"} /-->
        <!-- wp:navigation-link {"label":"<?php esc_html_e( 'Typography', 'dualtone' ); ?>","url":"#"} /-->
        <!-- wp:navigation-link {"label":"<?php esc_html_e( 'Colors', 'dualtone' ); ?>","url":"#"} /-->
        <!-- wp:navigation-link {"label":"<?php esc_html_e( 'Spacings', 'dualtone' ); ?>","url":"#"} /-->

        <!-- wp:spacer {"width":"0px","style":{"layout":{"flexSize":"8px","selfStretch":"fixed"}}} -->
        <div style="height:100px;width:0px" aria-hidden="true" class="wp-block-spacer"></div>
        <!-- /wp:spacer -->

        <!-- wp:navigation-link {"label":"<?php esc_html_e( 'Patterns', 'dualtone' ); ?>","url":"#"} /-->
        <!-- wp:navigation-link {"label":"<?php esc_html_e( 'Styles', 'dualtone' ); ?>","url":"#"} /-->
        <!-- wp:navigation-link {"label":"<?php esc_html_e( 'Tools', 'dualtone' ); ?>","url":"#"} /-->

        <!-- wp:spacer {"width":"0px","style":{"layout":{"flexSize":"8px","selfStretch":"fixed"}}} -->
        <div style="height:100px;width:0px" aria-hidden="true" class="wp-block-spacer"></div>
        <!-- /wp:spacer -->

        <!-- wp:social-links -->
        <ul class="wp-block-social-links">
            <!-- wp:social-link {"url":"#","service":"wordpress"} /-->
            <!-- wp:social-link {"url":"#","service":"github"} /-->
            <!-- wp:social-link {"url":"#","service":"linkedin"} /-->
        </ul>
        <!-- /wp:social-links -->

    <!-- /wp:navigation -->
</div>
<!-- /wp:group --></aside>
<!-- /wp:group -->