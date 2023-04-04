<?php
/*
 * Properties for homepage
 */

global $inspiry_options;
?>
<div class="property-listing-three fade-in-up <?php echo inspiry_animation_class(); ?>">
    <div class="container">
        <div class="welcome-text">
            <?php
            $inspiry_welcome_title = $inspiry_options[ 'inspiry_welcome_title' ];
            $inspiry_welcome_text  = $inspiry_options[ 'inspiry_welcome_text' ];

            // Welcome Title
            if ( ! empty( $inspiry_welcome_title ) ) {
                ?><h2 class="title"><?php echo esc_html( $inspiry_welcome_title ); ?></h2><?php
            }

            // Welcome Text
            if ( ! empty( $inspiry_welcome_text ) ) {
                ?><p><?php echo wp_kses(
                    $inspiry_welcome_text,
                    array(
                        'a' => array(
                            'href' => array(),
                            'title' => array(),
                            'target' => array(),
                        ),
                        'em' => array(),
                        'strong' => array(),
                        'br' => array(),
                    ) ); ?></p><?php
            }
            ?>
        </div>

        <?php
        $number_of_properties = intval( $inspiry_options[ 'inspiry_home_properties_number_3' ] );
        if ( !$number_of_properties ) {
            $number_of_properties = 3;
        }

        $home_properties_args = array(
        'post_type' => 'property',
        'posts_per_page' => $number_of_properties,
        );

        $home_properties_query = new WP_Query( apply_filters( 'inspiry_home_properties', $home_properties_args ) );

        // Homepage Properties Loop
        if ( $home_properties_query->have_posts() ) :
            ?>
            <div class="row">
                <?php
                $properties_count = 1;
                $columns_count = 3;

                while ( $home_properties_query->have_posts() ) :

                    $home_properties_query->the_post();

                    $home_property = new Inspiry_Property( get_the_ID() );
                    ?>
                    <div class="col-xs-6 custom-col-xs-12 col-sm-6 col-md-4 <?php echo inspiry_col_animation_class( $columns_count, $properties_count ) .' '. inspiry_animation_class(); ?>">

                        <article class="hentry property-listing-three-post image-transition ">

                            <div class="property-thumbnail">
                                <?php inspiry_thumbnail(); ?>
                                <?php
                                $first_status_term = $home_property->get_taxonomy_first_term( 'property-status', 'all' );
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
                                    <h4 class="entry-title">
                                        <a href="<?php the_permalink(); ?>" rel="bookmark"><?php echo get_inspiry_custom_excerpt( get_the_title(), 9 ); ?></a>
                                    </h4>
                                    <div class="price-and-status">
                                        <span class="price"><?php echo esc_html( $home_property->get_price() ); ?></span>
                                    </div>
                                </header>

                                <p><?php inspiry_excerpt( 12, "" ); ?></p>

                                <div class="property-meta entry-meta clearfix">
                                    <?php
                                    /*
                                     * Area
                                     */
                                    $inspiry_property_area = $home_property->get_area();
                                    if ( $inspiry_property_area ) {
                                        ?>
                                        <div class="meta-wrapper">
                                            <span class="meta-value"><?php echo esc_html( $inspiry_property_area ); ?></span>
                                            <sub class="meta-unit"><?php echo esc_html( $home_property->get_area_postfix() ); ?></sub>
                                        </div>
                                        <?php
                                    }

                                    /*
                                     * Beds
                                     */
                                    $inspiry_property_beds = $home_property->get_beds();
                                    if ( $inspiry_property_beds ) {
                                        ?>
                                        <div class="meta-wrapper">
                                            <span class="meta-value"><?php echo $inspiry_property_beds; ?></span>
                                            <span class="meta-label"><?php echo _n( 'Bed', 'Beds', $inspiry_property_beds, 'inspiry' ); ?></span>
                                        </div>
                                        <?php
                                    }

                                    /*
                                    * Beds
                                    */
                                    $inspiry_property_baths = $home_property->get_baths();
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
                                    $inspiry_property_garages = $home_property->get_garages();
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

                    </div>
                    <?php
                    $properties_count++;

                endwhile;
            ?>
            </div>
            <!-- .row -->
            <?php
        endif;

        wp_reset_postdata();
        ?>

    </div>
    <!-- .container -->

</div><!-- .property-listing-three -->
