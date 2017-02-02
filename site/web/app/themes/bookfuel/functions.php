<?php
/**
 * Sage includes
 *
 * The $sage_includes array determines the code library included in your theme.
 * Add or remove files to the array as needed. Supports child theme overrides.
 *
 * Please note that missing files will produce a fatal error.
 *
 * @link https://github.com/roots/sage/pull/1042
 */
$sage_includes = [
  'lib/assets.php',    // Scripts and stylesheets
  'lib/extras.php',    // Custom functions
  'lib/setup.php',     // Theme setup
  'lib/titles.php',    // Page titles
  'lib/wrapper.php',   // Theme wrapper class
  'lib/customizer.php' // Theme customizer
];

foreach ($sage_includes as $file) {
  if (!$filepath = locate_template($file)) {
    trigger_error(sprintf(__('Error locating %s for inclusion', 'sage'), $file), E_USER_ERROR);
  }

  require_once $filepath;
}
unset($file, $filepath);

function below_content() {
	do_action('below_content');
}

function below_grouped_products() {
	do_action('below_grouped_products');
}


remove_action('woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20);
remove_action('woocommerce_after_single_product_summary','woocommerce_output_product_data_tabs', 10);
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );

function wc_remove_related_products( $args ) {
	return array();
}
add_filter('woocommerce_related_products_args','wc_remove_related_products', 10); 

add_filter( 'woocommerce_product_type_grouped', 'woo_custom_cart_button_text' );    // 2.1 +
 

/*PUT THIS IN YOUR CHILD THEME FUNCTIONS FILE*/
/*STEP 1 - REMOVE ADD TO CART BUTTON ON PRODUCT ARCHIVE (SHOP) */
function remove_loop_button(){
	remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
}
add_action('init','remove_loop_button');

/*STEP 2 -ADD NEW BUTTON THAT LINKS TO PRODUCT PAGE FOR EACH PRODUCT */
add_action('woocommerce_after_shop_loop_item','replace_add_to_cart');
function replace_add_to_cart() {
	global $product;
	$link = $product->get_permalink();
	echo do_shortcode('<a href="'.$link.'" class="button add_to_cart_button">Learn More</a>');
}

function add_loginout_link( $items, $args ) {
	if (is_user_logged_in() && $args->theme_location == 'user_navigation') {
		$items .= '<li class="menu-item menu-my-account"><a href="/my-account"><i class="fa fa-user" aria-hidden="true"></i> My Account</a></li>';
		$items .= '<li class="menu-item menu-logout"><a href="'. wp_logout_url() .'">Logout</a></li>';
	}
	elseif (!is_user_logged_in() && $args->theme_location == 'user_navigation') {
		$items .= '<li class="menu-item menu-login"><a href="/my-account"><i class="fa fa-user" aria-hidden="true"></i> Login</a></li>';
	}
	return $items;
}
add_filter( 'wp_nav_menu_items', 'add_loginout_link', 10, 2 );

function cart_link( $items, $args ) {
    if ( $args->theme_location == 'primary_navigation') {
	    
    	$items .= Bookfuel\cart_items();
    }
    return $items;
}
add_filter( 'wp_nav_menu_items', 'cart_link', 50, 2 );
