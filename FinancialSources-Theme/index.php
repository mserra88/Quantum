<!doctype html>
<html <?php language_attributes(); ?>>
	<head>
		<?php get_header(); ?>
	</head>
	<body <?php body_class('container-fluid p-0'); ?>>
		
			<?php /*IF ( have_posts() ) { WHILE ( have_posts() ) {*/ //the_post(); ?>
			<header class="sticky-top"><?php COMPONENT::init(COMPONENT::MENU); ?></header>
			<main class="row g-0">
				<?php COMPONENT::init(COMPONENT::SIDEBAR); ?>		
				<div class=" col-lg-10 col-xl-8 col-xxl-6 col-custom-center">			
					<?php VIEW::get_view(); ?>
				</div>
				<?php COMPONENT::init(COMPONENT::SIDEBAR); ?>				
			</main>
			<footer><?php get_footer(); ?></footer> 
			<?php //} } ?>
	
		<?php echo round(memory_get_usage()/1048576,2).''.' MB'; ?>
	</body>
</html>