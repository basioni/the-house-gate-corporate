<?php
if ( !function_exists( 'inspiry_produce_dynamic_css' ) ) {
    /**
     * Produce css based on given array
     * @param $dynamic_css_array
     */
    function inspiry_produce_dynamic_css ( $dynamic_css_array )
    {
        foreach ( $dynamic_css_array as $css_unit ) {
            if ( ! empty( $css_unit[ 'value' ] ) ) {
                echo $css_unit[ 'elements' ] . "{\n";
                echo $css_unit[ 'property' ] . ":" . $css_unit[ 'value' ] . ";\n";
                echo "}\n\n";
            }
        }
    }
}


if ( !function_exists( 'inspiry_generate_dynamic_css' ) ) {
    /**
     * Generate dynamic css
     */
    function inspiry_generate_dynamic_css()
    {

        global $inspiry_options;

        $dynamic_css = array();
        $dynamic_css_min_width_1200px = array();

        $header_variation = $inspiry_options['inspiry_header_variation'];

        /*
         * HEADER VARIATION ONE
         */

        if ( $header_variation == 1 ) {

            $menu_button_bg = $inspiry_options['inspiry_menu_button_bg'];
            $menu_button_text = $inspiry_options['inspiry_menu_button_txt'];
            $main_menu_close = $inspiry_options['inspiry_main_menu_close'];
            $header_phone_icon = $inspiry_options['inspiry_header_phone_icon'];
            $header_search_toggle_btn = $inspiry_options['inspiry_header_search_toggle_btn'];
            $header_search_toggle_btn_icon = $inspiry_options['inspiry_header_search_toggle_btn_icon'];
            $header_search_btn_bg = $inspiry_options['inspiry_header_search_btn_bg'];

            // Menu button
            $dynamic_css[] = array(
                'elements' => '.button-menu-reveal, .button-menu-reveal.active',
                'property' => 'background-color',
                'value' => $menu_button_bg['regular']
            );
            $dynamic_css[] = array(
                'elements' => '.button-menu-reveal:hover',
                'property' => 'background-color',
                'value' => $menu_button_bg['hover']
            );
            $dynamic_css[] = array(
                'elements' => '.button-menu-reveal',
                'property' => 'color',
                'value' => $menu_button_text['regular']
            );
            $dynamic_css[] = array(
                'elements' => '.button-menu-reveal:hover',
                'property' => 'color',
                'value' => $menu_button_text['hover']
            );

            // Menu Close Button
            $dynamic_css[] = array(
                'elements' => '.button-menu-close',
                'property' => 'background-color',
                'value' => $main_menu_close['regular']
            );
            $dynamic_css[] = array(
                'elements' => '.button-menu-close:hover',
                'property' => 'background-color',
                'value' => $main_menu_close['hover']
            );

            // Header phone icon - header variation one
            $dynamic_css[] = array(
                'elements' => '.contact-number .contacts-icon-container .contacts-icon',
                'property' => 'fill',
                'value' => $header_phone_icon,
            );

            // Search Fields Collapse & Expand Button
            $dynamic_css[] = array(
                'elements' => '.hidden-fields-reveal-btn',
                'property' => 'background-color',
                'value' => $header_search_toggle_btn['regular']
            );
            $dynamic_css[] = array(
                'elements' => '.hidden-fields-reveal-btn:hover',
                'property' => 'background-color',
                'value' => $header_search_toggle_btn['hover']
            );
            $dynamic_css[] = array(
                'elements' => '.hidden-fields-reveal-btn .icon-plus-container g',
                'property' => 'fill',
                'value' => $header_search_toggle_btn_icon['regular']
            );
            $dynamic_css[] = array(
                'elements' => '.hidden-fields-reveal-btn:hover .icon-plus-container g, .hidden-fields-reveal-btn:hover .icon',
                'property' => 'fill',
                'value' => $header_search_toggle_btn_icon['hover']
            );

            // search button
            $dynamic_css[] = array(
                'elements' => '.header-advance-search .form-submit-btn',
                'property' => 'background-color',
                'value' => $header_search_btn_bg['regular']
            );
            $dynamic_css[] = array(
                'elements' => '.header-advance-search .form-submit-btn:hover',
                'property' => 'background-color',
                'value' => $header_search_btn_bg['hover']
            );

        } elseif ( $header_variation == 2 ) {

            $header_border_color = $inspiry_options['inspiry_2nd_header_border_color'];
            $header_submit_btn_bg = $inspiry_options['inspiry_2nd_header_submit_btn_bg'];
            $header_submit_btn_text = $inspiry_options['inspiry_2nd_header_submit_btn_text'];
            $header_phone_icon = $inspiry_options['inspiry_2nd_header_phone_icon'];

            // header border color
            $dynamic_css_min_width_1200px[] = array(
                'elements' => '.header-variation-two .header-social-nav .fa',
                'property' => 'border-color',
                'value' => $header_border_color,
            );

            // submit button
            $dynamic_css_min_width_1200px[] = array(
                'elements' => '.header-variation-two .submit-property-link',
                'property' => 'background-color',
                'value' => $header_submit_btn_bg['regular'],
            );
            $dynamic_css_min_width_1200px[] = array(
                'elements' => '.header-variation-two .submit-property-link:hover',
                'property' => 'background-color',
                'value' => $header_submit_btn_bg['hover'],
            );
            $dynamic_css_min_width_1200px[] = array(
                'elements' => '.header-variation-two .submit-property-link',
                'property' => 'color',
                'value' => $header_submit_btn_text['regular'],
            );
            $dynamic_css_min_width_1200px[] = array(
                'elements' => '.header-variation-two .submit-property-link:hover',
                'property' => 'color',
                'value' => $header_submit_btn_text['hover'],
            );

            // Header phone icon
            $dynamic_css[] = array(
                'elements' => '.contact-number .contacts-icon-container .contacts-icon',
                'property' => 'fill',
                'value' => $header_phone_icon,
            );

        } elseif ( $header_variation == 3 ) {

            $inspiry_3rd_header_user_nav = $inspiry_options['inspiry_3rd_header_user_nav'];
            $inspiry_3rd_header_phone_icon = $inspiry_options['inspiry_3rd_header_phone_icon'];

            // SVG color in User Nav
            $dynamic_css[] = array(
                'elements' => '.header-variation-three .icon-email-two,
                                 .header-variation-three .icon-lock',
                'property' => 'fill',
                'value' => $inspiry_3rd_header_user_nav['regular'],
            );

            $dynamic_css[] = array(
                'elements' => '.header-variation-three .user-nav a:hover .icon-email-two,
                                 .header-variation-three .user-nav a:hover .icon-lock',
                'property' => 'fill',
                'value' => $inspiry_3rd_header_user_nav['hover'],
            );

            // Header phone icon
            $dynamic_css[] = array(
                'elements' => '.header-variation-three .icon-phone-two',
                'property' => 'fill',
                'value' => $inspiry_3rd_header_phone_icon,
            );
        }


        /*
         * SLIDER VARIATION ONE
         */

        $inspiry_slider_type = $inspiry_options['inspiry_slider_type'];

        if ( $inspiry_slider_type == 'properties-slider' || $inspiry_slider_type == 'properties-slider-two' ) {

            $inspiry_slide_status_tag_background = $inspiry_options['inspiry_slide_status_tag_background'];
            $inspiry_slide_status_tag_hover_background = $inspiry_options['inspiry_slide_status_tag_hover_background'];
            $inspiry_slide_meta_icon_color = $inspiry_options['inspiry_slide_meta_icon_color'];

            $dynamic_css[] = array(
                'elements' => '.slide-overlay .property-status-tag:before',
                'property' => 'border-right-color',
                'value' => $inspiry_slide_status_tag_background,
            );

            $dynamic_css[] = array(
                'elements' => '.slide-overlay .property-status-tag:hover:before',
                'property' => 'border-right-color',
                'value' => $inspiry_slide_status_tag_hover_background,
            );

            // Property Meta Icons Color
            $dynamic_css[] = array(
                'elements' => '.slide-overlay .meta-icon',
                'property' => 'fill',
                'value' => $inspiry_slide_meta_icon_color,
            );

        } elseif ( $inspiry_slider_type == 'properties-slider-three' ) {

            $inspiry_3rd_slider_status_tag_background = $inspiry_options['inspiry_3rd_slider_status_tag_background'];
            $inspiry_3rd_slider_status_tag_hover_background = $inspiry_options['inspiry_3rd_slider_status_tag_hover_background'];

            $dynamic_css[] = array(
                'elements' => '.slide-overlay .property-status-tag:before',
                'property' => 'border-right-color',
                'value' => $inspiry_3rd_slider_status_tag_background,
            );

            $dynamic_css[] = array(
                'elements' => '.slide-overlay .property-status-tag:hover:before',
                'property' => 'border-right-color',
                'value' => $inspiry_3rd_slider_status_tag_hover_background,
            );
        }


        /*
         * HOME PROPERTIES
         */

        $inspiry_home_properties_variation = 1;

        if ( isset ( $inspiry_options['inspiry_home_properties_variation'] ) ) {
            $inspiry_home_properties_variation = $inspiry_options['inspiry_home_properties_variation'];
        }

        if ( $inspiry_home_properties_variation == 1 ) {

            $inspiry_hp_1_pd_1_status_tag_background = $inspiry_options['inspiry_hp_1_pd_1_status_tag_background'];
            $inspiry_hp_1_pd_1_status_tag_hover_background = $inspiry_options['inspiry_hp_1_pd_1_status_tag_hover_background'];
            $inspiry_hp_1_pd_1_meta_icon_color = $inspiry_options['inspiry_hp_1_pd_1_meta_icon_color'];
            $inspiry_hp_1_pd_2_status_tag_background = $inspiry_options['inspiry_hp_1_pd_2_status_tag_background'];
            $inspiry_hp_1_pd_2_status_tag_hover_background = $inspiry_options['inspiry_hp_1_pd_2_status_tag_hover_background'];
            $inspiry_hp_1_pd_2_meta_icon_color = $inspiry_options['inspiry_hp_1_pd_2_meta_icon_color'];

            // Home Properties One - Property Design One
            $dynamic_css[] = array(
                'elements' => '
                    .row-odd .property-post-odd .property-status-tag:before,
                    .row-even .property-post-even .property-status-tag:before',
                'property' => 'border-right-color',
                'value' => $inspiry_hp_1_pd_1_status_tag_background,
            );

            $dynamic_css[] = array(
                'elements' => '
                    .row-odd .property-post-odd .property-status-tag:hover:before,
                    .row-even .property-post-even .property-status-tag:hover:before',
                'property' => 'border-right-color',
                'value' => $inspiry_hp_1_pd_1_status_tag_hover_background,
            );

            // Property Meta Icons Color
            $dynamic_css[] = array(
                'elements' => '
                    .row-odd .property-post-odd .meta-icon,
                    .row-even .property-post-even .meta-icon',
                'property' => 'fill',
                'value' => $inspiry_hp_1_pd_1_meta_icon_color,
            );


            // Home Properties One - Property Design Two
            $dynamic_css[] = array(
                'elements' => '
                    .row-odd .property-post-even .property-status-tag:before,
                    .row-even .property-post-odd .property-status-tag:before',
                'property' => 'border-right-color',
                'value' => $inspiry_hp_1_pd_2_status_tag_background,
            );

            $dynamic_css[] = array(
                'elements' => '
                    .row-odd .property-post-even .property-status-tag:hover:before,
                    .row-even .property-post-odd .property-status-tag:hover:before',
                'property' => 'border-right-color',
                'value' => $inspiry_hp_1_pd_2_status_tag_hover_background,
            );

            // Property Meta Icons Color
            $dynamic_css[] = array(
                'elements' => '
                    .row-odd .property-post-even .meta-icon,
                    .row-even .property-post-odd .meta-icon',
                'property' => 'fill',
                'value' => $inspiry_hp_1_pd_2_meta_icon_color,
            );

        } elseif ( $inspiry_home_properties_variation ==  2 ) {

            $inspiry_hp_2_status_tag_background = $inspiry_options['inspiry_hp_2_status_tag_background'];
            $inspiry_hp_2_status_tag_hover_background = $inspiry_options['inspiry_hp_2_status_tag_hover_background'];
            $inspiry_hp_2_meta_icon_color = $inspiry_options['inspiry_hp_2_meta_icon_color'];


            $dynamic_css[] = array(
                'elements' => '.property-listing-two .property-status-tag:before',
                'property' => 'border-right-color',
                'value' => $inspiry_hp_2_status_tag_background,
            );

            $dynamic_css[] = array(
                'elements' => '.property-listing-two .property-status-tag:hover:before',
                'property' => 'border-right-color',
                'value' => $inspiry_hp_2_status_tag_hover_background,
            );

            // Property Meta Icons Color
            $dynamic_css[] = array(
                'elements' => '.property-listing-two .property-meta .meta-icon',
                'property' => 'fill',
                'value' => $inspiry_hp_2_meta_icon_color,
            );

        }

        /*
         * Featured PROPERTIES
         */

        $inspiry_home_featured_variation = $inspiry_options['inspiry_home_featured_variation'];

        if ( $inspiry_home_featured_variation ==  1 ) {

            $inspiry_fp_1_status_tag_background = $inspiry_options['inspiry_fp_1_status_tag_background'];
            $inspiry_fp_1_status_tag_hover_background = $inspiry_options['inspiry_fp_1_status_tag_hover_background'];

            $dynamic_css[] = array(
                'elements' => '.featured-properties-one .property-status-tag:before',
                'property' => 'border-right-color',
                'value' => $inspiry_fp_1_status_tag_background,
            );

            $dynamic_css[] = array(
                'elements' => '.featured-properties-one .property-status-tag:hover:before',
                'property' => 'border-right-color',
                'value' => $inspiry_fp_1_status_tag_hover_background,
            );

        } elseif ( $inspiry_home_featured_variation ==  2 ) {

            $inspiry_fp_2_status_tag_background = $inspiry_options['inspiry_fp_2_status_tag_background'];
            $inspiry_fp_2_status_tag_hover_background = $inspiry_options['inspiry_fp_2_status_tag_hover_background'];
            $inspiry_fp_2_meta_icon_color = $inspiry_options['inspiry_fp_2_meta_icon_color'];

            $dynamic_css[] = array(
                'elements' => '.featured-properties-two .property-status-tag:before',
                'property' => 'border-right-color',
                'value' => $inspiry_fp_2_status_tag_background,
            );

            $dynamic_css[] = array(
                'elements' => '.featured-properties-two .property-status-tag:hover:before',
                'property' => 'border-right-color',
                'value' => $inspiry_fp_2_status_tag_hover_background,
            );

            // Property Meta Icons Color
            $dynamic_css[] = array(
                'elements' => '.featured-properties-two .meta-icon',
                'property' => 'fill',
                'value' => $inspiry_fp_2_meta_icon_color,
            );
        }

        // Start generating if related arrays are populated
        if ( count( $dynamic_css ) > 0 || count( $dynamic_css_min_width_1200px ) > 0 ) {
            echo "<style type='text/css' id='inspiry-dynamic-css'>\n\n";

            // Basic dynamic CSS
            if ( count( $dynamic_css ) > 0 ) {
                inspiry_produce_dynamic_css ( $dynamic_css );
            }

            // CSS for min width of 1200px
            if ( count( $dynamic_css_min_width_1200px ) > 0 ) {
                echo "@media (min-width: 1200px) {\n";
                inspiry_produce_dynamic_css ( $dynamic_css_min_width_1200px );
                echo "}\n";
            }

            echo '</style>';
        }

    }


}
add_action( 'wp_head', 'inspiry_generate_dynamic_css' );