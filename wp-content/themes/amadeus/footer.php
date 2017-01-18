<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Amadeus
 */
?>

	</div><!-- #content -->
	
	<?php if ( is_active_sidebar( 'sidebar-4' ) || is_active_sidebar( 'sidebar-5' ) || is_active_sidebar( 'sidebar-6' ) ) : ?>
		<?php get_sidebar( 'footer' ); ?>
	<?php endif; ?>

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="scroll-container">
			<a href="#" class="scrolltop"><i class="fa fa-chevron-up"></i></a>
		</div>
		<div class="site-info container">
			<?php do_action( 'amadeus_footer' ); ?>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
