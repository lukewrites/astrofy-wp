<?php
/**
 * Theme Footer
 */
?>
            </main>
        </div>

        <footer class="footer footer-center block mb-5 pt-10">
            <div class="pb-2">
                &copy; <?php echo date( 'Y' ); ?> <?php bloginfo( 'name' ); ?>
            </div>
            <div class="inline opacity-75">
                The <a href="https://github.com/lukewrites/astrofy-wp" target="_blank" class="font-bold">Astrofy WP</a> theme is based on 
                <a href="https://astrofy-template.netlify.app/" target="_blank" class="font-bold">Astrofy Template &#9889;&#65039;</a>
            </div>
        </footer>

    </div>
    <?php
    // Include sidebar unless explicitly disabled (e.g. 404 page)
    global $astrofy_include_sidebar;
    $include_sidebar = isset( $astrofy_include_sidebar ) ? $astrofy_include_sidebar : true;
    if ( $include_sidebar ) {
        get_sidebar();
    }
    ?>
</div>

<?php wp_footer(); ?>
</body>
</html>
