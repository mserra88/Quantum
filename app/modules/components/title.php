<?php
	$h1 			= MODEL_COMPONENT::H1;
	$h1_bold		= MODEL_COMPONENT::H1_BOLD;	
	$h2				= MODEL_COMPONENT::H2;
	$h2_bold		= MODEL_COMPONENT::H2_BOLD;	
	$h3				= MODEL_COMPONENT::H3;
	$h3_bold		= MODEL_COMPONENT::H3_BOLD;	
	$h4				= MODEL_COMPONENT::H4;
	$h4_bold		= MODEL_COMPONENT::H4_BOLD;	
	$h5				= MODEL_COMPONENT::H5;
	$h5_bold		= MODEL_COMPONENT::H5_BOLD;	
	$h6				= MODEL_COMPONENT::H6;
	$h6_bold		= MODEL_COMPONENT::H6_BOLD;	
	$normal			= MODEL_COMPONENT::NORMAL;
	$normal_bold 	= MODEL_COMPONENT::NORMAL_BOLD;	
	$small			= MODEL_COMPONENT::SMALL;
	$small_bold 	= MODEL_COMPONENT::SMALL_BOLD;	
	$x_small		= MODEL_COMPONENT::X_SMALL;
	$x_small_bold	= MODEL_COMPONENT::X_SMALL_BOLD;

	$model = COMPONENT::get_model();
	$settings = $model[1];
	$title = $settings[0];
	$size = UTILITY::set_value($settings[1], $h1_bold);
	$transform = UTILITY::set_value($settings[2], 'text-uppercase');
	
	IF($size==$h1_bold || $size==$h2_bold || $size==$h3_bold || $size==$h4_bold || $size==$h5_bold || $size==$h6_bold || $size==$normal_bold || $size==$small_bold || $size==$x_small_bold){ $weight = 'fw-bolder'; }
	ELSE{ $weight = 'fw-normal'; }

	IF($size==$small || $size==$small_bold){ $fontsize = 'fs-small'; } 
	ELSE IF($size==$x_small || $size==$x_small_bold){ $fontsize = 'fs-x-small'; }	
	
	$class = $weight.' '.$transform.' '.$fontsize;//m-0 p-0 breaker
?>

<?php IF($size==$h1 || $size==$h1_bold) { ?><h1 class="<?php ECHO $class; ?>">
<?php } ELSE IF($size==$h2 || $size==$h2_bold) { ?><h2 class="<?php ECHO $class; ?>">
<?php } ELSE IF($size==$h3 || $size==$h3_bold) { ?><h3 class="<?php ECHO $class; ?>">
<?php } ELSE IF($size==$h4 || $size==$h4_bold) { ?><h4 class="<?php ECHO $class; ?>">
<?php } ELSE IF($size==$h5 || $size==$h5_bold) { ?><h5 class="<?php ECHO $class; ?>">
<?php } ELSE IF($size==$h6 || $size==$h6_bold) { ?><h6 class="<?php ECHO $class; ?>">
<?php } ELSE { ?><span class="<?php ECHO $class; ?>"><?php } ?>
<?php ECHO $title; ?>
<?php IF($size==$h1 || $size==$h1_bold) { ?></h1>
<?php } ELSE IF($size==$h2 || $size==$h2_bold) { ?></h2>
<?php } ELSE IF($size==$h3 || $size==$h3_bold) { ?></h3>
<?php } ELSE IF($size==$h4 || $size==$h4_bold) { ?></h4>
<?php } ELSE IF($size==$h5 || $size==$h5_bold) { ?></h5>
<?php } ELSE IF($size==$h6 || $size==$h6_bold) { ?></h6>
<?php } ELSE { ?></span><?php } ?>