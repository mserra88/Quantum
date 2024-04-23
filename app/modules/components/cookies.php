<div id="divcookies" class="bg-white p-1 border-top fixed-bottom d-flex align-items-center justify-content-between d-none">
	<span>
		<?php COMPONENT::init(COMPONENT::TITLE, array('Usamos', MODEL_COMPONENT::X_SMALL,'')); ?>		
		 <a id="botoninfocookies" href="!#"><?php COMPONENT::init(COMPONENT::TITLE, array('cookies', MODEL_COMPONENT::X_SMALL_BOLD,'')); ?></a>
		<?php COMPONENT::init(COMPONENT::TITLE, array('para mejorar la experiencia de navegación.', MODEL_COMPONENT::X_SMALL,'')); ?>	
	</span>
	<span class="d-flex">
		<a id="botonrechazarcookies" class="btn btn-sm btn-danger" href="!#">
			<?php COMPONENT::init(COMPONENT::TITLE, array('Rechazar', MODEL_COMPONENT::X_SMALL_BOLD)); ?>	
		</a>	
		<a id="botonaceptarcookies" class="btn btn-sm btn-success" href="!#">
			<?php COMPONENT::init(COMPONENT::TITLE, array('Aceptar', MODEL_COMPONENT::X_SMALL_BOLD)); ?>	
		</a>	
		<button type="button" id="botoncerrarcookies" class="btn-close align-middle" aria-label="Cerrar" href="!#"></button>
	</span>
</div>