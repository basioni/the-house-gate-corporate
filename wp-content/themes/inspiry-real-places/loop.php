<?php
/*
 * Main loop for search and archive pages
 */
if ( have_posts() ) :

    while ( have_posts() ) :

        the_post();

        // get post type
        $post_type = get_post_type( get_the_ID() );

        // classes based on post type
        $article_classes = 'blog-listing-post clearfix';
        if ( $post_type == 'post' ) {
            $article_classes = 'blog-post' . ' ' . $article_classes;
        }

        // post format
        $format = get_post_format( get_the_ID() );
        if ( false === $format ) {
            $format = 'standard';
        }

        // header margin fix in case of no thumbnail for a blog post
        if ( $post_type == 'post' && !has_post_thumbnail() ) {
            $article_classes .= ' entry-header-margin-fix';
        }
        ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class( $article_classes ); ?> >

            <?php
            // display image, gallery or video based on format type
            if ( in_array( $format, array( 'standard', 'image', 'gallery', 'video' ) ) ) :
                get_template_part( 'partials/post/entry-format', $format );
            endif;

            // display entry header for only blog posts
            if ( $post_type == 'post' ) {
                ?>
                <header class="entry-header blog-post-entry-header">
                    <?php
                    // title
                    get_template_part( 'partials/post/entry-title' );

                    // meta
                    get_template_part('partials/post/entry-meta');
                    ?>
                </header>
                <?php
            }
            ?>

            <div class="entry-summary">
                <?php
                // display title for other post types
                if ( $post_type != 'post' ) {
                    ?><h2 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2><?php
                }

                // summary
                if( strpos( get_the_content(), 'more-link' ) === false ) {
                    the_excerpt();
                } else {
                    the_content( '' );
                }
                ?>
                <a href="<?php the_permalink(); ?>" rel="bookmark" class="btn-default btn-orange"><?php _e( 'Read More', 'inspiry' ); ?></a>
            </div>

        </article>
    <?php

    endwhile;

    global $wp_query;
    inspiry_pagination( $wp_query );

else :

    inspiry_nothing_found();

endif;