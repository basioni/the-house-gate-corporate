<div class="page-listing-control clearfix">

    <div class="row">

        <div class="col-xs-6 col-lg-7">
            <?php global $found_properties; ?>
            <h3 class="heading results">
                <?php
                if ( $found_properties == 0 ) {
                    _e( 'No Property Found', 'inspiry' );
                } else {
                    printf( _n( '%d Property Found', '%d Properties Found', $found_properties, 'inspiry' ) , $found_properties );
                }
                ?>
            </h3>
        </div>

        <div class="col-xs-6 col-lg-5 page-controls-wrapper">

            <div class="sort-controls">
                <?php
                $sort_by = null;
                if ( isset( $_GET['sortby'] ) ) {
                    $sort_by = $_GET['sortby'];
                } else {
                    if ( is_page_template( 'page-templates/properties-search.php' ) ) {
                        global $inspiry_options;
                        $sort_by = $inspiry_options[ 'inspiry_search_order' ];
                    }
                }
                ?>
                <select name="sort-properties" id="sort-properties">
                    <option value="default"><?php _e('Default Order','inspiry');?></option>
                    <option value="price-asc" <?php echo ( $sort_by == 'price-asc' ) ? 'selected' : '' ; ?>><?php _e( 'Sort by Price Low to High', 'inspiry' ); ?></option>
                    <option value="price-desc" <?php echo ( $sort_by == 'price-desc' ) ? 'selected' : '' ; ?>><?php _e( 'Sort by Price High to Low', 'inspiry' ); ?></option>
                    <option value="date-asc" <?php echo ( $sort_by == 'date-asc' ) ? 'selected' : '' ; ?>><?php _e( 'Sort by Date Old to New', 'inspiry' ); ?></option>
                    <option value="date-desc" <?php echo ( $sort_by == 'date-desc' ) ? 'selected' : '' ; ?>><?php _e( 'Sort by Date New to Old', 'inspiry' ); ?></option>
                </select>
            </div>
            <!-- .sort-controls -->

        </div><!-- .page-controls-wrapper -->

    </div><!-- .row -->

</div><!-- .page-sub-header -->
