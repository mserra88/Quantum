<?php
	$class_link = 'btn py-2';
	$size_title = MODEL_COMPONENT::NORMAL_BOLD; 	
	$url  = home_url().'/';	
	IF(CONTROLLER::is_home() || CONTROLLER::is_explore()|| CONTROLLER::is_404()){ 
		$col = 4;
		$col_sm = 5;
		$class_link .= ' px-0 ls-1';		
		$class_icon = 'btn py-0 px-2';
		$justify_content_center = 'justify-content-center';	
		$model_icon = CONF::LINKS[0];
		$model_dropdown = CONF::LINKS[1];
		$name_home = VIEW::get_name();			
		//$size_title = MODEL_COMPONENT::H5_BOLD;		
	}ELSE{
		$has_menu = TRUE;
		$col = 12;
		$col_sm = $col;
		//$class_link .= ' rounded-0'; /*btn-primary*/		
		IF(CONTROLLER::is_product() || CONTROLLER::is_single()){ $path = CATEGORY::get_name(); }//aview cat_name.	
		ELSE IF( CONTROLLER::is_category() && CONTROLLER::is_reflected()){ $path = CONTROLLER::get_title(CONTROLLER::get_id(CONF::SLUG_SERVICES)); }		
		
		IF($path){ $url = get_permalink(utility::get_page_by_path($path)); }
	}
?>
<div class="row g-0 border-bottom"><!-- d-flex align-items-center   -->
	<div class="col-<?php ECHO $col; ?> col-sm-<?php ECHO $col_sm; ?> d-flex align-items-center <?php ECHO $justify_content_center; ?>">
		<a class="<?php ECHO $class_link; ?>" href="<?php ECHO $url; ?>">
			<?php IF($has_menu){ ?><i class="fa fa-arrow-left"></i><?php }ELSE{ COMPONENT::init(COMPONENT::TITLE, ARRAY($name_home, $size_title)); } ?>
		</a>		
		<?php IF($has_menu){ ?>		
			<a class="<?php ECHO $class_link; ?> link-dark disabled w-100 text-start" href="!#">							
				<?php COMPONENT::init(COMPONENT::TITLE, ARRAY(VIEW::get_title(), $size_title));  ?>	
			</a>
			<?php COMPONENT::init(COMPONENT::SHARE, ARRAY(FALSE, get_permalink(VIEW::get_page()), $class_link)); ?>						
		<?php } ?>
	</div>
	<?php IF(!$has_menu){ ?>
	<div class="col d-flex align-items-center">	
		<input id="search" class="form-control form-control-sm text-center d-none" name="search" type="search" placeholder="🔍 Buscar" aria-label="Buscar" autocomplete="off" />
	</div>
	<?php } ?>
	<?php IF(!$has_menu && ($model_icon || $model_dropdown)){ ?>	
	<div class="col d-flex align-items-center justify-content-end">
		<?php IF($model_icon){ ?>
			<?php FOREACH($model_icon AS $name){ //$result = null;
				IF(!IS_ARRAY($name)){
					$id_controller = CONTROLLER::get_id($name);					
					$icon_controller = CONTROLLER::get_icon($id_controller);  				
					$name_controller = CONTROLLER::get_title($id_controller);				
				}ELSE{
					$name_controller = $name[0][0];	
					$name_reflected = $name[0][3][0];
					$result_reflected = REFLECT::get_method($name_reflected); 	
					IF($result_reflected){
						$icon_reflected = $result_reflected[0];						
						$title = $title.$result_reflected[1];//$title = utility::get_title($page).': ';
					}					
				}				
				$page = UTILITY::get_page_by_path($name_controller);		
				IF(!$page){ $page = UTILITY::get_page_by_path($name); }
			?>
				<a class="<?php ECHO $class_icon; ?>" href="<?php ECHO get_permalink($page); ?>" aria-label="<?php ECHO UCFIRST($name_controller); ?>" title="<?php ECHO $title;?>">  
					<?php IF(!$result_reflected){ ?><i class="<?php ECHO $icon_controller; ?>"></i><?php }ELSE{ ECHO $icon_reflected; } ?>  
				</a>
			<?php } ?>
		<?php } ?>	
		<?php IF($model_dropdown){ ?>		
			<a class="<?php ECHO $class_icon; ?>" href="!#" data-bs-toggle="dropdown" aria-expanded="false" aria-label="Ver más">
				<img class="align-top my-1" src="<?php ECHO utility::get_logo('favicon','16'); ?>" alt="<?php ECHO $name_home; ?>" loading="lazy">
			</a>
			<ul class="dropdown-menu mt-2">	
			<?php FOREACH($model_dropdown AS $name){ ?>
				<?php IF($name!='divider'){ $page = utility::get_page_by_path($name); } ?>						
				<?php IF($name=='divider'){ ?>			
					<li><hr class="dropdown-divider"></li>
				<?php }ELSE{  ?>	
					<li>
						<a class="dropdown-item" href="<?php ECHO get_permalink($page); ?>">
							<?php COMPONENT::init(COMPONENT::TITLE, ARRAY(utility::get_title($page), MODEL_COMPONENT::X_SMALL_BOLD)); ?>		
						</a>	
					</li>
				<?php }  ?>	
			<?php } ?>		
			</ul>	
		<?php } ?>
	</div>
<?php } ?>	
</div>