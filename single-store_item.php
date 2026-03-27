<?php
/**
 * Single Store Item (StoreItemLayout)
 */
get_header();

while ( have_posts() ) : the_post();
    $badge            = get_post_meta( get_the_ID(), '_astrofy_badge', true );
    $pricing          = get_post_meta( get_the_ID(), '_astrofy_pricing', true );
    $oldPricing       = get_post_meta( get_the_ID(), '_astrofy_old_pricing', true );
    $checkoutUrl      = get_post_meta( get_the_ID(), '_astrofy_checkout_url', true );
    $custom_link      = get_post_meta( get_the_ID(), '_astrofy_custom_link', true );
    $custom_link_label = get_post_meta( get_the_ID(), '_astrofy_custom_link_label', true );
    $hero_img         = get_the_post_thumbnail_url( null, 'astrofy-hero' );
?>

<main class="md:flex md:justify-center">
    <article class="prose prose-lg max-w-[750px] prose-img:mx-auto">
        <?php if ( $hero_img ) : ?>
        <img src="<?php echo esc_url( $hero_img ); ?>" width="750" height="422" alt="<?php the_title_attribute(); ?>" class="w-full mb-6" />
        <?php endif; ?>
        <div>
            <h1 class="title my-2 text-4xl font-bold">
                <?php the_title(); ?>
                <?php if ( $badge ) : ?>
                <div class="badge badge-secondary mx-2"><?php echo esc_html( $badge ); ?></div>
                <?php endif; ?>
            </h1>
            <div class="flex place-content-between items-center">
                <div class="grow md:grow-0">
                    <span class="text-xl mr-1"><?php echo esc_html( $pricing ); ?></span>
                    <?php if ( $oldPricing ) : ?>
                    <span class="text-md opacity-50 line-through"><?php echo esc_html( $oldPricing ); ?></span>
                    <?php endif; ?>
                </div>
                <div>
                    <?php if ( $custom_link ) : ?>
                    <a class="btn btn-outline grow md:grow-0 ml-4" href="<?php echo esc_url( $custom_link ); ?>" target="_blank"><?php echo esc_html( $custom_link_label ); ?></a>
                    <?php endif; ?>
                    <?php if ( $checkoutUrl ) : ?>
                    <a class="btn btn-primary grow md:grow-0 ml-4" href="<?php echo esc_url( $checkoutUrl ); ?>" target="_blank">Buy Now</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="divider my-2"></div>
        <?php the_content(); ?>
    </article>
</main>

<?php endwhile;

get_footer();
