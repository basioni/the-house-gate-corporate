<?php
global $inspiry_single_property;
$attachments = $inspiry_single_property->get_attachments(); // returns an array containing attachment ids

if ( is_array( $attachments ) ) {
    $attachments = array_filter( $attachments ); // remove any empty elements
}

if ( !empty( $attachments ) ) {
    ?>
    <div class="row">
        <div class="col-sm-12">
            <div class="property-attachments clearfix">
                <?php
                global $inspiry_options;
                if ( !empty( $inspiry_options[ 'inspiry_property_attachments_title' ] ) ) {
                    ?><h4 class="fancy-title"><?php echo esc_html( $inspiry_options[ 'inspiry_property_attachments_title' ] ); ?></h4><?php
                }
                echo '<ul class="property-attachments-list clearfix">';
                foreach ( $attachments as $attachment_id ) {
                    $file_path = wp_get_attachment_url( $attachment_id );
                    if ( $file_path ) {
                        $file_type = wp_check_filetype( $file_path );
                        echo '<li class="' . $file_type['ext'] . '"><a target="_blank" href="' . $file_path . '">' .
                             inspiry_get_file_icon( $file_type['ext'] ) .
                             get_the_title( $attachment_id ) .
                             '</a></li>';
                    }
                }
                echo '</ul>';
                ?>
            </div>
        </div>
    </div>
    <?php
}