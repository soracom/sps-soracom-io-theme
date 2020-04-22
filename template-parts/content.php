<?php
/**
 * Template part for displaying posts
 *
 * @package Exoplanet
 */

$exoplanet_overlap = get_theme_mod('blog_img_overlap','overlap');
if ( $exoplanet_overlap == 'no-overlap' ) {
	$exoplanet_overlap = esc_html(' no-overlap');
} else {
	$exoplanet_overlap = '';
}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="archive-entry">
		<figure class="entry-figure<?php echo $exoplanet_overlap;?>">
			<?php if ( has_post_thumbnail() ) : ?>
			<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
			<?php the_post_thumbnail('medium'); ?>
			</a>
			<?php endif; ?>
		</figure>
		<div class="post-wrapper<?php echo $exoplanet_overlap;?>">
			<header class="entry-header">
				<?php the_title( sprintf('<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>'); ?>

				<?php if ('post' === get_post_type() ) : ?>
				<div class="entry-meta">
					<?php exoplanet_posted_on(); ?>
				</div><!-- .entry-meta -->
				<?php endif; ?>
			</header><!-- .entry-header -->

			<div class="entry-content">
				<?php the_excerpt(); ?>

				<?php
					wp_link_pages( array(
						'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'exoplanet' ),
						'after'  => '</div>',
					) );
				?>

				<?php if ('post' === get_post_type()) : ?>
				<a class="more-tag" href="<?php echo esc_url( get_the_permalink() ); ?>"><?php esc_html_e( 'Continue Reading', 'exoplanet' ); ?></a>
				<?php endif; ?>

			</div><!-- .entry-content -->

			<footer class="entry-footer">
				<?php exoplanet_entry_footer(); ?>
			</footer><!-- .entry-footer -->
		</div>
	</div><!-- .archive-entry -->
</article><!-- #post-## -->
