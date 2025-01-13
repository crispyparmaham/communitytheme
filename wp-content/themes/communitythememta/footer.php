<?php wp_footer(); ?>

<footer>
	<div class="footer-container">
		<p>&copy; <?php echo date( 'Y' ); ?> <?php bloginfo( 'name' ); ?></p>
		<?php
		wp_nav_menu( array(
			'theme_location' => 'footer', // Hier wird das Footer-Menü eingebunden
			'menu_id' => 'footer-menu',
		) );
		?>
	</div>
</footer>
</body>
</html>