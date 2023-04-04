<?php
/*
 * If the current post is protected by a password and the visitor has not yet
 * entered the password we will return early without loading the comments.
 */
if (post_password_required())
    return;
?>
<!-- start of comments section -->
<div id="comments">

    <?php
    if (have_comments()) {
        ?>
        <h2 id="comments-title"><?php comments_number( __('No Comment', 'inspiry'), __('One Comment', 'inspiry'), __('% Comments', 'inspiry') ); ?></h2>

        <ol class="commentlist">
            <?php wp_list_comments( array( 'callback' => 'inspiry_theme_comment' ) ); ?>
        </ol>

        <?php

        if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) {
            ?>
            <nav class="pagination comments-pagination">
                <?php paginate_comments_links(); ?>
            </nav>
            <?php
        }

    }

    if ( !comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) {
        ?><p class="nocomments"><?php _e('Comments are closed.', 'inspiry'); ?></p><?php
    }

    /* comments form */
    comment_form();

    ?>

</div>
<!-- end of comments -->