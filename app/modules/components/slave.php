<?PHP
	$model = COMPONENT::get_model();	
	$settings = $model[1];
	
	$cid =  $settings[0];		
	$tab_id =  $settings[1];
	
	$id = '-'.strval($tab_id);
	$tab_grid = 'nav-grid'.$id;
	$tab_list = 'nav-list'.$id;
	$tab_carousel = 'nav-carousel'.$id;

	
	$grid = CONF::SLUGS_SLAVE[0];
	$list = CONF::SLUGS_SLAVE[1];	
	$carousel = CONF::SLUGS_SLAVE[2];
	
	$tsize = MODEL_COMPONENT::SMALL;
	
	$class = 'tab-pane fade';			
	
	$active_class = 'show active';
	$active_tab_master = $active_class;
	$active_tab_slave = $active_class;	
	IF(!CONTROLLER::is_services()){ 
		$datamodel = MODEL_COMPONENT::ALL_PRODUCTS;
		$type = 'products';
		IF($tab_id == 1){ 
			$active_tab_master = null;  
			$datamodel = MODEL_COMPONENT::TOP_PRODUCTS;  
			$type = 'featured';
		}		 
	}	else {	
		$datamodel = MODEL_COMPONENT::ALL_CATEGORIES_HIDDEN;		
	}
	
	$tablinkclass = 'border-active link-secondary nav-item nav-link py-0';
?>
<div id="<?php echo 'nav-'.$type; ?>" class="<?php ECHO $class.' '.$active_tab_master; ?>" aria-labelledby="<?php echo 'nav-'.$type.'-tab'; ?>" role="tabpanel">
	<nav id="myTab" class="nav nav-fill  " role="tablist"><!-- sticky-top bg-white style="top:54px;"  -->
		<a id="<?php ECHO 'tab-'.$tab_grid; ?>" class="<?php ECHO $active_tab_slave.' '.$tablinkclass; ?>" href="<?php ECHO '#'.$tab_grid; ?>" role="tab" tab-id="0"  data-bs-toggle="tab"  aria-controls="<?php ECHO $tab_grid; ?>" aria-selected="true">
			<i class="fas fa-th"></i>
			<span class="d-sm-inline d-none">
				<?php COMPONENT::init(COMPONENT::TITLE, array($grid, $tsize)); ?>
			</span>
		</a> 
		<a id="<?php ECHO 'tab-'.$tab_list; ?>" class="<?php ECHO $tablinkclass; ?>" href="<?php ECHO '#'.$tab_list; ?>" role="tab" tab-id="1" data-bs-toggle="tab" aria-controls="<?php ECHO $tab_list; ?>" aria-selected="false">
			<i class="fas fa-th-list"></i>
			<span class="d-sm-inline d-none">
				<?php COMPONENT::init(COMPONENT::TITLE, array($list, $tsize)); ?>
			</span>
		</a>
		<a id="<?php ECHO 'tab-'.$tab_carousel; ?>" class="<?php ECHO $tablinkclass; ?>" href="<?php ECHO '#'.$tab_carousel; ?>" role="tab" tab-id="2" data-bs-toggle="tab" aria-controls="<?php ECHO $tab_carousel; ?>" aria-selected="false">
			<i class="far fa-caret-square-right"></i>
			<span class="d-sm-inline d-none">
				<?php COMPONENT::init(COMPONENT::TITLE, array($carousel, $tsize)); ?>
			</span>
		</a>
	</nav>
	<div class="tab-content">
		<div id="<?php ECHO $tab_grid; ?>" class="<?php ECHO $class.' '.$active_tab_slave; ?>" role="tabpanel">
			<?php COMPONENT::init(COMPONENT::QUANTUM, ARRAY(MODEL_COMPONENT::DEFAULT, $datamodel, $cid)); ?>	
		</div>	
		<div id="<?php ECHO $tab_list; ?>" class="<?php ECHO $class; ?>" role="tabpanel">	
			<?php COMPONENT::init(COMPONENT::QUANTUM, ARRAY(MODEL_COMPONENT::LIST, $datamodel, $cid)); ?>
		</div>
		<div id="<?php ECHO $tab_carousel; ?>" class="<?php ECHO $class; ?>" role="tabpanel">
			<?php COMPONENT::init(COMPONENT::QUANTUM, ARRAY(MODEL_COMPONENT::CAROUSEL, $datamodel, $cid)); ?>	
		</div>	
	</div>	
</div>