<?php 
	add_filter('comment_form_fields', 'VIEW_COMMENTS::comment_form_fields_custom' );	

	$model = COMPONENT::get_model();
	$settings = $model[1];
	$post = $settings[0];
	$islist = $settings[1];
	
	$postid = utility::get_id($post);
//ECHO $postid.'<............... abrir putos comentarios.';
	$commentcount =  $post->comment_count; 
	$title = $commentcount.' comentario';		

	IF($commentcount != 1){ $title = $title.'s'; }	

	$commentsettings = array();
	$commentsettings['post_id'] = $postid;
	$commentsettings['status'] = 'approve';

	/*if(CONTROLLER::is_category()){
		$showallcomments = true;
		$commentsettings['number'] = '4';
		//$commentsettings['parent'] =  '0';
		$commentsettings['orderby'] = 'comment_date';
		$commentsettings['order'] = 'DESC';
	}*/
	
	if($islist){
		$showallcomments = true;
		$commentsettings['number'] = '2';
		$commentsettings['parent'] =  '0';
		$commentsettings['orderby'] = 'comment_date';
		$commentsettings['order'] = 'DESC';
	}
	
	/*{
		$mt = ' mt-2 ';
	}*/
	
	$tsize = MODEL_COMPONENT::NORMAL;
	
	$datetime = get_the_date( 'Y-m-d', $post->ID ).' '.get_the_time( 'H:i:s', $post->ID ); 
	$timeago = UTILITY::get_time_ago($datetime, false);		
?>

<?php COMPONENT::init(COMPONENT::ADS); ?>
	 	<div class="d-none w-100 border-top "></div>

<?php IF($islist && $commentcount > 0){ ?>
<div class="w-100 "><!--border-top d-flex justify-content-center align-items-center -->
	<p class="my-0">
<a class="text-decoration-none border-0" href="<?php echo get_permalink($postid); ?>#comment-list"><?php COMPONENT::init(COMPONENT::TITLE, array('Ver los '.$commentcount.' comentarios', $tsize, false)); ?></a></p>								
</div>
<?php } ?>
	 
<?php if(!$islist){ ?>	
	<div class="d-none mt-1 ms-2 "><?php COMPONENT::init(COMPONENT::TITLE, array($title, $tsize)); ?></div>
	<?php comment_form(VIEW_COMMENTS::comment_form_custom($postid), $postid); ?>
<?php } ?>

<ul class="ps-0 mb-0">
	<?php wp_list_comments(array('callback' => 'VIEW_COMMENTS::wp_list_comments_custom', 'reverse_top_level' => TRUE, 'reverse_children' => TRUE), get_comments($commentsettings)); ?>
</ul>

<?php if($islist){ ?>	
	<p class="my-0">
		<span class="fs-x-small text-uppercase" data-bs-toggle="tooltip" data-bs-placement="right" title="<?php echo $datetime; ?>"><?php echo $timeago; ?></span>
	</p>
	<div class=" w-100 border-top "></div>
	<?php comment_form(VIEW_COMMENTS::comment_form_custom($postid), $postid); ?>
<?php } ?>