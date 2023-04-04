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

                        <main id="main" class="site-main default-page blog-single-post clearfix">
                            <?php

                            if ( have_posts() ):

                                while ( have_posts() ):

                                    the_post();

                                    $format = get_post_format( get_the_ID() );
                                    if ( false === $format ) {
                                        $format = 'standard';
                                    }

                                    $article_classes = 'blog-post clearfix';
                                    // header margin fix in case of no thumbnail for a blog post
                                    if ( !has_post_thumbnail() ) {
                                        $article_classes .= ' entry-header-margin-fix';
                                    }

                                    ?>
                                    <article id="post-<?php the_ID(); ?>" <?php post_class( $article_classes ); ?> >

                                        <?php
                                        // image, gallery or video based on format
                                        if ( in_array( $format, array( 'standard', 'image', 'gallery', 'video' ) ) ) :
                                            get_template_part( 'partials/post/entry-format', $format );
                                        endif;
                                        ?>

                                        <header class="entry-header blog-post-entry-header">
                                            <?php
                                            // title
                                            get_template_part( 'partials/post/entry-title' );

                                            // meta
                                            get_template_part( 'partials/post/entry-meta' );
                                            ?>
                                        </header>

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
                                            <?php the_tags( '<span class="tag-links">', '', '</span>' ); ?>
                                        </footer>

                                    </article>

                                    <?php
                                    // comments
                                    get_template_part( 'partials/post/entry-comments' );

                                endwhile;

                            endif;
                            ?>

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

    </div><!-- .site-content-wrapper -->

<?php
/*
 * Footer
 */
get_footer();