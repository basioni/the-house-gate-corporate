<?php
global $inspiry_options;
// number of locations chosen from theme options
$location_select_count = inspiry_get_locations_number();
$location_select_names = inspiry_get_location_select_names();
$location_titles = inspiry_get_location_titles( $location_select_count );

// override select boxes titles based on theme options data
for ( $i = 1; $i <= $location_select_count; $i++  ) {
    $temp_location_title = $inspiry_options[ 'inspiry_search_location_title_' . $i  ];
    if( !empty( $temp_location_title ) ) {
        $location_titles[ $i - 1 ] = $temp_location_title;
    }
}

// Generate required location select boxes
for( $i=0; $i < $location_select_count; $i++ ) {
    ?>
    <div class="option-bar col-xs-12 property-location">
        <select name="<?php echo esc_attr( $location_select_names[$i] ); ?>" id="<?php echo esc_attr( $location_select_names[$i] );  ?>" data-title="<?php echo esc_attr( $location_titles[$i] ); ?>" class="search-select">
            <option value="any"><?php echo esc_html( $location_titles[$i] ) . ' ' . __( '(Any)', 'inspiry' ); ?></option>
        </select>
    </div>
    <?php
}

/* important action hook - related JS works based on it */
do_action( 'inspiry_after_location_fields' );

?>