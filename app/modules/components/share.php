<?php 
	$model = COMPONENT::get_model();
	$name = $model[0]; 	
	$settings = $model[1]; 
	$pill = $settings[0];	
	$url = $settings[1];
	$class = UTILITY::set_value($settings[2], 'text-white');
	$modalid = UTILITY::set_value($settings[3], 1);
	$title = $settings[4];
	$titlesize = $settings[5];

$id = $name.'-'.COMPONENT::get_counter();


	IF($modalid==MODEL_COMPONENT::MODAL_SHARE){// //cuidao MODEL_COMPONENT::MODAL_MENU
$id = 'menuid'; 
	}////cuidao
	
	IF($url){
		/*$id ='';*///cuidao
		$class = $class.' fw-bold text-decoration-none fas fa-ellipsis-h fa-1x'; 
	}
?>
<?php if($pill) { ?>
<span class="ms-auto badge rounded-pill bg-primary">
<?php } ?>
	<a id="<?php echo $id; ?>" class="<?php ECHO $class; ?>" href="!#" data-bs-toggle="modal" data-bs-target="#exampleModal-<?php echo $modalid; ?>" data-bs-whatever="<?php ECHO $url; ?>" aria-label="Compartir">
		<?php IF($title) { COMPONENT::init(COMPONENT::TITLE, array($title, $titlesize)); } ?>	
	</a>
<?php if($pill) { ?>
</span>	
<?php } ?>