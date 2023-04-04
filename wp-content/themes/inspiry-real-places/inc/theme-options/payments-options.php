<?php
/*
 * Payments Options
 */
global $opt_name;
Redux::setSection( $opt_name, array(
    'title' => __( 'Payments', 'inspiry' ),
    'id'    => 'payments-section',
    'desc'  => __( 'This section contains options related to payments for submitted properties.', 'inspiry' ),
    'fields'=> array(

        array(
            'id'       => 'inspiry_payment_via_paypal',
            'type'     => 'switch',
            'title'    => __( 'PayPal Payments', 'inspiry' ),
            'subtitle' => __( 'Enable payment via PayPal ?', 'inspiry' ),
            'default'  => 1,
            'on'       => __( 'Enable', 'inspiry' ),
            'off'      => __( 'Disable', 'inspiry' ),
        ),
        array(
            'id'       => 'inspiry_paypal_ipn_url',
            'type'     => 'text',
            'title'    => __( 'PayPal IPN URL', 'inspiry' ),
            'subtitle' => __( 'It is a must', 'inspiry' ),
            'desc'     => __( 'Install "PayPal IPN for WordPress" plugin and get IPN URL from Settings > PayPal IPN.', 'inspiry' ),
            'validate' => 'url',
            'required' => array( 'inspiry_payment_via_paypal', '=', 1 ),
        ),
        array(
            'id'       => 'inspiry_paypal_merchant_id',
            'type'     => 'text',
            'title'    => __( 'PayPal Merchant Account ID or Email', 'inspiry' ),
            'required' => array( 'inspiry_payment_via_paypal', '=', 1 ),
        ),
        array(
            'id'       => 'inspiry_paypal_sandbox',
            'type'     => 'switch',
            'title'    => __( 'PayPal Sandbox', 'inspiry' ),
            'subtitle' => __( 'Enable PayPal sandbox for testing', 'inspiry' ),
            'default'  => 0,
            'on'       => __( 'Enable', 'inspiry' ),
            'off'      => __( 'Disable', 'inspiry' ),
            'required' => array( 'inspiry_payment_via_paypal', '=', 1 ),
        ),
        array(
            'id'       => 'inspiry_paypal_payment_amount',
            'type'     => 'text',
            'title'    => __( 'Payment Amount for a Property', 'inspiry' ),
            'desc'     => __( 'Provide the amount that you want to charge for a property. Example: 20.00', 'inspiry' ),
            'default'  => '20.00',
            'required' => array( 'inspiry_payment_via_paypal', '=', 1 ),
        ),
        array(
            'id'       => 'inspiry_paypal_currency_code',
            'type'     => 'text',
            'title'    => __( 'Currency Code', 'inspiry' ),
            'desc'     => __( 'Provide the currency code that you want to use. Example: USD', 'inspiry' ),
            'default'  => 'USD',
            'required' => array( 'inspiry_payment_via_paypal', '=', 1 ),
        ),
        array(
            'id'       => 'inspiry_publish_on_payment',
            'type'     => 'switch',
            'title'    => __( 'Auto Action on Successful Payment', 'inspiry' ),
            'default'  => 0,
            'on'       => __( 'Publish the Property', 'inspiry' ),
            'off'      => __( 'Do Nothing', 'inspiry' ),
            'required' => array( 'inspiry_payment_via_paypal', '=', 1 ),
        ),
        /*
         * Todo: Email for payment notification
        array(
            'id'       => 'inspiry_payment_notification_email',
            'type'     => 'text',
            'title'    => __( 'Email for Payment Notification', 'inspiry' ),
            'desc'     => __( 'Given email address will receive payment notifications.', 'inspiry' ),
            'required' => array( 'inspiry_payment_via_paypal', '=', 1 ),
            'validate' => 'email',
        ),
        */

    ) ) );