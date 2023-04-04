<header class="site-header header header-variation-one">
    <div class="header-container">
        
        <div class="header-menu-wrapper hidden-xs hidden-sm clearfix">
            <?php
            global $inspiry_options;
            $menu_title = __( 'Menu', 'inspiry' );
            if ( !empty( $inspiry_options[ 'inspiry_header_menu_title' ] ) ) {
                $menu_title = $inspiry_options[ 'inspiry_header_menu_title' ];
            }
            ?>
            <a class="button-menu-reveal" href=""><?php echo esc_html( $menu_title ); ?></a>
            <a class="button-menu-close" href=""><i class="fa fa-times"></i></a>
            <?php get_template_part( 'partials/header/menu' ); ?>
        </div>

        <div class="row zero-horizontal-margin">

            <div class="left-column">
                <?php get_template_part( 'partials/header/logo' ); ?>
            </div>
            <!-- .left-column -->

            <div class="right-column">

                <div class="header-top hidden-xs hidden-sm clearfix">
                    <?php
                    get_template_part( 'partials/header/contact-number' );
                    get_template_part( 'partials/header/user-nav' );
                    get_template_part( 'partials/header/social-networks' );
                    ?>
                </div>
                <!-- .header-top -->

                <div class="header-bottom clearfix">
                    <?php get_template_part( 'partials/header/advance-search' ); ?>
                </div>
                <!-- .header-bottom -->

            </div>
            <!-- .right-column -->

        </div>
        <!-- .row -->

    </div>
    <!-- .container -->

</header><!-- .site-header -->

