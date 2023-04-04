<?php
/*
 * Template Name: Home
 */
get_header();

    /*
     * Homepage Slider or Banner or Google Map
     */
    global $inspiry_options;

    // For Demo Purposes
    if ( isset( $_GET['module_below_header'] ) ) {
        $inspiry_options[ 'inspiry_home_module_below_header' ] = $_GET['module_below_header'];
        if ( isset( $_GET['module_below_header'] ) ) {
            $inspiry_options[ 'inspiry_slider_type' ] = $_GET['slider_type'];
        }
    }

    if ( $inspiry_options[ 'inspiry_home_module_below_header' ] == 'slider' ) {

        /*
         * Types of slider
         */
        if ( $inspiry_options[ 'inspiry_slider_type' ] == 'revolution-slider' ) {

            $revolution_slider_alias = $inspiry_options['inspiry_revolution_slider_alias'];
            if ( function_exists( 'putRevSlider' ) && ( !empty( $revolution_slider_alias ) ) ) {
                if ( $inspiry_options[ 'inspiry_header_variation' ] == '1' ) {
                    // Image Banner should be displayed with header variation one to keep things in order
                    get_template_part( 'partials/header/banner' );
                }
                echo '<div class="inspiry-revolution-slider">';
                putRevSlider( $revolution_slider_alias );
                echo '</div>';
            } else {
                get_template_part( 'partials/header/banner' );
            }

        } elseif ( $inspiry_options[ 'inspiry_slider_type' ] == 'properties-slider-two' ) {
            get_template_part ( 'partials/home/slider-two' );
        } elseif ( $inspiry_options[ 'inspiry_slider_type' ] == 'properties-slider-three' ) {
            get_template_part ( 'partials/home/slider-three' );
        } else {
            get_template_part( 'partials/home/slider' );
        }

    } else if ( $inspiry_options[ 'inspiry_home_module_below_header' ] == 'google-map' ) {
        // Google Map
        get_template_part( 'partials/header/map' );
    } else {
        // Image Banner
        get_template_part( 'partials/header/banner' );
    }

    /*
     * Home section width
     */
    global $inspiry_home_sections_width;
    $inspiry_home_sections_width = $inspiry_options[ 'inspiry_home_sections_width' ];
    if ( !in_array( $inspiry_home_sections_width, array( 'boxed', 'wide' ) ) ) {
        $inspiry_home_sections_width = 'wide';
    }
    ?>
    <div id="content-wrapper" class="site-content-wrapper">

        <div id="content" class="site-content layout-<?php echo esc_attr( $inspiry_home_sections_width ); ?>">

            <main id="main" class="site-main">

                <?php
                if ( $inspiry_options[ 'inspiry_home_search' ] && $inspiry_options[ 'inspiry_header_variation' ] != '1' ) {
                    get_template_part( 'partials/home/search' );
                }

                // Homepage Layout Manager
                $enabled_sections = $inspiry_options['inspiry_home_sections']['enabled'];

                if ( $enabled_sections ) {
                    foreach ($enabled_sections as $key => $val  ) {

                        switch( $key ) {

                            // Home page contents from page editor
                            case 'content':
                                if ( have_posts() ):
                                    while ( have_posts() ):
                                        the_post();
                                        $content = get_the_content();
                                        if ( !empty( $content ) ) {
                                            ?>
                                            <article id="post-<?php the_ID(); ?>" <?php post_class( 'clearfix' ); ?> >
                                                <div class="entry-content clearfix">
                                                    <?php the_content(); ?>
                                                </div>
                                            </article>
                                            <?php
                                        }
                                    endwhile;
                                endif;
                                break;

                            /*
                            * Home Properties
                            */
                            case 'properties':
                                if ( isset( $inspiry_options[ 'inspiry_home_properties_variation' ] ) && ( $inspiry_options[ 'inspiry_home_properties_variation' ] == 2 ) ) {
                                    get_template_part( 'partials/home/properties-two' );
                                } elseif ( isset( $inspiry_options[ 'inspiry_home_properties_variation' ] ) && ( $inspiry_options[ 'inspiry_home_properties_variation' ] == 3 ) ) {
                                    get_template_part( 'partials/home/properties-three' );
                                } else {
                                    get_template_part( 'partials/home/properties' );
                                }
                                break;

                            /*
                             * How it works
                             */
                            case 'how-it-works':
                                get_template_part( 'partials/home/how-it-works' );
                                break;

                            /*
                             * Featured properties
                             */
                            case 'featured':
                                if ( $inspiry_options[ 'inspiry_home_featured_variation' ] == 2 ) {
                                    get_template_part( 'partials/home/featured-two' );
                                } elseif ( $inspiry_options[ 'inspiry_home_featured_variation' ] == 3 ) {
                                    get_template_part( 'partials/home/featured-three' );
                                } else {
                                    get_template_part( 'partials/home/featured' );
                                }
                                break;

                            /*
                             * Partners
                             */
                            case 'partners':
                                get_template_part( 'partials/home/partners' );
                                break;

                            /*
                             * News
                             */
                            case 'news':
                                get_template_part( 'partials/home/news' );
                                break;

                        }

                    }
                }
                ?>


            </main>
            <!-- .site-main -->

        </div>
        <!-- .site-content -->

    </div><!-- .site-content-wrapper -->
    <?php

get_footer();