<?php
/**
 * Title: Post with video
 * Slug: dualtone/post-with-video
 * Categories: dualtone_page
 * Keywords: starter
 * Block Types: core/post-content
 * Post Types: page, post
 */
?>
<!-- wp:embed {"url":"https://www.youtube.com/watch?v=Cl_kXbhTi8k","type":"video","providerNameSlug":"youtube","responsive":true,"className":"wp-embed-aspect-16-9 wp-has-aspect-ratio"} -->
<figure class="wp-block-embed is-type-video is-provider-youtube wp-block-embed-youtube wp-embed-aspect-16-9 wp-has-aspect-ratio"><div class="wp-block-embed__wrapper">
https://www.youtube.com/watch?v=Cl_kXbhTi8k
</div><figcaption class="wp-element-caption"><?php esc_html_e( 'The Beauty of Earth', 'dualtone' ); ?></figcaption></figure>
<!-- /wp:embed -->

<!-- wp:paragraph -->
<p><?php esc_html_e( 'Different type of media may be embeded in WordPress like this video. You just have to insert the url.', 'dualtone' ); ?></p>
<!-- /wp:paragraph -->
