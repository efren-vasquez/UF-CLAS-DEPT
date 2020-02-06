<?php
/**
 * Newsletter header
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package UFCLAS_emily
 */

	$newsletter_data = ufclas_emily_newsletter_data();
	$issue_data = ufclas_emily_issuem_issue_data();

	$shortcode = sprintf( '[ufl-landing-page-hero headline="%s" subtitle="%s" image="%s" image_height="%s"]%s[/ufl-landing-page-hero]',
		$newsletter_data['title'],
		$newsletter_data['subtitle'],
		$newsletter_data['cover'],
		$newsletter_data['image_height'],
		''
	);
	echo do_shortcode( $shortcode );

	// Newsletter menu
	if ( has_nav_menu( 'newsletter-menu' ) ): ?>
  		<nav id="site-navigation" class="navbar navbar-inverse subnav subnav-dark" role="navigation">
    		<div class="container">
      		<?php
      		wp_nav_menu( array(
      			'theme_location' => 'newsletter-menu',
      			'depth' => 2,
      			'container' => 'div',
      			'container_class' => 'collapse navbar-collapse',
      			'container_id' => 'newsletter-menu-navbar',
      			'menu_class' => 'nav navbar-nav',
      		));
      		?>
    		</div>
    	</nav>
<?php
endif;
?>
