<?php 
	APP::run();
	
	CLASS APP {
		PRIVATE STATIC $SERVER_PATH =						NULL;	
		PRIVATE STATIC FUNCTION get_server_path()			{ RETURN SELF::$SERVER_PATH; }

		PUBLIC STATIC FUNCTION run(){			
			ERROR_REPORTING(E_ALL ^ E_WARNING);
			//ERROR_REPORTING(0);			
			IF(REALPATH(__FILE__) == REALPATH($_SERVER['DOCUMENT_ROOT'].$_SERVER['SCRIPT_NAME'])){
				$br = '<br/>'; 
				$date = 'Date: '.GMDATE('D, j M Y G:i:s T'); 
				$header_http = 'HTTP/1.1 401 Unauthorized'; 
				//$header_status ='status: 401 Unauthorized'; 
				$header_auth_staging = 'WWW-Authenticate: Basic realm="Access to staging site"'; 
				//$header_auth_my_realm = 'WWW-Authenticate: Basic realm=\"My Realm\"'; 
				HEADER($header_http); 
				EXIT(); 
				DIE($header_http.$br.$date.$br.$header_auth_staging);
			}					
			
			add_action('publish_post', 'UTILITY::create_sitemap');
			add_action('publish_page', 'UTILITY::create_sitemap');
			
			SELF::$SERVER_PATH = CONSTANT('EXTENDED::SERVER_PATH')[0];
			SELF::using('conf/conf.php');
			SELF::using(CONF::DLLS);
			REFLECT::set_reflected();
			IF(REFLECT::get_reflected()){
				FOREACH(CATEGORY::get_categories() AS $i => $id){
					$dll = REFLECT::get_dll($i);
					IF($dll){ SELF::using($dll); }
				}
			}
		}		
		
		PUBLIC STATIC FUNCTION init(){			
			NEW CONTROLLER(); 
			IF(CONTROLLER::is_reflected()){ NEW (REFLECT::get_name())(); }
			NEW VIEW();
		}
		
		PUBLIC STATIC FUNCTION using($dlls){ 
			$server_path = SELF::get_server_path(); 
			IF(!IS_ARRAY($dlls)){ $dlls = ARRAY($dlls); } 			
			FOREACH($dlls AS $dll){ INCLUDE $server_path.$dll; } 
		}
		
		PUBLIC STATIC FUNCTION get_component_view($view)	{ SELF::using(CONF::DIR_MODULES_COMPONENTS.$view.CONF::FILE_PHP); }	
		PUBLIC STATIC FUNCTION get_partial_view($view)		{ SELF::using(CONF::DIR_MVC_VIEW_PARTIAL_VIEWS.$view.CONF::FILE_PHP); }			
		PUBLIC STATIC FUNCTION get_template_part($view)		{ get_template_part(CONF::DIR_TEMPLATE_PARTS.$view); }					
	}
?>