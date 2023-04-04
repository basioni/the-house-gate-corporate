<?php
global $inspiry_options;
if ( !empty( $inspiry_options['inspiry_facebook_url'] )
        || !empty( $inspiry_options['inspiry_twitter_url'] )
            || !empty( $inspiry_options['inspiry_google_url'] ) ) {
    ?>
    <div class="social-networks header-social-nav">
        <?php
        if ( ! empty( $inspiry_options['inspiry_twitter_url'] ) ) {
            ?><a class="twitter" target="_blank" href="<?php echo esc_url( $inspiry_options['inspiry_twitter_url'] ); ?>"><i class="fa fa-twitter"></i></a><?php
        }

        if ( ! empty( $inspiry_options['inspiry_facebook_url'] ) ) {
            ?><a class="facebook" target="_blank" href="<?php echo esc_url( $inspiry_options['inspiry_facebook_url'] ); ?>"><i class="fa fa-facebook"></i></a><?php
        }

        if ( ! empty( $inspiry_options['inspiry_google_url'] ) ) {
            ?><a class="gplus" target="_blank" href="<?php echo esc_url( $inspiry_options['inspiry_google_url'] ); ?>"><i class="fa fa-google-plus"></i></a><?php
        }
        ?>
    </div><!-- .social-networks -->
    <?php
}
?>