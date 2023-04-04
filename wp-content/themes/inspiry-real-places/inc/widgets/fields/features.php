<?php
// all property features terms
$all_features = get_terms( 'property-feature' );

if ( !empty( $all_features ) && !is_wp_error( $all_features ) ) {

    $required_features_slugs = array();
    if ( isset( $_GET[ 'features' ] ) ) {
        $required_features_slugs = $_GET[ 'features' ];
    }

    if ( 0 < count ( $all_features ) ) {
        ?>
        <div class="extra-search-fields">

            <h5 class="title"><span class="text-wrapper"><?php _e( 'Looking for certain features', 'inspiry' ); ?></span></h5>

            <ul class="features-checkboxes-wrapper list-unstyled clearfix">
                <?php
                foreach ( $all_features as $feature ) {
                    $checked = '';
                    if ( in_array( $feature->slug, $required_features_slugs ) ) {
                        $checked = 'checked';
                    }
                    echo '<li><span class="option-set">';
                    echo '<input type="checkbox" name="features[]" id="feature-' . $feature->slug . '" value="' . $feature->slug . '" ' . $checked . ' />';
                    echo '<label for="feature-' . $feature->slug . '">' . ucwords( $feature->name ) . '<small>('. $feature->count .')</small></label>';
                    echo '</span></li>';
                }
                ?>
            </ul>

        </div>
        <!-- .extra-search-fields -->
        <?php
    }
}

?>