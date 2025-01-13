<?php get_header(); ?>

<main id="content-container">
	<div class="header-img-wrap">
		<?php
		if ( has_post_thumbnail() ) :
			$headerImage = get_the_post_thumbnail_url( null, 'full' ); ?>
			<img src="<?php echo esc_url( $headerImage ); ?>" alt="<?php the_title_attribute(); ?>">
		<?php else : ?>
			<img src="<?php echo get_template_directory_uri(); ?>/assets/images/mta-communitytheme-bg-thumbnail.jpg"
				alt="MTA Header Image">
		<?php endif; ?>
		<div class="header-img-heading">
			<h1 class=""><?php echo the_title(); ?></h1>
		</div>
	</div>
	<div class="main-content">
		<div class="layout-container">
			<?php if ( have_posts() ) :
				while ( have_posts() ) :
					the_post(); ?>
					<div>
						<?php the_content(); ?>
					</div>
				<?php endwhile; endif; ?>
		</div>
		<div class="sidebar">
			<?php get_sidebar(); ?>
		</div>
	</div>
</main>

<?php get_footer(); ?>