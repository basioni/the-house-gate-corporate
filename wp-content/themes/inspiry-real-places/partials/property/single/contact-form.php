<?php
global $inspiry_options;
global $inspiry_single_property;
global $contact_form_email;

$property_title = get_the_title( $inspiry_single_property->get_post_ID() );
$property_permalink = get_permalink( $inspiry_single_property->get_post_ID() );

?>
<div class="agent-contact-form">

    <?php
    if ( !empty( $inspiry_options[ 'inspiry_agent_contact_form_title' ] ) ) {
        ?><h3 class="agent-contact-form-title"><?php echo esc_html( $inspiry_options[ 'inspiry_agent_contact_form_title' ] ); ?></h3><?php
    }
    ?>

    <form id="agent-contact-form" class="contact-form-small" method="post" action="<?php echo admin_url('admin-ajax.php'); ?>" novalidate="novalidate">

        <div class="row">

            <div class="col-sm-6 left-field">
                <input type="text" name="name" id="name" placeholder="<?php _e('Name', 'inspiry'); ?>" class="required" title="<?php _e('* Please provide your name', 'inspiry'); ?>">
            </div>

            <div class="col-sm-6 right-field">
                <input type="text" name="email" id="email" placeholder="<?php _e('Email', 'inspiry'); ?>" class="email required" title="<?php _e('* Please provide valid email address', 'inspiry'); ?>">
            </div>

        </div>

        <textarea  name="message" id="comment" class="required" placeholder="<?php _e('Message', 'inspiry'); ?>" title="<?php _e('* Please provide your message', 'inspiry'); ?>"></textarea>

        <?php get_template_part( 'partials/common/google-reCAPTCHA' ); ?>

        <input type="hidden" name="nonce" value="<?php echo wp_create_nonce( 'agent_message_nonce' ); ?>"/>

        <input type="hidden" name="target" value="<?php echo antispambot( $contact_form_email ); ?>">

        <input type="hidden" name="action" value="send_message_to_agent" />

        <input type="hidden" name="property_title" value="<?php echo esc_attr( $property_title ); ?>" />

        <input type="hidden" name="property_permalink" value="<?php echo esc_url( $property_permalink ); ?>" />

        <input type="submit" id="submit-button" name="submit" class="btn-default btn-round" value="<?php _e( 'Send Message', 'inspiry' ); ?>">

        <img src="<?php echo get_template_directory_uri(); ?>/images/ajax-loader.gif" id="ajax-loader" alt="Loading...">

    </form>

    <div id="error-container"></div>

    <div id="message-container">&nbsp;</div>

</div>