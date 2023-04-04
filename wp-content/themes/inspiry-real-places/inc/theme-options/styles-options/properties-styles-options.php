<?php
/*
 * Home Properties Styles Options
 */
global $opt_name;

Redux::setSection( $opt_name, array(
    'title' => __( 'Home Properties', 'inspiry'),
    'id'    => 'home-properties-styles',
    'desc'  => __('This section contains home properties styles options.', 'inspiry' ),
    'subsection' => true,
    'fields'=> array (

        array(
            'id'    => 'home_properties_section_info',
            'type'  => 'info',
            'style' => 'success',
            'title' => __('Home Properties Variation One', 'inspiry'),
            'desc'  => __('This variation consists of two different designs.', 'inspiry' ),
            'required' => array( 'inspiry_home_properties_variation', '=', 1 ),
        ),


        /**********************
          Home Properties One - Property Design One
         ***********************/

        // @abbreviation home_properties_one_property_design_one = hp_1_pd_1
        array(
            'id' => 'property-design-one',
            'type' => 'section',
            'title' => __('Property Design One', 'inspiry'),
            'indent' => true,
            'required' => array( 'inspiry_home_properties_variation', '=', 1 ),
        ),

        array(
            'id'        => 'inspiry_hp_1_pd_1_background',
            'type'      => 'color',
            'mode'      => 'background-color',
            'output'    => array(
                '.row-odd .property-post-odd',
                '.row-even .property-post-even',
            ),
            'title'     => __( 'Background Color', 'inspiry' ),
            'desc'      => 'default: #4a525d',
            'default'   => '#4a525d',
            'validate'  => 'color',
            'transparent' => false,
        ),

        array(
            'id'        => 'inspiry_hp_1_pd_1_title_color',
            'type'      => 'link_color',
            'output'    => array(
                '.row-odd .property-post-odd a',
                '.row-even .property-post-even a',
            ),
            'title'     => __( 'Title Color', 'inspiry' ),
            'default'   => array(
                'regular' => '#ffffff',
                'hover'   => '#0dbae8',
                'active'  => '#0dbae8',
            ),
            'transparent' => false,
        ),

        array(
            'id'        => 'inspiry_hp_1_pd_1_price_color',
            'type'      => 'color',
            'output'    => array(
                '.row-odd .property-post-odd .price',
                '.row-even .property-post-even .price',
            ),
            'title'     => __( 'Price Color', 'inspiry' ),
            'default'   => '#0dbae8',
            'validate'  => 'color',
            'transparent' => false,
        ),

        array(
            'id'        => 'inspiry_hp_1_pd_1_status_tag_color',
            'type'      => 'link_color',
            'output'    => array(
                '.row-odd .property-post-odd .property-status-tag',
                '.row-even .property-post-even .property-status-tag',
            ),
            'title'     => __( 'Status Tag Text Color', 'inspiry' ),
            'active'    => false,
            'default'   => array(
                'regular' => '#4a525d',
                'hover'   => '#ffffff',
            ),
            'transparent' => false,
        ),

        array(
            'id'        => 'inspiry_hp_1_pd_1_status_tag_background',
            'type'      => 'color',
            'mode'      => 'background-color',
            'output'    => array(
                '.row-odd .property-post-odd .property-status-tag',
                '.row-even .property-post-even .property-status-tag',
            ),
            'title'     => __( 'Status Tag Background Color', 'inspiry' ),
            'desc'      => 'default: #ffffff',
            'default'   => '#ffffff',
            'validate'  => 'color',
            'transparent' => false,
        ),

        array(
            'id'        => 'inspiry_hp_1_pd_1_status_tag_hover_background',
            'type'      => 'color',
            'mode'      => 'background-color',
            'output'    => array(
                '.row-odd .property-post-odd .property-status-tag:hover',
                '.row-even .property-post-even .property-status-tag:hover',
            ),
            'title'     => __( 'Status Tag Background Color on Hover', 'inspiry' ),
            'desc'      => 'default: #ff8000',
            'default'   => '#ff8000',
            'validate'  => 'color',
            'transparent' => false,
        ),

        array(
            'id'        => 'inspiry_hp_1_pd_1_color',
            'type'      => 'color',
            'output'    => array(
                '.row-odd .property-post-odd',
                '.row-even .property-post-even',
                '.row-odd .property-post-odd .meta-item-unit',
                '.row-even .property-post-even .meta-item-unit',
            ),
            'title'     => __( 'Meta Text Color', 'inspiry' ),
            'desc'      => 'default: #c0c5cd',
            'default'   => '#c0c5cd',
            'validate'  => 'color',
            'transparent' => false,

        ),

        array(
            'id'        => 'inspiry_hp_1_pd_1_value_color',
            'type'      => 'color',
            'output'    => array(
                '.row-odd .property-post-odd .meta-item-value',
                '.row-even .property-post-even .meta-item-value',
            ),
            'title'     => __( 'Meta Value Text Color', 'inspiry' ),
            'desc'      => 'default: #ffffff',
            'default'   => '#ffffff',
            'validate'  => 'color',
            'transparent' => false,
        ),

        // css generation code reside in css/dynamic-css.php
        array(
            'id'        => 'inspiry_hp_1_pd_1_meta_icon_color',
            'type'      => 'color',
            'title'     => __( 'Meta Icons Color', 'inspiry' ),
            'desc'      => 'default: #0dbae8',
            'default'   => '#0dbae8',
            'validate'  => 'color',
            'transparent' => false,
        ),


        /**********************
          Home Properties One - Property Design Two
         ***********************/

        // @abbreviation home_properties_one_property_design_two = hp_1_pd_2
        array(
            'id' => 'property-design-two',
            'type' => 'section',
            'title' => __('Property Design Two', 'inspiry'),
            'indent' => true,
            'required' => array( 'inspiry_home_properties_variation', '=', 1 ),
        ),

        array(
            'id'        => 'inspiry_hp_1_pd_2_background',
            'type'      => 'color',
            'mode'      => 'background-color',
            'output'    => array(
                '.row-odd .property-post-even',
                '.row-even .property-post-odd',
            ),
            'title'     => __( 'Background Color', 'inspiry' ),
            'desc'      => 'default: #e9edf1',
            'default'   => '#e9edf1',
            'validate'  => 'color',
            'transparent' => false,
        ),

        array(
            'id'        => 'inspiry_hp_1_pd_2_title_color',
            'type'      => 'link_color',
            'output'    => array(
                '.row-odd .property-post-even a',
                '.row-even .property-post-odd a',
            ),
            'title'     => __( 'Title Color', 'inspiry' ),
            'default'   => array(
                'regular' => '#4a525d',
                'hover'   => '#0dbae8',
                'active'  => '#0dbae8',
            ),
            'transparent' => false,
        ),

        array(
            'id'        => 'inspiry_hp_1_pd_2_price_color',
            'type'      => 'color',
            'output'    => array(
                '.row-odd .property-post-even .price',
                '.row-even .property-post-odd .price',
            ),
            'title'     => __( 'Price Color', 'inspiry' ),
            'desc'      => 'default: #0dbae8',
            'default'   => '#0dbae8',
            'validate'  => 'color',
            'transparent' => false,
        ),

        array(
            'id'        => 'inspiry_hp_1_pd_2_status_tag_color',
            'type'      => 'link_color',
            'output'    => array(
                '.row-odd .property-post-even .property-status-tag',
                '.row-even .property-post-odd .property-status-tag',
            ),
            'title'     => __( 'Status Tag Text Color', 'inspiry' ),
            'active'    => false,
            'default'   => array(
                'regular' => '#ffffff',
                'hover'   => '#ffffff',
            ),
            'transparent' => false,
        ),

        array(
            'id'        => 'inspiry_hp_1_pd_2_status_tag_background',
            'type'      => 'color',
            'mode'      => 'background-color',
            'output'    => array(
                '.row-odd .property-post-even .property-status-tag',
                '.row-even .property-post-odd .property-status-tag',
            ),
            'title'     => __( 'Status Tag Background Color', 'inspiry' ),
            'desc'      => 'default: #4a525d',
            'default'   => '#4a525d',
            'validate'  => 'color',
            'transparent' => false,
        ),

        array(
            'id'        => 'inspiry_hp_1_pd_2_status_tag_hover_background',
            'type'      => 'color',
            'mode'      => 'background-color',
            'output'    => array(
                '.row-odd .property-post-even .property-status-tag:hover',
                '.row-even .property-post-odd .property-status-tag:hover',
            ),
            'title'     => __( 'Status Tag Background Color on Hover', 'inspiry' ),
            'desc'      => 'default: #ff8000',
            'default'   => '#ff8000',
            'validate'  => 'color',
            'transparent' => false,
        ),

        array(
            'id'        => 'inspiry_hp_1_pd_2_color',
            'type'      => 'color',
            'output'    => array(
                '.row-odd .property-post-even',
                '.row-even .property-post-odd',
                '.row-odd .property-post-even .meta-item-unit',
                '.row-even .property-post-odd .meta-item-unit',
            ),
            'title'     => __( 'Meta Text Color', 'inspiry' ),
            'desc'      => 'default: #6a7585',
            'default'   => '#6a7585',
            'validate'  => 'color',
            'transparent' => false,
        ),

        array(
            'id'        => 'inspiry_hp_1_pd_2_value_color',
            'type'      => 'color',
            'output'    => array(
                '.row-odd .property-post-even .meta-item-value',
                '.row-even .property-post-odd .meta-item-value',
            ),
            'title'     => __( 'Meta Value Text Color', 'inspiry' ),
            'desc'      => 'default: #4a525d',
            'default'   => '#4a525d',
            'validate'  => 'color',
            'transparent' => false,
        ),

        // css generation code reside in css/dynamic-css.php
        array(
            'id'        => 'inspiry_hp_1_pd_2_meta_icon_color',
            'type'      => 'color',
            'title'     => __( 'Meta Icons Color', 'inspiry' ),
            'desc'      => 'default: #0dbae8',
            'default'   => '#0dbae8',
            'validate'  => 'color',
            'transparent' => false,
        ),


        /**********************
           Home Properties Two
         ***********************/

        // @abbreviation home_properties_two = hp_2
        array(
            'id' => 'inspiry_hp_2',
            'type' => 'section',
            'title' => __('Home Properties Variation Two', 'inspiry'),
            'indent' => true,
            'required' => array( 'inspiry_home_properties_variation', '=', 2 ),
        ),

        array(
            'id'        => 'inspiry_hp_2_background',
            'type'      => 'color_rgba',
            'mode'      => 'background-color',
            'output'    => array( '.property-listing-two .property-description' ),
            'title'     => __( 'Background Color', 'inspiry' ),
            'desc'      => 'default: rgba(47, 53, 61, 0.9)',
            'default'   => array(
                'color'     => '#1c1f23',
                'alpha'     => 0.9
            ),
        ),

        array(
            'id'        => 'inspiry_hp_2_hover_background',
            'type'      => 'color_rgba',
            'mode'      => 'background-color',
            'output'    => array( '.property-listing-two .property-description:hover' ),
            'title'     => __( 'Background Color on Hover', 'inspiry' ),
            'desc'      => 'default: rgba(237, 106, 0, 0.9)',
            'default'   => array(
                'color'     => '#ed6a00',
                'alpha'     => 0.9
            ),
        ),

        array(
            'id'        => 'inspiry_hp_2_title_color',
            'type'      => 'link_color',
            'output'    => array( '.property-listing-two a' ),
            'title'     => __( 'Title Color', 'inspiry' ),
            'default'   => array(
                'regular' => '#ffffff',
                'hover'   => '#804000',
                'active'  => '#804000',
            ),
            'transparent' => false,
        ),

        array(
            'id'        => 'inspiry_hp_2_price_color',
            'type'      => 'color',
            'output'    => array( '.property-listing-two .price' ),
            'title'     => __( 'Price Color', 'inspiry' ),
            'desc'      => 'default: #0dbae8',
            'default'   => '#0dbae8',
            'validate'  => 'color',
            'transparent' => false,
        ),

        array(
            'id'        => 'inspiry_hp_2_status_tag_color',
            'type'      => 'link_color',
            'output'    => array( '.property-listing-two .property-status-tag' ),
            'title'     => __( 'Status Tag Text Color', 'inspiry' ),
            'active'    => false,
            'default'   => array(
                'regular' => '#4a525d',
                'hover'   => '#ffffff',
            ),
            'transparent' => false,
        ),

        array(
            'id'        => 'inspiry_hp_2_status_tag_background',
            'type'      => 'color',
            'mode'      => 'background-color',
            'output'    => array( '.property-listing-two .property-status-tag' ),
            'title'     => __( 'Status Tag Background Color', 'inspiry' ),
            'desc'      => 'default: #ffffff',
            'default'   => '#ffffff',
            'validate'  => 'color',
            'transparent' => false,
        ),

        array(
            'id'        => 'inspiry_hp_2_status_tag_hover_background',
            'type'      => 'color',
            'mode'      => 'background-color',
            'output'    => array( '.property-listing-two .property-status-tag:hover' ),
            'title'     => __( 'Status Tag Background Color on Hover', 'inspiry' ),
            'desc'      => 'default: #994d00',
            'default'   => '#994d00',
            'validate'  => 'color',
            'transparent' => false,
        ),

        array(
            'id'        => 'inspiry_hp_2_color',
            'type'      => 'color',
            'output'    => array( '.property-listing-two' ),
            'title'     => __( 'Meta and Price Text Color on hover', 'inspiry' ),
            'desc'      => 'default: #ffffff',
            'default'   => '#ffffff',
            'validate'  => 'color',
            'transparent' => false,
        ),

        // css generation code reside in css/dynamic-css.php
        array(
            'id'        => 'inspiry_hp_2_meta_icon_color',
            'type'      => 'color',
            'title'     => __( 'Meta Icons Color', 'inspiry' ),
            'desc'      => 'default: #ffffff',
            'default'   => '#ffffff',
            'validate'  => 'color',
            'transparent' => false,
        ),


        /**********************
          Home Properties Three
         ***********************/

        // @abbreviation home_properties_three = hp_3
        array(
            'id' => 'inspiry_hp_3',
            'type' => 'section',
            'title' => __('Home Properties Variation Three', 'inspiry'),
            'indent' => true,
            'required' => array( 'inspiry_home_properties_variation', '=', 3 ),
        ),

        array(
            'id'        => 'inspiry_hp_3_welcome_title_color',
            'type'      => 'color',
            'output'    => array( '.welcome-text .title' ),
            'title'     => __( 'Welcome Board Title Color', 'inspiry' ),
            'desc'      => 'default: #191c20',
            'default'   => '#191c20',
            'validate'  => 'color',
            'transparent' => false,
        ),

        array(
            'id'        => 'inspiry_hp_3_welcome_text_color',
            'type'      => 'color',
            'output'    => array( '.welcome-text p' ),
            'title'     => __( 'Welcome Board Text Color', 'inspiry' ),
            'desc'      => 'default: #191c20',
            'default'   => '#191c20',
            'validate'  => 'color',
            'transparent' => false,
        ),

        array(
            'id'        => 'inspiry_hp_3_status_color',
            'type'      => 'link_color',
            'output'    => array( '.property-listing-three-post .property-status' ),
            'title'     => __( 'Status Tag Text Color', 'inspiry' ),
            'active'    => false,
            'default'   => array(
                'regular' => '#ffffff',
                'hover'   => '#ffffff',
            ),
            'transparent' => false,
        ),

        array(
            'id'        => 'inspiry_hp_3_status_background',
            'type'      => 'color',
            'mode'      => 'background-color',
            'output'    => array( '.property-listing-three-post .property-status' ),
            'title'     => __( 'Status Tag Background Color', 'inspiry' ),
            'desc'      => 'default: #0dbae8',
            'default'   => '#0dbae8',
            'validate'  => 'color',
            'transparent' => false,
        ),

        array(
            'id'        => 'inspiry_hp_3_status_hover_background',
            'type'      => 'color',
            'mode'      => 'background-color',
            'output'    => array( '.property-listing-three-post .property-status:hover' ),
            'title'     => __( 'Status Tag Background Color on Hover', 'inspiry' ),
            'desc'      => 'default: #0ca7d0',
            'default'   => '#0ca7d0',
            'validate'  => 'color',
            'transparent' => false,
        ),

        array(
            'id'        => 'inspiry_hp_3_description_background',
            'type'      => 'color',
            'mode'      => 'background-color',
            'output'    => array( '.property-listing-three-post .property-description' ),
            'title'     => __( 'Description Background Color', 'inspiry' ),
            'desc'      => 'default: #ffffff',
            'default'   => '#ffffff',
            'validate'  => 'color',
            'transparent' => false,
        ),

        array(
            'id'        => 'inspiry_hp_3_description_border',
            'type'      => 'color',
            'mode'      => 'border-color',
            'output'    => array( '.property-listing-three-post .property-description' ),
            'title'     => __( 'Description Border Color', 'inspiry' ),
            'desc'      => 'default: #ebeef2',
            'default'   => '#ebeef2',
            'validate'  => 'color',
            'transparent' => false,
        ),

        array(
            'id'        => 'inspiry_hp_3_title_color',
            'type'      => 'link_color',
            'output'    => array( '.property-listing-three-post .entry-title a' ),
            'title'     => __( 'Title Color', 'inspiry' ),
            'default'   => array(
                'regular' => '#191c20',
                'hover'   => '#0dbae8',
                'active'  => '#0dbae8',
            ),
            'transparent' => false,
        ),

        array(
            'id'        => 'inspiry_hp_3_price_color',
            'type'      => 'color',
            'output'    => array( '.property-listing-three-post .price' ),
            'title'     => __( 'Price Color', 'inspiry' ),
            'desc'      => 'default: #50b848',
            'default'   => '#50b848',
            'validate'  => 'color',
            'transparent' => false,
        ),

        array(
            'id'        => 'inspiry_hp_3_text_color',
            'type'      => 'color',
            'output'    => array(
                '.property-listing-three-post p',
                '.property-listing-three-post .meta-wrapper:before',
                '.property-listing-three-post .meta-unit',
                '.property-listing-three-post .meta-label',
            ),
            'title'     => __( 'Description and Meta Text Color', 'inspiry' ),
            'desc'      => 'default: #929ba7',
            'default'   => '#929ba7',
            'validate'  => 'color',
            'transparent' => false,
        ),

        array(
            'id'        => 'inspiry_hp_3_meta_wrapper_background',
            'type'      => 'color',
            'mode'      => 'background-color',
            'output'    => array( '.property-listing-three-post .property-meta' ),
            'title'     => __( 'Meta Wrapper Background Color', 'inspiry' ),
            'desc'      => 'default: #f7f8fa',
            'default'   => '#f7f8fa',
            'validate'  => 'color',
            'transparent' => false,
        ),

        array(
            'id'        => 'inspiry_hp_3_meta_wrapper_border',
            'type'      => 'color',
            'mode'      => 'border-color',
            'output'    => array( '.property-listing-three-post .property-meta' ),
            'title'     => __( 'Meta Wrpper Top Border Color', 'inspiry' ),
            'desc'      => 'default: #ebeef2',
            'default'   => '#ebeef2',
            'validate'  => 'color',
            'transparent' => false,
        ),

        array(
            'id'        => 'inspiry_hp_3_meta_value_color',
            'type'      => 'color',
            'output'    => array( '.property-listing-three-post .meta-value' ),
            'title'     => __( 'Meta value Color', 'inspiry' ),
            'desc'      => 'default: #0dbae8',
            'default'   => '#0dbae8',
            'validate'  => 'color',
            'transparent' => false,
        ),


    ) ) );