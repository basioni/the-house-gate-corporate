<?php
if ( is_single() ) :
    global $post;
    $embed_code = get_post_meta( $post->ID, 'REAL_HOMES_embed_code', true );
    if( !empty( $embed_code ) ) :
        ?>
        <div class="embed-responsive embed-responsive-4by3">
            <?php echo stripslashes( htmlspecialchars_decode( $embed_code ) ); ?>
        </div>
        <?php
    else :
        inspiry_standard_thumbnail();
    endif;
else:
    inspiry_standard_thumbnail();
endif;