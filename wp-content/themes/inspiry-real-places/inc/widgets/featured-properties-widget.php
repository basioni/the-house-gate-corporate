<?php
if ( !class_exists( 'Inspiry_Featured_Properties_Widget' ) ) {
    class Inspiry_Featured_Properties_Widget extends WP_Widget {

        public function __construct(){
            $widget_ops = array(
                'classname' => 'Inspiry_Featured_Properties_Widget',
                'description' => __('Displays random or recent featured properties.','inspiry')
            );
            parent::__construct( 'Inspiry_Featured_Properties_Widget', __('Inspiry Featured Properties','inspiry'), $widget_ops );
        }


        function widget($args, $instance) {

            extract($args);

            $title = apply_filters( 'widget_title', $instance['title'] );

            if ( empty($title) ) $title = false;

            // number of properties
            $count = intval( $instance['count']);
            if ( !$count || $count < 1 ) {
                $count = 2;
            }

            $sort_by = $instance['sort_by'];

            $featured_args = array(
                'post_type' => 'property',
                'posts_per_page' => $count,
                'meta_query' => array(
                    array(
                        'key' => 'REAL_HOMES_featured',
                        'value' => 1,
                        'compare' => '=',
                        'type'  => 'NUMERIC'
                    )
                )
            );


            //Order by
            if($sort_by == "random"):
                $featured_args['orderby']= "rand";
            else:
                $featured_args['orderby']= "date";
            endif;

            $featured_query = new WP_Query($featured_args);

            echo $before_widget;

            if($title):
                echo $before_title;
                echo esc_html( $title );
                echo $after_title;
            endif;

            if( $featured_query->have_posts() ):
                ?>
                <ul class="widget-featured-properties">
                    <?php
                    while($featured_query->have_posts()):
                        $featured_query->the_post();
                        $featured_property = new Inspiry_Property( get_the_ID() );
                        ?>
                        <li>
                            <figure class="featured-properties-thumbnail">
                                <span class="price"><?php $featured_property->price() ?></span>
                                <?php inspiry_thumbnail( 'post-thumbnail' ) ?>
                            </figure>
                            <h4 class="featured-properties-title">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h4>
                            <p><?php inspiry_excerpt( 12 ); ?> <a href="<?php the_permalink() ?>" class="read-more-link"><?php _e( 'Know More', 'inspiry' ); ?></a></p>
                        </li>
                        <?php
                    endwhile;
                    ?>
                </ul>
                <?php
            else:
                ?>
                <ul class="widget-featured-properties">
                    <?php
                    echo '<li>';
                    _e('No featured property found!', 'inspiry');
                    echo '</li>';
                    ?>
                </ul>
                <?php
            endif;

            wp_reset_postdata();

            echo $after_widget;
        }


        function form($instance)
        {
            $instance = wp_parse_args( (array) $instance, array( 'title' => 'Featured Properties', 'count' => 1 , 'sort_by' => 'random' ) );

            $title= esc_attr($instance['title']);
            $count =  $instance['count'];
            $sort_by = $instance['sort_by'];

                ?>
                <p>
                    <label for="<?php echo esc_attr( $this->get_field_id('title') ); ?>"><?php _e('Widget Title', 'inspiry'); ?></label>
                    <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('title') ); ?>" name="<?php echo esc_attr( $this->get_field_name('title') ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
                </p>
                <p>
                    <label for="<?php echo esc_attr( $this->get_field_id('count') ); ?>"><?php _e('Number of Properties', 'inspiry'); ?></label>
                    <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('count') ); ?>" name="<?php echo esc_attr( $this->get_field_name('count') ); ?>" type="text" value="<?php echo esc_attr( $count ); ?>" />
                </p>
                <p>
                    <label for="<?php echo esc_attr( $this->get_field_id('sort_by') ); ?>"><?php _e('Sort By:', 'inspiry') ?></label>
                    <select name="<?php echo esc_attr( $this->get_field_name('sort_by') ); ?>" id="<?php echo esc_attr( $this->get_field_id('sort_by') ); ?>" class="widefat">
                            <option value="recent"<?php selected( $sort_by, 'recent' ); ?>><?php _e('Most Recent', 'inspiry'); ?></option>
                            <option value="random"<?php selected( $sort_by, 'random' ); ?>><?php _e('Random', 'inspiry'); ?></option>
                    </select>
                </p>
                <?php
        }

        function update($new_instance, $old_instance)
        {
            $instance = $old_instance;

            $instance['title'] = strip_tags($new_instance['title']);
            $instance['count'] = $new_instance['count'];
            $instance['sort_by'] = $new_instance['sort_by'];

            return $instance;

        }

    }
}



if( !function_exists( 'inspiry_register_featured_properties_widget' ) ) :
    /**
     * Register featured properties widget
     */
    function inspiry_register_featured_properties_widget() {
        register_widget( 'Inspiry_Featured_Properties_Widget' );
    }
    add_action( 'widgets_init', 'inspiry_register_featured_properties_widget' );
endif;
