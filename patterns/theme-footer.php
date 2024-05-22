<?php
/**
 * Title: Footer
 * Slug: dualtone/theme-footer
 * Inserter: no
 */
$wordpress = 'https://wordpress.org';
$prowdly = sprintf( __( ' Prowdly powered by <a href="%s">WordPress</a>', 'dualtone'), $wordpress );
?>
<!-- wp:group {"style":{"spacing":{"blockGap":"0"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:cover {"overlayColor":"accent","isUserOverlayColor":true,"align":"full","className":"is-style-variable-min-height","layout":{"type":"constrained"}} -->
<div class="wp-block-cover alignfull is-style-variable-min-height" id="cta"><span aria-hidden="true" class="wp-block-cover__background has-accent-background-color has-background-dim-100 has-background-dim"></span><div class="wp-block-cover__inner-container"><!-- wp:paragraph {"align":"center","placeholder":"Write title…","textColor":"base","fontSize":"medium"} -->
<p class="has-text-align-center has-base-color has-text-color has-medium-font-size"><?php esc_html_e( 'Join my list and get access to my content creation guide', 'dualtone' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
<div class="wp-block-buttons"><!-- wp:button {"textAlign":"center","className":"is-style-dark"} -->
<div class="wp-block-button is-style-dark"><a href="#" class="wp-block-button__link has-text-align-center wp-element-button"><?php esc_html_e( 'yes, please!', 'dualtone' ); ?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div></div>
<!-- /wp:cover -->

<!-- wp:group {"align":"full","style":{"spacing":{"margin":{"top":"0%"},"padding":{"bottom":"var:preset|spacing|10"}}},"backgroundColor":"accent","className":"footer-credits","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull footer-credits has-accent-background-color has-background" style="margin-top:0%;padding-bottom:var(--wp--preset--spacing--10)"><!-- wp:group {"align":"wide","style":{"spacing":{"padding":{"top":"var:preset|spacing|10","bottom":"var:preset|spacing|10","left":"var:preset|spacing|10","right":"var:preset|spacing|10"}}},"layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"space-between"}} -->
<div class="wp-block-group alignwide" style="padding-top:var(--wp--preset--spacing--10);padding-right:var(--wp--preset--spacing--10);padding-bottom:var(--wp--preset--spacing--10);padding-left:var(--wp--preset--spacing--10)"><!-- wp:paragraph {"style":{"elements":{"link":{"color":{"text":"var:preset|color|base"}}}},"textColor":"base","fontSize":"small"} -->
<p class="has-base-color has-text-color has-link-color has-small-font-size">&copy; <?php echo date("Y"); ?> <a href="#">Some text here</a> · <?php echo $prowdly ?> · <?php esc_html_e( 'by', 'dualtone' ); ?> Some&nbsp;More&nbsp;Text · <a href="#"><?php esc_html_e( 'Privacy', 'dualtone' ); ?></a></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"elements":{"link":{"color":{"text":"var:preset|color|base"}}}},"textColor":"base","className":"go-top-link","fontSize":"small"} -->
<p class="go-top-link has-base-color has-text-color has-link-color has-small-font-size"><a href="#top"><?php esc_html_e( 'top', 'dualtone' ); ?></a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->
