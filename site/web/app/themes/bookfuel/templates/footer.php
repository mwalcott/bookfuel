<footer class="content-info">
  <div class="container">
    <?php dynamic_sidebar('sidebar-footer'); ?>
  </div>
	
	<?php 
		$socialBackground = '';
		$backgroundImage = get_field('social_background_image', 'option');
		if( $backgroundImage ) {
			$socialBackground = 'style="background-image: url('. $backgroundImage .');"';
		}
	?>
	
	<div class="container-fluid text-center social" <?php echo $socialBackground; ?>>
		<div class="container">
			<ul>
				<?php
				
				if( have_rows('social_accounts', 'option') ):
				
			    while ( have_rows('social_accounts', 'option') ) : the_row();
						
						$icon = '';
						$link = '';
						$provider = get_sub_field('provider', 'option');
						$account = get_sub_field('social_url', 'option');
		
						if( get_sub_field('provider', 'option') == 'facebook' ) {
							$icon = 'facebook';
						}
						elseif( get_sub_field('provider', 'option') == 'twitter' ) {
							$icon = 'twitter';
						}
						elseif( get_sub_field('provider', 'option') == 'googleplus' ) {
							$icon = 'google-plus';
						}
						elseif( get_sub_field('provider', 'option') == 'linkedin' ) {
							$icon = 'linkedin';
						}
						elseif( get_sub_field('provider', 'option') == 'pinterest' ) {
							$icon = 'pinterest';
						}
						elseif( get_sub_field('provider', 'option') == 'youtube' ) {
							$icon = 'youtube-play';
						}
						else {
							$icon = '';
						}
						
						$link .= '<li><a target="_blank" rel="nofollow" href="'. $account .'">';
						
						$link .= '<i class="fa fa-'. $icon .'" aria-hidden="true"></i>';
						
						$link .= '</a></li>';	
						
						echo $link;    	
			
			    endwhile;
				
				else :
				
					// no rows found
				
				endif;
				
				?>
			</ul>
		</div>
	</div>
  
  <div class="container text-center footer-lower">
	  
	  <nav>
		  <?php
		  if (has_nav_menu('footer_navigation')) :
		    wp_nav_menu(['theme_location' => 'footer_navigation', 'menu_class' => 'footer-nav']);
		  endif;
		  ?>
	  </nav>
	  
	  <p>
		  Copyright &copy; <?php echo date('Y'); ?> WaveCloud Corporation<br />
	  	<?php the_field('copyright_text', 'option'); ?>
	  </p>
	  
  </div>
	
</footer>
