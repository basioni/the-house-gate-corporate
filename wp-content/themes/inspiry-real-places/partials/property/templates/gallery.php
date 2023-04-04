<?php
/*
 * Gallery Filter
 */
$status_terms = get_terms( 'property-status' );
if ( !empty( $status_terms ) && !is_wp_error( $status_terms ) ) {
    ?>
    <div id="gallery-items-filter" class="gallery-items-filter clearfix">
        <a href="#" class="active" data-filter="*"><?php _e( 'All', 'inspiry' ); ?></a>
        <?php
        foreach ( $status_terms as $term ) {
            ?><a href="#" data-filter="<?php echo '.' . $term->slug; ?>"><?php echo esc_html( $term->name ); ?></a><?php
        }
        ?>
    </div><!-- .filter-by -->
    <?php
}


/*
 * Important classes for page structure
 */
$gallery_columns_class = 'gallery-3-columns';
$property_class = 'col-md-4';

if ( is_page_template( 'page-templates/2-columns-gallery.php' ) ) {
    $gallery_columns_class = 'gallery-2-columns';
    $property_class = 'col-md-6';
} elseif ( is_page_template( 'page-templates/4-columns-gallery.php' ) ) {
    $gallery_columns_class = 'gallery-4-columns';
    $property_class = 'col-md-3';
}
?>

<div id="gallery-container" class="gallery-container gallery-post-listing isotope row <?php echo esc_attr( $gallery_columns_class ); ?>">

    <?php
    // Basic gallery query
    $gallery_args = array(
        'post_type' => 'property',
        'posts_per_page' => 50      // 50 is better than -1 with respect to performance if a site has more than 50 properties
    );

    // Gallery query and start of loop
    $gallery_query = new WP_Query( $gallery_args );

    if ( $gallery_query->have_posts() ):

        while ( $gallery_query->have_posts() ) :

            $gallery_query->the_post();

            if( has_post_thumbnail( get_the_ID() ) ):

                // Get status based classes that will be used for filtering
                $property_status_based_classes = '';
                $property_status_terms =  get_the_terms( get_the_ID(), 'property-status' );
                if ( !empty( $property_status_terms ) && !is_wp_error( $property_status_terms ) ) :
                    foreach( $property_status_terms as $status_term ) {
                        $property_status_based_classes .= $status_term->slug . ' ';
                    }
                endif;
                ?>
                <div class="col-xs-6 col-gallery-item isotope-item <?php echo esc_attr( $property_status_based_classes ); echo esc_attr( $property_class ); ?>">

                    <article class="gallery-post-item gallery-listing-post clearfix hentry">

                        <figure class="gallery-thumbnail">
                            <div class="media-container">
                                <div class="btn-wrapper">
                                    <?php
                                    $image_id = get_post_thumbnail_id();
                                    $full_image_url = wp_get_attachment_url( $image_id );
                                    if ( $full_image_url ) {
                                        ?><a class="search-plus swipebox" href="<?php echo esc_url( $full_image_url ); ?>" title="<?php the_title(); ?>"><i class="fa fa-search-plus"></i></a><?php
                                    }
                                    ?>
                                    <a class="external-link" href="<?php the_permalink(); ?>"><i class="fa fa-external-link"></i></a>
                                </div>
                            </div>
                            <?php the_post_thumbnail( 'post-thumbnail', array( 'class' => 'img-responsive' ) ); ?>
                        </figure>

                        <div class="gallery-title-wrapper">
                            <h3 class="gallery-item-title entry-title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" rel="bookmark"><?php the_title(); ?></a></h3>
                        </div>

                    </article>
                    <!-- .gallery-post-item -->

                </div><!-- .col-gallery-item -->
                <?php

            endif;

        endwhile;

    endif;
    ?>

</div><!-- .gallery-container -->