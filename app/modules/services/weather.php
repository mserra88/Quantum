<?php //defined('ABSPATH') or die(); //revoco acceso directo. en todos los .php?>

<?php	

	APP::using(CONF::DLL_OPENWEATHERMAP_API);
	
	CLASS WEATHER {	
		PUBLIC FUNCTION __construct()	{  ECHO self::get_weather(); }		
	
		PUBLIC STATIC FUNCTION get_weather(){
			//llamar al constr?
			$temp = 0;
			$icon = '13d@2x';
			$description = 'Hace un tiempo guay';
			
			//$json = self::get_json(); 
			//$temp = $json->main->temp;
			//$icon = $json->weather[0]->icon;
			//$description = $json->weather[0]->description;		
			
			$icon = '<img alt="'.$description.'" loading="lazy" style="width:29px;height:29px;" class="d-inline" src = "http://openweathermap.org/img/wn/'.$icon.'.png"  >';

			RETURN array($icon.self::get_temp_color($temp, true), $description);
		}

		PUBLIC STATIC FUNCTION get_temp_color($temp, $round = false){
			IF($temp >= -4.99 && $temp <= 15.99) { $color = 'text-primary'; }
			ELSE IF($temp >= 16.00 && $temp <= 29.99) { $color = 'text-success'; }
			ELSE IF($temp >= 30.00 && $temp <= 35.99) { $color = 'text-warning'; }
			ELSE { $color = 'text-danger'; }			
			IF($round){ $temp = round($temp, 1, PHP_ROUND_HALF_ODD); }		
			RETURN '<b><span class="'.$color.'">'.$temp.'</span></b><small>ºC</small>';			
		}
		
		PUBLIC STATIC FUNCTION get_json(){
			$apikey = "47b790fd0fc41878c80c57c9846132cb";
			//$ciudad = VIEW::get_name();
			$codigoPais ="ES";
			$unidades = "&units=metric";
			$idioma = "&lang=es";
			$url = "http://api.openweathermap.org/data/2.5/weather?q=" . $ciudad ."," .$codigoPais . $unidades . $idioma . "&APPID=" . $apikey;
			$datos = file_get_contents($url);// Se solicita el archivo JSON de la url que se pasa como parámetro y se recibe como un string
			// Muestra el archivo JSON recibido como string maquetado en bonito
			//ECHO "<pre>".print_r(json_decode($datos, JSON_PRETTY_PRINT))."</pre>";
			// Se convierte el JSON en un objeto PHP
			$json = json_decode($datos);
			IF($json==null) { }//ECHO "<h3>Error en el archivo JSON recibido</h3>";
			ELSE { }//ECHO "<h3>JSON decodIFicado correctamente</h3>";		
			RETURN $json;
		}	
		
		PUBLIC STATIC FUNCTION get_weather_detail(){
			$json = self::get_json();
			# Datos contenidos en el JSON
			$estacion = $json->name;
			$pais =$json->sys->country;
			$lat = $json->coord->lat;
			$lon = $json->coord->lon;
			$temp = $json->main->temp;
			$tempmax = $json->main->temp_max;
			$tempmin = $json->main->temp_min;
			$presion = $json->main->pressure;
			$humedad = $json->main->humidity;
			$velocidadViento = $json->wind->speed;
			IF(isset($json->wind->deg)) { $direccionViento = $json->wind->deg;	}
			ELSE{ }//$direccionViento ="No disponible";
			$estadoCielo = $json->weather[0]->main;
			$descripcion = $json->weather[0]->description;
			$icono = $json->weather[0]->icon;
			$URLicono = "http://openweathermap.org/img/w/" . $icono . ".png";
			$nubosidad = $json->clouds->all;
			$amanece = $json->sys->sunrise;
			$oscurece = $json->sys->sunset;
			$fechaHoraMedida = $json->dt;

			//ECHO "<h2>Datos</h2>";
			//COMPONENT::init(COMPONENT::TITLE, array($estacion .', '. $pais, model_component::normal));

			ECHO "<br><img loading='lazy' src = '$URLicono' alt = '$descripcion' >";
			ECHO "<p>[longitud = ".$lon. " grados, latitud = ".$lat. " grados]</p>";
			ECHO "<p>Estado del cielo: " .$estadoCielo ."</p>";
			ECHO "<p>Descripción: ".$descripcion."</p>";
			ECHO "<p>Nubosidad: " . $nubosidad . " %</p>";
			ECHO "<p>Temperatura: ".self::get_temp_color($temp)." grados Celsius [Máx: ".$tempmax." grados Celsius, Mín: ".$tempmin." grados Celsius]</p>";
			ECHO "<p>Presión: ".$presion. " milibares</p>";
			ECHO "<p>Humedad: ".$humedad. " %</p>";
			ECHO "<p>Velocidad del viento: " . $velocidadViento . " metros/segundo</p>";
			ECHO "<p>Dirección del viento: " . $direccionViento . " grados</p>";
			ECHO "<p>Fecha y hora del amanecer: " . date("d-m-Y G:i:s",$amanece) . "</p>";
			ECHO "<p>Fecha y hora del oscurecer: " . date("d-m-Y G:i:s",$oscurece) . "</p>";
			ECHO "<p>Fecha y hora de la medida: " . date("d-m-Y G:i:s",$fechaHoraMedida) . "</p>";
		}
	}
?>