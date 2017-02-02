
<?php
	
	$colWrapperClass = get_sub_field('column_wrapper_class');
	
	
	$rows = get_sub_field('column');
	
	if( $rows ) {
		$count = count($rows);
		$colClass = '';
		
		if( $count == 4 ) {
			$colClass = 'col-sm-3';
		}
		elseif( $count == 3 ) {
			$colClass = 'col-sm-4';
		}
		elseif( $count == 2 ) {
			$colClass = 'col-sm-6';
		}
		else {
			$colClass = 'col-sm-12';
		}
		
		$background = '';
		$backgroundClass = '';
		$bgImage = get_sub_field('col_background_image');
		$bgColor = get_sub_field('col_background_color');
		
		if( $bgImage || $bgImage && $bgColor ) {
			$background = 'style="background-image: url('. $bgImage .');"';
			$backgroundClass = 'has-background-image';
		}
		else {
			$background = $bgColor;
		}
		
		echo '<section class="container-fluid column-section '. $backgroundClass .'" '. $background .'>';

			echo '<div class="container section-head">';
				echo '<div class="row text-center">';
				
					echo '<div class="col-sm-12 section-head">';
					
						if( get_sub_field('main_heading') ) {
							echo '<h2>'. get_sub_field('main_heading') .'</h2>';
						}
	
						if( get_sub_field('main_text') ) {
							echo '<div class="row"><div class="col-sm-8 col-sm-offset-2">'. get_sub_field('main_text') .'</div></div>';
						}
	
					echo '</div>';
				echo '</div>';
			echo '</div>';

			echo '<div class="container">';
				echo '<div class="row text-center row-eq-height">';
				
					foreach( $rows as $row ) {
					
						echo '<section class="'. $colClass .' columns '. $colWrapperClass .'">';	
							echo '<div class="column-inner">';
	
								echo '<header class="col-heading">';
													
									if( $row['col_heading'] ) {
										echo '<h3>'. $row['col_heading'] .'</h3>';
									}
				
									if( $row['col_sub_heading'] ) {
										echo '<em>'. $row['col_sub_heading'] .'</em>';
									}
									
								echo '</header>';
			
								if( $row['col_pricing'] ) {
									echo '<p class="col-price">$'. $row['col_pricing'] .'</p>';
								}
			
								if( $row['col_content'] ) {
									echo '<p>'. $row['col_content'] .'</p>';
								}
			
								if( $row['col_button_text'] && $row['col_button_link'] ) {
									echo '<a class="btn btn-primary-outline btn-lg" href="'. $row['col_button_link'] .'">'. $row['col_button_text'] .'</a>';
								}
						
							echo '</div>';
							
						echo '</section>';
						
					}
				
				echo '</div>';
			echo '</div>';
		echo '</section>';
		
	}
	
	
?>