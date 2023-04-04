<?php
/*
 * Template Name: Agents List - 4 Columns
 */

get_header();

get_template_part( 'partials/header/banner' );
?>
    <div id="content-wrapper" class="site-content-wrapper site-pages">

        <div id="content" class="site-content layout-boxed">

            <div class="container">

                <div class="row">

                    <div class="col-xs-12 site-main-content">

                        <main id="main" class="site-main">

                            <div class="agent-post-listing">

                                <div class="row zero-horizontal-margin">

                                <?php
                                /*
                                 * Number of agents on each page
                                 */
                                $number_of_agents = intval( get_post_meta( get_the_ID(), 'inspiry_agents_per_page', true ) );
                                if ( !$number_of_agents ) {
                                    $number_of_agents = 6;
                                }

                                global $paged;

                                $agents_query = array(
                                    'post_type' => 'agent',
                                    'posts_per_page' => $number_of_agents,
                                    'paged' => $paged
                                );

                                $agents_list_query = new WP_Query( $agents_query );

                                if ( $agents_list_query->have_posts() ) :

                                    global $agent_list_counter;
                                    $agent_list_counter = 1;

                                    while ( $agents_list_query->have_posts() ) :

                                        $agents_list_query->the_post();

                                        get_template_part( 'partials/agent/templates/agent-for-list' );

                                        $agent_list_counter++;

                                    endwhile;

                                    wp_reset_postdata();

                                else:
                                    ?><h4><?php _e( 'No agent found!', 'inspiry' ); ?></h4><?php
                                endif;
                                ?>
                                </div>
                                <!-- .row-->

                            </div>

                            <?php inspiry_pagination( $agents_list_query ); ?>

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
get_footer();
?>