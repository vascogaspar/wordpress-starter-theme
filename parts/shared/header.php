<nav id="nav_principal">
  <div class="container">
    <div class="navbar-header">
      <a class="navbar-brand" href="<?php echo home_url(); ?>">
        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/logo.png" />
			</a>
    </div>
	  <?php
      wp_nav_menu( array(
        'menu'              => 'primary',
        'theme_location'    => 'primary',
        'depth'             => 2,
        'container'         => false,
        'menu_class'        => 'nav navbar-nav',
        'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
        'walker'            => new wp_bootstrap_navwalker())
      );
    ?>
  </div>
</nav>
