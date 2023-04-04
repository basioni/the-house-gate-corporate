<?php
/*
 * Footer Options
 */
global $opt_name;
Redux::setSection( $opt_name, array(
    'title' => __( 'Footer', 'inspiry' ),
    'id'    => 'footer-section',
    'desc'  => __( 'This section contains options for footer.', 'inspiry' ),
    'fields'=> array(

        array(
            'id'       => 'inspiry_footer_logo',
            'type'     => 'media',
            'url'      => false,
            'title'    => __( 'Footer Logo', 'inspiry' ),
            'subtitle' => __( 'Upload footer logo.', 'inspiry' ),
        ),
        array(
            'id'           => 'inspiry_copyright_html',
            'type'         => 'textarea',
            'title'        => __( 'Footer Copyright Text', 'inspiry' ),
            'desc'         => __( 'Allowed html tags are a, br, em and strong.', 'inspiry' ),
            'validate'     => 'html_custom',
            'default'      => sprintf( '&copy; Copyright 2015 All rights reserved by <a href="%1$s" target="_blank">Inspiry Themes</a>', esc_url( 'http://themeforest.net/user/InspiryThemes' ) ),
            'allowed_html' => array(
                'a'      => array(
                    'href'  => array(),
                    'title' => array(),
                    'target' => array(),
                ),
                'br'     => array(),
                'em'     => array(),
                'strong' => array()
            ), //see http://codex.wordpress.org/Function_Reference/wp_kses
        ),

    ) ) );