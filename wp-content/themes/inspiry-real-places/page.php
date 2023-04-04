<?php
/*
 * Header
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
                                            <?php
                                            wp_link_pages( array(
                                                'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'inspiry' ),
                                                'after'  => '</div>',
                                            ) );
                                            ?>
                                        </div>

                                        <footer class="entry-footer">
                                            <?php edit_post_link( esc_html__( 'Edit', 'inspiry' ), '<span class="edit-link">', '</span>' ); ?>
                                        </footer>

                                    </article>
                                    <?php
                                    // If comments are open or we have at least one comment, load up the comment template
                                    if ( comments_open() || '0' != get_comments_number() ) :
                                        comments_template();
                                    endif;

                                endwhile;

                            endif;
                            ?>

                        </main>
                        <!-- .site-main -->

                    </div>
                    <!-- .site-main-content -->

                    <div class="col-md-3 site-sidebar-content">

                        <?php get_sidebar( 'page' ); ?>

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