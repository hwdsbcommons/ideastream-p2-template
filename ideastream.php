<?php
/**
 * Ideastream page template for P2.
 */

add_action( 'wp_head', 'hwdsb_p2_css_ideastream_additions', 99 );

/**
 * CSS additions for P2 and P2 child themes.
 */
function hwdsb_p2_css_ideastream_additions() {
	switch ( get_stylesheet() ) {
		case 'p2' :
?>

<style type="text/css">
#main ul#postlist li {border:0; padding:0;}
#main ul.commentlist {margin-left:0;}
#main #respond {margin-left:0;}
</style>

<?php
			break;

		case 'mercury' :
?>	

<style type="text/css">
#main ul#postlist li {border:0; padding:0;}
#wp-idea-stream ul.idea-list .idea-content {margin-left:64px;}

#main ul.commentlist {margin-left:0;}

@media (min-width: 620px) {
	#main ul#postlist > li {
		margin: 0 0 0 82px;
	}
	#main #respond {margin-left:0;}
}
</style>

<?php
			break;
	}
}
?><?php get_header(); ?>

<div class="sleeve_main">

	<div id="main">
		<h2><?php the_title(); ?></h2>

		<ul id="postlist">
		<?php if ( have_posts() ) : ?>

			<?php while ( have_posts() ) : the_post(); ?>
				<li id="prologue-<?php the_ID(); ?>" <?php post_class(); ?>>
					<?php the_content( __( '(More ...)' , 'p2' ) ); ?>

					<?php
					/*
					 * Comments
					 */
				
					$comment_field = '<div class="form"><textarea id="comment" class="expand50-100" name="comment" cols="45" rows="3"></textarea></div> <label class="post-error" for="comment" id="commenttext_error"></label>';
				
					$comment_notes_before = '<p class="comment-notes">' . ( get_option( 'require_name_email' ) ? sprintf( ' ' . __( 'Required fields are marked %s', 'p2' ), '<span class="required">*</span>' ) : '' ) . '</p>';
				
					$p2_comment_args = array(
						'title_reply'           => __( 'Reply', 'p2' ),
						'comment_field'         => $comment_field,
						'comment_notes_before'  => $comment_notes_before,
						'comment_notes_after'   => '<span class="progress spinner-comment-new"></span>',
						'label_submit'          => __( 'Reply', 'p2' ),
						'id_submit'             => 'comment-submit',
					);
				
					?>
				
					<?php if ( get_comments_number() > 0 && ! post_password_required() ) : ?>
						<div class="discussion" style="display: none">
							<p>
								<?php p2_discussion_links(); ?>
								<a href="#" class="show-comments"><?php _e( 'Toggle Comments', 'p2' ); ?></a>
							</p>
						</div>
					<?php endif;
				
					wp_link_pages( array( 'before' => '<p class="page-nav">' . __( 'Pages:', 'p2' ) ) ); ?>
				
					<div class="bottom-of-entry">&nbsp;</div>
				
					<?php if ( p2_is_ajax_request() ) : ?>
						<ul id="comments-<?php the_ID(); ?>" class="commentlist inlinecomments"></ul>
					<?php else :
						comments_template();
						$pc = 0;
						if ( p2_show_comment_form() && $pc == 0 && ! post_password_required() ) :
							$pc++; ?>
							<div class="respond-wrap" <?php echo ( ! is_singular() ) ? 'style="display: none; "' : ''; ?>>
								<?php comment_form( $p2_comment_args ); ?>
							</div><?php
						endif;
					endif; ?>
				</li>
			<?php endwhile; ?>

		<?php endif; ?>
		</ul>

	</div> <!-- main -->

</div> <!-- sleeve -->

<?php get_footer(); ?>
