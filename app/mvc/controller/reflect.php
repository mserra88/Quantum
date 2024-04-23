<?php
	CLASS REFLECT {		
		PRIVATE STATIC $REFLECTED =								[NULL];	
		
		PUBLIC STATIC FUNCTION get_reflected()					{ RETURN ARRAY_COLUMN(SELF::$REFLECTED, 0); }	

		PUBLIC STATIC FUNCTION set_reflected(){ 
			FOREACH(CATEGORY::get_categories_array() AS $i => $category){ 
				IF(SELF::get_dll($i)){ ARRAY_PUSH(SELF::$REFLECTED, $category); } 
			}
		}
		
		PUBLIC STATIC FUNCTION is_reflected(){
			$is_category = CONTROLLER::is_category();
			$is_product = CONTROLLER::is_product();
			$is_single = CONTROLLER::is_single();
			IF(SELF::get_reflected() && ($is_category || $is_product || $is_single)){ 						
				IF($is_category){ $current_category = UTILITY::get_name(); } 
				ELSE IF($is_product){ $current_category = UTILITY::get_parent_name(); } 
				ELSE IF($is_single){ $current_category = UTILITY::get_the_category(); } 					
				FOREACH(CATEGORY::get_categories() AS $i => $category){ 
					IF(SELF::get_dll($i) && $current_category == $category){ RETURN TRUE; }//break; 		
				} 		
			}			
		}

		PUBLIC STATIC FUNCTION get_dll($id){
			$constant = SELF::get_class_func('CONF', 'DLL_'.STRTOUPPER(SELF::get_name($id)));
			IF(DEFINED($constant)){ RETURN CONSTANT($constant); }//IF((NEW ReflectionClass($class))->hasConstant($func)){ RETURN CONSTANT(SELF::get_class_func($class, $func)); } 
		}	
		
		PUBLIC STATIC FUNCTION get_reflected_count()			{ RETURN UTILITY::set_value(COUNT(SELF::get_reflected()), '0'); } 
		
		PUBLIC STATIC FUNCTION get_method($name)				{ RETURN CALL_USER_FUNC_ARRAY(SELF::get_class_func($name, 'get_'.$name), ARRAY(NULL)); }		

		PUBLIC STATIC FUNCTION get_name($id = NULL)				{ RETURN CATEGORY::get_properties($id)[0]; }//RETURN SELF::$REFLECTED[$id][0];	
		
		PRIVATE STATIC FUNCTION get_class_func($class, $func)	{ RETURN $class.'::'.$func; }
	}
?>