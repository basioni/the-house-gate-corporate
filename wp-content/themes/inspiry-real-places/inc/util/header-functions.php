<?php
/*
 * Dynamic CSS
 */
require_once( get_template_directory() . '/css/dynamic-css.php' );



if ( ! function_exists( 'inspiry_generate_favicon' ) ) :
    /**
     * Generate favicon
     */
    function inspiry_generate_favicon() {
        if ( !function_exists( 'has_site_icon' ) || !has_site_icon() ) {
            global $inspiry_options;
            if ( !empty( $inspiry_options['inspiry_favicon'] ) && !empty( $inspiry_options['inspiry_favicon']['url'] ) ) {
                ?>
                <!-- favicon -->
                <link rel="shortcut icon" href="<?php echo esc_url( $inspiry_options['inspiry_favicon']['url'] ); ?>"/>
                <?php
            }
        }
    }
    add_action( 'wp_head', 'inspiry_generate_favicon', 5 );
endif;



if ( ! function_exists( 'inspiry_get_banner_image' ) ) :
    /**
     * Get banner image
     * @return bool|string
     */
    function inspiry_get_banner_image() {
        global $post;
        if( isset( $post->ID ) ){
            if ( is_page_template( 'page-templates/home.php' ) ) {
                $banner_image_id = get_post_meta( $post->ID, 'inspiry_homepage_banner_image', true );
            } else {
                $banner_image_id = get_post_meta( $post->ID, 'REAL_HOMES_page_banner_image', true );
            }

            if ( $banner_image_id ) {
                return wp_get_attachment_url( $banner_image_id );
            }
        }
        return inspiry_get_default_banner();
    }
endif;



if ( ! function_exists( 'inspiry_get_default_banner' ) ) :
    /**
     * Get default banner
     * @return string
     */
    function inspiry_get_default_banner() {
        global $inspiry_options;
        $banner_image_path = null;
        if ( !empty( $inspiry_options['inspiry_banner_image'] ) ) {
            $banner_image_path = $inspiry_options['inspiry_banner_image']['url'];
        }
        return empty( $banner_image_path ) ? esc_url( get_template_directory_uri() . '/images/banner.png' ) : $banner_image_path;
    }
endif;



if ( ! function_exists( 'inspiry_quick_css' ) ) :
    /**
     * Generate Quick CSS
     */
    function inspiry_quick_css(){
        global $inspiry_options;
        if ( isset( $inspiry_options[ 'inspiry_quick_css' ] ) ) {
            // Quick CSS from Theme Options
            $quick_css = stripslashes( $inspiry_options[ 'inspiry_quick_css' ] );
            if ( ! empty( $quick_css ) ) {
                echo "\n<style type='text/css' id='inspiry-quick-css'>\n";
                echo $quick_css . "\n";
                echo "</style>" . "\n\n";
            }
        }
    }

    add_action( 'wp_head', 'inspiry_quick_css' );
endif;



if( ! function_exists( 'inspiry_quick_js' ) ) :
    /**
     * Generate Quick JS
     */
    function inspiry_quick_js(){
        global $inspiry_options;
        if ( isset( $inspiry_options[ 'inspiry_quick_js' ] ) ) {
            // Quick JS from Theme Options
            $quick_js = stripslashes( $inspiry_options[ 'inspiry_quick_js' ] );
            if( ! empty( $quick_js )){
                echo "\n<script type='text/javascript' id='inspiry-quick-js'>\n";
                echo $quick_js . "\n";
                echo "</script>" . "\n\n";
            }
        }
    }

    add_action( 'wp_footer', 'inspiry_quick_js' );
endif;
