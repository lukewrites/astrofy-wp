<?php
/**
 * Template Tags / Helper Functions
 */

/**
 * Render a horizontal card (blog/project card).
 *
 * @param array $args {
 *   @type string $title
 *   @type string $img     URL to image
 *   @type string $desc    Description text
 *   @type string $url     Link URL
 *   @type string $badge   Optional badge text
 *   @type array  $tags    Optional array of tag names
 *   @type string $target  Link target, default '_self'
 * }
 */
function astrofy_horizontal_card( $args ) {
    $defaults = array(
        'title'  => '',
        'img'    => '',
        'desc'   => '',
        'url'    => '#',
        'badge'  => '',
        'tags'   => array(),
        'target' => '_self',
    );
    $args = wp_parse_args( $args, $defaults );
    ?>
    <div class="rounded-lg bg-base-100 hover:shadow-xl transition ease-in-out hover:scale-[102%]">
        <a href="<?php echo esc_url( $args['url'] ); ?>" target="<?php echo esc_attr( $args['target'] ); ?>">
            <div class="hero-content flex-col md:flex-row">
                <?php if ( $args['img'] ) : ?>
                <img src="<?php echo esc_url( $args['img'] ); ?>" width="750" height="422" alt="<?php echo esc_attr( $args['title'] ); ?>" class="max-w-full md:max-w-[13rem] rounded-lg" loading="lazy" />
                <?php endif; ?>
                <div class="grow w-full">
                    <h1 class="text-xl font-bold">
                        <?php echo esc_html( $args['title'] ); ?>
                        <?php if ( $args['badge'] ) : ?>
                        <div class="badge badge-secondary mx-2"><?php echo esc_html( $args['badge'] ); ?></div>
                        <?php endif; ?>
                    </h1>
                    <p class="py-1 text-1xl"><?php echo esc_html( $args['desc'] ); ?></p>
                    <?php if ( ! empty( $args['tags'] ) ) : ?>
                    <div class="card-actions justify-end">
                        <?php foreach ( $args['tags'] as $tag ) : ?>
                        <a href="<?php echo esc_url( home_url( '/blog/tag/' . sanitize_title( $tag ) . '/' ) ); ?>" class="badge badge-outline"><?php echo esc_html( $tag ); ?></a>
                        <?php endforeach; ?>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </a>
    </div>
    <?php
}

/**
 * Render a horizontal shop item card.
 *
 * @param array $args {
 *   @type string $title
 *   @type string $img
 *   @type string $desc
 *   @type string $url
 *   @type string $badge
 *   @type string $pricing
 *   @type string $oldPricing
 * }
 */
function astrofy_horizontal_shop_item( $args ) {
    $defaults = array(
        'title'      => '',
        'img'        => '',
        'desc'       => '',
        'url'        => '#',
        'badge'      => '',
        'pricing'    => '',
        'oldPricing' => '',
    );
    $args = wp_parse_args( $args, $defaults );
    ?>
    <div class="rounded-lg bg-base-100 hover:shadow-xl transition ease-in-out hover:scale-[102%]">
        <a href="<?php echo esc_url( $args['url'] ); ?>">
            <div class="hero-content flex-col md:flex-row">
                <?php if ( $args['img'] ) : ?>
                <img src="<?php echo esc_url( $args['img'] ); ?>" width="750" height="422" alt="<?php echo esc_attr( $args['title'] ); ?>" class="max-w-full md:max-w-[13rem] rounded-lg" loading="lazy" />
                <?php endif; ?>
                <div class="grow w-full p-5 md:p-0">
                    <h1 class="text-xl font-bold">
                        <?php echo esc_html( $args['title'] ); ?>
                        <?php if ( $args['badge'] ) : ?>
                        <div class="badge badge-secondary mx-2"><?php echo esc_html( $args['badge'] ); ?></div>
                        <?php endif; ?>
                    </h1>
                    <div>
                        <span class="text-xl mr-1"><?php echo esc_html( $args['pricing'] ); ?></span>
                        <?php if ( $args['oldPricing'] ) : ?>
                        <span class="text-md opacity-50 line-through"><?php echo esc_html( $args['oldPricing'] ); ?></span>
                        <?php endif; ?>
                    </div>
                    <p class="py-1 text-1xl"><?php echo esc_html( $args['desc'] ); ?></p>
                </div>
            </div>
        </a>
    </div>
    <?php
}

/**
 * Render a timeline element for the CV page.
 */
function astrofy_timeline_element( $title, $subtitle, $content = '', $logo_url = '', $skills = '' ) {
    $skills_array = $skills ? array_map( 'trim', explode( ',', $skills ) ) : array();
    $data_skills  = $skills ? esc_attr( implode( ',', array_map( 'strtolower', $skills_array ) ) ) : '';
    ?>
    <div class="flex cv-entry mb-6" <?php echo $data_skills ? 'data-skills="' . $data_skills . '"' : ''; ?>>
        <div class="education__time">
            <span class="w-4 h-4 bg-primary block rounded-full mt-1"></span>
            <span class="education__line bg-primary block h-full w-[2px] translate-x-[7px]"></span>
        </div>
        <div class="experience__data bd-grid px-5">
            <div class="flex items-center gap-3 mb-1">
                <?php if ( $logo_url ) : ?>
                <img src="<?php echo esc_url( $logo_url ); ?>" alt="" class="flex-shrink-0 object-contain" style="width:40px;height:40px;" loading="lazy" />
                <?php endif; ?>
                <div>
                    <h3 class="font-semibold"><?php echo esc_html( $title ); ?></h3>
                    <span class="font-light text-sm"><?php echo esc_html( $subtitle ); ?></span>
                </div>
            </div>
            <?php if ( $content ) : ?>
            <p class="my-2 text-justify"><?php echo wp_kses_post( $content ); ?></p>
            <?php endif; ?>
            <?php if ( ! empty( $skills_array ) ) : ?>
            <div class="flex flex-wrap gap-2 mt-3">
                <?php foreach ( $skills_array as $skill ) : ?>
                <span class="badge badge-outline badge-sm py-2 px-3"><?php echo esc_html( trim( $skill ) ); ?></span>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>
        </div>
    </div>
    <?php
}

/**
 * Render pagination with prev/next arrows matching Astro markup.
 *
 * @param string $prev_label Label for previous link (default 'Recent posts')
 * @param string $next_label Label for next link (default 'Older Posts')
 */
function astrofy_pagination( $prev_label = 'Recent posts', $next_label = 'Older Posts' ) {
    $prev_link = get_previous_posts_link();
    $next_link = get_next_posts_link();

    if ( ! $prev_link && ! $next_link ) {
        return;
    }
    ?>
    <div class="flex justify-between">
        <?php if ( get_previous_posts_page_link() && get_query_var( 'paged' ) > 1 ) : ?>
        <a href="<?php echo esc_url( get_previous_posts_page_link() ); ?>" class="btn btn-ghost my-10 mx-5">
            <svg class="h-6 w-6 fill-current md:h-8 md:w-8" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M15.41,16.58L10.83,12L15.41,7.41L14,6L8,12L14,18L15.41,16.58Z"/></svg>
            <?php echo esc_html( $prev_label ); ?>
        </a>
        <?php else : ?>
        <div></div>
        <?php endif; ?>

        <?php
        global $wp_query;
        $max_pages = $wp_query->max_num_pages;
        $paged     = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
        if ( $paged < $max_pages ) : ?>
        <a href="<?php echo esc_url( get_next_posts_page_link() ); ?>" class="btn btn-ghost my-10 mx-5">
            <?php echo esc_html( $next_label ); ?>
            <svg class="h-6 w-6 fill-current md:h-8 md:w-8" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M8.59,16.58L13.17,12L8.59,7.41L10,6L16,12L10,18L8.59,16.58Z"/></svg>
        </a>
        <?php else : ?>
        <div></div>
        <?php endif; ?>
    </div>
    <?php
}
