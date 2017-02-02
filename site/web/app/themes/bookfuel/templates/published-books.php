<section class="container-fluid books-section">
	
	<div class="container section-head">
		
		<div class="row text-center">
			
			<div class="col-sm-12">
				
				<h2><?php echo get_sub_field('pub_heading'); ?></h2>
				
				<div class="row">
					<div class="col-sm-8 col-sm-offset-2">
						<?php the_sub_field('pub_content'); ?>
					</div>
				</div>
				
			</div>
			
		</div>
		
	</div>


	<div class="row">
		<?php
		
			$args = array(
				'post_type' => 'published-books',
				'order' => 'DESC',
				'orderby' => 'date',
				'posts_per_page' => 12
			);
		
			// The Query
			$the_query = new WP_Query( $args );
			
			// The Loop
			if ( $the_query->have_posts() ) {
		
				while ( $the_query->have_posts() ) {
					$the_query->the_post();
					
					echo '<div class="col-xs-3 col-sm-2 book">';
					
						the_post_thumbnail( 'book-size', array( 'class' => 'img-responsive' ) );
					
					echo '</div>';
					
				}
		
			} else {
				// no posts found
			}
			/* Restore original Post Data */
			wp_reset_postdata();	
		
		?>
	</div>
	
	<div class="container text-center view-all">
		<a class="btn btn-default btn-lg" href="/published-books">View All</a>
	</div>
	
</section>