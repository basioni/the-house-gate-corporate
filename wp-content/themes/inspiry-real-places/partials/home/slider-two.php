<?php
/*
 * Homepage properties slider two
 */

global $inspiry_options;
$number_of_slides = intval( $inspiry_options[ 'inspiry_home_slides_number' ] );
if( !$number_of_slides ) {
    $number_of_slides = 3;
}

$slider_args = array(
    'post_type' => 'property',
    'posts_per_page' => $number_of_slides,
    'meta_query' => array(
        array(
            'key' => 'REAL_HOMES_add_in_slider',
            'value' => 'yes',
            'compare' => 'LIKE',
        )
    )
);

$slider_query = new WP_Query( apply_filters( 'inspiry_slider_two_query_args', $slider_args ) );

if ( $slider_query->have_posts() ) {
?>
<div class="homepage-slider slider-variation-two flexslider slider-loader">
    <ul class="slides">
    <?php
    while ( $slider_query->have_posts() ) {

        $slider_query->the_post();

        $slider_property = new Inspiry_Property( get_the_ID() );

        $slider_image = $slider_property->get_slider_image();

        if ( !empty( $slider_image ) ) {
            ?>
            <li>
                <div class="slide-overlay hidden-xs hidden-sm container">
                    <div class="slide-inner-container">

                        <div class="slide-header">
                            <h3 class="slide-entry-title entry-title">
                                <a href="<?php the_permalink(); ?>" rel="bookmark"><?php echo get_inspiry_custom_excerpt( get_the_title(), 6 ); ?></a>
                            </h3>
                            <div class="price-and-status">
                                <span class="price"><?php $slider_property->price(); ?></span>
                                <?php
                                $first_status_term = $slider_property->get_taxonomy_first_term( 'property-status', 'all' );
                                if ( $first_status_term ) {
                                    ?>
                                    <a href="<?php echo esc_url( get_term_link( $first_status_term ) ); ?>">
                                        <span class="property-status-tag"><?php echo esc_html( $first_status_term->name ); ?></span>
                                    </a>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>

                        <div class="meta-item-half hidden-md">
                            <?php inspiry_property_meta( $slider_property, apply_filters( 'inspiry_slider_two_meta_exclude', array( 'exclude' => array( 'id', 'status' ) ) ) ); ?>
                        </div>

                        <?php
                        if ( !empty( $inspiry_options[ 'inspiry_slide_button_text' ] ) ) {
                            ?><a class="btn-default btn-orange hidden-md" href="<?php the_permalink(); ?>"><?php echo esc_html( $inspiry_options[ 'inspiry_slide_button_text' ] ); ?><i class="fa fa-angle-right"></i></a><?php
                        }
                        ?>

                    </div>
                </div>

                <a href="<?php the_permalink(); ?>">
                    <img src="<?php echo esc_url( $slider_image ); ?>" alt="<?php the_title(); ?>" />
                </a>

            </li>
        <?php
        }
    }
    ?>
    </ul>
</div>
<?php
} else {
    get_template_part( 'partials/header/banner' );
}