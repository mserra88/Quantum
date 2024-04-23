<?php APP::init(); ?>
<?php
//KEYWORDS
			$meta_keywords = controller::get_keywords();
			if(CONTROLLER::is_category() || CONTROLLER::is_product() || CONTROLLER::is_single()){
				
				$cat_name = category::get_name();
				IF(CONTROLLER::is_single()){
					$cat_name = UTILITY::get_the_category();//aview,
				}
				$meta_keywords .= ', '.$cat_name.', '.category::get_keywords();
				//$cid = category::get_id();
			}

	//		echo $meta_keywords.'<-';
/*			
			$model = CATEGORY::get_products(array($cid));
			if($model){
				foreach($model as $pr){
					$meta_keywords = $meta_keywords.', '.$pr[0]->post_name;
				}
			}
*/	
/*			
			if(!$is_category && !$is_product && !$is_single && !controller::is_reflected()){
				$model = CATEGORY::get_categories();
				if($model){
					foreach($model as $pr){
						$meta_keywords = $meta_keywords.', '.$pr;
					}
				}			
			}
*/		
//KEYWORDS	

			$siteurl = VIEW::get_site_url();
			$app_name = VIEW::get_name();
			$meta_subtitle = ucfirst(VIEW::get_subtitle());
			
			if(CONTROLLER::is_home()){ $meta_title = $app_name.' | '.ucwords($meta_subtitle); }
			else { $meta_title = ucfirst(ltrim(VIEW::get_title())).': '.$meta_subtitle.'. '.$app_name; }
?>

<title><?php echo $meta_title; ?></title>
<meta charset="<?php echo UTILITY::get_bloginfo('charset'); ?>" />
<meta id="viewport" name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover, shrink-to-fit=no, height=device-height"/><!--, user-scalable=no-->
<meta name="apple-mobile-web-app-status-bar-style" content="default"/>
<meta name="apple-mobile-web-app-capable" content="yes"/>
<meta name="mobile-web-app-capable" content="yes"/>
<meta http-equiv="x-ua-compatible" content="IE=edge"/>
<meta name="googlebot" content="index, follow" />
<meta name="robots" content="index, follow" />
<meta name="description" content="<?php echo $meta_title.': '.UTILITY::get_bloginfo('description'); ?>"/>
<meta name="keywords" content="<?php echo $meta_keywords; ?>" />
<link rel="apple-touch-startup-image" href="<?php echo $siteurl; ?>/android-chrome-192x192.png" />
<link rel="apple-touch-icon" sizes="180x180" href="<?php echo $siteurl; ?>/apple-touch-icon.png" />
<link rel="shortcut icon" href="<?php echo $siteurl; ?>/favicon.ico" />
<link rel="manifest" href="<?php echo $siteurl; ?>/site.webmanifest" />
<link rel="preload stylesheet" as="style" href="<?php ECHO CONF::STYLESHEET_FONTAWESOME; ?>" media="screen" /><!--- media="screen" defer -->
<link rel="preload stylesheet" as="style" href="<?php ECHO CONF::STYLESHEET_BOOTSTRAP; ?>" media="screen" /><!--- media="screen" defer -->
<link rel="preload stylesheet" as="style" href="<?php ECHO CONF::STYLESHEET; ?>"  media="screen" /><!--- media="screen" defer -->
<link rel="sitemap" href="<?php echo $siteurl; ?>/sitemap.xml" type="application/xml" title="Sitemap" /><!-- ??? -->
<?PHP //ECHO ' <link rel="stylesheet" href="'.view::get_uri().CONF::STYLESHEET_THEME.'" /> '; //NN ?>
<?PHP IF(VIEW::GET_CLARITY()){ ?>
<!-- Clarity tracking code for https://ganarmidinero.com/ -->
<!--
<script>
	(function(c,l,a,r,i,t,y){
		c[a]=c[a]||function(){(c[a].q=c[a].q||[]).push(arguments)};
		t=l.createElement(r);t.async=1;t.src="https://www.clarity.ms/tag/"+i+"?ref=bwt";
		y=l.getElementsByTagName(r)[0];y.parentNode.insertBefore(t,y);
	})(window, document, "clarity", "script", "AAAKKKIII");
</script>
-->
<?PHP } ?>