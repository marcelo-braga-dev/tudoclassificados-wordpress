<?php

/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package customify
 */

?> <?php do_action('customify/main/after'); ?>
</main><!-- #main -->
<?php do_action('customify/sidebars'); ?>
</div><!-- #.customify-grid -->
</div><!-- #.customify-container -->
</div><!-- #content -->
<?php
/**
 * Hook before site content
 *
 * @since 0.2.2
 */
do_action('customify/after-site-content');

do_action('customify/site-end/before');
if (!customify_is_e_theme_location('footer')) {
	/**
	 * Site end
	 *
	 * @hooked customify_customize_render_footer - 10
	 *
	 * @see customify_customize_render_footer
	 */
	do_action('customify/site-end');
}
do_action('customify/site-end/after');

?>
</div><!-- #page -->
<?php
	require_once ABSPATH.'wp-functions/config/footer.php';
	wp_footer();
?>
<script>
            $(document).ready(function() {
                $('#mobile').mask('(00) 0 0000-0000');
            });    
        </script>

</body>

</html>