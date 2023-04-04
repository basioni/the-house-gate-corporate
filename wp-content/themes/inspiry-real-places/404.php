<?php
/**
 * 404 page
 */

get_header();

get_template_part( 'partials/header/banner' );
?>
    <div id="content-wrapper" class="site-content-wrapper site-pages">

        <div id="content" class="site-content layout-boxed">

            <div class="container">

                <div class="row">

                    <div class="col-xs-12 site-main-content">

                        <main id="main" class="site-main default-page clearfix">

                            <div class="wrapper-404">

                                <h1 title="title-404">4<span>0</span>4</h1>

                                <div class="content-404">

                                    <p><?php _e( 'Look like something went wrong!', 'inspiry'); ?></p>

                                    <p><?php _e( 'The page you were looking for is not here', 'inspiry'); ?></p>

                                    <p><a href="<?php echo esc_url( home_url('/') ); ?>"><?php _e( 'Go to Home','inspiry'); ?></a></p>

                                </div>

                            </div>

                        </main>
                        <!-- .site-main -->

                    </div>
                    <!-- .site-main-content -->

                </div>
                <!-- .row -->

            </div>
            <!-- .container -->

        </div>
        <!-- .site-content -->

    </div><!-- .site-content-wrapper -->
<?php
/*
 * Footer
 */
get_footer();