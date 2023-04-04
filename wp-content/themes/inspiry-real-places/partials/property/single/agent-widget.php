<?php
global $inspiry_single_property;
$agent_display_option = $inspiry_single_property->get_agent_display_option();

if ( $agent_display_option != 'none' ) {
    ?>
    <section class="agent-sidebar-widget clearfix">
        <div class="agent-content-wrapper agent-common-styles">
            <?php
            if ( $agent_display_option == "my_profile_info" ) {
                // Author
                get_template_part( 'partials/property/single/author-information' );
            } else {
                // Agent
                get_template_part( 'partials/property/single/agent-information' );
            }
            ?>
        </div>
    </section>
    <?php
}
?>