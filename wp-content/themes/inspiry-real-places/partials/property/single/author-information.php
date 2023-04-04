<?php
    global $inspiry_options;
    $author_id              =   get_the_author_meta( 'ID' );
    $author_display_name    =   get_the_author_meta( 'display_name' );
    $author_page_url        =   get_author_posts_url( $author_id );
    $profile_image_id       =   intval( get_the_author_meta( 'profile_image_id' ) );
    $author_email           =   is_email( get_the_author_meta( 'user_email' ) );

    ?>
    <div class="inner-wrapper clearfix">

        <?php

        if ( $profile_image_id ) {
            ?>
            <figure class="agent-image">
                <a href="<?php echo esc_url( $author_page_url ); ?>" >
                    <?php echo wp_get_attachment_image( $profile_image_id, 'inspiry-agent-thumbnail', false, array( 'class' => 'img-circle' ) ); ?>
                </a>
            </figure>
            <?php
        } else if ( function_exists( 'get_avatar' ) ) {
            ?>
            <figure class="agent-image">
                <a href="<?php echo esc_url( $author_page_url ); ?>" >
                    <?php echo get_avatar( $author_email, 220, '', '', array( 'class' => 'img-circle' ) ); ?>
                </a>
            </figure>
            <?php
        }
        ?>

        <h3 class="agent-name">
            <a href="<?php echo esc_url( $author_page_url ); ?>"><?php echo esc_html( $author_display_name ); ?></a>
            <?php
            $author_job_title = get_the_author_meta( 'job_title' );
            if ( !empty( $author_job_title ) ) {
                ?><span><?php echo esc_html( $author_job_title ); ?></span><?php
            }
            ?>
        </h3>

        <div class="agent-social-profiles">
            <?php
            /*
             * Twitter
             */
            $twitter_url = get_the_author_meta( 'twitter_url' );
            if ( !empty( $twitter_url ) ) {
                ?><a class="twitter" target="_blank" href="<?php echo esc_url( $twitter_url ); ?>"><i class="fa fa-twitter"></i></a><?php
            }

            /*
             * Facebook
             */
            $facebook_url = get_the_author_meta( 'facebook_url' );
            if ( !empty( $facebook_url ) ) {
                ?><a class="facebook" target="_blank" href="<?php echo esc_url( $facebook_url ); ?>"><i class="fa fa-facebook"></i></a><?php
            }

            /*
             * Google
             */
            $google_url = get_the_author_meta( 'google_plus_url' );
            if ( !empty( $google_url ) ) {
                ?><a class="gplus" target="_blank" href="<?php echo esc_url( $google_url ); ?>"><i class="fa fa-google-plus"></i></a><?php
            }

            /*
             * Linkedin
             */
            $linkedin_url = get_the_author_meta( 'linkedin_url' );
            if ( !empty( $linkedin_url ) ) {
                ?><a class="linkedin" target="_blank" href="<?php echo esc_url( $linkedin_url ); ?>"><i class="fa fa-linkedin"></i></a><?php
            }

            /*
             * Pinterest
             */
            $pinterest_url = get_the_author_meta( 'pinterest_url' );
            if ( !empty( $pinterest_url ) ) {
                ?><a class="pinterest" target="_blank" href="<?php echo esc_url( $pinterest_url ); ?>"><i class="fa fa-pinterest"></i></a><?php
            }

            /*
             * Instagram
             */
            $instagram_url = get_the_author_meta( 'instagram_url' );
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
        $author_mobile = get_the_author_meta( 'mobile_number' );
        if ( !empty( $author_mobile ) ) {
            ?><li class="mobile"><?php include( $template_svg_path . 'icon-mobile.svg' ); ?><span><?php _e( 'Mobile:', 'inspiry' ); ?></span><?php echo esc_html( $author_mobile ); ?></li><?php
        }

        /*
         * Office phone
         */
        $author_office_phone = get_the_author_meta( 'office_number' );
        if ( !empty( $author_office_phone ) ) {
            ?><li class="office"><?php include( $template_svg_path . 'icon-phone.svg' ); ?><span><?php _e( 'Office:', 'inspiry' ); ?></span><?php echo esc_html( $author_office_phone ); ?></li><?php
        }

        /*
         * Fax
         */
        $author_fax = get_the_author_meta( 'fax_number' );
        if ( !empty( $author_fax ) ) {
            ?><li class="fax"><?php include( $template_svg_path . 'icon-fax.svg' ); ?><span><?php _e( 'Fax:', 'inspiry' ); ?></span><?php  echo esc_html( $author_fax ); ?></li><?php
        }

        /*
         * Office Address
         */
        $office_address = get_the_author_meta( 'office_address' );
        if ( !empty( $office_address ) ) {
            ?><li class="map-pin"><?php include( $template_svg_path . 'map-marker.svg' ); echo esc_html( $office_address ); ?></li><?php
        }
        ?>

    </ul>
    <?php

    if ( ! is_author() ) {
        /*
         * Author intro text and view profile button
         */
        $author_description = get_the_author_meta( 'description' );
        echo apply_filters( 'the_content', get_inspiry_custom_excerpt( $author_description ) );
        ?>
        <a class="btn-default show-details" href="<?php echo esc_url( $author_page_url ); ?>"><?php _e( 'View Profile', 'inspiry' ); ?><i class="fa fa-angle-right"></i></a>
        <?php
    }

    /*
     * Author contact form
     */
    if ( $author_email && $inspiry_options['inspiry_agent_contact_form'] ) {
        global $contact_form_email;             // This will be used in contact form
        $contact_form_email = $author_email;    // Assign author email to global variable
        get_template_part( 'partials/property/single/contact-form' );
    }

?>