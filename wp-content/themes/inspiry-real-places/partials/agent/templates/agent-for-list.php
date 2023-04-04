<?php
/*
 * Odd / Even class
 */
global $agent_list_counter;

if ( $agent_list_counter % 2 == 0 ) {
    $agent_odd_even_class = 'agent-post-even';
} else {
    $agent_odd_even_class = 'agent-post-odd';
}

/*
 * Columns class
 */
$agent_columns_class = 'col-sm-6';
if ( is_page_template( 'page-templates/agents-list-3-columns.php' ) ) {
    $agent_columns_class .= ' col-md-4';
} else if ( is_page_template( 'page-templates/agents-list-4-columns.php' ) ) {
    $agent_columns_class .= ' col-lg-3';
    $agent_remainder = $agent_list_counter % 8;
    if ( $agent_remainder == 2 || $agent_remainder == 4 || $agent_remainder == 5 || $agent_remainder == 7 ) {
        $agent_odd_even_class = 'agent-post-even';
    } else {
        $agent_odd_even_class = 'agent-post-odd';
    }
} else if ( is_page_template( 'page-templates/agents-list-2-columns.php' ) ) {
    $agent_remainder = $agent_list_counter % 4;
    if ( $agent_remainder == 2 || $agent_remainder == 3 ) {
        $agent_odd_even_class = 'agent-post-even';
    } else {
        $agent_odd_even_class = 'agent-post-odd';
    }
}

?>
<div class="zero-horizontal-padding <?php echo esc_attr( $agent_columns_class ); ?>">

    <article class="agent-listing-post clearfix hentry <?php echo esc_attr( $agent_odd_even_class ); ?>">

        <div class="agent-content-wrapper agent-common-styles">

            <?php get_template_part( 'partials/agent/single/agent-info' ); ?>

        </div>

    </article>
    <!-- .agent-listing-post -->

</div>


