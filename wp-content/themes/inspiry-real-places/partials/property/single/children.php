<?php
/*
 * Children Properties ( Also known as Sub Properties )
 */
global $post;

$property_children_args = array(
    'post_type'         => 'property',
    'posts_per_page'    => 50,      // 50 is just a decent and efficient alternative of -1 ( which means all )
    'post_parent'       => $post->ID,
);

$child_properties_query = new WP_Query( $property_children_args );

if ( $child_properties_query->have_posts() ) :
    ?>
    <div class="sub-properties">
        <?php
        global $inspiry_options;
        if ( !empty( $inspiry_options[ 'inspiry_property_children_title' ] ) ) {
            ?><h4 class="fancy-title"><?php echo esc_html( $inspiry_options[ 'inspiry_property_children_title' ] ); ?></h4><?php
        }

        while ( $child_properties_query->have_posts() ) :
            $child_properties_query->the_post();

            $child_property = new Inspiry_Property( get_the_ID() );
            ?>
            <article class="property-listing-simple property-listing-simple-2 meta-item-half hentry clearfix">

                <div class="property-thumbnail col-sm-5 zero-horizontal-padding">
                    <div class="price-wrapper">
                        <span class="price"><?php $child_property->price(); ?></span>
                    </div>
                    <?php inspiry_thumbnail( 'inspiry-grid-thumbnail' ); ?>
                </div>

                <div class="title-and-meta col-sm-7">
                    <header class="entry-header">
                        <h3 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h3>
                    </header>
                    <?php inspiry_property_meta( $child_property, array( 'exclude' => array( 'id' ) ) ); ?>
                </div>

            </article>
            <?php

        endwhile;

        // reset to default query
        wp_reset_postdata();

        ?>
    </div><!-- .sub-properties -->
    <?php

endif;