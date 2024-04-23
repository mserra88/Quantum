<?php
	$model = COMPONENT::get_model();
	$component = $model[0];
	$settings = $model[1];
	$id = $settings[0];
	
	$color = UTILITY::set_value($settings[1], TRUE);
	$size = UTILITY::set_value($settings[2], 2);
	$update = $settings[3];	
	$url = $settings[4];
	$mostrar = $settings[5];	
	$from = UTILITY::set_value($settings[6], FALSE);
	$tuvehistoriasrecientes = UTILITY::set_value($settings[7], FALSE);
	$showborder = UTILITY::set_value($settings[8], true);
	$bggg = 'rounded-circle ';
if($update){ $bggg = $bggg.' bg-light';  }	
$pp = 'padding1px ';
	if(is_array($from)){
		$style = $from[0];
		//echo 'estilo extra';
		$iconmasterclass = 'mx-1';
//$border_p = 'p-2';
		if($style == MODEL_COMPONENT::NAVBAR_SPECIAL){	
		$pp = 'p-2 d-flex align-items-center justify-content-center';
			$bggg = ''; 
			$active = $from[1];
			$iconmasterclass = $iconmasterclass.' mt-2 navbar-components '.$active.' '.UTILITY::get_text_color($id).' '.UTILITY::get_bg_color($id);
			//btn p-0 py-1 mt-2 mb-1  mx-4 navbar-components text-center d-flex-block justify-content-center align-items-center 
		}
		
	} else if($from){
		//$iconmasterclass = 'update-url-here';
//$border_p = 'p-lg-4 p-md-5 p-3';
	}


/*
	$link = TRUE;
	if($id == NULL && $update == NULL && $url == NULL){ echo 'no..'; $link = FALSE; }
*/

	if(isset($url)){  $link = TRUE; }

	IF(!ISSET($id) && !CONTROLLER::is_category() && !CONTROLLER::is_product() && !CONTROLLER::is_single()) {				
		$icon = CONTROLLER::get_icon();
		IF($color) { 
			$class = CONTROLLER::get_name();
		}					
	} ELSE {					
		$id = UTILITY::set_value($id, CATEGORY::get_id());

		$icon = CATEGORY::get_icon($id);
		
		
		IF($color) { $class =  UTILITY::get_text_color($id);  } 
		ELSE { $class = 'text-white'; }  
		

		if($mostrar!=null && $mostrar == get_page_by_path(EXTENDED::SERVICES[1])->post_title) { //!$icon testear....			
				$icon = CONTROLLER::get_icon(controller::get_id(CONF::SLUG_SERVICES));
		} 
	}	

	IF($update|| $tuvehistoriasrecientes) { 
		
		$style = 3;//(1,2,3,4,5) 
		if($tuvehistoriasrecientes){
			$style = 5;
		}
		$style = $style.' rounded-circle';
		$outer = 'glow-outer'.$style;
		$inner = 'glow-inner'.$style.' p-1';
	}else{
		$inner = ' p-1';		
	}

	IF(!ISSET($url)&&controller::is_category()){ //para el logo

	}
	
	/*if(!$update){
			$url = get_permalink(utility::get_page_by_path(CATEGORY::get_name($id)));

	}*/

	//s m l xl
	
	IF($size==MODEL_COMPONENT::ICON_S){ $padding = '1'; $sizing='ICON_S'; }		//26
	ELSE IF($size==MODEL_COMPONENT::ICON_M ){ $padding = '2'; $sizing='ICON_M'; } //50
	ELSE IF($size==MODEL_COMPONENT::ICON_L){ $padding = '3'; $sizing='ICON_L'; }	//2	//98
	ELSE IF($size==MODEL_COMPONENT::ICON_XL){ $padding = '4'; $sizing='ICON_XL'; }		//3//162
	
	$icon_style = $class.' '.$component.' '.$icon.' '.'fa-'.$size.'x';/*.' '.$update.' '*/

	$max = 8;
	if(strlen($mostrar) > $max){
		$mostrar = substr($mostrar, 0 , $max-1).'...';
	}	
?>
<?php IF(!$update){ ?>
<!--<div class="< ?php echo ' ' .$pp; ?>">-->
<?php } ?>

<?php IF($link){ ?>
<!-- data-bs-toggle="modal" data-bs-target="#exampleModal-2" data-bs-whatever="< ?php ECHO $title; ?>"-->
	<a class=" <?PHP echo $iconmasterclass; ?> btn m-0 p-0" href="<?php ECHO $url; ?>" aria-label="<?php ECHO utility::get_name(get_post(url_to_postid( $url ))); ?>" >

		<div class=" <?php echo $outer; ?>">
			<div class=" <?php echo $inner; ?>">
				<div class=" <?php echo  $bggg.'   '.$pp; ?> ">
<?php } ?>
		
<?php IF($showborder){ ?>
		
<div class=" <?php echo 'bg-white p-'.$padding.' '.$sizing; ?> d-flex align-items-center justify-content-center border rounded-circle border-secondary" >
<?php } ?>
			<i class="<?php ECHO $icon_style; ?>  <?php //echo $border_p; ?> "  ></i><!---->

<?php IF($showborder){ ?>

</div>
<?php } ?>
<?php IF($link){ ?>
				</div>
			</div>
		</div>
	</a>
<?php } ?>
<?php IF(!$update){ ?>
<!--</div>-->
<?php } ?>
<?php IF($mostrar){ ?>
<a class="btn m-0 p-0 d-block" href="<?php ECHO $url; ?>" >
<?php COMPONENT::init(COMPONENT::TITLE, array($mostrar, MODEL_COMPONENT::X_SMALL_BOLD)); ?>
</a>
<?php } ?>