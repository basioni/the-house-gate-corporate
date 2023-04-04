<?php
/*
 * Template Name: Favorites
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
                            if( is_user_logged_in() ):

                                $user_id = get_current_user_id();
                                $favorite_properties = get_user_meta( $user_id, 'favorite_properties' );
                                $total_favorites = count( $favorite_properties );

                                if( $total_favorites > 0 ):

                                    global $inspiry_options;

                                    $number_of_properties = intval( $inspiry_options[ 'inspiry_favorites_properties_number' ] );
                                    if ( !$number_of_properties ) {
                                        $number_of_properties = 6;
                                    }

                                    global $paged;

                                    $favorites_properties_args = array(
                                        'post_type' => 'property',
                                        'posts_per_page' => $number_of_properties,
                                        'post__in' => $favorite_properties,
                                        'orderby' => 'post__in',
                                        'paged' => $paged,
                                    );

                                    // Apply sorting filter
                                    $favorites_properties_args = apply_filters( 'inspiry_sort_properties', $favorites_properties_args );

                                    $favorites_query = new WP_Query( $favorites_properties_args );

                                    /*
                                     * Found properties heading and sorting controls
                                     */
                                    global $found_properties;
                                    $found_properties = $favorites_query->found_posts;
                                    get_template_part( 'partials/property/templates/listing-control' );

                                    /*
                                     * Properties List
                                     */
                                    if ( $favorites_query->have_posts() ) :

                                        global $property_grid_counter;
                                        $property_grid_counter = 1;

                                        echo '<div class="row">';

                                        while ( $favorites_query->have_posts() ) :

                                            $favorites_query->the_post();

                                            // display property in grid layout
                                            get_template_part( 'partials/property/templates/property-for-grid' );

                                            $property_grid_counter++;

                                        endwhile;

                                        echo '</div>';

                                        inspiry_pagination( $favorites_query );

                                        wp_reset_postdata();

                                    endif;

                                else:

                                    inspiry_message( __( 'Oops', 'inspiry' ), __( 'You have not added any property to your favorites!', 'inspiry' ) );

                                endif;

                            else:

                                inspiry_message( __( 'Login Required', 'inspiry' ), __( 'You need to login to view your properties!', 'inspiry' ) );

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
?>