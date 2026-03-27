<?php
/**
 * Tag Archive — Blog filtered by tag
 */
get_header();
?>

<div class="mb-5">
    <div class="text-3xl w-full font-bold">Blog - <?php single_tag_title(); ?></div>
</div>

<?php if ( have_posts() ) : ?>
    <ul>
        <?php while ( have_posts() ) : the_post();
            $badge = get_post_meta( get_the_ID(), '_astrofy_badge', true );
            $img   = get_the_post_thumbnail_url( null, 'astrofy-hero' );
            $tags  = wp_get_post_tags( get_the_ID(), array( 'fields' => 'names' ) );
            astrofy_horizontal_card( array(
                'title'  => get_the_title(),
                'img'    => $img,
                'desc'   => get_the_excerpt(),
                'url'    => get_permalink(),
                'target' => '_self',
                'badge'  => $badge,
                'tags'   => $tags,
            ) );
            echo '<div class="divider my-0"></div>';
        endwhile; ?>
    </ul>
    <?php astrofy_pagination(); ?>
<?php else : ?>
    <div class="bg-base-200 border-l-4 border-secondary w-full p-4 min-w-full">
        <p class="font-bold">Sorry!</p>
        <p>There are no blog posts to show at the moment. Check back later!</p>
    </div>
<?php endif;

get_footer();
