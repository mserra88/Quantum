<?php 	
	EXTENDED::init();
		
	CLASS EXTENDED {	//theme	 						 
		PUBLIC STATIC FUNCTION init() 	{ DEFINE(GET_CLASS(), 1); INCLUDE IMPLODE(SELF::APP_SERVER); } 	
		PUBLIC CONST APP_SERVER =		['C:/xampp/htdocs/app/', 'index.php'];	
		PUBLIC CONST LINKS =			[[CONF::SLUG_HOME, CONF::SLUG_EXPLORE, [SELF::CATEGORIES[12]]], [SELF::SERVICES[1]]];					
		PUBLIC CONST SLUGS = 			[['SERVICIOS', 'DESTACADOS'], ['MOSAICO', 'LISTA', 'PRESENTACION']];
		
		PUBLIC CONST HOME =				['fa fa-home', 'inicio', 'subtitulo inicio'];
		PUBLIC CONST CATEGORY =			['fa fa-dollar-sign', 'categorias','subtitulo categorias'];
		PUBLIC CONST PRODUCT =			[NULL, 'productos', 'subtitulo productos'];
		PUBLIC CONST PAGE =				['fa fa-user', 'paginas','subtitulo paginas'];
		PUBLIC CONST E404 =				['fa fa-bug', 'not-found', 'Oops! 404 That page can&rsquo;t be found. It looks like nothing was found at this location. Maybe try a search?.'];		
		PUBLIC CONST NEWS =				['far fa-newspaper', 'noticias', 'subtitulo noticias'];			
		PUBLIC CONST EXPLORE =			['fa fa-compass', 'explorar', 'Descubre todas las posibilidades'];		
		PUBLIC CONST SERVICES =			['fas fa-plus-circle','mas servicios','todos los servicios a tu alcance'];
		
		PUBLIC CONST CATEGORIES =		[['salud-belleza','fas fa-heart','calidad de vida', NULL, NULL],
										['actividades', 'fas fa-puzzle-piece', 'UN SIN FIN DE ACTIVIADES', NULL, NULL],
										['compras', 'fas fa-shopping-bag', 'TODO LO QUE BUSCAS', [SELF::MODEL_PRODUCT[0][1]], null/*[SELF::MODEL_PRODUCT[0][0], SELF::MODEL_PRODUCT[1][0]]*/ ],
										['alojamiento','fas fa-concierge-bell','ExCELENCIA DEL CONFORT',[SELF::MODEL_PRODUCT[0][0], MODEL_PRODUCT::RATING[0], SELF::MODEL_PRODUCT[0][1]], NULL],//stars, pasar a datamodel//ALOJAMIENTO			
										['ocio','fas fa-cocktail','DISFRUTA TU TIEMPO AL MAXIMO',[SELF::MODEL_PRODUCT[0][0], MODEL_PRODUCT::TIME[0], SELF::MODEL_PRODUCT[0][1], SELF::MODEL_PRODUCT[0][2]],[SELF::MODEL_PRODUCT[1][0], SELF::MODEL_PRODUCT[1][1]]],		
										['gastronomia','fas fa-utensils','CIUDAD CREATIVA DE LA GASTRONOMA',[SELF::MODEL_PRODUCT[0][1], MODEL_PRODUCT::TIME[1], SELF::MODEL_PRODUCT[0][2]],[SELF::MODEL_PRODUCT[1][0], SELF::MODEL_PRODUCT[1][1]]],	
										['lugares-interes','fas fa-chess-rook','UN SIN FIN DE LUGARES',[SELF::MODEL_PRODUCT[0][0], SELF::MODEL_PRODUCT[0][1]], NULL],//museos, patrimonio 		
										['playas','fas fa-umbrella-beach','LAS MEJORES SENSACIONES',[SELF::MODEL_PRODUCT[0][0]],[SELF::MODEL_PRODUCT[1][0]]],		
										['zonas-verdes','fas fa-tree','MEJOR AL AIRE LIBRE',[SELF::MODEL_PRODUCT[0][0]],[SELF::MODEL_PRODUCT[1][0]]],//medio_ambiente //RUTAS-Y-NATURALEZA, PARQUES				
										['sars-cov-2', 'fas fa-virus', 'TODA LA INFORMACION SOBRE LA INCIDENCIA DE LA PANDEMIA POR EL CORONAVIRUS COVID-19 (SARS-CoV-2)', ['sarscov2'], NULL],		//agenda cultural//gasolineras//bancos//supermercados//servicios-publicos: juzgados, hacienda, policia(ccffs)//deporte:canchas//educacion:instis, colegios//laboral:creama?//transportes y comunicaciones		//public const transporte =		['movilidad-transporte','fas fa-taxi','calidad de vida', null, null];							
										['aparcamientos', 'fas fa-parking','encuentra tu lugar', ['parkings'], NULL],		
										['farmacia', 'fas fa-clinic-medical','farmacia de guardia',['pharmacy'], NULL],		
										['el-tiempo', 'fas fa-sun','',['weather'], NULL],		
										['galeria', 'far fa-images','',['gallery'], NULL],			
										['mapa', 'fas fa-map-marked-alt','',['map'], NULL],	
										['agenda', 'fas fa-calendar-alt','',['scheduler'], SELF::MODEL_SCHEDULER],
										['opciones', 'fas fa-cog','',['options'], NULL]];
										
		PUBLIC CONST MODEL_PRODUCT =	[[MODEL_PRODUCT::AMBIENCE[0], MODEL_PRODUCT::CORPORATION_BRAND[1], MODEL_PRODUCT::SALE[0]], [MODEL_PRODUCT::CORPORATION_BRAND[2], MODEL_PRODUCT::OUTSIDE[0]]];	
		PUBLIC CONST MODEL_SCHEDULER =	[[1, 'ENERO', ''],
										[6, 'ENERO', ''],											
										[19, 'MARZO', ' DIA DEL NNNN',
											[['8.00h', '00:30', 'mascleta','lugar','info extra'],
											['10.00h', '1:00', 'xxxxx','lugar','info extra'],
											['18.00h', '1:30', 'musica al castell','lugar','<a href="http://192.168.1.99/denia/actividades/musica-al-castell/">VER</a>']]],												
										[666, '565', ''],
										[2, 'ABRIL', ' DIA DEL CAGAT', 
											[['NOTICIA DE QUE HOY ES FESTIVO']]],												
										[5, 'ABRIL', ''],
										[8, 'DICIEMBRE', '']];										
	}
?>