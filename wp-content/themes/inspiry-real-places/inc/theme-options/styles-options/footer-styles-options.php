<?php
/*
 * Footer Styles Options
 */
global $opt_name;

Redux::setSection( $opt_name, array(
    'title' => __( 'Footer', 'inspiry'),
    'id'    => 'footer-styles',
    'desc'  => __('This sub section contains footer styles options.', 'inspiry' ),
    'subsection' => true,
    'fields'=> array (

        array (
            'id'        => 'inspiry_footer_variation',
            'type'      => 'button_set',
            'title'     => __( 'Overall Footer Style', 'inspiry' ),
            'options'   => array(
                'one' => __('Light', 'inspiry'),
                'two' => __('Dark', 'inspiry'),
            ),
            'default'   => 'one',
        ),
        array(
            'id'   =>'inspiry_footer_divider',
            'type' => 'divide',
        ),

        /************************
          Footer light variation
         ************************/

        array(
            'id'        => 'inspiry_light_footer_bg',
            'type'      => 'color',
            'mode'      => 'background-color',
            'output'    => array( '.site-footer' ),
            'title'     => __( 'Footer Background Color', 'inspiry' ),
            'desc'      => 'default: #ffffff',
            'default'   => '#ffffff',
            'transparent' => false,
            'required' => array( 'inspiry_footer_variation', '=', 'one' ),
        ),
        array(
            'id'        => 'inspiry_light_footer_heading',
            'type'      => 'color',
            'output'    => array(
                '.site-footer h1',
                '.site-footer h2',
                '.site-footer h3',
                '.site-footer h4',
                '.site-footer h5',
                '.site-footer h6',
                '.site-footer .h1',
                '.site-footer .h2',
                '.site-footer .h3',
                '.site-footer .h4',
                '.site-footer .h5',
                '.site-footer .h6',
            ),
            'title'     => __( 'Footer Headings Color', 'inspiry' ),
            'desc'      => 'default: #4a525d',
            'default'   => '#4a525d',
            'transparent' => false,
            'required' => array( 'inspiry_footer_variation', '=', 'one' ),
        ),
        array(
            'id'        => 'inspiry_light_footer_text',
            'type'      => 'color',
            'output'    => array( '.site-footer' ),
            'title'     => __( 'Footer Text Color', 'inspiry' ),
            'desc'      => 'default: #4a525d',
            'default'   => '#4a525d',
            'transparent' => false,
            'required' => array( 'inspiry_footer_variation', '=', 'one' ),
        ),
        array(
            'id'        => 'inspiry_light_footer_link',
            'type'      => 'link_color',
            'title'     => __( 'Footer Link Color', 'inspiry' ),
            'active'    => true,
            'output'    => array( '.site-footer a' ),
            'default'   => array(
                'regular' => '#9aa2aa',
                'hover'   => '#0dbae8',
                'active'  => '#0dbae8',
            ),
            'required' => array( 'inspiry_footer_variation', '=', 'one' ),
        ),

        /************************
        Footer Dark variation
         ************************/

        array(
            'id'        => 'inspiry_dark_footer_bg',
            'type'      => 'color',
            'mode'      => 'background-color',
            'output'    => array( '.site-footer-two' ),
            'title'     => __( 'Footer Background Color', 'inspiry' ),
            'desc'      => 'default: #4a525d',
            'default'   => '#4a525d',
            'transparent' => false,
            'required' => array( 'inspiry_footer_variation', '=', 'two' ),
        ),
        array(
            'id'        => 'inspiry_dark_footer_heading',
            'type'      => 'color',
            'output'    => array(
                '.site-footer-two h1',
                '.site-footer-two h2',
                '.site-footer-two h3',
                '.site-footer-two h4',
                '.site-footer-two h5',
                '.site-footer-two h6',
                '.site-footer-two .h1',
                '.site-footer-two .h2',
                '.site-footer-two .h3',
                '.site-footer-two .h4',
                '.site-footer-two .h5',
                '.site-footer-two .h6',
            ),
            'title'     => __( 'Footer Headings Color', 'inspiry' ),
            'desc'      => 'default: #ffffff',
            'default'   => '#ffffff',
            'transparent' => false,
            'required' => array( 'inspiry_footer_variation', '=', 'two' ),
        ),
        array(
            'id'        => 'inspiry_dark_footer_text',
            'type'      => 'color',
            'output'    => array( '.site-footer-two' ),
            'title'     => __( 'Footer Text Color', 'inspiry' ),
            'desc'      => 'default: #ffffff',
            'default'   => '#ffffff',
            'transparent' => false,
            'required' => array( 'inspiry_footer_variation', '=', 'two' ),
        ),
        array(
            'id'        => 'inspiry_dark_footer_link',
            'type'      => 'link_color',
            'title'     => __( 'Footer Link Color', 'inspiry' ),
            'active'    => true,
            'output'    => array( '.site-footer-two a' ),
            'default'   => array(
                'regular' => '#9aa2aa',
                'hover'   => '#ffffff',
                'active'  => '#ffffff',
            ),
            'required' => array( 'inspiry_footer_variation', '=', 'two' ),
        ),


    ) ) );