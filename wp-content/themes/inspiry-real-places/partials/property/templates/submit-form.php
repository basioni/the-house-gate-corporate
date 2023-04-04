<?php

global $inspiry_options;
?>
<form id="submit-property-form" class="submit-form" enctype="multipart/form-data" method="post">

    <div class="row">

        <div class="col-md-6">

            <div class="form-option">
                <label for="inspiry_property_title"><?php _e('Property Title', 'inspiry'); ?></label>
                <input id="inspiry_property_title" name="inspiry_property_title" type="text" class="required" title="<?php _e('* Please provide property title!', 'inspiry'); ?>" autofocus required/>
            </div>

            <div class="form-option">
                <label for="description"><?php _e('Property Description', 'inspiry'); ?></label>
                <textarea name="description" id="description" cols="30" rows="5"></textarea>
            </div>

        </div>

        <div class="col-md-6">

            <div class="form-option">
                <label for="address"><?php _e('Address', 'inspiry'); ?></label>
                <input type="text" class="required" name="address" id="address" value="<?php echo esc_attr( $inspiry_options[ 'inspiry_submit_address' ] ); ?>" title="<?php _e('* Please provide a property address!', 'inspiry'); ?>" required/>
                <div class="map-wrapper">
                    <button class="btn-default goto-address-button" type="button" value="address"><?php _e('Find Address', 'inspiry'); ?></button>
                    <div class="map-canvas"></div>
                    <input type="hidden" name="location" class="map-coordinate" value="<?php echo esc_attr( $inspiry_options[ 'inspiry_submit_location_coordinates' ] ); ?>"/>
                </div>
            </div>

        </div>

    </div>
    <!-- .row -->

    <div class="row">

        <div class="col-md-4">
            <div class="form-option">
                <label for="type"><?php _e('Type', 'inspiry'); ?></label>
                <select name="type" id="type" class="search-select">
                    <option selected="selected" value="-1"><?php _e('None', 'inspiry'); ?></option>
                    <?php
                    // Property type terms
                    $type_terms = get_terms( 'property-type', array(
                            'orderby' => 'name',
                            'order' => 'ASC',
                            'hide_empty' => false,
                            'parent' => 0,
                        )
                    );

                    inspiry_hierarchical_id_options( 'property-type', $type_terms, -1 );
                    ?>
                </select>
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-option">
                <label for="city"><?php _e('Location', 'inspiry'); ?></label>
                <select name="city" id="city" class="search-select">
                    <option selected="selected" value="-1"><?php _e('None', 'inspiry'); ?></option>
                    <?php
                    // Property location terms
                    $location_terms = get_terms( 'property-city', array(
                            'orderby' => 'name',
                            'order' => 'ASC',
                            'hide_empty' => false,
                            'parent' => 0,
                        )
                    );

                    inspiry_hierarchical_id_options( 'property-city', $location_terms, -1 );
                    ?>
                </select>
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-option">
                <label for="status"><?php _e('Status', 'inspiry'); ?></label>
                <select name="status" id="status" class="search-select">
                    <option selected="selected" value="-1"><?php _e('None', 'inspiry'); ?></option>
                    <?php
                    // Property status terms
                    $status_terms = get_terms( 'property-status', array(
                            'orderby' => 'name',
                            'order' => 'ASC',
                            'hide_empty' => false,
                            'parent' => 0,
                        )
                    );

                    inspiry_hierarchical_id_options( 'property-status', $status_terms, -1 );
                    ?>
                </select>
            </div>
        </div>

    </div>
    <!-- .row -->

    <div class="row">

        <div class="col-md-4">
            <div class="form-option">
                <label for="bedrooms"><?php _e('Bedrooms', 'inspiry'); ?></label>
                <input id="bedrooms" name="bedrooms" type="text" title="<?php _e('* Only numbers allowed!', 'inspiry'); ?>"/>
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-option">
                <label for="bathrooms"><?php _e('Bathrooms', 'inspiry'); ?></label>
                <input id="bathrooms" name="bathrooms" type="text" title="<?php _e('* Only numbers allowed!', 'inspiry'); ?>"/>
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-option">
                <label for="garages"><?php _e('Garages', 'inspiry'); ?></label>
                <input id="garages" name="garages" type="text" title="<?php _e('* Only numbers allowed!', 'inspiry'); ?>"/>
            </div>
        </div>

    </div>
    <!-- .row -->

    <div class="row">

        <div class="col-md-4">
            <div class="form-option">
                <label for="price"><?php _e('Sale OR Rent Price', 'inspiry'); ?></label>
                <input id="price" name="price" type="text" title="<?php _e('* Only numbers allowed!', 'inspiry'); ?>"/>
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-option">
                <label for="price-postfix"><?php _e('Price Postfix Text', 'inspiry'); ?></label>
                <input id="price-postfix" name="price-postfix" type="text"/>
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-option">
                <label for="size"><?php _e( 'Area', 'inspiry' ); ?></label>
                <input id="size" name="size" type="text" title="<?php _e('* Only numbers allowed!', 'inspiry'); ?>"/>
            </div>
        </div>

    </div>
    <!-- .row -->

    <div class="row">

        <div class="col-md-4">
            <div class="form-option">
                <label for="area-postfix"><?php _e('Area Postfix Text', 'inspiry'); ?></label>
                <input id="area-postfix" name="area-postfix" type="text" value="<?php _e('SqFt', 'inspiry'); ?>"/>
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-option">
                <label for="property-id"><?php _e('Property ID', 'inspiry'); ?></label>
                <input id="property-id" name="property-id" type="text" title="<?php _e('Property ID', 'inspiry'); ?>"/>
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-option">
                <label for="video-url"><?php _e('Virtual Tour Video URL', 'inspiry'); ?></label>
                <input id="video-url" name="video-url" type="text" />
            </div>
        </div>

    </div>
    <!-- .row -->


    <div class="row container-row">

        <div class="col-lg-6">
            <div class="form-option">
                <div id="gallery-thumbs-container" class="clearfix"></div>
                <div id="drag-and-drop">
                    <div class="drag-drop-msg text-center">
                        <i class="fa fa-cloud-upload"></i>&nbsp;&nbsp;<?php _e('Drag and drop images here', 'inspiry'); ?>
                        <br/>
                        <span class="drag-or"><?php _e('OR', 'inspiry'); ?></span>
                        <br/>
                        <a id="select-images" class="drag-btn btn-default btn-orange" href="javascript:;"><?php _e('Select Images', 'inspiry'); ?></a>
                    </div>
                </div>

                <ul class="field-description list-unstyled">
                    <li><span>*</span><?php _e('An image should have minimum width of 850px and minimum height of 600px.', 'inspiry'); ?></li>
                    <li><span>*</span><?php _e('You can mark an image as featured by clicking the star icon, Otherwise first image will be considered featured image.', 'inspiry'); ?></li>
                </ul>
                <div id="plupload-container"></div>
                <div id="errors-log"></div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="form-option">
                <label class="fancy-title"><?php _e('What to display in agent information box ?', 'inspiry'); ?></label>
                <ul class="agent-options list-unstyled">

                    <li>
                        <span class="radio-field">
                            <input id="agent_option_none" type="radio" name="agent_display_option" value="none" checked/>
                            <label for="agent_option_none"><?php _e('None', 'inspiry'); ?></label>
                        </span>
                        <small><?php _e('( No information will be displayed )', 'inspiry'); ?></small>
                    </li>

                    <li>
                        <span class="radio-field">
                            <input id="agent_option_profile" type="radio" name="agent_display_option" value="my_profile_info"/>
                            <label for="agent_option_profile"><?php _e('My Profile Information', 'inspiry'); ?></label>
                        </span>
                        <?php
                        if ( !empty( $inspiry_options[ 'inspiry_edit_profile_page' ] ) ) {
                            $edit_profile_url = get_permalink( $inspiry_options[ 'inspiry_edit_profile_page' ] );
                            if ( !empty( $edit_profile_url ) ) {
                                ?>
                                <small>
                                    <a href="<?php echo esc_url( $edit_profile_url ); ?>" target="_blank"><?php _e('( Edit Profile Information )', 'inspiry'); ?></a>
                                </small>
                                <?php
                            }
                        }
                        ?>
                    </li>

                    <li>
                        <span class="radio-field">
                            <input id="agent_option_agent" type="radio" name="agent_display_option" value="agent_info"/>
                            <label for="agent_option_agent"><?php _e( 'Display Agent Information', 'inspiry' ); ?></label>
                        </span>
                        <select name="agent_id" id="agent-selectbox">
                            <?php inspiry_generate_cpt_options( 'agent' ); ?>
                        </select>
                    </li>

                </ul>
            </div>

            <div class="form-option checkbox-option clearfix">
                <input id="featured" name="featured" type="checkbox"/>
                <label for="featured"><?php _e('Mark this property as featured property', 'inspiry'); ?></label>
            </div>
        </div>

    </div>
    <!-- .row -->


    <div class="row container-row">

        <div class="col-lg-6">
            <div class="form-option">
                <label class="fancy-title"><?php _e('Features', 'inspiry'); ?></label>
                <ul class="features-checkboxes-wrapper list-unstyled clearfix">
                    <?php
                    // Property features
                    $features_terms = get_terms( 'property-feature', array(
                            'orderby' => 'name',
                            'order' => 'ASC',
                            'hide_empty' => false,
                        )
                    );

                    if ( ! empty( $features_terms ) && ! is_wp_error( $features_terms ) ) {
                        foreach ( $features_terms as $feature ) {
                            echo '<li><span class="option-set">';
                            echo '<input type="checkbox" name="features[]" id="feature-'.$feature->term_id.'" value="'.$feature->term_id.'" />';
                            echo '<label for="feature-'.$feature->term_id.'">'.$feature->name.'</label>';
                            echo '</li>';
                        }
                    }
                    ?>
                </ul>
            </div>
        </div>

        <div class="col-lg-6">

            <div class="form-option">

                <div class="inspiry-details-wrapper">

                    <label><?php _e( 'Additional Details', 'inspiry' ); ?></label>

                    <div class="inspiry-detail labels clearfix">
                        <div class="inspiry-detail-control">&nbsp;</div>
                        <div class="inspiry-detail-title"><label><?php _e( 'Title','inspiry' ) ?></label></div>
                        <div class="inspiry-detail-value"><label><?php _e( 'Value','inspiry' ); ?></label></div>
                        <div class="inspiry-detail-control">&nbsp;</div>
                    </div>

                    <!-- additional details container -->
                    <div id="inspiry-additional-details-container">
                        <div class="inspiry-detail inputs clearfix">
                            <div class="inspiry-detail-control">
                                <i class="sort-detail fa fa-bars"></i>
                            </div>
                            <div class="inspiry-detail-title">
                                <input type="text" name="detail-titles[]" value="" />
                            </div>
                            <div class="inspiry-detail-value">
                                <input type="text" name="detail-values[]" value="" />
                            </div>
                            <div class="inspiry-detail-control">
                                <a class="remove-detail" href="#"><i class="fa fa-times"></i></a>
                            </div>
                        </div>
                    </div><!-- end of additional details container -->

                    <div class="inspiry-detail clearfix">
                        <div class="inspiry-detail-control">&nbsp;</div>
                        <div class="inspiry-detail-control">
                            <a class="add-detail" href="#"><i class="fa fa-plus"></i></a>
                        </div>
                    </div>

                </div>

            </div>

        </div>

    </div>
    <!-- .row -->

    <div class="row container-row">

        <div class="col-xs-12">

            <?php
            $submit_notice_email = is_email( $inspiry_options[ 'inspiry_submit_notice_email' ] );
            $message_for_reviewer = $inspiry_options[ 'inspiry_submit_message_to_reviewer' ];
            if ( !empty( $submit_notice_email ) && $message_for_reviewer ) {
                ?>
                <div class="form-option">
                    <label for="message_to_reviewer"><?php _e('Message to the Reviewer','inspiry'); ?></label>
                    <textarea name="message_to_reviewer" id="message_to_reviewer" cols="30" rows="3"></textarea>
                </div>
                <?php
            }
            ?>

            <div class="form-option">
                <?php wp_nonce_field( 'submit_property', 'property_nonce' ); ?>
                <input type="hidden" name="action" value="add_property"/>
                <input type="submit" value="<?php _e('Submit Property', 'inspiry'); ?>" class="btn-small btn-orange"/>
            </div>

            <div id="message-container"></div>

        </div>
    </div>
    <!-- .row -->

</form>

