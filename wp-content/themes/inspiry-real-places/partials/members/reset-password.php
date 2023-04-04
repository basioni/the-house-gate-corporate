<div class="form-wrapper">

    <div class="form-heading clearfix">
        <span><?php _e( 'Forgot Password', 'inspiry' ); ?></span>
        <button type="button" class="close close-modal-dialog" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times fa-lg"></i></button>
    </div>

    <form id="forgot-form" action="<?php echo admin_url('admin-ajax.php'); ?>" method="post" enctype="multipart/form-data">

        <div class="form-element">
            <label class="login-form-label" for="reset_username_or_email"><?php _e( 'Username or Email', 'inspiry' ); ?><span>*</span></label>
            <input id="reset_username_or_email" name="reset_username_or_email" type="text" class="login-form-input login-form-input-common required"
                   title="<?php _e( '* Provide a valid username or email!', 'inspiry' ); ?>"
                   placeholder="<?php _e( 'Username or Email', 'inspiry' ); ?>" />
        </div>

        <div class="form-element">
            <input type="submit" id="forgot-button" name="user-submit" class="login-form-submit login-form-input-common" value="<?php _e( 'Reset Password', 'inspiry' ); ?>">
            <input type="hidden" name="action" value="inspiry_ajax_forgot" />
            <input type="hidden" name="user-cookie" value="1" />
            <?php wp_nonce_field( 'inspiry-ajax-forgot-nonce', 'inspiry-secure-reset' ); ?>
            <div class="text-center">
                <div id="forgot-message" class="modal-message"></div>
                <div id="forgot-error" class="modal-error"></div>
                <img id="forgot-loader" class="modal-loader" src="<?php echo get_template_directory_uri(); ?>/images/ajax-loader.gif" alt="Working...">
            </div>
        </div>

    </form>

    <div class="clearfix">

        <?php
        if( get_option( 'users_can_register' ) ) :
            ?>
            <span class="sign-up pull-left">
                <?php _e( 'Not a Member?', 'inspiry' ); ?>
                <a href="#" class="activate-section" data-section="register-section"><?php _e( 'Sign up now', 'inspiry' ); ?></a>
            </span>
        <?php
        endif;
        ?>

        <span class="login-link pull-right">
            <a href="#" class="activate-section" data-section="login-section"><?php _e( 'Login', 'inspiry' ); ?></a>
        </span>

    </div>

</div>

