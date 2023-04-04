<?php
/**
 * The current version of the theme.
 */
define( 'INSPIRY_THEME_VERSION', '1.2.2' );

/**
 * Make theme available for translation.
 * Translations can be filed in the /languages/ directory.
 *
 * Note: This function supposed to be in inspiry_theme_setup,
 * But I called it before including redux framework to support theme options translations
 */
load_theme_textdomain( 'inspiry', get_template_directory() . '/languages' );


if ( ! function_exists( 'inspiry_theme_setup' ) ) :
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     *
     * @since 1.0.0
     */
    function inspiry_theme_setup() {

        // Add default posts and comments RSS feed links to head.
        add_theme_support( 'automatic-feed-links' );

        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support( 'title-tag' );

        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * See: https://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
         */
        add_theme_support( 'post-thumbnails' );

        /*
         * Used on:
         * Single post page and Post archive pages
         * Single property page
         * Gallery pages
         */
        set_post_thumbnail_size( 850, 570, true );

        /*
         * Used on:
         * Home page ( Properties and Featured Properties )
         * Properties list pages ( both list and grid layout )
         */
        add_image_size( 'inspiry-grid-thumbnail', 660,600, true);

        /*
         * Used on:
         * Agent single page
         * Property single page
         */
        add_image_size( 'inspiry-agent-thumbnail', 220, 220, true);

        /*
         * Theme theme uses wp_nav_menu in one location.
         */
        register_nav_menus( array(
            'primary' => __( 'Primary Menu', 'inspiry' ),
        ) );

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support( 'html5', array(
            'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
        )   );

        /*
         * Enable support for Post Formats.
         *
         * See: https://codex.wordpress.org/Post_Formats
         */
        add_theme_support( 'post-formats', array(
            'image', 'video', 'gallery'
        ) );

    }

    add_action( 'after_setup_theme', 'inspiry_theme_setup' );

endif; // inspiry_theme_setup


/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * @since 1.0
 */
if ( ! isset( $content_width ) ) {
    $content_width = 710;
}


/*
 * Redux Framework and Theme Options
 */
require_once ( get_template_directory() . '/inc/ReduxFramework/inspiry-redux.php' );


/*
 * Meta boxes configuration
 */
require_once ( get_template_directory() . '/inc/meta-boxes/config.php' );


/*
 * TGM plugin activation
 */
require_once ( get_template_directory() . '/inc/tgm/inspiry-required-plugins.php' );


/*
 * Utility functions
 */
require_once ( get_template_directory() . '/inc/util/basic-functions.php' );
require_once ( get_template_directory() . '/inc/util/header-functions.php' );
require_once ( get_template_directory() . '/inc/util/footer-functions.php' );
require_once ( get_template_directory() . '/inc/util/real-estate-functions.php' );


/*
 * Widgets
 */
include_once ( get_template_directory() . '/inc/widgets/advance-search-widget.php' );
include_once ( get_template_directory() . '/inc/widgets/featured-properties-widget.php' );
include_once ( get_template_directory() . '/inc/widgets/social-icons-widget.php' );


if( !function_exists( 'inspiry_google_fonts' ) ) :
    /**
     * Google fonts enqueue url
     */
    function inspiry_google_fonts() {

            $fonts_url = '';

            /*
             * Translators: If there are characters in your language that are not
             * supported by Varela Round, translate this to 'off'. Do not translate
             * into your own language.
             */

            $varela_round = _x( 'on', 'Varela Round font: on or off', 'inspiry' );

            if ( 'off' !== $varela_round ) {
                $font_families = array();

                if ( 'off' !== $varela_round ) {
                    $font_families[] = 'Varela Round';
                }

                $query_args = array(
                    'family' => urlencode( implode( '|', $font_families ) ),
                    'subset' => urlencode( 'latin,latin-ext' ),
                );

                $fonts_url = add_query_arg( $query_args,  '//fonts.googleapis.com/css' );
            }

            return esc_url_raw( $fonts_url );

    }
endif;


if ( ! function_exists( 'inspiry_enqueue_styles' ) ) :
    /**
     * Enqueue required styles for front end
     * @since   1.0.0
     * @return  void
     */
    function inspiry_enqueue_styles() {

        if ( ! is_admin() ) :

            $inspiry_template_directory_uri = get_template_directory_uri();

            // Google Font
            wp_enqueue_style (
                'google-varela-round',
                inspiry_google_fonts(),
                array(),
                INSPIRY_THEME_VERSION
            );

            // flexslider
            wp_enqueue_style(
                'flexslider',
                $inspiry_template_directory_uri . '/js/flexslider/flexslider.css',
                array(),
                '2.4.0'
            );

            // lightslider
            wp_enqueue_style(
                'lightslider',
                $inspiry_template_directory_uri . '/js/lightslider/css/lightslider.min.css',
                array(),
                '1.1.2'
            );

            // owl carousel
            wp_enqueue_style(
                'owl-carousel',
                $inspiry_template_directory_uri . '/js/owl.carousel/owl.carousel.css',
                array(),
                INSPIRY_THEME_VERSION
            );

            // swipebox
            wp_enqueue_style(
                'swipebox',
                $inspiry_template_directory_uri . '/js/swipebox/css/swipebox.min.css',
                array(),
                '1.3.0'
            );

            // select2
            wp_enqueue_style(
                'select2',
                $inspiry_template_directory_uri . '/js/select2/select2.css',
                array(),
                '4.0.0'
            );

            // font awesome
            wp_enqueue_style(
                'font-awesome',
                $inspiry_template_directory_uri . '/css/font-awesome.min.css',
                array(),
                '4.3.0'
            );

            // animate css
            wp_enqueue_style(
                'animate',
                $inspiry_template_directory_uri . '/css/animate.css',
                array(),
                INSPIRY_THEME_VERSION
            );

            // magnific popup css
            wp_enqueue_style(
                'magnific-popup',
                $inspiry_template_directory_uri . '/js/magnific-popup/magnific-popup.css',
                array(),
                '1.0.0'
            );

            // main styles
            wp_enqueue_style(
                'inspiry-main',
                $inspiry_template_directory_uri . '/css/main.css',
                array( 'font-awesome', 'animate' ),
                INSPIRY_THEME_VERSION
            );

            // theme styles
            wp_enqueue_style(
                'inspiry-theme',
                $inspiry_template_directory_uri . '/css/theme.css',
                array( 'inspiry-main' ),
                INSPIRY_THEME_VERSION
            );

            // parent theme style.css
            wp_enqueue_style(
                'inspiry-parent-default',
                get_stylesheet_uri(),
                array ( 'inspiry-main' ),
                INSPIRY_THEME_VERSION
            );

            // if rtl is enabled
            if ( is_rtl() ) {

                wp_enqueue_style(
                    'inspiry-main-rtl',
                    $inspiry_template_directory_uri . '/css/main-rtl.css',
                    array( 'inspiry-main' ),
                    INSPIRY_THEME_VERSION
                );

                wp_enqueue_style(
                    'inspiry-theme-rtl',
                    $inspiry_template_directory_uri . '/css/theme-rtl.css',
                    array( 'inspiry-main', 'inspiry-theme', 'inspiry-main-rtl' ),
                    INSPIRY_THEME_VERSION
                );
            }

            // parent theme css/custom.css
            wp_enqueue_style(
                'inspiry-parent-custom',
                $inspiry_template_directory_uri . '/css/custom.css',
                array ( 'inspiry-parent-default' ),
                INSPIRY_THEME_VERSION
            );

        endif;

    }

endif; // inspiry_enqueue_styles

add_action ( 'wp_enqueue_scripts', 'inspiry_enqueue_styles' );



if ( ! function_exists( 'inspiry_enqueue_scripts' ) ) :
    /**
     * Enqueue required java scripts for front end
     * @since   1.0.0
     * @return  void
     */
    function inspiry_enqueue_scripts() {

        if ( ! is_admin() ) :

            $inspiry_template_directory_uri = get_template_directory_uri();

            // flex slider
            wp_enqueue_script(
                'flexslider',
                $inspiry_template_directory_uri . '/js/flexslider/jquery.flexslider-min.js',
                array( 'jquery' ),
                '2.4.0',
                true
            );

            if ( is_singular( 'property' ) ) {
                // light slider
                wp_enqueue_script(
                    'lightslider',
                    $inspiry_template_directory_uri . '/js/lightslider/js/lightslider.min.js',
                    array( 'jquery' ),
                    '1.1.2',
                    true
                );
            }

            if ( is_singular( 'property' ) || is_page_template( 'page-templates/home.php' ) ) {
                // owl carousel
                wp_enqueue_script(
                    'owl-carousel',
                    $inspiry_template_directory_uri . '/js/owl.carousel/owl.carousel.min.js',
                    array( 'jquery' ),
                    INSPIRY_THEME_VERSION,
                    true
                );
            }

            // swipebox
            wp_enqueue_script(
                'swipebox',
                $inspiry_template_directory_uri . '/js/swipebox/js/jquery.swipebox.min.js',
                array( 'jquery' ),
                '1.3.0',
                true
            );

            // select2
            wp_enqueue_script(
                'select2',
                $inspiry_template_directory_uri . '/js/select2/select2.min.js',
                array( 'jquery' ),
                '4.0.0',
                true
            );

            // hoverIntent
            wp_enqueue_script(
                'hoverIntent',
                $inspiry_template_directory_uri . '/js/jquery.hoverIntent.js',
                array( 'jquery' ),
                '1.8.1',
                true
            );

            // validate
            wp_enqueue_script(
                'validate',
                $inspiry_template_directory_uri . '/js/jquery.validate.min.js',
                array( 'jquery' ),
                '1.13.1',
                true
            );

            // form
            wp_enqueue_script(
                'form',
                $inspiry_template_directory_uri . '/js/jquery.form.js',
                array( 'jquery' ),
                '3.51.0',
                true
            );

            // transition
            wp_enqueue_script(
                'transition',
                $inspiry_template_directory_uri . '/js/transition.js',
                array( 'jquery' ),
                '3.3.1',
                true
            );

            // appear
            wp_enqueue_script(
                'appear',
                $inspiry_template_directory_uri . '/js/jquery.appear.js',
                array( 'jquery' ),
                '0.3.4',
                true
            );

            // modal
            wp_enqueue_script(
                'modal',
                $inspiry_template_directory_uri . '/js/modal.js',
                array( 'jquery' ),
                '3.3.4',
                true
            );

            // mean menu
            wp_enqueue_script(
                'meanmenu',
                $inspiry_template_directory_uri . '/js/meanmenu/jquery.meanmenu.min.js',
                array( 'jquery' ),
                '2.0.8',
                true
            );

            // Placeholder
            wp_enqueue_script(
                'placeholder',
                $inspiry_template_directory_uri . '/js/jquery.placeholder.min.js',
                array( 'jquery' ),
                '2.1.2',
                true
            );

            if ( is_page_template( 'page-templates/2-columns-gallery.php' )
                    || is_page_template( 'page-templates/3-columns-gallery.php' )
                    || is_page_template( 'page-templates/4-columns-gallery.php' ) ) {

                // isotope
                wp_enqueue_script(
                    'isotope',
                    $inspiry_template_directory_uri . '/js/isotope.pkgd.min.js',
                    array( 'jquery' ),
                    '2.2.0',
                    true
                );
            }

            // jQuery UI
            wp_enqueue_script( 'jquery-ui-core' );
            wp_enqueue_script( 'jquery-ui-autocomplete' );
            wp_enqueue_script( 'jquery-ui-sortable' );

            if( is_singular( 'property' )
                || is_page_template( 'page-templates/contact.php' )
                || is_page_template( 'page-templates/properties-search.php' )
                || is_page_template( 'page-templates/home.php' )
                || is_page_template( 'page-templates/properties-list.php' )
                || is_page_template( 'page-templates/properties-list-with-sidebar.php' )
                || is_page_template( 'page-templates/properties-grid.php' )
                || is_page_template( 'page-templates/properties-grid-with-sidebar.php' )
                || is_page_template( 'page-templates/submit-property.php' )
                || is_tax( 'property-city' )
                || is_tax( 'property-status' )
                || is_tax( 'property-type' )
                || is_tax( 'property-feature' )
                || is_post_type_archive( 'property' ) ) {

                $google_map_arguments = array();

                global $inspiry_options;

                // Get Google Map API Key if available
                if ( isset( $inspiry_options[ 'inspiry_google_map_api_key' ] ) && !empty( $inspiry_options[ 'inspiry_google_map_api_key' ] ) ) {
                    $google_map_arguments[ 'key' ] = urlencode( $inspiry_options[ 'inspiry_google_map_api_key' ] );
                }

                // Change the map based on language if enabled from theme options
                if ( $inspiry_options[ 'inspiry_google_map_auto_lang' ] ) {
                    if ( function_exists( 'wpml_object_id_filter' ) ) {
                        $google_map_arguments[ 'language' ] = urlencode( ICL_LANGUAGE_CODE );
                    } else {
                        $google_map_arguments[ 'language' ] = urlencode( get_locale() );
                    }
                }

                $google_map_api_uri = add_query_arg( apply_filters( 'inspiry_google_map_arguments', $google_map_arguments ) ,  '//maps.google.com/maps/api/js' );

                wp_enqueue_script(
                    'google-map-api',
                    esc_url_raw( $google_map_api_uri ),
                    array(),
                    '3.21',
                    false
                );
            }

            if( is_page_template( 'page-templates/properties-search.php' )
                || is_page_template( 'page-templates/home.php' )
                || is_page_template( 'page-templates/properties-list.php' )
                || is_page_template( 'page-templates/properties-list-with-sidebar.php' )
                || is_page_template( 'page-templates/properties-grid.php' )
                || is_page_template( 'page-templates/properties-grid-with-sidebar.php' )
                || is_tax( 'property-city' )
                || is_tax( 'property-status' )
                || is_tax( 'property-type' )
                || is_tax( 'property-feature' )
                || is_post_type_archive( 'property' ) ) {

                wp_enqueue_script(
                    'google-map-info-box',
                    $inspiry_template_directory_uri . '/js/infobox.js',
                    array( 'google-map-api' ),
                    '1.1.9',
                    false
                );

                wp_enqueue_script(
                    'google-map-marker-clusterer',
                    $inspiry_template_directory_uri . '/js/markerclusterer.js',
                    array( 'google-map-api' ),
                    '2.1.1',
                    false
                );
            }

            // Comment reply script
            if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
                wp_enqueue_script( 'comment-reply' );
            }

            // Property search form script
            wp_enqueue_script(
                'inspiry-search-form',
                $inspiry_template_directory_uri . '/js/inspiry-search-form.js',
                array( 'jquery' ),
                INSPIRY_THEME_VERSION,
                true
            );


            // favorites
            if ( is_singular( 'property' ) || is_page_template( 'page-templates/favorites.php' ) ) {

                wp_enqueue_script(
                    'inspiry-favorites',
                    $inspiry_template_directory_uri . '/js/inspiry-favorites.js',
                    array( 'jquery' ),
                    INSPIRY_THEME_VERSION,
                    true
                );

            }


            // edit profile
            if ( is_page_template( 'page-templates/edit-profile.php' ) ) {

                wp_enqueue_script( 'plupload' );

                wp_enqueue_script(
                    'inspiry-edit-profile',
                    $inspiry_template_directory_uri . '/js/inspiry-edit-profile.js',
                    array( 'jquery', 'plupload' ),
                    INSPIRY_THEME_VERSION,
                    true
                );

                $edit_profile_data = array(
                    'ajaxURL' => admin_url( 'admin-ajax.php' ),
                    'uploadNonce' => wp_create_nonce ( 'inspiry_allow_upload' ),
                    'fileTypeTitle' => __( 'Valid file formats', 'inspiry' ),
                );

                wp_localize_script( 'inspiry-edit-profile', 'editProfile', $edit_profile_data );

            }

            // Property submit
            if ( is_page_template( 'page-templates/submit-property.php' ) ) {

                wp_enqueue_script( 'plupload' );
                wp_enqueue_script( 'jquery-ui-sortable' );

                wp_enqueue_script(
                    'inspiry-property-submit',
                    $inspiry_template_directory_uri . '/js/inspiry-property-submit.js',
                    array( 'jquery', 'plupload', 'jquery-ui-sortable' ),
                    INSPIRY_THEME_VERSION,
                    true
                );

                $property_submit_data = array(
                    'ajaxURL' => admin_url( 'admin-ajax.php' ),
                    'uploadNonce' => wp_create_nonce ( 'inspiry_allow_upload' ),
                    'fileTypeTitle' => __( 'Valid file formats', 'inspiry' ),
                );
                wp_localize_script( 'inspiry-property-submit', 'propertySubmit', $property_submit_data );

            }

            // Property Single
            if ( is_singular( 'property' ) ) {

                wp_enqueue_script(
                    'magnific-popup',
                    $inspiry_template_directory_uri . '/js/magnific-popup/jquery.magnific-popup.min.js',
                    array( 'jquery' ),
                    '1.0.0',
                    true
                );

                wp_enqueue_script(
                    'share-js',
                    $inspiry_template_directory_uri . '/js/share.min.js',
                    array( 'jquery' ),
                    INSPIRY_THEME_VERSION,
                    true
                );

                wp_enqueue_script(
                    'property-share',
                    $inspiry_template_directory_uri . '/js/property-share.js',
                    array( 'jquery' ),
                    INSPIRY_THEME_VERSION,
                    true
                );

                wp_enqueue_script(
                    'sly-js',
                    $inspiry_template_directory_uri . '/js/sly.min.js',
                    array( 'jquery' ),
                    INSPIRY_THEME_VERSION,
                    true
                );

                wp_enqueue_script(
                    'property-horizontal-scrolling',
                    $inspiry_template_directory_uri . '/js/property-horizontal-scrolling.js',
                    array( 'jquery' ),
                    INSPIRY_THEME_VERSION,
                    true
                );

            }

            // Main js
            wp_enqueue_script(
                'custom',
                $inspiry_template_directory_uri . '/js/custom.js',
                array( 'jquery' ),
                INSPIRY_THEME_VERSION,
                true
            );

        endif;

    }

endif; // inspiry_enqueue_scripts

add_action ( 'wp_enqueue_scripts', 'inspiry_enqueue_scripts' );



if ( ! function_exists( 'inspiry_enqueue_admin_scripts' ) ) :
    /**
     * Enqueue admin side scripts
     *
     * @param $hook
     */
    function inspiry_enqueue_admin_scripts( $hook ) {
        if ( $hook == 'post.php' || $hook == 'post-new.php' ) {
            global $post_type;
            if ( 'post' == $post_type ) {
                wp_enqueue_script (
                    'post-meta-box-switcher',
                    get_template_directory_uri() . '/js/admin.js',
                    array( 'jquery' ),
                    INSPIRY_THEME_VERSION
                );
            }
        }
    }
    add_action( 'admin_enqueue_scripts', 'inspiry_enqueue_admin_scripts' );
endif;



if( !function_exists( 'inspiry_theme_sidebars' ) ) :
    /**
     * Register theme sidebars
     *
     * @since 1.0.0
     */
    function inspiry_theme_sidebars( ) {

        // Location: Default Sidebar
        register_sidebar(array(
            'name'=>__('Default Sidebar','inspiry'),
            'id' => 'default-sidebar',
            'description' => __('Widget area for default sidebar on news and post pages.','inspiry'),
            'before_widget' => '<section id="%1$s" class="widget clearfix %2$s">',
            'after_widget' => '</section>',
            'before_title' => '<h3 class="widget-title">',
            'after_title' => '</h3>',
        ));

        // Location: Sidebar Pages
        register_sidebar(array(
            'name'=>__('Pages Sidebar','inspiry'),
            'id' => 'default-page-sidebar',
            'description' => __('Widget area for default page template sidebar.','inspiry'),
            'before_widget' => '<section id="%1$s" class="widget clearfix %2$s">',
            'after_widget' => '</section>',
            'before_title' => '<h3 class="widget-title">',
            'after_title' => '</h3>',
        ));

        // Location: Sidebar Properties List
        register_sidebar(array(
            'name'=>__('Properties List Sidebar','inspiry'),
            'id' => 'properties-list',
            'description' => __('Widget area for properties list template with sidebar support.','inspiry'),
            'before_widget' => '<section id="%1$s" class="widget clearfix %2$s">',
            'after_widget' => '</section>',
            'before_title' => '<h3 class="widget-title">',
            'after_title' => '</h3>',
        ));

        // Location: Sidebar Properties Grid
        register_sidebar(array(
            'name'=>__('Properties Grid Sidebar','inspiry'),
            'id' => 'properties-grid',
            'description' => __( 'Widget area for properties grid template with sidebar support.', 'inspiry' ),
            'before_widget' => '<section id="%1$s" class="widget clearfix %2$s">',
            'after_widget' => '</section>',
            'before_title' => '<h3 class="widget-title">',
            'after_title' => '</h3>',
        ));

        // Location: Sidebar Property
        register_sidebar(array(
            'name'=>__('Property Sidebar','inspiry'),
            'id' => 'property-sidebar',
            'description' => __('Widget area for property detail page sidebar.','inspiry'),
            'before_widget' => '<section id="%1$s" class="widget clearfix %2$s">',
            'after_widget' => '</section>',
            'before_title' => '<h3 class="widget-title">',
            'after_title' => '</h3>',
        ));

        // *** FOR FUTURE ***
        // Location: Property Search Template
        /*register_sidebar( array(
            'name' => __('Property Search Sidebar','inspiry'),
            'id' => 'property-search-sidebar',
            'description' => __('Widget area for property search template with sidebar.','inspiry'),
            'before_widget' => '<section id="%1$s" class="widget clearfix %2$s">',
            'after_widget' => '</section>',
            'before_title' => '<h3 class="widget-title">',
            'after_title' => '</h3>'
        ));
        */

        // Location: Sidebar dsIDX
        register_sidebar(array(
            'name'=>__('dsIDXpress Sidebar','inspiry'),
            'id' => 'dsidx-sidebar',
            'description' => __('Widget area for dsIDX related pages.','inspiry'),
            'before_widget' => '<section id="%1$s" class="widget clearfix %2$s">',
            'after_widget' => '</section>',
            'before_title' => '<h3 class="widget-title">',
            'after_title' => '</h3>',
        ));

        // Location: Footer First Column
        register_sidebar(array(
            'name'=>__('Footer First Column','inspiry'),
            'id' => 'footer-first-column',
            'description' => __('Widget area for first column in footer.','inspiry'),
            'before_widget' => '<section id="%1$s" class="widget clearfix %2$s">',
            'after_widget' => '</section>',
            'before_title' => '<h3 class="widget-title">',
            'after_title' => '</h3>',
        ));

        // Location: Footer Second Column
        register_sidebar(array(
            'name'=>__('Footer Second Column','inspiry'),
            'id' => 'footer-second-column',
            'description' => __('Widget area for second column in footer.','inspiry'),
            'before_widget' => '<section id="%1$s" class="widget clearfix %2$s">',
            'after_widget' => '</section>',
            'before_title' => '<h3 class="widget-title">',
            'after_title' => '</h3>'
        ));

        // Location: Footer Third Column
        register_sidebar(array(
            'name'=>__('Footer Third Column','inspiry'),
            'id' => 'footer-third-column',
            'description' => __('Widget area for third column in footer.','inspiry'),
            'before_widget' => '<section id="%1$s" class="widget clearfix %2$s">',
            'after_widget' => '</section>',
            'before_title' => '<h3 class="widget-title">',
            'after_title' => '</h3>'
        ));

        // Location: Footer Fourth Column
        register_sidebar(array(
            'name'=>__('Footer Fourth Column','inspiry'),
            'id' => 'footer-fourth-column',
            'description' => __('Widget area for fourth column in footer.','inspiry'),
            'before_widget' => '<section id="%1$s" class="widget clearfix %2$s">',
            'after_widget' => '</section>',
            'before_title' => '<h3 class="widget-title">',
            'after_title' => '</h3>'
        ));

        // *** FOR FUTURE ***
        // Location: Home Search Area
        /*
        register_sidebar(array(
            'name'=>__('Home Search Area','inspiry'),
            'id'=> 'home-search-area',
            'description'=>__('Widget area for only IDX Search Widget. Using this area means you want to display IDX search form instead of default search form.','inspiry'),
            'before_widget' => '<section id="home-idx-search" class="clearfix %2$s">',
            'after_widget' => '</section>',
            'before_title' => '<h3 class="home-widget-label">',
            'after_title' => '</h3>'
        ));
        */

    }

    add_action( 'widgets_init', 'inspiry_theme_sidebars' );

endif;
