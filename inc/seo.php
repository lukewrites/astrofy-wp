<?php
/**
 * SEO: Open Graph & Twitter Card Meta Tags
 */
function astrofy_seo_meta() {
    $default_image = get_template_directory_uri() . '/assets/images/social_img.webp';

    if ( is_singular() ) {
        $og_type    = is_singular( 'post' ) ? 'article' : 'website';
        $og_title   = get_the_title();
        $og_desc    = has_excerpt() ? get_the_excerpt() : wp_trim_words( get_the_content(), 30, '...' );
        $og_url     = get_permalink();
        $og_image   = get_the_post_thumbnail_url( null, 'astrofy-hero' ) ?: $default_image;
    } else {
        $og_type    = 'website';
        $og_title   = get_bloginfo( 'name' );
        $og_desc    = get_bloginfo( 'description' );
        $og_url     = home_url( $_SERVER['REQUEST_URI'] );
        $og_image   = $default_image;
    }
    ?>
    <!-- Astrofy SEO -->
    <meta property="og:type" content="<?php echo esc_attr( $og_type ); ?>" />
    <meta property="og:url" content="<?php echo esc_url( $og_url ); ?>" />
    <meta property="og:title" content="<?php echo esc_attr( $og_title ); ?>" />
    <meta property="og:description" content="<?php echo esc_attr( $og_desc ); ?>" />
    <meta property="og:image" content="<?php echo esc_url( $og_image ); ?>" />
    <meta property="twitter:card" content="summary_large_image" />
    <meta property="twitter:url" content="<?php echo esc_url( $og_url ); ?>" />
    <meta property="twitter:title" content="<?php echo esc_attr( $og_title ); ?>" />
    <meta property="twitter:description" content="<?php echo esc_attr( $og_desc ); ?>" />
    <meta property="twitter:image" content="<?php echo esc_url( $og_image ); ?>" />
    <?php
}
add_action( 'wp_head', 'astrofy_seo_meta', 5 );
