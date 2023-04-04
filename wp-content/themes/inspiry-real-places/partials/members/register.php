<div class="form-wrapper">

    <div class="form-heading clearfix">
        <span><?php _e( 'Register', 'inspiry' ); ?></span>
        <button type="button" class="close close-modal-dialog" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times fa-lg"></i></button>
    </div>

    <form id="register-form" action="<?php echo admin_url('admin-ajax.php'); ?>" method="post" enctype="multipart/form-data">

        <div class="form-element">
            <label class="login-form-label" for="register_username"><?php _e( 'Username', 'inspiry' ); ?><span>*</span></label>
            <input id="register_username" name="register_username" type="text" class="login-form-input login-form-input-common"
                   title="<?php _e( '* Please enter a valid username.', 'inspiry' ); ?>"
                   placeholder="<?php _e( 'Username', 'inspiry' ); ?>" />
        </div>

        <div class="form-element">
            <label class="login-form-label" for="register_email"><?php _e( 'Email', 'inspiry' ); ?><span>*</span></label>
            <input id="register_email" name="register_email" type="text" class="login-form-input login-form-input-common"
                   title="<?php _e( '* Please provide valid email address!', 'inspiry' ); ?>"
                   placeholder="<?php _e( 'Email', 'inspiry' ); ?>" />
        </div>

        <div class="form-element">
            <label class="login-form-label" for="register_pwd"><?php _e( 'Password', 'inspiry' ); ?></label>
            <input id="register_pwd" name="register_pwd" type="password" class="login-form-input login-form-input-common"
                   title="<?php _e( '* Provide your password', 'inspiry' ); ?>"
                   placeholder="<?php _e( 'Password', 'inspiry' ); ?>" />
        </div>

        <div class="form-element">
            <label class="login-form-label" for="register_pwd2"><?php _e( 'Confirm Password', 'inspiry' ); ?></label>
            <input id="register_pwd2" name="register_pwd2" type="password" class="login-form-input login-form-input-common"
                   title="<?php _e( '* Password should be same as above', 'inspiry' ); ?>"
                   placeholder="<?php _e( 'Confirm Password', 'inspiry' ); ?>" />
        </div>

        <div class="form-element clearfix">
            <input type="submit" id="register-button" name="user-submit" class="login-form-submit login-form-input-common" value="<?php _e( 'Register', 'inspiry' ); ?>" />
            <input type="hidden" name="action" value="inspiry_ajax_register" />
            <?php  // nonce for security
            wp_nonce_field( 'inspiry-ajax-register-nonce', 'inspiry-secure-register' );

            if ( is_page() || is_single() ) {
                ?><input type="hidden" name="redirect_to" value="<?php wp_reset_postdata(); global $post; the_permalink( $post->ID ); ?>" /><?php
            } else {
                ?><input type="hidden" name="redirect_to" value="<?php echo esc_url( home_url( '/' ) ); ?>" /><?php
            }

            ?>
            <div class="text-center">
                <div id="register-message" class="modal-message"></div>
                <div id="register-error" class="modal-error"></div>
                <img id="register-loader" class="modal-loader" src="<?php echo get_template_directory_uri(); ?>/images/ajax-loader.gif" alt="Working...">
            </div>
        </div>

    </form>

    <div class="clearfix">
        <span class="login-link pull-left">
            <a href="#" class="activate-section" data-section="login-section"><?php _e( 'Login', 'inspiry' ); ?></a>
        </span>
        <span class="forgot-password pull-right">
            <a href="#" class="activate-section" data-section="password-section"><?php _e( 'Forgot Password?', 'inspiry' ); ?></a>
        </span>
    </div>

</div>

