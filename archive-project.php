<?php
/**
 * Projects Archive
 */
get_header();
?>

<div class="mb-5">
    <div class="text-3xl w-full font-bold">Projects</div>
</div>

<?php if ( have_posts() ) : ?>
    <?php while ( have_posts() ) : the_post();
        $badge = get_post_meta( get_the_ID(), '_astrofy_project_badge', true );
        $url   = get_post_meta( get_the_ID(), '_astrofy_project_url', true );
        $img   = get_the_post_thumbnail_url( null, 'astrofy-hero' );

        astrofy_horizontal_card( array(
            'title'  => get_the_title(),
            'img'    => $img,
            'desc'   => get_the_excerpt(),
            'url'    => $url ? $url : '#',
            'badge'  => $badge,
            'target' => $url ? '_blank' : '_self',
        ) );

        echo '<div class="divider my-0"></div>';
    endwhile; ?>

    <?php astrofy_pagination( 'Newer projects', 'Older projects' ); ?>
<?php else : ?>
    <div class="bg-base-200 border-l-4 border-secondary w-full p-4 min-w-full">
        <p class="font-bold">No projects yet!</p>
        <p>Check back soon.</p>
    </div>
<?php endif;

get_footer();
