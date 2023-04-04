<?php
global $inspiry_options;
$variation    = 'one';
$hiw_bg_color = '#202020';

$hiw_bg_img   = null;
if ( isset( $inspiry_options[ 'inspiry_hiw_bg_image' ] ) ) {
    $hiw_bg_img = $inspiry_options[ 'inspiry_hiw_bg_image' ][ 'url' ];
}

if ( $inspiry_options[ 'inspiry_hiw_section_bg' ] == 0 ) {
    $variation    = 'two';
    $hiw_bg_img   = null;
    $hiw_bg_color = '#ffffff';
}

$inspiry_allowed_tags = array(
    'a' => array(
        'href' => array(),
        'title' => array(),
        'target' => array(),
    ),
    'em' => array(),
    'strong' => array(),
    'br' => array(),
);

?>
<section class="submit-property submit-property-<?php echo esc_attr( $variation ); ?> fade-in-up <?php echo esc_attr( inspiry_animation_class() ); ?>"
         style="<?php inspiry_generate_background( $hiw_bg_color, $hiw_bg_img ); ?>">

    <div class="container">

        <?php
        if ( !empty( $inspiry_options[ 'inspiry_hiw_welcome' ] ) || !empty( $inspiry_options[ 'inspiry_hiw_title' ] ) || !empty( $inspiry_options[ 'inspiry_hiw_description' ] ) ) {
        ?>
        <header class="submit-property-header">
            <?php
            /*
             * Welcome
             */
            if ( !empty( $inspiry_options[ 'inspiry_hiw_welcome' ] ) ) {
                ?><h3 class="sub-title"><?php echo esc_html( $inspiry_options[ 'inspiry_hiw_welcome' ] ); ?></h3><?php
            }

            /*
             * Title
             */
            if ( !empty( $inspiry_options[ 'inspiry_hiw_title' ] ) ) {
                ?><h2 class="title"><?php echo esc_html( $inspiry_options[ 'inspiry_hiw_title' ] ); ?></h2><?php
            }

            /*
             * Description
             */
            if ( !empty( $inspiry_options[ 'inspiry_hiw_description' ] ) ) {
                ?><p><?php echo wp_kses( $inspiry_options[ 'inspiry_hiw_description' ] , $inspiry_allowed_tags ); ?><p><?php
            }
            ?>
        </header>
        <?php } ?>

        <?php
        /*
         * Columns
         */
        $hiw_columns = $inspiry_options[ 'inspiry_hiw_columns' ];
        if ( $hiw_columns != '0' ) {

            // column class
            $hiw_column_class = 'col-sm-4';
            if ( $hiw_columns == '2' ) {
                $hiw_column_class = 'col-sm-6';
            } else if ( $hiw_columns == '1' ) {
                $hiw_column_class = 'col-sm-12';
            }

            // alignment class
            if ( $inspiry_options[ 'inspiry_hiw_column_alignment' ] == 'center' ) {
                $hiw_column_class .= ' text-center';
            }
            
            // todo: provide anchor styles in description text in version 1.1
            ?>
            <div class="row submit-property-placeholders">

                <?php if ( in_array( $hiw_columns, array( '1', '2', '3' ) ) ) { ?>
                <div class="<?php echo esc_attr( $hiw_column_class ); ?> submit-property-placeholder fade-in-up <?php echo esc_attr( inspiry_animation_class() ); ?>">
                    <div class="image-wrapper">
                        <img src="<?php echo esc_url( $inspiry_options['inspiry_hiw_1st_col_icon']['url'] ); ?>" alt="Icon"/>
                    </div>
                    <h3 class="submit-property-title"><?php echo esc_html( $inspiry_options['inspiry_hiw_1st_col_title'] ); ?></h3>

                    <p><?php echo wp_kses( $inspiry_options['inspiry_hiw_1st_col_description'], $inspiry_allowed_tags ); ?></p>
                </div>
                <?php } ?>

                <?php if ( in_array( $hiw_columns, array( '2', '3' ) ) ) { ?>
                <div class="<?php echo esc_attr( $hiw_column_class ); ?> submit-property-placeholder fade-in-up <?php echo esc_attr( inspiry_animation_class() ); ?>">
                    <div class="image-wrapper">
                        <img src="<?php echo esc_url( $inspiry_options['inspiry_hiw_2nd_col_icon']['url'] ); ?>" alt=""/>
                    </div>
                    <h3 class="submit-property-title"><?php echo esc_html( $inspiry_options['inspiry_hiw_2nd_col_title'] ); ?></h3>

                    <p><?php echo wp_kses( $inspiry_options['inspiry_hiw_2nd_col_description'], $inspiry_allowed_tags ); ?></p>
                </div>
                <?php } ?>

                <?php if ( $hiw_columns == '3' ) { ?>
                <div
                    class="<?php echo esc_attr( $hiw_column_class ) ?> submit-property-placeholder fade-in-up <?php echo esc_attr( inspiry_animation_class() ); ?>">
                    <div class="image-wrapper">
                        <img src="<?php echo esc_url( $inspiry_options['inspiry_hiw_3rd_col_icon']['url'] ); ?>" alt=""/>
                    </div>
                    <h3 class="submit-property-title"><?php echo esc_html( $inspiry_options['inspiry_hiw_3rd_col_title'] ); ?></h3>

                    <p><?php echo wp_kses( $inspiry_options['inspiry_hiw_3rd_col_description'], $inspiry_allowed_tags ); ?></p>
                </div>
                <?php } ?>

            </div>
            <?php
        }

        /*
         * Submit Property Button
         */
        if ( $inspiry_options[ 'inspiry_hiw_submit_button' ] ) {
            ?>
            <div class="text-center">
                <a class="btn-large btn-green" href="<?php echo esc_url( $inspiry_options[ 'inspiry_hiw_button_url' ] ); ?>"><?php echo esc_html( $inspiry_options[ 'inspiry_hiw_button_text' ] );  ?></a>
            </div>
            <?php
        }
        ?>

    </div>
    <!-- .container -->

</section><!-- .submit-property-section -->

