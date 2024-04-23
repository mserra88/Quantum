<?php
	EXTENDED::init();

	CLASS EXTENDED {	 
		PUBLIC STATIC FUNCTION init()   { INCLUDE IMPLODE(SELF::SERVER_PATH); } 
		PUBLIC CONST SERVER_SUBDOMAIN = 'http://192.168.1.99/app/';	
		PUBLIC CONST SERVER_PATH =		['C:/xampp/htdocs/app/', 'index.php'];		
		
		//PUBLIC CONST SERVER_SUBDOMAIN = 'https://app.ganarmidinero.com/';
		//PUBLIC CONST SERVER_PATH =	['/homepages/38/d881419990/htdocs/app/', 'index.php'];	

		PUBLIC CONST LINKS =			[[CONF::SLUG_HOME, CONF::SLUG_EXPLORE]/*, [SELF::SERVICES[1]]*/, [self::CONTACT, self::privacity]];
		PUBLIC CONST SLUGS = 			[['SERVICIOS', 'DESTACADOS'], ['MOSAICO', 'LISTA', 'PRESENTACION']];
		
		PUBLIC CONST HOME =				['fa fa-home', 'inicio', 'ingresos online', self::KEYWORDS];
		PUBLIC CONST CATEGORY =			[NULL, 'categorias','categorias', self::KEYWORDS];
		PUBLIC CONST PRODUCT =			[NULL, 'productos', 'productos', self::KEYWORDS];
		PUBLIC CONST PAGE =				[NULL, 'paginas','paginas', self::KEYWORDS];
		PUBLIC CONST E404 =				['fa fa-bug', 'error 404', 'Oops! 404 La página no puede ser encontrada. Parece que no se encontró nada en esta ubicación', self::KEYWORDS];		

		PUBLIC CONST NEWS =				['far fa-newspaper', 'noticias', 'noticias', self::KEYWORDS];			
		PUBLIC CONST EXPLORE =			['fa fa-compass', 'explorar', 'Descubre todas las posibilidades', self::KEYWORDS];		
		PUBLIC CONST SERVICES =			['fas fa-plus-circle','mas servicios','todos los servicios a tu alcance', self::KEYWORDS];

		public const CATEGORIES = 		[['anuncios', 'fab fa-buysellads', 'Gana dinero viendo anuncios', SELF::MODEL_PRODUCT, SELF::MODEL_PRODUCT_INFO, SELF::MODEL_PRODUCT_LINKS, SELF::KEYWORDS_ANUNCIOS],
										['apostar', 'fas fa-dice', 'Apuesta y gana dinero', SELF::MODEL_PRODUCT, SELF::MODEL_PRODUCT_INFO, SELF::MODEL_PRODUCT_LINKS, null],
										['captchas', 'fas fa-qrcode', 'Gana dinero completando captchas', SELF::MODEL_PRODUCT, SELF::MODEL_PRODUCT_INFO, SELF::MODEL_PRODUCT_LINKS, null],
										['cashback', 'fas fa-wallet', 'Recupera dinero con tus compras',  SELF::MODEL_PRODUCT, SELF::MODEL_PRODUCT_INFO, SELF::MODEL_PRODUCT_LINKS, null],
										['criptomonedas', 'fab fa-btc' /*fa-btc*/, 'Gana dinero con las criptomonedas', SELF::MODEL_PRODUCT, SELF::MODEL_PRODUCT_INFO, SELF::MODEL_PRODUCT_LINKS, null],
										['encuestas', 	 'fas fa-file-signature', 'Gana dinero completando encuestas',  SELF::MODEL_PRODUCT, SELF::MODEL_PRODUCT_INFO, SELF::MODEL_PRODUCT_LINKS, null],
										['escribiendo', 	'fas fa-pencil-alt', 'Gana dinero escribiendo',  SELF::MODEL_PRODUCT, SELF::MODEL_PRODUCT_INFO, SELF::MODEL_PRODUCT_LINKS, null],
										['fotografias', 'fas fa-camera-retro', 'Gana dinero vendiendo tus fotografías', SELF::MODEL_PRODUCT, SELF::MODEL_PRODUCT_INFO, SELF::MODEL_PRODUCT_LINKS, null],
										['inversion', 'fas fa-piggy-bank', 'Invierte y gana dinero',  SELF::MODEL_PRODUCT, SELF::MODEL_PRODUCT_INFO, SELF::MODEL_PRODUCT_LINKS, null],
										['jugar', 'fas fa-gamepad', 'Gana dinero divirtíendote mientras juegas',  SELF::MODEL_PRODUCT, SELF::MODEL_PRODUCT_INFO, SELF::MODEL_PRODUCT_LINKS, null],
										['leer-emails', 'fa fa-envelope', 'Gana dinero por leer e-mails', SELF::MODEL_PRODUCT, SELF::MODEL_PRODUCT_INFO, SELF::MODEL_PRODUCT_LINKS, null],
										['redes-sociales', 'fa fa-bullhorn', 'Gana dinero con las redes sociale.', SELF::MODEL_PRODUCT, SELF::MODEL_PRODUCT_INFO, SELF::MODEL_PRODUCT_LINKS, null],
										['promociones', 'fa fa-gift', 'Gana dinero con las mejores promociones', SELF::MODEL_PRODUCT, SELF::MODEL_PRODUCT_INFO, SELF::MODEL_PRODUCT_LINKS, null],
										['tareas', 'fas fa-hammer', 'Completa tareas y gana dinero', SELF::MODEL_PRODUCT, SELF::MODEL_PRODUCT_INFO, SELF::MODEL_PRODUCT_LINKS, null],								
										['herramientas', 'fas fa-tools', 'Herramientas para gestionar dinero online', SELF::MODEL_PRODUCT, SELF::MODEL_PRODUCT_INFO, SELF::MODEL_PRODUCT_LINKS, null],
										/*['paypal', 'fas fa-map-marked-alt','',['options'], NULL],
										['bizum', 'fas fa-map-marked-alt','',['options'], NULL],*/
										/*['opciones', 'fas fa-cog','',['options'], NULL],*/
										/*['opciones2', 'fa fa-gift','',['weather'], NULL]*/
										];

		PUBLIC CONST MODEL_PRODUCT =		[MODEL_PRODUCT::CORPORATION_BRAND[0], MODEL_PRODUCT::CORPORATION[1], MODEL_PRODUCT::CORPORATION[2],MODEL_PRODUCT::CORPORATION[5], MODEL_PRODUCT::CORPORATION[0],MODEL_PRODUCT::CORPORATION[3], MODEL_PRODUCT::CORPORATION[4]];
		PUBLIC CONST MODEL_PRODUCT_INFO =	[MODEL_PRODUCT::TIME[0], MODEL_PRODUCT::SALE[2], MODEL_PRODUCT::INFO[0]];		
		PUBLIC CONST MODEL_PRODUCT_LINKS =	[MODEL_PRODUCT::COMPATIBILITY[0],MODEL_PRODUCT::COMPATIBILITY[1], MODEL_PRODUCT::MONEY[0]];			
						
		PUBLIC CONST KEYWORDS = 'ganar, dinero, internet, negocios, online, casa, emprendedores, rapido, extra, facil, sencillo, verdad, urgente, gratis, legal, seguro, fiable, instantaneo, ingresos, beneficios, marketing, digital';
		PUBLIC CONST KEYWORDS_ANUNCIOS = 'viendo, publicidad, ptc, paid, click';	
				
		PUBLIC CONST privacity = 'privacidad';	
		PUBLIC CONST privacity_subtitle = 'informacion sobre la politica de privacidad';	
		PUBLIC CONST CONTACT = 'contacto';	
		PUBLIC CONST CONTACT_SUBTITLE = 'Ponte en contacto con nosotros';
		public const contact_detail = ['contact', 'instagram'];
		PUBLIC CONST CONTACT_DETAILS = 'contacto@ganarmidinero.com';	
		PUBLIC CONST CONTACT_DETAILS2 = 'instagram.com/ganarmidinero/';
		PUBLIC CONST CLARITY = '';/*8aka3b33vq*/
	}
?>