<nav id="site-main-nav" class="site-main-nav">
    <?php
    wp_nav_menu( array(
        'theme_location' => 'primary',
        'container' => false,
        'menu_class' => 'main-menu clearfix',
        'fallback_cb' => false,
    ) );
    ?>
</nav>