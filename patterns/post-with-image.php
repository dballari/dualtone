<?php
/**
 * Title: Post with image
 * Slug: dualtone/post-with-image
 * Categories: dualtone_page
 * Keywords: starter
 * Block Types: core/post-content
 * Post Types: page, post
 */
?>
<!-- wp:image {"lightbox":{"enabled":true},"id":109,"sizeSlug":"large","linkDestination":"none","style":{"color":[]},"className":"is-style-default"} -->
<figure class="wp-block-image size-large is-style-default"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/images/29577251796_38fd07f97f_k_scaled.webp') ); ?>" alt="example image" class="wp-image-109"/><figcaption class="wp-element-caption">This is an image caption</figcaption></figure>
<!-- /wp:image -->

<!-- wp:paragraph -->
<p><?php esc_html_e( 'The DualTone theme is a two column sidebar content layout, that\'s why you can\'t use wide and full alignments on posts or pages that use the default layout.', 'dualtone' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p><?php esc_html_e( 'On the other hand, you can make a picture expand by choosing the \'expand on click\' option of the link toobar button.', 'dualtone' ); ?></p>
<!-- /wp:paragraph -->