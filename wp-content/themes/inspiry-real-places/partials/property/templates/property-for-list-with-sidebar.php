<?php
global $inspiry_options;
global $property_list_counter;
global $post;

$list_property = new Inspiry_Property( get_the_ID() );

?>
<article class="property-listing-simple property-listing-simple-2 hentry clearfix">

    <div class="property-thumbnail col-sm-5 zero-horizontal-padding">

        <div class="price-wrapper">
            <span class="price"><?php $list_property->price(); ?></span>
        </div>

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

    </div>
    <!-- .property-thumbnail -->

    <div class="title-and-meta col-sm-7">

        <header class="entry-header">
            <h3 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h3>
        </header>

        <?php
        /*
         * Property meta
         */
        inspiry_property_meta( $list_property, array( 'exclude' => array( 'id' ) ) );
        ?>

    </div>
    <!-- .title-and-meta -->

</article><!-- .property-listing-simple-2 -->

