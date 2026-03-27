<?php
/**
 * Generic Page Template
 */
get_header();

while ( have_posts() ) : the_post();
?>
    <div class="mb-5">
        <div class="text-3xl w-full font-bold"><?php the_title(); ?></div>
    </div>
    <div class="prose prose-lg max-w-none">
        <?php the_content(); ?>
    </div>
<?php endwhile;

get_footer();
