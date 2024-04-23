<?php 
	$model = COMPONENT::get_model(); 
	$settings = $model[1];
	$modal_id = $settings[0];
	
	$size = 'modal-md';
	$size_title = MODEL_COMPONENT::X_SMALL_BOLD;

	IF($modal_id == MODEL_COMPONENT::MODAL_STORIES){
//$content = 'h-100';/*si no hay mucho contenido el modal tiene un gran espacio debajo*/
//$container = 'row g-0 h-100';
//$modal_body = 'h-100 overflow-hidden';	
		$display = true;
		$display_header = true;
		$header = 'py-0 ps-0';
		$size = 'modal-fullscreen';	

		IF(isset($_GET["news"])){
			$id = $_GET["news"];
		}else IF(isset($_GET["news_single"])){
			$id = $_GET["news_single"];
		}		
		
		$p = get_post($id);
		$category_name = utility::get_name($p);	
		$category_title	= utility::get_title($p);	
		$cid = CATEGORY::get_id($category_name);//findid			
		
		//$category_update = view::should_update_category($cid);
		$category_update = utility::should_update_category(category::get_name($cid));
		
			//$category_update = true;
			//IF(  !utility::match(,  view::get_categories_not_viewed())){
			//	$category_update = false;

			//}
		$category_url = get_permalink($p);
$category_url0 = $category_url;		
	} ELSE IF($modal_id == MODEL_COMPONENT::MODAL_MENU || $modal_id == MODEL_COMPONENT::MODAL_SHARE ){
		$container = 'list-group text-center list-group-flush ';
		$display_menu_share = true;
		$li_menu_share = 'list-group-item list-group-item-action';		
	} ELSE IF($modal_id == MODEL_COMPONENT::MODAL_COOKIES ){
		$display_menu_cookies = true;
			$display = true;
			$size = 'modal-sm';
 $backdrop = 'data-bs-backdrop="static" ';
$cookiesmsj = 'Política sobre cookies.';

	}
?>
<div id="<?php echo 'exampleModal-'.$modal_id; ?>" class="modal" <?php ECHO $backdrop; ?> tabindex="-1" aria-hidden="true"><!--aria-labelledby="exampleModalLabel" -->
	<div class="modal-dialog modal-dialog-scrollable modal-dialog-centered <?php ECHO $size; ?>" style="<?php ECHO $bottomstyle; ?>">
		<div class="modal-content <?php echo $content; ?>">
			<?php IF($display){ ?>
			<div class="modal-header  bg-light <?php echo $header; ?>">			
				<?php IF($display_header){ 
				COMPONENT::init(COMPONENT::HEADER_CATEGORY, array('border-0 w-100', $cid, $category_update, $category_url0, $category_url, $category_title)); 
				//COMPONENT::init(COMPONENT::HEADER_CATEGORY, array(null, $cid, $category_update, null, $category_url, $category_name, $product_url, 1));				
				} ?>
				
				<?php IF($cookiesmsj){ 	
					echo '<b>'.$cookiesmsj.'</b>';
				} ?>
				<button type="button" class="btn-close " data-bs-dismiss="modal" aria-label="Close"></button>
			</div>			
			<?php } ?>	
			<div class="modal-body p-0 <?php echo $modal_body; ?>">
				<div class="<?php echo $container; ?>">
					<?php IF($modal_id == MODEL_COMPONENT::MODAL_STORIES){ ?>
					
						<?php COMPONENT::init(COMPONENT::QUANTUM, ARRAY(MODEL_COMPONENT::CAROUSEL_MODAL_C, MODEL_COMPONENT::MODAL_NEWS_STORIES));  ?>
						
					<?php } ELSE IF($display_menu_share) { ?>
						<?php IF($modal_id == MODEL_COMPONENT::MODAL_MENU){ ?>
							<a id="pubid" class="<?php echo $li_menu_share; ?>" href="!#"><?php COMPONENT::init(COMPONENT::TITLE, array('IR A LA PUBLICACIÓN', $size_title)); ?></a>
							<span class="d-none"><!-- d-none -->
							<?php COMPONENT::init(COMPONENT::SHARE, array(false, null, $li_menu_share, MODEL_COMPONENT::MODAL_SHARE,'COMPARTIR EN...', $size_title)); ?>
							</span>
						<?php } ELSE IF($modal_id == MODEL_COMPONENT::MODAL_SHARE) { ?>
							<a href="!#" class="d-none <?php echo $li_menu_share; ?>" id='copyos'><?php COMPONENT::init(COMPONENT::TITLE, array('COMPARTIR EN...', $size_title)); ?></a>
						<?php } ?>
						<a href="!#" class="<?php echo $li_menu_share; ?>" id='<?php echo 'copyme'.$modal_id; ?>' ><?php COMPONENT::init(COMPONENT::TITLE, array('COPIAR ENLACE', $size_title)); ?></a>
						<a href="!#" class="<?php echo $li_menu_share; ?> text-danger" data-bs-dismiss="modal"><?php COMPONENT::init(COMPONENT::TITLE, array('CANCELAR', $size_title)); ?></a>
						<input id="<?php echo 'myInput'.$modal_id; ?>" class="p-0 border-0" style="width:1px;height:0px;" type="text" value="">					
					<?php } ELSE IF($display_menu_cookies) { ?>
						<p>
						Al igual que la mayoría de los sitios en Internet, en <?php echo VIEW::get_site_url(); ?> usamos cookies para mejorar la experiencia del usuario, mostrar anuncios relevantes y analizar el tráfico.
						</p>
						<p>
						Las cookies asocian su dispositivo de manera anónima sin proporcionar referencias personales, y desempeñan un papel imprescindible para ofrecer una navegación óptima. 
						</p>
						<p>
						Puedes revisar los controles de cookies cuando quieras. Consulta nuestra <a href="<?php echo VIEW::get_site_url(); ?>/<?php echo extended::privacity; ?>">Política de privacidad</a> para obtener más información sobre el uso y los controles de cookies.						
						</p>					
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
</div>