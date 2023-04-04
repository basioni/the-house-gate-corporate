<?php
/*
 * Google reCAPTCHA
 */
global $inspiry_options;

if ( class_exists( 'Inspiry_Real_Estate' )
    && ( $inspiry_options[ 'inspiry_google_reCAPTCHA' ] )
    && !empty( $inspiry_options[ 'inspiry_reCAPTCHA_site_key' ] )
    && !empty( $inspiry_options[ 'inspiry_reCAPTCHA_secret_key' ] )) {

        $recaptcha_src = '';
        if ( isset( $inspiry_options['inspiry_reCAPTCHA_language'] ) && !empty( $inspiry_options['inspiry_reCAPTCHA_language'] ) ) {
            $recaptcha_src =    add_query_arg(
                                    array(
                                        'hl' => urlencode( $inspiry_options['inspiry_reCAPTCHA_language'] )
                                    ),
                                    '//www.google.com/recaptcha/api.js'
                                );
        }

        ?>
        <div class="inspiry-recaptcha-wrapper clearfix">
            <div class="g-recaptcha" data-sitekey="<?php echo esc_attr( $inspiry_options[ 'inspiry_reCAPTCHA_site_key' ] ); ?>"></div>
            <script type="text/javascript" src="<?php echo esc_url( $recaptcha_src ) ?>"></script>
        </div>
        <?php
}