<?php
/**
 * Template Name: Projects
 * Template Post Type: page
 *
 * Redirects to the Projects CPT archive.
 */
wp_safe_redirect( get_post_type_archive_link( 'project' ), 301 );
exit;
