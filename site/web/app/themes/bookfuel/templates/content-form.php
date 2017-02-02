<?php 
	$backgroundStyle = '';
	$backgroundColor = get_sub_field('con_background_color_copy');
	
	if( $backgroundColor ) {
		$backgroundStyle = 'style="background-color:'. $backgroundColor .'"';
	}
	
?>

<section class="container-fluid content-form" <?php echo $backgroundStyle; ?>>

	<div class="container section-head text-center">
		<div class="row">	
			<div class="col-sm-12">
				<?php 
					if( get_sub_field('con_heading') ) {
						echo '<h2>'. get_sub_field('con_heading') .'</h2>'; 	
					}
				?>
			</div>
		</div>
	</div>

	<div class="container">
			
		<div class="row">
			
			<div class="col-sm-4">
				<?php the_sub_field('con_content'); ?>
			</div>

			<div class="col-sm-8">
				<?php the_sub_field('pardot_form'); ?>
			</div>

		</div>
	</div>
</section>

