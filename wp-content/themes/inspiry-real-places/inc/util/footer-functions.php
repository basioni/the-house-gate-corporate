<?php
if( !function_exists( 'inspiry_modal_login' ) ) :
    /**
     * Generate modal login form
     */
    function inspiry_modal_login(){

        if ( ! is_user_logged_in() ) {
            /*
             * include modal login code
             */
            get_template_part( 'partials/members/modal-login' );
        }

    }

    add_action( 'wp_footer', 'inspiry_modal_login', 5 );

endif;