<?php
global $inspiry_options;

// Search Fields
$search_fields = $inspiry_options['inspiry_search_fields']['enabled'];
$search_page = $inspiry_options['inspiry_search_page'];     // search page id

if ( ( 0 < count( $search_fields ) ) && ( !empty( $search_page ) ) ) {

    // If WPML is installed then this function will return translated page id for current language against given page id
    $search_page = inspiry_wpml_translated_page_id ( $search_page );

    ?>
    <form class="advance-search-form" action="<?php echo get_permalink( $search_page ); ?>" method="get">
        <?php
        foreach ($search_fields as $key => $val  ) {

            switch( $key ) {

                case 'keyword':
                    get_template_part( 'partials/search/fields/keyword' );
                    break;

                case 'location':
                    get_template_part( 'partials/search/fields/locations' );
                    break;

                case 'status':
                    get_template_part( 'partials/search/fields/property-status' );
                    break;

                case 'type':
                    get_template_part( 'partials/search/fields/property-type' );
                    break;

                case 'min-beds':
                    get_template_part( 'partials/search/fields/beds' );
                    break;

                case 'min-baths':
                    get_template_part( 'partials/search/fields/baths' );
                    break;

                case 'min-max-price':
                    get_template_part( 'partials/search/fields/min-price' );
                    get_template_part( 'partials/search/fields/max-price' );
                    break;

                case 'min-max-area':
                    get_template_part( 'partials/search/fields/min-area' );
                    get_template_part( 'partials/search/fields/max-area' );
                    break;

                case 'property-id':
                    get_template_part( 'partials/search/fields/property-id' );
                    break;

            }
        }

        // Submit Button
        get_template_part( 'partials/search/fields/submit-btn' );

        // Features
        if ( $inspiry_options['inspiry_search_features'] ) {
            get_template_part( 'partials/search/fields/features' );
        }

        // generated sort by field
        if ( isset( $_GET['sortby'] ) ) {
            echo '<input type="hidden" name="sortby" value="' . $_GET['sortby'] . '" />';
        }
    ?>
    </form><!-- .advance-search-form -->
    <?php
}