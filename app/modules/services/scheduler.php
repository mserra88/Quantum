<?php	
	CLASS SCHEDULER {	
		PUBLIC FUNCTION __construct()	{ ECHO '__construct'; }		
		PUBLIC STATIC FUNCTION get_scheduler()	{ ECHO 'get_scheduler'; }
	}
	/*	
	class AGENDA {
		static private $year;
		static private $calendario_laboral;	
		static private $name;
		PUBLIC STATIC FUNCTION get_name() 		{ RETURN self::$name; }	
		
		PUBLIC STATIC FUNCTION get_year() 		{ RETURN self::$year; }	
		PUBLIC STATIC FUNCTION get_dm() 	{ RETURN self::$calendario_laboral; }			
		PUBLIC FUNCTION __construct() 	{  
			ECHO 'ENTRO';
			self::$year = DATE::get_current_year(); 
			self::$calendario_laboral = EXTENDED_MODEL_PRODUCT::agenda[1]; 
			
			self:$name = get_class() ;
		}
		
		PUBLIC STATIC FUNCTION get_agenda(){
			RETURN 'soy una puta agenda: '.DATE::get_current_year();	
			//ECHO 'ENTRO';
			/*
			$calendario_laboral = MODEL_SCHEDULER::set_dm();
			$year = self::get_year();
			
			ECHO $year;
			
			foreach($calendario_laboral as $dia){
				ECHO '<br>';
				foreach($dia as $property){
					
					IF(is_array($property)){
						
						foreach($property as $property_array){
							
							ECHO '<br>';
							foreach($property_array as $value){
								ECHO $value.' ';
							}
							
						}
								ECHO '<br>';
					}ELSE{
						ECHO $property.' ';
					}
				}
			}
			*/
	/* } */
?>