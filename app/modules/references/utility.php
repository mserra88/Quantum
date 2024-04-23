<?php
	CLASS UTILITY {		
	
		PUBLIC STATIC FUNCTION get_bloginfo($NAME)				{ RETURN get_bloginfo($NAME, 'display' ); }		
	
		PRIVATE STATIC FUNCTION get_global_post()				{ GLOBAL $post; RETURN $post; }	
		PUBLIC STATIC FUNCTION get_id($page = NULL)				{ RETURN UTILITY::set_value($page, SELF::get_global_post())->ID; }				
		PUBLIC STATIC FUNCTION get_name($page = NULL)			{ IF(is_array($page)){ $name = $page[0]->name; } ELSE { $name = UTILITY::set_value($page, SELF::get_global_post())->post_name; } RETURN $name; }	
		PUBLIC STATIC FUNCTION get_title($page= NULL)			{ RETURN UTILITY::set_value($page, SELF::get_global_post())->post_title; }	
		PUBLIC STATIC FUNCTION get_content($page= NULL)			{ RETURN UTILITY::set_value($page, SELF::get_global_post())->post_content; }	
		PUBLIC STATIC FUNCTION get_date($page= NULL)			{ RETURN UTILITY::set_value($page, SELF::get_global_post())->post_date; }		
		
		PUBLIC STATIC FUNCTION get_image($path, $file)			{ RETURN VIEW::get_uri().$path.SELF::set_value($file, SELF::get_name()).'.png'; }
		PUBLIC STATIC FUNCTION get_category_image($file=null)	{ RETURN UTILITY::get_image(CONF::DIR_IMG_CATEGORY, $file); }		
		PUBLIC STATIC FUNCTION get_single_image($file=null)		{ RETURN UTILITY::get_image(CONF::DIR_IMG_SINGLE, $file); }
		PUBLIC STATIC FUNCTION get_product_image($file=null)	{ RETURN UTILITY::get_image(CONF::DIR_IMG_PRODUCT, $file); }

		PUBLIC STATIC FUNCTION get_page_image()					{ RETURN UTILITY::get_logo('android-chrome'); }
		
		PUBLIC STATIC FUNCTION get_logo($file, $size=null)			{ RETURN VIEW::get_site_url().'/'.$file.'-'.UTILITY::set_value($size, '192').'x'.UTILITY::set_value($size, '192').'.png'; }
		
		PUBLIC STATIC FUNCTION get_current_year()				{ RETURN DATE('Y'); }		
		PUBLIC STATIC FUNCTION set_value($var, $i = null)		{ IF(ISSET($var)) { RETURN $var; } RETURN $i; }
		PUBLIC STATIC FUNCTION get_start($var)					{ IF($var == 0) { $result = TRUE; } RETURN $result; }		
		PUBLIC STATIC FUNCTION get_end($var, $i)				{ IF($var == $i-1) { $result = TRUE; } RETURN $result; }	
		PUBLIC STATIC FUNCTION get_bg_color($id)				{ RETURN 'bg-'.'CATEGORY'.'-'.$id; }
		PUBLIC STATIC FUNCTION get_text_color($id)				{ RETURN 'text-color-'.'CATEGORY'.'-'.$id; }	
		PUBLIC STATIC FUNCTION get_border_bottom_color($id)		{ RETURN 'border-bottom-color-'.'CATEGORY'.'-'.$id; }
				
		PUBLIC STATIC FUNCTION get_page_by_path($page_path, $product = null, $post_type = 'page') {
			IF($product != NULL) { $page_path .= '/'.$product; }
			RETURN get_page_by_path($page_path, OBJECT, $post_type);
		}	
		
		PUBLIC STATIC FUNCTION get_parent_name($page=null)		{ RETURN SELF::get_name(get_post(UTILITY::set_value($page, SELF::get_global_post())->post_parent));}
		
		PUBLIC STATIC FUNCTION get_pages($id)					{ RETURN get_pages(array('parent' => $id, 'child_of' => $id, 'post_type' => 'page', 'order' => 'ASC', 'orderby' => 'title', 'posts_per_page' => -1)); }	

		PUBLIC STATIC FUNCTION get_tag_name($tag)				{ RETURN self::get_name(array($tag)); }

		PUBLIC STATIC FUNCTION get_the_category($page = null)	{ RETURN self::get_name(array(get_the_category(self::get_id($page))[0])); }

		PUBLIC STATIC FUNCTION get_news($name, $TODELETE = null) {	
			$model = ARRAY(); 
			IF(term_exists($name, 'category' ) || !isset($name)) { $model = get_posts(array('category' => get_cat_ID($name), 'post_type' => 'post', 'order' => 'DESC', 'orderby' => 'date', 'posts_per_page' => -1)); }				
			RETURN $model;
		}

		PUBLIC STATIC FUNCTION should_update($p, $match = null){//, $isnew = null			
			IF(!$match){ $match = !SELF::match(SELF::get_name($p), view::get_to_delete()); }			
			IF($match && date_diff(date_create(get_the_date('Y-m-d', SELF::get_id($p))), date_create(DATE('Y-m-d', time())))->format('%a') <= 365){  $category_update = true; }			
			RETURN 	$category_update;			
		}

		PUBLIC STATIC FUNCTION should_update_category($category){
			IF(SELF::match($category, view::get_categories_not_viewed()) ){ $category_update = TRUE; }
			RETURN $category_update;
		}
		
		PUBLIC STATIC FUNCTION match($name, $array){ RETURN is_int(array_search($name, $array)); }
		
		PUBLIC STATIC FUNCTION create_sitemap() {
			$postsForSitemap = get_posts(array(
				'numberposts' => -1,
				'orderby' => 'modified',
				'post_type'  => array( 'post', 'page' ),
				'order'    => 'DESC'
			));
			$sitemap = '<?xml version="1.0" encoding="UTF-8"?>';
			$sitemap .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">';
			foreach( $postsForSitemap as $post ) {
				setup_postdata( $post );
				$postdate = explode( " ", $post->post_modified );
				$sitemap .= '<url>'.
				  '<loc>' . get_permalink( $post->ID ) . '</loc>' .
				  '<lastmod>' . $postdate[0] . '</lastmod>' .     
				  '<changefreq>daily</changefreq>' . 
				  '</url>';
			  }
			$sitemap .= '</urlset>';
			$fp = fopen( ABSPATH . 'sitemap.xml', 'w' );
			fwrite( $fp, $sitemap );
			fclose( $fp );
		}

		PUBLIC STATIC FUNCTION get_time_ago( $time , $minuscule=null) {	
			date_default_timezone_set("Europe/Madrid");  

			$time_difference = time() - strtotime($time);

			if( $time_difference < 1 ) { return 'Hace menos de 1s'; }
			$condition = array( 12 * 30 * 24 * 60 * 60	=>  'año',
						30 * 24 * 60 * 60       		=>  'mes',
						24 * 60 * 60            		=>  'dia',
						60 * 60                 		=>  'hora',
						60                      		=>  'minuto',
						1                       		=>  'segundo'
			);

			foreach( $condition as $secs => $str )
			{
				$d = $time_difference / $secs;

				if( $d >= 1 ) {
					$t = round( $d );
					 IF($str=='mes' && $t > 1){
						 $str =$str.'e';
					 }
					 if($minuscule!=false){
						$timeago = '<span class="d-none d-sm-inline">';
					}
					 $timeago = $timeago.'Hace '. $t . ' ' . $str . ( $t > 1 ? 's' : '' );///'</span>'
					
					if($minuscule!=false){
						$timeago = $timeago.'</span>';
					}
					
					 if($str=='minuto'){
						 $limit = 3;
					 }else {
						  $limit = 1;
					 }
					
					 if($minuscule!=false){
						$timeago = $timeago.'<span class="d-sm-none">'. $t . substr($str, 0, $limit) .'</span>';
					 }
					 return $timeago;
				}
			}
		}

		//PUBLIC STATIC FUNCTION have_recent_news($settings)				{ return (new WP_Query( array( $settings[1] => $settings[0], 'date_query' => array(array('column' => 'post_date_gmt', 'after'  => '365 days ago')) )))->found_posts; }		
		//PUBLIC STATIC FUNCTION is_new($id)								{ $R= date_diff(date_create(get_the_date('Y-m-d', $id)), date_create(DATE('Y-m-d', time())))->format('%a');  IF($R <= 365) { RETURN true; } RETURN false; }							
		//PUBLIC STATIC FUNCTION get_count($page)							{ RETURN $page->count; }	
		//PUBLIC STATIC FUNCTION has_value($array)							{ IF(!IS_ARRAY($array)) { $temp = ARRAY(); ARRAY_PUSH($temp, $array); $array = $temp; } FOREACH($array AS $var) { IF($var) { RETURN TRUE; } }  RETURN FALSE; }	
		//PUBLIC STATIC FUNCTION get_bg_color_gardient($id)					{ RETURN 'bg-gardient-'.'CATEGORY'.'-'.$id; }
		//PUBLIC STATIC FUNCTION get_bg_color_gardient_alpha($id) 			{ RETURN 'bg-gardient-alpha-'.'CATEGORY'.'-'.$id; }			
		//PUBLIC STATIC FUNCTION get_bg_color_secondary($id)					{ RETURN 'bg-secondary-'.'CATEGORY'.'-'.$id; }	
		//PUBLIC STATIC FUNCTION get_bg_image()								{ RETURN 'bg-image-'.'CATEGORY'.'-'.$id; }	
		//PUBLIC STATIC FUNCTION get_border_color($id) 						{ RETURN 'border-color-'.'CATEGORY'.'-'.$id; }
		//PUBLIC STATIC FUNCTION get_bg_color_secondary_gardient($id)		{ RETURN 'bg-gardient-secondary-'.'CATEGORY'.'-'.$id; }			
		//PUBLIC STATIC FUNCTION get_bg_color_secondary_gardient_alpha($id)	{ RETURN 'bg-secondary-gardient-alpha-'.'CATEGORY'.'-'.$id; }			
		//PUBLIC STATIC FUNCTION get_border_color_secondary($id) 			{ RETURN 'border-color-secondary-'.'CATEGORY'.'-'.$id; }			
		//PUBLIC STATIC FUNCTION get_header_class()							{ RETURN 'sticky-top bg-light border-bottom'; }			
		//PUBLIC STATIC FUNCTION get_text_color_secondary($id) 				{ RETURN 'text-color-secondary-'.'CATEGORY'.'-'.$id; }		
		/*
		function timeAgo($time_ago){
			date_default_timezone_set("Europe/Madrid");  

			$cur_time 	= time();
			$time_elapsed 	= $cur_time - strtotime($time_ago);
			$seconds 	= $time_elapsed ;
			$minutes 	= round($time_elapsed / 60 );
			$hours 		= round($time_elapsed / 3600);
			$days 		= round($time_elapsed / 86400 );
			$weeks 		= round($time_elapsed / 604800);
			$months 	= round($time_elapsed / 2600640 );
			$years 		= round($time_elapsed / 31207680 );
			
			echo 'Hace ';
			// Seconds
			if($seconds <= 60){
				echo "$seconds segundos";
			}
			//Minutes
			else if($minutes <=60){
				if($minutes==1){
					echo "1 minuto";
				}
				else{
					echo "$minutes minutos";
				}
			}
			//Hours
			else if($hours <=24){
				if($hours==1){
					echo "1 hora";
				}else{
					echo "$hours horas";
				}
			}
			//Days
			else if($days <= 7){
				if($days==1){
					echo "1 dia";
				}else{
					echo "$days dias";
				}
			}
			//Weeks
			else if($weeks <= 4.3){
				if($weeks==1){
					echo "1 semana";
				}else{
					echo "$weeks semanas";
				}
			}
			//Months
			else if($months <=12){
				if($months==1){
					echo "1 mes";
				}else{
					echo "$months meses";
				}
			}
			//Years
			else{
				if($years==1){
					echo "1 año";
				}else{
					echo "$years años";
				}
			}
		}
		*/		
	}
?>