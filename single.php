<?php
/**
 * Single Blog Post (PostLayout)
 */
get_header();

while ( have_posts() ) : the_post();
    $badge       = get_post_meta( get_the_ID(), '_astrofy_badge', true );
    $tags        = wp_get_post_tags( get_the_ID(), array( 'fields' => 'names' ) );
    $hero_img    = get_the_post_thumbnail_url( null, 'astrofy-hero' );
    $pub_date    = get_the_date( 'M j, Y' );
    $updated     = get_the_modified_date( 'M j, Y' );
    $posted_date = get_the_date( 'M j, Y' );
?>

<main class="md:flex md:justify-center">
    <article class="prose prose-lg max-w-[750px] prose-img:mx-auto">
        <?php if ( $hero_img ) : ?>
        <img src="<?php echo esc_url( $hero_img ); ?>" width="750" height="422" alt="<?php the_title_attribute(); ?>" class="w-full mb-6" />
        <?php endif; ?>
        <h1 class="title my-2 text-4xl font-bold"><?php the_title(); ?></h1>
        <time><?php echo esc_html( $pub_date ); ?></time>
        <br />
        <?php if ( $badge ) : ?>
        <div class="badge badge-secondary my-1"><?php echo esc_html( $badge ); ?></div>
        <?php endif; ?>
        <?php if ( ! empty( $tags ) ) :
            foreach ( $tags as $tag ) : ?>
            <a href="<?php echo esc_url( home_url( '/blog/tag/' . sanitize_title( $tag ) . '/' ) ); ?>" class="badge badge-outline ml-2 no-underline"><?php echo esc_html( $tag ); ?></a>
            <?php endforeach;
        endif; ?>
        <?php if ( $updated !== $posted_date ) : ?>
        <div>Last updated on <time><?php echo esc_html( $updated ); ?></time></div>
        <?php endif; ?>
        <div class="divider my-2"></div>
        <?php the_content(); ?>
    </article>
</main>

<?php endwhile;

get_footer();
