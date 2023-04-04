<?php
global $inspiry_options;
global $inspiry_single_property;

$number_of_similar_properties = intval( $inspiry_options[ 'inspiry_similar_properties_number' ] );
if ( empty( $number_of_similar_properties ) ) {
    $number_of_similar_properties = 3;
}

$similar_properties_args = array(
    'post_type' => 'property',
    'posts_per_page' => $number_of_similar_properties,
    'post__not_in' => array( $inspiry_single_property->get_post_ID() ),
    'post_parent__not_in' => array( $inspiry_single_property->get_post_ID() ),    // to avoid child posts from appearing in similar properties
    'orderby' => 'rand',
);

$tax_query = array();

// Main Post Property Type
$type_terms = get_the_terms( $inspiry_single_property->get_post_ID(), "property-type" );
if ( !empty( $type_terms ) && is_array( $type_terms ) ) {
    $types_array = array();
    foreach( $type_terms as $type_term ) {
        $types_array[] = $type_term->term_id;
    }
    $tax_query[] = array(
        'taxonomy'  => 'property-type',
        'field'     => 'id',
        'terms'     => $types_array
    );
}

// Main Post Property Status
$status_terms = get_the_terms( $inspiry_single_property->get_post_ID(), "property-status" );
if ( !empty( $status_terms ) && is_array( $status_terms ) ) {
    $statuses_array = array();
    foreach( $status_terms as $status_term ) {
        $statuses_array[] = $status_term->term_id;
    }
    $tax_query[] = array(
        'taxonomy' => 'property-status',
        'field' => 'id',
        'terms' => $statuses_array
    );
}

$tax_count = count( $tax_query );   // count number of taxonomies
if ( $tax_count > 1 ) {
    $tax_query['relation'] = 'OR';  // add OR relation if more than one
}

if ( $tax_count > 0 ) {
    $similar_properties_args['tax_query'] = $tax_query;   // add taxonomies query
}

$similar_properties_query = new WP_Query( $similar_properties_args );

if ( $similar_properties_query->have_posts() ) :
    ?>
    <section class="similar-properties meta-item-half clearfix">
        <div class="nav-and-title clearfix">
            <?php
            if ( !empty( $inspiry_options['inspiry_similar_properties_title'] ) ) {
                ?><h3 class="title"><?php echo wp_kses( $inspiry_options['inspiry_similar_properties_title'], array( 'span' => array() ) ); ?></h3><?php
            }
            ?>
            <div class="similar-properties-carousel-nav carousel-nav">
                <a class="carousel-prev-item prev"><?php include( get_template_directory() . '/images/svg/arrow-left.svg' ); ?></a>
                <a class="carousel-next-item next"><?php include( get_template_directory() . '/images/svg/arrow-right.svg' ); ?></a>
            </div>
        </div>

        <div class="similar-properties-carousel">
            <div class="owl-carousel">
                <?php
                while ( $similar_properties_query->have_posts() ) :
                    $similar_properties_query->the_post();
                    $similar_property = new Inspiry_Property( $post->ID );
                    ?>
                    <article class="hentry clearfix">

                        <figure class="property-thumbnail">
                            <?php inspiry_thumbnail( 'post-thumbnail' ); ?>
                        </figure>

                        <div class="property-description">
                            <div class="arrow"></div>
                            <header class="entry-header">
                                <h3 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h3>
                                <div class="price-and-status">
                                    <span class="price"><?php $similar_property->price(); ?></span><?php
                                    $first_status_term = $similar_property->get_taxonomy_first_term( 'property-status', 'all' );
                                    if ( $first_status_term ) {
                                        ?><a href="<?php echo esc_url( get_term_link( $first_status_term ) ); ?>"><span class="property-status-tag"><?php echo esc_html( $first_status_term->name ); ?></span></a><?php
                                    }
                                    ?>
                                </div>
                            </header>
                            <?php inspiry_property_meta( $similar_property, array( 'exclude' => array( 'id', 'status' ) ) ); ?>
                        </div>

                    </article>
                    <?php
                endwhile;
                ?>
            </div>
        </div>
    </section>
    <?php
endif;

wp_reset_postdata();