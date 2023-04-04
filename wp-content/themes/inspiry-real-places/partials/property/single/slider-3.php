<?php
global $post;
global $gallery_images_exists;

$gallery_images = inspiry_get_post_meta(
    'REAL_HOMES_property_images',
    array(
        'type' => 'image_advanced',
        'size' => 'post-thumbnail'
    ),
    $post->ID
);

if ( !empty( $gallery_images ) ) {
    $gallery_images_exists = true;
    ?>
    <div class="scrolling-wrapper">
        <div class="scrolling-frame">
            <ul class="clearfix">
            <?php
            foreach( $gallery_images as $gallery_image ) {
                // caption
                $caption = ( !empty( $gallery_image['caption'] ) ) ? $gallery_image['caption'] : $gallery_image['alt'];

                echo '<li>';
                echo '<a class="swipebox" data-rel="gallery-'. $post->ID  .'" href="'. $gallery_image['full_url'] .'" title="'. $caption .'" >';
                echo '<img src="'. $gallery_image['url'] .'" alt="'. $gallery_image['title'] .'" />';
                echo '</a>';
                echo '</li>';
            }
            ?>
            </ul>
        </div>
        <div class="scrollbar">
            <div class="handle">
                <div class="mousearea"></div>
            </div>
        </div>
        <div class="controls">
            <button class="btn prev"><i class="fa fa-chevron-left"></i></button>
            <button class="btn next"><i class="fa fa-chevron-right"></i></button>
        </div>
    </div>
    <?php

}