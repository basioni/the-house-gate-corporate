<?php
$agent_email = '';
if ( is_singular( 'agent' ) ) {
    global $post;
    $agent_email = get_post_meta( $post->ID, 'REAL_HOMES_agent_email', true );
} else if ( is_author() ){
    global $current_author;
    $agent_email = $current_author->user_email;
}

$agent_email = is_email( $agent_email );

if( $agent_email ) {
    ?>
    <div class="agent-contact-form">

        <h3 class="agent-contact-form-title"><?php _e( 'Contact Agent', 'inspiry' ); ?></h3>

        <form id="agent-contact-form" class="contact-form-small" method="post" action="<?php echo admin_url('admin-ajax.php'); ?>" novalidate="novalidate">

            <div class="row">

                <div class="col-sm-6 left-field">
                    <input type="text" name="name" id="name" placeholder="<?php _e( 'Name', 'inspiry' ); ?>" class="required" title="<?php _e( '* Please provide your name', 'inspiry' ); ?>">
                </div>

                <div class="col-sm-6 right-field">
                    <input type="text" name="email" id="email" placeholder="<?php _e( 'Email', 'inspiry' ); ?>" class="email required" title="<?php _e( '* Please provide valid email address', 'inspiry' ); ?>">
                </div>

            </div>

            <textarea name="message" id="comment" class="required" placeholder="<?php _e( 'Message', 'inspiry' ); ?>" title="<?php _e( '* Please provide your message', 'inspiry' ); ?>"></textarea>

            <?php get_template_part( 'partials/common/google-reCAPTCHA' ); ?>

            <input type="hidden" name="nonce" value="<?php echo wp_create_nonce( 'agent_message_nonce' ); ?>"/>

            <input type="hidden" name="target" value="<?php echo antispambot( $agent_email ); ?>">

            <input type="hidden" name="action" value="send_message_to_agent" />

            <input type="submit" id="submit-button" name="submit" class="btn-default btn-round" value="<?php _e( 'Send Message', 'inspiry' ); ?>">

            <img src="<?php echo get_template_directory_uri(); ?>/images/ajax-loader.gif" id="ajax-loader" alt="Loading...">

        </form>

        <div id="error-container"></div>
        <div id="message-container">&nbsp;</div>

    </div>
    <?php
}
?>