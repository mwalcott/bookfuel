<?php 
	$background = '';
	$bgImage = get_field('banner_background_image'); 
	$bannerContent = get_field('banner_content'); 
	$bannerBtnText = get_field('banner_button_text');
	$bannerBtnLink = get_field('button_link');

	if( $bgImage ) {
		$background = 'style="background-image: url('. $bgImage .');"';
	}

?>

<?php if( get_field('banner') ) { ?>

<div class="main-banner container-fluid text-center" <?php echo $background; ?>>
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<p><?php echo $bannerContent; ?></p>
				<a href="<?php echo $bannerBtnLink; ?>" class="btn btn-primary btn-lg"><?php echo $bannerBtnText; ?></a>
			</div>
		</div>
	</div>
</div>

<?php } ?>