<?php
if (post_password_required()) {
    return;
}
?>
<div id="comments" class="comments-area content-boxed">
    <?php

    // You can start editing here -- including this comment!
    if (have_comments()) : ?>
        <div class="comment-list-wap">
            <h2 class="comments-title">
                <?php
                $comments_number = get_comments_number();

                printf(_n('%s Comment', '%s Comments', $comments_number, 'strollik5'), $comments_number);
                ?>
            </h2>
            <ol class="comment-list" data-opal-customizer="otf_comment_template">
                <?php
                wp_list_comments(array(
                    'avatar_size' => 100,
                    'style' => 'ol',
                    'short_ping' => true,
                    'reply_text' => esc_html__('Reply', 'strollik5'),
                ));
                ?>
            </ol>
        </div>
        <?php the_comments_pagination(array(
            'prev_text' => '<span class="fa fa-arrow-left"></span><span class="screen-reader-text">' . esc_html__('Previous page', 'strollik5') . '</span>',
            'next_text' => '<span class="screen-reader-text">' . esc_html__('Next page', 'strollik5') . '</span><span class="fa fa-arrow-right"></span>',
        ));
    endif; // Check for have_comments().

    // If comments are closed and there are comments, let's leave a little note, shall we?
    if (!comments_open() && get_comments_number() && post_type_supports(get_post_type(), 'comments')) : ?>
        <p class="no-comments"><?php esc_html_e('Comments are closed.', 'strollik5'); ?></p>
    <?php
    endif;
    $comments_args = array(
        // Redefine your own textarea (the comment body).
        'comment_field' => '<p class="comment-form-comment"><label for="comment">' . esc_html_x('Comment', 'noun', 'strollik5') . '</label> <textarea id="comment" name="comment" cols="45" rows="8" maxlength="65525" required="required" placeholder="' . esc_attr__("Comment", "strollik5") . '"></textarea></p>',
    );
    comment_form($comments_args);
    ?>

</div><!-- #comments -->
