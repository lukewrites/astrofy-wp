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

// ── Register Custom Post Types ──────────────────────────────────────────────
function astrofy_register_cpt() {
    register_post_type( 'project', array(
        'labels' => array(
            'name'               => __( 'Projects', 'astrofy' ),
            'singular_name'      => __( 'Project', 'astrofy' ),
            'add_new'            => __( 'Add New', 'astrofy' ),
            'add_new_item'       => __( 'Add New Project', 'astrofy' ),
            'edit_item'          => __( 'Edit Project', 'astrofy' ),
            'new_item'           => __( 'New Project', 'astrofy' ),
            'view_item'          => __( 'View Project', 'astrofy' ),
            'search_items'       => __( 'Search Projects', 'astrofy' ),
            'not_found'          => __( 'No projects found', 'astrofy' ),
            'not_found_in_trash' => __( 'No projects found in Trash', 'astrofy' ),
        ),
        'public'             => true,
        'has_archive'        => true,
        'rewrite'            => array( 'slug' => 'projects', 'with_front' => false ),
        'supports'           => array( 'title', 'thumbnail', 'excerpt' ),
        'show_in_rest'       => true,
        'menu_icon'          => 'dashicons-portfolio',
    ) );

    register_taxonomy( 'project_tag', 'project', array(
        'labels' => array(
            'name'          => __( 'Project Tags', 'astrofy' ),
            'singular_name' => __( 'Project Tag', 'astrofy' ),
            'add_new_item'  => __( 'Add New Project Tag', 'astrofy' ),
            'search_items'  => __( 'Search Project Tags', 'astrofy' ),
        ),
        'public'       => true,
        'hierarchical' => false,
        'rewrite'      => array( 'slug' => 'projects/tag', 'with_front' => false ),
        'show_in_rest' => true,
    ) );

    register_post_type( 'service', array(
        'labels' => array(
            'name'               => __( 'Services', 'astrofy' ),
            'singular_name'      => __( 'Service', 'astrofy' ),
            'add_new'            => __( 'Add New', 'astrofy' ),
            'add_new_item'       => __( 'Add New Service', 'astrofy' ),
            'edit_item'          => __( 'Edit Service', 'astrofy' ),
            'new_item'           => __( 'New Service', 'astrofy' ),
            'view_item'          => __( 'View Service', 'astrofy' ),
            'search_items'       => __( 'Search Services', 'astrofy' ),
            'not_found'          => __( 'No services found', 'astrofy' ),
            'not_found_in_trash' => __( 'No services found in Trash', 'astrofy' ),
        ),
        'public'       => true,
        'has_archive'  => true,
        'rewrite'      => array( 'slug' => 'services', 'with_front' => false ),
        'supports'     => array( 'title', 'thumbnail', 'excerpt' ),
        'show_in_rest' => true,
        'menu_icon'    => 'dashicons-admin-generic',
    ) );

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
        'rewrite'      => array( 'slug' => 'store', 'with_front' => false ),
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

// ── Redirect single project pages to external URL or archive ────────────────
function astrofy_redirect_single_project() {
    if ( is_singular( 'project' ) ) {
        $url = get_post_meta( get_the_ID(), '_astrofy_project_url', true );
        wp_redirect( $url ? $url : get_post_type_archive_link( 'project' ), 301 );
        exit;
    }
}
add_action( 'template_redirect', 'astrofy_redirect_single_project' );

// ── Redirect single service pages to archive ────────────────────────────────
function astrofy_redirect_single_service() {
    if ( is_singular( 'service' ) ) {
        wp_redirect( get_post_type_archive_link( 'service' ), 301 );
        exit;
    }
}
add_action( 'template_redirect', 'astrofy_redirect_single_service' );

// ── RSS redirect ─────────────────────────────────────────────────────────────
function astrofy_rss_rewrite() {
    add_rewrite_rule( '^rss\.xml$', 'index.php?feed=rss2', 'top' );
}
add_action( 'init', 'astrofy_rss_rewrite' );

// ── Posts per page for store archive ─────────────────────────────────────────
function astrofy_pre_get_posts( $query ) {
    if ( ! is_admin() && $query->is_main_query() ) {
        if ( is_post_type_archive( 'store_item' ) || is_post_type_archive( 'project' ) ) {
            $query->set( 'posts_per_page', 10 );
        }
        if ( is_post_type_archive( 'service' ) ) {
            $query->set( 'posts_per_page', 10 );
            $query->set( 'meta_query', array(
                'relation' => 'OR',
                array( 'key' => '_astrofy_service_active', 'value' => '1' ),
                array( 'key' => '_astrofy_service_active', 'compare' => 'NOT EXISTS' ),
            ) );
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
