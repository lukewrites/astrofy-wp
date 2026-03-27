<?php
/**
 * Template Name: CV / Resume
 * Template Post Type: page
 *
 * For a page with slug "cv", WordPress auto-selects this template.
 */
get_header();

if ( have_posts() ) { the_post(); }
$page_id        = get_the_ID();
$profile        = get_post_meta( $page_id, '_astrofy_cv_profile', true );
$education      = get_post_meta( $page_id, '_astrofy_cv_education', true );
$experience     = get_post_meta( $page_id, '_astrofy_cv_experience', true );
$certifications = get_post_meta( $page_id, '_astrofy_cv_certifications', true );
$skills         = get_post_meta( $page_id, '_astrofy_cv_skills', true );

if ( ! is_array( $education ) ) $education = array();
if ( ! is_array( $experience ) ) $experience = array();
if ( ! is_array( $certifications ) ) $certifications = array();
if ( ! is_array( $skills ) ) $skills = array();
?>

<div class="mb-5">
    <div class="text-3xl w-full font-bold">Profile</div>
</div>

<?php if ( $profile ) : ?>
<div class="mb-10 text-justify">
    <?php echo wp_kses_post( $profile ); ?>
</div>
<?php endif; ?>

<?php if ( ! empty( $education ) ) : ?>
<div class="mb-5">
    <div class="text-3xl w-full font-bold">Education</div>
</div>
<div class="time-line-container grid gap-4 mb-10">
    <?php foreach ( $education as $item ) :
        astrofy_timeline_element(
            $item['title'] ?? '',
            $item['subtitle'] ?? '',
            $item['description'] ?? ''
        );
    endforeach; ?>
</div>
<?php endif; ?>

<?php if ( ! empty( $experience ) ) : ?>
<div class="mb-5">
    <div class="text-3xl w-full font-bold">Experience</div>
</div>
<div class="time-line-container mb-10">
    <?php foreach ( $experience as $item ) :
        astrofy_timeline_element(
            $item['title'] ?? '',
            $item['subtitle'] ?? '',
            $item['description'] ?? ''
        );
    endforeach; ?>
</div>
<?php endif; ?>

<?php if ( ! empty( $certifications ) ) : ?>
<div class="mb-5">
    <div class="text-3xl w-full font-bold">Certifications</div>
</div>
<ul class="list-disc mx-6 mb-10 grid gap-2">
    <?php foreach ( $certifications as $item ) : ?>
    <li>
        <?php if ( ! empty( $item['url'] ) ) : ?>
        <a href="<?php echo esc_url( $item['url'] ); ?>" target="_blank"><?php echo esc_html( $item['name'] ); ?></a>
        <?php else : ?>
        <?php echo esc_html( $item['name'] ); ?>
        <?php endif; ?>
    </li>
    <?php endforeach; ?>
</ul>
<?php endif; ?>

<?php if ( ! empty( $skills ) ) : ?>
<div class="mb-5">
    <div class="text-3xl w-full font-bold">Skills</div>
</div>
<ul class="list-disc md:columns-5 columns-2 mx-6">
    <?php foreach ( $skills as $item ) : ?>
    <li><?php echo esc_html( $item['name'] ); ?></li>
    <?php endforeach; ?>
</ul>
<?php endif; ?>

<?php
get_footer();
