<?php
/**
 * The main template file
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
	<div class="title-header">
	<?php
		$enable_bread = get_theme_mod('enable_bread', true);
		if ($enable_bread) {
			exoplanet_breadcrumb_trail();
		}
	}
	?>
	</div>
<?php
} else {
?>
<header class="main-header">
		<div class="container">
			<div class="header-title">
				<?php
				$enable_bread = get_theme_mod('enable_bread', true);
				if ($enable_bread) {
					exoplanet_breadcrumb_trail();
				}
				?>
			</div>
		</div>
	<?php
	}
	?>
</header><!-- .entry-header -->
<div class="container">
<?php
}
?>
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) : ?>

			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part('template-parts/content'); ?>

			<?php endwhile; ?>

			<?php the_posts_pagination(); ?>

		<?php else : ?>

			<?php get_template_part('template-parts/content', 'none'); ?>

		<?php endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
</div>

<?php get_footer(); ?>
