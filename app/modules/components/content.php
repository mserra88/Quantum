<?php 
	$model = COMPONENT::get_model();
	$settings = $model[1];
	
	$from = $settings[0];
	
	$p = $settings[1];
	$content_type = $settings[2];	
	$collapseclass = $settings[3];	
	
	$ps = 0;
	if(CONTROLLER::is_category()){ $ps = 1; }
	
	if($content_type == MODEL_COMPONENT::CONTENT_EXC){
		$show_exc = true;
	}
	
	$html = utility::get_content($p);

	IF($content_type == MODEL_COMPONENT::CONTENT_CUT){
		$paragraph = explode("</p>", $html);
		$parrafos = count($paragraph)-1;
		$html = $paragraph[0];
		IF($parrafos > 1) { $more = true; }
	}ELSE IF($show_exc){
		IF(strlen($html) >= 500){ 
			$sss = true;
			$html = substr($html, 0, 500);
			$html =  substr($html, 0, strrpos($html, ' ')).'...'; 
		}
	}
	IF($from && $html){ 		/* breaker*/	
		$ttittle = '<a class="text-decoration-none " href="'.get_permalink(get_page_by_path(utility::get_parent_name($p))).'"><span class="m-0 p-0  fw-bolder text-uppercase fs-small">'.get_page_by_path(utility::get_parent_name($p))->post_title.'</span></a> ';	
	} 	
?>	
<?php //COMPONENT::init(COMPONENT::ADS);  ?>
<?php IF($show_exc){ ?>
<div id="excp-<?php echo $p->ID; ?>" class="w-100 text-start">
<?php } ?>
	<?php IF($html){ ?>
	<div class="p-nomy">
	<?php echo substr_replace($html, $ttittle, strpos($html,'<p>')+3, 0); ?>	
	<?php //echo substr($html, strpos($html,'<p>')+3); ?>
	<?php if($more) { ?>						
	<a class="text-decoration-none" href="<?php echo get_permalink($p); ?>"><?php COMPONENT::init(COMPONENT::TITLE, array('Leer más &raquo;', MODEL_COMPONENT::NORMAL_BOLD, false)); ?></a>
	<?php } else IF($sss){ ?>
	<!-- data-bs-toggle="collapse" data-bs-target="#< ?php echo $collapseclass; ?>" aria-expanded="false" aria-controls="< ?php echo $collapseclass; ?>" -->
	<a class="text-decoration-none loadmore" data-bs-toggle="collapse" href="#<?php echo $collapseclass.'-'.$p->ID; ?>" role="button" aria-expanded="false" aria-controls="<?php echo $collapseclass.'-'.$p->ID; ?>">

	<!--  onclick="collapseaccordion(event)"-->
	<?php COMPONENT::init(COMPONENT::TITLE, array('más', MODEL_COMPONENT::NORMAL, false)); ?>
	</a>
<?php } ?>
	</div>
	<?php } ?>
<?php edit_post_link(); ?>	
<?php if($show_exc){ ?>
</div>
<?php } ?>