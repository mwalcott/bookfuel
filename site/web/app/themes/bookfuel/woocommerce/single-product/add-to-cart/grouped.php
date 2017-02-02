<?php
/**
 * Grouped product add to cart
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/add-to-cart/grouped.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see 	    http://docs.woothemes.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.1.7
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product, $post;

$parent_product_post = $post;

do_action( 'woocommerce_before_add_to_cart_form' ); ?>

<form class="cart" method="post" enctype='multipart/form-data'>
	<div class="group_table row text-center column-section row-eq-height">
			<?php
				foreach ( $grouped_products as $product_id ) :
					if ( ! $product = wc_get_product( $product_id ) ) {
						continue;
					}

					if ( 'yes' === get_option( 'woocommerce_hide_out_of_stock_items' ) && ! $product->is_in_stock() ) {
						continue;
					}

					$post    = $product->post;
					setup_postdata( $post );
					?>

						<div class="col-sm-4 columns">
							<div class="column-inner">

								<header class="col-heading">
									<h3>
										<?php echo $product->is_visible() ? '<a href="' . esc_url( apply_filters( 'woocommerce_grouped_product_list_link', get_permalink(), $product_id ) ) . '">' . esc_html( get_the_title() ) . '</a>' : esc_html( get_the_title() ); ?>
									</h3>
								</header>						

								<p class="col-price">
									<?php
										echo $product->get_price_html();
		
										if ( $availability = $product->get_availability() ) {
											$availability_html = empty( $availability['availability'] ) ? '' : '<p class="stock ' . esc_attr( $availability['class'] ) . '">' . esc_html( $availability['availability'] ) . '</p>';
											echo apply_filters( 'woocommerce_stock_html', $availability_html, $availability['availability'], $product );
										}
									?>
									<?php if( get_field('per') ) { ?>
										<span class="per">/<?php the_field('per'); ?></span>
									<?php } ?>
								</p>
								
								<?php the_excerpt(); ?>

								<?php if ( $product->is_sold_individually() || ! $product->is_purchasable() ) : ?>
									<?php woocommerce_template_loop_add_to_cart(); ?>
								<?php else : ?>
									<a class="btn btn-lg btn-primary-outline" data-toggle="modal" data-target="#<?php echo $post->post_name;?>">Add to Cart</a>
								<?php endif; ?>

								<!-- Button trigger modal -->
								<a class="learn-more" data-toggle="modal" data-target="#<?php echo $post->post_name;?>">
								  Learn More
								</a>
						
								<!-- Modal -->
								<div class="modal fade" id="<?php echo $post->post_name;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
								  <div class="modal-dialog modal-lg text-left" role="document">
								    <div class="modal-content">
								      <div class="modal-header">
								        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								        <h4 class="modal-title" id="myModalLabel"><?php echo get_the_title(); ?></h4>
								      </div>
								      <div class="modal-body">
									      
									      <div class="row">
										      <div class="col-sm-8">
											      <?php the_content(); ?>
										      </div>
										      <div class="col-sm-4">
											      <div class="modal-price">
															<?php
																echo $product->get_price_html();
								
																if ( $availability = $product->get_availability() ) {
																	$availability_html = empty( $availability['availability'] ) ? '' : '<p class="stock ' . esc_attr( $availability['class'] ) . '">' . esc_html( $availability['availability'] ) . '</p>';
																	echo apply_filters( 'woocommerce_stock_html', $availability_html, $availability['availability'], $product );
																}
															?>										      
															<?php if( get_field('per') ) { ?>
																<span class="per">/<?php the_field('per'); ?></span>
															<?php } ?>
											      </div>
														
														<div class="modal-add-to-cart">
														<div class="quantity-add clearfix">
															<?php if ( $product->is_sold_individually() || ! $product->is_purchasable() ) : ?>
																<?php woocommerce_template_loop_add_to_cart(); ?>
															<?php else : ?>
															<label class="quantity-label">How many <?php the_field('per'); ?>s?</label>
																<?php
																	$quantites_required = true;
																	woocommerce_quantity_input( array(
																		'input_name'  => 'quantity[' . $product_id . ']',
																		'input_value' => ( isset( $_POST['quantity'][$product_id] ) ? wc_stock_amount( $_POST['quantity'][$product_id] ) : 0 ),
																		'min_value'   => apply_filters( 'woocommerce_quantity_input_min', 0, $product ),
																		'max_value'   => apply_filters( 'woocommerce_quantity_input_max', $product->backorders_allowed() ? '' : $product->get_stock_quantity(), $product )
																	) );
																?>
		
																<?php if ( $quantites_required ) : ?>
															
																	<?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>
															
																	<button type="submit" class="single_add_to_cart_button button alt"><?php echo $product->single_add_to_cart_text(); ?></button>
															
																	<?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>
															
																<?php endif; ?>
		
															<?php endif; ?>
														</div>
															
														</div>
	
										      </div>
									      </div>
									      
									      
													<?php 
													
													$images = get_field('gallery');
													
													if( $images ): ?>
														<div class="row gallery">
											        <?php foreach( $images as $image ): ?>
										            <div class="col-sm-3 col-xs-3">
										            	<img src="<?php echo $image['sizes']['book-size']; ?>" alt="<?php echo $image['alt']; ?>" class="img-responsive" />
										            </div>
											        <?php endforeach; ?>
											      </div>									      
													<?php endif; ?>	
									      
																							      
										      
								        
								      </div>
								      <div class="modal-footer">
	
												<i class="fa fa-phone" aria-hidden="true"></i> <?php the_field('phone_number', 'option'); ?>
	
								      </div>
								    </div>
								  </div>
								</div>
								<!-- End Modal -->
																
								<?php do_action ( 'woocommerce_grouped_product_list_before_price', $product ); ?>

						
							</div>
						</div>


					<?php
				endforeach;

				// Reset to parent grouped product
				$post    = $parent_product_post;
				$product = wc_get_product( $parent_product_post->ID );
				setup_postdata( $parent_product_post );
			?>
	</div>

	<input type="hidden" name="add-to-cart" value="<?php echo esc_attr( $product->id ); ?>" />

</form>

<?php do_action( 'woocommerce_after_add_to_cart_form' ); ?>
