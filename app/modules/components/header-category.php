<?php 

$model = COMPONENT::get_model();
$component = $model[0];
$settings = $model[1];	

$border = $settings[0];
$id = $settings[1];	
$category_update = $settings[2];	
$category_url2 = $settings[3];	
$category_url = $settings[4];	
$class = $settings[5];	
$dsw = $settings[6];
$modal = $settings[7];

$thiscol = '11';
if($dsw){
	$thiscol = '10';
}

if(!$category_update){
	$category_url2 = $category_url;
}/*else {
	echo $category_url2;
	echo $category_url;
}*/

?>
						<!-- bg-white -->
<div class="<?php echo $component; ?> card-header bg-light row g-0 p-0 px-2 px-md-3 <?php echo $border; ?>"><!--p-0 py-3-->
	<div class="col-1 d-flex justify-content-center align-items-center">
		<?php  COMPONENT::init(COMPONENT::ICON, array($id,null,1, $category_update, $category_url2)); ?>
	</div>		
	<div class="col-<?php echo $thiscol; ?> d-flex justify-content-start align-items-center"><!-- overflow solucionado con d..flex  probarlo en col. -->			
		<!-- btn -->
		<a class="text-decoration-none text-dark d-flex" href="<?php ECHO $category_url; ?>"><?php COMPONENT::init(COMPONENT::TITLE, array($class, MODEL_COMPONENT::X_SMALL_BOLD)); ?></a>			
	</div>		
	<?php if($dsw){ ?>
	<div class="col-1 d-flex justify-content-end align-items-center">
		<?php COMPONENT::init(COMPONENT::SHARE, array(false, $dsw, 'link-dark', $modal)); ?>			
	</div>
	<?php } ?>
</div>	