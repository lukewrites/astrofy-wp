<?php
/**
 * Theme Customizer Settings
 */
function astrofy_customize_register( $wp_customize ) {

    // ── Identity Section ─────────────────────────────────────────────────────
    $wp_customize->add_section( 'astrofy_identity', array(
        'title'    => __( 'Astrofy Identity', 'astrofy' ),
        'priority' => 30,
    ) );

    $wp_customize->add_setting( 'astrofy_profile_image', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ) );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'astrofy_profile_image', array(
        'label'   => __( 'Profile Image', 'astrofy' ),
        'section' => 'astrofy_identity',
    ) ) );

    $wp_customize->add_setting( 'astrofy_contact_email', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_email',
    ) );
    $wp_customize->add_control( 'astrofy_contact_email', array(
        'label'   => __( 'Contact Email', 'astrofy' ),
        'section' => 'astrofy_identity',
        'type'    => 'email',
    ) );

    // ── Hero Section ─────────────────────────────────────────────────────────
    $wp_customize->add_section( 'astrofy_hero', array(
        'title'    => __( 'Homepage Hero', 'astrofy' ),
        'priority' => 31,
    ) );

    $hero_fields = array(
        'astrofy_hero_greeting'   => array( 'label' => 'Greeting', 'default' => 'Hey there 👋' ),
        'astrofy_hero_name'       => array( 'label' => 'Name', 'default' => "I'm Astrofy" ),
        'astrofy_hero_title'      => array( 'label' => 'Title', 'default' => '(A beautiful WordPress theme)' ),
        'astrofy_hero_description'=> array( 'label' => 'Description', 'default' => 'Welcome to my personal portfolio website built with WordPress and TailwindCSS. Here you can find my blog, CV, projects, and more. Thanks for visiting!' ),
        'astrofy_hero_cta1_label' => array( 'label' => 'CTA 1 Label', 'default' => "Let's connect!" ),
        'astrofy_hero_cta1_url'   => array( 'label' => 'CTA 1 URL', 'default' => '#' ),
        'astrofy_hero_cta2_label' => array( 'label' => 'CTA 2 Label', 'default' => 'Get This template' ),
        'astrofy_hero_cta2_url'   => array( 'label' => 'CTA 2 URL', 'default' => '#' ),
    );

    foreach ( $hero_fields as $key => $field ) {
        $wp_customize->add_setting( $key, array(
            'default'           => $field['default'],
            'sanitize_callback' => ( strpos( $key, '_url' ) !== false ) ? 'esc_url_raw' : 'sanitize_text_field',
        ) );
        $wp_customize->add_control( $key, array(
            'label'   => $field['label'],
            'section' => 'astrofy_hero',
            'type'    => ( strpos( $key, '_url' ) !== false ) ? 'url' : 'text',
        ) );
    }

    // ── Social Links Section ─────────────────────────────────────────────────
    $wp_customize->add_section( 'astrofy_social', array(
        'title'    => __( 'Social Links', 'astrofy' ),
        'priority' => 32,
    ) );

    $social_fields = array(
        'astrofy_github_url'   => 'GitHub URL',
        'astrofy_twitter_url'  => 'Twitter URL',
        'astrofy_linkedin_url' => 'LinkedIn URL',
        'astrofy_support_url'  => 'Support URL',
    );

    foreach ( $social_fields as $key => $label ) {
        $wp_customize->add_setting( $key, array(
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
        ) );
        $wp_customize->add_control( $key, array(
            'label'   => $label,
            'section' => 'astrofy_social',
            'type'    => 'url',
        ) );
    }

    // ── Theme Section ────────────────────────────────────────────────────────
    $wp_customize->add_section( 'astrofy_theme', array(
        'title'    => __( 'DaisyUI Theme', 'astrofy' ),
        'priority' => 33,
    ) );

    $wp_customize->add_setting( 'astrofy_daisyui_theme', array(
        'default'           => 'lofi',
        'sanitize_callback' => 'sanitize_text_field',
    ) );

    $themes = array(
        'light' => 'Light', 'dark' => 'Dark', 'cupcake' => 'Cupcake', 'bumblebee' => 'Bumblebee',
        'emerald' => 'Emerald', 'corporate' => 'Corporate', 'synthwave' => 'Synthwave', 'retro' => 'Retro',
        'cyberpunk' => 'Cyberpunk', 'valentine' => 'Valentine', 'halloween' => 'Halloween', 'garden' => 'Garden',
        'forest' => 'Forest', 'aqua' => 'Aqua', 'lofi' => 'Lofi', 'pastel' => 'Pastel',
        'fantasy' => 'Fantasy', 'wireframe' => 'Wireframe', 'black' => 'Black', 'luxury' => 'Luxury',
        'dracula' => 'Dracula', 'cmyk' => 'CMYK', 'autumn' => 'Autumn', 'business' => 'Business',
        'acid' => 'Acid', 'lemonade' => 'Lemonade', 'night' => 'Night', 'coffee' => 'Coffee',
        'winter' => 'Winter', 'dim' => 'Dim', 'nord' => 'Nord', 'sunset' => 'Sunset',
    );

    $wp_customize->add_control( 'astrofy_daisyui_theme', array(
        'label'   => __( 'DaisyUI Theme', 'astrofy' ),
        'section' => 'astrofy_theme',
        'type'    => 'select',
        'choices' => $themes,
    ) );
}
add_action( 'customize_register', 'astrofy_customize_register' );
