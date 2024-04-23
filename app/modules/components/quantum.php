<?php
$model = COMPONENT::get_model();
$component_unique = COMPONENT::get_counter();
$component = $model[0];
$settings = $model[1];	
$style = $settings[0];	
$data_model = $settings[1];
$cid = $settings[2];
$size = MODEL_COMPONENT::X_SMALL_BOLD;
$jsvar = 0;
$link_class = 'text-dark text-decoration-none';

$is_home = CONTROLLER::is_home();
$is_services = CONTROLLER::is_services();
$is_explore = CONTROLLER::is_explore();
$is_category = CONTROLLER::is_category();
$is_reflected = CONTROLLER::is_reflected();

IF ($style==MODEL_COMPONENT::DEFAULT || $style==MODEL_COMPONENT::LIST ) { 
	$isgrid=true; 
	if($style==MODEL_COMPONENT::DEFAULT){
		$isdefaultgrid = true;
	}
	else if($style==MODEL_COMPONENT::LIST){
		$isdefaultlist = true;
		IF( ($is_home || $is_explore /*|| $is_services*/)) { 
			$isfeed = true;
		}		
	}

} ELSE IF($style==MODEL_COMPONENT::CAROUSEL || $style==MODEL_COMPONENT::CAROUSEL_MODAL_C || $style==MODEL_COMPONENT::NAVBAR_STORIES_CAT|| $style==MODEL_COMPONENT::NAVBAR_STORIES_NEWS || $style==MODEL_COMPONENT::NAVBAR_SPECIAL) { 	
	$iscarousel=true; 		
	IF($style==MODEL_COMPONENT::NAVBAR_STORIES_CAT || $style==MODEL_COMPONENT::NAVBAR_STORIES_NEWS || $style==MODEL_COMPONENT::NAVBAR_SPECIAL) { 
		$isnavbar=true; 
		IF($style==MODEL_COMPONENT::NAVBAR_SPECIAL) { 
			$isnavbarspecial=true; 
		} ELSE IF($style==MODEL_COMPONENT::NAVBAR_STORIES_CAT) { 
			$isnavbarstoriescat=true; 
		} ELSE IF($style==MODEL_COMPONENT::NAVBAR_STORIES_NEWS) { 
			$isnavbarstoriesnew=true; 
		} 
	} ELSE IF($style==MODEL_COMPONENT::CAROUSEL || $style==MODEL_COMPONENT::CAROUSEL_MODAL_C) {
		$iscarouseldefault=true;
		IF($style==MODEL_COMPONENT::CAROUSEL_MODAL_C) { 
			$carouselmodal=true; 
		}	
	}
}

IF($isnavbarstoriescat || $isfeed){
	$UPTATEDCATS = view::get_categories_updated();
}

IF ($data_model == MODEL_COMPONENT::ALL_CATEGORIES_UPDATED) {
	$model = $UPTATEDCATS;
} ELSE IF ($data_model == MODEL_COMPONENT::ALL_CATEGORIES) { 
	$model = CATEGORY::get_categories(true);
} ELSE IF ($data_model == MODEL_COMPONENT::ALL_CATEGORIES_HIDDEN) { 
	$model = REFLECT::get_reflected();
} ELSE IF ($data_model == MODEL_COMPONENT::ALL_PRODUCTS || $data_model == MODEL_COMPONENT::TOP_PRODUCTS || $data_model == MODEL_COMPONENT::ALL_PRODUCTS_CLOUD) { 
	IF ($data_model == MODEL_COMPONENT::ALL_PRODUCTS_CLOUD) { 
		$iscloudtag = true;
		$isfeed = false;
	} ELSE IF ($data_model == MODEL_COMPONENT::TOP_PRODUCTS) { 
		$featured = true; 
	}
	$model = CATEGORY::get_products(ARRAY($cid, $featured, $iscloudtag));	
} ELSE IF ($data_model == MODEL_COMPONENT::NEWS) { 
	$model = VIEW::get_news();
} ELSE IF ($data_model == MODEL_COMPONENT::MODAL_NEWS_STORIES) {
	$model = VIEW::get_news_modal();
	$todas_vistas = view::get_todas_vistas();
}

$count = COUNT($model);

IF($isgrid) {
	//$overlay = true;
	//IF($isfeed || $iscloudtag) { $overlay = false; }

	$parts = ARRAY(1);
	$container = 'card rounded-0 border-0 ';	//border
//$caption = 'px-0';	
	IF($style == MODEL_COMPONENT::DEFAULT){	
		$row = 'row g-0';
		$col = 'quantum-g col-4 ';/*px-1 pb-2*/
		$colpr = 'colpaddingr';
		$colpl = 'colpaddingl';
		
		$colpaddingb = 'colpaddingbottom';
		$bg_size = 'contain';
	} ELSE IF($style == MODEL_COMPONENT::LIST){ 
		$col = 'quantum-l';	
		$colxtra =  'mb-4';
		$bg_size = 'contain';
	}	
	IF($iscloudtag || controller::is_services()){ 
		$dtitle = true;
	}
} ELSE IF($iscarousel) {
	//$overlay = true;
	$parts = ARRAY(0, 1);
$caption = 'carousel-caption py-0';	
	$row = 'carousel-inner'; 
	$carousel_item = 'h-100 carousel-item';	
	$active_class = 'active';
	$time = 15000;	
$height = 240;	
	IF($count > 1){
		//$showcontrols = true;
		$dcontrols = true;		
	}
	
	IF($iscarouseldefault){
		$bg_size = 'cover';
		//$bordercaru = 'border ';
//$hidearrows = 'd-none';		
		$extended = 'extended';
		if(CONTROLLER::is_services()){
			$dtitle = true;	
			$titlealign = 'd-flex align-items-center justify-content-center';
		}
		IF ($carouselmodal) {
			//$height = '100%!important';	
//$height = 240;

			$dcontrols = true;	
			$dtitle = true;//false..¿
			$titlealign = 'd-flex align-items-center justify-content-center';
			$component_unique = 'modal';
			IF($count == 1){ $hidearrows = 'd-none'; $single_slide = "single-slide='true'"; }
		}
		
		/*IF ($carouselmodal || $showcontrols) {		
			//$progress_bar = true;
		}*/
	}ELSE IF($isnavbar){
$height = NULL;
		$container = 'clone';
		$row = $row.' nvv-inner';
		$carousel_item = $carousel_item.' nvv-item';
		$time = 0;
		$dcontrols = false;
		$bg_controls = 'bg-light';
		
		$jsvar = $count-1;
		$max = 5;
		IF($jsvar<=$max){ $showcontrols = 'd-inline d-sm-none';  /* $showcontrols = 'd-none';*/ }
		IF($jsvar<=3){ $showcontrols = 'd-none'; }
		IF($jsvar>=$max){ $jsvar = $max;}
		
		IF($isnavbarspecial){
			$bordercaru = 'bg-light py-1  mb-1 border-bottom';
			 $showborder = false;
			$color = false;			
			IF($is_category && !$is_reflected){ $current_category = CATEGORY::get_name(); }
			ELSE IF($is_services || $is_reflected){ $current_category = CONF::SLUG_SERVICES; }
		} ELSE IF($isnavbarstoriescat) {
			$component_unique = 'navbar';
			//$category_update = true;	
			$get_storyng = view::get_storyng();		
			$story = "story='".view::get_stories()."'";
			$bordercaru = 'border rounded py-3 my-md-4 my-1';
		}		
	}
	
	$col = $carousel_item; 
}

if($height){
	$height = 'height:'.$height.'px;';
}

IF($isfeed){ $preurl_icon = '?news_single=';	} 
ELSE { $preurl_icon = '?news='; }

$component_id = $component.'-'.$component_unique;
$filas = ceil($count /3)-1;
FOREACH($parts as $part) { 
	$i=0;
	$columna=0;
	$thisfila =0;
	$header  = FALSE; 
	IF($part==0) { $header = TRUE; }
	$continue = true;
	
	FOREACH($model AS $nn => $elem) {
		$start = UTILITY::get_start($i);
		$end = UTILITY::get_end($i, $count);
		
		if($isdefaultgrid){
			if($columna==3){
				$columna = 0;
				$thisfila++;
			}
			if($thisfila == $filas){ $colpaddingb  =''; }
			$colpadding = '';
			if($columna==2){ $colpadding = $colpl; }
			if($columna==0){ $colpadding = $colpr; }			
		}
		
		if(!$isgrid){
			IF(/*!$isgrid ||*/ !$carouselmodal || $todas_vistas){				
				$active = '';
				IF($start) { $active = $active_class; }
			} ELSE {
				$active = '';
				if($continue){					
					if(utility::should_update(get_page_by_path($elem,OBJECT,'post')) ){
						$active = $active_class;
						$continue = false;
					}
				}			
			}
		}	
		
		IF(!$header){ 		
			IF($data_model == MODEL_COMPONENT::ALL_PRODUCTS || $data_model == MODEL_COMPONENT::TOP_PRODUCTS || $data_model == MODEL_COMPONENT::ALL_PRODUCTS_CLOUD){
				IF($data_model == MODEL_COMPONENT::ALL_PRODUCTS || $data_model == MODEL_COMPONENT::TOP_PRODUCTS) { 							
					$class = CATEGORY::get_name($elem[1]);	
					$p = UTILITY::get_page_by_path($class, UTILITY::get_name($elem[0]));						
				} ELSE IF($data_model == MODEL_COMPONENT::ALL_PRODUCTS_CLOUD) { 
					$class = CATEGORY::get_name($nn);
					$p = UTILITY::get_page_by_path($class);
				}
			} ELSE IF($data_model == MODEL_COMPONENT::ALL_CATEGORIES || $data_model == MODEL_COMPONENT::ALL_CATEGORIES_UPDATED || $data_model == MODEL_COMPONENT::ALL_CATEGORIES_HIDDEN) {
				IF($data_model == MODEL_COMPONENT::ALL_CATEGORIES) { 
					$class = CATEGORY::get_name($i); 
				} ELSE IF($data_model == MODEL_COMPONENT::ALL_CATEGORIES_HIDDEN || $data_model == MODEL_COMPONENT::ALL_CATEGORIES_UPDATED) { 
					$class = $elem; 
				}	
				$p = UTILITY::get_page_by_path($class);				
			} ELSE IF($data_model == MODEL_COMPONENT::NEWS || $data_model == MODEL_COMPONENT::MODAL_NEWS_STORIES) {
				$p = get_page_by_path($elem,OBJECT,'post');				
				$class = UTILITY::get_the_category($p);
			} 
			
			$id = CATEGORY::get_id($class);//findid
			$category_title	= utility::get_title(UTILITY::get_page_by_path($class));				
			$title = utility::get_title($p);
			$name = utility::get_name($p);	
			$page_id = utility::get_id($p);

		
			$otraurl = get_permalink($p);		
			$url = $otraurl;		

			
			IF($iscloudtag){ 
				$title = $class.'('.$elem.')';
				IF($elem >= 0 && $elem <= 1) { $size =  MODEL_COMPONENT::H6_BOLD; } 
				ELSE IF($elem > 1 && $elem <= 3) { $size =  MODEL_COMPONENT::H5_BOLD; } 
				ELSE IF($elem > 3 && $elem <= 5) { $size =  MODEL_COMPONENT::H4_BOLD; }
				ELSE IF($elem > 5) { $size =  MODEL_COMPONENT::H3_BOLD; }	
			}

			IF(!$isnavbar) { 
				$bg_gardient = UTILITY::get_bg_color($id); //*_gardient_alpha*/
				//$caption_class = $bg_gardient.' '.$caption;
				
				$caption_class = $caption;
				//if($isgrid){					
					$caption_class = $caption_class.' '.$bg_gardient;
					//echo $caption_class;
					//$caption_class = $bg_gardient;
				//}
				
				if($iscarouseldefault){
					$caption_class = $caption_class.' '.$extended;					
					$bgimageextended = "'".UTILITY::get_category_image($class)."'";				
				}
				
				if(!$dtitle){				
					$bgimage =  "'".utility::get_product_image($name)."'";//url(&quot;data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' version='1.1' height='50px' width='120px'><text x='0' y='15' fill='red' font-size='20'>I love SVG!</text></svg>&quot;); 
					IF($carouselmodal){	
						$bgimage = "&quot;data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' version='1.1' height='50px' width='120px'><text x='0' y='15' fill='red' font-size='20'>".$name."</text></svg>&quot;";
					}					
				}
			}
	
			IF($isgrid) {
				IF($isfeed) {				
					$p_feed = utility::get_page_by_path($class);
					$category_url = get_permalink($p_feed);
					$category_update = utility::should_update_category($class);			
					$header_icon_url = $category_url;	
					//$category_update = true;
					IF(  $category_update){
						//$header_icon_url = $preurl_icon.$class;
						//echo $header_icon_url.'<--';
						$header_icon_url = $preurl_icon.utility::get_id($p_feed);//NAME AQUI.			
					}
				}
				
				if($end){ $colxtra = ''; }
			} ELSE IF($iscarousel) { 
				//$col = $carousel_item; 
				IF(!$isnavbar){					
					IF($carouselmodal || $iscarouseldefault){
						//$col = $col.' '.$bg_gardient;
						IF($carouselmodal){
							$slide_info = "last-slide='".$end."' current-slide='".$name."'";						
							IF(/*$start || $single_slide*/$active) { $_COOKIE["nombre"] = $name; }//active ?¿
						}
					}					
				}				
			}
		}
?>
<?php IF($header) { ?>
	<?php IF($start) { ?>
	<!-- slide h-100 -->
		<div   id="<?php ECHO $component_id; ?>" <?php ECHO $single_slide.' '.$story; ?> class="<?php echo $bordercaru; ?> carousel  carousel-dark" data-bs-ride="carousel" data-bs-interval="<?php ECHO $time; ?>" data-bs-pause="false">
			<?php if($dcontrols){ ?>
			<ol class="carousel-indicators m-0">
			<?php } ?>
	<?php } ?>
			<?php if($dcontrols){ ?>
				<li data-bs-target="#<?php ECHO $component_id; ?>" data-bs-slide-to="<?php ECHO $i; ?>" class="bar <?php ECHO $active; ?>">
						<div class="in"></div>
				</li>	
			<?php } ?>	
	<?php IF($end) { ?>	
			<?php if($dcontrols){ ?>	
			</ol>
			<?php } ?>			
	<?php } ?>
<?php } ?>
<?php IF(!$header) { ?>
	<?php IF($start) { ?>
			<div class="<?php ECHO $row; ?>   " style="<?php ECHO $height; ?>;"><!--style="height:400px;"-->
	<?php } ?>
				<div class="<?php ECHO $colpaddingb.' '.$colpadding.' '.$col.' '.$colxtra.' '.$active; ?>" <?php ECHO $slide_info; ?> >	<!--  -->
			<?php //IF($progress_bar) { ?>
					<!--<div class="bar">
						<div class="in"></div>
					</div>
					-->
			<?php //} ?>
			<?php FOR ($x = 0; $x <= $jsvar; $x++) {
				IF($isnavbar){ 
					$class = null;
					
					$result = $i+$x;
					IF($result>=$count){ $result = $result-$count; }
					
					$mostrar = $model[$result];
					
					$id = CATEGORY::get_id($mostrar);//findid
					$p_nav = utility::get_page_by_path($mostrar);

					IF($isnavbarstoriesnew){

						$p_nav = get_page_by_path($mostrar,OBJECT,'post');												
						$cname = utility::get_the_category($p_nav);
						$id = CATEGORY::get_id($cname);//findid
						$p_nav_id = utility::get_id($p_nav);
						//$category_update = view::check_single_update($cname, $mostrar, $TODELETE);						
						//primero comprobar si ESTA CATEGORIA tiene noticias recientes, sisi seguir, singo category_update = false;
						//if(utility::have_recent_news(array($cname, 'category_name'))){	
						$category_update = utility::should_update($p_nav);
					//}else{
					//	$category_update = false;
					//}
					} ELSE IF($isnavbarspecial){ 
						IF($current_category){
							$icon_active = ''; 		
							IF($current_category == $mostrar){ $icon_active = $active_class; }
						}
						IF($mostrar == CONF::SLUG_SERVICES){
							$id =  $mostrar;
							//$mostrar = ;								
							$p_nav = utility::get_page_by_path(EXTENDED::SERVICES[1]);
						}
					} ELSE IF($isnavbarstoriescat){					
						$p_id_nav = utility::get_id($p_nav);
						
						//$icon_url = $preurl_icon.$mostrar;						
						//$p_id_nav = 'fid-'.$mostrar;	
						//echo $icon_url.'<--<br>';	
						//echo $p_id_nav.'<--';	
						
						$icon_url = $preurl_icon.$p_id_nav;//NAME AQUI.						
						$p_id_nav = 'fid-'.$p_id_nav;//NAME AQUI.	
						
						if($get_storyng){
							$next = $result+1;
							if($next > $jsvar){ $next = null; /*0*/ }
							
							$storyngid = $next;							
							if($next != null){
								$storyngid = utility::get_id(utility::get_page_by_path($model[$next]));						
							}
							//$storyng = 'story="'.$mostrar.'"';//$model[$next];
							$storyng = 'story="'.$storyngid.'"';	//NAME AQUI.
						}
						
						$category_update = utility::should_update_category($mostrar);
						//$category_update = true;
						//if( /*utility::match($mostrar, view::get_categories_viewed()) &&*/ !utility::match($mostrar, view::get_categories_not_viewed()) ){
						//	$category_update = FALSE;
						//}
					}

					IF(!$isnavbarstoriescat){ $icon_url = get_permalink($p_nav); }
					$mostrar2 = $p_nav->post_title;
				} ?>
					<?php //echo 'active: '.$active.'<br> nn: '.$nn.'<br> count: '.$count.'<br> result: '.$result.'<br> jsvar: '.$jsvar; ?>
					<?php //$fin = "";if($isnavbar && $result == $count-1 || $iscarouseldefault && $end){/*$fin = "fin";*/} ?>
					<!--textcenter pal navbar -->
					<!-- d-flex justify-content-center align-content-center -->
					<div class=" h-100  text-center <?php ECHO $container.' '.$p_id_nav; ?> <?php echo $result; ?>" <?php echo $storyng; ?>><!-- style="max-width:350px;"  --> <!--style="height:< ?php ECHO $height; ?>px;"--> 
					<?php IF($isfeed) {  ?>
						<?php COMPONENT::init(COMPONENT::HEADER_CATEGORY, array(null,$id, $category_update, $header_icon_url, $category_url, $category_title, $otraurl, 3)); ?>
					<?php } ?>
					<?php IF(!$isnavbar) { ?>
						<div class="h-100 <?php ECHO $caption_class; ?> " style="background-image: url(<?php echo $bgimageextended; ?>);"><!-- p-0 card-body  -->														
						<div class="h-100 flex-column <?php ECHO $titlealign; ?> " style="background: url(<?php echo $bgimage; ?>); background-position:center center; background-repeat: no-repeat; background-size: <?php echo $bg_size; ?>;">			<!--  cover contain --> <!--text-center  -->

							<a class="<?php ECHO $link_class; ?> " href="<?php ECHO $url; ?>" aria-label="<?php ECHO $title; ?>"><!--alturareader -->
					<?php } ?>
					<?php IF($iscarousel && !$isnavbar) { ?>		
									<!--
								<div class="carousel-cards bg-transparent card " ><!--text-center  -->
									<!--<div class="card-header bg-alpha-white">
									-->
					<?php } ?> 
					<?php IF($isnavbar) { ?> 
					
										<?php COMPONENT::init(COMPONENT::ICON, array($id,$color,MODEL_COMPONENT::ICON_M, $category_update, $icon_url, $mostrar2, array($style, $icon_active), null, $showborder )); ?>	
										
										
					<?php } ELSE { ?>
										<?php if($dtitle){ ?>
										<?php COMPONENT::init(COMPONENT::TITLE, array($title, $size)); ?>
										<?php } else { ?> 
										<div class="" style="padding-bottom: 88%" >&nbsp;</div>
										<?php } ?>
					<?php } ?>
					<?php IF($iscarousel && !$isnavbar) { ?>									
									<!--</div>-->
					<?php } ?> 

					<?php IF($overlay) { ?>
									<div class="image-overlay rounded text-light d-flex justify-content-center align-items-center">	
					<?php } ?>

					<?php IF($overlay /*|| ($iscarouseldefault && controller::is_category())*/) { ?>
										<div class="d-flex justify-content-center align-items-center">
											<?php COMPONENT::init(COMPONENT::PROPERTIES, array($p,MODEL_COMPONENT::PROPERTIES_FEATURED, false)); ?>
											<?php COMPONENT::init(COMPONENT::PROPERTIES, array($p,MODEL_COMPONENT::PROPERTIES_INFO, false)); ?>
										</div>
					<?php } ?>
					<?php IF($overlay) { ?>
									</div>	
					<?php } ?>
					<?php IF($iscarousel && !$isnavbar) { ?>								
								<!--</div>-->
					<?php }  ?> 
					<?php IF(!$isnavbar) { ?>								
							</a>						
							<?php if($carouselmodal){ COMPONENT::init(COMPONENT::CONTENT, array(false, $p, MODEL_COMPONENT::CONTENT_CUT)); } ?>					
						</div>					
						</div>
						<?php IF($isdefaultlist && !$is_services){ ?>
						<div class="card-footer text-start p-0 border-0">	<!--  p-nomy -->					
							<?php COMPONENT::init(COMPONENT::ACCORDION_CONTENT, array(true, 0, $p, MODEL_COMPONENT::CONTENT_EXC)); ?>
							<?php COMPONENT::init(COMPONENT::ACCORDION_CONTENT, array(true, 1, $p, MODEL_COMPONENT::CONTENT_FULL)); ?>
							<?php COMPONENT::init(COMPONENT::COMMENTS, array($p, true)); ?> 
							<?php //COMPONENT::init(COMPONENT::CONTENT, array($p, MODEL_COMPONENT::CONTENT_CUT)); ?>					
						</div>
						<?php }  ?>
					<?php }  ?> 
					</div>
			<?php } ?>
				</div>
	<?php IF($end) { ?>
			</div>
			<?php IF($iscarousel) { ?>
			<div class="<?php echo $showcontrols; ?>">
				<a class="carousel-control-prev <?php ECHO $bg_controls; ?>" href="#<?php ECHO $component_id; ?>" role="button" data-bs-slide="prev">
					<span class="carousel-control-prev-icon <?php ECHO $hidearrows; ?>" aria-hidden="true"></span>
					<span class="sr-only">Anterior</span>
				</a>
				<a class="carousel-control-next <?php ECHO $bg_controls; ?>" href="#<?php ECHO $component_id; ?>" role="button" data-bs-slide="next">
					<span class="carousel-control-next-icon <?php ECHO $hidearrows; ?>" aria-hidden="true"></span> 
					<span class="sr-only">Siguiente</span>
				</a>
			</div>
			<?php } ?>
		<?php IF($iscarousel) { ?>		
		</div>
		<?php } ?>
	<?php } ?>
<?php } $i++; $columna++; } } ?>