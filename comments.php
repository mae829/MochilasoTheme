<?php
/**
 * The template for displaying comments
 *
 * @package mochilaso
 */

if ( ! empty( $_SERVER['SCRIPT_FILENAME'] ) && 'comments.php' === basename( $_SERVER['SCRIPT_FILENAME'] ) ) {
	die( 'Please do not load this page directly. Thanks!' );
}

if ( post_password_required() ) {
	echo 'This post is password protected. Enter the password to view comments.';
	return;
}

if ( have_comments() ) { ?>

	<h2 id="comments"><?php comments_number( 'No Responses', 'One Response', '% Responses' ); ?></h2>

	<div class="navigation">
		<div class="next-posts"><?php previous_comments_link(); ?></div>
		<div class="prev-posts"><?php next_comments_link(); ?></div>
	</div>

	<ol class="commentlist">
		<?php wp_list_comments(); ?>
	</ol>

	<div class="navigation">
		<div class="next-posts"><?php previous_comments_link(); ?></div>
		<div class="prev-posts"><?php next_comments_link(); ?></div>
	</div>

	<?php
} else { // this is displayed if there are no comments so far.

	// If comments are open, but there are no comments.
	if ( comments_open() ) {
		echo '<p>There are currently no comments.</p>';
	} else { // comments are closed.
		echo '<p>Comments are closed.</p>';
	}
}

if ( function_exists( 'facebook_comments' ) ) {
	facebook_comments();
}

if ( comments_open() ) {
	?>

	<div id="respond">

		<h2><?php comment_form_title( 'Leave a Reply', 'Leave a Reply to %s' ); ?></h2>

		<div class="cancel-comment-reply">
			<?php cancel_comment_reply_link(); ?>
		</div>

		<?php if ( get_option( 'comment_registration' ) && ! is_user_logged_in() ) { ?>
			<p>You must be <a href="<?php echo esc_url( site_url( '/wp-admin/' ) ); ?>">logged in</a> to post a comment.</p>
		<?php } else { ?>

			<form action="<?php echo esc_url( site_url() ); ?>/wp-comments-post.php" method="post" id="commentform">

				<?php if ( is_user_logged_in() ) { ?>

					<p>Logged in as <a href="<?php echo esc_url( site_url() ); ?>/wp-admin/profile.php"><?php echo esc_html( $user_identity ); ?></a>. <a href="<?php echo esc_url( wp_logout_url( get_permalink() ) ); ?>" title="Log out of this account">Log out &raquo;</a></p>

				<?php } else { ?>

					<div>
						<input type="text" name="author" id="author" value="<?php echo esc_attr( $comment_author ); ?>" size="22" tabindex="1" />
						<label for="author">Name
						</label>
					</div>

					<div>
						<input type="text" name="email" id="email" value="<?php echo esc_attr( $comment_author_email ); ?>" size="22" tabindex="2" />
						<label for="email">Mail (will not be published)</label>
					</div>

					<div>
						<input type="text" name="url" id="url" value="<?php echo esc_attr( $comment_author_url ); ?>" size="22" tabindex="3" />
						<label for="url">Website</label>
					</div>

				<?php } ?>

				<!--<p>You can use these tags: <code><?php echo allowed_tags(); ?></code></p>-->

				<div>
					<textarea name="comment" id="comment" cols="58" rows="10" tabindex="4"></textarea>
				</div>

				<div>
					<input name="submit" type="submit" id="submit" tabindex="5" value="Submit Comment" />
					<?php comment_id_fields(); ?>
				</div>

				<?php do_action( 'comment_form', $post->ID ); ?>

			</form>

		<?php } // If registration required and not logged in ?>

	</div><!-- end #respond -->

<?php } // end comments_open() ?>
