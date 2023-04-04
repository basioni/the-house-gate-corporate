    <div class="option-bar form-control-buttons">
        <?php
        global $field_counter;
        global $number_search_fields;
        if ( $field_counter < $number_search_fields ) {
            ?><a class="hidden-fields-reveal-btn" href="#"><?php include( get_template_directory() . '/images/svg/icon-plus.svg' ); ?></a><?php
        }
        ?>
        <input type="submit" value="<?php _e( 'Search', 'inspiry' ); ?>" class="form-submit-btn">
    </div>
</div>
<!-- .inline-fields -->
<div class="hidden-fields clearfix">