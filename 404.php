<?php
/**
 * 404 Page — No sidebar
 */
global $astrofy_include_sidebar;
$astrofy_include_sidebar = false;
get_header();
?>

<div class="text-center">
    <h1 class="text-9xl font-bold mb-4">&#127965;</h1>
    <h1 class="text-9xl font-bold mb-2">404</h1>
    <h3 class="text-2xl">The page you're looking for couldn't be found.</h3>
    <a class="btn btn-accent mt-9" href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a>
</div>

<?php
get_footer();
