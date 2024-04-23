<?php 
	$model = COMPONENT::get_model();
	$settings = $model[1];
	$from = $settings[0]; 
	$part = $settings[1]; 
	$page = $settings[2]; 
	$content_type = UTILITY::set_value($settings[3], MODEL_COMPONENT::CONTENT_FULL);
	$show_collapse = $settings[4]; 
	$display_properties = $settings[5]; 
	$display_comments = $settings[6]; 

	IF($part==0){ COMPONENT::init(COMPONENT::CONTENT, array($from, $page, $content_type, 'collapseZero')); } //CONTENT_exc
	ELSE IF($part==1){ ?>
	<div class="collapse <?php echo $show_collapse; ?> " id="<?php echo 'collapseZero-'.$page->ID; ?>">
	<?php IF($display_properties){ ?>
		<span class="d-sm-none d-inline">					
			<?php COMPONENT::init(COMPONENT::PROPERTIES, array($page, MODEL_COMPONENT::PROPERTIES_DETAIL)); ?>
		</span>	
		<?php //COMPONENT::init(COMPONENT::PROPERTIES, array($page,MODEL_COMPONENT::PROPERTIES_BUTTONREGISTER)); ?>					
		<?php } ?>															
		<?php COMPONENT::init(COMPONENT::CONTENT, array($from, $page, $content_type)); ?>		
		<?php IF($display_properties){ ?>
		<?php COMPONENT::init(COMPONENT::PROPERTIES, array($page,MODEL_COMPONENT::PROPERTIES_BUTTONREGISTER)); ?>
		<div class="text-start">
			<?php COMPONENT::init(COMPONENT::PROPERTIES, array($page,MODEL_COMPONENT::PROPERTIES_LINKS)); ?>
		</div>	
		<?php } ?>	
		<?php IF($display_comments) { ?>
		<?php COMPONENT::init(COMPONENT::COMMENTS, array($page)); ?> 
		<?php } ?>					
	</div>
<?php } ?>