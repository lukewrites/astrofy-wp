<?php
/**
 * Astrofy Theme Functions
 */

// ── Theme Setup ──────────────────────────────────────────────────────────────
function astrofy_setup() {
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'custom-logo' );
    add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) );
    add_theme_support( 'automatic-feed-links' );

    add_image_size( 'astrofy-hero', 750, 422, true );
    add_image_size( 'astrofy-profile', 300, 300, true );

    register_nav_menus( array(
        'sidebar-menu' => __( 'Sidebar Menu', 'astrofy' ),
    ) );
}
add_action( 'after_setup_theme', 'astrofy_setup' );

// ── Enqueue Assets ───────────────────────────────────────────────────────────
function astrofy_enqueue_assets() {
    wp_enqueue_style( 'astrofy-global', get_template_directory_uri() . '/assets/css/global.css', array(), '1.0.0' );
    wp_enqueue_script( 'astrofy-drawer', get_template_directory_uri() . '/assets/js/drawer.js', array(), '1.0.0', true );
}
add_action( 'wp_enqueue_scripts', 'astrofy_enqueue_assets' );

// ── Dequeue WordPress block styles that conflict with DaisyUI ────────────────
function astrofy_dequeue_block_styles() {
    wp_dequeue_style( 'wp-block-library' );
    wp_dequeue_style( 'wp-block-library-theme' );
    wp_dequeue_style( 'classic-theme-styles' );
    wp_dequeue_style( 'global-styles' );
}
add_action( 'wp_enqueue_scripts', 'astrofy_dequeue_block_styles', 100 );

// ── Register Store Item CPT ──────────────────────────────────────────────────
function astrofy_register_cpt() {
    register_post_type( 'store_item', array(
        'labels' => array(
            'name'               => __( 'Store Items', 'astrofy' ),
            'singular_name'      => __( 'Store Item', 'astrofy' ),
            'add_new'            => __( 'Add New', 'astrofy' ),
            'add_new_item'       => __( 'Add New Store Item', 'astrofy' ),
            'edit_item'          => __( 'Edit Store Item', 'astrofy' ),
            'new_item'           => __( 'New Store Item', 'astrofy' ),
            'view_item'          => __( 'View Store Item', 'astrofy' ),
            'search_items'       => __( 'Search Store Items', 'astrofy' ),
            'not_found'          => __( 'No store items found', 'astrofy' ),
            'not_found_in_trash' => __( 'No store items found in Trash', 'astrofy' ),
        ),
        'public'       => true,
        'has_archive'  => true,
        'rewrite'      => array( 'slug' => 'store' ),
        'supports'     => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
        'show_in_rest' => true,
        'menu_icon'    => 'dashicons-cart',
    ) );
}
add_action( 'init', 'astrofy_register_cpt' );

// ── Permalink Config on Theme Activation ─────────────────────────────────────
function astrofy_activation() {
    astrofy_register_cpt();

    global $wp_rewrite;
    $wp_rewrite->set_permalink_structure( '/blog/%postname%/' );
    $wp_rewrite->set_tag_base( 'blog/tag' );
    $wp_rewrite->flush_rules();
}
add_action( 'after_switch_theme', 'astrofy_activation' );

// ── RSS redirect ─────────────────────────────────────────────────────────────
function astrofy_rss_rewrite() {
    add_rewrite_rule( '^rss\.xml$', 'index.php?feed=rss2', 'top' );
}
add_action( 'init', 'astrofy_rss_rewrite' );

// ── Posts per page for store archive ─────────────────────────────────────────
function astrofy_pre_get_posts( $query ) {
    if ( ! is_admin() && $query->is_main_query() ) {
        if ( is_post_type_archive( 'store_item' ) ) {
            $query->set( 'posts_per_page', 10 );
        }
    }
}
add_action( 'pre_get_posts', 'astrofy_pre_get_posts' );

// ── Include files ────────────────────────────────────────────────────────────
require_once get_template_directory() . '/inc/customizer.php';
require_once get_template_directory() . '/inc/meta-boxes.php';
require_once get_template_directory() . '/inc/template-tags.php';
require_once get_template_directory() . '/inc/seo.php';
require_once get_template_directory() . '/inc/walker-sidebar.php';
