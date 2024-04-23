<?php
	CLASS CATEGORY {		
		
		PUBLIC STATIC FUNCTION get_categories_array()		{ RETURN EXTENDED::CATEGORIES; }
				
		//PUBLIC STATIC FUNCTION get_id($category = null)	{ RETURN ARRAY_SEARCH( UTILITY::set_value($category, UTILITY::get_parent_name()) , SELF::get_categories()); }
		
		PUBLIC STATIC FUNCTION get_id($category = null)		{ RETURN ARRAY_SEARCH(UTILITY::set_value($category, UTILITY::set_value(utility::get_the_category(), UTILITY::get_parent_name()) ) , SELF::get_categories()); }

		/*PUBLIC STATIC FUNCTION get_id($category = null){ 
			IF(!ISSET($category)){
				$category = UTILITY::get_parent_name();
				IF(controller::is_single()){ $category = utility::get_the_category(); }
			}			
			RETURN ARRAY_SEARCH($category, SELF::get_categories());
		}*/

		PUBLIC STATIC FUNCTION get_name($id = NULL)			{ RETURN SELF::get_value($id, 0); }
		PUBLIC STATIC FUNCTION get_icon($id = NULL)			{ RETURN SELF::get_value($id, 1); }
		PUBLIC STATIC FUNCTION get_subtitle($id = NULL)		{ RETURN SELF::get_value($id, 2); }			
		PUBLIC STATIC FUNCTION get_properties($id = NULL)	{ RETURN SELF::get_value($id, 3); }		
		PUBLIC STATIC FUNCTION get_info($id = NULL)			{ RETURN SELF::get_value($id, 4); }
		PUBLIC STATIC FUNCTION get_links($id = NULL)		{ RETURN SELF::get_value($id, 5); }
		PUBLIC STATIC FUNCTION get_keywords($id = NULL)		{ RETURN SELF::get_value($id, 6); }

		PUBLIC STATIC FUNCTION get_categories($all = null) { 
			$model = ARRAY_COLUMN(SELF::get_categories_array(), 0); 					
			IF($all){
				$categories_reflected = REFLECT::get_reflected();
				IF($categories_reflected){
					$temp = ARRAY();
					FOREACH($model AS $categories){	
						IF(utility::match($categories, $categories_reflected)){ 
							IF(!$services_added){ 
								$services_added = TRUE; 
								ARRAY_PUSH($temp, CONF::SLUG_SERVICES); 
							} 
						}ELSE{ ARRAY_PUSH($temp, $categories); }
					}
					$model = $temp;
				}
			}			
			RETURN $model;			
		}
		
		PUBLIC STATIC FUNCTION get_products_count($settings = null) { RETURN COUNT(SELF::get_products($settings)); }

		PUBLIC STATIC FUNCTION get_products($settings) { 	
			$id = $settings[0];			
			$featured = $settings[1];
			$iscloudtag = $settings[2];			
			$temp = ARRAY();
			
			FOREACH(CATEGORY::get_categories() AS $category){  
				$cid = CATEGORY::get_id($category);//findid
								
				IF(!ISSET($id)){ $all_categories = TRUE; } 
				ELSE{ IF($id == $cid){ $current_category = TRUE; } } 
				
				IF($all_categories || $current_category){
					FOREACH(utility::get_pages(utility::get_id(utility::get_page_by_path($category))) AS $product){
						IF(!($featured && !get_post_meta(utility::get_id($product), 'featured'))){ ARRAY_PUSH($temp, ARRAY($product, $cid, utility::get_date($product))); }
					}
					IF($current_category){ BREAK; }
				}
			}

			ARRAY_MULTISORT(ARRAY_COLUMN($temp, 2), SORT_DESC, $temp); 
			
			IF($iscloudtag){
				$temp = ARRAY_COUNT_VALUES(ARRAY_COLUMN($temp, 1)); 
				ARSORT($temp);	
			}

			RETURN $temp;	
		}
		
		PRIVATE STATIC FUNCTION get_value($id, $column)	{ RETURN SELF::get_categories_array()[UTILITY::set_value($id, SELF::get_id())][$column]; }														
	}		
?>