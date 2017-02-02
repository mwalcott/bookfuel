<?php

namespace Roots\Sage\Extras;

use Roots\Sage\Setup;

/**
 * Add <body> classes
 */
function body_class($classes) {
  // Add page slug if it doesn't exist
  if (is_single() || is_page() && !is_front_page()) {
    if (!in_array(basename(get_permalink()), $classes)) {
      $classes[] = basename(get_permalink());
    }
  }

  // Add class if sidebar is active
  if (Setup\display_sidebar()) {
    $classes[] = 'sidebar-primary';
  }

  return $classes;
}
add_filter('body_class', __NAMESPACE__ . '\\body_class');

/**
 * Clean up the_excerpt()
 */
function excerpt_more() {
  return ' &hellip; <a href="' . get_permalink() . '">' . __('Continued', 'sage') . '</a>';
}
add_filter('excerpt_more', __NAMESPACE__ . '\\excerpt_more');

namespace Bookfuel;

add_image_size( 'book-size', 640, 960, true );

if( function_exists('acf_add_options_page') ) {
	
	acf_add_options_page(array(
		'page_title' 	=> 'Options',
		'menu_title'	=> 'Global Options',
	));	

}



// Content Builder ACF
function content_acf() { 

	// check if the flexible content field has rows of data
	if( have_rows('section') ):
	
		// loop through the rows of data
		while ( have_rows('section') ) : the_row();
		
			if( get_row_layout() == 'columns' )
			
				get_template_part('templates/columns');
							
			if( get_row_layout() == 'content_form' )
				
				get_template_part('templates/content-form');

			if( get_row_layout() == 'published_books' )
				
				get_template_part('templates/published-books');			

			if( get_row_layout() == 'carousel' )
				
				get_template_part('templates/carousel');			

			if( get_row_layout() == 'portfolio' )
				
				get_template_part('templates/portfolio');			
		
		endwhile;
	
	else :
	
		// no layouts found
	
endif;

}
add_action('below_content', __NAMESPACE__ . '\\content_acf');

function cart_items() {
	
	if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
	$count = WC()->cart->cart_contents_count;
	?>
	
			<?php 
				if ( $count > 0 ) { 
					$item = '';
					if( $count == 1 ) {
						$item = 'Item';	
					}
					else {
						$item = 'Items';
					}
					echo '<a class="cart-contents" href="'. WC()->cart->get_cart_url() .'" title="View Your Shopping Cart">';
					echo '<span>' . $count . '</span><i class="fa fa-shopping-cart" aria-hidden="true"></i>'; 
					echo '</a>';
				}
				else {
					echo ''; 
				}
			?>
	
	<?php 
	}
}
