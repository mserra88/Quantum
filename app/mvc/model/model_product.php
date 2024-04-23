<?php
	CLASS MODEL_PRODUCT {				
		PUBLIC CONST AMBIENCE = 					['ambience'];
		PUBLIC CONST CORPORATION = 					[SELF::TIME[1], 'central', 'company', 'income', SELF::WEBSITE[1], 'language'];
		PUBLIC CONST CORPORATION_BRAND = 			['location', SELF::TIME[2], SELF::DIMENSION[0]]; //telefono//isopen //cierra a las 14:00//recogida en tienda//como llegar//google thumbnail//detalle//horas punta
		PUBLIC CONST OUTSIDE =						['outside-'.SELF::DIMENSION[0]];
		PUBLIC CONST SALE = 						['price', 'premium', 'bonus'];/*BONUS //25 E AL REGISTRARTE //  10€ GRATIS*/
		PUBLIC CONST DIMENSION = 					['meters'];
		PUBLIC CONST COMPATIBILITY =				['compatibility', 'compatibility'.'-'.SELF::WEBSITE[1]];		//Android, Telegram, WINDOWS, EXTENSION CHROME Y FIREFOX (PUTOS LINKS), Metatrader 4, Metatrader 5,  cTrader, R Trader,  R Web Trader.//Android, Telegram, WINDOWS, EXTENSION CHROME Y FIREFOX (PUTOS LINKS)
		PUBLIC CONST RATING = 						['rating'];//stars
		PUBLIC CONST SOCIAL = 						['social'.'-'.SELF::WEBSITE[1], 'followers', 'plays'];
		PUBLIC CONST TIME = 						['age', 'year', 'hour-hand'];
		PUBLIC CONST WEBSITE =						['website-name', 'url'];	
		public const MONEY = 						['payment', 'payment-url'];
		public const INFO = 						['important'];

		public const PAYMENT_URL = [
			'bitcoin' => 'http://www.bitcoin.com',
			'paypal' => 'http://www.paypal.com',
			'visa' => 'http://www.visa.com',
			'apple' => 'http://www.apple.com',
			'mastercard' => 'http://www.mastercard.com'
		];
		
		public const ACCOUNT_LIMIT = 'account-limit';//1 --> AQUI SE PUEDEN HACE CALCULOS:>
		public const BALANCE_TRANSFER = 'balance-transfer';//Si
		public const CONDITIONS = 'conditions';
		public const CONTESTS = 'contests';//ENCUESTAS (SI)
		public const DAILY_INTEREST = 'daily-interest';//0.0109589%. La tasa de interés anual es de 4.08% .
		public const DEMO = 'demo';//SI		
		public const DEPOSIT = 'deposit';//BITCOIN, PAYEER, NETEWEER...
		public const DEPOSIT_URL = 'deposit-url';//BITCOIN-url, PAYEER-url, NETEWEER-url...			
		public const IMPORTANT = 'important';//Debemos ver los anuncios para recibir comisiones por referido				
		public const MEMBERSHIP = 'membership';//SI
		public const LEVERAGE = 'leverage';//APALANCAMIENTO (SI)		
		public const MINIMUM_DEPOSIT = 'minimum-deposit';//15 rublos
		public const MINIMUM_PAYMENT = 'minimum-payment';//15 rublos		
		public const OTHER = 'other';//INFORMACION TEXTO	
		public const PAYMENT = 'payment';//BITCOIN, PAYEER, NETEWEER...
		//public const PAYMENT_URL = 'payment-url';//BITCOIN-url, PAYEER-url, NETEWEER-url...		
		public const PAYMENT_CHECK = 'payment-check';//NO
		public const REFERRAL = 'referral';//1 NIVEL
		public const REFERRAL_LIMIT = 'referral-limit';//ilimitado
		public const REFERRAL_PAYMENT = 'referral-payment';//Standard: 0.0005$ X click, .....
		public const REFERRAL_RENT = 'referral-rent';//SI
		public const REFERRAL_SALE = 'referral-sale';//SI
		public const REFERRAL_COMMISSION = 'referral-commission';//10%
		public const SUSPENSION = 'suspension';//La cuenta queda suspendida si no tenemos actividad en 30 días 
		public const SPREADS = 'spreads';// Tan bajos de hasta 0.6 pips.
		public const TYPE = 'type';//Casino

		/*
		SELF::ACCOUNT_LIMIT, 
		SELF::BALANCE_TRANSFER, 
		SELF::CONDITIONS, 
		SELF::CONTESTS, 
		SELF::DAILY_INTEREST, 
		SELF::DEMO, 
		SELF::DEPOSIT, 
		SELF::DEPOSIT_URL,	
		SELF::MEMBERSHIP,
		SELF::LEVERAGE, 
		SELF::MINIMUM_DEPOSIT, 
		SELF::MINIMUM_PAYMENT, 
		SELF::PAYMENT_CHECK,
		SELF::REFERRAL,
		SELF::REFERRAL_LIMIT,
		SELF::REFERRAL_PAYMENT, 
		SELF::REFERRAL_RENT, 
		SELF::REFERRAL_SALE, 
		SELF::REFERRAL_COMMISSION,
		SELF::SUSPENSION, 
		SELF::SPREADS, 
		SELF::TYPE
		*/
		//(HASHTAGS)//categorias, PLATAFORMAS,METODOS,PRODUCTOS,SERVICIOS,ARTISTAS,//(TENDENCIAS)//destacad@s , top, premium, tendencia/s, exclusiv@s, mejores, estrella, recomendad/s , recomendadiones, sugerencias, seleccionad@/s, seleccion, //TOP //MEJORES	,+VALORADOS	  					//(PUBLICACIONES)	//ALBUMES, NOTIFICACIONES	, NOTICIAS, eventos, promociones, 																	
	}
?>