<?php
	CLASS VIEW {
		PRIVATE STATIC $category_update						= NULL;
		PRIVATE STATIC $view								= NULL;
		PRIVATE STATIC $page								= NULL;
		PRIVATE STATIC $title								= NULL;
		PRIVATE STATIC $subtitle							= NULL;		
		PRIVATE STATIC $ARRAYNEWS							= NULL;
		PRIVATE STATIC $ARRAYNEWSMODAL						= NULL;		
		PRIVATE STATIC $CATEGORIESUPDATED					= NULL;
		PRIVATE STATIC $TODELETE							= NULL;
		PRIVATE STATIC $stories								= NULL;
		PRIVATE STATIC $todas_vistas						= NULL;		
		PRIVATE STATIC $CATEGORIES_VIEWED					= NULL;
		PRIVATE STATIC $CATEGORIES_NOT_VIEWED				= NULL;
		PRIVATE STATIC $storyng								= NULL;
		PRIVATE STATIC $NAME 								= NULL;
		PRIVATE STATIC $siteurl 							= NULL;
		PRIVATE STATIC $uri 								= NULL;
		PRIVATE STATIC $meta_keywords 						= NULL;		
		PRIVATE STATIC $meta_description 					= NULL;
		PRIVATE STATIC $meta_title 							= NULL;
		PRIVATE STATIC $id_news 							= NULL;
	
		PUBLIC STATIC FUNCTION get_id_news()				{ RETURN SELF::$id_news; }			
	
		PUBLIC STATIC FUNCTION get_clarity()				{ RETURN EXTENDED::CLARITY; }			

		PUBLIC STATIC FUNCTION get_meta_title()				{ RETURN SELF::$meta_title; }	
		PUBLIC STATIC FUNCTION get_meta_description()		{ RETURN SELF::$meta_description; }	
		
		PUBLIC STATIC FUNCTION get_name()					{ RETURN SELF::$NAME; }		
		PUBLIC STATIC FUNCTION get_categories_viewed()		{ return SELF::$CATEGORIES_VIEWED; }	
		PUBLIC STATIC FUNCTION get_categories_not_viewed()	{ return SELF::$CATEGORIES_NOT_VIEWED; }			
		PUBLIC STATIC FUNCTION get_storyng()				{ return SELF::$storyng; }	//NAME AQUI.	
		PUBLIC STATIC FUNCTION get_stories()				{ return SELF::$stories; }	//NAME AQUI.
		PUBLIC STATIC FUNCTION get_uri()					{ RETURN SELF::$uri; }	
		PUBLIC STATIC FUNCTION get_categories_updated()		{ return SELF::$CATEGORIESUPDATED; }
		PUBLIC STATIC FUNCTION get_to_delete() 				{ return SELF::$TODELETE; }
		PUBLIC STATIC FUNCTION get_news() 					{ return SELF::$ARRAYNEWS; }
		PUBLIC STATIC FUNCTION get_news_modal()				{ return SELF::$ARRAYNEWSMODAL; }		
		PUBLIC STATIC FUNCTION get_title()					{ return SELF::$title; }		
		PUBLIC STATIC FUNCTION get_page()					{ return SELF::$page; }
		PUBLIC STATIC FUNCTION get_category_update()		{ return SELF::$category_update; }
		PUBLIC STATIC FUNCTION get_todas_vistas()			{ return SELF::$todas_vistas; }		
		PUBLIC STATIC FUNCTION get_meta_keywords() 			{ return SELF::$meta_keywords; }
		PUBLIC STATIC FUNCTION get_site_url() 				{ return SELF::$siteurl; }
		PUBLIC STATIC FUNCTION get_subtitle() 				{ return SELF::$subtitle; }
				
		PUBLIC STATIC FUNCTION get_view($partial_view = NULL) { 
			IF($partial_view){ APP::get_partial_view($partial_view); }
			ELSE{ APP::get_template_part(SELF::$view); }
		}
		
		PUBLIC FUNCTION __construct() {
			$is_home = CONTROLLER::is_home();
			$is_category = CONTROLLER::is_category();
			$is_product = CONTROLLER::is_product();
			$is_explore = CONTROLLER::is_explore();
			$is_services = CONTROLLER::is_services();
			$is_page = CONTROLLER::is_page();
			$is_single = CONTROLLER::is_single();
			$is_404 = CONTROLLER::is_404();
			
			SELF::$NAME = STRTOUPPER(STR_REPLACE(' ', '', UTILITY::get_bloginfo('name'))); //SELF::$URI = get_template_directory_uri(); //get_stylesheet_directory_uri();   get_bloginfo('charset');  get_bloginfo('description');
			SELF::$page = get_post();
			SELF::$siteurl = get_site_url();
			SELF::$uri = get_template_directory_uri();
			
			$title = wp_title('', false);
			IF($is_home){
				$calculos = true;				
				$view = CONF::SLUG_HOME;
			} ELSE IF($is_category) {
$subtitle = category::get_subtitle();	
				
				$calculos = true;
				$estenombre = CATEGORY::get_name();				
			} ELSE IF($is_product) {
$subtitle = category::get_subtitle();	
				
			} ELSE IF($is_explore) {
				
				$calculos = true;
			} ELSE IF($is_services) {
				$calculos = true;//$subtitle = EXTENDED::SERVICES[2];	
			} ELSE IF($is_page) {
				
			$name = UTILITY::get_name();			
			if($name == EXTENDED::CONTACT) { $subtitle = EXTENDED::CONTACT_SUBTITLE; }
			else if($name == EXTENDED::privacity) { $subtitle = EXTENDED::privacity_subtitle; }

				
			} ELSE IF($is_single) {	
$subtitle = category::get_subtitle();	

				$_COOKIE["nombre"] = UTILITY::get_name(); //$calculos = true; $estenombre = CATEGORY::get_name();	
			} ELSE IF($is_404) {
				$title = CONTROLLER::get_title().': '.$title;		
			} 
			SELF::$view = UTILITY::set_value($view, CONF::SLUG_MASTER);
			SELF::$title = $title;	
			SELF::$subtitle = UTILITY::set_value($subtitle, CONTROLLER::get_subtitle());
			
			IF(ISSET($_GET["news"]) || ISSET($_GET["news_single"])) {
				IF(ISSET($_GET["news"])) { $id_news = $_GET["news"]; }
				ELSE IF(ISSET($_GET["news_single"])) { $id_news = $_GET["news_single"]; }
			}
			SELF::$id_news = $id_news;//NAME AQUI.	

			IF($calculos) {		
				$nametodelete = $_COOKIE["cookie"];
				IF(!IS_ARRAY($nametodelete)) { $nametodelete = ARRAY_UNIQUE(EXPLODE(",", $nametodelete)); }//$temp = array();//array_push($temp, $nametodelete);//$nametodelete = $temp;			
				SELF::$TODELETE = $nametodelete;	
				
				IF(!$is_services) {
					$model = UTILITY::get_news($estenombre);								
				} ELSE {
					$model = ARRAY();									
					FOREACH(REFLECT::get_reflected() AS $reflected_category) {						
						FOREACH(UTILITY::get_news($reflected_category) AS $single_name) {								
							ARRAY_PUSH($model, $single_name);
						}
					}
				}

				//if($model){//...
					$count = COUNT($model);
					
					$categories_not_viewed  = ARRAY();
					$categories_viewed = ARRAY();							
					$stories  = ARRAY();
					$arraynews = ARRAY();
					$arraynewsmodal = ARRAY();
					$todas_vistas = TRUE;

					FOREACH($model AS $i => $p) {				
						$noticia = UTILITY::get_name($p);
						$category = UTILITY::get_the_category($p);
						$cid = UTILITY::get_id(utility::get_page_by_path($category));
						
						IF($id_news) { 
							IF($id_news == $cid) { $current_category = TRUE; } 
							ELSE { $current_category = FALSE; } 
						} 
						
						IF(utility::should_update($p)) {						
							IF($current_category) { $todas_vistas = FALSE; }

							IF($is_single) {
								IF($noticia != UTILITY::get_name()) { $category_update = TRUE; }						
							} ELSE {
								IF(!$is_explore || !$is_services) {  							
									$category_update = TRUE;								
									IF($is_home && $current_category === FALSE && !UTILITY::match($cid, $stories)) { ARRAY_PUSH($stories, $cid); } //NAME AQUI.	
								}						
							}
							
							ARRAY_PUSH($categories_not_viewed, array($category, $cid));
						} ELSE {
							$category_update = FALSE; 
							IF(utility::should_update($p, TRUE)) { ARRAY_PUSH($categories_viewed, ARRAY($category, $cid)); }
						}

						$position = $i;
						IF(!$category_update) { $position = $count; }
						
						ARRAY_PUSH($arraynews, ARRAY($noticia, $position, UTILITY::get_date($p)));					
						
						IF($current_category) { ARRAY_PUSH($arraynewsmodal, $noticia); }				
					}
					
					SELF::$stories = ARRAY_VALUES($stories)[0]; //array values para reindexar el array. https://stackoverflow.com/questions/11224821/how-to-reindex-an-array/11224846			
					IF(!SELF::$stories && $id_news) { SELF::$storyng = TRUE; }
					SELF::$CATEGORIES_NOT_VIEWED = ARRAY_VALUES(ARRAY_UNIQUE(ARRAY_COLUMN($categories_not_viewed, 0)));
					SELF::$CATEGORIES_VIEWED = ARRAY_VALUES(ARRAY_UNIQUE(ARRAY_COLUMN($categories_viewed, 0)));		
					IF(SELF::$CATEGORIES_VIEWED) { SELF::$CATEGORIESUPDATED = ARRAY_VALUES(ARRAY_UNIQUE(ARRAY_MERGE(SELF::$CATEGORIES_NOT_VIEWED, SELF::$CATEGORIES_VIEWED))); } 
					ELSE { SELF::$CATEGORIESUPDATED = SELF::$CATEGORIES_NOT_VIEWED; }								
					ARRAY_MULTISORT(ARRAY_COLUMN($arraynews, 1), SORT_ASC, ARRAY_COLUMN($arraynews, 2), SORT_DESC, $arraynews);			
					SELF::$ARRAYNEWS = ARRAY_COLUMN($arraynews, 0);
					SELF::$todas_vistas = $todas_vistas;				
					SELF::$ARRAYNEWSMODAL = $arraynewsmodal;
					SELF::$category_update = $category_update;
				//}				
			}
		}
	}
?>