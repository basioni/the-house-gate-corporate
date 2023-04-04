<?php
/*
 * Header Options
 */
global $opt_name;
Redux::setSection( $opt_name, array(
    'title' => __('Header', 'inspiry'),
    'id'    => 'header-section',
    'desc'  => __('This section contains options for header.', 'inspiry'),
    'fields'=> array(

        array(
            'id'        => 'inspiry_header_variation',
            'type'      => 'image_select',
            'title'     => __( 'Header Design Variation', 'inspiry' ),
            'subtitle'  => __( 'Select the design variation that you want to use for site header.', 'inspiry' ),
            'options'   => array(
                '1' => array(
                    'title' => __('1st Variation', 'inspiry'),
                    'img' => get_template_directory_uri() . '/inc/theme-options/images/header-variation-1.png',
                ),
                '2' => array(
                    'title' => __('2nd Variation', 'inspiry'),
                    'img' => get_template_directory_uri() . '/inc/theme-options/images/header-variation-2.png',
                ),
                '3' => array(
                    'title' => __('3rd Variation', 'inspiry'),
                    'img' => get_template_directory_uri() . '/inc/theme-options/images/header-variation-3.png',
                )
            ),
            'default'   => '1',
        ),
        array(
            'id'        => 'inspiry_sticky_header',
            'type'      => 'switch',
            'title'     => __('Sticky Header', 'inspiry'),
            'desc'     => __('This feature only works above 992px screen size.', 'inspiry'),
            'default'   => 0,
            'on'        => __('Enable','inspiry'),
            'off'       => __('Disable','inspiry'),
        ),
        array(
            'id'        => 'inspiry_header_menu_title',
            'type'      => 'text',
            'title'     => __( 'Menu Button Title', 'inspiry' ),
            'default'   => __( 'Menu', 'inspiry' ),
            'required' => array( 'inspiry_header_variation', '=', 1 ),
        ),
        array(
            'id'       => 'inspiry_favicon',
            'type'     => 'media',
            'url'      => false,
            'title'    => __( 'Favicon', 'inspiry' ),
            'subtitle' => __( 'Upload your website favicon.', 'inspiry' ),
        ),
        array(
            'id'       => 'inspiry_logo',
            'type'     => 'media',
            'url'      => false,
            'title'    => __( 'Logo', 'inspiry' ),
            'subtitle' => __( 'Upload logo image for your Website. Otherwise site title will be displayed in place of logo.', 'inspiry' ),
        ),
        array(
            'id'        => 'inspiry_header_email',
            'type'      => 'text',
            'title'     => __( 'Email Address', 'inspiry' ),
            'default'   => '',
            'validate'  => 'email',
            'required'  => array( 'inspiry_header_variation', '=', 3 ),
        ),
        array(
            'id'        => 'inspiry_header_phone',
            'type'      => 'text',
            'title'     => __( 'Phone Number', 'inspiry' ),
            'default'   => '',
        ),
        array(
            'id'       => 'inspiry_facebook_url',
            'type'     => 'text',
            'title'    => __( 'Facebook URL', 'inspiry' ),
            'validate' => 'url',
            'default'  => '',
        ),
        array(
            'id'       => 'inspiry_twitter_url',
            'type'     => 'text',
            'title'    => __( 'Twitter URL', 'inspiry' ),
            'validate' => 'url',
            'default'  => '',
        ),
        array(
            'id'       => 'inspiry_google_url',
            'type'     => 'text',
            'title'    => __( 'Google Plus URL', 'inspiry' ),
            'validate' => 'url',
            'default'  => '',
        ),
        array(
            'id'       => 'inspiry_banner_image',
            'type'     => 'media',
            'url'      => false,
            'title'    => __('Banner Image', 'inspiry'),
            'desc'     => __('Banner image should have minimum width of 2000px and minimum height of 320px.', 'inspiry'),
            'subtitle' => __('This banner image will be displayed on all the pages where banner image is not overridden by page specific banner settings.', 'inspiry'),
        ),
        array(
            'id'        => 'inspiry_display_wpml_flags',
            'type'      => 'switch',
            'title'     => __('WPML Language Switcher Flags', 'inspiry'),
            'subtitle'     => __('Do you want to display WPML language switcher flags in header top bar ?', 'inspiry'),
            'desc'     => __('This option only works if WPML plugin is installed.', 'inspiry'),
            'default'   => 1,
            'on'        => __('Display','inspiry'),
            'off'       => __('Hide','inspiry'),
        ),
        array(
            'id'        => 'inspiry_page_loader',
            'type'      => 'switch',
            'title'     => __('Page Loader', 'inspiry'),
            'desc'     => __('You can enable or disable page loader.', 'inspiry'),
            'default'   => false,
            'on'        => __('Enable','inspiry'),
            'off'       => __('Disable','inspiry'),
        ),
        array(
            'id'       => 'inspiry_page_loader_gif',
            'type'     => 'media',
            'url'      => false,
            'title'    => __( 'Page Loader Gif', 'inspiry' ),
            'desc'     => __( 'You can upload your page loader gif here or default one will be displayed.', 'inspiry' ),
            'required' => array( 'inspiry_page_loader', '=', 1 ),
        ),
        array(
            'id'        => 'inspiry_quick_js',
            'type'      => 'ace_editor',
            'title'     => __('Quick JavaScript', 'inspiry'),
            'desc'  => __('You can paste your JavaScript code here.', 'inspiry'),
            'mode'      => 'javascript',
            'theme'     => 'chrome',
        ),

    ) ) );
