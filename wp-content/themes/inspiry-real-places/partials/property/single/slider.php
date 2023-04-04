<?php
global $post;

$gallery_images = inspiry_get_post_meta(
                            'REAL_HOMES_property_images',
                            array(
                                'type' => 'image_advanced',
                                'size' => 'post-thumbnail'
                            ),
                            $post->ID
                        );

if ( !empty( $gallery_images ) ) {

    echo '<div class="single-property-slider gallery-slider flexslider">';

        echo '<ul class="slides">';

        foreach( $gallery_images as $gallery_image ) {
            // caption
            $caption = ( !empty( $gallery_image['caption'] ) ) ? $gallery_image['caption'] : $gallery_image['alt'];

            echo '<li>';
                echo '<a class="swipebox" data-rel="gallery-'. $post->ID  .'" href="'. $gallery_image['full_url'] .'" title="'. $caption .'" >';
                    echo '<img src="'. $gallery_image['url'] .'" alt="'. $gallery_image['title'] .'" />';
                echo '</a>';
            echo '</li>';
        }

        echo '</ul>';

    echo '</div>';

    // for print
    if ( has_post_thumbnail() ) {
        echo '<div id="property-featured-image" class="only-for-print">';
            the_post_thumbnail( 'post-thumbnail', array( 'class' => 'img-responsive' ) );
        echo '</div>';
    }

} else if ( has_post_thumbnail() ) {

    inspiry_standard_thumbnail( 'post-thumbnail' );

} else {
    // display placeholder
    inspiry_image_placeholder( 'post-thumbnail', 'img-responsive' );

}