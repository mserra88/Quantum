<?php
	CLASS CONTROLLER {	
		PUBLIC STATIC $IS_HOME =						NULL;		
		PUBLIC STATIC $IS_CATEGORY =					NULL;
		PUBLIC STATIC $IS_PRODUCT =						NULL;
		PUBLIC STATIC $IS_PAGE =						NULL;
		PUBLIC STATIC $IS_E404 =						NULL;		
		PUBLIC STATIC $IS_SINGLE =						NULL;
		PUBLIC STATIC $IS_EXPLORE =						NULL;
		PUBLIC STATIC $IS_SERVICES =					NULL;
		PUBLIC STATIC $IS_REFLECTED =					NULL;			
		
		PRIVATE STATIC $CONTROLLERS =					[[CONF::SLUG_HOME, EXTENDED::HOME[0], EXTENDED::HOME[1], EXTENDED::HOME[2], EXTENDED::HOME[3]], 
														[CONF::SLUG_CATEGORY, EXTENDED::CATEGORY[0], EXTENDED::CATEGORY[1], EXTENDED::CATEGORY[2], EXTENDED::CATEGORY[3]], 
														[CONF::SLUG_PRODUCT, EXTENDED::PRODUCT[0], EXTENDED::PRODUCT[1], EXTENDED::PRODUCT[2], EXTENDED::PRODUCT[3]], 
														[CONF::SLUG_EXPLORE, EXTENDED::EXPLORE[0], EXTENDED::EXPLORE[1], EXTENDED::EXPLORE[2], EXTENDED::EXPLORE[3]],
														[CONF::SLUG_SERVICES,  EXTENDED::SERVICES[0], EXTENDED::SERVICES[1], EXTENDED::SERVICES[2], EXTENDED::SERVICES[3]],															
														[CONF::SLUG_PAGE, EXTENDED::PAGE[0],EXTENDED::PAGE[1],EXTENDED::PAGE[2],EXTENDED::PAGE[3]],
														[CONF::SLUG_NEWS, EXTENDED::NEWS[0], EXTENDED::NEWS[1], EXTENDED::NEWS[2], EXTENDED::NEWS[3]],
														[CONF::SLUG_E404, EXTENDED::E404[0], EXTENDED::E404[1], EXTENDED::E404[2], EXTENDED::E404[3]]];
		

		PUBLIC STATIC FUNCTION is_home()				{ RETURN SELF::$IS_HOME; }
		PUBLIC STATIC FUNCTION is_category()			{ RETURN SELF::$IS_CATEGORY; }	
		PUBLIC STATIC FUNCTION is_product()				{ RETURN SELF::$IS_PRODUCT; }
		PUBLIC STATIC FUNCTION is_page()				{ RETURN SELF::$IS_PAGE;}						
		PUBLIC STATIC FUNCTION is_404()					{ RETURN SELF::$IS_E404;}		
		PUBLIC STATIC FUNCTION is_single()				{ RETURN SELF::$IS_SINGLE; }		
		PUBLIC STATIC FUNCTION is_explore()				{ RETURN SELF::$IS_EXPLORE; }
		PUBLIC STATIC FUNCTION is_services()			{ RETURN SELF::$IS_SERVICES;}	
		PUBLIC STATIC FUNCTION is_reflected()			{ RETURN SELF::$IS_REFLECTED;}	
		
		PUBLIC STATIC FUNCTION get_id($name = NULL)		{ RETURN ARRAY_SEARCH(UTILITY::set_value($name, SELF::get_name()), ARRAY_COLUMN(SELF::$CONTROLLERS, 0)); }		
		PUBLIC STATIC FUNCTION get_name($id = NULL)		{ RETURN SELF::get_value($id, 0); }
		PUBLIC STATIC FUNCTION get_icon($id = NULL)		{ RETURN SELF::get_value($id, 1); }
		PUBLIC STATIC FUNCTION get_title($id = NULL)	{ RETURN SELF::get_value($id, 2); }
		PUBLIC STATIC FUNCTION get_subtitle($id = NULL)	{ RETURN SELF::get_value($id, 3); }
		PUBLIC STATIC FUNCTION get_keywords($id = NULL)	{ RETURN SELF::get_value($id, 4); }
		
		PUBLIC FUNCTION __construct()					{ SELF::set_controller(); }

		PRIVATE STATIC FUNCTION get_value($id, $col)	{ RETURN SELF::$CONTROLLERS[UTILITY::set_value($id, SELF::set_id())][$col]; }			
		
		PRIVATE STATIC FUNCTION set_controller(){ 
			$id = SELF::get_id();
			IF($id == 0){ SELF::$IS_HOME = TRUE; }
			ELSE IF($id == 1){ SELF::$IS_CATEGORY = TRUE; }
			ELSE IF($id == 2){ SELF::$IS_PRODUCT = TRUE;}
			ELSE IF($id == 3){ SELF::$IS_EXPLORE = TRUE;  }
			ELSE IF($id == 4){ SELF::$IS_SERVICES = TRUE; }
			ELSE IF($id == 5){ SELF::$IS_PAGE = TRUE; }
			ELSE IF($id == 6){ SELF::$IS_SINGLE = TRUE; }
			ELSE IF($id == 7){ SELF::$IS_E404 = TRUE; }
			SELF::$IS_REFLECTED = REFLECT::is_reflected();
		}	
		
		PRIVATE STATIC FUNCTION set_id(){
			IF(is_front_page() || is_home()){ $id = 0; }
			ELSE IF(is_page()){
				IF(is_page(CATEGORY::get_categories())){ $id = 1;  }					 
				ELSE IF(is_int(CATEGORY::get_id())){ $id = 2;  }//findid
				ELSE IF(is_page(EXTENDED::EXPLORE[1])){ $id = 3;}
				ELSE IF(is_page(EXTENDED::SERVICES[1])){ $id = 4;  } 
				ELSE{ $id = 5; } }
			ELSE IF(is_single()){ $id = 6; } /*&& is_int(CATEGORY::get_id())*/ 
			ELSE{ $id = 7; }
			RETURN $id;
		}
	}
?>