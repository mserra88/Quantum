<?php 
	$is_product = CONTROLLER::is_product();
	$is_single = CONTROLLER::is_single();
	$is_explore = controller::is_explore();
	$is_category = controller::is_category();
	$is_home = controller::is_home();
	$is_category = CONTROLLER::is_category();
	$is_services = CONTROLLER::is_services();
	//COMPONENT::init(COMPONENT::ADS);

	if(!$_COOKIE["ocultardiv"]) {	
		COMPONENT::init(COMPONENT::COOKIES);
		COMPONENT::init(COMPONENT::MODAL, array(MODEL_COMPONENT::MODAL_COOKIES)); 
	}
	
	//IF(isset($_GET["product"])) {  

//$id = 0; IF($_GET["view"] == 'featured' ) { $id = 1; } 

	//if(CONTROLLER::is_category() || controller::is_explore()){ 
	/*controller::is_home() ||*/
											
											
										


		
	//}
	//}

	COMPONENT::init(COMPONENT::MODAL, array(MODEL_COMPONENT::MODAL_SHARE));
	
	$news = VIEW::get_id_news();
	//IF(isset($_GET["news"]) || isset($_GET["news_single"])) { 
		/*
		IF(isset($_GET["news"])){
			$news = $_GET["news"];
		}else IF(isset($_GET["news_single"])){
			$news = $_GET["news_single"];
		}
		*/
		
																	//NAME AQUI
		//IF($news && ( $is_home || $is_explore || ($is_category && utility::get_id(VIEW::get_page())==$news) )  )		
		IF($news && ( $is_home || $is_explore || ($is_category && utility::get_id(VIEW::get_page(category::get_name()))==$news) )  )
		{
			$modalid = MODEL_COMPONENT::MODAL_STORIES;
			COMPONENT::init(COMPONENT::MODAL, array($modalid)); 
		}
	//}
	
	IF($is_home || $is_explore || $is_services){ COMPONENT::init(COMPONENT::MODAL, array(MODEL_COMPONENT::MODAL_MENU)); }
	
?>

<script src="<?php ECHO CONF::SCRIPT_BOOTSTRAP; ?>"></script> <!--defer="defer" -->
<script src="<?php ECHO CONF::SCRIPT; ?>"></script>
<?PHP  //ECHO ' <script src="'.view::get_uri().CONF::SCRIPT_THEME.'"></script> '; ?>
<script>documentReady(<?php echo "'".$modalid."','".$_COOKIE["nombre"]."'"; ?>);</script>