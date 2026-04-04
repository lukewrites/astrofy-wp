<?php
/**
 * Projects Archive
 */
get_header();

$active_tag = get_query_var( 'project_tag' );
$all_tags   = get_terms( array(
    'taxonomy'   => 'project_tag',
    'hide_empty' => true,
) );
?>

<div class="mb-5">
    <div class="text-3xl w-full font-bold">Projects</div>
</div>

<?php if ( ! empty( $all_tags ) && ! is_wp_error( $all_tags ) ) : ?>
<div class="flex flex-wrap gap-2 mb-6">
    <a href="<?php echo esc_url( get_post_type_archive_link( 'project' ) ); ?>"
       class="badge badge-lg <?php echo $active_tag ? 'badge-outline' : 'badge-primary'; ?>">All</a>
    <?php foreach ( $all_tags as $tag ) : ?>
    <a href="<?php echo esc_url( get_term_link( $tag ) ); ?>"
       class="badge badge-lg <?php echo $active_tag === $tag->slug ? 'badge-primary' : 'badge-outline'; ?>"><?php echo esc_html( $tag->name ); ?></a>
    <?php endforeach; ?>
</div>
<?php endif; ?>

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
        <p class="font-bold">No projects found for this tag.</p>
        <p><a href="<?php echo esc_url( get_post_type_archive_link( 'project' ) ); ?>" class="link">View all projects</a></p>
    </div>
<?php endif;

get_footer();
