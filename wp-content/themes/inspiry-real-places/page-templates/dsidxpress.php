<?php
/*
 * Template Name: dsIDXpress Template
 */
get_header();

get_template_part( 'partials/header/banner' );
?>
    <div id="content-wrapper" class="site-content-wrapper site-pages">

        <div id="content" class="site-content layout-boxed">

            <div class="container">

                <div class="row">

                    <div class="col-md-9 site-main-content">

                        <main id="main" class="site-main default-page clearfix">

                            <?php
                            if ( have_posts() ):

                                while ( have_posts() ):

                                    the_post();
                                    ?>
                                    <article id="post-<?php the_ID(); ?>" <?php post_class( 'clearfix' ); ?> >

                                        <div class="entry-content clearfix">
                                            <?php the_content(); ?>
                                        </div>

                                    </article>
                                    <?php

                                endwhile;

                            endif;
                            ?>

                        </main>
                        <!-- .site-main -->

                    </div>
                    <!-- .site-main-content -->

                    <div class="col-md-3 site-sidebar-content">

                        <aside class="sidebar">

                            <?php
                            if ( is_active_sidebar( 'dsidx-sidebar' ) ) {
                                dynamic_sidebar( 'dsidx-sidebar' );
                            }
                            ?>

                        </aside><!-- .sidebar -->

                    </div>
                    <!-- .site-sidebar-content -->

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