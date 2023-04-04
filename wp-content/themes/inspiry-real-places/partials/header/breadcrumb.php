<div class="breadcrumb-wrapper">
    <div class="container">
        <?php
        global $post;
        $inspiry_breadcrumbs_items = inspiry_get_breadcrumbs_items( $post->ID, 'property-type' );
        if ( is_array( $inspiry_breadcrumbs_items ) && ( 0 < count( $inspiry_breadcrumbs_items ) ) ) {
            ?>
            <nav>
                <ol class="breadcrumb">
                <?php
                foreach( $inspiry_breadcrumbs_items as $item ) :
                    $class = ( !empty( $item['class'] ) ) ? 'class="' . $item['class'] . '"' : '';
                    if ( !empty ( $item['url'] ) ) :
                        ?>
                        <li <?php echo $class; ?>>
                            <a href="<?php echo esc_url( $item['url'] ); ?>"><?php echo $item['name']; ?></a>
                        </li>
                        <?php
                    else :
                        ?>
                        <li <?php echo $class; ?>><?php echo $item['name']; ?></li>
                        <?php
                    endif;
                endforeach;
                ?>
                </ol>
            </nav>
            <?php
        }
        ?>
    </div>
</div><!-- .breadcrumb-wrapper -->