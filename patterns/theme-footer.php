<?php
/**
 * Title: Footer
 * Slug: dualtone/theme-footer
 * Inserter: no
 */
?>
<!-- wp:group {"className":"is-style-section-1","style":{"spacing":{"blockGap":"0"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group is-style-section-1"><!-- wp:cover {"dimRatio":0,"isUserOverlayColor":true,"isDark":false,"align":"full","className":"is-style-variable-min-height","layout":{"type":"constrained"}} -->
<div class="wp-block-cover alignfull is-light is-style-variable-min-height" id="cta"><span aria-hidden="true" class="wp-block-cover__background has-background-dim-0 has-background-dim"></span><div class="wp-block-cover__inner-container"><!-- wp:paragraph {"align":"center","placeholder":"Write title…","fontSize":"medium"} -->
<p class="has-text-align-center has-medium-font-size"><?php esc_html_e('Join my list and get access to my content creation guide', 'dualtone');?></p>
<!-- /wp:paragraph -->

<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
<div class="wp-block-buttons"><!-- wp:button {"textAlign":"center","className":"is-style-fill"} -->
<div class="wp-block-button is-style-fill"><a class="wp-block-button__link has-text-align-center wp-element-button" href="#"><?php esc_html_e('yes, please!', 'dualtone');?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div></div>
<!-- /wp:cover -->

<!-- wp:group {"align":"full","className":"footer-credits","style":{"spacing":{"margin":{"top":"0%"},"padding":{"bottom":"var:preset|spacing|10"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull footer-credits" style="margin-top:0%;padding-bottom:var(--wp--preset--spacing--10)"><!-- wp:group {"align":"wide","style":{"spacing":{"padding":{"top":"var:preset|spacing|10","bottom":"var:preset|spacing|10","left":"var:preset|spacing|10","right":"var:preset|spacing|10"}}},"layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"space-between"}} -->
<div class="wp-block-group alignwide" style="padding-top:var(--wp--preset--spacing--10);padding-right:var(--wp--preset--spacing--10);padding-bottom:var(--wp--preset--spacing--10);padding-left:var(--wp--preset--spacing--10)"><!-- wp:paragraph {"fontSize":"small"} -->
<p class="has-small-font-size"><?php /* Translators: 1. is the start of a 'a' HTML element, 2. is the end of a 'a' HTML element, 3. is the start of a 'a' HTML element, 4. is the end of a 'a' HTML element, 5. is the start of a 'a' HTML element, 6. is the end of a 'a' HTML element */ 
echo sprintf( esc_html__( '© 2024 %1$sSome text here%2$s ·  Prowdly powered by %3$sWordPress%4$s · by Some More Text · %5$sPrivacy%6$s', 'dualtone' ), '<a href="' . esc_url( '#' ) . '">', '</a>', '<a href="' . esc_url( 'https://wordpress.org' ) . '">', '</a>', '<a href="' . esc_url( '#' ) . '">', '</a>' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"go-top-link","fontSize":"small"} -->
<p class="go-top-link has-small-font-size"><?php /* Translators: 1. is the start of a 'a' HTML element, 2. is the end of a 'a' HTML element */ 
echo sprintf( esc_html__( '%1$stop%2$s', 'dualtone' ), '<a href="' . esc_url( '#top' ) . '">', '</a>' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->