<?php
	CLASS VIEW_COMMENTS {
		
		PUBLIC STATIC FUNCTION comment_form_fields_custom( $fields ) {
			$author_field = $fields['author'];
			$comment_field = $fields['comment'];
			unset( $fields );
			$fields['author'] = $author_field;
			$fields['comment'] = $comment_field;
			return $fields;
		}
		
		public static function comment_form_custom($comment = null) {
			//Declare Vars //pasarle un id unico//pattern="\S(.*\S)?"//pattern=".{3,10}"  oninvalid="this.setCustomValidity(\'Para publicar tu comentario debes introducir un nombre válido (Entre 3 y 10 carácteres\')" onchange="try{setCustomValidity(\'\')}catch(e){}"
			$btn = 'btn btn-primary btn-sm fw-bold';
			$formcontrol = 'form-control form-control-sm';
			
			$comment_body = 'Añade un comentario público...';
			$postid = $comment;			
			$parentid = 0;
			$commentlist = 'comment-list';
			if(is_array($comment)){ 
				$comment_body = 'Añade una respuesta pública...';
				$postid = $comment[0];
				$parentid = $comment[1];				
				$author = $comment[2].' '; 
				$commentid = $comment[3];		
				$commentlist = $commentlist.'-'.$commentid;
				$cancel = '<a id="showme'.$commentid.'" class="'.$btn.'" data-bs-toggle="collapse" href="#reply-'.$commentid.'" role="button" aria-expanded="false" aria-controls="reply-'.$commentid.'">CANCELAR</a>';
			}		
			
			$rows = '2';
			if(CONTROLLER::is_category()){ $rows = '4'; }
			/*rows='.$rows.'*/
			$args = array(
				'fields' => array(
					'author' => '<p class="comment-form-author"><input minlength=3 maxlength=30 required class="'.$formcontrol.'" id="author" name="author" aria-required="true" placeholder="Nombre"/></p>'
				),
				'comment_field' => '<p class="comment-form-comment"><textarea  minlength=1 maxlength=280 required class="'.$formcontrol.' rs-none" id="comment" name="comment" aria-required="true" placeholder="'. $comment_body .'">'.$author./*'#'.$commentid.' '.*/'</textarea></p>',
				'submit_field' => '			
				<p id="'.$commentlist.'"  class="form-submit text-end">			
					'.$cancel.'
					<input class="'.$btn.'" type="submit" name="submit" id="submit" value="COMENTAR"> 
					<input type="hidden" name="comment_post_ID" id="comment_post_ID" value="'.$postid.'"> 
					<input type="hidden" name="comment_parent" id="comment_parent" value="'.$parentid.'">
					<input type="hidden" name="comment_parent_2" id="comment_parent_2" value="'.$commentid.'">				
				</p>',			
				'title_reply' => NULL,
				'comment_notes_before' => NULL
			);
			
			
			return $args;
		}
		
		public static function wp_list_comments_custom($comment, $args, $depth, $i = 0){
			//$GLOBALS['comment'] = $comment; 
			//$border = 'border-top';
			static $numercomment = 0;
			if(CONTROLLER::is_category() && $numercomment == 0){
				$border  = '';
			}
				
			$postid = $comment->comment_post_ID;
			
			
			$commentid = $comment->comment_ID;
			
	
			//get_post($postid)->comment_count;
			
			
			
			$parentid = $commentid;				
			$author = str_replace(' ', '', $comment->comment_author); 				
			if(!isset($author) || empty($author)){ $author = 'Anónimo'; }
			$author = '@'.strtolower($author);					
			if($depth >= $args['max_depth']){ $parentid = $comment->comment_parent; }
			$atr_mention = 'class="text-primary text-decoration-none fw-bold"';
			$content = preg_replace('/(?<=^| )@([^@ ]+)/', '<span '.$atr_mention.'>@$1</span>', $comment->comment_content);	
			$datetime = get_comment_date('Y-m-d').' '.get_comment_time('H:i:s');
			$timeago = UTILITY::get_time_ago($datetime);	
			$gravatar = $comment->comment_author_IP.$author;	

			$tooltipinfo = 'data-bs-toggle="tooltip" data-bs-placement="right" title="'.$author.'"';
			
			$avatar = get_avatar($gravatar, 56, 'identicon', $author, array('class' => 'rounded-circle border border-2', 'extra_attr' => $tooltipinfo));/*404,(mp,mystery,mm,mysteryman),identicon,monsterid,wavatar,retro,robohash, blank,gravatar_default*/
			$authorcut = $author;
			$cutchar = 15;
			if(strlen($authorcut) > $cutchar){ $tooltipauthor = str_replace('right', 'bottom', $tooltipinfo); $authorcut = substr($authorcut, 0, $cutchar).'...'; }	

			//if(controller::is_product()){
				//$pppd = 'py-1';
			//}
?>	
			<li id="li-comment-<?php echo $commentid; ?>" <?php comment_class($mt.' '.$pppd.' '.$border); ?> >	
			
			<div id="comment-<?php echo $commentid; ?>" class="d-flex align-items-top">			 
				<?php if(controller::is_product()) { ?>
					<div class="flex-shrink-0"><?php echo $avatar; ?></div>
				<?php } ?>
				<div class="flex-grow-1 "><!-- ms-1 -->
					<p class="my-0"><!--d-flex align-items-center-->
						<span <?php echo $atr_mention; ?>>
						
							<span class="d-none d-sm-inline"><?php echo $author; ?></span>
							<span class="d-inline d-sm-none" <?php echo $tooltipauthor; ?>><?php echo $authorcut; ?></span>
							
						</span>
<?php if(controller::is_product()) { ?>							
						<!---ms-auto --><span class="fw-bold ls-1 fs-small" data-bs-toggle="tooltip" data-bs-placement="right" title="<?php echo $datetime; ?>"><?php echo $timeago; ?></span>	
<?php } ?>
<?php if(!controller::is_product()) { ?>							

						<span class="comment-breaker"><?php echo $content ?> <?php edit_comment_link(__('(Edit)'),'',''); ?></span>	
<?php } ?>
						
					</p>
<?php if(controller::is_product()) { ?>					
					<p>
					<span class="comment-breaker"><?php echo $content ?> <?php edit_comment_link(__('(Edit)'),'',''); ?></span>	
					</p>
<?php } ?>					
					<?php if ($comment->comment_approved == '0') { ?>
					<p class="text-info d-none"><?php _e('Your comment is awaiting moderation.') ?></p>
					<?php } ?>		
					<?php if(controller::is_product()) { //intentar pasar variable no controlar mediante controlador. ?>
					<p><a class="btn btn-outline-primary btn-sm fw-bold hider" href="!#" rid="<?php echo $commentid; ?>">RESPONDER</a></p>
				


   
					<div class="collapse" id="reply-<?php echo $commentid; ?>">
						<?php comment_form(VIEW_COMMENTS::comment_form_custom(array($postid, $parentid, $author, $commentid)), $postid); ?>
					</div>
					
					<div class="reply d-none"><?php comment_reply_link(array_merge( $args, array('depth' =>1, 'max_depth' => $args['max_depth']))) ?></div>
					
					<?php } ?>




					
				</div> 
			</div>

<?php
		$numercomment++; 
		}	
	}
?>