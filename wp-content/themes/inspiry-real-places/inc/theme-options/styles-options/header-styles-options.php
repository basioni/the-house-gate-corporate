<?php
/*
 * Header Styles Options
 */
global $opt_name;

Redux::setSection( $opt_name, array(
    'title' => __( 'Header', 'inspiry'),
    'id'    => 'header-styles',
    'desc'  => __('This sub section contains header styles options.', 'inspiry' ),
    'subsection' => true,
    'fields'=> array (

        /**********************
          Header variation one
         ***********************/

        /*
         * Menu Button
         */
        // css generation code reside in css/dynamic-css.php
        array(
            'id'        => 'inspiry_menu_button_bg',
            'type'      => 'link_color',
            'title'     => __( 'Menu Button Background Color', 'inspiry' ),
            'active'    => false,
            'default'   => array (
                'regular'   => '#50b848',
                'hover'     => '#000000',
            ),
            'required' => array( 'inspiry_header_variation', '=', 1 ),
        ),
        // css generation code reside in css/dynamic-css.php
        array(
            'id'        => 'inspiry_menu_button_txt',
            'type'      => 'link_color',
            'title'     => __( 'Menu Button Text Color', 'inspiry' ),
            'active'    => false,
            'default'   => array (
                'regular'   => '#ffffff',
                'hover'     => '#ffffff',
            ),
            'required' => array( 'inspiry_header_variation', '=', 1 ),
        ),
        array(
            'id'   =>'inspiry_menu_button_divider',
            'type' => 'divide',
            'required' => array( 'inspiry_header_variation', '=', 1 ),
        ),


        /*
         * Main menu
         */
        array(
            'id'        => 'inspiry_main_menu_bg',
            'type'      => 'color',
            'mode'      => 'background-color',
            'output'    => array( '.header-variation-one .site-main-nav' ),
            'title'     => __( 'Main Menu Background Color', 'inspiry' ),
            'desc'      => 'default: #50b848',
            'default'   => '#50b848',
            'transparent' => false,
            'required' => array( 'inspiry_header_variation', '=', 1 ),
        ),
        array(
            'id'        => 'inspiry_main_menu_text',
            'type'      => 'color',
            'output'    => array( '.header-variation-one .main-menu > li > a' ),
            'title'     => __( 'Main Menu Text Color', 'inspiry' ),
            'desc'      => 'default: #20671b',
            'default'   => '#20671b',
            'validate'  => 'color',
            'transparent' => false,
            'required' => array( 'inspiry_header_variation', '=', 1 ),
        ),
        array(
            'id'        => 'inspiry_main_menu_text_hover',
            'type'      => 'color',
            'output'    => array( '.header-variation-one .main-menu li:hover > a', '.header-variation-one .main-menu .current-menu-item > a' ),
            'title'     => __( 'Main Menu Text Color on Hover', 'inspiry' ),
            'desc'      => 'default: #ffffff',
            'default'   => '#ffffff',
            'validate'  => 'color',
            'transparent' => false,
            'required' => array( 'inspiry_header_variation', '=', 1 ),
        ),
        array(
            'id'        => 'inspiry_main_menu_bg_hover',
            'type'      => 'color',
            'mode'      => 'background-color',
            'output'    => array(
                '.header-variation-one .main-menu > li:hover > a',
                '.header-variation-one .sub-menu',
                '.header-variation-one .main-menu > .current-menu-item > a',
            ),
            'title'     => __( 'Main Menu Hover and Dropdown Background Color', 'inspiry' ),
            'desc'      => 'default: #46a13f',
            'default'   => '#46a13f',
            'transparent' => false,
            'required' => array( 'inspiry_header_variation', '=', 1 ),
        ),
        array(
            'id'        => 'inspiry_main_menu_dropdown_text',
            'type'      => 'color',
            'output'    => array( '.header-variation-one .sub-menu a' ),
            'title'     => __( 'Main Menu Dropdown Text Color', 'inspiry' ),
            'desc'      => 'default: #92df8c',
            'default'   => '#92df8c',
            'validate'  => 'color',
            'transparent' => false,
            'required' => array( 'inspiry_header_variation', '=', 1 ),
        ),
        array(
            'id'        => 'inspiry_main_menu_dropdown_text_hover',
            'type'      => 'color',
            'output'    => array( '.header-variation-one .main-menu .sub-menu li:hover > a' ),
            'title'     => __( 'Main Menu Dropdown Text Color on Hover', 'inspiry' ),
            'desc'      => 'default: #ffffff',
            'default'   => '#ffffff',
            'validate'  => 'color',
            'transparent' => false,
            'required' => array( 'inspiry_header_variation', '=', 1 ),
        ),
        array(
            'id'        => 'inspiry_main_menu_dropdown_sep',
            'type'      => 'color',
            'mode'      => 'background-color',
            'output'    => array( '.header-variation-one .sub-menu a:after' ),
            'title'     => __( 'Main Menu Dropdown Separator Color', 'inspiry' ),
            'desc'      => 'default: #48B040',
            'default'   => '#48B040',
            'validate'  => 'color',
            'transparent' => false,
            'required' => array( 'inspiry_header_variation', '=', 1 ),
        ),
        // css generation code reside in css/dynamic-css.php
        array(
            'id'        => 'inspiry_main_menu_close',
            'type'      => 'link_color',
            'title'     => __( 'Main Menu Close Button Background Color', 'inspiry' ),
            'active'    => false,
            'default'   => array (
                'regular'   => '#33762e',
                'hover'     => '#000000',
            ),
            'required' => array( 'inspiry_header_variation', '=', 1 ),
        ),
        // css generation code reside in css/dynamic-css.php
        array(
            'id'        => 'inspiry_main_menu_close_icon',
            'type'      => 'link_color',
            'title'     => __( 'Main Menu Close Button Icon Color', 'inspiry' ),
            'active'    => false,
            'output'    => array( '.button-menu-close' ),
            'default'   => array(
                'regular' => '#ffffff',
                'hover'   => '#ffffff',
            ),
            'required' => array( 'inspiry_header_variation', '=', 1 ),
        ),
        array(
            'id'   =>'inspiry_main_menu_divider',
            'type' => 'divide',
            'required' => array( 'inspiry_header_variation', '=', 1 ),
        ),


        /*
         * Logo area
         */
        array(
            'id'        => 'inspiry_header_logo_background',
            'type'      => 'color',
            'mode'      => 'background-color',
            'output'    => array( '.header-variation-one .site-logo' ),
            'title'     => __( 'Logo Background Color', 'inspiry' ),
            'desc'      => 'default: #000000',
            'default'   => '#000000',
            'transparent' => false,
            'required' => array( 'inspiry_header_variation', '=', 1 ),
        ),
        array(
            'id'        => 'inspiry_header_logo_text_color',
            'type'      => 'link_color',
            'title'     => __( 'Logo Text Color', 'inspiry' ),
            'active'    => true,
            'output'    => array( '.header-variation-one .site-logo a' ),
            'default'   => array(
                'regular' => '#ffffff',
                'hover'   => '#0dbae8',
                'active'  => '#0dbae8',
            ),
            'required' => array( 'inspiry_header_variation', '=', 1 ),
        ),
        array(
            'id'        => 'inspiry_header_tagline_text_color',
            'type'      => 'color',
            'output'    => array( '.header-variation-one .site-logo' ),
            'title'     => __( 'Header Tagline Text Color', 'inspiry' ),
            'desc'      => 'default: #ffffff',
            'default'   => '#ffffff',
            'validate'  => 'color',
            'transparent' => false,
            'required' => array( 'inspiry_header_variation', '=', 1 ),
        ),
        array(
            'id'   =>'inspiry_logo_divider',
            'type' => 'divide',
            'required' => array( 'inspiry_header_variation', '=', 1 ),
        ),

        /*
         * Header
         */
        array(
            'id'        => 'inspiry_header_background',
            'type'      => 'color',
            'mode'      => 'background-color',
            'output'    => array( '.header-variation-one .header-top' ),
            'title'     => __( 'Header Top Bar Background Color', 'inspiry' ),
            'desc'      => 'default: #ffffff',
            'default'   => '#ffffff',
            'transparent' => false,
            'required' => array( 'inspiry_header_variation', '=', 1 ),
        ),
        array(
            'id'        => 'inspiry_user_nav_link',
            'type'      => 'link_color',
            'title'     => __( 'User Navigation Link Color', 'inspiry' ),
            'active'    => true,
            'output'    => array( '.user-nav a' ),
            'default'   => array(
                'regular' => '#7c848b',
                'hover'   => '#4a525d',
                'active'  => '#4a525d',
            ),
            'required' => array( 'inspiry_header_variation', '=', 1 ),
        ),
        array(
            'id'   =>'inspiry_simple_header_divider',
            'type' => 'divide',
            'required' => array( 'inspiry_header_variation', '=', 1 ),
        ),

        /*
         * Phone number
         */
        array(
            'id'        => 'inspiry_header_phone_bg',
            'type'      => 'color',
            'mode'      => 'background-color',
            'output'    => array( '.header-variation-one .contact-number' ),
            'title'     => __( 'Phone Background Color', 'inspiry' ),
            'desc'      => 'default: #0dbae8',
            'default'   => '#0dbae8',
            'transparent' => false,
            'required' => array( 'inspiry_header_variation', '=', 1 ),
        ),
        array(
            'id'        => 'inspiry_header_phone_text',
            'type'      => 'color',
            'output'    => array( '.header-variation-one .contact-number a', '.header-variation-one .contact-number span' ),
            'title'     => __( 'Phone Text Color', 'inspiry' ),
            'desc'      => 'default: #ffffff',
            'default'   => '#ffffff',
            'validate'  => 'color',
            'transparent' => false,
            'required' => array( 'inspiry_header_variation', '=', 1 ),
        ),
        array(
            'id'        => 'inspiry_header_phone_icon',
            'type'      => 'color',
            'title'     => __( 'Phone Icon Color', 'inspiry' ),
            'desc'      => 'default: #0080BC',
            'default'   => '#0080BC',
            'validate'  => 'color',
            'transparent' => false,
            'required' => array( 'inspiry_header_variation', '=', 1 ),
        ),
        array(
            'id'   =>'inspiry_phone_divider',
            'type' => 'divide',
            'required' => array( 'inspiry_header_variation', '=', 1 ),
        ),

        /*
         * Advance search form
         */
        array(
            'id'        => 'inspiry_header_search_fields_bg',
            'type'      => 'color',
            'mode'      => 'background-color',
            'output'    => array(
                '.header-advance-search input[type="text"]',
                '.header-advance-search .select2-container--default .select2-selection--single',
            ),
            'title'     => __( 'Search Fields Background Color', 'inspiry' ),
            'desc'      => 'default: #dfe7ee',
            'default'   => '#dfe7ee',
            'validate'  => 'color',
            'transparent' => false,
            'required' => array( 'inspiry_header_variation', '=', 1 ),
        ),
        array(
            'id'        => 'inspiry_header_search_fields_hover_bg',
            'type'      => 'color',
            'mode'      => 'background-color',
            'output'    => array(
                '.advance-search input[type="text"]:hover',
                '.advance-search input[type="text"]:focus',
                '.advance-search .select2-container--default .select2-selection--single:hover',
                '.advance-search .select2-container--default.select2-container--open.select2-container--below .select2-selection--single',
                '.advance-search .select2-container--default.select2-container--open.select2-container--below .select2-selection--multiple',
                '.select2-container--default .select2-results__option[aria-selected=true]',
                '.select2-results li',
                '.select2-dropdown',
            ),
            'title'     => __( 'Search Fields Background Color on Hover', 'inspiry' ),
            'desc'      => 'default: #f9f9fa',
            'default'   => '#f9f9fa',
            'validate'  => 'color',
            'transparent' => false,
            'required' => array( 'inspiry_header_variation', '=', 1 ),
        ),
        array(
            'id'        => 'inspiry_header_search_fields_dropdown_hover_bg',
            'type'      => 'color',
            'mode'      => 'background-color',
            'output'    => array(
                '.select2-container--default .select2-results__option--highlighted[aria-selected]',
            ),
            'title'     => __( 'Search Fields Dropdown Background Color on Hover', 'inspiry' ),
            'desc'      => 'default: #f9f9fa',
            'default'   => '#f9f9fa',
            'validate'  => 'color',
            'transparent' => false,
            'required' => array( 'inspiry_header_variation', '=', 1 ),
        ),
        // css generation code reside in css/dynamic-css.php
        array(
            'id'        => 'inspiry_header_search_toggle_btn',
            'type'      => 'link_color',
            'title'     => __( 'Search Fields Expand & Collapse Toggle Button Background Color', 'inspiry' ),
            'active'    => false,
            'default'   => array (
                'regular'   => '#f4903f',
                'hover'     => '#0dbae8',
            ),
            'required' => array( 'inspiry_header_variation', '=', 1 ),
        ),
        // css generation code reside in css/dynamic-css.php
        array(
            'id'        => 'inspiry_header_search_toggle_btn_icon',
            'type'      => 'link_color',
            'title'     => __( 'Search Fields Expand & Collapse Toggle Button Icon Color', 'inspiry' ),
            'active'    => false,
            'default'   => array (
                'regular'   => '#C15302',
                'hover'     => '#ffffff',
            ),
            'required' => array( 'inspiry_header_variation', '=', 1 ),
        ),
        // css generation code reside in css/dynamic-css.php
        array(
            'id'        => 'inspiry_header_search_btn_bg',
            'type'      => 'link_color',
            'title'     => __( 'Search Button Background Color', 'inspiry' ),
            'active'    => false,
            'default'   => array (
                'regular'   => '#191c20',
                'hover'     => '#0dbae8',
            ),
            'required' => array( 'inspiry_header_variation', '=', 1 ),
        ),
        array(
            'id'   =>'inspiry_header_search_divider',
            'type' => 'divide',
            'required' => array( 'inspiry_header_variation', '=', 1 ),
        ),


        /**********************
          Header variation two
         ***********************/

        array(
            'id'        => 'inspiry_2nd_header_background',
            'type'      => 'color',
            'mode'      => 'background-color',
            'output'    => array( '.header-variation-two' ),
            'title'     => __( 'Header Background Color', 'inspiry' ),
            'desc'      => 'default: #ffffff',
            'default'   => '#ffffff',
            'transparent' => false,
            'required' => array( 'inspiry_header_variation', '=', 2 ),
        ),
        array(
            'id'        => 'inspiry_2nd_header_logo_text_color',
            'type'      => 'link_color',
            'title'     => __( 'Text Logo Color', 'inspiry' ),
            'active'    => true,
            'output'    => array( '.header-variation-two .site-logo a' ),
            'default'   => array(
                'regular' => '#191c20',
                'hover'   => '#0dbae8',
                'active'  => '#0dbae8',
            ),
            'required' => array( 'inspiry_header_variation', '=', 2 ),
        ),
        array(
            'id'        => 'inspiry_2nd_header_tag_line_color',
            'type'      => 'color',
            'output'    => array( '.header-variation-two .tag-line' ),
            'title'     => __( 'Tagline Color', 'inspiry' ),
            'desc'      => 'default: #4a525d',
            'default'   => '#4a525d',
            'validate'  => 'color',
            'transparent' => false,
            'required' => array( 'inspiry_header_variation', '=', 2 ),
        ),
        array(
            'id'   =>'inspiry_2nd_logo_divider',
            'type' => 'divide',
            'required' => array( 'inspiry_header_variation', '=', 2 ),
        ),

        // Header top
        array(
            'id'        => 'inspiry_2nd_header_border_color',
            'type'      => 'color',
            'mode'      => 'border-color',
            'output'    => array( '.header-variation-two .header-top' ),
            'title'     => __( 'Border Color', 'inspiry' ),
            'desc'      => 'default: #e2e2e2',
            'default'   => '#e2e2e2',
            'transparent' => false,
            'required' => array( 'inspiry_header_variation', '=', 2 ),
        ),
        array(
            'id'        => 'inspiry_2nd_header_social_icons_color',
            'type'      => 'color',
            'output'    => array( '.header-variation-two .header-social-nav > a' ),
            'title'     => __( 'Social Icons Color', 'inspiry' ),
            'desc'      => 'default: #b1b1b1',
            'default'   => '#b1b1b1',
            'validate'  => 'color',
            'transparent' => false,
            'required' => array( 'inspiry_header_variation', '=', 2 ),
        ),
        // css generation code reside in css/dynamic-css.php
        array(
            'id'        => 'inspiry_2nd_header_submit_btn_bg',
            'type'      => 'link_color',
            'title'     => __( 'Submit Button Background Color', 'inspiry' ),
            'active'    => false,
            'default'   => array (
                'regular'   => '#ff8000',
                'hover'     => '#0dbae8',
            ),
            'required' => array( 'inspiry_header_variation', '=', 2 ),
        ),
        // css generation code reside in css/dynamic-css.php
        array(
            'id'        => 'inspiry_2nd_header_submit_btn_text',
            'type'      => 'link_color',
            'title'     => __( 'Submit Button Text Color', 'inspiry' ),
            'active'    => false,
            'default'   => array (
                'regular'   => '#ffffff',
                'hover'     => '#ffffff',
            ),
            'required' => array( 'inspiry_header_variation', '=', 2 ),
        ),
        array(
            'id'       => 'inspiry_2nd_header_user_nav',
            'type'     => 'link_color',
            'title'    => __( 'User Navigation Colors', 'inspiry' ),
            'output'   => array( '.user-nav a' ),
            'default'  => array(
                'regular' => '#7c848b',
                'hover'   => '#4a525d',
                'active'  => '#4a525d',
            ),
            'required' => array( 'inspiry_header_variation', '=', 2 ),
        ),
        array(
            'id'        => 'inspiry_2nd_header_phone_text',
            'type'      => 'color',
            'output'    => array(
                '.header-variation-two .contact-number a',
                '.header-variation-two .contact-number span'
            ),
            'title'     => __( 'Phone Text Color', 'inspiry' ),
            'desc'      => 'default: #0080bc',
            'default'   => '#0080bc',
            'validate'  => 'color',
            'transparent' => false,
            'required' => array( 'inspiry_header_variation', '=', 2 ),
        ),
        array(
            'id'        => 'inspiry_2nd_header_phone_icon',
            'type'      => 'color',
            'title'     => __( 'Phone Icon Color', 'inspiry' ),
            'desc'      => 'default: #0080BC',
            'default'   => '#0080BC',
            'validate'  => 'color',
            'transparent' => false,
            'required' => array( 'inspiry_header_variation', '=', 2 ),
        ),
        array(
            'id'   =>'inspiry_2nd_header_top_divider',
            'type' => 'divide',
            'required' => array( 'inspiry_header_variation', '=', 2 ),
        ),

        // Menu
        array(
            'id'        => 'inspiry_2nd_header_menu_text',
            'type'      => 'color',
            'output'    => array( '.header-variation-two .main-menu > li > a' ),
            'title'     => __( 'Main Menu Text Color', 'inspiry' ),
            'desc'      => 'default: #191c20',
            'default'   => '#191c20',
            'validate'  => 'color',
            'transparent' => false,
            'required' => array( 'inspiry_header_variation', '=', 2 ),
        ),
        array(
            'id'        => 'inspiry_2nd_header_menu_text_hover',
            'type'      => 'color',
            'output'    => array( '.header-variation-two .main-menu li:hover > a' ),
            'title'     => __( 'Main Menu Text Color on Hover', 'inspiry' ),
            'desc'      => 'default: #ffffff',
            'default'   => '#ffffff',
            'validate'  => 'color',
            'transparent' => false,
            'required' => array( 'inspiry_header_variation', '=', 2 ),
        ),
        array(
            'id'        => 'inspiry_2nd_header_menu_bg',
            'type'      => 'color',
            'mode'      => 'background-color',
            'output'    => array(
                '.header-variation-two .main-menu li:hover > a',
                '.header-variation-two .sub-menu',
            ),
            'title'     => __( 'Main Menu Hover and Dropdown Background Color', 'inspiry' ),
            'desc'      => 'default: #4a525d',
            'default'   => '#4a525d',
            'transparent' => false,
            'required'  => array( 'inspiry_header_variation', '=', 2 ),
        ),
        array(
            'id'        => 'inspiry_2nd_header_dropdown_text',
            'type'      => 'color',
            'output'    => array( '.header-variation-two .sub-menu a' ),
            'title'     => __( 'Main Menu Dropdown Text Color', 'inspiry' ),
            'desc'      => 'default: #9ba4b3',
            'default'   => '#9ba4b3',
            'validate'  => 'color',
            'transparent' => false,
            'required' => array( 'inspiry_header_variation', '=', 2 ),
        ),
        array(
            'id'        => 'inspiry_2nd_header_dropdown_text_hover',
            'type'      => 'color',
            'output'    => array( '.header-variation-two .main-menu .sub-menu li:hover > a' ),
            'title'     => __( 'Main Menu Dropdown Text Color on Hover', 'inspiry' ),
            'desc'      => 'default: #ffffff',
            'default'   => '#ffffff',
            'validate'  => 'color',
            'transparent' => false,
            'required' => array( 'inspiry_header_variation', '=', 2 ),
        ),
        array(
            'id'        => 'inspiry_2nd_header_dropdown_sep',
            'type'      => 'color',
            'mode'      => 'background-color',
            'output'    => array( '.header-variation-two .sub-menu a:after' ),
            'title'     => __( 'Main Menu Dropdown Separator Color', 'inspiry' ),
            'desc'      => 'default: #5a626e',
            'default'   => '#5a626e',
            'validate'  => 'color',
            'transparent' => false,
            'required' => array( 'inspiry_header_variation', '=', 2 ),
        ),


        /**********************
        Header variation three
         ***********************/

        array(
            'id'        => 'inspiry_3rd_header_background',
            'type'      => 'color',
            'mode'      => 'background-color',
            'output'    => array( '.header-variation-three' ),
            'title'     => __( 'Header Background Color', 'inspiry' ),
            'desc'      => 'default: #191c20',
            'default'   => '#191c20',
            'transparent' => false,
            'required' => array( 'inspiry_header_variation', '=', 3 ),
        ),
        array(
            'id'        => 'inspiry_3rd_header_logo_text_color',
            'type'      => 'link_color',
            'title'     => __( 'Text Logo Color', 'inspiry' ),
            'active'    => true,
            'output'    => array( '.header-variation-three .site-logo a' ),
            'default'   => array(
                'regular' => '#ffffff',
                'hover'   => '#0dbae8',
                'active'  => '#0dbae8',
            ),
            'required' => array( 'inspiry_header_variation', '=', 3 ),
        ),
        array(
            'id'        => 'inspiry_3rd_header_tag_line_color',
            'type'      => 'color',
            'output'    => array( '.header-variation-three .tag-line' ),
            'title'     => __( 'Tagline Color', 'inspiry' ),
            'desc'      => 'default: #4a525d',
            'default'   => '#4a525d',
            'validate'  => 'color',
            'transparent' => false,
            'required' => array( 'inspiry_header_variation', '=', 3 ),
        ),
        array(
            'id'   =>'inspiry_3rd_logo_divider',
            'type' => 'divide',
            'required' => array( 'inspiry_header_variation', '=', 3 ),
        ),
        // Header top
        array(
            'id'        => 'inspiry_3rd_header_border_color',
            'type'      => 'color',
            'mode'      => 'border-color',
            'output'    => array( '.header-variation-three .header-top' ),
            'title'     => __( 'Border Color', 'inspiry' ),
            'desc'      => 'default: #2e3135,' . ' ' . __( 'This border appears on smaller screen sizes.', 'inspiry' ),
            'default'   => '#2e3135',
            'transparent' => false,
            'required' => array( 'inspiry_header_variation', '=', 3 ),
        ),
        array(
            'id'       => 'inspiry_3rd_header_user_nav',
            'type'     => 'link_color',
            'title'    => __( 'User Navigation Colors', 'inspiry' ),
            'output'   => array(
                '.header-variation-three .user-nav a,
                 .header-variation-three .header-social-nav > a'
            ),
            'default'  => array(
                'regular' => '#737a84',
                'hover'   => '#ffffff',
                'active'  => '#ffffff',
            ),
            'required' => array( 'inspiry_header_variation', '=', 3 ),
        ),
        array(
            'id'        => 'inspiry_3rd_header_phone_text',
            'type'      => 'color',
            'output'    => array(
                '.header-variation-three .contact-number a',
                '.header-variation-three .contact-number span'
            ),
            'title'     => __( 'Phone Text Color', 'inspiry' ),
            'desc'      => 'default: #0dbae8',
            'default'   => '#0dbae8',
            'validate'  => 'color',
            'transparent' => false,
            'required' => array( 'inspiry_header_variation', '=', 3 ),
        ),
        array(
            'id'        => 'inspiry_3rd_header_phone_icon',
            'type'      => 'color',
            'title'     => __( 'Phone Icon Color', 'inspiry' ),
            'desc'      => 'default: #0dbae8',
            'default'   => '#0dbae8',
            'validate'  => 'color',
            'transparent' => false,
            'required' => array( 'inspiry_header_variation', '=', 3 ),
        ),
        array(
            'id'   =>'inspiry_3rd_header_top_divider',
            'type' => 'divide',
            'required' => array( 'inspiry_header_variation', '=', 3 ),
        ),

        // Menu
        array(
            'id'        => 'inspiry_3rd_header_menu_text',
            'type'      => 'color',
            'output'    => array( '.header-variation-three .main-menu > li > a' ),
            'title'     => __( 'Main Menu Text Color', 'inspiry' ),
            'desc'      => 'default: #ffffff',
            'default'   => '#ffffff',
            'validate'  => 'color',
            'transparent' => false,
            'required' => array( 'inspiry_header_variation', '=', 3 ),
        ),
        array(
            'id'        => 'inspiry_3rd_header_menu_text_hover',
            'type'      => 'color',
            'output'    => array( '.header-variation-three .main-menu li:hover > a' ),
            'title'     => __( 'Main Menu Text Color on Hover', 'inspiry' ),
            'desc'      => 'default: #ffffff',
            'default'   => '#ffffff',
            'validate'  => 'color',
            'transparent' => false,
            'required' => array( 'inspiry_header_variation', '=', 3 ),
        ),
        array(
            'id'        => 'inspiry_3rd_header_menu_bg',
            'type'      => 'color',
            'mode'      => 'background-color',
            'output'    => array(
                '.header-variation-three .main-menu li:hover > a',
                '.header-variation-three .main-menu > .current-menu-item > a',
                '.header-variation-three .sub-menu',
            ),
            'title'     => __( 'Main Menu Hover and Dropdown Background Color', 'inspiry' ),
            'desc'      => 'default: #50b848',
            'default'   => '#50b848',
            'transparent' => false,
            'required'  => array( 'inspiry_header_variation', '=', 3 ),
        ),
        array(
            'id'        => 'inspiry_3rd_header_dropdown_text',
            'type'      => 'color',
            'output'    => array( '.header-variation-three .sub-menu a' ),
            'title'     => __( 'Main Menu Dropdown Text Color', 'inspiry' ),
            'desc'      => 'default: #b8eab4                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 ',
            'default'   => '#b8eab4',
            'validate'  => 'color',
            'transparent' => false,
            'required' => array( 'inspiry_header_variation', '=', 3 ),
        ),
        array(
            'id'        => 'inspiry_3rd_header_dropdown_text_hover',
            'type'      => 'color',
            'output'    => array( '.header-variation-three .main-menu .sub-menu li:hover > a' ),
            'title'     => __( 'Main Menu Dropdown Text Color on Hover', 'inspiry' ),
            'desc'      => 'default: #ffffff',
            'default'   => '#ffffff',
            'validate'  => 'color',
            'transparent' => false,
            'required' => array( 'inspiry_header_variation', '=', 3 ),
        ),
        array(
            'id'        => 'inspiry_3rd_header_dropdown_sep',
            'type'      => 'color',
            'mode'      => 'background-color',
            'output'    => array( '.header-variation-three .sub-menu a:after' ),
            'title'     => __( 'Main Menu Dropdown Separator Color', 'inspiry' ),
            'desc'      => 'default: #66c55e',
            'default'   => '#66c55e',
            'validate'  => 'color',
            'transparent' => false,
            'required' => array( 'inspiry_header_variation', '=', 3 ),
        ),


    ) ) );