<?php
/*
 * Google Map with Properties Markers
 */
global $inspiry_options;

// Image Banner should be displayed with header variation one to keep things in order
if ( $inspiry_options[ 'inspiry_header_variation' ] == '1' ) {
    get_template_part( 'partials/header/banner' );
}

$map_args = array(
                    'post_type' => 'property',
                    'posts_per_page' => -1
                );

if( is_page_template( 'page-templates/properties-search.php' ) ){

    // Apply Search Filter
    $map_args = apply_filters( 'inspiry_property_search', $map_args );

} elseif ( is_page_template( 'page-templates/home.php' ) ) {

    // Apply Homepage Properties Filter
    $map_args = apply_filters( 'inspiry_home_properties', $map_args );

} elseif ( is_page_template( 'page-templates/properties-list.php' )
            || is_page_template( 'page-templates/properties-list-with-sidebar.php' )
            || is_page_template( 'page-templates/properties-grid.php' )
            || is_page_template( 'page-templates/properties-grid-with-sidebar.php' ) ) {


    global $paged;
    if ( is_front_page() ) {
        $paged = ( get_query_var('page') ) ? get_query_var( 'page' ) : 1;
    }

    $map_args = array(
        'post_type'         => 'property',
        'paged'             => $paged,
    );

    // Apply Properties Filter
    $map_args = apply_filters( 'inspiry_properties_filter', $map_args );
    $map_args = apply_filters( 'inspiry_sort_properties', $map_args );

} elseif ( is_tax() ) {

    global $wp_query;
    /* Taxonomy Query */
    $map_args['tax_query'] = array(
                                    array(
                                        'taxonomy' => $wp_query->query_vars['taxonomy'],
                                        'field' => 'slug',
                                        'terms' => $wp_query->query_vars['term']
                                    )
                                );

}

$map_query = new WP_Query( $map_args );

$properties_data = array();

if ( $map_query->have_posts() ) :

    while ( $map_query->have_posts() ) :

        $map_query->the_post();

        $map_property = new Inspiry_Property( get_the_ID() );

        $current_prop_array = array();

        // Property Title
        $current_prop_array['title'] = get_the_title();

        // Property Price
        $current_prop_array['price'] = $map_property->get_price();

        // Property Location
        $property_location = $map_property->get_location();
        if( !empty( $property_location ) ) {
            $current_prop_array['lat'] = $map_property->get_latitude();
            $current_prop_array['lng'] = $map_property->get_longitude();
        }

        // Property Thumbnail
        if( has_post_thumbnail() ) {
            $image_id = get_post_thumbnail_id();
            $image_attributes = wp_get_attachment_image_src( $image_id, 'post-thumbnail' );
            if( !empty( $image_attributes[0] ) ) {
                $current_prop_array[ 'thumb' ] = $image_attributes[0];
            }
        }

        // Property Permalink
        $current_prop_array['url'] = get_permalink();

        // Property Map Icon Based on Property Type
        $property_type_slug = 'single-family-home'; // Default Icon Slug
        $temp_property_type_slug = $map_property->get_taxonomy_first_term( 'property-type', 'slug' );
        if ( !empty( $temp_property_type_slug ) ) {
            $property_type_slug = $temp_property_type_slug;
        }


        if( file_exists( get_template_directory() . '/images/map/' . $property_type_slug . '-map-icon.png' ) ) {
            $current_prop_array['icon'] = get_template_directory_uri() . '/images/map/' . $property_type_slug . '-map-icon.png';
            // retina icon
            if( file_exists( get_template_directory() . '/images/map/' . $property_type_slug . '-map-icon@2x.png' ) ) {
                $current_prop_array['retinaIcon'] = get_template_directory_uri() . '/images/map/' . $property_type_slug . '-map-icon@2x.png';
            }
        } else {
            $current_prop_array['icon'] = get_template_directory_uri() . '/images/map/single-family-home-map-icon.png';   // default icon
            $current_prop_array['retinaIcon'] = get_template_directory_uri() . '/images/map/single-family-home-map-icon@2x.png';  // default retina icon
        }

        $properties_data[] = $current_prop_array;
        
    endwhile;

    wp_reset_postdata();

    ?>
    <script type="text/javascript">
        function initializePropertiesMap() {

            // Properties Array
            var properties = <?php echo json_encode( $properties_data ); ?>

            var mapOptions = {
                zoom: 12,
                maxZoom: 16,
                scrollwheel: false
            };

            var map = new google.maps.Map( document.getElementById( "listing-map" ), mapOptions );

            var bounds = new google.maps.LatLngBounds();

            // Loop to generate marker and infowindow based on properties array
            var markers = new Array();

            for ( var i=0; i < properties.length; i++ ) {

                var url = properties[i].icon;
                var size = new google.maps.Size( 42, 57 );
                if( window.devicePixelRatio > 1.5 ) {
                    if ( properties[i].retinaIcon ) {
                        url = properties[i].retinaIcon;
                        size = new google.maps.Size( 83, 113 );
                    }
                }

                var image = {
                    url: url,
                    size: size,
                    scaledSize: new google.maps.Size( 42, 57 ),
                    origin: new google.maps.Point( 0, 0 ),
                    anchor: new google.maps.Point( 21, 56 )
                };

                markers[i] = new google.maps.Marker({
                    position: new google.maps.LatLng( properties[i].lat, properties[i].lng ),
                    map: map,
                    icon: image,
                    title: properties[i].title,
                    animation: google.maps.Animation.DROP,
                    visible: true
                });

                bounds.extend( markers[i].getPosition() );

                var boxText = document.createElement( "div" );
                boxText.className = 'map-info-window';
                boxText.innerHTML = '<a class="thumb-link" href="' + properties[i].url + '">' +
                                        '<img class="prop-thumb" src="' + properties[i].thumb + '" alt="' + properties[i].title + '"/>' +
                                    '</a>' +
                                    '<h5 class="prop-title"><a class="title-link" href="' + properties[i].url + '">' + properties[i].title + '</a></h5>' +
                                    '<p><span class="price">' + properties[i].price + '</span></p>' +
                                    '<div class="arrow-down"></div>';


                var myOptions = {
                    content: boxText,
                    disableAutoPan: true,
                    maxWidth: 0,
                    alignBottom: true,
                    pixelOffset: new google.maps.Size( -122, -48 ),
                    zIndex: null,
                    closeBoxMargin: "0 0 -16px -16px",
                    closeBoxURL: "<?php echo get_template_directory_uri() . '/images/map/close.png'; ?>",
                    infoBoxClearance: new google.maps.Size( 1, 1 ),
                    isHidden: false,
                    pane: "floatPane",
                    enableEventPropagation: false
                };

                var ib = new InfoBox( myOptions );

                attachInfoBoxToMarker( map, markers[i], ib );
            }

            map.fitBounds(bounds);

            /* Marker Clusters */
            var markerClustererOptions = {
                ignoreHidden: true,
                maxZoom: 14,
                styles: [{
                    textColor: '#ffffff',
                    url: "<?php echo get_template_directory_uri() . '/images/map/cluster-icon.png'; ?>",
                    height: 48,
                    width: 48
                }]
            };

            var markerClusterer = new MarkerClusterer( map, markers, markerClustererOptions );

            function attachInfoBoxToMarker( map, marker, infoBox ){
                google.maps.event.addListener( marker, 'click', function(){
                    var scale = Math.pow( 2, map.getZoom() );
                    var offsety = ( (100/scale) || 0 );
                    var projection = map.getProjection();
                    var markerPosition = marker.getPosition();
                    var markerScreenPosition = projection.fromLatLngToPoint( markerPosition );
                    var pointHalfScreenAbove = new google.maps.Point( markerScreenPosition.x, markerScreenPosition.y - offsety );
                    var aboveMarkerLatLng = projection.fromPointToLatLng( pointHalfScreenAbove );
                    map.setCenter( aboveMarkerLatLng );
                    infoBox.open( map, marker );
                });
            }

        }

        google.maps.event.addDomListener( window, 'load', initializePropertiesMap );

    </script>

    <?php
    $map_class = 'header-two';
    if ( $inspiry_options[ 'inspiry_header_variation' ] == '1' ) {
        $map_class = 'header-one';
    }
    ?>
    <div id="map-head" class="<?php echo esc_attr( $map_class ); ?>">
        <div id="listing-map"></div>
    </div>
    <!-- End Map Head -->

    <?php
else:

    if ( $inspiry_options[ 'inspiry_header_variation' ] != '1' ) {
        // Image Banner
        get_template_part( 'partials/header/banner' );
    }

endif;