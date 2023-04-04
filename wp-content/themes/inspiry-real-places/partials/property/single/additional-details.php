<?php
global $inspiry_options;
global $inspiry_single_property;

$additional_details = $inspiry_single_property->get_additional_details();

if ( ! empty ( $additional_details ) and is_array( $additional_details ) ) {

    $additional_details = array_filter( $additional_details ); // remove empty values

    if ( 0 < count( $additional_details ) ) {

        echo '<div class="property-additional-details clearfix">';

        $additional_details_title = $inspiry_options[ 'inspiry_property_details_title' ];
        if( ! empty ( $additional_details_title ) ){
            echo '<h4 class="fancy-title">'.$additional_details_title.'</h4>';
        }

        echo '<ul class="property-additional-details-list clearfix">';

            foreach ( $additional_details as $key => $value ) {
                echo sprintf( "<li><dl><dt>%s</dt><dd>%s</dd></dl></li>", $key, $value );
            }

        echo '</ul>';

        echo '</div>';
    }

}
