<?php
/*
 * Styles Options
 */
global $opt_name;

Redux::setSection( $opt_name, array(
        'title' => __( 'Styles', 'inspiry' ),
        'icon'  => 'el-icon-website',
        'desc'  => __('This section contains styles related options.', 'inspiry'),
        'fields'=> array(),
    )
);

/*
 * Basic Styles Options
 */
require_once ( get_template_directory() . '/inc/theme-options/styles-options/basic-styles-options.php' );

/*
 * Header Styles Options
 */
require_once ( get_template_directory() . '/inc/theme-options/styles-options/header-styles-options.php' );

/*
 * Slider Styles Options
 */
require_once ( get_template_directory() . '/inc/theme-options/styles-options/slider-styles-options.php' );

/*
 * Home Properties Styles Options
 */
require_once ( get_template_directory() . '/inc/theme-options/styles-options/properties-styles-options.php' );

/*
 * Featured Properties Styles Options
 */
require_once ( get_template_directory() . '/inc/theme-options/styles-options/featured-properties-styles-options.php' );

/*
 * Footer Styles Options
 */
require_once ( get_template_directory() . '/inc/theme-options/styles-options/footer-styles-options.php' );