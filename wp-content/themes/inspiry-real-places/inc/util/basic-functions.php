<?php
/*
 * This file contains basic utility functions used throughout the theme
 */

if ( ! function_exists( 'inspiry_generate_background' ) ) :
    /**
     * Generate background styles
     *
     * @since 1.0.0
     * @param null $color
     * @param null $url
     */
    function inspiry_generate_background( $color = null, $url = null ) {
        if ( !empty( $url ) && !empty( $color ) ) {
            echo 'background: url(' . esc_url( $url ) . ') ' . $color . ' no-repeat center top; background-size:cover;';
        } elseif ( !empty( $url ) ) {
            echo 'background: url(' . esc_url( $url ) . ') no-repeat center top; background-size:cover;';
        } elseif ( !empty( $color ) ) {
            echo 'background-color:' . $color . ';';
        }
    }

endif;



if ( ! function_exists( 'inspiry_animation_class' ) ) :
    /**
     * Return animation class to enable animation.
     *
     * @since 1.0.0
     * @param   bool $generate
     * @return  string
     */
    function inspiry_animation_class( $generate = false ) {
        global $inspiry_options;
        if ( $generate || ( $inspiry_options['inspiry_animation'] == 1 ) ) {
            return 'animated';
        }
        return '';
    }

endif;



if ( !function_exists( 'inspiry_standard_thumbnail' ) ) :
    /**
     * Generate standard thumbnail for this theme
     *
     * @since 1.0.0
     * @param   string  $size
     */
    function inspiry_standard_thumbnail( $size = 'post-thumbnail' ) {

        global $post;

        if ( has_post_thumbnail( $post->ID ) ) :

            if ( is_single() ) :
                $featured_image_id = get_post_thumbnail_id();
                $original_image_url = wp_get_attachment_url( $featured_image_id );
                ?>
                <figure class="entry-thumbnail">
                    <a  class="swipebox" href="<?php echo esc_url( $original_image_url ); ?>" title="<?php the_title(); ?>">
                        <?php the_post_thumbnail( $size, array('class'=>"img-responsive") ); ?>
                    </a>
                </figure>
                <?php
            else :
                ?>
                <figure class="entry-thumbnail">
                    <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" rel="bookmark">
                        <?php the_post_thumbnail( $size, array( 'class' => 'img-responsive' ) ); ?>
                    </a>
                </figure>
                <?php
            endif;

        endif;
    }

endif;



if( ! function_exists( 'inspiry_standard_gallery' ) ) :
    /**
     * Get list of gallery images
     *
     * @since 1.0.0
     * @param string $size
     */
    function inspiry_standard_gallery( $size = 'post-thumbnail' ) {

        global $post;

        $gallery_images = inspiry_get_post_meta( 'REAL_HOMES_gallery', array( 'type' => 'image_advanced', 'size' => $size ), $post->ID );

        if( ! empty( $gallery_images ) ) {

            echo '<div class="blog-gallery-slider gallery-slider flexslider">';
                echo '<ul class="slides list-unstyled">';

                foreach( $gallery_images as $gallery_image ) {
                    $caption = ( !empty( $gallery_image['caption'] ) ) ? $gallery_image['caption'] : $gallery_image['alt'];
                    echo '<li><a class="swipebox" data-rel="gallery-' . $post->ID . '" href="' . esc_url( $gallery_image['full_url'] ) . '" title="' . $caption . '" >';
                    echo '<img src="' . esc_url( $gallery_image['url'] ) .'" alt="' . $gallery_image['title'] . '" />';
                    echo '</a></li>';
                }

                echo '</ul>';
            echo '</div>';

        } else if ( has_post_thumbnail( $post->ID ) ) {

            inspiry_standard_thumbnail( $size );

        }

    }

endif;



if( ! function_exists( 'inspiry_get_post_meta' ) ) :
    /**
     * Get post meta
     *
     * @since 1.0.0
     * @param string   $key     Meta key. Required.
     * @param int|null $post_id Post ID. null for current post. Optional
     * @param array    $args    Array of arguments. Optional.
     *
     * @return mixed
     */
    function inspiry_get_post_meta( $key, $args = array(), $post_id = null ) {

        $post_id = empty( $post_id ) ? get_the_ID() : $post_id;
        $args = wp_parse_args( $args, array( 'type' => 'text', 'multiple' => false, ) );

        // Always set 'multiple' true for following field types
        if ( in_array( $args['type'], array('checkbox_list', 'file', 'file_advanced', 'image', 'image_advanced', 'plupload_image', 'thickbox_image') ) ) {
            $args['multiple'] = true;
        }

        $meta = get_post_meta( $post_id, $key, !$args['multiple'] );

        // Get uploaded files info
        if (in_array($args['type'], array('file', 'file_advanced'))) {

            if ( is_array( $meta ) && !empty( $meta ) ) {
                $files = array();
                foreach ($meta as $id) {
                    // Get only info of existing attachments
                    if (get_attached_file($id)) {
                        $files[$id] = inspiry_get_file_info($id);
                    }
                }
                $meta = $files;
            }

        // Get uploaded images info
        } elseif (in_array($args['type'], array('image', 'plupload_image', 'thickbox_image', 'image_advanced'))) {

            if (is_array($meta) && !empty($meta)) {
                $images = array();
                foreach ($meta as $id) {
                    // Get only info of existing attachments
                    if (get_attached_file($id)) {
                        $images[$id] = inspiry_get_file_info($id, $args);
                    }
                }
                $meta = $images;
            }

        // Get terms
        } elseif ('taxonomy_advanced' == $args['type']) {

            if (!empty($args['taxonomy'])) {
                $term_ids = array_map('intval', array_filter(explode(',', $meta . ',')));
                // Allow to pass more arguments to "get_terms"
                $func_args = wp_parse_args(array(
                    'include' => $term_ids,
                    'hide_empty' => false,
                ), $args);
                unset($func_args['type'], $func_args['taxonomy'], $func_args['multiple']);
                $meta = get_terms($args['taxonomy'], $func_args);
            } else {
                $meta = array();
            }

        // Get post terms
        } elseif ( 'taxonomy' == $args['type'] ) {

            $meta = empty( $args['taxonomy'] ) ? array() : wp_get_post_terms( $post_id, $args['taxonomy'] );

        }

        return $meta;
    }

endif;



if( ! function_exists( 'inspiry_get_file_info' ) ) :
    /**
     * Get uploaded file information
     *
     * @since 1.0.0
     * @param int   $file_id Attachment image ID (post ID). Required.
     * @param array $args    Array of arguments (for size).
     *
     * @return array|bool False if file not found. Array of image info on success
     */
    function inspiry_get_file_info( $file_id, $args = array() ) {

        $args = wp_parse_args( $args, array(
            'size' => 'thumbnail',
        ) );

        $img_src = wp_get_attachment_image_src( $file_id, $args['size'] );
        if ( ! $img_src ) {
            return false;
        }

        $attachment = get_post( $file_id );
        $path       = get_attached_file( $file_id );
        return array(
            'ID'          => $file_id,
            'name'        => basename( $path ),
            'path'        => $path,
            'url'         => $img_src[0],
            'width'       => $img_src[1],
            'height'      => $img_src[2],
            'full_url'    => wp_get_attachment_url( $file_id ),
            'title'       => $attachment->post_title,
            'caption'     => $attachment->post_excerpt,
            'description' => $attachment->post_content,
            'alt'         => get_post_meta( $file_id, '_wp_attachment_image_alt', true ),
        );
    }

endif;



if ( !function_exists('inspiry_nothing_found') ) :
    /**
     * Display nothing found message
     *
     * @param $message
     */
    function inspiry_nothing_found() {
        ?>
        <section class="no-results not-found">
            <h2><?php esc_html_e( 'Nothing Found', 'inspiry' ); ?></h2>
            <p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'inspiry' ); ?></p>
            <?php get_search_form(); ?>
        </section>
        <!-- .no-results -->
        <?php
    }

endif;



if ( ! function_exists( 'inspiry_pagination' ) ) :
    /**
     * Output pagination
     *
     * @param $query
     */
    function inspiry_pagination( $query ) {

        echo "<div class='pagination'>";

        $big = 999999999; // need an unlikely integer
        echo paginate_links( array(
            'base' => str_replace( $big, '%#%', esc_url ( get_pagenum_link( $big ) ) ),
            'format' => '?paged=%#%',
            'prev_text' => __( '<i class="fa fa-angle-left"></i>', 'inspiry' ),
            'next_text' => __( '<i class="fa fa-angle-right"></i>', 'inspiry' ),
            'current' => max( 1, get_query_var ( 'paged' ) ),
            'total' => $query->max_num_pages,
        ) );

        echo "</div>";

    }

endif;



if( !function_exists( 'inspiry_excerpt' ) ) {
    /**
     * Output excerpt for given number of words
     * @param int $len
     * @param string $trim
     */
    function inspiry_excerpt( $len=15, $trim = "&hellip;" ) {
        echo get_inspiry_excerpt( $len, $trim );
    }
}



if( !function_exists( 'get_inspiry_excerpt' ) ) {
    /**
     * Return excerpt for given number of words.
     * @param int $len
     * @param string $trim
     * @return string
     */
    function get_inspiry_excerpt( $len=15, $trim = "&hellip;" ) {
        $limit = $len+1;
        $excerpt = explode( ' ', get_the_excerpt(), $limit );
        $num_words = count( $excerpt );
        if ( $num_words >= $len ) {
            $last_item = array_pop( $excerpt );
        } else {
            $trim="";
        }
        $excerpt = implode( " ", $excerpt ) . $trim ;
        return $excerpt;
    }
}



if( !function_exists( 'get_inspiry_custom_excerpt' ) ) {
    /**
     * Return excerpt for given number of words from custom contents
     * @param string $contents
     * @param int $len
     * @param string $trim
     * @return array|string
     */
    function get_inspiry_custom_excerpt( $contents, $len = 15, $trim = "&hellip;" ){
        $limit = $len+1;
        $excerpt = explode( ' ', $contents, $limit );
        $num_words = count( $excerpt );
        if( $num_words >= $len ){
            $last_item = array_pop( $excerpt );
        } else {
            $trim = "";
        }
        $excerpt = implode( " ", $excerpt ) . $trim;
        return $excerpt;
    }
}



if( !function_exists( 'inspiry_send_message' ) ){
    /**
     * contact form handler
     */
    function inspiry_send_message() {

        if ( isset($_POST['email'] ) ):

            global $inspiry_options;
            $nonce = $_POST['nonce'];

            if (!wp_verify_nonce($nonce, 'send_message_nonce')) {
                echo json_encode(array(
                    'success' => false,
                    'message' => __('Unverified Nonce!', 'inspiry')
                ));
                die;
            }

            if ( class_exists( 'Inspiry_Real_Estate' )
                && ( $inspiry_options[ 'inspiry_google_reCAPTCHA' ] )
                && !empty( $inspiry_options[ 'inspiry_reCAPTCHA_site_key' ] )
                && !empty( $inspiry_options[ 'inspiry_reCAPTCHA_secret_key' ] )) {

                // include reCAPTCHA library - https://github.com/google/recaptcha
                require_once( WP_PLUGIN_DIR . '/inspiry-real-estate/reCAPTCHA/autoload.php' );

                // If the form submission includes the "g-captcha-response" field
                // Create an instance of the service using your secret
                $reCAPTCHA = new \ReCaptcha\ReCaptcha( $inspiry_options[ 'inspiry_reCAPTCHA_secret_key' ] );

                // If file_get_contents() is locked down on your PHP installation to disallow
                // its use with URLs, then you can use the alternative request method instead.
                // This makes use of fsockopen() instead.
                //  $reCAPTCHA = new \ReCaptcha\ReCaptcha($secret, new \ReCaptcha\RequestMethod\SocketPost());

                // Make the call to verify the response and also pass the user's IP address
                $resp = $reCAPTCHA->verify( $_POST['g-recaptcha-response'], $_SERVER['REMOTE_ADDR'] );

                if ( $resp->isSuccess() ){
                    // If the response is a success, that's it!
                } else {
                    // reference for error codes - https://developers.google.com/recaptcha/docs/verify
                    $error_messages =  array(
                        'missing-input-secret' => 'The secret parameter is missing.',
                        'invalid-input-secret' => 'The secret parameter is invalid or malformed.',
                        'missing-input-response' => 'The response parameter is missing.',
                        'invalid-input-response' => 'The response parameter is invalid or malformed.',
                    );
                    $error_codes = $resp->getErrorCodes();
                    $final_error_message = $error_messages[ $error_codes[0] ];
                    echo json_encode( array(
                        'success' => false,
                        'message' => __('reCAPTCHA Failed:', 'inspiry') . ' ' . $final_error_message
                    ) );
                    die;
                }

            }

            // Sanitize and Validate Target email address that is coming from agent form
            $to_email = sanitize_email( $_POST['target'] );
            $to_email = is_email( $to_email );
            if ( !$to_email ) {
                echo wp_json_encode( array(
                    'success' => false,
                    'message' => __( 'Target Email address is not properly configured!', 'inspiry' )
                ));
                die;
            }

            /*
             *  Sanitize and Validate contact form input data
             */
            $from_name = sanitize_text_field( $_POST['name'] );
            $phone_number = sanitize_text_field( $_POST['number'] );
            $message = stripslashes( $_POST['message'] );
            $from_email = sanitize_email( $_POST['email'] );
            $from_email = is_email( $from_email );
            if (! $from_email ) {
                echo json_encode(array(
                    'success' => false,
                    'message' => __('Provided Email address is invalid!', 'inspiry')
                ));
                die;
            }

            $email_subject = __( 'New message sent by', 'inspiry' ) . ' ' . $from_name . ' ' . __( 'using contact form at', 'inspiry' ) . ' ' . get_bloginfo( 'name' );
            $email_body = __( "You have received a message from: ", 'inspiry' ) . $from_name . " <br/>";

            if ( !empty( $phone_number ) ) {
                $email_body .= __( "Phone Number : ", 'inspiry' ) . $phone_number . " <br/>";
            }

            $email_body .= __( "Their additional message is as follows.", 'inspiry' ) . " <br/>";
            $email_body .= wpautop( $message ) . " <br/>";
            $email_body .= __("You can contact ", 'inspiry') . $from_name . __(" via email, ", 'inspiry') . $from_email;

            $header = 'Content-type: text/html; charset=utf-8' . "\r\n";
            $header = apply_filters( "inspiry_contact_mail_header", $header );
            $header .= 'From: ' . $from_name . " <" . $from_email . "> \r\n";

            if ( wp_mail( $to_email, $email_subject, $email_body, $header ) ) {
                echo json_encode( array(
                    'success' => true,
                    'message' => __("Message Sent Successfully!", 'inspiry')
                ) );
            } else {
                echo json_encode( array(
                        'success' => false,
                        'message' => __( "Server Error: WordPress mail function failed!", 'inspiry' )
                    )
                );
            }

        else:
            echo json_encode( array(
                    'success' => false,
                    'message' => __("Invalid Request !", 'inspiry')
                )
            );
        endif;

        die;
    }

    add_action( 'wp_ajax_nopriv_inspiry_send_message', 'inspiry_send_message' );
    add_action( 'wp_ajax_inspiry_send_message', 'inspiry_send_message' );

}



if( !function_exists( 'inspiry_col_animation_class' ) ) {
    /**
     * Provide animation class based on columns and index
     * @param int $number_of_cols   number of columns
     * @param int $col_index    column's index
     * @return string   animation class
     */
    function inspiry_col_animation_class($number_of_cols = 3, $col_index ) {

        // For 1 Column Layout
        if ( $number_of_cols == 1 ) {
            return 'fade-in-up';
        }

        // For 2 Columns Layout
        if ( $number_of_cols == 2 ) {
            if ( $col_index % 2 == 0 ) {
                return 'fade-in-right';
            } else {
                return 'fade-in-left';
            }
        }

        // For 3 Columns Layout
        if ( $number_of_cols == 3 ) {
            if ( $col_index % 3 == 0 ) {
                return 'fade-in-right';
            } else if ( $col_index % 3 == 1 ) {
                return 'fade-in-left';
            } else {
                return 'fade-in-up';
            }
        }

        // For 4 Columns Layout
        if ( $number_of_cols == 4 ) {
            if ( $col_index % 4 == 0 ) {
                return 'fade-in-right';
            } else if ( $col_index % 4 == 1 ) {
                return 'fade-in-left';
            } else {
                return 'fade-in-up';
            }
        }

        return 'fade-in-up';

    }
}



/*-----------------------------------------------------------------------------------*/
// Featured image place holder
/*-----------------------------------------------------------------------------------*/
if( !function_exists('get_inspiry_image_placeholder')){
    /**
     * Return place holder image
     * @param $image_size string    image size
     * @param $image_class string   image class
     * @return string   image tag
     */
    function get_inspiry_image_placeholder( $image_size, $image_class = 'img-responsive' ){

        global $_wp_additional_image_sizes;

        $holder_width = 0;
        $holder_height = 0;
        $holder_text = get_bloginfo('name');

        if ( in_array( $image_size , array( 'thumbnail', 'medium', 'large' ) ) ) {

            $holder_width = get_option( $image_size . '_size_w' );
            $holder_height = get_option( $image_size . '_size_h' );

        } elseif ( isset( $_wp_additional_image_sizes[ $image_size ] ) ) {

            $holder_width = $_wp_additional_image_sizes[ $image_size ]['width'];
            $holder_height = $_wp_additional_image_sizes[ $image_size ]['height'];

        }

        if( intval( $holder_width ) > 0 && intval( $holder_height ) > 0 ) {
            $place_holder_final_url = esc_url( add_query_arg( array(
                'text' => urlencode( $holder_text )
            ), sprintf(
                '//placehold.it/%dx%d',
                $holder_width,
                $holder_height
            ) ) );
            return sprintf( '<img class="%s" src="%s" />', $image_class, $place_holder_final_url );
        }

        return '';
    }
}



if( !function_exists( 'inspiry_image_placeholder' ) ) {
    /*
     * Display place holder image.
     */
    function inspiry_image_placeholder( $image_size, $image_class = 'img-responsive' ) {
        echo get_inspiry_image_placeholder( $image_size, $image_class );
    }
}



if( !function_exists( 'inspiry_thumbnail' ) ) :
    /**
     * Display thumbnail
     * @param string $size
     */
    function inspiry_thumbnail( $size = 'inspiry-grid-thumbnail' ) {
        ?>
        <a href="<?php the_permalink(); ?>">
            <?php
            if ( has_post_thumbnail() ) {
                the_post_thumbnail( $size, array( 'class' => 'img-responsive' ) );
            } else {
                inspiry_image_placeholder( $size, 'img-responsive' );
            }
            ?>
        </a>
    <?php
    }
endif;



if( !function_exists( 'inspiry_message' ) ) :
    /**
     * Output given message for visitor
     *
     * @param string $heading
     * @param string $message
     */
    function inspiry_message( $heading = '', $message = '' ) {

        echo '<div class="inspiry-message">';
        if ( !empty( $heading ) ) {
            echo '<h3>' . $heading . '</h3>';
        }
        if ( !empty( $message ) ) {
            echo '<p>' . $message . '</p>';
        }
        echo '</div>';
    }
endif;



if( !function_exists( 'inspiry_highlighted_message' ) ) :
    /**
     * Output given message for visitor with highlighted background
     *
     * @param string $heading
     * @param string $message
     */
    function inspiry_highlighted_message( $heading = '', $message = '' ) {

        echo '<div class="inspiry-highlighted-message">';
        if ( !empty( $heading ) ) {
            echo '<h4>' . $heading . '</h4>';
        }
        if ( !empty( $message ) ) {
            echo '<p>' . $message . '</p>';
        }
        echo '<i class="fa fa-times close-message"></i>';
        echo '</div>';

    }
endif;




if( !function_exists( 'inspiry_profile_image_upload' ) ) {
    /**
     *  Profile image upload handler
     */
    function inspiry_profile_image_upload( ) {

        // Verify Nonce
        $nonce = $_REQUEST['nonce'];
        if ( ! wp_verify_nonce( $nonce, 'inspiry_allow_upload' ) ) {
            $ajax_response = array(
                'success' => false ,
                'reason' => __( 'Security check failed!', 'inspiry' )
            );
            echo json_encode( $ajax_response );
            die;
        }

        $submitted_file = $_FILES['inspiry_upload_file'];
        $uploaded_image = wp_handle_upload( $submitted_file, array( 'test_form' => false ) );   //Handle PHP uploads in WordPress, sanitizing file names, checking extensions for mime type, and moving the file to the appropriate directory within the uploads directory.

        if ( isset( $uploaded_image['file'] ) ) {
            $file_name          =   basename( $submitted_file['name'] );
            $file_type          =   wp_check_filetype( $uploaded_image['file'] );   //Retrieve the file type from the file name.

            // Prepare an array of post data for the attachment.
            $attachment_details = array(
                'guid'           => $uploaded_image['url'],
                'post_mime_type' => $file_type['type'],
                'post_title'     => preg_replace( '/\.[^.]+$/', '', basename( $file_name ) ),
                'post_content'   => '',
                'post_status'    => 'inherit'
            );

            $attach_id      =   wp_insert_attachment( $attachment_details, $uploaded_image['file'] );       // This function inserts an attachment into the media library
            $attach_data    =   wp_generate_attachment_metadata( $attach_id, $uploaded_image['file'] );     // This function generates metadata for an image attachment. It also creates a thumbnail and other intermediate sizes of the image attachment based on the sizes defined
            wp_update_attachment_metadata( $attach_id, $attach_data );                                      // Update metadata for an attachment.

            $thumbnail_url = inspiry_get_profile_image_url( $attach_data ); // returns escaped url

            $ajax_response = array(
                'success'   => true,
                'url' => $thumbnail_url,
                'attachment_id'    => $attach_id
            );
            echo json_encode( $ajax_response );
            die;

        } else {
            $ajax_response = array(
                'success' => false,
                'reason' => __( 'Image upload failed!', 'inspiry' )
            );
            echo json_encode( $ajax_response );
            die;
        }

    }
    add_action( 'wp_ajax_profile_image_upload', 'inspiry_profile_image_upload' );
}



if( !function_exists( 'inspiry_get_profile_image_url' ) ) {
    /**
     * Get thumbnail url based on attachment data
     * @param $attach_data
     * @return string
     */
    function inspiry_get_profile_image_url( $attach_data ) {
        $upload_dir         =   wp_upload_dir();
        $image_path_array   =   explode( '/', $attach_data['file'] );
        $image_path_array   =   array_slice( $image_path_array, 0, count( $image_path_array ) - 1 );
        $image_path         =   implode( '/', $image_path_array );
        $thumbnail_name     =   null;
        if ( isset( $attach_data['sizes']['inspiry-agent-thumbnail'] ) ) {
            $thumbnail_name     =   $attach_data['sizes']['inspiry-agent-thumbnail']['file'];
        } else {
            $thumbnail_name     =   $attach_data['sizes']['thumbnail']['file'];
        }
        return esc_url( $upload_dir['baseurl'] . '/' . $image_path . '/' . $thumbnail_name );
    }
}



if( !function_exists( 'inspiry_update_profile' ) ) {
    /**
     * Edit profile request handler
     */
    function inspiry_update_profile() {

        // Get user info
        global $current_user;
        get_currentuserinfo();

        // Array for errors
        $errors = array();

        if( wp_verify_nonce( $_POST['user_profile_nonce'], 'update_user' ) ) {

            // profile-image-id
            // Update profile image
            if ( !empty( $_POST['profile-image-id'] ) ) {
                $profile_image_id = intval( $_POST['profile-image-id'] );
                update_user_meta( $current_user->ID, 'profile_image_id', $profile_image_id );
            } else {
                delete_user_meta( $current_user->ID, 'profile_image_id' );
            }

            // Update first name
            if ( !empty( $_POST['first-name'] ) ) {
                $user_first_name = sanitize_text_field( $_POST['first-name'] );
                update_user_meta( $current_user->ID, 'first_name', $user_first_name );
            } else {
                delete_user_meta( $current_user->ID, 'first_name' );
            }

            // Update last name
            if ( !empty( $_POST['last-name'] ) ) {
                $user_last_name = sanitize_text_field( $_POST['last-name'] );
                update_user_meta( $current_user->ID, 'last_name', $user_last_name );
            } else {
                delete_user_meta( $current_user->ID, 'last_name' );
            }

            // Update display name
            if ( !empty( $_POST['display-name'] ) ) {
                $user_display_name = sanitize_text_field( $_POST['display-name'] );
                $return = wp_update_user( array(
                    'ID' => $current_user->ID,
                    'display_name' => $user_display_name
                ) );
                if ( is_wp_error( $return ) ) {
                    $errors[] = $return->get_error_message();
                }
            }

            // Update user email
            if ( !empty( $_POST['email'] ) ){
                $user_email = is_email( sanitize_email ( $_POST['email'] ) );
                if ( !$user_email )
                    $errors[] = __( 'Provided email address is invalid.', 'inspiry' );
                else {
                    $email_exists = email_exists( $user_email );    // email_exists returns a user id if a user exists against it
                    if( $email_exists ) {
                        if( $email_exists != $current_user->ID ){
                            $errors[] = __('Provided email is already in use by another user. Try a different one.', 'inspiry');
                        } else {
                            // no need to update the email as it is already current user's
                        }
                    } else {
                        $return = wp_update_user( array ('ID' => $current_user->ID, 'user_email' => $user_email ) );
                        if ( is_wp_error( $return ) ) {
                            $errors[] = $return->get_error_message();
                        }
                    }
                }
            }

            // update user description
            if ( !empty( $_POST['description'] ) ) {
                $user_description = sanitize_text_field( $_POST['description'] );
                update_user_meta( $current_user->ID, 'description', $user_description );
            } else {
                delete_user_meta( $current_user->ID, 'description' );
            }

            // Update mobile number
            if ( !empty( $_POST['mobile-number'] ) ) {
                $user_mobile_number = sanitize_text_field( $_POST['mobile-number'] );
                update_user_meta( $current_user->ID, 'mobile_number', $user_mobile_number );
            } else {
                delete_user_meta( $current_user->ID, 'mobile_number' );
            }

            // Update office number
            if ( !empty( $_POST['office-number'] ) ) {
                $user_office_number = sanitize_text_field( $_POST['office-number'] );
                update_user_meta( $current_user->ID, 'office_number', $user_office_number );
            } else {
                delete_user_meta( $current_user->ID, 'office_number' );
            }

            // Update fax number
            if ( !empty( $_POST['fax-number'] ) ) {
                $user_fax_number = sanitize_text_field( $_POST['fax-number'] );
                update_user_meta( $current_user->ID, 'fax_number', $user_fax_number );
            } else {
                delete_user_meta( $current_user->ID, 'fax_number' );
            }

            // Update facebook url
            if ( !empty( $_POST['facebook-url'] ) ) {
                $facebook_url = esc_url_raw( sanitize_text_field( $_POST['facebook-url'] ) );
                update_user_meta( $current_user->ID, 'facebook_url', $facebook_url );
            } else {
                delete_user_meta( $current_user->ID, 'facebook_url' );
            }

            // Update twitter url
            if ( !empty( $_POST['twitter-url'] ) ) {
                $twitter_url = esc_url_raw( sanitize_text_field( $_POST['twitter-url'] ) );
                update_user_meta( $current_user->ID, 'twitter_url', $twitter_url );
            } else {
                delete_user_meta( $current_user->ID, 'twitter_url' );
            }

            // Update google plus url
            if ( !empty( $_POST['google-plus-url'] ) ) {
                $google_plus_url = esc_url_raw( sanitize_text_field( $_POST['google-plus-url'] ) );
                update_user_meta( $current_user->ID, 'google_plus_url', $google_plus_url );
            } else {
                delete_user_meta( $current_user->ID, 'google_plus_url' );
            }

            // Update linkedIn url
            if ( !empty( $_POST['linkedin-url'] ) ) {
                $linkedin_url = esc_url_raw( sanitize_text_field( $_POST['linkedin-url'] ) );
                update_user_meta( $current_user->ID, 'linkedin_url', $linkedin_url );
            } else {
                delete_user_meta( $current_user->ID, 'linkedin_url' );
            }

            // todo: add instagram and pin

            // Update user password
            if ( !empty($_POST['pass1'] ) && !empty( $_POST['pass2'] ) ) {
                if ( $_POST['pass1'] == $_POST['pass2'] ) {
                    $return = wp_update_user( array(
                        'ID' => $current_user->ID,
                        'user_pass' => $_POST['pass1']
                    ) );
                    if ( is_wp_error( $return ) ) {
                        $errors[] = $return->get_error_message();
                    }
                } else {
                    $errors[] = __('The passwords you entered do not match.  Your password is not updated.', 'inspiry');
                }
            }

            // if everything is fine
            if ( count( $errors ) == 0 ) {

                //action hook for plugins and extra fields saving
                do_action( 'edit_user_profile_update', $current_user->ID );

                $response = array(
                    'success' => true,
                    'message' => __( 'Profile information is updated successfully!', 'inspiry' ),
                );
                echo json_encode( $response );
                die;
            }

        } else {
            $errors[] = __('Security check failed!', 'inspiry');
        }

        // in case of errors
        $response = array(
            'success' => false,
            'errors' => $errors
        );
        echo json_encode( $response );
        die;

    }
    add_action( 'wp_ajax_inspiry_update_profile', 'inspiry_update_profile' );    // only for logged in user
}



if ( !function_exists( 'inspiry_log' ) ) {
    /**
     * Log a given message to wp-content/debug.log file, if debug is enabled from wp-config.php file
     *
     * @param $message
     */
    function inspiry_log( $message ) {
        if ( WP_DEBUG === true ) {
            if ( is_array( $message ) || is_object( $message ) ) {
                error_log( print_r( $message, true ) );
            } else {
                error_log( $message );
            }
        }
    }
}



if ( ! function_exists( 'inspiry_theme_comment' ) ) {
    /**
     * Theme Custom Comment Template
     */
    function inspiry_theme_comment( $comment, $args, $depth ) {

        $GLOBALS['comment'] = $comment;
        switch ($comment->comment_type) :
            case 'pingback' :
            case 'trackback' :
                ?>
                <li class="pingback">
                    <p><?php _e('Pingback:', 'inspiry'); ?> <?php comment_author_link(); ?><?php edit_comment_link(__('(Edit)', 'inspiry'), ' '); ?></p>
                </li>
                <?php
                break;

            default :
                ?>
            <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
                <article id="comment-<?php comment_ID(); ?>" class="comment-body">

                    <div class="author-photo">
                        <a class="avatar" href="<?php comment_author_url(); ?>">
                            <?php echo get_avatar( $comment, 68, '', '', array( 'class' => 'img-circle', ) ); ?>
                        </a>
                    </div>

                    <div class="comment-wrapper">
                        <div class="comment-meta">
                            <div class="comment-author vcard">
                                <h5 class="fn"><?php echo get_comment_author_link(); ?></h5>
                            </div>
                            <div class="comment-metadata">
                                <time datetime="<?php comment_time('c'); ?>"><?php printf( __( '%1$s', 'inspiry' ), get_comment_date() ); ?></time>
                            </div>
                        </div>

                        <div class="comment-content">
                            <?php comment_text(); ?>
                        </div>

                        <div class="reply">
                            <?php comment_reply_link( array_merge( array( 'before' => '' ), array( 'depth' => $depth , 'max_depth' => $args['max_depth'] ) ) ); ?>
                        </div>
                    </div>

                </article>
                <!-- end of comment -->
                <?php
                break;

        endswitch;
    }
}



if( !function_exists( 'real_places_gallery_desc' ) ) :
    /**
     * Filter for gallery images meta box description
     *
     * @return string|void
     */
    function real_places_gallery_desc() {
        return __( 'Images should have minimum size of 850px by 600px. Bigger size images will be cropped automatically.', 'inspiry' );
    }
    add_filter( 'inspiry_gallery_description', 'real_places_gallery_desc' );
endif;



if( !function_exists( 'real_places_slider_desc' ) ) :
    /**
     * Filter for slider image meta box description
     *
     * @return string|void
     */
    function real_places_slider_desc() {
        return __( 'The recommended image size is 2000px by 1000px. You can use a bigger or smaller size but keep the same height to width ratio and use exactly same size images for all slider entries.', 'inspiry' );
    }
    add_filter( 'inspiry_slider_description', 'real_places_slider_desc' );
endif;



if( !function_exists( 'real_places_video_desc' ) ) :
    /**
     * Filter for video image meta box description
     *
     * @return string|void
     */
    function real_places_video_desc() {
        return __( 'Provided image will be used as a video place holder and when user will click on it the video will be opened in a lightbox. Minimum required image size is 850px by 600px.', 'inspiry' );
    }
    add_filter( 'inspiry_video_description', 'real_places_video_desc' );
endif;



if( !function_exists( 'inspiry_home_body_classes' ) ) :
    /**
     * Filter to add header and slider variation classes to body
     */
    function inspiry_home_body_classes( $classes ) {

        global $inspiry_options;

        // class for sticky header
        if ( $inspiry_options[ 'inspiry_sticky_header' ] == '1' ) {
            $classes[] = 'inspiry-sticky-header';
        }

        if ( is_page_template( 'page-templates/home.php' ) ) {

            // For Demo Purposes
            if ( isset( $_GET['module_below_header'] ) ) {
                $inspiry_options[ 'inspiry_home_module_below_header' ] = $_GET['module_below_header'];
                if ( isset( $_GET['module_below_header'] ) ) {
                    $inspiry_options[ 'inspiry_slider_type' ] = $_GET['slider_type'];
                }
            }

            // class for header variation
            if ( $inspiry_options[ 'inspiry_header_variation' ] == '1' ) {
                $classes[] = 'inspiry-header-variation-one';
            } elseif ( $inspiry_options[ 'inspiry_header_variation' ] == '2' ) {
                $classes[] = 'inspiry-header-variation-two';
            } else {
                $classes[] = 'inspiry-header-variation-three';
            }

            // class for module below header
            if ( $inspiry_options[ 'inspiry_home_module_below_header' ] == 'slider' ) {
                $classes[] = 'inspiry-slider-header';

                // class for slider type
                if ( $inspiry_options[ 'inspiry_slider_type' ] == 'revolution-slider' ) {
                    $classes[] = 'inspiry-revolution-slider';
                } elseif ( $inspiry_options[ 'inspiry_slider_type' ] == 'properties-slider-two' ) {
                    $classes[] = 'inspiry-slider-two';
                } elseif ( $inspiry_options[ 'inspiry_slider_type' ] == 'properties-slider-three' ) {
                    $classes[] = 'inspiry-slider-three';
                } else {
                    $classes[] = 'inspiry-slider-one';
                }

            } else if ( $inspiry_options[ 'inspiry_home_module_below_header' ] == 'google-map' ) {
                $classes[] = 'inspiry-google-map-header';
            } else {
                $classes[] = 'inspiry-banner-header';
            }

        } elseif ( is_page_template( 'page-templates/properties-search.php' ) ) {

            if ( $inspiry_options[ 'inspiry_header_variation' ] == '1' ) {
                if ( $inspiry_options[ 'inspiry_search_module_below_header' ] == 'google-map' ) {
                    $classes[] = 'inspiry-google-map-header';
                } else {
                    $classes = inspiry_revolution_slider_class ( $classes );
                }
            }

        } elseif ( is_page_template( 'page-templates/properties-list.php' )
                    || is_page_template( 'page-templates/properties-list-with-sidebar.php' )
                    || is_page_template( 'page-templates/properties-grid.php' )
                    || is_page_template( 'page-templates/properties-grid-with-sidebar.php' ) ) {

            if ( $inspiry_options[ 'inspiry_header_variation' ] == '1' ) {
                $display_google_map = get_post_meta( get_the_ID(), 'inspiry_display_google_map', true );
                if ( $display_google_map ) {
                    $classes[] = 'inspiry-google-map-header';
                } else {
                    $classes = inspiry_revolution_slider_class ( $classes );
                }
            }

        } elseif ( is_page() || is_singular( 'agent' ) ) {

            if ( $inspiry_options[ 'inspiry_header_variation' ] == '1' ) {
                $classes = inspiry_revolution_slider_class ( $classes );
            }

        }

        return $classes;
    }

    add_filter( 'body_class', 'inspiry_home_body_classes' );

endif;


if( !function_exists( 'inspiry_revolution_slider_class' ) ) :
    /**
     * @param $classes
     * @return array
     */
    function inspiry_revolution_slider_class ( $classes ) {
        $revolution_slider_alias = get_post_meta ( get_the_ID (), 'REAL_HOMES_rev_slider_alias', true );
        if ( function_exists ( 'putRevSlider' ) && ( ! empty( $revolution_slider_alias ) ) ) {
            $classes[] = 'inspiry-revolution-slider';
        }
        return $classes;
    }
endif;


if( !function_exists( 'inspiry_completed_payment_handler' ) ) :
    /**
     * IPN completed payment handler
     */
    function inspiry_completed_payment_handler( $posted ) {

        global $inspiry_options;

        $paypal_merchant_id     = $inspiry_options[ 'inspiry_paypal_merchant_id' ];
        $publish_on_payment     = $inspiry_options[ 'inspiry_publish_on_payment' ];
        // $payment_notification_email      = is_email( $inspiry_options[ 'inspiry_payment_notification_email' ] );

        if( $posted['business'] == $paypal_merchant_id ) {

            if( isset( $posted['item_number'] ) && ( !empty( $posted['item_number'] ) ) ) {

                $property_id = intval( $posted['item_number'] );
                $property = get_post( $property_id, 'ARRAY_A' );

                if ( $property ) {

                    if ( isset( $posted['txn_id'] ) && ( !empty( $posted['txn_id'] ) ) ) {
                        update_post_meta( $property_id, 'txn_id', $posted['txn_id'] );
                    }

                    if ( isset( $posted['payment_date'] ) && ( !empty( $posted['payment_date'] ) ) ) {
                        update_post_meta( $property_id, 'payment_date', $posted['payment_date'] );
                    }

                    if ( isset( $posted['payer_email'] ) && ( !empty( $posted['payer_email'] ) ) ) {
                        update_post_meta( $property_id, 'payer_email', $posted['payer_email'] );
                    }

                    if ( isset( $posted['first_name'] ) && ( !empty( $posted['first_name'] ) ) ) {
                        update_post_meta( $property_id, 'first_name', $posted['first_name'] );
                    }

                    if ( isset( $posted['last_name'] ) && ( !empty( $posted['last_name'] ) ) ) {
                        update_post_meta( $property_id, 'last_name', $posted['last_name'] );
                    }

                    if ( isset( $posted['payment_status'] ) && ( !empty( $posted['payment_status'] ) ) ) {
                        update_post_meta( $property_id, 'payment_status', $posted['payment_status'] );
                    }

                    if ( isset( $posted['payment_gross'] ) && ( !empty( $posted['payment_gross'] ) ) ) {
                        update_post_meta( $property_id, 'payment_gross', $posted['payment_gross'] );
                    }

                    if( isset( $posted['mc_currency'] ) && ( !empty( $posted['mc_currency'] ) ) ) {
                        update_post_meta( $property_id, 'mc_currency', $posted['mc_currency'] );
                    }

                    if ( $publish_on_payment ) {
                        $property['post_status'] = 'publish';
                        wp_update_post( $property );
                    }

                    /*
                     * Todo: Plan to implement in version 1.1
                    if ( $payment_notification_email ) {
                        $site_name = get_bloginfo( 'name' );
                        $email_subject  = sprintf( __('Payment Received for a Property at %s', 'inspiry'), $site_name );
                    }
                    */

                }
            }
        }


    }
    add_action( 'paypal_ipn_for_wordpress_payment_status_completed', 'inspiry_completed_payment_handler' );
endif;



if( !function_exists( 'inspiry_get_breadcrumbs_items' ) ) :
    /**
     * Returns a array of breadcrumbs items
     *
     * @param $post_id  int Post id
     * @param $breadcrumbs_taxonomy string Taxonomy name
     * @return mixed|void
     */
    function inspiry_get_breadcrumbs_items( $post_id, $breadcrumbs_taxonomy ) {

        // Add home at the beginning of the breadcrumbs
		$inspiry_breadcrumbs_items = array(
            array(
                'name' => __( 'Home', 'inspiry' ),
                'url' => esc_url( home_url('/') ),
                'class' => '',
            )
        );

        // Get all assigned terms
        $the_terms = get_the_terms( $post_id, $breadcrumbs_taxonomy );

        if ( $the_terms && ! is_wp_error( $the_terms ) ) :

            $deepest_term = $the_terms[0];
            $deepest_depth = 0;

            // Find the deepest term
            foreach( $the_terms as $term ) {
                $current_term_depth = inspiry_get_term_depth( $term->term_id, $breadcrumbs_taxonomy );
                if ( $current_term_depth > $deepest_depth ) {
                    $deepest_depth = $current_term_depth;
                    $deepest_term = $term;
                }
            }

            // work on deepest term
            if ( $deepest_term ) {

                // Get ancestors if any and add them to breadcrumbs items
                $deepest_term_ancestors = get_ancestors( $deepest_term->term_id, $breadcrumbs_taxonomy );
                if ( $deepest_term_ancestors && ( 0 < count( $deepest_term_ancestors ) ) ) {
                    $deepest_term_ancestors = array_reverse( $deepest_term_ancestors ); // reversing the array is important
                    foreach ( $deepest_term_ancestors as $term_ancestor_id ) {
                        $ancestor_term = get_term_by( 'id', $term_ancestor_id, $breadcrumbs_taxonomy );
                        $inspiry_breadcrumbs_items[] = array(
                            'name' => $ancestor_term->name,
                            'url' => get_term_link( $ancestor_term, $breadcrumbs_taxonomy ),
                            'class' => ''
                        );
                    }
                }

                // add deepest term
                $inspiry_breadcrumbs_items[] = array(
                    'name' => $deepest_term->name,
                    'url' => get_term_link( $deepest_term, $breadcrumbs_taxonomy ),
                    'class' => ''
                );

            }

        endif;

        // Add the current page / property
        $inspiry_breadcrumbs_items[] = array(
            'name' => get_the_title( $post_id ),
            'url' => '',
            'class' => 'active',
        );
		
		return apply_filters( 'inspiry_breadcrumbs_items', $inspiry_breadcrumbs_items );

	}

endif;


if( !function_exists( 'inspiry_get_term_depth' ) ) :
    /**
     * Returns an integer value that tells the term depth in it's hierarchy
     *
     * @param $term_id
     * @param $term_taxonomy
     * @return int
     */
    function inspiry_get_term_depth( $term_id, $term_taxonomy ) {
        $term_ancestors = get_ancestors( $term_id, $term_taxonomy );
        if ( $term_ancestors ) {
            return count( $term_ancestors );
        }
        return 0;
    }
endif;


if( !function_exists( 'inspiry_is_user_restricted' ) ) :
    /**
     * Checks if current user is restricted to access admin side or not
     * @return bool
     */
    function inspiry_is_user_restricted() {
        global $inspiry_options;
        global $current_user;
        get_currentuserinfo();

        if ( isset( $inspiry_options[ 'inspiry_restricted_level' ] ) ) {

            // get restricted level from theme options
            $restricted_level = $inspiry_options['inspiry_restricted_level'];
            if ( !empty( $restricted_level ) ) {
                $restricted_level = intval( $restricted_level );
            } else {
                $restricted_level = 0;
            }

            // Redirects user below a certain user level to home url
            // Ref: https://codex.wordpress.org/Roles_and_Capabilities#User_Level_to_Role_Conversion
            if ( $current_user->user_level <= $restricted_level ) {
                return true;
            }

        }

        return false;
    }
endif;


if( !function_exists( 'inspiry_restrict_admin_access' ) ) :
    /**
     * Restrict user access to admin if his level is equal or below restricted level
     */
    function inspiry_restrict_admin_access() {
        if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) {
            // let it go
        } else if ( isset( $_GET['action'] ) && ( $_GET['action'] == 'delete' )  ) {
            // let it go as it is from my properties delete button
        } else {
            if ( inspiry_is_user_restricted() ) {
                wp_redirect( esc_url_raw( home_url( '/' ) ) );
                exit;
            }
        }
    }
    add_action( 'admin_init', 'inspiry_restrict_admin_access' );
endif;


if( !function_exists( 'inspiry_hide_admin_bar' ) ) :
    /**
     * Hide the admin bar on front end for users with user level equal to or below restricted level
     */
    function inspiry_hide_admin_bar() {
        if( is_user_logged_in() ) {
            if ( inspiry_is_user_restricted() ) {
                add_filter( 'show_admin_bar', '__return_false' );
            }
        }
    }
    add_action( 'init', 'inspiry_hide_admin_bar', 9 );
endif;


if( !function_exists( 'inspiry_ajax_login' ) ) :
    /**
     * AJAX login request handler
     */
    function inspiry_ajax_login() {

        // First check the nonce, if it fails the function will break
        check_ajax_referer( 'inspiry-ajax-login-nonce', 'inspiry-secure-login' );

        // Nonce is checked, get the POST data and sign user on
        inspiry_auth_user_login( $_POST['log'], $_POST['pwd'], __( 'Login', 'inspiry' ) );

        die();
    }

    // Enable the user with no privileges to request ajax login
    add_action( 'wp_ajax_nopriv_inspiry_ajax_login', 'inspiry_ajax_login' );

endif;


if( !function_exists( 'inspiry_auth_user_login' ) ) :
    /**
     * This function process login request and displays JSON response
     *
     * @param $user_login
     * @param $password
     * @param $login
     */
    function inspiry_auth_user_login ( $user_login, $password, $login ) {

        $info = array();
        $info['user_login'] = $user_login;
        $info['user_password'] = $password;
        $info['remember'] = true;

        $user_signon = wp_signon( $info, false );

        if ( is_wp_error( $user_signon ) ) {
            echo json_encode( array (
                'success' => false,
                'message' => __( '* Wrong username or password.', 'inspiry' ),
            ) );
        } else {
            wp_set_current_user( $user_signon->ID );
            echo json_encode( array (
                'success' => true,
                'message' => $login . ' ' . __( 'successful. Redirecting...', 'inspiry' ),
                'redirect' => $_POST['redirect_to']
            ) );
        }

        die();
    }
endif;


if( !function_exists( 'inspiry_ajax_register' ) ) :
    /**
     * AJAX register request handler
     */
    function inspiry_ajax_register() {

        // First check the nonce, if it fails the function will break
        check_ajax_referer( 'inspiry-ajax-register-nonce', 'inspiry-secure-register' );

        // Nonce is checked, Get to work
        $info = array();
        $info['user_nicename'] = $info['nickname'] = $info['display_name'] = $info['first_name'] = $info['user_login'] = sanitize_user( $_POST['register_username'] ) ;
        $info['user_pass'] = sanitize_text_field( $_POST['register_pwd'] );
        $info['user_email'] = sanitize_email( $_POST['register_email'] );

        // Register the user
        $user_register = wp_insert_user( $info );

        if ( is_wp_error( $user_register ) ) {

            $error  = $user_register->get_error_codes()	;
            if ( in_array( 'empty_user_login', $error ) ) {
                echo json_encode( array (
                    'success' => false,
                    'message' => __( $user_register->get_error_message( 'empty_user_login' ) )
                ) );
            } elseif ( in_array ( 'existing_user_login', $error ) ) {
                echo json_encode ( array (
                    'success' => false,
                    'message' => __( 'This username already exists.', 'inspiry' )
                ) );
            } elseif ( in_array ( 'existing_user_email', $error ) ) {
                echo json_encode( array (
                    'success' => false,
                    'message' => __( 'This email is already registered.', 'inspiry' )
                ) );
            }

        } else {
            inspiry_auth_user_login( $info['user_login'], $info['user_pass'], __( 'Registration', 'inspiry' ) );
        }

        die();
    }

    // Enable the user with no privileges to request ajax register
    add_action( 'wp_ajax_nopriv_inspiry_ajax_register', 'inspiry_ajax_register' );

endif;


if( !function_exists( 'inspiry_ajax_reset_password' ) ) :
    /**
     * AJAX reset password request handler
     */
    function inspiry_ajax_reset_password(){

        // First check the nonce, if it fails the function will break
        check_ajax_referer( 'inspiry-ajax-forgot-nonce', 'inspiry-secure-reset' );

        $account = $_POST['reset_username_or_email'];
        $error = "";
        $get_by = "";

        if ( empty( $account ) ) {
            $error = __( 'Provide a valid username or email address!', 'inspiry' );
        } else {
            if ( is_email( $account ) ) {
                if ( email_exists( $account ) ) {
                    $get_by = 'email';
                } else {
                    $error = __( 'No user found for given email!', 'inspiry' );
                }
            } elseif ( validate_username ( $account ) ) {
                if ( username_exists ( $account ) ) {
                    $get_by = 'login';
                } else {
                    $error = __( 'No user found for given username!', 'inspiry' );
                }
            } else {
                $error = __( 'Invalid username or email!', 'inspiry' );
            }
        }

        if ( empty ( $error ) ) {

            // Generate new random password
            $random_password = wp_generate_password();

            // Get user data by field ( fields are id, slug, email or login )
            $target_user = get_user_by( $get_by, $account );

            $update_user = wp_update_user( array (
                'ID' => $target_user->ID,
                'user_pass' => $random_password
            ) );

            // if  update_user return true then send user an email containing the new password
            if ( $update_user ) {

                $from = get_option( 'admin_email' ); // Set whatever you want like mail@yourdomain.com

                if ( !isset( $from ) || !is_email( $from ) ) {
                    $site_name = strtolower( $_SERVER['SERVER_NAME'] );
                    if ( substr( $site_name, 0, 4 ) == 'www.' ) {
                        $site_name = substr( $site_name, 4 );
                    }
                    $from = 'admin@' . $site_name;
                }

                $to = $target_user->user_email;
                $website_name = get_bloginfo( 'name' );
                $subject = sprintf( __('Your New Password For %s', 'inspiry'), $website_name );
                $sender = sprintf( __( 'From: %s <%s>', 'inspiry' ), $website_name , $from ) . "\r\n";
                $message = sprintf( __( 'Your new password is: %s', 'inspiry' ), $random_password );

                // email header
                $header = 'Content-type: text/html; charset=utf-8' . "\r\n";
                $header = apply_filters ( "inspiry_password_reset_header", $header );
                $header .= $sender;

                $mail = wp_mail( $to, $subject, $message, $header );

                if ( $mail ) {
                    $success = __( 'Check your email for new password', 'inspiry' );
                } else {
                    $error = __( 'Failed to send you new password email!', 'inspiry' );
                }

            } else {
                $error = __( 'Oops! Something went wrong while resetting your password!', 'inspiry' );
            }
        }

        if( ! empty( $error ) ){
            echo json_encode(
                array (
                    'success' => false,
                    'message' => $error
                )
            );
        } elseif ( ! empty( $success ) ) {
            echo json_encode(
                array (
                    'success' => true,
                    'message' => $success
                )
            );
        }

        die();
    }

    // Enable the user with no privileges to request ajax password reset
    add_action( 'wp_ajax_nopriv_inspiry_ajax_forgot', 'inspiry_ajax_reset_password' );

endif;


if ( ! function_exists( 'inspiry_plugin_update_notice' ) ) :
/**
 * Displays a notice if an update is required for Inspiry Real Estate Plugin
 */
function inspiry_plugin_update_notice() {

    if ( ! function_exists( 'is_plugin_active' ) ) {
        include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
    }

    if ( is_plugin_active( 'inspiry-real-estate/inspiry-real-estate.php' ) ) {

        $required_version = '1.1.0';
        $inspiry_plugin_data = get_plugin_data( WP_PLUGIN_DIR . '/inspiry-real-estate/inspiry-real-estate.php' );
        $current_version = $inspiry_plugin_data['Version'];

        if ( $current_version != $required_version ) {
            add_action( 'admin_notices', function () use ( $current_version, $required_version ) {
                ?>
                <div class="update-nag notice is-dismissible">
                    <p><?php printf( __( 'You are using version %s of Inspiry Real Estate plugin, Required version is %s.', 'inspiry' ), $current_version, $required_version ); ?></p>
                    <p><em><?php _e( 'You can simply deactivate and remove it, After that follow the plugin installation notices to install the updated one included with in the theme.', 'inspiry' ); ?></em></p>
                    <p><?php _e( '* Make sure to save its settings after the installation.', 'inspiry' ); ?></p>
                </div>
                <?php
            } );

        }

    }

}

inspiry_plugin_update_notice();

endif;


if ( ! function_exists( 'inspiry_update_taxonomy_pagination' ) ) {
    /**
     * Update Taxonomy Pagination Based on Number of Properties Provided in Theme Options
     *
     * @param $query
     */
    function inspiry_update_taxonomy_pagination( $query ) {
        if ( is_tax( 'property-type' )
                || is_tax( 'property-status' )
                || is_tax( 'property-city' )
                || is_tax( 'property-feature' ) ) {
            global $inspiry_options;
            if ( $query->is_main_query() ) {
                $number_of_properties = intval( $inspiry_options[ 'inspiry_archive_properties_number' ] );
                if ( !$number_of_properties ) {
                    $number_of_properties = 6;
                }
                $query->set ( 'posts_per_page', $number_of_properties );
            }
        }
    }

    add_action( 'pre_get_posts', 'inspiry_update_taxonomy_pagination' );

}