<?php
/*
 * Search Results Page
 */

get_header();

get_template_part( 'partials/header/banner' );
?>

<div id="content-wrapper" class="site-content-wrapper site-pages">

    <div id="content" class="site-content layout-boxed">

        <div class="container">

            <div class="row">

                <div class="col-md-9 site-main-content">

                    <main id="main" class="site-main blog-post-listing">

                        <?php get_template_part( 'loop' ); ?>

                    </main>
                    <!-- .site-main -->

                </div>
                <!-- .site-main-content -->

                <div class="col-md-3 site-sidebar-content">

                    <?php get_sidebar(); ?>

                </div>
                <!-- .site-sidebar-content -->

            </div>
            <!-- .row -->

        </div>
        <!-- .container -->

    </div>
    <!-- .site-content -->

</div>
<!-- .site-content-wrapper -->

<?php
/*
 * Footer
 */
get_footer();