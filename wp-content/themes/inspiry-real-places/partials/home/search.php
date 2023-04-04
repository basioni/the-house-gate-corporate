<?php
/*
 * Property search form for homepage
 */
global $inspiry_options;
?>
<section class="advance-search main-advance-search">
    <div class="container">
        <?php
        if ( !empty( $inspiry_options['inspiry_home_search_form_title'] ) ) {
            ?><h3 class="search-title"><?php echo esc_html( $inspiry_options['inspiry_home_search_form_title'] ); ?></h3><?php
        }

        get_template_part( 'partials/search/form' );
        ?>
    </div>
    <!-- .container -->
</section><!-- .advance-search -->

