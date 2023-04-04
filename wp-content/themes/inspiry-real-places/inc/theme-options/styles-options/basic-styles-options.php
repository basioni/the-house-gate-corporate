<?php
/*
 * Basic Styles Options
 */
global $opt_name;

Redux::setSection( $opt_name, array(
    'title' => __( 'Basic', 'inspiry'),
    'id'    => 'basic-styles',
    'desc'  => __('This sub section contains basic styles options.', 'inspiry' ),
    'subsection' => true,
    'fields'=> array(

        array(
            'id'        => 'inspiry_body_background',
            'type'      => 'background',
            'output'    => array( 'body', '.site-pages' ),
            'title'     => __( 'Main Background', 'inspiry' ),
            'subtitle'  => __( 'Configure body background of your choice. ( default:#eff1f5 )', 'inspiry' ),
            'default'   => '#eff1f5'
        ),
        array(
            'id'        => 'inspiry_change_font',
            'type'      => 'switch',
            'title'     => __( 'Do you want to change fonts?', 'inspiry' ),
            'default'   => '0',
            'on'    => __( 'Yes', 'inspiry' ),
            'off'   => __( 'No', 'inspiry' )
        ),
        array(
            'id'        => 'inspiry_headings_font',
            'type'      => 'typography',
            'title'     => __( 'Headings Font', 'inspiry' ),
            'subtitle'  => __( 'Select the font for headings.', 'inspiry' ),
            'desc'      => __( 'Varela Round is default font.', 'inspiry' ),
            'required'  => array( 'inspiry_change_font', '=', '1' ),
            'google'    => true,
            'font-style'    => false,
            'font-weight'   => false,
            'font-size'     => false,
            'line-height'   => false,
            'color'         => false,
            'text-align'    => false,
            'output'        => array( 'h1','h2','h3','h4','h5','h6', '.h1','.h2','.h3','.h4','.h5','.h6' ),
            'default'       => array(
                'font-family' => 'Varela Round',
                'google'      => true
            )
        ),
        array(
            'id'        => 'inspiry_body_font',
            'type'      => 'typography',
            'title'     => __( 'Text Font', 'inspiry' ),
            'subtitle'  => __( 'Select the font for body text.', 'inspiry' ),
            'desc'      => __( 'Varela Round is default font.', 'inspiry' ),
            'required'  => array( 'inspiry_change_font', '=', '1' ),
            'google'    => true,
            'font-style'    => false,
            'font-weight'   => false,
            'font-size'     => false,
            'line-height'   => false,
            'color'         => false,
            'text-align'    => false,
            'output'        => array( 'body' ),
            'default'       => array(
                'font-family' => 'Varela Round',
                'google'      => true
            )
        ),
        array(
            'id'        => 'inspiry_headings_color',
            'type'      => 'color',
            'output'    => array( 'h1, h2, h3, h4, h5, h6, .h1, .h2, .h3, .h4, .h5, .h6' ),
            'title'     => __( 'Headings Color', 'inspiry' ),
            'default'   => '#4a525d',
            'validate'  => 'color',
            'transparent' => false,
            'desc'  => 'default: #4a525d',
        ),
        array(
            'id'        => 'inspiry_text_color',
            'type'      => 'color',
            'transparent' => false,
            'output'    => array( 'body' ),
            'title'     => __( 'Text Color', 'inspiry' ),
            'desc'  => 'default: #4a525d',
            'default'   => '#4a525d',
            'validate'  => 'color'
        ),
        array(
            'id'        => 'inspiry_blockquote_color',
            'type'      => 'color',
            'output'    => array( 'blockquote', 'blockquote p' ),
            'title'     => __('Quote Text Color', 'inspiry'),
            'default'   => '#4a525d',
            'validate'  => 'color',
            'transparent' => false,
            'desc'  => 'default: #4a525d',
        ),
        array(
            'id'        => 'inspiry_link_color',
            'type'      => 'link_color',
            'title'     => __( 'Link Color', 'inspiry' ),
            'active'    => true,
            'output'    => array( 'a' ),
            'default'   => array(
                'regular' => '#191c20',
                'hover'   => '#0dbae8',
                'active'  => '#0dbae8',
            )
        ),
        array(
            'id'        => 'inspiry_content_link_color',
            'type'      => 'link_color',
            'title'     => __( 'Link Color in Page and Post Contents', 'inspiry' ),
            'active'    => true,
            'output'    => array( '.default-page .entry-content a' ),
            'default'   => array(
                'regular' => '#0dbae8',
                'hover'   => '#ff8000',
                'active'  => '#ff8000',
            )
        ),
        array(
            'id'        => 'inspiry_animation',
            'type'      => 'switch',
            'title'     => __('Animation', 'inspiry'),
            'desc'     => __('You can enable or disable CSS3 animation on various components.', 'inspiry'),
            'default'   => 1,
            'on'        => __('Enable','inspiry'),
            'off'       => __('Disable','inspiry'),
        ),
        array(
            'id'        => 'inspiry_quick_css',
            'type'      => 'ace_editor',
            'title'     => __( 'Quick CSS', 'inspiry' ),
            'desc'      => __( 'You can use this box for some quick css changes. For big changes, Use the custom.css file in css folder. In case of child theme please use style.css file in child theme.', 'inspiry' ),
            'mode'      => 'css',
            'theme'     => 'monokai'
        )

    ) ) );