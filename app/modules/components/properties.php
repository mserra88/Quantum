<?php 
	$model = COMPONENT::get_model();
	$settings = $model[1];
	$p = $settings[0];
	$dataset = $settings[1];
	$tooltip = UTILITY::set_value($settings[2], TRUE);
	
	if(controller::is_explore()){
		$pid = category::get_id($p->post_name);
	}
		
	IF($dataset == MODEL_COMPONENT::PROPERTIES_DETAIL){
		$properties = category::get_properties($pid);
		//A PAGE
		if($p->post_name == extended::CONTACT){
			$properties = extended::contact_detail;
	
		}
//$details = category::get_detail();		
	}ELSE IF($dataset == MODEL_COMPONENT::PROPERTIES_INFO){
		$properties = category::get_info($pid);
	}ELSE IF($dataset == MODEL_COMPONENT::PROPERTIES_LINKS){
		$properties = category::get_links($pid);
	} ELSE IF($dataset == MODEL_COMPONENT::PROPERTIES_FEATURED){
		$properties = array('featured');
	} ELSE IF($dataset == MODEL_COMPONENT::PROPERTIES_BUTTONREGISTER){
		$properties = array('url');//MODEL_PRODUCT::CORPORATION[4]
	}
	
	if($tooltip && ($dataset == MODEL_COMPONENT::PROPERTIES_INFO  || $dataset == MODEL_COMPONENT::PROPERTIES_FEATURED)) {
		$tooltipsettings = 'data-bs-toggle="tooltip" data-bs-placement="bottom"  data-bs-html="true" ';
	}
?>

						<?php //if(get_post_meta(UTILITY::get_id($page), 'featured')){ ?> <!-- QUANTUM 458-->			<!--🏆-->								
						<!-- 						-->
						<?php //} ?>
<?php IF(!$detail){ ?>
	<!--<div class="card-header text-start border-0 p-0">
		<p>Info</p>
	</div>-->
<?php } ?>
<!--
<div class="row g-0 d-none">
		<div class="col-4">
		<img  height="200px" class="w-100 border float-start" src="https://1.bp.blogspot.com/-cPGUh1FLAvY/WoBQyfNbiVI/AAAAAAAAAqI/2teQFpnm4hg-t5nhsa4ogO7il97Dl_bLQCLcBGAs/s280/Czc121UVIAA5UZQ.jpg" />
		</div>
		<div class="col-8">
		</div>
</div>							
-->
		 <?php //if (){ echo 'destacado'; } ?>
		<?php 
			foreach($properties as $nn => $property) { 
				
				$value = get_post_meta(utility::get_id($p), $property, true);
				
				if(isset($value) || (!isset($value) && $property == 'featured') ){
				//echo '...'.$value.'???';
				
IF($value ||$value == 0){
					$d_type = 'block';
					$ps = '3';
					IF($property == 'bonus' || $property == 'age' || $property == 'important' || $property == 'featured' || $property == 'category'  ){ $d_type = 'inline'; $ps = ''; }
				$CClass = '';
					IF($property == 'url' && $dataset == MODEL_COMPONENT::PROPERTIES_BUTTONREGISTER){
						$d_type = ''; $ps = '';
						$CClass = 'text-center';
					}
				?>				
				<div class="<?php echo $CClass; ?> d-<?php echo $d_type; ?> ps-<?php echo $ps;?>">
				<?php IF($property == 'compatibility' || $property == 'compatibility-url' || $property == 'payment'){ ?>
						
				<?php IF($property == 'compatibility') { ?>
					<?php  echo '<p class="fw-bold">APP DISPONIBLE EN:</p>'; ?>
					<?php $valuestitles = explode(',', $value); ?>
				<?php }?>

				<?php IF($property == 'compatibility-url') { ?>
					<?php $valuestitles2 = explode(',', $value); ?>
					<?php $av = 'Disponible para'; ?>
				<?php }?>						
					<?php IF($property == 'payment') { ?>
					<?php  echo '<p class="fw-bold">PAGO DISPONIBLE CON:</p>'; ?>					
					<?php $valuestitles = explode(',', $value); ?>					
					<?php $valuestitles2 = MODEL_PRODUCT::PAYMENT_URL; ?>					
					<?php $av = 'Compatible con'; ?>
				<?php }?>
				<?php 
				IF($property == 'compatibility-url' || $property == 'payment') { 
				?>
				<div class="my-2"><!--mt-4 mb-2-->
				<span class=" w-min"><!-- bg-light py-4-->
				
				<?php	foreach($valuestitles as $nn => $titles){										
						$titles = strtolower(str_replace(' ', '', $titles));						
						IF($property == 'payment') { 
							$url = $valuestitles2[$titles];
						}else {
							$url = $valuestitles2[$nn];
						}
				?>
					<span class="mx-1 tooltip-link click-again-to-go"  url="<?php echo $url; ?>" target="_blank" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-html="true" title="<?php echo $av.' '.$titles; ?>">
					
						<?php if($titles=='opera') { ?>
							<i class="fab fa-opera fa-2x text-danger"></i>					
						<?php } else if($titles=='firefox') { ?>
							<i class="fab fa-firefox fa-2x text-warning"></i>					
						<?php } else if($titles=='ios') { ?>
							<i class="fab fa-apple fa-2x text-secondary"></i>					
						<?php } else if($titles=='chrome') { ?>
							<i class="fab fa-chrome fa-2x"></i>					
						<?php } else if($titles=='android') { ?>
							<i class="fab fa-android fa-2x text-success"></i>					
						<?php } else if($titles=='telegram') { ?>
							<i class="fab fa-telegram fa-2x text-primary"></i>					
						<?php } else if($titles=='windows') { ?>
							<i class="fab fa-windows fa-2x text-primary"></i>					
						<?php } else if($titles=='bitcoin') { ?>
							<i class="fab fa-bitcoin fa-2x text-danger"></i>					
						<?php } else if($titles=='paypal') { ?>
							<i class="fab fa-cc-paypal fa-2x text-primary"></i>					
						<?php } else if($titles=='visa') { ?>
							<i class="fab fa-cc-visa fa-2x text-primary"></i>					
						<?php } else if($titles=='apple') { ?>
							<i class="fab fa-cc-apple-pay fa-2x text-secondary"></i>					
						<?php } else if($titles=='mastercard') { ?>
							<i class="fab fa-cc-mastercard fa-2x text-danger"></i>					
						<?php } else {  ?>
							<?php IF($property == 'compatibility-url') { ?>
								<i class="fas fa-link fa-2x text-secondary"></i>
								<!--<i class="fas fa-puzzle-piece fa-2x text-success"></i>-->
								<!--<i class="fas fa-cubes fa-2x text-success"></i>-->
								<!--<i class="fab fa-uncharted fa-2x text-success"></i>-->
								
							<?php } else IF($property == 'payment') { ?>
								<i class="far fa-credit-card fa-2x  text-dark"></i>
							<?php } ?>	
						<?php } ?>						
					</span>
				<?php } ?> 
				</span>
				</div>
				<?php } ?>
				<?php } ELSE IF($property == 'featured' && get_post_meta(utility::get_id($p), $property)){ ?>
						<?php if($tooltip){ $ttooltip = 'Destacado'; }?>
						<span class="fa-stack fa-md" <?php //echo $tooltipsettings;?> title="<?php //echo $ttooltip; ?>">
							<i class="fas fa-certificate fa-stack-2x text-primary"></i>
							<i class="fas fa-trophy fa-stack-1x text-warning"></i>					  
						</span>
			
				<?php } ELSE IF($property == 'income'){ ?>
					<?php if($value[0]=='+'){ $dir = 'up'; $color = 'success'; } else { $dir = 'down'; $color = 'danger'; } ?>
					<i class="fas fa-caret-<?php echo $dir; ?> fa-sm text-<?php echo $color; ?>" data-bs-toggle="tooltip" data-bs-placement="right" title="Ingresos"></i>
					
					<span class="fw-bold fs-small"><?php ECHO substr($value, 1); ?></span>				
			
				<?php } ELSE IF($property == 'company'){ ?>
					<i class="fas fa-building fa-sm text-info" data-bs-toggle="tooltip" data-bs-placement="right" title="Compañia"></i>
					<span class="fw-bold fs-small"><?php ECHO $value; ?></span>				
			
				<?php } ELSE IF($property == 'language'){ ?>
					<i class="fas fa-comment fa-sm text-info" data-bs-toggle="tooltip" data-bs-placement="right" title="Idioma"></i>
					<span class="fw-bold fs-small"><?php ECHO $value; ?></span>				
			
				<?php } ELSE IF($property == 'year'){ ?>
					<i class="fas fa-calendar-alt fa-sm text-info" data-bs-toggle="tooltip" data-bs-placement="right" title="Desde"></i><!-- fas fa-globe -europe -americas -africa -->
					<span class="fw-bold fs-small"><?php ECHO $value; ?></span>				
			
				<?php } ELSE IF($property == 'location'){ ?>
					<i class="fas fa-location-arrow fa-sm text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Locacización"></i><!-- fa-map-pin-->
					<span class="fw-bold fs-small"><?php ECHO $value; ?></span>				
				
				<?php } ELSE IF($property == 'instagram'){ ?>
				<?php				
						if($p->post_name == extended::CONTACT){
							$value = extended::CONTACT_DETAILS2;
							
						}	
				?>				
					<i class="fab fa-instagram fa-sm text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Instagram"></i><!--fa-map-pin -->
					<a href="https://www.<?php ECHO $value; ?>"  target="_blank" rel="nofollow noopener" class="fw-bold fs-small"><?php ECHO $value; ?></a>
				
				<?php } ELSE IF($property == 'contact'){ ?>
				
				<?php				
						if($p->post_name == extended::CONTACT){
							$value = extended::CONTACT_DETAILS;
							
						}		
				?>				
					<i class="fa fa-envelope fa-sm text-secondary" data-bs-toggle="tooltip" data-bs-placement="right" title="Contacto"></i><!--fa-map-pin -->
					<span class="fw-bold fs-small"><?php ECHO $value; ?></span>	
				
				<?php } ELSE IF($property == 'central'){ ?>
				
					<i class="fas fa-map-marker-alt fa-sm text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Sede central"></i><!--fa-map-pin -->
					<span class="fw-bold fs-small"><?php ECHO $value; ?></span>				
				
				<?php } ELSE IF($property == 'age'){ ?>							
					<?php if($value==0){ ?>
					<span class="fa-stack fa-md" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-html="true" title="<span class='fs-x-small'>No autorizado para menores de 18 años</span>"><!--🔞-->
					  <i class="fas fa-ban fa-stack-2x text-danger"></i>
					  <i class="fas fa-stack-1x">18</i>					  
					</span>
					<?php } else if($value==1){ ?>
					<span class="fa-stack fa-md" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-html="true" title="<span class='fs-x-small'>Apto para todos los públicos</span>"><!--🔞-->
					  <i class="far fa-circle fa-stack-2x text-success"></i>
					  <i class="fas fa-stack-1x ">TP</i>					  
					</span>	
					<?php } else if($value==2){ ?>
					<span class="fa-stack fa-md" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-html="true" title="<span class='fs-x-small'>Ambiente Familiar</span>"><!--🔞-->
					  <i class="far fa-circle fa-stack-2x text-success"></i>
					  <i class="fas fa-users fa-stack-1x text-success"></i>					  
					</span>	
					<?php } ?>

				<?php } ELSE IF($property == 'url'){ ?>
				
				<?php 
					
					$value2 = substr($value, 0, strpos($value, '?'));
					
					$align = ' align-top';
				IF($dataset == MODEL_COMPONENT::PROPERTIES_BUTTONREGISTER){ 
					$align = 'text-white';
					$class = 'border btn btn-lg '.utility::get_bg_color( CATEGORY::get_id(utility::get_parent_name($p)));// w-100 //findid
					$value2 = 'REGISTRARSE EN '.strtoupper($p->post_title);
					
				} 
				?>
				<a href="<?php echo $value; ?>" target="_blank" class="<?php echo $class; ?>" rel="nofollow noopener">			
					<span class="fw-bold fs-small <?php echo $align; ?>"><?php echo $value2; ?></span>				
				</a>
				
				
				<!--
				<i class="text-primary fas fa-external-link-alt fa-xs tooltip-link click-again-to-go" url="<?php echo $value; ?>" data-bs-toggle="tooltip" data-bs-placement="right" title="Abrir en nueva ventana"></i>							
				-->
				<?php } ELSE IF($property == 'bonus'){ ?>
					
					<span class="w-min border rounded border-success bg-success text-warning fw-bold py-1 px-2 mb-1" data-bs-html="true" data-bs-toggle="tooltip" data-bs-placement="bottom" title="<span class='fs-x-small'>Bono de bienvenida de <?php ECHO $value; ?> al registrarse</span>"><?php ECHO $value; ?></span><!--💶-->		
				<?php } ELSE IF($property == 'important'){ ?>
					
					<i class="fas fa-info-circle fa-2x text-info" data-bs-toggle="tooltip" data-bs-html="true"  data-bs-placement="bottom" title="<span class='fs-x-small'><?php ECHO $value; ?></span>"></i><!--ℹ️--><!--fa-map-pin -->
					
				<?php } ELSE { ?>	

				<!---->

				
				<?php 
					//echo strtoupper($property).': ';					
					//echo $value;							
				?>
				<?php } ?>
				</div>
				
				
					<?php 
}
				
				}
			}			 
		?>	





<?php IF($details){ ?>
<div class="card card-body text-start p-0  border-0 rounded-0 <?php echo $border; ?> <?php echo $w; ?>">


	<a id="estedetalle" class=" btn btn-primary rounded-0" data-bs-toggle="collapse" href="#collapseExample-detail" role="button" aria-expanded="false" aria-controls="collapseExample-detail">
					<?php COMPONENT::init(COMPONENT::TITLE, array('VER DETALLE', MODEL_COMPONENT::NORMAL)); ?>						

	</a>	
	<div class="collapse" id="collapseExample-detail">
		<ul class="list-group list-group-flush">
		<?php 
			foreach($details as $property) { 
				
				$value = get_post_meta(utility::get_id($p), $property, true);
				//IF($value){
				?>	
				
						 
				  <li class="list-group-item">
						<?php 
					echo strtoupper($property).': ';
					echo $value;		?>
					
				</li>
		
				
				
			
				
					<?php 
				//}
			}			 
		?>
		</ul>
	</div>
	
	</div>

<?php } ?>
