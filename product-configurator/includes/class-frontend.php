<?php

class Product_Configurator_Frontend {
    
    public function __construct() {
        add_action('wp_enqueue_scripts', [$this, 'enqueue_scripts']);
        add_action('woocommerce_before_add_to_cart_button', [$this, 'display_options']);
        add_filter('woocommerce_add_cart_item_data', [$this, 'add_custom_data_to_cart_item'], 10, 3);
        add_action('woocommerce_before_calculate_totals', [$this, 'update_cart_price']);
        add_filter('woocommerce_get_item_data', [$this, 'display_custom_data_in_cart'], 10, 2);
        add_action('woocommerce_checkout_create_order_line_item', [$this, 'add_custom_data_to_order_item'], 10, 4);
        add_filter('woocommerce_hidden_order_itemmeta', [$this, 'hide_export_item_meta']);
    }

    public function enqueue_scripts() {
        if (is_product()) {
            global $product;
            wp_enqueue_style('product-configurator-style', PRODUCT_CONFIG_URL . 'assets/css/product-configurator-style.css', [], PRODUCT_CONFIG_VERSION);
            wp_register_script('product-configurator-front', PRODUCT_CONFIG_URL . 'assets/js/product-configurator-front.js', [], PRODUCT_CONFIG_VERSION, true);
            
            $product_data = [
                'currencySymbol' => get_woocommerce_currency_symbol(),
                'productName'    => $product->get_name(),
                'basePrice'      => $product->get_price(),
            ];

            wp_localize_script('product-configurator-front', 'productOptions', $product_data);
            wp_enqueue_script('product-configurator-front');
        }
    }

    private function render_option_group($prefix, $product_id) {
        $header = get_post_meta($product_id, "_{$prefix}_header", true);
        
        $fixed_options = [];
        for ($i = 1; $i <= 2; $i++) {
            $label = get_post_meta($product_id, "_{$prefix}_option{$i}_label", true);
            if (!empty($label)) {
                $fixed_options["option{$i}"] = [
                    'label' => $label,
                    'price' => get_post_meta($product_id, "_{$prefix}_option{$i}_price", true),
                ];
            }
        }
        
        $extra_options = [];
        if ($prefix === 'accommodation') {
            $extra_options = get_post_meta($product_id, '_accommodation_extra_options', true);
        }

        if (empty($fixed_options) && empty($extra_options)) return;

        echo '<div class="registration-options-wrapper">';
        if (!empty($header)) {
            echo '<h3>' . esc_html($header) . '</h3>';
        }
        echo '<div class="registration-options">';
        
        if($prefix === 'accommodation') echo '<div id="fixed-accommodation-options" class="options-group-content">';

        foreach ($fixed_options as $key => $option) {
            $input_id = esc_attr("{$prefix}_{$key}");
            echo '<p>';
            echo '<input type="radio" id="' . $input_id . '" name="' . esc_attr($prefix) . '_option" value="' . esc_attr($key) . '" data-price="' . esc_attr($option['price']) . '">';
            echo '<label for="' . $input_id . '">' . esc_html($option['label']) . '<span class="price">' . wp_kses_post(wc_price($option['price'])) . '</span></label>';
            echo '</p>';
            
            if ($prefix === 'accommodation' && $key === 'option1') {
                echo '<div id="roommate-field-wrapper" style="display:none;"><label for="roommate_name">Z kim chcesz zostać zakwaterowana/y?</label><input type="text" id="roommate_name" name="roommate_name"></div>';
            }
        }

        if($prefix === 'accommodation') {
            echo '</div>';
        }

        if (!empty($extra_options)) {
             echo '<div class="options-group-content">';
            foreach ($extra_options as $index => $option) {
                $input_id = esc_attr("accommodation_extra_{$index}");
                echo '<p>';
                echo '<input type="checkbox" id="' . $input_id . '" name="accommodation_extra_options[]" value="' . esc_attr($index) . '" data-price="' . esc_attr($option['price']) . '">';
                echo '<label for="' . $input_id . '">' . esc_html($option['label']) . '<span class="price">' . wp_kses_post(wc_price($option['price'])) . '</span></label>';
                echo '</p>';
            }
            echo '</div>';
        }

        echo '</div></div>';
    }

    public function display_options() {
        static $has_run = false;
        if ($has_run) return;
        
        global $product;
        if (!$product) return;

        echo '<div class="product-configurator-container">';
        echo '<div class="product-configurator-main">';
        $this->render_option_group('registration', $product->get_id());
        $this->render_option_group('accommodation', $product->get_id());
        echo '</div>';
        
        echo '<aside class="product-configurator-summary">';
        echo '<h3>Podsumowanie</h3>';
        echo '<ul id="configurator-summary-items"></ul>';
        echo '<div class="summary-total">';
        echo '<span>Łącznie:</span>';
        echo '<span id="configurator-summary-total"></span>';
        echo '</div>';
        echo '</aside>';
        echo '</div>';

        $has_run = true;
    }
    
    public function add_custom_data_to_cart_item($cart_item_data, $product_id, $variation_id) {
        $product = wc_get_product($product_id);
        $cart_item_data['configurator_base_price'] = $product->get_price();

        $cart_item_data['custom_fees'] = [];

        if (isset($_POST["registration_option"])) {
            $registration_choice = sanitize_text_field($_POST["registration_option"]);
            $label = get_post_meta($product_id, "_registration_{$registration_choice}_label", true);
            $price = get_post_meta($product_id, "_registration_{$registration_choice}_price", true);
            if (!empty($label)) {
                $cart_item_data['custom_fees'][] = ['label' => $label, 'price' => $price, 'type' => 'registration'];
            }

            if ($registration_choice === 'option2' && isset($_POST["accommodation_option"])) {
                $accommodation_choice = sanitize_text_field($_POST["accommodation_option"]);
                $label = get_post_meta($product_id, "_accommodation_{$accommodation_choice}_label", true);
                $price = get_post_meta($product_id, "_accommodation_{$accommodation_choice}_price", true);
                if (!empty($label)) {
                    $cart_item_data['custom_fees'][] = ['label' => $label, 'price' => $price, 'type' => 'accommodation'];
                }
            }
        }
        
        if (isset($_POST['accommodation_extra_options']) && is_array($_POST['accommodation_extra_options'])) {
            $extra_options_all = get_post_meta($product_id, '_accommodation_extra_options', true);
            foreach ($_POST['accommodation_extra_options'] as $checked_index) {
                $index = (int) $checked_index;
                if (isset($extra_options_all[$index])) {
                    $option = $extra_options_all[$index];
                    if (!empty($option['label'])) {
                        $option['type'] = 'extra';
                        $cart_item_data['custom_fees'][] = $option;
                    }
                }
            }
        }

        if (isset($_POST['roommate_name']) && !empty(trim($_POST['roommate_name']))) {
            $cart_item_data['roommate_name'] = sanitize_text_field(trim($_POST['roommate_name']));
        }
        
        return $cart_item_data;
    }

    public function update_cart_price($cart) {
        if (is_admin() && !defined('DOING_AJAX')) return;

        foreach ($cart->get_cart() as $cart_item) {
            if (isset($cart_item['configurator_base_price'])) {
                $base_price = (float) $cart_item['configurator_base_price'];
                $total_fee = 0;

                if (!empty($cart_item['custom_fees'])) {
                    $total_fee = array_sum(wp_list_pluck($cart_item['custom_fees'], 'price'));
                }

                $cart_item['data']->set_price($base_price + $total_fee);
            }
        }
    }

    public function display_custom_data_in_cart($item_data, $cart_item) {
        if (!empty($cart_item['custom_fees'])) {
            foreach ($cart_item['custom_fees'] as $fee) {
                 if (!empty($fee['label'])) {
                    $display_value = $fee['price'] > 0 ? wc_price($fee['price']) : '';
                    $item_data[] = ['key' => $fee['label'], 'value' => $display_value];
                 }
            }
        }
        if (isset($cart_item['roommate_name'])) {
            $item_data[] = [
                'key'     => __('Zakwaterowanie z', 'product-configurator'),
                'value'   => $cart_item['roommate_name'],
            ];
        }
        return $item_data;
    }

    public function add_custom_data_to_order_item($item, $cart_item_key, $values, $order) {
        $export = [
            '_opcja_rejestracji'    => '',
            '_opcja_zakwaterowania' => '',
            '_opcje_dodatkowe'      => [],
        ];

        if (!empty($values['custom_fees'])) {
            foreach ($values['custom_fees'] as $fee) {
                 if (!empty($fee['label'])) {
                    $display_value = $fee['price'] > 0 ? wc_price($fee['price']) : '';
                    $item->add_meta_data($fee['label'], $display_value);

                    $type = isset($fee['type']) ? $fee['type'] : 'extra';
                    if ($type === 'registration') {
                        $export['_opcja_rejestracji'] = $fee['label'];
                    } elseif ($type === 'accommodation') {
                        $export['_opcja_zakwaterowania'] = $fee['label'];
                    } else {
                        $export['_opcje_dodatkowe'][] = $fee['label'];
                    }
                 }
            }
        }
        if (isset($values['roommate_name'])) {
            $item->add_meta_data(__('Zakwaterowanie z', 'product-configurator'), $values['roommate_name']);
        }

        // Stałe klucze meta (ukryte w panelu) na potrzeby eksportu zamówień.
        $item->add_meta_data('_opcja_rejestracji', $export['_opcja_rejestracji'], true);
        $item->add_meta_data('_opcja_zakwaterowania', $export['_opcja_zakwaterowania'], true);
        $item->add_meta_data('_opcje_dodatkowe', implode(', ', $export['_opcje_dodatkowe']), true);
        $item->add_meta_data('zakwaterowanie_z', isset($values['roommate_name']) ? $values['roommate_name'] : '', true);
    }

    public function hide_export_item_meta($hidden) {
        return array_merge($hidden, ['_opcja_rejestracji', '_opcja_zakwaterowania', '_opcje_dodatkowe', 'zakwaterowanie_z']);
    }
}