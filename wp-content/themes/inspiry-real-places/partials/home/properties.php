<?php
/*
 * Properties for homepage
 */

global $inspiry_options;
$number_of_properties = intval( $inspiry_options[ 'inspiry_home_properties_number_1' ] );
if( !$number_of_properties ) {
    $number_of_properties = 4;
}

$home_properties_args = array(
    'post_type' => 'property',
    'posts_per_page' => $number_of_properties,
);

$home_properties_query = new WP_Query( apply_filters( 'inspiry_home_properties', $home_properties_args ) );

// Homepage Properties Loop
if ( $home_properties_query->have_posts() ) :

    $properties_count = 1;

    $gallery_enabled = $inspiry_options[ 'inspiry_home_properties_gallery' ];
    $gallery_limit = 3;

    if ( $gallery_enabled ) {
        $gallery_limit =  intval( $inspiry_options[ 'inspiry_home_properties_gallery_limit' ] );
    }
    ?>
    <div class="container fade-in-up <?php echo inspiry_animation_class(); ?>">
        <div class="row row-odd zero-horizontal-margin">
        <?php

        while ( $home_properties_query->have_posts() ) :

            $home_properties_query->the_post();

            $home_property = new Inspiry_Property( get_the_ID() );

            $even_odd_class = 'property-post-odd';
            if ( $properties_count % 2 == 0) {
                $even_odd_class = 'property-post-even';
            }
            ?>
            <div class="col-xs-6 custom-col-xs-12">

                <article class="row hentry property-listing-home property-listing-one meta-item-half <?php echo esc_attr( $even_odd_class ); ?>">

                    <div class="property-thumbnail zero-horizontal-padding col-lg-6">
                        <?php
                        if ( $gallery_enabled ) {
                            inspiry_property_gallery( $home_property->get_post_ID(), $gallery_limit );
                        } else {
                            inspiry_thumbnail();
                        }
                        ?>
                    </div>
                    <!-- .property-thumbnail -->

                    <div class="property-description clearfix col-lg-6">
                        <header class="entry-header">
                            <h3 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h3>
                            <div class="price-and-status">
                                <span class="price"><?php $home_property->price(); ?></span>
                                <?php
                                $first_status_term = $home_property->get_taxonomy_first_term( 'property-status', 'all' );
                                if ( $first_status_term ) {
                                    ?>
                                    <a href="<?php echo esc_url( get_term_link( $first_status_term ) ); ?>">
                                        <span class="property-status-tag"><?php echo esc_html( $first_status_term->name ); ?></span>
                                    </a>
                                    <?php
                                }
                                ?>
                            </div>
                        </header>
                        <?php inspiry_property_meta( $home_property, array( 'exclude' => array( 'id', 'status', 'type' ) ) ); ?>
                    </div>
                    <!-- .property-description -->

                </article>
                <!-- .property-post-odd -->

            </div>
            <?php
            /*
             * odd and even rows
             */
            if ( $number_of_properties > $properties_count ) {
                if ( 0 == ( $properties_count % 4 ) ) {
                    ?></div><div class="row row-odd zero-horizontal-margin"><?php
                } elseif ( 0 == ( $properties_count % 2 ) ) {
                    ?></div><div class="row row-even zero-horizontal-margin"><?php
                }
            }

            $properties_count++;

        endwhile;
        ?>
        </div>
        <!-- end of row -->

    </div>
    <?php

endif;

wp_reset_postdata();