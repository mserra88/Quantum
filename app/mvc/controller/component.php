<?php
	CLASS COMPONENT {
		PUBLIC CONST HEADER_CATEGORY =			'header-category';						
		PUBLIC CONST ADS =						'ads';				
		PUBLIC CONST MASTER =					'master';				
		PUBLIC CONST slave =					'slave';	
		PUBLIC CONST FOOTER =					CONF::SLUG_FOOTER;			
		PUBLIC CONST QUANTUM =					'quantum';
		PUBLIC CONST HEADER =					CONF::SLUG_HEADER;		
		PUBLIC CONST ICON =						'icon';
		PUBLIC CONST SEARCH =					'search';
		PUBLIC CONST MODAL =					'modal';		
		PUBLIC CONST MENU =						'menu';
		PUBLIC CONST PROPERTIES =				'properties';		
		PUBLIC CONST COMMENTS =					'comments';
		PUBLIC CONST COOKIES =					'cookies';				
		PUBLIC CONST SHARE =					'share';
		PUBLIC CONST SIDEBAR =					'sidebar';
		PUBLIC CONST TITLE =					'title';
		PUBLIC CONST CONTENT =					'content';
		PUBLIC CONST ACCORDION_CONTENT =		'accordion_content';

		PRIVATE STATIC $MODEL =					NULL;			
		PRIVATE STATIC $COUNTER =				NULL;

		PUBLIC STATIC FUNCTION get_model()		{ RETURN SELF::$MODEL; }
		PUBLIC STATIC FUNCTION get_counter()	{ RETURN SELF::$COUNTER; }
		
		PUBLIC STATIC FUNCTION init($name, $model = NULL){
			SELF::$COUNTER = SELF::$COUNTER+1;
			SELF::$MODEL = ARRAY($name , $model);
			APP::get_component_view($name);//$name = $model[0]; //$model[0] = $model[0].'-'.CONF::SLUG_COMPONENT.' ';
		}
	}
?>