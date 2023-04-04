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
    ?>
    <div class="single-property-slider">
        <ul id="image-gallery" class="list-unstyled">
            <?php
            foreach( $gallery_images as $gallery_image ) {
                // caption
                $caption = ( !empty( $gallery_image['caption'] ) ) ? $gallery_image['caption'] : $gallery_image['alt'];
                ?>
                <li data-thumb="<?php echo esc_url( $gallery_image['url'] ); ?>">
                    <a class="swipebox" href="<?php echo esc_url( $gallery_image['full_url'] ); ?>" title="<?php echo esc_attr( $caption ); ?>">
                        <img class="img-responsive" src="<?php echo esc_url( $gallery_image['url'] ); ?>" alt="<?php echo esc_attr( $gallery_image['title'] ); ?>"/>
                    </a>
                </li>
                <?php
            }
            ?>
        </ul>
    </div>
    <?php

    // for print
    if ( has_post_thumbnail() ) {
        echo '<div id="property-featured-image" class="only-for-print">';
        the_post_thumbnail( 'post-thumbnail', array( 'class' => 'img-responsive' ) );
        echo '</div>';
    }

} else if ( has_post_thumbnail() ) {

    inspiry_standard_thumbnail( 'post-thumbnail' );

}