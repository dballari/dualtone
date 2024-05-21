<?php
/**
 * Title: Post with image gallery
 * Slug: dualtone/post-with-image-gallery
 * Categories: dualtone_page
 * Keywords: starter
 * Block Types: core/post-content
 * Post Types: page, post
 */
?>
<!-- wp:gallery {"columns":2,"linkTo":"none"} -->
<figure class="wp-block-gallery has-nested-images columns-2 is-cropped"><!-- wp:image {"lightbox":{"enabled":true},"id":110,"sizeSlug":"large","linkDestination":"none","className":"is-style-rounded"} -->
<figure class="wp-block-image size-large is-style-rounded"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/images/IMG20210723175416.webp') ); ?>" alt="river in Ordesa" class="wp-image-110"/></figure>
<!-- /wp:image -->

<!-- wp:image {"lightbox":{"enabled":true},"id":111,"sizeSlug":"large","linkDestination":"none","className":"is-style-rounded"} -->
<figure class="wp-block-image size-large is-style-rounded"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/images/IMG20210720121117.webp') ); ?>" alt="panoramic view of the Pedraforca mountain" class="wp-image-111"/></figure>
<!-- /wp:image -->

<!-- wp:image {"lightbox":{"enabled":true},"id":109,"sizeSlug":"large","linkDestination":"none","style":{"color":{}}} -->
<figure class="wp-block-image size-large"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/images/29577251796_38fd07f97f_k_scaled.webp') ); ?>" alt="the great pyramid of Giza" class="wp-image-109"/></figure>
<!-- /wp:image --><figcaption class="blocks-gallery-caption wp-element-caption">Image Gallery Caption</figcaption></figure>
<!-- /wp:gallery -->

<!-- wp:paragraph -->
<p>When adding an image gallery, you may choose the number of columns of the gallery. And, for each image of the gallery, you may choose the styling options that all images have. In this gallery, for instance, the first two images have been chosen to be rounded.</p>
<!-- /wp:paragraph -->
