<?php
/**
 * Store Items Archive
 */
get_header();
?>

<div class="mb-5">
    <div class="text-3xl w-full font-bold">Store</div>
</div>

<?php if ( have_posts() ) : ?>
    <ul>
        <?php while ( have_posts() ) : the_post();
            $badge      = get_post_meta( get_the_ID(), '_astrofy_badge', true );
            $pricing    = get_post_meta( get_the_ID(), '_astrofy_pricing', true );
            $oldPricing = get_post_meta( get_the_ID(), '_astrofy_old_pricing', true );
            $img        = get_the_post_thumbnail_url( null, 'astrofy-hero' );
            astrofy_horizontal_shop_item( array(
                'title'      => get_the_title(),
                'img'        => $img,
                'desc'       => get_the_excerpt(),
                'url'        => get_permalink(),
                'badge'      => $badge,
                'pricing'    => $pricing,
                'oldPricing' => $oldPricing,
            ) );
            echo '<div class="divider my-0"></div>';
        endwhile; ?>
    </ul>
    <?php astrofy_pagination( 'Previous page', 'Next page' ); ?>
<?php else : ?>
    <div class="bg-base-200 border-l-4 border-secondary w-full p-4 min-w-full">
        <p class="font-bold">Sorry!</p>
        <p>There are no store items to show at the moment. Check back later!</p>
    </div>
<?php endif;

get_footer();
