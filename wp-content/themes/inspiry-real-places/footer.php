<?php
global $inspiry_options;

$footer_variation = $inspiry_options['inspiry_footer_variation'];
if( !$footer_variation ) {
    $footer_variation = 'one';
}

?>
<footer class="site-footer site-footer-<?php echo esc_attr( $footer_variation ); ?>">

    <div class="container">

        <div class="row">

            <div class="col-lg-3 footer-logo fade-in-left <?php echo inspiry_animation_class(); ?>">

                <?php
                /*
                 * Footer Logo
                 */
                if ( !empty( $inspiry_options['inspiry_footer_logo'] ) && !empty( $inspiry_options['inspiry_footer_logo']['url'] ) ) {
                    ?>
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                        <img class="img-responsive" src="<?php echo esc_url( $inspiry_options['inspiry_footer_logo']['url'] ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>"/>
                    </a>
                    <?php
                }

                /*
                 * Footer copyright text
                 */
                if ( !empty( $inspiry_options['inspiry_copyright_html'] ) ) {
                    ?>
                    <p class="copyright-text"><?php echo wp_kses(
                            $inspiry_options['inspiry_copyright_html'],
                            array(
                                'a' => array(
                                    'href' => array(),
                                    'title' => array(),
                                    'target' => array(),
                                ),
                                'em' => array(),
                                'strong' => array(),
                                'br' => array(),
                            ) ); ?></p>
                    <?php
                }
                ?>
            </div>

            <div class="col-lg-9 footer-widget-area fade-in-up <?php echo inspiry_animation_class(); ?>">

                <div class="row">

                    <div class="col-sm-6 col-md-3">
                        <?php
                        if ( is_active_sidebar( 'footer-first-column' ) ) {
                            dynamic_sidebar( 'footer-first-column' );
                        }
                        ?>
                    </div>

                    <div class="col-sm-6 col-md-3">
                        <?php
                        if ( is_active_sidebar( 'footer-second-column' ) ) {
                            dynamic_sidebar( 'footer-second-column' );
                        }
                        ?>
                    </div>

                    <div class="clearfix visible-sm"></div>

                    <div class="col-sm-6 col-md-3">
                        <?php
                        if ( is_active_sidebar( 'footer-third-column' ) ) {
                            dynamic_sidebar( 'footer-third-column' );
                        }
                        ?>
                    </div>

                    <div class="col-sm-6 col-md-3">
                        <?php
                        if ( is_active_sidebar( 'footer-fourth-column' ) ) {
                            dynamic_sidebar ( 'footer-fourth-column' );
                        }
                        ?>
                    </div>

                </div>

            </div>

        </div>

    </div>

</footer> <!-- .footer -->

<?php wp_footer(); ?>

</body>
</html>
