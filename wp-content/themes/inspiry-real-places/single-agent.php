<?php
/*
 * Single agent page
 */
get_header();

get_template_part( 'partials/header/banner' );
?>
    <div id="content-wrapper" class="site-content-wrapper site-pages">

        <div id="content" class="site-content layout-boxed">

            <div class="container">

                <div class="row">

                    <div class="col-xs-12 site-main-content">

                        <main id="main" class="site-main">

                            <?php
                            if ( have_posts() ) :
                                while ( have_posts() ) :
                                    the_post();
                                    ?>
                                    <article class="agent-single-post clearfix hentry">

                                        <div class="agent-content-wrapper agent-common-styles clearfix">
                                            <div class="row">
                                                <div class="col-md-5 col-sm-6">
                                                    <?php get_template_part( 'partials/agent/single/agent-info' ); ?>
                                                </div>

                                                <div class="col-md-7 col-sm-6">
                                                    <?php get_template_part( 'partials/agent/single/contact-form' ); ?>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="entry-content clearfix">
                                            <?php the_content(); ?>
                                        </div>

                                    </article>
                                    <!-- .agent-single-post -->
                                    <?php
                                endwhile;
                            endif;


                            /*
                             * Properties Query
                             */
                            global $paged;
                            $properties_list_arg = array(
                                'post_type' => 'property',
                                'posts_per_page' => 6,
                                'paged' => $paged,
                                'meta_query' => array(
                                    array(
                                        'key' => 'REAL_HOMES_agents',
                                        'value' => get_the_ID(),            // agent id
                                        'compare' => '='
                                    )
                                ),
                                'orderby'   => 'meta_value_num',
                                'meta_key'  => 'REAL_HOMES_property_price',
                                'order'     => 'ASC',
                            );

                            $properties_list_query = new WP_Query( $properties_list_arg );

                            /*
                             * Properties list based on current agent.
                             */
                            if ( $properties_list_query->have_posts() ) :

                                ?><h3 class="agent-properties-list-heading"><?php _e( 'Properties by', 'inspiry' ); ?><span class="property-posted-by"> <?php the_title(); ?></span></h3><?php

                                global $property_list_counter;
                                $property_list_counter = 1;

                                while ( $properties_list_query->have_posts() ) :

                                    $properties_list_query->the_post();

                                    // display property in list layout
                                    get_template_part( 'partials/property/templates/property-for-list' );

                                    $property_list_counter++;

                                endwhile;

                                inspiry_pagination( $properties_list_query );

                                wp_reset_postdata();

                            endif;
                            ?>

                        </main>
                        <!-- .site-main -->

                    </div>
                    <!-- .site-main-content -->

                </div>
                <!-- .row -->

            </div>
            <!-- .container -->

        </div>
        <!-- .site-content -->

    </div><!-- .site-content-wrapper -->

<?php
get_footer();