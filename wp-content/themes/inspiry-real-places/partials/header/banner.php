<?php
/*
 * Banner Area
 */

global $inspiry_options;
$inspiry_banner_title = null;
$inspiry_banner_sub_title = null;
$revolution_slider_alias = null;
$skip_banner = false;


if ( is_page_template( 'page-templates/home.php' ) ) {      // Home page
    // leave empty

} elseif ( is_page_template( 'page-templates/properties-search.php' ) ) {   // Search page

    if ( $inspiry_options[ 'inspiry_search_module_below_header' ] != 'google-map' ) {
        // initial work for revolution slider
        $revolution_slider_alias = get_post_meta( get_the_ID(), 'REAL_HOMES_rev_slider_alias', true );
        if ( function_exists( 'putRevSlider' ) && ( !empty( $revolution_slider_alias ) ) ) {
            if ( $inspiry_options[ 'inspiry_header_variation' ] != '1' ) {
                $skip_banner = true;    // skip revolution slider if header variation is not 1
            }
        } else {
            $inspiry_banner_title = get_the_title();
        }
    } else {
        if ( $inspiry_options[ 'inspiry_header_variation' ] != '1' ) {
            $inspiry_banner_title = get_the_title();
        }
    }
} elseif ( is_home() ) {

    $blog_page_id = get_option('page_for_posts');
    if ( $blog_page_id ) {
        $revolution_slider_alias = get_post_meta( $blog_page_id, 'REAL_HOMES_rev_slider_alias', true );
        if ( function_exists( 'putRevSlider' ) && ( !empty( $revolution_slider_alias ) ) ) {
            if ( $inspiry_options[ 'inspiry_header_variation' ] != '1' ) {
                $skip_banner = true;    // skip revolution slider if header variation is not 1
            }
        } else {
            $inspiry_banner_title = get_the_title( $blog_page_id );
        }
    }

} elseif ( is_page() || is_singular( 'agent' ) ) {

    // display map is priority and if map is being displayed then revolution slider cannot be displayed
    $display_google_map = get_post_meta( get_the_ID(), 'inspiry_display_google_map', true );
    if ( !$display_google_map ) {

        // initial work for revolution slider
        $revolution_slider_alias = get_post_meta( get_the_ID(), 'REAL_HOMES_rev_slider_alias', true );
        if ( function_exists( 'putRevSlider' ) && ( !empty( $revolution_slider_alias ) ) ) {
            if ( $inspiry_options[ 'inspiry_header_variation' ] != '1' ) {
                $skip_banner = true;    // skip revolution slider if header variation is not 1
            }
        } else {
            $inspiry_banner_title = get_the_title();
        }
    }

} elseif ( is_singular( 'post' ) ) {

    $revolution_slider_alias = get_post_meta( get_the_ID(), 'REAL_HOMES_rev_slider_alias', true );
    if ( function_exists( 'putRevSlider' ) && ( !empty( $revolution_slider_alias ) ) ) {
        if ( $inspiry_options[ 'inspiry_header_variation' ] != '1' ) {
            $skip_banner = true;    // skip revolution slider if header variation is not 1
        }
    } else {
        $inspiry_banner_title = apply_filters( 'the_title', get_the_title( get_option( 'page_for_posts' ) ) );
    }

} elseif ( is_single() ) {
    $inspiry_banner_title = get_the_title();

} elseif ( is_search() ) {
    $inspiry_banner_title = sprintf( __( 'Search Results for: %s', 'inspiry' ), get_search_query() );

} elseif ( is_author() ) {
    global $wp_query;
    $current_author = $wp_query->get_queried_object();
    if( !empty( $current_author->display_name ) ) {
        $inspiry_banner_title = $current_author->display_name;
    }

} elseif ( is_archive() ) {
    $inspiry_banner_title = get_the_archive_title();
    $inspiry_banner_sub_title = get_the_archive_description();

}

/*
 * Skip the banner if revolution slider is being displayed
 */
if ( !$skip_banner ) {
    $inspiry_banner_bg_image = inspiry_get_banner_image();
    $inspiry_banner_bg_color = '#494c53';

    $banner_variation_class = '';
    if ( $inspiry_options[ 'inspiry_header_variation' ] == '1' ) {
        $banner_variation_class = 'add-padding-top';
    }
    ?>
    <div class="page-head <?php echo esc_attr( $banner_variation_class ); ?>"
         style="<?php inspiry_generate_background( $inspiry_banner_bg_color, $inspiry_banner_bg_image ); ?>">
        <?php
        if ( is_singular( 'property' ) && $inspiry_options[ 'inspiry_property_breadcrumbs' ] ) {
            get_template_part( 'partials/header/breadcrumb' );
        } else {
            ?>
            <div class="container">
                <div class="page-head-content">
                    <?php
                    if ( !empty( $inspiry_banner_title ) ) {
                        if ( is_single() ) {
                            ?><h2 class="page-title"><?php echo esc_html( $inspiry_banner_title ); ?></h2><?php
                        } else {
                            ?><h1 class="page-title"><?php echo esc_html( $inspiry_banner_title ); ?></h1><?php
                        }
                    }

                    // only for archive pages
                    if ( !empty( $inspiry_banner_sub_title ) ) {
                        ?><p class="page-description"><?php echo esc_html( $inspiry_banner_sub_title ); ?></p><?php
                    }
                    ?>
                </div>
            </div>
            <?php
        }
        ?>
    </div><!-- .page-head -->
    <?php
}

/*
 * Display revolution slider of all conditions are met
 */
if ( is_home() || is_page() || is_singular( 'agent' ) || is_singular( 'post' ) ) {
    if ( function_exists( 'putRevSlider' ) && ( !empty( $revolution_slider_alias ) ) ) {
        echo '<div class="inspiry-revolution-slider">';
        putRevSlider( $revolution_slider_alias );
        echo '</div>';
    }
}

