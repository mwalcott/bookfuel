<section class="container-fluid content-form" style="background-color: #fff;">
	
	<div class="container section-head text-center">
		<div class="row">
			<div class="col-sm-12">
				<h2><?php the_sub_field('carousel_heading'); ?></h2>
				
				<?php if( get_sub_field('carousel_content') ) { ?>
				
					<div class="row">
						<div class="col-sm-8 col-sm-offset-2">
							<?php the_sub_field('carousel_content'); ?>
						</div>
					</div>
				
				<?php } ?>
				
			</div>
		</div>
	</div>
	
	<div class="container">
	
		<?php 
		
		$images = get_sub_field('carousel_images');
		
		if( $images ): ?>
			<div id="owl-example" class="owl-carousel">
				<?php foreach( $images as $image ): ?>
					<div class="item">
						<img src="<?php echo $image['sizes']['large']; ?>" alt="<?php echo $image['alt']; ?>" />
					</div>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>
	
	</div>
	
</section>