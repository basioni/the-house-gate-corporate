<div class="row">
    <div class="col-sm-12">
        <div class="property-share-networks clearfix">
            <?php
            global $inspiry_options;
            if ( !empty( $inspiry_options[ 'inspiry_property_share_title' ] ) ) {
                ?><h4 class="fancy-title"><?php echo esc_html( $inspiry_options[ 'inspiry_property_share_title' ] ); ?></h4><?php
            }
            ?>
            <div id="share-button-title" class="hide"><?php _e('Share', 'inspiry'); ?></div>
            <div class="share-this"></div>
        </div>
    </div>
</div>