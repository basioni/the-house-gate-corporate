<?php
global $inspiry_options;
global $inspiry_single_property;
$agent_id = intval( $inspiry_single_property->get_agent_id() );

if ( $agent_id > 0 ) {

    $inspiry_agent = new Inspiry_Agent( $agent_id );
    $agent_post = get_post( $agent_id );
    $agent_permalink = get_permalink( $agent_id );
    ?>
    <div class="inner-wrapper clearfix">

        <?php
        if ( has_post_thumbnail( $agent_id ) ) {
            ?>
            <figure class="agent-image">
                <a href="<?php echo esc_url( $agent_permalink ); ?>" >
                    <?php echo get_the_post_thumbnail( $agent_id, 'inspiry-agent-thumbnail', array( 'class' => 'img-circle' ) ); ?>
                </a>
            </figure>
            <?php
        }
        ?>

        <h3 class="agent-name">
            <a href="<?php echo esc_url( $agent_permalink ); ?>"><?php echo esc_html( $agent_post->post_title ); ?></a>
            <?php
            $agent_job_title = $inspiry_agent->get_job_title();
            if ( !empty( $agent_job_title ) ) {
                ?><span><?php echo esc_html( $agent_job_title ); ?></span><?php
            }
            ?>
        </h3>

        <div class="agent-social-profiles">
            <?php
            /*
             * Twitter
             */
            $twitter_url = $inspiry_agent->get_twitter();
            if ( !empty( $twitter_url ) ) {
                ?><a class="twitter" target="_blank" href="<?php echo esc_url( $twitter_url ); ?>"><i class="fa fa-twitter"></i></a><?php
            }

            /*
             * Facebook
             */
            $facebook_url = $inspiry_agent->get_facebook();
            if ( !empty( $facebook_url ) ) {
                ?><a class="facebook" target="_blank" href="<?php echo esc_url( $facebook_url ); ?>"><i class="fa fa-facebook"></i></a><?php
            }

            /*
             * Google
             */
            $google_url = $inspiry_agent->get_google();
            if ( !empty( $google_url ) ) {
                ?><a class="gplus" target="_blank" href="<?php echo esc_url( $google_url ); ?>"><i class="fa fa-google-plus"></i></a><?php
            }

            /*
             * Linkedin
             */
            $linkedin_url = $inspiry_agent->get_linkedin();
            if ( !empty( $linkedin_url ) ) {
                ?><a class="linkedin" target="_blank" href="<?php echo esc_url( $linkedin_url ); ?>"><i class="fa fa-linkedin"></i></a><?php
            }

            /*
             * Pinterest
             */
            $pinterest_url = $inspiry_agent->get_pinterest();
            if ( !empty( $pinterest_url ) ) {
                ?><a class="pinterest" target="_blank" href="<?php echo esc_url( $pinterest_url ); ?>"><i class="fa fa-pinterest"></i></a><?php
            }

            /*
             * Instagram
             */
            $instagram_url = $inspiry_agent->get_instagram();
            if ( !empty( $instagram_url ) ) {
                ?><a class="instagram" target="_blank" href="<?php echo esc_url( $instagram_url ); ?>"><i class="fa fa-instagram"></i></a><?php
            }
            ?>
        </div>

    </div>

    <ul class="agent-contacts-list">
        <?php
        $template_svg_path = get_template_directory() . '/images/svg/';

        /*
         * Mobile
         */
        $mobile = $inspiry_agent->get_mobile();
        if ( !empty( $mobile ) ) {
            ?><li class="mobile"><?php include( $template_svg_path . 'icon-mobile.svg' ); ?><span><?php _e( 'Mobile:', 'inspiry' ); ?></span><?php echo esc_html( $mobile ); ?></li><?php
        }

        /*
         * Office
         */
        $office_phone = $inspiry_agent->get_office_phone();
        if ( !empty( $office_phone ) ) {
            ?><li class="office"><?php include( $template_svg_path . 'icon-phone.svg' ); ?><span><?php _e( 'Office:', 'inspiry' ); ?></span><?php echo esc_html( $office_phone ); ?></li><?php
        }

        /*
         * Fax
         */
        $fax = $inspiry_agent->get_fax();
        if ( !empty( $fax ) ) {
            ?><li class="fax"><?php include( $template_svg_path . 'icon-fax.svg' ); ?><span><?php _e( 'Fax:', 'inspiry' ); ?></span><?php  echo esc_html( $fax ); ?></li><?php
        }

        /*
         * Address
         */
        $office_address = $inspiry_agent->get_office_address();
        if ( !empty( $office_address ) ) {
            ?><li class="map-pin"><?php include( $template_svg_path . 'map-marker.svg' ); echo esc_html( $office_address ); ?></li><?php
        }
        ?>

    </ul>
    <?php

    if ( ! is_singular( 'agent' ) ) {
        /*
         * Agent intro text and view profile button
         */
        echo apply_filters( 'the_content', get_inspiry_custom_excerpt( $agent_post->post_content ) );
        ?>
        <a class="btn-default show-details" href="<?php echo esc_url( $agent_permalink ); ?>"><?php _e( 'View Profile', 'inspiry' ); ?><i class="fa fa-angle-right"></i></a>
        <?php
    }

    /*
     * Agent Contact Form
     */
    $agent_email = $inspiry_agent->get_email();
    if ( $agent_email && $inspiry_options['inspiry_agent_contact_form'] ) {
        global $contact_form_email;             // This will be used in contact form
        $contact_form_email = $agent_email;    // Assign author email to global variable
        get_template_part( 'partials/property/single/contact-form' );
    }

}
?>

