<?php
/*
 * Slider Styles Options
 */
global $opt_name;

Redux::setSection( $opt_name, array(
    'title' => __( 'Slider', 'inspiry'),
    'id'    => 'slider-styles',
    'desc'  => __('This section contains properties slider styles options.', 'inspiry' ),
    'subsection' => true,
    'fields'=> array (

        /**********************
          Slider variation one
         ***********************/

        array(
            'id'        => 'inspiry_slide_overlay_background',
            'type'      => 'color_rgba',
            'mode'      => 'background-color',
            'output'    => array( '.slide-inner-container' ),
            'title'     => __( 'Overlay Background Color', 'inspiry' ),
            'desc'      => 'default: rgba(25, 28, 32, 0.9)',
            'default'   => array(
                'color'     => '#1c1f23',
                'alpha'     => 0.9
            ),
            'required' => array( 'inspiry_slider_type', '=', array( 'properties-slider', 'properties-slider-two' ) ),
        ),

        array(
            'id'        => 'inspiry_slide_title_color',
            'type'      => 'link_color',
            'output'    => array( '.slide-entry-title a' ),
            'title'     => __( 'Property Title Color', 'inspiry' ),
            'default'   => array(
                'regular' => '#ffffff',
                'hover'   => '#0dbae8',
                'active'  => '#0dbae8',
            ),
            'transparent' => false,
            'required' => array( 'inspiry_slider_type', '=', array( 'properties-slider', 'properties-slider-two' ) ),
        ),

        array(
            'id'        => 'inspiry_slide_price_color',
            'type'      => 'color',
            'output'    => array( '.slide-overlay .price' ),
            'title'     => __( 'Property Price Color', 'inspiry' ),
            'desc'      => 'default: #50b848',
            'default'   => '#50b848',
            'validate'  => 'color',
            'transparent' => false,
            'required' => array( 'inspiry_slider_type', '=', array( 'properties-slider', 'properties-slider-two' ) ),
        ),

        array(
            'id'        => 'inspiry_slide_status_tag_color',
            'type'      => 'link_color',
            'output'    => array( '.slide-overlay .property-status-tag' ),
            'title'     => __( 'Property Status Text Color', 'inspiry' ),
            'active'    => false,
            'default'   => array(
                'regular' => '#4a525d',
                'hover'   => '#ffffff',
            ),
            'transparent' => false,
            'required' => array( 'inspiry_slider_type', '=', array( 'properties-slider', 'properties-slider-two' ) ),
        ),

        array(
            'id'        => 'inspiry_slide_status_tag_background',
            'type'      => 'color',
            'mode'      => 'background-color',
            'output'    => array( '.slide-overlay .property-status-tag'),
            'title'     => __( 'Property Status Background Color', 'inspiry' ),
            'desc'      => 'default: #ffffff',
            'default'   => '#ffffff',
            'validate'  => 'color',
            'transparent' => false,
            'required' => array( 'inspiry_slider_type', '=', array( 'properties-slider', 'properties-slider-two' ) ),
        ),

        array(
            'id'        => 'inspiry_slide_status_tag_hover_background',
            'type'      => 'color',
            'mode'      => 'background-color',
            'output'    => array( '.slide-overlay .property-status-tag:hover'),
            'title'     => __( 'Property Status Background Color on Hover', 'inspiry' ),
            'desc'      => 'default: #ff8000',
            'default'   => '#ff8000',
            'validate'  => 'color',
            'transparent' => false,
            'required' => array( 'inspiry_slider_type', '=', array( 'properties-slider', 'properties-slider-two' ) ),
        ),

        array(
            'id'        => 'inspiry_slide_overlay_color',
            'type'      => 'color',
            'output'    => array( '.slide-overlay' ),
            'title'     => __( 'Property Meta Text Color', 'inspiry' ),
            'desc'      => 'default: #ffffff',
            'default'   => '#ffffff',
            'validate'  => 'color',
            'transparent' => false,
            'required' => array( 'inspiry_slider_type', '=', array( 'properties-slider', 'properties-slider-two' ) ),
        ),

        array(
            'id'        => 'inspiry_slide_meta_value_color',
            'type'      => 'color',
            'output'    => array(
                '.slide-overlay .meta-item-label',
                '.slide-overlay .meta-item-unit',
            ),
            'title'     => __( 'Property Meta Value and Unit Text Color', 'inspiry' ),
            'desc'      => 'default: #939ca4',
            'default'   => '#939ca4',
            'validate'  => 'color',
            'transparent' => false,
            'required' => array( 'inspiry_slider_type', '=', array( 'properties-slider', 'properties-slider-two' ) ),
        ),

        // css generation code reside in css/dynamic-css.php
        array(
            'id'        => 'inspiry_slide_meta_icon_color',
            'type'      => 'color',
            'title'     => __( 'Property Meta Icons Color', 'inspiry' ),
            'desc'      => 'default: #f4903f',
            'default'   => '#f4903f',
            'validate'  => 'color',
            'transparent' => false,
            'required' => array( 'inspiry_slider_type', '=', array( 'properties-slider', 'properties-slider-two' ) ),
        ),


        /**********************
           Slider variation two
         ***********************/

        array(
            'id'        => 'inspiry_slide_border_color',
            'type'      => 'color',
            'mode'      => 'border-color',
            'output'    => array( '.slider-variation-two .slide-inner-container' ),
            'title'     => __( 'Overlay Top Border Color', 'inspiry' ),
            'desc'      => 'default: #d46206',
            'default'   => '#d46206',
            'transparent' => false,
            'required' => array( 'inspiry_slider_type', '=', 'properties-slider-two' ),
        ),

        array(
            'id'        => 'inspiry_slide_bottom_border_color',
            'type'      => 'color',
            'mode'      => 'border-color',
            'output'    => array( '.slider-variation-two .slide-header' ),
            'title'     => __( 'Overlay Middle Border Color', 'inspiry' ),
            'desc'      => 'default: #404245',
            'default'   => '#404245',
            'transparent' => false,
            'required' => array( 'inspiry_slider_type', '=', 'properties-slider-two' ),
        ),

        array(
            'id'        => 'inspiry_slide_button_color',
            'type'      => 'link_color',
            'output'    => array( '.slider-variation-two .btn-default' ),
            'title'     => __( 'Button Color', 'inspiry' ),
            'default'   => array(
                'regular' => '#ffffff',
                'hover'   => '#ffffff',
                'active'  => '#ffffff',
            ),
            'transparent' => false,
            'required' => array( 'inspiry_slider_type', '=', 'properties-slider-two' ),
        ),

        array(
            'id'        => 'inspiry_slide_button_background',
            'type'      => 'color',
            'mode'      => 'background-color',
            'output'    => array( '.slider-variation-two .btn-default' ),
            'title'     => __( 'Button Background Color', 'inspiry' ),
            'desc'      => 'default: #ff8000',
            'default'   => '#ff8000',
            'transparent' => false,
            'required' => array( 'inspiry_slider_type', '=', 'properties-slider-two' ),
        ),

        array(
            'id'        => 'inspiry_slide_button_hover_background',
            'type'      => 'color',
            'mode'      => 'background-color',
            'output'    => array( '.slider-variation-two .btn-default:hover' ),
            'title'     => __( 'Button Background Color on Hover', 'inspiry' ),
            'desc'      => 'default: #f07800',
            'default'   => '#f07800',
            'transparent' => false,
            'required' => array( 'inspiry_slider_type', '=', 'properties-slider-two' ),
        ),


        /**********************
           Slider variation three
         ***********************/

        array(
            'id'        => 'inspiry_3rd_slider_overlay_background',
            'type'      => 'color_rgba',
            'mode'      => 'background-color',
            'output'    => array( '.slider-variation-three .slide-inner-container' ),
            'title'     => __( 'Overlay Background Color', 'inspiry' ),
            'desc'      => 'default: rgba(255, 255, 255, 0.9)',
            'default'   => array(
                'color'     => '#ffffff',
                'alpha'     => 0.9
            ),
            'required' => array( 'inspiry_slider_type', '=', 'properties-slider-three' ),
        ),

        array(
            'id'        => 'inspiry_3rd_slider_title_color',
            'type'      => 'link_color',
            'output'    => array( '.slider-variation-three .slide-entry-title a' ),
            'title'     => __( 'Property Title Color', 'inspiry' ),
            'default'   => array(
                'regular' => '#000000',
                'hover'   => '#0dbae8',
                'active'  => '#0dbae8',
            ),
            'transparent' => false,
            'required' => array( 'inspiry_slider_type', '=', 'properties-slider-three' ),
        ),

        array(
            'id'        => 'inspiry_3rd_slider_price_color',
            'type'      => 'color',
            'output'    => array( '.slide-overlay .price' ),
            'title'     => __( 'Property Price Color', 'inspiry' ),
            'desc'      => 'default: #50b848',
            'default'   => '#50b848',
            'validate'  => 'color',
            'transparent' => false,
            'required' => array( 'inspiry_slider_type', '=', 'properties-slider-three' ),
        ),

        array(
            'id'        => 'inspiry_3rd_slider_status_tag_color',
            'type'      => 'link_color',
            'output'    => array( '.slide-overlay .property-status-tag' ),
            'title'     => __( 'Property Status Text Color', 'inspiry' ),
            'active'    => false,
            'default'   => array(
                'regular' => '#ffffff',
                'hover'   => '#ffffff',
            ),
            'transparent' => false,
            'required' => array( 'inspiry_slider_type', '=', 'properties-slider-three' ),
        ),

        array(
            'id'        => 'inspiry_3rd_slider_status_tag_background',
            'type'      => 'color',
            'mode'      => 'background-color',
            'output'    => array( '.slide-overlay .property-status-tag'),
            'title'     => __( 'Property Status Background Color', 'inspiry' ),
            'desc'      => 'default: #50b848',
            'default'   => '#50b848',
            'validate'  => 'color',
            'transparent' => false,
            'required' => array( 'inspiry_slider_type', '=', 'properties-slider-three' ),
        ),

        array(
            'id'        => 'inspiry_3rd_slider_status_tag_hover_background',
            'type'      => 'color',
            'mode'      => 'background-color',
            'output'    => array( '.slide-overlay .property-status-tag:hover'),
            'title'     => __( 'Property Status Background Color on Hover', 'inspiry' ),
            'desc'      => 'default: #409439',
            'default'   => '#409439',
            'validate'  => 'color',
            'transparent' => false,
            'required' => array( 'inspiry_slider_type', '=', 'properties-slider-three' ),
        ),

        array(
            'id'        => 'inspiry_3rd_slider_text_color',
            'type'      => 'color',
            'output'    => array( '.slider-variation-three p'),
            'title'     => __( 'Property Description Text Color', 'inspiry' ),
            'desc'      => 'default: #929ba7',
            'default'   => '#929ba7',
            'validate'  => 'color',
            'transparent' => false,
            'required' => array( 'inspiry_slider_type', '=', 'properties-slider-three' ),
        ),

        array(
            'id'        => 'inspiry_3rd_slider_button_color',
            'type'      => 'link_color',
            'output'    => array( '.slider-variation-three .btn-default' ),
            'title'     => __( 'Button Color', 'inspiry' ),
            'default'   => array(
                'regular' => '#ffffff',
                'hover'   => '#ffffff',
                'active'  => '#ffffff',
            ),
            'transparent' => false,
            'required' => array( 'inspiry_slider_type', '=', 'properties-slider-three' ),
        ),

        array(
            'id'        => 'inspiry_3rd_slider_button_background',
            'type'      => 'color',
            'mode'      => 'background-color',
            'output'    => array( '.slider-variation-three .btn-default' ),
            'title'     => __( 'Button Background Color', 'inspiry' ),
            'desc'      => 'default: #0dbae8',
            'default'   => '#0dbae8',
            'transparent' => false,
            'required' => array( 'inspiry_slider_type', '=', 'properties-slider-three' ),
        ),

        array(
            'id'        => 'inspiry_3rd_slider_button_hover_background',
            'type'      => 'color',
            'mode'      => 'background-color',
            'output'    => array( '.slider-variation-three .btn-default:hover' ),
            'title'     => __( 'Button Hover Background Color', 'inspiry' ),
            'desc'      => 'default: #0caeda',
            'default'   => '#0caeda',
            'transparent' => false,
            'required' => array( 'inspiry_slider_type', '=', 'properties-slider-three' ),
        ),


    ) ) );