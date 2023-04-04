<?php
global $inspiry_options;
global $post;

$grid_property = new Inspiry_Property( get_the_ID() );

?>
<div class="col-xs-6 col-md-4 col-grid-post">

    <article class="property-listing-grid post-for-grid hentry clearfix">

        <div class="property-thumbnail">
            <?php
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

                <?php
                /*
                 * Property Type
                 */
                $first_type_term = $grid_property->get_taxonomy_first_term( 'property-type', 'all' );
                if ( $first_type_term ) {
                    ?><p class="property-type"><?php echo esc_html( $first_type_term->name ); ?></p><?php
                }
                ?>

                <div class="price-and-status-wrapper clearfix">

                    <div class="price-wrapper">
                        <span class="price"><?php $grid_property->price() ?></span>
                    </div>

                    <?php
                    /*
                     * Property Status
                     */
                    $first_status_term = $grid_property->get_taxonomy_first_term( 'property-status', 'all' );
                    if ( $first_status_term ) {
                        ?>
                        <div class="status-tag-wrapper">
                            <a href="<?php echo esc_url( get_term_link( $first_status_term ) ); ?>">
                                <span class="property-status-tag"><?php echo esc_html( $first_status_term->name ); ?></span>
                            </a>
                        </div>
                        <?php
                    }
                    ?>

                </div>

            </header>

        </div>
        <!-- .title-and-meta -->

    </article>
    <!-- .property-listing-page -->

</div><!-- .col-grid-post -->


