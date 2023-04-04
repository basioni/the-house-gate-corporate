<?php
global $inspiry_options;
global $inspiry_single_property;

$video_url = $inspiry_single_property->get_video_url();

if ( !empty( $video_url ) ) {
    ?>
    <section class="property-video">

        <?php
        if ( !empty( $inspiry_options[ 'inspiry_property_video_title' ] ) ) {
            ?><h4 class="fancy-title"><?php echo esc_html( $inspiry_options[ 'inspiry_property_video_title' ] ); ?></h4><?php
        }
        ?>

        <div class="placeholder-thumb format-video">
            <a class="video-popup" href="<?php echo esc_url( $video_url ); ?>" title="<?php echo esc_attr( $inspiry_options[ 'inspiry_property_video_title' ] ); ?>">
                <i class="fa fa-play-circle-o"></i>
                <?php
                // flag to keep check
                $video_image_generated = false;

                $video_image = $inspiry_single_property->get_video_image();
                if ( !empty( $video_image ) ) {
                    $video_image_src = wp_get_attachment_image_src( $video_image,'post-thumbnail' );
                    if ( $video_image_src ) {
                        ?><img class="img-responsive" src="<?php echo esc_url( $video_image_src[0] ); ?>" alt="" /><?php
                        $video_image_generated = true;
                    }
                }

                /*
                 * Backup in case of no video image
                 */
                if ( !$video_image_generated ) {
                    if ( has_post_thumbnail() ) {
                        // display featured image if video image is not available
                        the_post_thumbnail( 'post-thumbnail', array( 'class' => 'img-responsive' ) );
                    } else {
                        // display place holder image in case of all above fails
                        inspiry_image_placeholder( 'post-thumbnail' );
                    }
                }
                ?>
            </a>
        </div>
    </section>
    <?php
}
