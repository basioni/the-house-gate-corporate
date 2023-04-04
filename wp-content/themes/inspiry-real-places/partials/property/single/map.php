<section class="property-location-section clearfix">
    <?php
    global $inspiry_options;
    if ( !empty( $inspiry_options[ 'inspiry_property_map_title' ] ) ) {
        ?><h4 class="fancy-title"><?php echo esc_html( $inspiry_options[ 'inspiry_property_map_title' ] ); ?></h4><?php
    }

    global $inspiry_single_property;
    $property_marker = array();

    $property_marker['lat'] = $inspiry_single_property->get_latitude();
    $property_marker['lang'] = $inspiry_single_property->get_longitude();

    /*
     * Property Map Icon Based on Property Type
     */
    $property_type_slug = $inspiry_single_property->get_taxonomy_first_term( 'property-type', 'slug' );
    if ( !empty( $property_type_slug ) ) {
        $property_type_slug = 'single-family-home'; // Default Icon Slug
    }

    $template_dir = get_template_directory();
    $template_dir_uri = get_template_directory_uri();
    $base_icon_path = $template_dir .'/images/map/' . $property_type_slug;
    $base_icon_uri = $template_dir_uri .'/images/map/' . $property_type_slug;

    if ( file_exists( $base_icon_path .'-map-icon.png' ) ) {
        $property_marker['icon'] = $base_icon_uri . '-map-icon.png';
        if( file_exists( $base_icon_path . '-map-icon@2x.png' ) ) {
            $property_marker['retinaIcon'] = $base_icon_uri . '-map-icon@2x.png';   // retina icon
        }
    } else {
        $property_marker['icon'] = $base_icon_uri . '-map-icon.png';           // default icon
        $property_marker['retinaIcon'] = $base_icon_uri . '-map-icon@2x.png';  // default retina icon
    }

    ?>

    <div id="property-map"></div>

    <script type="text/javascript">

        /* Property Detail Page - Google Map for Property Location */

        function initialize_property_map(){

            var propertyMarkerInfo = <?php echo json_encode( $property_marker ); ?>

            var url = propertyMarkerInfo.icon;
            var size = new google.maps.Size( 42, 57 );

            // retina
            if( window.devicePixelRatio > 1.5 ) {
                if ( propertyMarkerInfo.retinaIcon ) {
                    url = propertyMarkerInfo.retinaIcon;
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

            var propertyLocation = new google.maps.LatLng( propertyMarkerInfo.lat, propertyMarkerInfo.lang );
            var propertyMapOptions = {
                center: propertyLocation,
                zoom: 15,
                mapTypeId: google.maps.MapTypeId.ROADMAP,
                scrollwheel: false
            };
            var propertyMap = new google.maps.Map( document.getElementById( "property-map" ), propertyMapOptions );
            var propertyMarker = new google.maps.Marker({
                position: propertyLocation,
                map: propertyMap,
                icon: image
            });
        }

        window.onload = initialize_property_map();

    </script>

</section>