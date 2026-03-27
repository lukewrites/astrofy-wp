<?php
/**
 * Template Name: Services
 * Template Post Type: page
 *
 * For a page with slug "services", WordPress auto-selects this template.
 * User builds service cards in the block editor content area.
 */
get_header();

while ( have_posts() ) : the_post();
?>
    <div>
        <div class="text-3xl w-full font-bold mb-5"><?php the_title(); ?></div>
    </div>
    <div class="prose prose-lg max-w-none">
        <?php the_content(); ?>
    </div>
<?php endwhile;

get_footer();
