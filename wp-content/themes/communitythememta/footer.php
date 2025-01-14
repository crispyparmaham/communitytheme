<?php wp_footer(); ?>

<footer class="main-footer">
	<div class="footer-inner-wrap">
        <div class="footer-top">
		<?php
		// Logo von der Optionsseite abrufen
		$logo = get_field( 'logo_footer', 'option' );
		$logo_size = get_field( 'logo_size_footer', 'option' );

		if ( $logo ) :
			$logo_class = '';
			$logo_style = '';

			switch ( $logo_size ) {
				case 'small':
					$logo_class = 'logo-small';
					break;
				case 'medium':
					$logo_class = 'logo-medium';
					break;
				case 'large':
					$logo_class = 'logo-large';
					break;
			}
			?>
			<div class="main-logo <?php echo esc_attr( $logo_class ); ?>">
				<a href="/"><img src="<?php echo esc_url( $logo['url'] ); ?>" alt="<?php echo esc_attr( $logo['alt'] ); ?>"
						<?php echo $logo_style; ?>></a>
			</div>
		<?php else : ?>
			<h1><a href="<?php echo esc_url( home_url() ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
		<?php endif; ?>

		<?php
		$selected_menu_id = get_field( 'selected_menu', 'option' );

		if ( $selected_menu_id ) :
			wp_nav_menu( array(
				'menu' => $selected_menu_id,
				'container' => 'nav',
				'container_class' => 'main-navigation',
			) );
		else :
			echo '<p>' . __( 'Kein Menü ausgewählt.', 'communitytheme' ) . '</p>';
		endif;

		?>
        </div>
		<div class="footer-bottom">
			<div class="footer-copyright">
				<span>&copy; <?php echo date( 'Y' ); ?> <?php bloginfo( 'name' ); ?></span>
			</div>
            <div class="footer-policy">
                <a href="/impressum">Impressum</a>
                <a href="/datenschutz">Datenschutz</a>
            </div>
		</div>
	</div>

</footer>
</body>

</html>