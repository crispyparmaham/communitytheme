<?php get_header(); ?>

<main id="content-container">
	<div id="main" class="layout-container">

		<?php if ( have_posts() ) :
			while ( have_posts() ) :
				the_post(); ?>
				<h2><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
				<div>
					<?php the_content(); ?>
				</div>
			<?php endwhile; endif; ?>

		<?php

		?>

	</div>

	<div id="sidebar">
		<?php get_sidebar(); ?>
	</div>
</main>

<?php get_footer(); ?>