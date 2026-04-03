<?php
/**
 * Meta Boxes for Posts, Store Items, and CV Page
 */

// ── Post Meta Box (Badge) ────────────────────────────────────────────────────
function astrofy_post_meta_box() {
    add_meta_box(
        'astrofy_post_meta',
        __( 'Astrofy Post Options', 'astrofy' ),
        'astrofy_post_meta_callback',
        'post',
        'side'
    );
}
add_action( 'add_meta_boxes', 'astrofy_post_meta_box' );

function astrofy_post_meta_callback( $post ) {
    wp_nonce_field( 'astrofy_post_meta', 'astrofy_post_meta_nonce' );
    $badge = get_post_meta( $post->ID, '_astrofy_badge', true );
    ?>
    <p>
        <label for="astrofy_badge"><strong><?php esc_html_e( 'Badge', 'astrofy' ); ?></strong></label><br>
        <input type="text" id="astrofy_badge" name="astrofy_badge" value="<?php echo esc_attr( $badge ); ?>" class="widefat" placeholder="e.g. NEW, Featured" />
    </p>
    <?php
}

function astrofy_save_post_meta( $post_id ) {
    if ( ! isset( $_POST['astrofy_post_meta_nonce'] ) || ! wp_verify_nonce( $_POST['astrofy_post_meta_nonce'], 'astrofy_post_meta' ) ) {
        return;
    }
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    if ( ! current_user_can( 'edit_post', $post_id ) ) return;

    if ( isset( $_POST['astrofy_badge'] ) ) {
        update_post_meta( $post_id, '_astrofy_badge', sanitize_text_field( $_POST['astrofy_badge'] ) );
    }
}
add_action( 'save_post_post', 'astrofy_save_post_meta' );

// ── Project Meta Box ────────────────────────────────────────────────────
function astrofy_project_meta_box() {
    add_meta_box(
        'astrofy_project_meta',
        __( 'Project Options', 'astrofy' ),
        'astrofy_project_meta_callback',
        'project',
        'normal',
        'high'
    );
}
add_action( 'add_meta_boxes', 'astrofy_project_meta_box' );

function astrofy_project_meta_callback( $post ) {
    wp_nonce_field( 'astrofy_project_meta', 'astrofy_project_meta_nonce' );

    $fields = array(
        '_astrofy_project_url'   => array( 'label' => 'Project URL (clicking the card goes here)', 'type' => 'url', 'placeholder' => 'https://github.com/...' ),
        '_astrofy_project_badge' => array( 'label' => 'Badge', 'type' => 'text', 'placeholder' => 'e.g. NEW, Featured, WIP' ),
    );

    foreach ( $fields as $key => $field ) {
        $value = get_post_meta( $post->ID, $key, true );
        ?>
        <p>
            <label for="<?php echo esc_attr( $key ); ?>"><strong><?php echo esc_html( $field['label'] ); ?></strong></label><br>
            <input type="<?php echo esc_attr( $field['type'] ); ?>" id="<?php echo esc_attr( $key ); ?>" name="<?php echo esc_attr( $key ); ?>" value="<?php echo esc_attr( $value ); ?>" class="widefat" placeholder="<?php echo esc_attr( $field['placeholder'] ); ?>" />
        </p>
        <?php
    }
    echo '<p class="description">' . esc_html__( 'Use the Featured Image box (in the right sidebar) for the project screenshot.', 'astrofy' ) . '</p>';
}

function astrofy_save_project_meta( $post_id ) {
    if ( ! isset( $_POST['astrofy_project_meta_nonce'] ) || ! wp_verify_nonce( $_POST['astrofy_project_meta_nonce'], 'astrofy_project_meta' ) ) {
        return;
    }
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    if ( ! current_user_can( 'edit_post', $post_id ) ) return;

    if ( isset( $_POST['_astrofy_project_url'] ) ) {
        update_post_meta( $post_id, '_astrofy_project_url', esc_url_raw( $_POST['_astrofy_project_url'] ) );
    }
    if ( isset( $_POST['_astrofy_project_badge'] ) ) {
        update_post_meta( $post_id, '_astrofy_project_badge', sanitize_text_field( $_POST['_astrofy_project_badge'] ) );
    }
}
add_action( 'save_post_project', 'astrofy_save_project_meta' );

// ── Store Item Meta Box ──────────────────────────────────────────────────────
function astrofy_store_meta_box() {
    add_meta_box(
        'astrofy_store_meta',
        __( 'Store Item Options', 'astrofy' ),
        'astrofy_store_meta_callback',
        'store_item',
        'normal',
        'high'
    );
}
add_action( 'add_meta_boxes', 'astrofy_store_meta_box' );

function astrofy_store_meta_callback( $post ) {
    wp_nonce_field( 'astrofy_store_meta', 'astrofy_store_meta_nonce' );

    $fields = array(
        '_astrofy_pricing'           => array( 'label' => 'Pricing', 'type' => 'text', 'placeholder' => 'e.g. $9.99' ),
        '_astrofy_old_pricing'       => array( 'label' => 'Old Pricing', 'type' => 'text', 'placeholder' => 'e.g. $19.99' ),
        '_astrofy_badge'             => array( 'label' => 'Badge', 'type' => 'text', 'placeholder' => 'e.g. SALE' ),
        '_astrofy_checkout_url'      => array( 'label' => 'Checkout URL', 'type' => 'url', 'placeholder' => 'https://' ),
        '_astrofy_custom_link'       => array( 'label' => 'Custom Link URL', 'type' => 'url', 'placeholder' => 'https://' ),
        '_astrofy_custom_link_label' => array( 'label' => 'Custom Link Label', 'type' => 'text', 'placeholder' => 'e.g. View Demo' ),
    );

    foreach ( $fields as $key => $field ) {
        $value = get_post_meta( $post->ID, $key, true );
        ?>
        <p>
            <label for="<?php echo esc_attr( $key ); ?>"><strong><?php echo esc_html( $field['label'] ); ?></strong></label><br>
            <input type="<?php echo esc_attr( $field['type'] ); ?>" id="<?php echo esc_attr( $key ); ?>" name="<?php echo esc_attr( $key ); ?>" value="<?php echo esc_attr( $value ); ?>" class="widefat" placeholder="<?php echo esc_attr( $field['placeholder'] ); ?>" />
        </p>
        <?php
    }
}

function astrofy_save_store_meta( $post_id ) {
    if ( ! isset( $_POST['astrofy_store_meta_nonce'] ) || ! wp_verify_nonce( $_POST['astrofy_store_meta_nonce'], 'astrofy_store_meta' ) ) {
        return;
    }
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    if ( ! current_user_can( 'edit_post', $post_id ) ) return;

    $text_fields = array( '_astrofy_pricing', '_astrofy_old_pricing', '_astrofy_badge', '_astrofy_custom_link_label' );
    $url_fields  = array( '_astrofy_checkout_url', '_astrofy_custom_link' );

    foreach ( $text_fields as $key ) {
        if ( isset( $_POST[ $key ] ) ) {
            update_post_meta( $post_id, $key, sanitize_text_field( $_POST[ $key ] ) );
        }
    }
    foreach ( $url_fields as $key ) {
        if ( isset( $_POST[ $key ] ) ) {
            update_post_meta( $post_id, $key, esc_url_raw( $_POST[ $key ] ) );
        }
    }
}
add_action( 'save_post_store_item', 'astrofy_save_store_meta' );

// ── CV Page Meta Box ─────────────────────────────────────────────────────────
function astrofy_cv_meta_box() {
    $screen = get_current_screen();
    if ( $screen && $screen->id === 'page' ) {
        add_meta_box(
            'astrofy_cv_meta',
            __( 'CV / Resume Data', 'astrofy' ),
            'astrofy_cv_meta_callback',
            'page',
            'normal',
            'high'
        );
    }
}
add_action( 'add_meta_boxes', 'astrofy_cv_meta_box' );

function astrofy_cv_meta_callback( $post ) {
    // Only show on the CV page
    if ( $post->post_name !== 'cv' && get_page_template_slug( $post->ID ) !== 'page-cv.php' ) {
        echo '<p>' . esc_html__( 'This meta box is only active on the CV page (slug: "cv").', 'astrofy' ) . '</p>';
        return;
    }

    wp_nonce_field( 'astrofy_cv_meta', 'astrofy_cv_meta_nonce' );

    $profile        = get_post_meta( $post->ID, '_astrofy_cv_profile', true );
    $education      = get_post_meta( $post->ID, '_astrofy_cv_education', true );
    $experience     = get_post_meta( $post->ID, '_astrofy_cv_experience', true );
    $certifications = get_post_meta( $post->ID, '_astrofy_cv_certifications', true );
    $skills         = get_post_meta( $post->ID, '_astrofy_cv_skills', true );

    if ( ! is_array( $education ) ) $education = array();
    if ( ! is_array( $experience ) ) $experience = array();
    if ( ! is_array( $certifications ) ) $certifications = array();
    if ( ! is_array( $skills ) ) $skills = array();
    ?>
    <style>
        .astrofy-repeater { border: 1px solid #ddd; padding: 10px; margin: 5px 0; background: #f9f9f9; }
        .astrofy-repeater input, .astrofy-repeater textarea { width: 100%; margin: 3px 0; }
        .astrofy-remove-row { color: #a00; cursor: pointer; float: right; }
    </style>

    <h3><?php esc_html_e( 'Profile', 'astrofy' ); ?></h3>
    <textarea name="astrofy_cv_profile" rows="4" class="widefat"><?php echo esc_textarea( $profile ); ?></textarea>

    <h3><?php esc_html_e( 'Education', 'astrofy' ); ?></h3>
    <div id="astrofy-education-rows">
        <?php foreach ( $education as $i => $item ) : ?>
        <div class="astrofy-repeater">
            <span class="astrofy-remove-row" onclick="this.parentElement.remove();">&times;</span>
            <input type="text" name="astrofy_cv_education[<?php echo $i; ?>][title]" value="<?php echo esc_attr( $item['title'] ?? '' ); ?>" placeholder="Title" />
            <input type="text" name="astrofy_cv_education[<?php echo $i; ?>][subtitle]" value="<?php echo esc_attr( $item['subtitle'] ?? '' ); ?>" placeholder="Subtitle (dates, institution)" />
            <textarea name="astrofy_cv_education[<?php echo $i; ?>][description]" placeholder="Description (optional)"><?php echo esc_textarea( $item['description'] ?? '' ); ?></textarea>
        </div>
        <?php endforeach; ?>
    </div>
    <button type="button" class="button" onclick="astrofyAddRow('education');"><?php esc_html_e( '+ Add Education', 'astrofy' ); ?></button>

    <h3><?php esc_html_e( 'Experience', 'astrofy' ); ?></h3>
    <div id="astrofy-experience-rows">
        <?php foreach ( $experience as $i => $item ) : ?>
        <div class="astrofy-repeater">
            <span class="astrofy-remove-row" onclick="this.parentElement.remove();">&times;</span>
            <input type="text" name="astrofy_cv_experience[<?php echo $i; ?>][title]" value="<?php echo esc_attr( $item['title'] ?? '' ); ?>" placeholder="Job Title" />
            <input type="text" name="astrofy_cv_experience[<?php echo $i; ?>][subtitle]" value="<?php echo esc_attr( $item['subtitle'] ?? '' ); ?>" placeholder="Subtitle (dates, company)" />
            <textarea name="astrofy_cv_experience[<?php echo $i; ?>][description]" placeholder="Description"><?php echo esc_textarea( $item['description'] ?? '' ); ?></textarea>
        </div>
        <?php endforeach; ?>
    </div>
    <button type="button" class="button" onclick="astrofyAddRow('experience');"><?php esc_html_e( '+ Add Experience', 'astrofy' ); ?></button>

    <h3><?php esc_html_e( 'Certifications', 'astrofy' ); ?></h3>
    <div id="astrofy-certifications-rows">
        <?php foreach ( $certifications as $i => $item ) : ?>
        <div class="astrofy-repeater">
            <span class="astrofy-remove-row" onclick="this.parentElement.remove();">&times;</span>
            <input type="text" name="astrofy_cv_certifications[<?php echo $i; ?>][name]" value="<?php echo esc_attr( $item['name'] ?? '' ); ?>" placeholder="Certification Name" />
            <input type="url" name="astrofy_cv_certifications[<?php echo $i; ?>][url]" value="<?php echo esc_attr( $item['url'] ?? '' ); ?>" placeholder="Link URL (optional)" />
        </div>
        <?php endforeach; ?>
    </div>
    <button type="button" class="button" onclick="astrofyAddCertRow();"><?php esc_html_e( '+ Add Certification', 'astrofy' ); ?></button>

    <h3><?php esc_html_e( 'Skills', 'astrofy' ); ?></h3>
    <div id="astrofy-skills-rows">
        <?php foreach ( $skills as $i => $item ) : ?>
        <div class="astrofy-repeater">
            <span class="astrofy-remove-row" onclick="this.parentElement.remove();">&times;</span>
            <input type="text" name="astrofy_cv_skills[<?php echo $i; ?>][name]" value="<?php echo esc_attr( $item['name'] ?? '' ); ?>" placeholder="Skill Name" />
        </div>
        <?php endforeach; ?>
    </div>
    <button type="button" class="button" onclick="astrofyAddSkillRow();"><?php esc_html_e( '+ Add Skill', 'astrofy' ); ?></button>

    <script>
    var astrofyCounter = <?php echo max( count( $education ), count( $experience ), count( $certifications ), count( $skills ) ) + 100; ?>;

    function astrofyAddRow(section) {
        var idx = astrofyCounter++;
        var html = '<div class="astrofy-repeater">' +
            '<span class="astrofy-remove-row" onclick="this.parentElement.remove();">&times;</span>' +
            '<input type="text" name="astrofy_cv_' + section + '[' + idx + '][title]" placeholder="Title" />' +
            '<input type="text" name="astrofy_cv_' + section + '[' + idx + '][subtitle]" placeholder="Subtitle" />' +
            '<textarea name="astrofy_cv_' + section + '[' + idx + '][description]" placeholder="Description"></textarea>' +
            '</div>';
        document.getElementById('astrofy-' + section + '-rows').insertAdjacentHTML('beforeend', html);
    }

    function astrofyAddCertRow() {
        var idx = astrofyCounter++;
        var html = '<div class="astrofy-repeater">' +
            '<span class="astrofy-remove-row" onclick="this.parentElement.remove();">&times;</span>' +
            '<input type="text" name="astrofy_cv_certifications[' + idx + '][name]" placeholder="Certification Name" />' +
            '<input type="url" name="astrofy_cv_certifications[' + idx + '][url]" placeholder="Link URL (optional)" />' +
            '</div>';
        document.getElementById('astrofy-certifications-rows').insertAdjacentHTML('beforeend', html);
    }

    function astrofyAddSkillRow() {
        var idx = astrofyCounter++;
        var html = '<div class="astrofy-repeater">' +
            '<span class="astrofy-remove-row" onclick="this.parentElement.remove();">&times;</span>' +
            '<input type="text" name="astrofy_cv_skills[' + idx + '][name]" placeholder="Skill Name" />' +
            '</div>';
        document.getElementById('astrofy-skills-rows').insertAdjacentHTML('beforeend', html);
    }
    </script>
    <?php
}

function astrofy_save_cv_meta( $post_id ) {
    if ( ! isset( $_POST['astrofy_cv_meta_nonce'] ) || ! wp_verify_nonce( $_POST['astrofy_cv_meta_nonce'], 'astrofy_cv_meta' ) ) {
        return;
    }
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    if ( ! current_user_can( 'edit_page', $post_id ) ) return;
    if ( get_post_type( $post_id ) !== 'page' ) return;

    if ( isset( $_POST['astrofy_cv_profile'] ) ) {
        update_post_meta( $post_id, '_astrofy_cv_profile', sanitize_textarea_field( $_POST['astrofy_cv_profile'] ) );
    }

    // Sanitize repeater arrays
    $repeaters = array( 'astrofy_cv_education', 'astrofy_cv_experience' );
    foreach ( $repeaters as $key ) {
        if ( isset( $_POST[ $key ] ) && is_array( $_POST[ $key ] ) ) {
            $clean = array();
            foreach ( $_POST[ $key ] as $item ) {
                if ( ! empty( $item['title'] ) ) {
                    $clean[] = array(
                        'title'       => sanitize_text_field( $item['title'] ),
                        'subtitle'    => sanitize_text_field( $item['subtitle'] ?? '' ),
                        'description' => sanitize_textarea_field( $item['description'] ?? '' ),
                    );
                }
            }
            update_post_meta( $post_id, '_' . $key, $clean );
        } else {
            update_post_meta( $post_id, '_' . $key, array() );
        }
    }

    // Certifications
    if ( isset( $_POST['astrofy_cv_certifications'] ) && is_array( $_POST['astrofy_cv_certifications'] ) ) {
        $clean = array();
        foreach ( $_POST['astrofy_cv_certifications'] as $item ) {
            if ( ! empty( $item['name'] ) ) {
                $clean[] = array(
                    'name' => sanitize_text_field( $item['name'] ),
                    'url'  => esc_url_raw( $item['url'] ?? '' ),
                );
            }
        }
        update_post_meta( $post_id, '_astrofy_cv_certifications', $clean );
    } else {
        update_post_meta( $post_id, '_astrofy_cv_certifications', array() );
    }

    // Skills
    if ( isset( $_POST['astrofy_cv_skills'] ) && is_array( $_POST['astrofy_cv_skills'] ) ) {
        $clean = array();
        foreach ( $_POST['astrofy_cv_skills'] as $item ) {
            if ( ! empty( $item['name'] ) ) {
                $clean[] = array( 'name' => sanitize_text_field( $item['name'] ) );
            }
        }
        update_post_meta( $post_id, '_astrofy_cv_skills', $clean );
    } else {
        update_post_meta( $post_id, '_astrofy_cv_skills', array() );
    }
}
add_action( 'save_post_page', 'astrofy_save_cv_meta' );
