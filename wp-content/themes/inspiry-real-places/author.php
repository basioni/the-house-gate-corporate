<?php
/*
 * Single agent page
 */
get_header();

get_template_part( 'partials/header/banner' );

global $wp_query;
global $current_author;
$current_author = $wp_query->get_queried_object();
global $current_author_meta;
$current_author_meta = get_user_meta( $current_author->ID );
?>
    <div id="content-wrapper" class="site-content-wrapper site-pages">

        <div id="content" class="site-content layout-boxed">

            <div class="container">

                <div class="row">

                    <div class="col-xs-12 site-main-content">

                        <main id="main" class="site-main">

                            <article class="agent-single-post clearfix hentry">

                                <div class="agent-content-wrapper agent-common-styles clearfix">
                                    <div class="row">
                                        <div class="col-md-5 col-sm-6">
                                            <?php get_template_part( 'partials/common/author-info' ); ?>
                                        </div>

                                        <div class="col-md-7 col-sm-6">
                                            <?php get_template_part( 'partials/agent/single/contact-form' ); ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="entry-content clearfix">
                                    <?php
                                    /*
                                     * Author Description
                                     */
                                    if( isset( $current_author_meta['description'] ) && !empty( $current_author_meta['description'][0] ) ) {
                                        echo wpautop( $current_author_meta['description'][0] );
                                    }
                                    ?>
                                </div>

                            </article>
                            <!-- .agent-single-post -->

                            <?php

                            /*
                             * Properties Query
                             */

                            $properties_list_arg = array(
                                'post_type' => 'property',
                                'posts_per_page' => -1,
                                'author' => $current_author->ID,
                            );

                            $properties_list_query = new WP_Query( $properties_list_arg );

                            /*
                             * Properties list based on current agent.
                             */

                            if ( $properties_list_query->have_posts() ) :

                                ?><h3 class="agent-properties-list-heading"><?php _e( 'Properties by', 'inspiry' ); ?><span class="property-posted-by"> <?php echo esc_html( $current_author->display_name ); ?></span></h3><?php

                                global $property_list_counter;
                                $property_list_counter = 1;

                                while ( $properties_list_query->have_posts() ) :

                                    $properties_list_query->the_post();

                                    // display property in list layout
                                    get_template_part( 'partials/property/templates/property-for-list' );

                                    $property_list_counter++;

                                endwhile;

                                // inspiry_pagination( $properties_list_query );

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