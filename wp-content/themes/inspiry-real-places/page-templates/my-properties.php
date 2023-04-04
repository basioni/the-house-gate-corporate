<?php
/*
 * Template Name: My Properties
 */
get_header();

get_template_part( 'partials/header/banner' );

global $inspiry_options;
?>
    <div id="content-wrapper" class="site-content-wrapper site-pages">

        <div id="content" class="site-content layout-boxed">

            <div class="container">

                <div class="row">

                    <div class="col-xs-12 site-main-content">

                        <main id="main" class="site-main">
                            <?php
                            if ( is_user_logged_in() ) {

                                /*
                                 * Messages for deletion, addition and update
                                 */
                                if ( isset( $_GET['deleted'] ) && ( intval( $_GET['deleted'] ) == 1 ) ) {

                                    inspiry_highlighted_message( __( 'Property Removed!', 'inspiry' ) );

                                } elseif ( isset( $_GET['property-added'] ) && ( $_GET['property-added'] == true ) ) {

                                    inspiry_highlighted_message( __( 'Property Added Successfully!', 'inspiry' ) );

                                } elseif ( isset( $_GET['property-updated'] ) && ( $_GET['property-updated'] == true ) ) {

                                    inspiry_highlighted_message( __( 'Property Updated Successfully!', 'inspiry' ) );

                                }

                                // Get User Id
                                global $current_user;
                                get_currentuserinfo();

                                // My properties arguments
                                global $paged;

                                $number_of_properties = intval( $inspiry_options[ 'inspiry_my_properties_number' ] );
                                if ( !$number_of_properties ) {
                                    $number_of_properties = 5;
                                }

                                $my_props_args = array(
                                    'post_type' => 'property',
                                    'posts_per_page' => $number_of_properties,
                                    'paged' => $paged,
                                    'post_status' => array( 'pending', 'draft', 'publish', 'future' ),
                                    'author' => $current_user->ID
                                );

                                $my_properties_query = new WP_Query( apply_filters( 'inspiry_my_properties', $my_props_args ) );

                                if ( $my_properties_query->have_posts() ) :

                                    // Get payment related options
                                    $paypal_payment_enabled = $inspiry_options[ 'inspiry_payment_via_paypal' ];
                                    $paypal_ipn_url         = $inspiry_options[ 'inspiry_paypal_ipn_url' ];
                                    $paypal_merchant_id     = $inspiry_options[ 'inspiry_paypal_merchant_id' ];
                                    $paypal_sandbox         = $inspiry_options[ 'inspiry_paypal_sandbox' ];
                                    $paypal_payment_amount  = $inspiry_options[ 'inspiry_paypal_payment_amount' ];
                                    $paypal_currency_code   = $inspiry_options[ 'inspiry_paypal_currency_code' ];

                                    while ( $my_properties_query->have_posts() ) :

                                        $my_properties_query->the_post();

                                        $my_property = new Inspiry_Property( get_the_ID() );

                                        ?>
                                        <article class="user-submit-property meta-item-half hentry clearfix">

                                            <div class="property-thumbnail col-xs-3 col-lg-2">
                                                <?php inspiry_thumbnail(); ?>
                                            </div>

                                            <div class="content-wrapper col-xs-9 col-lg-10">

                                                <div class="title-and-meta">

                                                    <header class="entry-header">
                                                        <h3 class="entry-title">
                                                            <a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a>
                                                            <span class="price"><?php $my_property->price() ?></span>
                                                        </h3>
                                                    </header>
                                                    <!-- .entry-header -->

                                                    <div class="property-meta entry-meta clearfix">

                                                        <div class="meta-item">
                                                            <span class="meta-item-label"><?php _e( 'Posted on:', 'inspiry' ); ?></span>
                                                            <span class="meta-item-value"><?php the_time( "d F 'y" ); ?></span>
                                                        </div>

                                                        <div class="meta-item">
                                                            <span class="meta-item-label"><?php _e( 'Last Modified:', 'inspiry' ); ?></span>
                                                            <span class="meta-item-value"><?php the_modified_time( "d F 'y" ); ?></span>
                                                        </div>

                                                        <div class="meta-item">
                                                            <span class="meta-item-label"><?php _e( 'Status:', 'inspiry' ); ?></span>
                                                            <?php $pub_status = get_post_status(); ?>
                                                            <span class="meta-item-value <?php echo strtolower( $pub_status ); ?>"><?php echo strtoupper( $pub_status ); ?></span>
                                                        </div>

                                                    </div>
                                                    <!-- .property-meta -->

                                                </div>
                                                <!--.title-and-meta -->

                                                <div class="action-buttons">
                                                    <?php
                                                    /*
                                                     * Payment Stuff
                                                     */
                                                    $payment_status = $my_property->get_payment_status();
                                                    if( $payment_status == "Completed" ) {
                                                        echo '<h4>';
                                                        _e('Payment Completed','inspiry');
                                                        echo '</h4>';
                                                    } else {

                                                        if ( class_exists( 'AngellEYE_Paypal_Ipn_For_Wordpress' ) ) {

                                                            if( ( $paypal_payment_enabled )
                                                                && ( !empty( $paypal_ipn_url ) )
                                                                && ( !empty( $paypal_merchant_id ) )
                                                                && ( !empty( $paypal_currency_code ) )
                                                                && ( !empty( $paypal_payment_amount ) ) ) {

                                                                $paypal_button_script = get_template_directory_uri() . "/js/paypal-button.min.js";
                                                                ?>
                                                                <script src= "<?php echo esc_url( add_query_arg( array( 'merchant' => $paypal_merchant_id ), $paypal_button_script ) ); ?>"
                                                                        <?php if( $paypal_sandbox ){ ?>data-env="sandbox"<?php } ?>
                                                                        data-callback="<?php echo esc_url( $paypal_ipn_url ); ?>"
                                                                        data-tax="0"
                                                                        data-shipping="0"
                                                                        data-currency="<?php echo esc_attr( $paypal_currency_code ); ?>"
                                                                        data-amount="<?php echo esc_attr( $paypal_payment_amount ); ?>"
                                                                        data-quantity="1"
                                                                        data-name="<?php the_title(); ?>"
                                                                        data-number="<?php the_ID(); ?>"
                                                                        data-button="buynow"
                                                                    ></script>
                                                                <?php
                                                            }

                                                        }
                                                    }

                                                    /*
                                                     * Other action buttons
                                                     */

                                                    // Edit Post Link
                                                    if ( !empty( $inspiry_options[ 'inspiry_submit_property_page' ] ) ) {
                                                        $submit_url = get_permalink( $inspiry_options[ 'inspiry_submit_property_page' ] );
                                                        if( !empty( $submit_url ) ) {
                                                            $edit_link = add_query_arg( 'edit_property', get_the_ID() , $submit_url );
                                                            ?><a href="<?php echo esc_url( $edit_link ); ?>"><i class="fa fa-pencil-square-o"></i></a><?php
                                                        }
                                                    }

                                                    // Delete Post Link Bypassing Trash
                                                    if ( current_user_can( 'delete_posts' ) ) {
                                                        $delete_post_link = get_delete_post_link( get_the_ID(), '', true );
                                                        if ( !empty( $delete_post_link ) ) {
                                                            ?><a href="<?php echo esc_url( $delete_post_link ); ?>"><i class="fa fa-trash-o"></i></a><?php
                                                        }
                                                    }

                                                    // Preview Post Link
                                                    if ( current_user_can('edit_posts') ) {
                                                        $preview_link = set_url_scheme( get_permalink( get_the_ID() ) );
                                                        $preview_link = apply_filters( 'preview_post_link', add_query_arg( 'preview', 'true', $preview_link ) );
                                                        if ( !empty( $preview_link ) ) {
                                                            ?><a target="_blank" href="<?php echo esc_url( $preview_link ); ?>"><i class="fa fa-eye"></i></a><?php
                                                        }
                                                    }
                                                    ?>
                                                </div>
                                                <!-- .action-buttons -->

                                            </div>
                                            <!-- .content-wrapper -->

                                        </article><!-- .user-submit-property -->

                                    <?php

                                    endwhile;

                                    inspiry_pagination( $my_properties_query );

                                    wp_reset_postdata();

                                else:
                                    inspiry_message( __( 'Oops' , 'inspiry' ), __( 'It appears that you have not submitted any property yet!', 'inspiry' ) );
                                endif;

                            } else {
                                inspiry_message( __( 'Login Required', 'inspiry' ), __( 'You need to login to view your properties!', 'inspiry' ) );
                            }
                            ?>

                        </main>
                        <!-- .site-main -->

                    </div>
                    <!-- .site-main-content -->

                </div>
                <!-- .row -->

            </div>
            <!-- .container -->

        </div>
        <!-- .site-content -->

    </div><!-- .site-content-wrapper -->

<?php
/*
 * Footer
 */
get_footer();