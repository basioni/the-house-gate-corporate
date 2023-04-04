<?php
/**
 * Show an admin notice to deactivate Redux plugin
 */
add_action( 'init', function() {
    include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
    if ( is_plugin_active( 'redux-framework/redux-framework.php' ) ) {
        add_action( 'admin_notices', function () {
            ?>
            <div class="update-nag notice is-dismissible">
                <p><strong><?php _e( 'Redux Framework plugin is no longer required!', 'inspiry' ); ?></strong></p>
                <p><?php _e( 'As its core files are embedded with in this theme.', 'inspiry' ); ?></p>
                <p><em><?php _e( 'So, You should deactivate and remove it from your plugins.', 'inspiry' ); ?></em></p>
            </div>
            <?php
        } );
    }
} );


/**
 * Include redux framework
 */
if ( !class_exists( 'ReduxFramework' ) && file_exists( get_template_directory() . '/inc/ReduxFramework/ReduxCore/framework.php' ) ) {
    require_once( get_template_directory() . '/inc/ReduxFramework/ReduxCore/framework.php' );
}


/**
 * Theme based options declaration
 *
 * Note: I have set forced_dev_mode_off to avoid debug mode notices and links
 */
require_once ( get_template_directory() . '/inc/theme-options/extension-loader/loader.php' );
require_once ( get_template_directory() . '/inc/theme-options/options-config.php' );


/**
 *  Remove redux submenu
 */
function inspiry_remove_redux_submenu() {
    remove_submenu_page('tools.php','redux-about');
}
add_action( 'admin_menu', 'inspiry_remove_redux_submenu', 12 );

