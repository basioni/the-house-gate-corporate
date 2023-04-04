<?php
global $inspiry_options;
$number_of_featured_properties = intval( $inspiry_options[ 'inspiry_home_featured_number_3' ] );
if( !$number_of_featured_properties ) {
    $number_of_featured_properties = 2;
}

/* Featured Properties Query Arguments */
$featured_properties_args = array(
    'post_type' => 'property',
    'posts_per_page' => $number_of_featured_properties,
    'meta_query' => array(
        array(
            'key' => 'REAL_HOMES_featured',
            'value' => 1,
            'compare' => '=',
            'type'  => 'NUMERIC'
        )
    )
);

$featured_properties_query = new WP_Query( $featured_properties_args );

if ( $featured_properties_query->have_posts() ) :
?>
<div class="featured-properties-three fade-in-up <?php echo inspiry_animation_class(); ?>" >

    <div class="container">

        <?php
        if ( ! empty( $inspiry_options[ 'inspiry_home_featured_title' ] ) ) {
            ?>
            <header class="section-header">
                <h3 class="section-title"><?php echo esc_html( $inspiry_options[ 'inspiry_home_featured_title' ] ); ?></h3>
            </header>
            <?php
        }
        ?>


        <div class="row">
        <?php
        $properties_count = 1;

        // Columns
        $columns_count = 2;

        while ( $featured_properties_query->have_posts() ) :
            $featured_properties_query->the_post();

            $featured_property = new Inspiry_Property( get_the_ID() );
            ?>
            <div class="custom-col-xs-12 col-xs-6 <?php echo esc_attr( inspiry_col_animation_class( $columns_count, $properties_count ) .' '. inspiry_animation_class() ); ?>">

                <article class="hentry featured-property-post clearfix">

                    <div class="property-thumbnail">
                        <?php inspiry_thumbnail(); ?>
                        <?php
                        $first_status_term = $featured_property->get_taxonomy_first_term( 'property-status', 'all' );
                        if ( $first_status_term ) {
                            ?>
                            <a href="<?php echo esc_url( get_term_link( $first_status_term ) ); ?>">
                                <span class="property-status"><?php echo esc_html( $first_status_term->name ); ?></span>
                            </a>
                            <?php
                        }
                        ?>
                    </div>
                    <!-- .property-thumbnail -->

                    <div class="property-description">
                        <header class="entry-header">
                            <h4 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php echo get_inspiry_custom_excerpt( get_the_title(), 7 ); ?></a></h4>
                            <div class="price-and-status">
                                <span class="price"><?php echo esc_html( $featured_property->price() ); ?></span>
                            </div>
                        </header>

                        <p><?php inspiry_excerpt( 9 ); ?></p>

                        <div class="property-meta entry-meta clearfix">

                            <?php
                            /*
                             * Area
                             */
                            $inspiry_property_area = $featured_property->get_area();
                            if ( $inspiry_property_area ) {
                                ?>
                                <div class="meta-wrapper">
                                    <span class="meta-value"><?php echo esc_html( $inspiry_property_area ); ?></span>
                                    <sub class="meta-unit"><?php echo esc_html( $featured_property->get_area_postfix() ); ?></sub>
                                </div>
                                <?php
                            }

                            /*
                            * Beds
                            */
                            $inspiry_property_beds = $featured_property->get_beds();
                            if ( $inspiry_property_beds ) {
                                ?>
                                <div class="meta-wrapper">
                                    <span class="meta-value"><?php echo $inspiry_property_beds; ?></span>
                                    <span class="meta-label"><?php echo _n( 'Bed', 'Beds', $inspiry_property_beds, 'inspiry' ); ?></span>
                                </div>
                                <?php
                            }

                            /*
                             * Baths
                             */
                            $inspiry_property_baths = $featured_property->get_baths();
                            if ( $inspiry_property_baths ) {
                                ?>
                                <div class="meta-wrapper">
                                    <span class="meta-value"><?php echo $inspiry_property_baths; ?></span>
                                    <span class="meta-label"><?php echo _n( 'Bath', 'Baths', $inspiry_property_baths, 'inspiry' ); ?></span>
                                </div>
                                <?php
                            }

                            /*
                            * Garages
                            */
                            $inspiry_property_garages = $featured_property->get_garages();
                            if ( $inspiry_property_garages ) {
                                ?>
                                <div class="meta-wrapper">
                                    <span class="meta-value"><?php echo $inspiry_property_garages; ?></span>
                                    <span class="meta-label"><?php echo _n( 'Garage', 'Garages', $inspiry_property_garages, 'inspiry' ); ?></span>
                                </div>
                                <?php
                            }
                            ?>

                        </div>

                    </div>
                    <!-- .property-description -->

                </article>

            </div><!-- .featured-properties-item -->
            <?php

            $properties_count++;

        endwhile;

        wp_reset_postdata();
        ?>
        </div>
        <!-- .row -->

    </div>
    <!-- .container -->

</div><!-- .featured-properties-three -->
<?php
endif;
?>
