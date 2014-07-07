<?php
/**
 * The template for displaying Comments.
 */
?>
 
    <div id="comments" class="comments-area">
 
    <?php // You can start editing here -- including this comment! ?>
 
    <?php if ( have_comments() ) : ?>
        <h2 class="commentTitle">
            <?php
                /*printf( _n( 'One thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', get_comments_number(), 'shape' ),
                    number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' );*/
					comments_number( 'no comments', 'one comments', '% comments' );
            ?>
        </h2>
 
        <ol class="commentsList">
            <?php
				$commentListArgs = array(
					'avatar_size'       => 0,
				);
                wp_list_comments($commentListArgs);
            ?>
        </ol><!-- .commentlist -->
 
    <?php endif; // have_comments() ?>
    
    <?php
		$comments_args = array(
		// change the title of send button 
		'label_submit'=>'Send',
		// change the title of the reply section
		'title_reply'=>'Write a Reply or Comment',
		// remove "Text or HTML to be displayed after the set of comment fields"
		'comment_notes_after' => '',
		// redefine your own textarea (the comment body)
		'comment_field' => '<p class="comment-form-comment"><label for="comment">' . _x( 'Comment', 'noun' ) . '</label><br /><textarea id="comment" name="comment" aria-required="true"></textarea></p>',
		);
		
		comment_form($comments_args);
	?>
 
</div>