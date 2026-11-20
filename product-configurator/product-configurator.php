<?php
/**
 * Plugin Name:       Konfigurator Produktu
 * Description:       Dodaje opcje konfiguracji do produktów WooCommerce.
 * Version:           1.0.0
 * Author:            ohsofreshcreative
 * Author URI:        
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       product-configurator
 * Domain Path:       /languages
 */

if (!defined('WPINC')) {
    die;
}

define('PRODUCT_CONFIG_VERSION', '1.0.0');
define('PRODUCT_CONFIG_PATH', plugin_dir_path(__FILE__));
define('PRODUCT_CONFIG_URL', plugin_dir_url(__FILE__));

require_once PRODUCT_CONFIG_PATH . 'includes/class-admin.php';
require_once PRODUCT_CONFIG_PATH . 'includes/class-frontend.php';

function run_product_configurator() {
    new Product_Configurator_Admin();
    new Product_Configurator_Frontend();
}
add_action('plugins_loaded', 'run_product_configurator');