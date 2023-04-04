<?php
/*
 * Property Features
 */
global $post;
$features = get_the_terms( $post->ID, 'property-feature' );

if ( !empty( $features ) && is_array( $features ) && !is_wp_error( $features ) ) {
    ?>
    <div class="property-features">
        <?php
        global $inspiry_options;
        $property_features_title = $inspiry_options[ 'inspiry_property_features_title' ];
        if( !empty( $property_features_title ) ) {
            ?><h4 class="fancy-title"><?php echo esc_html( $property_features_title ); ?></h4><?php
        }
        ?>
        <ul class="property-features-list clearfix">
            <?php
            foreach( $features as $single_feature ) {
                echo '<li><a href="' . get_term_link( $single_feature->slug, 'property-feature' ) .'">'. $single_feature->name . '</a></li>';
            }
            ?>
        </ul>
    </div>
    <?php
}
