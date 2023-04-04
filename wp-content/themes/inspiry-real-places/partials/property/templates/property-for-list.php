<?php
global $inspiry_options;
global $property_list_counter;
global $post;

$list_property = new Inspiry_Property( get_the_ID() );

/*
 * Even / Odd Class
 */
$even_odd_class = 'listing-post-odd';
if ( $property_list_counter % 2 == 0) {
    $even_odd_class = 'listing-post-even';
}

/*
 * Price title
 */
$price_title = __( 'Price', 'inspiry' );
if ( !empty( $inspiry_options[ 'inspiry_property_card_price_title' ] ) ) {
    $price_title = $inspiry_options[ 'inspiry_property_card_price_title' ];
}

/*
 * Description title
 */
$desc_title = __( 'Description', 'inspiry' );
if ( !empty( $inspiry_options[ 'inspiry_property_card_desc_title' ] ) ) {
    $desc_title = $inspiry_options[ 'inspiry_property_card_desc_title' ];
}

/*
 * Button Text
 */
$button_text = __( 'Show Details', 'inspiry' );
if ( !empty( $inspiry_options[ 'inspiry_property_card_button_text' ] ) ) {
    $button_text = $inspiry_options[ 'inspiry_property_card_button_text' ];
}
?>
<article class="property-listing-simple property-listing-simple-1 hentry clearfix <?php echo esc_attr( $even_odd_class ); ?>">

    <div class="property-thumbnail col-sm-4 zero-horizontal-padding">
        <?php
        /*
         * Display image gallery or thumbnail
         */
        if ( $inspiry_options[ 'inspiry_property_card_gallery' ] ) {
            inspiry_property_gallery( $list_property->get_post_ID(), intval( $inspiry_options[ 'inspiry_property_card_gallery_limit' ] ) );
        } else {
            inspiry_thumbnail();
        }
        ?>
    </div><!-- .property-thumbnail -->

    <div class="title-and-meta col-sm-8">

        <header class="entry-header">

            <h3 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h3>

            <div class="price-wrapper hidden-lg">
                <span class="prefix-text"><?php echo esc_html( $price_title ); ?></span>
                <span class="price"><?php echo esc_html( $list_property->get_price_without_postfix() ); ?></span><?php
                $price_postfix = $list_property->get_price_postfix();
                if ( !empty( $price_postfix ) ) {
                    ?><span class="postfix-text"><?php echo ' ' . $price_postfix; ?></span><?php
                }
                ?>
            </div>

            <?php
            /*
             * Address
             */
            $list_property_address = $list_property->get_address();
            if ( !empty( $list_property_address ) ) {
                ?><p class="property-address visible-lg"><i class="fa fa-map-marker"></i><?php echo esc_html( $list_property_address ); ?></p><?php
            }
            ?>
        </header>

        <?php
        /*
         * Property meta
         */
        inspiry_property_meta( $list_property, array( 'exclude' => array( 'id' ) ) );
        ?>

        <a class="btn-default visible-md-inline-block" href="<?php the_permalink(); ?>"><?php echo esc_html( $button_text ); ?><i class="fa fa-angle-right"></i></a>

    </div><!-- .title-and-meta -->

    <div class="property-description visible-lg">

        <?php
        /*
         * Description
         */
        $property_excerpt = get_inspiry_excerpt( 12 );
        if ( ! empty( $property_excerpt ) ) {
            ?>
            <h4 class="title-heading"><?php echo esc_html( $desc_title ); ?></h4>
            <p><?php echo esc_html( $property_excerpt ); ?></p>
            <?php
        }
        ?>

        <div class="price-wrapper">
            <span class="prefix-text"><?php echo esc_html( $price_title ); ?></span>
            <span class="price"><?php echo esc_html( $list_property->get_price_without_postfix() ); ?></span><?php
            $price_postfix = $list_property->get_price_postfix();
            if ( !empty( $price_postfix ) ) {
                ?><span class="postfix-text"><?php echo ' ' . $price_postfix; ?></span><?php
            }
            ?>
        </div>

        <a class="btn-default" href="<?php the_permalink(); ?>"><?php echo esc_html( $button_text ); ?><i class="fa fa-angle-right"></i></a>

    </div><!-- .property-description -->

</article><!-- .property-listing-simple -->