<?php
/**
 * The template for displaying all single posts
 *
 * @package Exoplanet
 */

get_header();
$page_header_position = get_theme_mod('page_header_position','header');
if ($page_header_position == "content") {
?>
<header class="main-header">
</header>
<div class="container">
	<div class="title-header single-header-title">
		<?php 
		the_title('<h1 class="main-title"><span>', '</span></h1>'); 
		$enable_bread = get_theme_mod('enable_bread', true);
		if ($enable_bread) {
			exoplanet_breadcrumb_trail();
		}
		?>
	</div>
<?php
} else {
?>
<header class="main-header">
	<div class="container">
		<div class="header-title single-header-title">
			<?php 
			the_title('<h1 class="main-title">', '</h1>'); 
			$enable_bread = get_theme_mod('enable_bread', true);
			if ($enable_bread) {
				exoplanet_breadcrumb_trail();
			}
			?>
		</div>
	</div>
</header><!-- .entry-header -->
<div class="container">
<?php
}
?>
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part('template-parts/content', 'single'); ?>

			<?php
				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;
			?>

		<?php endwhile; // End of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
</div>

<?php get_footer(); ?>
