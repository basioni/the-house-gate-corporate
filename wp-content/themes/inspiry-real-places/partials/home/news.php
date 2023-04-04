<?php
/*
 * News for homepage
 */

global $inspiry_options;

$variation = 'one';
if ( $inspiry_options[ 'inspiry_home_sections_width' ] == 'wide' ) {
    $variation = 'two'; // in case of wide layout
}

$number_of_posts = intval( $inspiry_options[ 'inspiry_home_posts_number' ] );
if( !$number_of_posts ) {
    $number_of_posts = 3;
}

$recent_posts_args = array(
    'post_type' => 'post',
    'posts_per_page' => $number_of_posts,
    'ignore_sticky_posts' => 1,
);

if ( ( $inspiry_options[ 'inspiry_home_news_type' ] == 'category' ) && ( !empty( $inspiry_options[ 'inspiry_home_news_category' ] ) ) ) {
    $recent_posts_args[ 'cat' ] = $inspiry_options[ 'inspiry_home_news_category' ];
}elseif ( ($inspiry_options[ 'inspiry_home_news_type' ] == 'tag') && !empty( $inspiry_options[ 'inspiry_home_news_tag' ] ) ) {
    $recent_posts_args[ 'tag_id' ] = $inspiry_options[ 'inspiry_home_news_tag' ];
}

// The Query
$recent_posts_query = new WP_Query( $recent_posts_args );

// The Loop
if ( $recent_posts_query->have_posts() ) {

    ?>
    <section
        class="home-recent-posts home-recent-posts-<?php echo esc_attr( $variation ); ?> fade-in-up <?php echo esc_attr( inspiry_animation_class() ); ?>">
        <div class="container">

            <header class="section-header">
                <?php
                if ( !empty( $inspiry_options[ 'inspiry_home_news_title' ] ) ) {
                    ?><h3 class="section-title"><?php echo esc_html( $inspiry_options[ 'inspiry_home_news_title' ] ); ?></h3><?php
                }
                ?>
                <div class="recent-posts-carousel-nav carousel-nav">
                    <a class="carousel-prev-item prev"><?php include( get_template_directory() . '/images/svg/arrow-left.svg' ); ?></a>
                    <a class="carousel-next-item next"><?php include( get_template_directory() . '/images/svg/arrow-right.svg' ); ?></a>
                </div>
            </header>

            <div class="recent-posts-carousel">

                <div class="owl-carousel">

                    <?php
                    while ( $recent_posts_query->have_posts() ) {

                        $recent_posts_query->the_post();

                        $format = get_post_format( get_the_ID() );

                        if ( false == $format ) {
                            $format = 'standard';
                        }

                        ?>
                        <div class="recent-posts-item">
                            <article <?php post_class( 'clearfix' ) ?>>

                                <?php
                                $thumbnail_needed = false;

                                if ( $format == 'video' ) {
                                    $embed_code = get_post_meta(get_the_ID(), 'REAL_HOMES_embed_code', true);
                                    if ( !empty( $embed_code ) ) {
                                        ?>
                                        <div class="post-thumbnail-container">
                                            <div class="embed-responsive embed-responsive-4by3">
                                                <?php echo stripslashes( htmlspecialchars_decode( $embed_code ) ); ?>
                                            </div>
                                        </div>
                                        <?php
                                    } else {
                                        $thumbnail_needed = true;
                                    }
                                } else if ( $format == 'gallery' ) {

                                    $gallery_images = inspiry_get_post_meta(
                                        'REAL_HOMES_gallery',
                                        array(
                                            'type' => 'image_advanced',
                                            'size' => 'inspiry-grid-thumbnail'
                                        ),
                                        get_the_ID()
                                    );

                                    if ( !empty( $gallery_images ) && 0 < count( $gallery_images ) ) {
                                        ?>
                                        <div class="post-thumbnail-container">
                                            <div class="gallery-slider-two flexslider">
                                                <ul class="slides">
                                                    <?php
                                                    $gallery_image_count = 1;
                                                    foreach( $gallery_images as $gallery_image ) {
                                                        // caption
                                                        $caption = ( !empty( $gallery_image['caption'] ) ) ? $gallery_image['caption'] : $gallery_image['alt'];
                                                        echo '<li>';
                                                        echo '<a class="swipebox" data-rel="gallery-'. get_the_ID()  .'" href="'. $gallery_image['full_url'] .'" title="'. $caption .'" >';
                                                        echo '<img src="'. $gallery_image['url'] .'" alt="'. $gallery_image['title'] .'" />';
                                                        echo '</a>';
                                                        echo '</li>';
                                                        if ( $gallery_image_count == 3 ) {
                                                            break;
                                                        }
                                                        $gallery_image_count++;
                                                    }
                                                    ?>
                                                </ul>
                                            </div>
                                        </div>
                                        <?php
                                    } else {
                                        $thumbnail_needed = true;
                                    }
                                }

                                if ( ( $format != 'video' && $format != 'gallery' ) || $thumbnail_needed ) {
                                    ?>
                                    <div class="post-thumbnail-container">
                                        <figure class="post-thumbnail">
                                            <?php inspiry_thumbnail(); ?>
                                        </figure>
                                    </div>
                                    <!-- .post-thumbnail-container -->
                                    <?php
                                }
                                ?>

                                <div class="post-content-wrapper">
                                    <div class="post-header entry-header">
                                        <h4 class="post-title entry-title">
                                            <a href="<?php the_permalink() ?>"><?php the_title(); ?></a>
                                        </h4>
                                        <div class="post-meta entry-meta">
                                            <span class="author-link"><?php
                                            printf(
                                                _x( 'By %s', 'author byline', 'inspiry' ),
                                                sprintf(
                                                    '<a rel="author" href="%1$s">%2$s</a>',
                                                    esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
                                                    esc_html( get_the_author_meta( 'display_name' ) )
                                                )
                                            );
                                            ?></span>
                                        </div>
                                    </div>

                                    <p><?php inspiry_excerpt( 13 ); ?></p>

                                    <?php
                                    if ( !empty( $inspiry_options['inspiry_home_news_link_text'] ) ) {
                                        ?>
                                        <a class="read-more" href="<?php the_permalink(); ?>"><?php echo esc_html( $inspiry_options[ 'inspiry_home_news_link_text' ] ); ?> <i class="fa fa-arrow-circle-o-right"></i></a>
                                        <?php
                                    }
                                    ?>

                                </div>
                                <!-- .post-content-wrapper -->

                            </article>
                        </div>
                        <?php
                    }

                    wp_reset_postdata();

                    ?>
                </div>

            </div>

        </div>
        <!-- .container -->

    </section><!-- .home-recent-posts -->
    <?php
}