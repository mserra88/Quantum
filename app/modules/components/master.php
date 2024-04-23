<?php
	$model = COMPONENT::get_model();
	$settings = $model[1]; 
	


	$is_services = CONTROLLER::is_services();
	$is_product = CONTROLLER::is_product();
	$is_single = CONTROLLER::is_single();
	$is_explore = CONTROLLER::is_explore();
	$is_category = CONTROLLER::is_category();
	$is_page = CONTROLLER::is_page();
	$is_404 = CONTROLLER::is_404();

	$title = VIEW::get_title();
	$subtitle = VIEW::get_subtitle();
	$page = view::get_page();
	$category_update = view::get_category_update();
	$category_id = 	CATEGORY::get_id();//a view
	
	$title_lenght_max = 15;//15//8
	if(strlen($title)>$title_lenght_max && !$is_404){ $title_tooltip = strtoupper($title); $title = substr($title, 0, $title_lenght_max).'...'; }

	$display_li_3 = true;	//ROW3
	$display_li_4 = true;	//ROW4
	$display_li_4_accordion_button = true;	
	$diplay_icon = true;
	$display_explore_link = true;	
	$display_news = true;
	$display_products = true;	
	$display_featured = true;
	
	//$padding = "pt-1";
	//$padding_li_2 = $padding;

	IF($is_404){
		$hideall = true;
		$display_li_3 = false;
		$display_li_4_accordion_button = false;		
		$display_news= false;
		$display_products= false;

		$collapse_show = 'show';
		//$accordion_st = '';
	} ELSE IF ($is_single) {
		$display_li_3 = false;
		$display_li_4 = false;			
		$display_news = false;
		$display_products = false;
		//$display_comments = true;
		$show_collapse = 'show';
		//$cat_name = UTILITY::get_the_category();//a view,
		//UTILITY::get_the_category()
		//$page = get_page_by_path(UTILITY::get_name(),OBJECT,'post');	
		//$category_id = category::get_id($cat_name);//a view.
		$tags = get_the_tags($page->ID);
		$showtags=true;
		$diplay_icon = false;//$icon_url = '#';	
		$bg_color = UTILITY::get_bg_color($category_id);
		$imageee = UTILITY::get_single_image();
	} ELSE IF ($is_product) {
		$show_collapse = 'show';
		$display_li_4 = false;
		$display_news = false;
		$display_products = false;
		$display_comments = true;
		$bg_color = UTILITY::get_bg_color($category_id);
		if($product){ $display_comments = false; }
		$display_properties_info = true;
		$display_properties = true;
		$display_featured_icon = true;
		$diplay_icon = false;
		$imageee = utility::get_product_image();
	} else if ($is_services){
		$category_border_color = controller::get_name();		
		$display_featured = false;
		$count_products = reflect::get_reflected_count(); 
	} else if ($is_category){
		$category_border_color = UTILITY::get_border_bottom_color($category_id);
		$display_excerpt = true;		
		$count_products = CATEGORY::get_products_count(ARRAY($category_id));
		$count_featured = CATEGORY::get_products_count(ARRAY($category_id, true));
		//$tuvehistoriasrecientes = utility::match(CATEGORY::get_name(), view::get_categories_viewed());	
		$icon_url = null;//get_permalink($page);
		if($category_update || $tuvehistoriasrecientes){
			//$icon_url = '?news_single='.UTILITY::get_name($page);			
			//echo $icon_url.'<-';
			$icon_url = '?news_single='.utility::get_id($page);//NAME AQUI. //utility::get_id(utility::get_page_by_path(CATEGORY::get_name($id))->ID; 
		}
	} else if ($is_explore){
		$category_id = null;
		//$bg_color = UTILITY::get_bg_color(category::find_id(get_page_by_path($_GET["product"])->post_name));
		$category_border_color = controller::get_name();		
		$display_explore_link = false;
		$count_products = CATEGORY::get_products_count();
		$count_featured = CATEGORY::get_products_count(ARRAY(NULL, true));	
	} else if ($is_page){
		$show_collapse = 'show';
		$display_li_4 = false;			
		$display_news = false;
		$display_products = false;
		$display_properties = true;
		//$show_collapse = 'show';
		$diplay_icon = false;
		$imageee = UTILITY::get_page_image();
	}
	
	$cat_url = get_permalink(utility::get_page_by_path($cat_name));
		
	$ts_small = MODEL_COMPONENT::SMALL;
	$ts_normal = MODEL_COMPONENT::NORMAL;
	$tsnormalbold = MODEL_COMPONENT::NORMAL_BOLD;
	$tssmallbold = MODEL_COMPONENT::SMALL_BOLD;
	

?>



<div class="card border-0">
	<div class="card-header border-0 p-0 d-flex bg-transparent ">		<!-- align-items-center -->

		<span class="d-none d-sm-inline m-1"> <!-- d-md-none -->
		<?php IF($diplay_icon){ ?>
			<?php COMPONENT::init(COMPONENT::ICON, array(null,null,MODEL_COMPONENT::ICON_XL, $category_update, $icon_url, false, TRUE)); ?>						
		<?php } ELSE { ?><!-- 168x186px -->
			<img loading="lazy" alt="<?php echo $title; ?>" class="rounded-circle border border-secondary <?php echo $bg_color.' ICON_XL'; ?>" src="<?php echo $imageee;?>"/>				
		<?php } ?>					
		</span>
		<span class="d-sm-none m-1">
		<?php IF($diplay_icon){ ?>
			<?php COMPONENT::init(COMPONENT::ICON, array(null,null,MODEL_COMPONENT::ICON_L, $category_update, $icon_url, false, TRUE)); ?>			
		<?php } ELSE { ?><!-- 82x90px; -->				
			<img loading="lazy" alt="<?php echo $title; ?>" class="rounded-circle border border-secondary <?php echo $bg_color.' ICON_L'; ?> "  src="<?php echo $imageee;?>"/>	
		<?php } ?>					
		</span>	
		<div class="card border-0 w-100">
			<div class="card-header border-0 p-0">	
				<ul class="list-group list-group-flush">				
					<li class="list-group-item p-0 d-flex align-items-center">					
						<?php IF($title_tooltip) { ?>
						<span data-bs-toggle="tooltip" data-bs-placement="bottom" title="<?php echo $title_tooltip; ?>">
						<?php } ?>							

						<?php COMPONENT::init(COMPONENT::TITLE, array($title)); ?>

						<?php IF($title_tooltip) { ?>
						</span>								
						<?php } ?>
						<?php IF($display_featured_icon){ ?> 		
						<?php COMPONENT::init(COMPONENT::PROPERTIES, array($page,MODEL_COMPONENT::PROPERTIES_FEATURED)); ?>
						<?php } ?>
						<?php IF($display_share){ ?> 																						
						<?php //COMPONENT::init(COMPONENT::SHARE, array(true, $url)); ?>
						<?php } ?>						
					</li>
					<li class="list-group-item p-0 border-0 d-flex align-items-center pt-1">					
						<?PHP IF($display_properties_info){ ?>
							<?php COMPONENT::init(COMPONENT::PROPERTIES, array($page,MODEL_COMPONENT::PROPERTIES_INFO)); ?>
						<?php } ELSE IF($showtags){ ?>						
								<a href="<?php ECHO $cat_url; ?>" class="btn border rounded-0">								
									<?php COMPONENT::init(COMPONENT::TITLE, array('#'.$cat_name, $ts_small)); //!CATNAME ?>
								</a>
								<?php IF($tags){ ?>								
									<?php FOREACH($tags AS $tag) {
											$tag_name = utility::get_tag_name($tag);
											$tag_url = get_permalink(utility::get_page_by_path($cat_name, $tag_name));//!CATNAME
									?>
									<a href="<?php ECHO $tag_url; ?>" class="btn border rounded-0">
										<?php COMPONENT::init(COMPONENT::TITLE, array('#'.$tag_name, $ts_small)); ?>
									</a>
									<?php }	?>
								<?php }	?>
						<?PHP } ELSE { ?> 
							<?php COMPONENT::init(COMPONENT::TITLE, array($subtitle, $ts_normal, $transform)); ?> 
						<?php } ?>
					</li>					
					<?php if($display_li_3){ ?>
					<li class="list-group-item p-0 border-0 pt-1">				
						<?php IF($display_properties){ 	?>						
							<span class="d-none d-sm-inline">
								<?php  COMPONENT::init(COMPONENT::PROPERTIES, array($page, MODEL_COMPONENT::PROPERTIES_DETAIL));  ?>								
							</span>	
							<!--
							<span class="d-sm-none d-inline">							
								< ?php COMPONENT::init(COMPONENT::PROPERTIES, array($page,MODEL_COMPONENT::PROPERTIES_BUTTONREGISTER)); ?>
							</span>	
							-->	
						<?php } ELSE { ?>						
						<nav id="settings-filter" class="nav justify-content-between text-center nav-fill <?php //if(controller::is_services()){ echo 'w-50'; } ?>" role="tablist">
							<a class="link-secondary nav-item nav-link p-0 active <?php ECHO $category_border_color ?>" id="nav-products-tab" data-bs-toggle="tab" href="#nav-products" role="tab" aria-controls="nav-products" aria-selected="true">
															
								<?php COMPONENT::init(COMPONENT::TITLE, array(UTILITY::set_value($count_products, 0), $ts_normal)); ?>
								<br>						
								
								<?php COMPONENT::init(COMPONENT::ICON, array(null,null,MODEL_COMPONENT::ICON_S, null, null, null, null, null, false));  ?>
								
								<?php COMPONENT::init(COMPONENT::TITLE, array(CONF::PRODUCTS_TITLE, $ts_small)); ?>							
							</a>
							<?php if($display_featured){ ?>	
							<a class="link-secondary nav-item nav-link p-0 " id="nav-featured-tab" data-bs-toggle="tab" href="#nav-featured" role="tab" aria-controls="nav-featured" aria-selected="false">
								
								<?php COMPONENT::init(COMPONENT::TITLE, array(UTILITY::set_value($count_featured, 0), $ts_normal)); ?>
								<br>							
								<i class=" icon-component fas fa-trophy fa-1x text-warning"></i>
								<?php COMPONENT::init(COMPONENT::TITLE, array(CONF::FEATURED_TITLE, $ts_small)); ?>
							</a>
							<?php } ?>
						</nav>
						<?php } ?>					
					</li>
					<?php }  ?>	
					<?php if($display_li_4 && $display_li_4_accordion_button){ ?>
					<li class="list-group-item p-0 d-flex justify-content-end pt-1">
			
						<h6 class="accordion-header">				
						  <a id="relatedTwo" class="btn accordion-button  border rounded px-3 py-2 collapsed" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">						  
						  </a>
						</h6>

					</li>
					<?php }  ?>	
					
				</ul>
			</div>			
		</div>
		
	</div>
	
	<?php IF($display_excerpt){	?>
	<div class="card-body p-0">
		<?php COMPONENT::init(COMPONENT::ACCORDION_CONTENT, array(null, 0, $page, MODEL_COMPONENT::CONTENT_EXC)); ?>
	</div>
	<?php }	?>

	<div class="card-footer bg-transparent border-0 p-0">	
	<?php COMPONENT::init(COMPONENT::ACCORDION_CONTENT, array(null, 1, $page, $content_type, $show_collapse, $display_properties, $display_comments)); ?>		
	<?php if($display_li_4){ ?>	
		<div class="collapse <?php echo $collapse_show; ?>" id="collapseExample">
		<?php IF($display_explore_link){ ?>
		<?php COMPONENT::init(COMPONENT::TITLE, array(controller::get_subtitle(controller::get_id(CONF::SLUG_EXPLORE)), $tssmallbold)); ?>		
			<a class="ps-5 d-inline p-0 nav-item nav-link" href="<?php ECHO get_permalink( UTILITY::get_page_by_path(CONTROLLER::get_title(controller::get_id(CONF::SLUG_EXPLORE))) ); ?>">
				<?php COMPONENT::init(COMPONENT::TITLE, array(CONTROLLER::get_title(controller::get_id(CONF::SLUG_EXPLORE)), $tssmallbold)); ?>
			</a>
		<?php } ?>	

		<?php COMPONENT::init(COMPONENT::QUANTUM, ARRAY(MODEL_COMPONENT::NAVBAR_SPECIAL, MODEL_COMPONENT::ALL_CATEGORIES)); ?>

		<?php //IF (controller::is_explore()) { ?> 
			<?php //COMPONENT::init(COMPONENT::QUANTUM, ARRAY(MODEL_COMPONENT::DEFAULT, MODEL_COMPONENT::ALL_PRODUCTS_CLOUD)); ?>
		<?php //} ?> 
		</div>
	<?php } ?>		
	</div>
</div>
<?php IF($display_news) { ?>
<?php COMPONENT::init(COMPONENT::QUANTUM, ARRAY(MODEL_COMPONENT::NAVBAR_STORIES_NEWS, MODEL_COMPONENT::NEWS)); ?>
<?php } ?>
<?php IF($display_products) {  ?>
<div class="tab-content">
	<?php COMPONENT::init(COMPONENT::slave, array($category_id, 0)); ?>
	<?php IF($display_featured){ ?>
	<?php COMPONENT::init(COMPONENT::slave, array($category_id, 1)); ?>
	<?php } ?>		
</div>
<?php } ?>