<?php
/**
 * Template Name: Services
 * Template Post Type: page
 *
 * Redirects to the Services CPT archive.
 */
wp_safe_redirect( get_post_type_archive_link( 'service' ), 301 );
exit;
