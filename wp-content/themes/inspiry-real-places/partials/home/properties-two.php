<?php
/*
 * Properties for homepage
 */

global $inspiry_options;
$number_of_properties = intval( $inspiry_options[ 'inspiry_home_properties_number_2' ] );
if( !$number_of_properties ) {
    $number_of_properties = 8;
}

$home_properties_args = array(
    'post_type' => 'property',
    'posts_per_page' => $number_of_properties,
);

$home_properties_query = new WP_Query( apply_filters( 'inspiry_home_properties', $home_properties_args ) );

// Homepage Properties Loop
if ( $home_properties_query->have_posts() ) :

?>
<div class="property-listing-two fade-in-up <?php echo inspiry_animation_class(); ?>">
    <div class="container">
        <div class="row zero-horizontal-margin">
        <?php
        $properties_count = 1;
        $columns_count = 4;   // todo: add the ability to change number of columns between 2, 3, 4

        while ( $home_properties_query->have_posts() ) :

            $home_properties_query->the_post();

            $home_property = new Inspiry_Property( get_the_ID() );
            ?>
            <div class="col-xs-6 custom-col-xs-12 col-md-4 col-lg-3 zero-horizontal-padding <?php echo inspiry_col_animation_class( $columns_count, $properties_count ) .' '. inspiry_animation_class(); ?>">
                <article class="hentry property-listing-home meta-item-half">

                    <div class="property-thumbnail">
                        <?php inspiry_thumbnail(); ?>
                    </div>
                    <!-- .property-thumbnail -->

                    <div class="property-description">
                        <header class="entry-header">
                            <h4 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php echo get_inspiry_custom_excerpt( get_the_title(), 7 ); ?></a></h4>
                            <div class="price-and-status">
                                <span class="price"><?php echo esc_html( $home_property->get_price_without_postfix() ); ?></span>
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
                        <?php inspiry_property_meta( $home_property, apply_filters( 'inspiry_home_two_properties_meta_exclude', array( 'exclude' => array( 'id', 'status', 'type' ) ) ) ); ?>
                    </div>
                    <!-- .property-description -->

                </article>
            </div>
            <?php
            /*
                if ( $number_of_properties > $properties_count ) {
                    if ( 0 == ( $properties_count % $columns_count ) ) {
                         ?></div><div class="row zero-horizontal-margin"><?php
                    }
                }
            */

            $properties_count++;

        endwhile;
        ?>
        </div>
        <!-- .row -->

    </div>
    <!-- .container -->

</div><!-- .property-listing-home -->
<?php

endif;

wp_reset_postdata();
