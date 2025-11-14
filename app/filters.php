<?php

/**
 * Theme filters.
 */

namespace App;

/**
 * Add "… Continued" to the excerpt.
 *
 * @return string
 */
add_filter('excerpt_more', function () {
    return sprintf(' &hellip; <a href="%s">%s</a>', get_permalink(), __('Continued', 'sage'));
});

/*--- CHANGE ADD TO CART TITLE ---*/

add_filter('woocommerce_product_single_add_to_cart_text', function () {
    return __('Zarejestruj się', 'sage');
});

/*--- CHANGE CHECKOUT TITLE ---*/

add_filter('woocommerce_checkout_fields', function ($fields) {
    if (isset($fields['billing']['billing_first_name'])) {
        $fields['billing']['billing_first_name']['label'] = 'Imię';
    }
    return $fields;
});

add_filter('gettext', function ($translated_text, $text, $domain) {
    if (is_checkout() && $domain === 'woocommerce' && $text === 'Billing details') {
        $translated_text = 'Zarejestruj się';
    }
    return $translated_text;
}, 20, 3);

/*--- CHANGE BUY BUTTON TEXT ---*/

add_filter('woocommerce_order_button_text', function () {
    return __('Zarejestruj się', 'sage');
});

/*--- CHANGE FORM FIELD ARGUMENTS ---*/

add_filter('woocommerce_form_field_args', function ($args, $key, $value) {
    // Remove "(optional)" text from the label
    $args['label_class'][] = 'sans-optional';
    return $args;
}, 10, 3);

/*--- ADD BEFORE PRODUCT TITLE ---*/

add_action('init', function () {
    remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_title', 5);

    add_action('woocommerce_single_product_summary', function () {
        $custom_text = 'Rejestracja: '; // <-- Zmień ten tekst na dowolny
        echo '<h1 class="product_title entry-title">' . esc_html($custom_text) . get_the_title() . '</h1>';
    }, 5);
});