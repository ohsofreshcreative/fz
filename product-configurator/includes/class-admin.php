<?php

class Product_Configurator_Admin {

    public function __construct() {
        add_action('admin_enqueue_scripts', [$this, 'enqueue_admin_styles']);
        add_filter('woocommerce_product_data_tabs', [$this, 'add_product_data_tab']);
        add_action('woocommerce_product_data_panels', [$this, 'add_product_data_panel_content']);
        add_action('woocommerce_process_product_meta', [$this, 'save_product_meta']);
        add_action('admin_footer-post.php', [$this, 'add_admin_scripts']);
        add_action('admin_footer-post-new.php', [$this, 'add_admin_scripts']);
    }

    public function enqueue_admin_styles($hook) {
        global $post_type;
        if (('post.php' == $hook || 'post-new.php' == $hook) && 'product' === $post_type) {
            wp_enqueue_style('product-configurator-admin-style', PRODUCT_CONFIG_URL . 'assets/css/product-configurator-admin.css', [], PRODUCT_CONFIG_VERSION);
        }
    }

    public function add_product_data_tab($tabs) {
        $tabs['product_configurator'] = [
            'label'    => __('Konfigurator', 'product-configurator'),
            'target'   => 'product_configurator_data',
            'class'    => ['show_if_simple', 'show_if_variable'],
            'priority' => 100,
        ];
        return $tabs;
    }

    public function add_product_data_panel_content() {
        global $post;
        echo '<div id="product_configurator_data" class="panel woocommerce_options_panel">';

            echo '<div class="wc-metabox closed">';
            echo '<h3 class="wc-metabox-handle"><span>' . __('Opcja rejestracji', 'product-configurator') . '</span><div class="wc-metabox-handle-content-toggle"></div></h3>';
            echo '<div class="wc-metabox-content" style="display: none;">';
                woocommerce_wp_text_input(['id' => '_registration_header', 'label' => __('Nagłówek sekcji', 'product-configurator'), 'value' => get_post_meta($post->ID, '_registration_header', true)]);
                echo '<div class="options_group">';
                    echo '<h4>' . __('Opcja 1 (stała)', 'product-configurator') . '</h4>';
                    woocommerce_wp_text_input(['id' => '_registration_option1_label', 'label' => __('Etykieta', 'product-configurator'), 'value' => get_post_meta($post->ID, '_registration_option1_label', true)]);
                    woocommerce_wp_text_input(['id' => '_registration_option1_price', 'label' => __('Cena', 'product-configurator'), 'data_type' => 'price', 'value' => get_post_meta($post->ID, '_registration_option1_price', true)]);
                echo '</div>';
                echo '<div class="options_group">';
                    echo '<h4>' . __('Opcja 2 (stała)', 'product-configurator') . '</h4>';
                    woocommerce_wp_text_input(['id' => '_registration_option2_label', 'label' => __('Etykieta', 'product-configurator'), 'value' => get_post_meta($post->ID, '_registration_option2_label', true)]);
                    woocommerce_wp_text_input(['id' => '_registration_option2_price', 'label' => __('Cena', 'product-configurator'), 'data_type' => 'price', 'value' => get_post_meta($post->ID, '_registration_option2_price', true)]);
                echo '</div>';
            echo '</div></div>';

            echo '<div class="wc-metabox closed">';
            echo '<h3 class="wc-metabox-handle"><span>' . __('Pozostałe stawki', 'product-configurator') . '</span><div class="wc-metabox-handle-content-toggle"></div></h3>';
            echo '<div class="wc-metabox-content" style="display: none;">';
                woocommerce_wp_text_input(['id' => '_accommodation_header', 'label' => __('Nagłówek sekcji', 'product-configurator'), 'value' => get_post_meta($post->ID, '_accommodation_header', true)]);
                echo '<div class="options_group">';
                    echo '<h4>' . __('Opcja 1 (stała)', 'product-configurator') . '</h4>';
                    woocommerce_wp_text_input(['id' => '_accommodation_option1_label', 'label' => __('Etykieta', 'product-configurator'), 'value' => get_post_meta($post->ID, '_accommodation_option1_label', true)]);
                    woocommerce_wp_text_input(['id' => '_accommodation_option1_price', 'label' => __('Cena', 'product-configurator'), 'data_type' => 'price', 'value' => get_post_meta($post->ID, '_accommodation_option1_price', true)]);
                echo '</div>';
                echo '<div class="options_group">';
                    echo '<h4>' . __('Opcja 2 (stała)', 'product-configurator') . '</h4>';
                    woocommerce_wp_text_input(['id' => '_accommodation_option2_label', 'label' => __('Etykieta', 'product-configurator'), 'value' => get_post_meta($post->ID, '_accommodation_option2_label', true)]);
                    woocommerce_wp_text_input(['id' => '_accommodation_option2_price', 'label' => __('Cena', 'product-configurator'), 'data_type' => 'price', 'value' => get_post_meta($post->ID, '_accommodation_option2_price', true)]);
                echo '</div>';

                echo '<div id="accommodation_repeater_container">';
                $extra_options = get_post_meta($post->ID, '_accommodation_extra_options', true);
                if (!empty($extra_options)) {
                    foreach ($extra_options as $index => $option) {
                        echo '<div class="options_group repeater_item">';
                        echo '<h4>Opcja dodatkowa <button type="button" class="button button-small remove_repeater_item">Usuń</button></h4>';
                        echo '<p class="form-field"><label>Etykieta</label><input type="text" name="_accommodation_extra_options[' . $index . '][label]" value="' . esc_attr($option['label']) . '"></p>';
                        echo '<p class="form-field"><label>Cena</label><input type="text" class="wc_input_price" name="_accommodation_extra_options[' . $index . '][price]" value="' . esc_attr($option['price']) . '"></p>';
                        echo '</div>';
                    }
                }
                echo '</div>';
                echo '<button type="button" class="button button-primary" id="add_accommodation_option">Dodaj kolejną opcję</button>';
            echo '</div></div>';

        echo '</div>';
    }

    public function save_product_meta($post_id) {
        $fields_to_save = [
            '_registration_header', '_registration_option1_label', '_registration_option2_label',
            '_accommodation_header', '_accommodation_option1_label', '_accommodation_option2_label',
            '_registration_option1_price', '_registration_option2_price',
            '_accommodation_option1_price', '_accommodation_option2_price'
        ];
        foreach ($fields_to_save as $field) {
            if (isset($_POST[$field])) {
                $value = strpos($field, '_price') !== false ? wc_format_decimal($_POST[$field]) : sanitize_text_field($_POST[$field]);
                update_post_meta($post_id, $field, $value);
            }
        }

        $extra_options = [];
        if (isset($_POST['_accommodation_extra_options']) && is_array($_POST['_accommodation_extra_options'])) {
            foreach ($_POST['_accommodation_extra_options'] as $option) {
                if (!empty($option['label'])) {
                    $extra_options[] = [
                        'label' => sanitize_text_field($option['label']),
                        'price' => wc_format_decimal($option['price']),
                    ];
                }
            }
        }
        update_post_meta($post_id, '_accommodation_extra_options', $extra_options);
    }

    public function add_admin_scripts() {
        global $post_type;
        if ('product' !== $post_type) return;
        ?>
        <script type="text/javascript">
            jQuery(document).ready(function($) {
                $('#product_configurator_data').on('click', '.wc-metabox-handle', function(e) {
                    e.stopImmediatePropagation();
                    const metabox = $(this).closest('.wc-metabox');
                    metabox.find('.wc-metabox-content').slideToggle(200);
                    metabox.find('.wc-metabox-handle-content-toggle').toggleClass('open');
                    metabox.toggleClass('closed');
                });

                $('#add_accommodation_option').on('click', function() {
                    const container = $('#accommodation_repeater_container');
                    const index = container.find('.repeater_item').length;
                    const newItem = `
                        <div class="options_group repeater_item">
                            <h4>Opcja dodatkowa <button type="button" class="button button-small remove_repeater_item">Usuń</button></h4>
                            <p class="form-field"><label>Etykieta</label><input type="text" name="_accommodation_extra_options[${index}][label]" value=""></p>
                            <p class="form-field"><label>Cena</label><input type="text" class="wc_input_price" name="_accommodation_extra_options[${index}][price]" value=""></p>
                        </div>`;
                    container.append(newItem);
                });

                $('#accommodation_repeater_container').on('click', '.remove_repeater_item', function() {
                    $(this).closest('.repeater_item').remove();
                });
            });
        </script>
        <?php
    }
}