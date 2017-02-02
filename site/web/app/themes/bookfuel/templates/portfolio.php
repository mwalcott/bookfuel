<section class="container-fluid">
	
	<div class="container section-head text-center">
		<div class="row">
			<div class="col-sm-12">
				<h2><?php the_sub_field('port_heading'); ?></h2>
				
				<?php if( get_sub_field('port_content') ) { ?>
				
					<div class="row">
						<div class="col-sm-8 col-sm-offset-2">
							<?php the_sub_field('port_content'); ?>
						</div>
					</div>
				
				<?php } ?>
				
			</div>
		</div>
	</div>
	
	<div class="container text-center">
		<?php 
			$terms = get_terms( 'portfolio-category' );
			$count = count( $terms );
			echo '<div class="filter-wrap">';
			echo '<div class="filter btn btn-primary" data-filter="all">All</div>';
			if ( $count > 0 ) {
				foreach ( $terms as $term ) {
				  echo '<a class="filter btn btn-primary" data-filter=".'. $term->slug .'">' . $term->name . '</a>';
				}
			}
			echo '</div>';			
		?>	
	</div>
	
	<div id="mixItUp" class="container-fluid">

		<?php

			$args = array(
				'post_type' => 'portfolio',
				'order' => 'DESC',
				'orderby' => 'date',
				'posts_per_page' => 12,
				'tax_query' => array(
					'taxonomy' => 'portfolio-category',
					'field' => 'slug',
				)
			);
		
			// The Query
			$the_query = new WP_Query( $args );
			
			// The Loop
			if ( $the_query->have_posts() ) {
		
				while ( $the_query->have_posts() ) {
					$the_query->the_post();

					
					$term_list = wp_get_post_terms($post->ID, 'portfolio-category', array("fields" => "all"));
					
					echo '<div class="mix col-sm-3 ';
						foreach($term_list as $term_single) {
							echo $term_single->slug .' ';
						}
					echo '">';
					
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
	
</section>