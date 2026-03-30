<?php
/**
 * Theme Header
 */
$daisyui_theme = get_theme_mod( 'astrofy_daisyui_theme', 'lofi' );
?>
<!doctype html>
<html <?php language_attributes(); ?> data-theme="<?php echo esc_attr( $daisyui_theme ); ?>">
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="icon" type="image/svg+xml" href="<?php echo esc_url( get_template_directory_uri() . '/assets/images/favicon.svg' ); ?>" />
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div class="bg-base-100 drawer lg:drawer-open">
    <input id="my-drawer" type="checkbox" class="drawer-toggle" />
    <div class="drawer-content bg-base-100">
        <?php // Mobile navbar — visible only on small screens ?>
        <div class="sticky lg:hidden top-0 z-30 flex h-16 w-full justify-center bg-opacity-90 backdrop-blur transition-all duration-100 bg-base-100 text-base-content shadow-sm">
            <div class="navbar">
                <div class="navbar-start">
                    <label for="my-drawer" class="btn btn-square btn-ghost">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="inline-block w-5 h-5 stroke-current"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                    </label>
                </div>
                <div class="navbar-center">
                    <a class="btn btn-ghost normal-case text-xl" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a>
                </div>
                <div class="navbar-end"></div>
            </div>
        </div>

        <div class="md:flex md:justify-center">
            <main class="p-6 pt-10 lg:max-w-[900px] max-w-[100vw]">
