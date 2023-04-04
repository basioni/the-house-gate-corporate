<?php
global $inspiry_options;
$grid_property = new Inspiry_Property( get_the_ID() );
?>
<div class="col-xs-6 col-md-4 col-grid-post">

    <article class="property-listing-grid post-for-grid hentry clearfix">

        <div class="property-thumbnail">
            <?php
            /*
             * Property Status
             */
            $first_status_term = $grid_property->get_taxonomy_first_term( 'property-status', 'all' );
            if ( $first_status_term ) {
                ?>
                <div class="status-tag-wrapper">
                    <a href="<?php echo esc_url( get_term_link( $first_status_term ) ); ?>">
                        <span class="property-status-tag-flipped"><?php echo esc_html( $first_status_term->name ); ?></span>
                    </a>
                </div>
                <?php
            }

            /*
             * Remove from favorites - only for favorites page template
             */
            if( is_page_template( 'page-templates/favorites.php' ) && is_user_logged_in() ) {
                ?>
                <div class="trash-favorite">
                    <a class="remove-from-favorite"
                       data-property-id="<?php the_ID(); ?>"
                       href="<?php echo admin_url('admin-ajax.php'); ?>"
                       title="<?php _e( 'Remove from favorites', 'inspiry' ); ?>">
                        <i class="fa fa-trash-o"></i>
                    </a>
                    <span class="loader"><i class="fa fa-spinner fa-spin"></i></span>
                </div>
                <?php
            }

            /*
             * Display image gallery or thumbnail
             */
            if ( $inspiry_options[ 'inspiry_property_card_gallery' ] ) {
                inspiry_property_gallery( $grid_property->get_post_ID(), intval( $inspiry_options[ 'inspiry_property_card_gallery_limit' ] ) );
            } else {
                inspiry_thumbnail();
            }
            ?>
        </div>

        <div class="title-and-meta">

            <header class="entry-header">
                <h3 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h3>
                <div class="clearfix">
                    <?php
                    /*
                     * Address
                     */
                    $grid_property_address = $grid_property->get_address();
                    if ( !empty( $grid_property_address ) ) {
                        ?><p class="property-address"><i class="fa fa-map-marker"></i><?php echo esc_html( $grid_property_address ); ?></p><?php
                    }
                    ?>
                    <div class="price-wrapper">
                        <span class="price"><?php $grid_property->price(); ?></span>
                    </div>
                </div>
            </header>

            <div class="property-meta entry-meta clearfix">

                <?php
                /*
                 * Beds
                 */
                $inspiry_property_beds = $grid_property->get_beds();
                if ( $inspiry_property_beds ) {
                    ?>
                    <div class="meta-item">
                        <i class="meta-item-icon icon-bed"><?php include( get_template_directory() . '/images/svg/icon-bed.svg' ); ?></i>
                        <span><?php printf( __( '%d Beds', 'inspiry' ) , $inspiry_property_beds ); ?></span>
                    </div>
                    <?php
                }

                /*
                 * Baths
                 */
                $inspiry_property_baths = $grid_property->get_baths();
                if ( $inspiry_property_baths ) {
                    ?>
                    <div class="meta-item">
                        <i class="meta-item-icon icon-bath"><?php include( get_template_directory() . '/images/svg/icon-bath.svg' ); ?></i>
                        <span><?php printf( __( '%d Baths', 'inspiry' ) , $inspiry_property_baths ); ?></span>
                    </div>
                    <?php
                }

                /*
                 * Area
                 */
                $inspiry_property_area = $grid_property->get_area();
                if ( $inspiry_property_area ) {
                    ?>
                    <div class="meta-item">
                        <i class="meta-item-icon icon-area"><?php include( get_template_directory() . '/images/svg/icon-area.svg' ); ?></i>
                        <span><?php echo esc_html( $inspiry_property_area . ' ' . $grid_property->get_area_postfix() ); ?></span>
                    </div>
                    <?php
                }
                ?>

            </div>

        </div><!-- .title-and-meta -->

    </article><!-- .property-listing-page -->

</div><!-- .col-grid-post -->



