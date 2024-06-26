<?php	
	class CONF {	
		
		PUBLIC CONST DLLS = 						[SELF::DLL_UTILITY,SELF::DLL_MODEL_PRODUCT,SELF::DLL_MODEL_COMPONENT,SELF::DLL_VIEW,SELF::DLL_VIEW_COMPONENTS_VIEW_COMMENTS,SELF::DLL_CONTROLLER,SELF::DLL_CATEGORY,SELF::DLL_REFLECT,SELF::DLL_COMPONENT];				
		
		PUBLIC CONST LINKS = 						EXTENDED::LINKS;		
		PUBLIC CONST SLUGS = 						EXTENDED::SLUGS;
		
		PUBLIC CONST SLUGS_MASTER = 				SELF::SLUGS[0];	
		
		PUBLIC CONST PRODUCTS_TITLE = CONF::SLUGS_MASTER[0];
		PUBLIC CONST FEATURED_TITLE = CONF::SLUGS_MASTER[1];
		
		
		PUBLIC CONST SLUGS_SLAVE = 					SELF::SLUGS[1];	
		
		PUBLIC CONST MINUS =						'-';				
		PUBLIC CONST UNDERSCORE =					'_';		
		PUBLIC CONST DIR =							'/';
		
		PUBLIC CONST FILE_PHP =						'.php';	
		PUBLIC CONST FILE_ICO =						'.ico';		
		PUBLIC CONST FILE_PNG =						'.png';		
		PUBLIC CONST FILE_CSS =						'.css';		
		PUBLIC CONST FILE_JS =						'.js';	

		PUBLIC CONST SLUG_MASTER =					'master';	

		PUBLIC CONST SLUG_CATEGORY =				'category';	
		PUBLIC CONST SLUG_COMPONENT =				'component';
		PUBLIC CONST SLUG_COMPONENTS =				'components';
		PUBLIC CONST SLUG_CONTROLLER =				'controller';	
		PUBLIC CONST SLUG_PARTIAL_VIEWS =			'partial'.SELF::UNDERSCORE.'views';		
		PUBLIC CONST SLUG_E404 =					'e404';
		PUBLIC CONST SLUG_EXPLORE = 				'explore';		
		PUBLIC CONST SLUG_GALLERY = 				'gallery';		
		PUBLIC CONST SLUG_HOME =					'home';
		PUBLIC CONST SLUG_MAP = 					'map';		
		PUBLIC CONST SLUG_MODEL =					'model';
		PUBLIC CONST SLUG_NEWS =					'news';
		PUBLIC CONST SLUG_PAGE =					'page';
		PUBLIC CONST SLUG_PRODUCT =					'product';
		PUBLIC CONST SLUG_SINGLE =					'single';
		PUBLIC CONST SLUG_REFLECT =					'reflect';
		PUBLIC CONST SLUG_SERVICES = 				'services';
		PUBLIC CONST SLUG_VIEW =					'view';
		PUBLIC CONST SLUG_HEADER =					'header';		
		PUBLIC CONST SLUG_FOOTER =					'footer';
		PUBLIC CONST SLUG_SCRIPT =					'script';
		PUBLIC CONST SLUG_CSS =						'css';
		PUBLIC CONST SLUG_JAVASCRIPT =				'javascript';
		PUBLIC CONST SLUG_STYLE =					'style';
		PUBLIC CONST SLUG_BOOTSTRAP =				'bootstrap';
		PUBLIC CONST SLUG_FONTAWESOME =				'fontawesome';
		
		PUBLIC CONST SLUG_ASSETS = 					'assets';
		PUBLIC CONST SLUG_SHORTCUT = 				'shortcut';
		PUBLIC CONST SLUG_TOUCH = 					'touch';
		PUBLIC CONST SLUG_LOGO = 					'logo';		
		PUBLIC CONST SLUG_IMG = 					'img';
		PUBLIC CONST SLUG_ICONS = 					'icons';
		PUBLIC CONST SLUG_UTILITY = 				'utility';
		PUBLIC CONST SLUG_MVC = 					'mvc';
		PUBLIC CONST SLUG_API = 					'api';
		PUBLIC CONST SLUG_REFERENCES = 				'references';
		PUBLIC CONST SLUG_MODULES = 				'modules';
		PUBLIC CONST SLUG_TEMPLATE_PARTS = 			'template'.SELF::MINUS.'parts';
		
		PUBLIC CONST COPYRIGHT = 					'© Todos los derechos reservados';
		PUBLIC CONST RELEASE = 						'1.0';
		PUBLIC CONST POWEREDBY = 					'Powered byMaik::labs()';//byMDMaïk
		
		PUBLIC CONST DIR_TEMPLATE_PARTS =			SELF::SLUG_TEMPLATE_PARTS.SELF::DIR;						
		PUBLIC CONST DIR_MODULES =					SELF::SLUG_MODULES.SELF::DIR;
		PUBLIC CONST DIR_MODULES_SERVICES =			SELF::DIR_MODULES.SELF::SLUG_SERVICES.SELF::DIR;				
		PUBLIC CONST DIR_MODULES_REFERENCES =		SELF::DIR_MODULES.SELF::SLUG_REFERENCES.SELF::DIR;
		PUBLIC CONST DIR_MODULES_API =				SELF::DIR_MODULES.SELF::SLUG_API.SELF::DIR;
		PUBLIC CONST DIR_MODULES_COMPONENTS = 		SELF::DIR_MODULES.SELF::SLUG_COMPONENTS.SELF::DIR;			
		PUBLIC CONST DIR_MVC =						SELF::SLUG_MVC.SELF::DIR;
		PUBLIC CONST DIR_MVC_MODEL =				SELF::DIR_MVC.SELF::SLUG_MODEL.SELF::DIR;		
		PUBLIC CONST DIR_MVC_VIEW =					SELF::DIR_MVC.SELF::SLUG_VIEW.SELF::DIR;	
		PUBLIC CONST DIR_MVC_CONTROLLER =			SELF::DIR_MVC.SELF::SLUG_CONTROLLER.SELF::DIR;
		PUBLIC CONST DIR_MVC_VIEW_PARTIAL_VIEWS =	SELF::DIR_MVC_VIEW.SELF::SLUG_PARTIAL_VIEWS.SELF::DIR;
		PUBLIC CONST DIR_MVC_VIEW_COMPONENTS =		SELF::DIR_MVC_VIEW.SELF::SLUG_COMPONENTS.SELF::DIR;
		
		PUBLIC CONST DLL_MODEL_PRODUCT =			SELF::DIR_MVC_MODEL.SELF::SLUG_MODEL.SELF::UNDERSCORE.SELF::SLUG_PRODUCT.SELF::FILE_PHP;
		PUBLIC CONST DLL_MODEL_COMPONENT =			SELF::DIR_MVC_MODEL.SELF::SLUG_MODEL.SELF::UNDERSCORE.SELF::SLUG_COMPONENT.SELF::FILE_PHP;		
		PUBLIC CONST DLL_VIEW =						SELF::DIR_MVC_VIEW.SELF::SLUG_VIEW.SELF::FILE_PHP;
		
		PUBLIC CONST DLL_VIEW_COMPONENTS_VIEW_COMMENTS = SELF::DIR_MVC_VIEW_COMPONENTS.SELF::SLUG_VIEW.SELF::UNDERSCORE.'comments'.SELF::FILE_PHP;
		
		
		PUBLIC CONST DLL_CONTROLLER =				SELF::DIR_MVC_CONTROLLER.SELF::SLUG_CONTROLLER.SELF::FILE_PHP;		
		PUBLIC CONST DLL_CATEGORY =					SELF::DIR_MVC_CONTROLLER.SELF::SLUG_CATEGORY.SELF::FILE_PHP;		
		PUBLIC CONST DLL_COMPONENT =				SELF::DIR_MVC_CONTROLLER.SELF::SLUG_COMPONENT.SELF::FILE_PHP;
		PUBLIC CONST DLL_REFLECT =					SELF::DIR_MVC_CONTROLLER.SELF::SLUG_REFLECT.SELF::FILE_PHP;				
		PUBLIC CONST DLL_UTILITY = 					SELF::DIR_MODULES_REFERENCES.SELF::SLUG_UTILITY.SELF::FILE_PHP;
		PUBLIC CONST DLL_WEATHER = 					SELF::DIR_MODULES_SERVICES.'weather'.SELF::FILE_PHP;
		PUBLIC CONST DLL_MAP = 						SELF::DIR_MODULES_SERVICES.'map'.SELF::FILE_PHP;
		PUBLIC CONST DLL_SCHEDULER = 				SELF::DIR_MODULES_SERVICES.'scheduler'.SELF::FILE_PHP;
		PUBLIC CONST DLL_PARKINGS = 				SELF::DIR_MODULES_SERVICES.'parkings'.SELF::FILE_PHP;
		PUBLIC CONST DLL_GALLERY = 					SELF::DIR_MODULES_SERVICES.'gallery'.SELF::FILE_PHP;		
		PUBLIC CONST DLL_PHARMACY = 				SELF::DIR_MODULES_SERVICES.'pharmacy'.SELF::FILE_PHP;		
		//PUBLIC CONST DLL_SERVICES = 				SELF::DIR_MODULES_SERVICES.SELF:SLUG_SERVICES.SELF::FILE_PHP;
		PUBLIC CONST DLL_SARSCOV2 = 				SELF::DIR_MODULES_SERVICES.'sarscov2'.SELF::FILE_PHP;
		PUBLIC CONST DLL_OPTIONS = 					SELF::DIR_MODULES_SERVICES.'options'.SELF::FILE_PHP;
		PUBLIC CONST DLL_OPENWEATHERMAP_API =		SELF::DIR_MODULES_API.'openweathermap'.SELF::FILE_PHP;

		PUBLIC CONST DIR_IMG = 						SELF::DIR.SELF::SLUG_IMG.SELF::DIR;	
		PUBLIC CONST DIR_ICON = 					SELF::DIR_IMG.SELF::SLUG_ICONS.SELF::DIR;				
		PUBLIC CONST DIR_IMG_PRODUCT = 				SELF::DIR_IMG.SELF::SLUG_PRODUCT.SELF::DIR;
		PUBLIC CONST DIR_IMG_SINGLE = 				SELF::DIR_IMG.SELF::SLUG_SINGLE.SELF::DIR;
		PUBLIC CONST DIR_IMG_CATEGORY = 			SELF::DIR_IMG.SELF::SLUG_CATEGORY.SELF::DIR;		

		PUBLIC CONST ICON_SHORTCUT_THEME = 			SELF::DIR_ICON.SELF::SLUG_SHORTCUT.SELF::FILE_ICO;
		PUBLIC CONST ICON_TOUCH_APPLE_THEME = 		SELF::DIR_ICON.SELF::SLUG_TOUCH.SELF::FILE_PNG;	
		//PUBLIC CONST LOGO_THEME = 					SELF::DIR_IMG.SELF::SLUG_LOGO.SELF::FILE_PNG;
		PUBLIC CONST LOGO_THEME = 					'/'.SELF::SLUG_LOGO.SELF::FILE_PNG;

		PUBLIC CONST DIR_CSS = 						SELF::DIR.SELF::SLUG_CSS.SELF::DIR;
		PUBLIC CONST DIR_JAVASCRIPT = 				SELF::DIR.SELF::SLUG_JAVASCRIPT.SELF::DIR;
		
		PUBLIC CONST STYLESHEET_THEME = 			SELF::DIR_CSS.SELF::SLUG_STYLE.SELF::FILE_CSS;
		PUBLIC CONST SCRIPT_THEME = 				SELF::DIR_JAVASCRIPT.SELF::SLUG_SCRIPT.SELF::FILE_JS;
			
		PUBLIC CONST DIR_ASSETS = 					EXTENDED::SERVER_SUBDOMAIN.SELF::SLUG_ASSETS.SELF::DIR;
		PUBLIC CONST DIR_ASSETS_CSS = 				SELF::DIR_ASSETS.SELF::SLUG_CSS.SELF::DIR;	
		
		PUBLIC CONST DIR_ASSETS_FONTAWESOME = 		SELF::DIR_ASSETS.SELF::SLUG_FONTAWESOME;			
		PUBLIC CONST DIR_ASSETS_FONTAWESOME_CSS = 	SELF::DIR_ASSETS_FONTAWESOME.SELF::DIR.SELF::SLUG_CSS.SELF::DIR;			
		
		PUBLIC CONST DIR_ASSETS_BOOTSTRAP = 		SELF::DIR_ASSETS.SELF::SLUG_BOOTSTRAP;			
		PUBLIC CONST DIR_ASSETS_BOOTSTRAP_CSS = 	SELF::DIR_ASSETS_BOOTSTRAP.SELF::DIR.SELF::SLUG_CSS.SELF::DIR;			
		PUBLIC CONST DIR_ASSETS_BOOTSTRAP_JAVASCRIPT = 	SELF::DIR_ASSETS_BOOTSTRAP.SELF::DIR.SELF::SLUG_JAVASCRIPT.SELF::DIR;			
				
		
		PUBLIC CONST DIR_ASSETS_JAVASCRIPT = 		SELF::DIR_ASSETS.SELF::SLUG_JAVASCRIPT.SELF::DIR;				
		
		PUBLIC CONST STYLESHEET = 					SELF::DIR_ASSETS_CSS.SELF::SLUG_STYLE.SELF::FILE_CSS;
		PUBLIC CONST STYLESHEET_BOOTSTRAP = 		SELF::DIR_ASSETS_BOOTSTRAP_CSS.SELF::SLUG_BOOTSTRAP.SELF::FILE_CSS;
		
		PUBLIC CONST STYLESHEET_FONTAWESOME = 		SELF::DIR_ASSETS_FONTAWESOME_CSS.'all.min'.SELF::FILE_CSS;		
		//PUBLIC CONST STYLESHEET_FONTAWESOME = 		'https://kit-pro.fontawesome.com/releases/v5.15.3/css/pro.min.css';		
		//PUBLIC CONST STYLESHEET_FONTAWESOME = 	SELF::DIR_ASSETS_CSS.'fontawesome'.SELF::FILE_CSS;				
		//PUBLIC CONST STYLESHEET_FONTAWESOME = 	'https://pro.fontawesome.com/releases/v6.0.0-beta1/css/all.css';	
		PUBLIC CONST SCRIPT = 						SELF::DIR_ASSETS_JAVASCRIPT.SELF::SLUG_SCRIPT.SELF::FILE_JS;
		PUBLIC CONST SCRIPT_BOOTSTRAP = 			SELF::DIR_ASSETS_BOOTSTRAP_JAVASCRIPT.SELF::SLUG_BOOTSTRAP.SELF::FILE_JS;	
		//PUBLIC CONST SCRIPT_BOOTSTRAP = 			'https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js';
	}
?>