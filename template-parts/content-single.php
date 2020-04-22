<?php
/**
 * Template part for displaying single posts
 *
 * @package Exoplanet
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="single-entry">
		<div class="entry-thumbnail"><?php the_post_thumbnail(); ?></div>
		<div class="entry-meta">
			<?php exoplanet_posted_on(); ?>
		</div><!-- .entry-meta -->

		<div class="entry-content single-entry-content">
			<?php the_content(); ?>
			<?php
				wp_link_pages( array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'exoplanet' ),
					'after'  => '</div>',
				) );
			?>
		</div><!-- .entry-content -->

		<footer class="entry-footer">
			<?php exoplanet_entry_footer(); ?>
		</footer><!-- .entry-footer -->
	</div><!-- .single-entry -->
</article><!-- #post-## -->

