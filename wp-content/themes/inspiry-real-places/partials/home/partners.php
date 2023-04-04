<?php
/*
 * Partners for homepage
 */

global $inspiry_options;

$variation = 'one';
if ( $inspiry_options[ 'inspiry_home_sections_width' ] == 'wide' ) {
    $variation = 'two'; // in case of wide layout
}

$number_of_partners = intval( $inspiry_options[ 'inspiry_home_partners_number' ] );
if( !$number_of_partners ) {
    $number_of_partners = 5;
}

$partners_query_args = array(
    'post_type' => 'partners',
    'posts_per_page' => $number_of_partners
);

$partners_query = new WP_Query( $partners_query_args );

if ( $partners_query->have_posts() ) :

    ?>
    <section class="partners partners-<?php echo esc_attr( $variation ) ?> fade-in-up <?php echo esc_attr( inspiry_animation_class() ); ?>">

        <div class="container">

            <div class="row zero-horizontal-margin">

                <div class="col-xs-12">

                    <?php
                    if ( !empty( $inspiry_options['inspiry_home_partners_title'] ) ) {
                        ?><h3 class="title"><?php echo wp_kses( $inspiry_options['inspiry_home_partners_title'], array( 'span' => array() ) ); ?></h3><?php
                    }
                    ?>

                    <ul class="list-grid-layout list-unstyled">
                        <?php
                        while ( $partners_query->have_posts() ) :

                            $partners_query->the_post();

                            $partner_id = get_the_ID();

                            if ( has_post_thumbnail( $partner_id ) ) {

                                $post_meta_data = get_post_custom( $partner_id );

                                /*
                                 * Partner URL
                                 */
                                $partner_url = null;
                                if( !empty( $post_meta_data[ 'REAL_HOMES_partner_url' ][ 0 ] ) ) {
                                    $partner_url = esc_url( $post_meta_data[ 'REAL_HOMES_partner_url' ][ 0 ] );
                                }

                                $full_image_url = wp_get_attachment_url( get_post_thumbnail_id() );
                                if ( !empty( $full_image_url ) ) {
                                    ?>
                                    <li>
                                        <?php if ( !empty( $partner_url ) ) : echo '<a href="' . esc_url( $partner_url ) . '">'; endif; ?>
                                            <img class="img-responsive" src="<?php echo esc_url( $full_image_url ); ?>" alt="<?php the_title(); ?>" />
                                        <?php if ( !empty( $partner_url ) ) : echo '</a>'; endif; ?>
                                    </li>
                                    <?php
                                }

                            }

                        endwhile;

                        wp_reset_postdata();
                        ?>
                    </ul>

                </div>

            </div>

        </div>
        <!-- .container -->

    </section><!-- .partners -->
    <?php

endif;


