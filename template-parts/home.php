<?php
/**
 * Template Name: Home Page
 *
 * @package Exoplanet
 */

get_header();
$disable_slider = get_theme_mod('disable_slider');
if(!$disable_slider){
	exoplanet_slider();
}

$whatsnew_args = array(
    'post_type' => 'whatsnew',
    'posts_per_page' => 5, /* 表示する数 */
); 
$whatsnew_query = new WP_Query( $whatsnew_args );  
?>
<section class="section">
	<div class="container clearfix">
		<div style="margin-top:15px;padding: 0% 10%;">
			<h2 class="section-title">新着情報</h2>
            <ul>    
                <?php while ( $whatsnew_query->have_posts() ) : $whatsnew_query->the_post(); ?>
                <li>
                    <?php $url = get_field('url'); ?>
                    <?php if($url){ ?><a href='<?php echo $url ?>'> <?php } ?>
                    <?php echo get_field('publication_date') ?>&nbsp;<?php the_title(); ?>
                    <?php if($url){ ?></a><?php } ?>
                </li>
                <?php endwhile; ?>
            </ul>
        </div>
    </div>
</section>
<?php
$disable_featured = get_theme_mod('disable_featured');
if(!$disable_featured){
	$enable_featured_link = get_theme_mod('enable_featured_link', true);
?>
<section id="featured-post-section" class="section">
	<div class="container">
	<?php $featured_title = get_theme_mod('featured_title');
		if ( $featured_title ) {
	?>
		<div class="featured-section-title">
			<span><?php echo esc_html( $featured_title );?></span>
		</div>
	<?php
		}
	?>
		<div class="featured-post-wrap clearfix">
			<?php
			$featured_page_link1 = get_theme_mod('featured_page_link1');
			if (!$featured_page_link1) {
			 	# display latest posts
				$exoplanet_recent_args = array(
					'numberposts' => '4',
					'orderby' => 'post_date',
					'order' => 'DESC',
					'post_type' => 'post',
					'post_status' => 'publish',
					'suppress_filters' => false
					);
				$recent_posts = wp_get_recent_posts( $exoplanet_recent_args );
				$featured_post_number = 1;
				foreach( $recent_posts as $recent ){
					$featured_page_icon = get_theme_mod('featured_page_icon'.$featured_post_number, 'fa fa-check');
					?>
					<div class="featured-post featured-post<?php echo $featured_post_number; ?>">
						<a href="<?php echo esc_url( get_permalink( $recent["ID"] ) ); ?>"><span class="featured-icon"><i class="<?php echo esc_attr( $featured_page_icon ); ?>"></i></span>
						<h4><?php echo get_the_title($recent["ID"]); ?></h4></a>
						<div class="featured-excerpt">
						<?php
						//$featured_page_excerpt = get_the_excerpt($recent["ID"]);//doesn't work as expected because if excerpt is empty it defaults to current page excerpt then current page content
						$featured_page_excerpt = apply_filters('the_excerpt', get_post_field('post_excerpt', $recent["ID"]));
						if ('' != $featured_page_excerpt) {
							echo $featured_page_excerpt;
						} else {
							$featured_page_content = get_post($recent["ID"])->post_content;
							echo '<p>' . exoplanet_excerpt_words($featured_page_content,10) . '</p>';
						}
						?>
						<a href="<?php echo esc_url( get_permalink( $recent["ID"] ) ); ?>" class="button featured-readmore"><?php echo esc_html__( 'Read More', 'exoplanet' );?></a>
						</div>
					</div>
					<?php
					$featured_post_number++;
				}
				wp_reset_postdata();
			} else {
				# display chosen
				for( $i = 1; $i < 5; $i++ ){
					$featured_page_icon = get_theme_mod('featured_page_icon'.$i, 'fa fa-check');
					$featured_page_link = exoplanet_wpml_page_id( get_theme_mod('featured_page_link'.$i) );					
					if($featured_page_link){
					?>
					<div class="featured-post featured-post<?php echo $i ;?>">
						<a href="<?php echo esc_url( get_page_link( $featured_page_link ) ); ?>"><span class="featured-icon"><i class="<?php echo esc_attr( $featured_page_icon ); ?>"></i></span>
						<h4><?php echo get_the_title($featured_page_link); ?></h4></a>
						<div class="featured-excerpt">
						<?php
						$featured_page_excerpt = apply_filters('the_excerpt', get_post_field('post_excerpt', $featured_page_link));
						if ('' != $featured_page_excerpt) {
							echo $featured_page_excerpt;
						} else {
							$featured_page_content = get_post($featured_page_link)->post_content;
							echo '<p>' . exoplanet_excerpt_words($featured_page_content,10) . '</p>';
						}
						if($enable_featured_link){
						?>
						<a href="<?php echo esc_url( get_page_link( $featured_page_link ) ); ?>" class="button featured-readmore"><?php echo esc_html__( 'Read More', 'exoplanet' );?></a>
						<?php
						}
						?>
						</div>
					</div>
				<?php
					}
				}
			}
			?>
		</div>
	</div>
</section>
<?php }

$exoplanet_font_page_content = get_theme_mod('exoplanet_font_page_content');					
if($exoplanet_font_page_content){
?>
<div class="container">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part('template-parts/content', 'page'); ?>

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
<?php
}

$disable_about_sec = get_theme_mod('disable_about_sec');
if(!$disable_about_sec){
	$about_page_link = exoplanet_wpml_page_id( get_theme_mod('about_page_link') );
?>
<section id="about-us-section" class="section">
	<div class="container clearfix">
		<div class="about-sec">
		<?php if (!$about_page_link) {
			 # display a random post
			$exoplanet_about_args = array(
				'numberposts'		=> 1,
				'orderby'			=> 'rand',
				'post_type'			=> 'post',
				'post_status'		=> 'publish',
				'suppress_filters' => false
				);
			$about_posts = get_posts( $exoplanet_about_args );
			foreach ( $about_posts as $post ) { 
  				setup_postdata( $post ); ?>
			<h2 class="section-title"><?php the_title(); ?></h2>
			<div class="content">
			<?php
			$about_page_excerpt = get_post($post)->post_excerpt;;
			if ('' != $about_page_excerpt) {
				echo '<p><span style="font-size: 125%;">' . esc_html( $about_page_excerpt ) . '</span></p>';
			}
			$about_page_content = get_the_content(); ?>
			<p><?php echo exoplanet_excerpt_words($about_page_content,50);?></p>
			</div>
		</div>
		<?php if ( has_post_thumbnail() ) {
			$about_image = get_the_post_thumbnail_url();
		} else {
			$about_image = get_template_directory_uri().'/images/exoplanet-placeholder.jpg';
		}
		?>
		<div class="about-image">
			<a href="<?php the_permalink(); ?>"><img src="<?php echo esc_url( $about_image ); ?>" /></a>
		</div>
			<?php }
			wp_reset_postdata();
		} else {
			# display chosen
		?>
			<h2 class="section-title"><?php echo get_the_title($about_page_link); ?></h2>
			<div class="content">
			<?php
			$about_page_excerpt = get_post($about_page_link)->post_excerpt;
			if ('' != $about_page_excerpt) {
				echo '<p><span style="font-size: 125%;">' . esc_html( $about_page_excerpt ) . '</span></p>';
			}
			$about_page_content = get_post($about_page_link)->post_content; ?>
			<p><?php echo exoplanet_excerpt_words($about_page_content,50);?></p>
			</div>
		</div>
		<?php if ( has_post_thumbnail($about_page_link) ) {
			$about_image = get_the_post_thumbnail_url($about_page_link, 'large');
		} else {
			$about_image = get_template_directory_uri().'/images/exoplanet-placeholder.jpg';
		}
		?>
		<div class="about-image">
			<a href="<?php echo esc_url( get_page_link( $about_page_link ) ); ?>"><img src="<?php echo esc_url( $about_image ); ?>" /></a>
		</div>
		<?php } ?>
	</div>
</section>
<?php } 

$disable_cta_sec = get_theme_mod('disable_cta_sec');
if(!$disable_cta_sec){
	$cta_link = exoplanet_wpml_page_id( get_theme_mod('cta_link') );
	if ( $cta_link ) {
	$cta_button = get_theme_mod('cta_button', esc_html__( 'Read More', 'exoplanet' ));
?>
<section id="cta-section" class="section">
	<div class="container clearfix">
		<div class="cta-left">
			<p><span class="leadin"><?php echo get_the_title($cta_link); ?></span></p>
			<?php
			$cta_excerpt = get_post($cta_link)->post_excerpt;
			if ( $cta_excerpt != '' ) {
				echo '<p>'.esc_html( $cta_excerpt ).'</p>';
			}
			?>
		</div>
		<div class="cta-right">
		<a href="<?php echo esc_url( get_permalink( $cta_link ) ); ?>"><?php echo esc_html( $cta_button ); ?></a>
		</div>
	</div>
</section>
<?php }
}
get_footer();