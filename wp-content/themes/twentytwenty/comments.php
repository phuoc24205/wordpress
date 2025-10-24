

<?php

/**
 * The template file for displaying the comments and comment form for the
 * Twenty Twenty theme.
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
*/
if (post_password_required()) {
    return;
}

if ($comments) {
    ?>

    <div class="comments" id="comments">

        <?php
        $comments_number = get_comments_number();
        ?>

	</div>

    <?php
}

if (comments_open() || pings_open()) {

    if ($comments) {
//        echo '<hr class="styled-separator is-style-wide" aria-hidden="true" />';
    }

    comment_form(array(
        'class_form' => 'section-inner thin max-percentage',
        'title_reply' => 'Make a post',
        'title_reply_before' => '<h2 id="reply-title" class="comment-reply-title">',
        'title_reply_after' => '</h2>',
        'label_submit' => 'share',
        'comment_field' => '
        
<textarea class="comment-text" id="comment" name="comment" rows="5" placeholder="What are you thinking..."></textarea>
        ',
        'fields' => is_user_logged_in() ? array() : array(
            'author' => '<p><input id="author" name="author" type="text" placeholder="Tên của bạn"></p>',
            'email' => '<p><input id="email" name="email" type="email" placeholder="Email"></p>',
        )
    ));
} elseif (is_single()) {

    if ($comments) {
        echo '<hr class="styled-separator is-style-wide" aria-hidden="true" />';
    }

    ?>

    <div class="comment-respond" id="respond">

        <p class="comments-closed"><?php _e('Comments are closed.', 'twentytwenty'); ?></p>

    </div><!-- #respond -->

    <?php
}