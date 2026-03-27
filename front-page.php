<?php
/**
 * Front Page Template
 */
get_header();

$greeting    = get_theme_mod( 'astrofy_hero_greeting', 'Hey there 👋' );
$name        = get_theme_mod( 'astrofy_hero_name', "I'm Luke Petschauer" );
$title       = get_theme_mod( 'astrofy_hero_title', 'Software Engineer' );
$description = get_theme_mod( 'astrofy_hero_description', 'Welcome to my personal portfolio website built with WordPress and TailwindCSS. Here you can find my blog, CV, projects, and more. Thanks for visiting!' );
$cta1_label  = get_theme_mod( 'astrofy_hero_cta1_label', "Let's connect!" );
$cta1_url    = get_theme_mod( 'astrofy_hero_cta1_url', '#' );
$cta2_label  = get_theme_mod( 'astrofy_hero_cta2_label', 'See My Work' );
$cta2_url    = get_theme_mod( 'astrofy_hero_cta2_url', '#' );
?>

<div class="pb-12 mt-5">
    <div class="text-xl py-1"><?php echo esc_html( $greeting ); ?></div>
    <div class="text-5xl font-bold"><?php echo esc_html( $name ); ?></div>
    <div class="text-3xl py-3 font-bold"><?php echo esc_html( $title ); ?></div>
    <div class="py-2">
        <span class="text-lg"><?php echo esc_html( $description ); ?></span>
    </div>
    <div class="mt-8">
        <?php if ( $cta1_label && $cta1_url ) : ?>
        <a class="btn" href="<?php echo esc_url( $cta1_url ); ?>" target="_blank"><?php echo esc_html( $cta1_label ); ?></a>
        <?php endif; ?>
        <?php if ( $cta2_label && $cta2_url ) : ?>
        <a href="<?php echo esc_url( $cta2_url ); ?>" target="_blank" class="btn btn-outline ml-5"><?php echo esc_html( $cta2_label ); ?></a>
        <?php endif; ?>
    </div>
</div>

<?php
// Render the page content (user can add project cards here via block editor)
if ( have_posts() ) {
    while ( have_posts() ) {
        the_post();
        $content = get_the_content();
        if ( trim( $content ) ) {
            echo '<div>';
            the_content();
            echo '</div>';
        }
    }
}
?>

<div>
    <div class="text-3xl w-full font-bold mb-5 mt-10">Latest from blog</div>
</div>

<?php
$latest_posts = new WP_Query( array(
    'posts_per_page' => 3,
    'post_type'      => 'post',
    'post_status'    => 'publish',
    'orderby'        => 'date',
    'order'          => 'DESC',
) );

if ( $latest_posts->have_posts() ) :
    while ( $latest_posts->have_posts() ) : $latest_posts->the_post();
        $badge = get_post_meta( get_the_ID(), '_astrofy_badge', true );
        $img   = get_the_post_thumbnail_url( null, 'astrofy-hero' );
        astrofy_horizontal_card( array(
            'title'  => get_the_title(),
            'img'    => $img,
            'desc'   => get_the_excerpt(),
            'url'    => get_permalink(),
            'target' => '_self',
            'badge'  => $badge,
        ) );
        echo '<div class="divider my-0"></div>';
    endwhile;
    wp_reset_postdata();
endif;

get_footer();
