<?php
/*
 * User navigation for header
 */
global $inspiry_options;
$is_header_variation_three = ( $inspiry_options[ 'inspiry_header_variation' ] == '3' ) ? true : false ;
$user_nav_in_header = $inspiry_options[ 'inspiry_header_user_nav' ];
if ( $user_nav_in_header ) {

    $submit_property_url = "";
    if ( isset( $inspiry_options[ 'inspiry_submit_property_page' ] ) && !empty( $inspiry_options[ 'inspiry_submit_property_page' ] ) ) {
        $submit_property_url    = get_permalink( inspiry_wpml_translated_page_id ( $inspiry_options[ 'inspiry_submit_property_page' ] ) );
    }

    ?>
    <ul class="user-nav">
        <?php
        /*
         * Header Email
         */
        if( $is_header_variation_three && !empty( $inspiry_options['inspiry_header_email'] ) ) {
            $inspiry_header_email = is_email( $inspiry_options['inspiry_header_email'] );
            if ( $inspiry_header_email ) {
                $antispam_header_email = antispambot( $inspiry_header_email );
                ?>
                <li>
                    <a href="mailto:<?php echo $antispam_header_email; ?>">
                        <?php
                        include( get_template_directory() . '/images/svg/icon-email-two.svg' );
                        echo $antispam_header_email;
                        ?>
                    </a>
                </li>
                <?php
            }
        }

        if ( is_user_logged_in() ) {

            $edit_profile_url = "";
            $my_properties_url = "";
            $favorites_url = "";

            if ( isset( $inspiry_options[ 'inspiry_edit_profile_page' ] ) && !empty( $inspiry_options[ 'inspiry_edit_profile_page' ] ) ) {
                $edit_profile_url = get_permalink( inspiry_wpml_translated_page_id ( $inspiry_options[ 'inspiry_edit_profile_page' ] ) );
            }

            if ( isset( $inspiry_options[ 'inspiry_my_properties_page' ] ) && !empty( $inspiry_options[ 'inspiry_my_properties_page' ] ) ) {
                $my_properties_url = get_permalink ( inspiry_wpml_translated_page_id ( $inspiry_options[ 'inspiry_my_properties_page' ] ) );
            }

            if ( isset( $inspiry_options[ 'inspiry_favorites_page' ] ) && !empty( $inspiry_options[ 'inspiry_favorites_page' ] ) ) {
                $favorites_url = get_permalink ( inspiry_wpml_translated_page_id ( $inspiry_options[ 'inspiry_favorites_page' ] ) );
            }

            ?>
            <li><a href="<?php echo wp_logout_url( esc_url( home_url('/') ) ); ?>"><i class="fa fa-sign-out"></i><?php _e( 'Logout', 'inspiry' ); ?></a></li>
            <?php

            if ( !empty( $edit_profile_url ) ) {
                ?><li><a href="<?php echo esc_url( $edit_profile_url ); ?>"><i class="fa fa-user"></i><?php _e( 'Profile', 'inspiry' ); ?></a></li><?php
            }

            if ( !empty( $my_properties_url ) ) {
                ?><li><a href="<?php echo esc_url( $my_properties_url ); ?>"><i class="fa fa-th-list"></i><?php _e( 'My Properties', 'inspiry' ); ?></a></li><?php
            }

            if ( !empty( $favorites_url ) ) {
                ?><li><a href="<?php echo esc_url( $favorites_url ); ?>"><i class="fa fa-star"></i><?php _e( 'Favorites', 'inspiry' ); ?></a></li><?php
            }

            if ( !empty( $submit_property_url ) ) {
                ?><li><a class="submit-property-link" href="<?php echo esc_url( $submit_property_url ); ?>"><i class="fa fa-plus-circle"></i><?php _e( 'Submit', 'inspiry' ); ?></a></li><?php
            }

        } else {

            ?>
            <li>
                <a class="login-register-link" href="#login-modal" data-toggle="modal">
                    <?php
                    if ( $is_header_variation_three ) {
                        include( get_template_directory() . '/images/svg/icon-lock.svg' );
                    } else {
                        echo '<i class="fa fa-sign-in"></i>';
                    }
                    _e( 'Login / Sign up', 'inspiry' ); ?>
                </a>
            </li>
            <?php

            if ( !empty( $submit_property_url ) ) {
                ?><li><a class="submit-property-link" href="<?php echo esc_url( $submit_property_url ); ?>"><i class="fa fa-plus-circle"></i><?php _e( 'Submit Property', 'inspiry' ); ?></a></li><?php
            }

        }
        ?>
    </ul><!-- .user-nav -->
    <?php
}


/*
 * WPML Language Switcher
 */
if ( $inspiry_options['inspiry_display_wpml_flags'] ) {
    if ( function_exists( 'icl_object_id' ) ) {
        $languages = apply_filters( 'wpml_active_languages', NULL, array( 'skip_missing' => 0 ) );
        if ( !empty( $languages ) ) {
            echo '<div id="inspiry_language_list"><ul class="clearfix">';
            foreach( $languages as $language ){
                $wrapper = $language['active'] ? '<li class="active">' : '<li>';
                echo $wrapper;
                    $native_name = $language['active'] ? strtoupper( $language['native_name'] ) : $language['native_name'];
                    if( !$language['active'] ) {
                        echo '<a href="' . $language['url'] . '">';
                    }
                    if ( $language['country_flag_url'] ) {
                        echo '<img src="' . $language['country_flag_url'] . '" height="12" alt="' . $language['language_code'] . '" width="18">';
                    }
                    echo esc_html( $native_name . ' ' );
                    if( !$language['active'] ) {
                        echo '</a>';
                    }
                echo '</li>';
            }
            echo '</ul></div>';
        }
    }
}