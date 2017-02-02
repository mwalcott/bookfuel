<header class="banner">
	<div class="container-fluid top-bar hidden-xs">
		<div class="container">
	    <?php
	    if (has_nav_menu('user_navigation')) :
	      wp_nav_menu(['theme_location' => 'user_navigation', 'menu_class' => 'nav pull-right']);
	    endif;
	    ?>
			<ul class="pull-right top-nav">
				<?php if( get_field('phone_number', 'option') ) { ?>
					<li class="phone"><i class="fa fa-phone" aria-hidden="true"></i> <?php the_field('phone_number', 'option'); ?></li>
				<?php	} ?>
				<li><a href="mailto:support@bookfuel.com"><i class="fa fa-envelope-o" aria-hidden="true"></i> support@bookfuel.com</a></li>
			</ul>
		</div>

	</div>
  <div class="container">
	  <a class="visible-xs pull-left hamburger" href="#nav-mobile"><i class="fa fa-bars" aria-hidden="true"></i></a>
		<?php if( get_field('phone_number', 'option') ) { ?>
			<a class="visible-xs pull-right phone" href="tel:<?php the_field('phone_number', 'option'); ?>"><i class="fa fa-phone" aria-hidden="true"></i></li>
		<?php	} ?>
    <a class="brand" href="<?= esc_url(home_url('/')); ?>">
	    <i class="icon-ico-bf"></i> <span class="hidden-xs">Book<strong>Fuel</strong></span>
	  </a>

    <nav class="nav-primary pull-right hidden-xs">
      <?php
      if (has_nav_menu('primary_navigation')) :
        wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'nav pull-right']);
      endif;
      ?>
    </nav>
  </div>
</header>
