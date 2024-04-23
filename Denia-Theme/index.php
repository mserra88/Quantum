<!doctype html>
<html <?php language_attributes(); ?>>
	<head><?php get_header(); ?></head>
	<body <?php body_class('container-fluid p-0 '.UTILITY::get_body_class()); ?>><!-- noscroll-->
		<header class="sticky-top"><?php COMPONENT::init(ARRAY(COMPONENT::MENU)); ?></header>
		<main class="row g-0 mt-md-4">
			<?php COMPONENT::init(ARRAY(COMPONENT::SIDEBAR)); ?>			
			<div class="col">
				<?php VIEW::get_view(); ?>
			</div>
			<?php COMPONENT::init(ARRAY(COMPONENT::SIDEBAR, array(true))); ?>					
		</main>
		<footer><?php get_footer(); ?></footer> 
	</body>
</html>