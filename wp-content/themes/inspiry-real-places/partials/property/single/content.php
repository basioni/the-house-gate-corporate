<div class="entry-content clearfix">

    <?php
    global $inspiry_options;
    global $post;

    /*
     * Description
     */
    if ( !empty( $post->post_content ) && $inspiry_options[ 'inspiry_property_description' ] ) {
        if ( !empty( $inspiry_options[ 'inspiry_property_desc_title' ] ) ) {
            ?><h4 class="fancy-title"><?php echo esc_html( $inspiry_options[ 'inspiry_property_desc_title' ] ); ?></h4><?php
        }
        ?><div class="property-content"><?php the_content(); ?></div><?php
    }

    /*
     * Additional Details
     */
    if ( $inspiry_options[ 'inspiry_property_details' ] ) {
        get_template_part( 'partials/property/single/additional-details' );
    }

    /*
     * Features
     */
    if ( $inspiry_options[ 'inspiry_property_features' ] ) {
        get_template_part( 'partials/property/single/features' );
    }

    /*
     * Video
     */
    if ( $inspiry_options[ 'inspiry_property_video' ] ) {
        get_template_part( 'partials/property/single/video' );
    }
    ?>
</div>
