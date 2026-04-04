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

// Collect all skills from defined skills + all entries
$all_skill_names = array();
foreach ( $skills as $s ) {
    $name = trim( $s['name'] ?? '' );
    if ( $name ) $all_skill_names[ strtolower( $name ) ] = $name;
}
foreach ( array_merge( $education, $experience, $certifications ) as $entry ) {
    $entry_skills = $entry['skills'] ?? '';
    if ( $entry_skills ) {
        foreach ( explode( ',', $entry_skills ) as $s ) {
            $s = trim( $s );
            if ( $s && ! isset( $all_skill_names[ strtolower( $s ) ] ) ) {
                $all_skill_names[ strtolower( $s ) ] = $s;
            }
        }
    }
}
?>

<div class="mb-5">
    <div class="text-3xl w-full font-bold">Profile</div>
</div>

<?php if ( $profile ) : ?>
<div class="mb-10 text-justify">
    <?php echo wp_kses_post( $profile ); ?>
</div>
<?php endif; ?>

<?php if ( ! empty( $all_skill_names ) ) : ?>
<div class="mb-5">
    <div class="text-3xl w-full font-bold">Skills</div>
</div>
<div class="flex flex-wrap gap-3 mb-10" id="cv-skill-filters">
    <button class="badge badge-lg badge-secondary cv-skill-btn whitespace-nowrap rounded-full cv-skill-active" data-skill="all">All</button>
    <?php foreach ( $all_skill_names as $lower => $display ) : ?>
    <button class="badge badge-lg badge-ghost cv-skill-btn whitespace-nowrap rounded-full" data-skill="<?php echo esc_attr( $lower ); ?>"><?php echo esc_html( $display ); ?></button>
    <?php endforeach; ?>
</div>
<?php endif; ?>

<?php if ( ! empty( $education ) ) : ?>
<div class="mb-5">
    <div class="text-3xl w-full font-bold">Education</div>
</div>
<div class="time-line-container grid gap-4 mb-10">
    <?php foreach ( $education as $item ) :
        $logo_url = ! empty( $item['logo_id'] ) ? wp_get_attachment_image_url( $item['logo_id'], 'thumbnail' ) : '';
        astrofy_timeline_element(
            $item['title'] ?? '',
            $item['subtitle'] ?? '',
            $item['description'] ?? '',
            $logo_url,
            $item['skills'] ?? ''
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
        $logo_url = ! empty( $item['logo_id'] ) ? wp_get_attachment_image_url( $item['logo_id'], 'thumbnail' ) : '';
        astrofy_timeline_element(
            $item['title'] ?? '',
            $item['subtitle'] ?? '',
            $item['description'] ?? '',
            $logo_url,
            $item['skills'] ?? ''
        );
    endforeach; ?>
</div>
<?php endif; ?>

<?php if ( ! empty( $certifications ) ) : ?>
<div class="mb-5">
    <div class="text-3xl w-full font-bold">Certifications</div>
</div>
<ul class="list-disc mx-6 mb-10 grid gap-2">
    <?php foreach ( $certifications as $item ) :
        $item_skills = $item['skills'] ?? '';
        $skills_array = $item_skills ? array_map( 'trim', explode( ',', $item_skills ) ) : array();
        $data_skills  = $item_skills ? esc_attr( implode( ',', array_map( 'strtolower', $skills_array ) ) ) : '';
    ?>
    <li class="cv-entry" <?php echo $data_skills ? 'data-skills="' . $data_skills . '"' : ''; ?>>
        <?php if ( ! empty( $item['url'] ) ) : ?>
        <a href="<?php echo esc_url( $item['url'] ); ?>" target="_blank"><?php echo esc_html( $item['name'] ); ?></a>
        <?php else : ?>
        <?php echo esc_html( $item['name'] ); ?>
        <?php endif; ?>
        <?php if ( ! empty( $skills_array ) ) : ?>
        <div class="flex flex-wrap gap-2 mt-1 inline">
            <?php foreach ( $skills_array as $skill ) : ?>
            <span class="badge badge-outline badge-sm py-2 px-3"><?php echo esc_html( trim( $skill ) ); ?></span>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
    </li>
    <?php endforeach; ?>
</ul>
<?php endif; ?>

<script>
(function () {
    var buttons = document.querySelectorAll('.cv-skill-btn');
    var entries = document.querySelectorAll('.cv-entry');
    if (!buttons.length || !entries.length) return;

    function resetAll() {
        buttons.forEach(function (b) {
            b.classList.remove('badge-secondary', 'cv-skill-active');
            b.classList.add('badge-ghost');
        });
        var allBtn = document.querySelector('.cv-skill-btn[data-skill="all"]');
        allBtn.classList.remove('badge-ghost');
        allBtn.classList.add('badge-secondary', 'cv-skill-active');
        entries.forEach(function (e) {
            e.style.opacity = '1';
            e.style.transition = 'opacity 0.2s';
        });
    }

    buttons.forEach(function (btn) {
        btn.addEventListener('click', function () {
            var skill = this.getAttribute('data-skill');

            if (skill === 'all') {
                resetAll();
                return;
            }

            // Toggle: if already active, deselect it
            if (this.classList.contains('cv-skill-active')) {
                resetAll();
                return;
            }

            // Activate this skill
            buttons.forEach(function (b) {
                b.classList.remove('badge-secondary', 'cv-skill-active');
                b.classList.add('badge-ghost');
            });
            this.classList.remove('badge-ghost');
            this.classList.add('badge-secondary', 'cv-skill-active');

            entries.forEach(function (e) {
                var entrySkills = (e.getAttribute('data-skills') || '').split(',');
                e.style.transition = 'opacity 0.2s';
                e.style.opacity = entrySkills.indexOf(skill) !== -1 ? '1' : '0.2';
            });
        });
    });
})();
</script>

<?php
get_footer();
