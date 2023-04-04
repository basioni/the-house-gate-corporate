<header class="site-header header header-variation-three">

    <div class="container">

        <div class="row zero-horizontal-margin">

            <div class="col-lg-3 zero-horizontal-padding">
                <?php get_template_part('partials/header/logo'); ?>
            </div>
            <!-- .left-column -->

            <div class="col-lg-9 zero-horizontal-padding hidden-xs hidden-sm">

                <div class="header-top clearfix">
                    <?php
                    get_template_part('partials/header/social-networks');
                    get_template_part('partials/header/user-nav');
                    ?>
                </div>
                <!-- .header-top -->

                <div class="header-bottom clearfix">
                    <?php
                    get_template_part('partials/header/contact-number');
                    get_template_part('partials/header/menu');
                    ?>
                </div>
                <!-- .header-bottom -->

            </div>
            <!-- .right-column -->

        </div>
        <!-- .row -->

    </div>
    <!-- .container -->

</header><!-- .site-header -->