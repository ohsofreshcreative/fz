<?php

/**
 * Theme setup.
 */

namespace App;

use Illuminate\Support\Facades\Vite;

/**
 * Inject styles into the block editor.
 *
 * @return array
 */
add_filter('block_editor_settings_all', function ($settings) {
	$style = Vite::asset('resources/css/editor.css');

	$settings['styles'][] = [
		'css' => "@import url('{$style}')",
	];

	return $settings;
});

/**
 * Inject scripts into the block editor.
 *
 * @return void
 */
add_filter('admin_head', function () {
	if (! get_current_screen()?->is_block_editor()) {
		return;
	}

	$dependencies = json_decode(Vite::content('editor.deps.json'));

	foreach ($dependencies as $dependency) {
		if (! wp_script_is($dependency)) {
			wp_enqueue_script($dependency);
		}
	}

	echo Vite::withEntryPoints([
		'resources/js/editor.js',
	])->toHtml();
});

/**
 * Use the generated theme.json file.
 *
 * @return string
 */
add_filter('theme_file_path', function ($path, $file) {
	return $file === 'theme.json'
		? public_path('build/assets/theme.json')
		: $path;
}, 10, 2);

/**
 * Register the initial theme setup.
 *
 * @return void
 */
add_action('after_setup_theme', function () {

	// Dodaj wsparcie dla WooCommerce
	add_theme_support('woocommerce');
	add_theme_support('wc-product-gallery-zoom');
	add_theme_support('wc-product-gallery-lightbox');
	add_theme_support('wc-product-gallery-slider');

	/**
	 * Disable full-site editing support.
	 *
	 * @link https://wptavern.com/gutenberg-10-5-embeds-pdfs-adds-verse-block-color-options-and-introduces-new-patterns
	 */
	remove_theme_support('block-templates');

	/**
	 * Register the navigation menus.
	 *
	 * @link https://developer.wordpress.org/reference/functions/register_nav_menus/
	 */
	register_nav_menus([
		'primary_navigation' => __('Primary Navigation', 'sage'),
	]);

	/**
	 * Disable the default block patterns.
	 *
	 * @link https://developer.wordpress.org/block-editor/developers/themes/theme-support/#disabling-the-default-block-patterns
	 */
	remove_theme_support('core-block-patterns');

	/**
	 * Enable plugins to manage the document title.
	 *
	 * @link https://developer.wordpress.org/reference/functions/add_theme_support/#title-tag
	 */
	add_theme_support('title-tag');

	/**
	 * Enable post thumbnail support.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support('post-thumbnails');

	/**
	 * Enable responsive embed support.
	 *
	 * @link https://developer.wordpress.org/block-editor/how-to-guides/themes/theme-support/#responsive-embedded-content
	 */
	add_theme_support('responsive-embeds');

	/**
	 * Enable HTML5 markup support.
	 *
	 * @link https://developer.wordpress.org/reference/functions/add_theme_support/#html5
	 */
	add_theme_support('html5', [
		'caption',
		'comment-form',
		'comment-list',
		'gallery',
		'search-form',
		'script',
		'style',
	]);

	/**
	 * Enable selective refresh for widgets in customizer.
	 *
	 * @link https://developer.wordpress.org/reference/functions/add_theme_support/#customize-selective-refresh-widgets
	 */
	add_theme_support('customize-selective-refresh-widgets');
}, 20);

/*--- WOOCOMMERCE PHP FILES ---*/

array_map(function ($file) {
  require_once $file;
}, array_merge(
  glob(get_theme_file_path('app/Woo/*.php')) ?: [],
  glob(get_theme_file_path('app/Woo/*/*.php')) ?: []
));


/**
 * Register the theme sidebars.
 *
 * @return void
 */
add_action('widgets_init', function () {
	$defaultConfig = [
		'before_widget' => '<section class="footer_widget widget %1$s %2$s">',
		'after_widget' => '</section>',
		'before_title' => '<h4 class="widget-title text-h5 text-p-lighter mb-4 flex">',
		'after_title' => '</h4>',
	];

	register_sidebar([
		'name' => __('Primary', 'sage'),
		'id' => 'sidebar-primary',
	] + $defaultConfig);

	register_sidebar([
		'name' => __('Footer 1', 'sage'),
		'id'   => 'sidebar-footer-1',
	] + $defaultConfig);

	register_sidebar([
		'name' => __('Footer 2', 'sage'),
		'id'   => 'sidebar-footer-2',
	] + $defaultConfig);

	register_sidebar([
		'name' => __('Footer 3', 'sage'),
		'id'   => 'sidebar-footer-3',
	] + $defaultConfig);

	register_sidebar([
		'name' => __('Footer 4', 'sage'),
		'id'   => 'sidebar-footer-4',
	] + $defaultConfig);
});


/*-- CLEAN TEXT PASTE ---*/

// Wymusza plain paste w ACF WYSIWYG (także w blokach ACF)
add_filter('acf/fields/wysiwyg/settings', function ($settings) {
    // tryb: wklejaj jako czysty tekst
    $settings['paste_as_text'] = true;

    // dopalacz dla TinyMCE (czyści style/spany itd.)
    $settings['tinymce'] = array_merge($settings['tinymce'] ?? [], [
        'paste_as_text' => true,
        'paste_auto_cleanup_on_paste' => true,
        'paste_remove_styles' => true,
        'paste_remove_spans' => true,
        'valid_elements' => '', // opcjonalnie: nie pozwalaj na żadne tagi
    ]);

    return $settings;
});

/////////////////////////
/////////////////////////
/*--- REGISTRATION ---*/
/////////////////////////
/////////////////////////


add_filter('woocommerce_product_data_tabs', function ($tabs) {
    $tabs['custom_options_tab'] = [
        'label' => 'Rejestracja',
        'target' => 'custom_options_product_data',
        'class' => ['show_if_simple', 'show_if_variable'],
        'priority' => 80,
    ];
    return $tabs;
});

add_action('woocommerce_product_data_panels', function () {
    echo '<div id="custom_options_product_data" class="panel woocommerce_options_panel">';
        echo '<div class="options_group group_wrapper">';
            echo '<div class="group_wrapper_title">Ustawienia pól rejestracji</div>';

            echo '<div class="collapsible-content">';
                woocommerce_wp_text_input([
                    'id' => '_custom_options_heading',
                    'label' => 'Nagłówek sekcji opcji',
                    'desc_tip' => true,
                    'description' => 'Wprowadź tekst, który pojawi się nad opcjami na stronie produktu.',
                    'wrapper_class' => 'form-field-wide',
                ]);

                woocommerce_wp_text_input([
                    'id' => '_custom_option_1_label',
                    'label' => 'Etykieta opcji 1',
                    'wrapper_class' => 'form-field-wide',
                ]);
                woocommerce_wp_text_input([
                    'id' => '_custom_option_1_price',
                    'label' => 'Cena opcji 1',
                    'data_type' => 'price',
                    'wrapper_class' => 'form-field-wide',
                ]);

                woocommerce_wp_text_input([
                    'id' => '_custom_option_2_label',
                    'label' => 'Etykieta opcji 2',
                    'wrapper_class' => 'form-field-wide',
                ]);
                woocommerce_wp_text_input([
                    'id' => '_custom_option_2_price',
                    'label' => 'Cena opcji 2',
                    'data_type' => 'price',
                    'wrapper_class' => 'form-field-wide',
                ]);
            echo '</div>';
        echo '</div>';
    echo '</div>';
});

add_action('woocommerce_process_product_meta', function ($post_id) {
    $fields = [
        '_custom_options_heading',
        '_custom_option_1_label',
        '_custom_option_1_price',
        '_custom_option_2_label',
        '_custom_option_2_price',
    ];

    foreach ($fields as $field) {
        if (isset($_POST[$field])) {
            $value = $_POST[$field];
            if (str_contains($field, '_price')) {
                $value = wc_format_decimal($value);
            } else {
                $value = sanitize_text_field($value);
            }
            update_post_meta($post_id, $field, $value);
        }
    }
});

add_action('woocommerce_before_add_to_cart_button', function () {
    global $product;
    if (!$product) return;

    $heading = get_post_meta($product->get_id(), '_custom_options_heading', true);
    $option1_label = get_post_meta($product->get_id(), '_custom_option_1_label', true);
    $option1_price = get_post_meta($product->get_id(), '_custom_option_1_price', true);
    $option2_label = get_post_meta($product->get_id(), '_custom_option_2_label', true);
    $option2_price = get_post_meta($product->get_id(), '_custom_option_2_price', true);

    if ((empty($option1_label) || $option1_price === '') && (empty($option2_label) || $option2_price === '')) {
        return;
    }

    echo '<div id="custom-product-options-wrapper" class="custom-product-options-wrapper" data-product-price="' . esc_attr($product->get_price()) . '">';

    if ($heading) {
        echo '<h3>' . esc_html($heading) . '</h3>';
    }

    echo '<div class="custom-options-container">';
    if ($option1_label && $option1_price !== '') {
        echo '<div class="custom-option">';
        echo '<input type="radio" id="custom_option_1" name="custom_product_option" value="' . esc_attr($option1_price) . '" checked>';
        echo '<label for="custom_option_1">' . esc_html($option1_label) . ' (+' . wc_price($option1_price) . ')</label>';
        echo '</div>';
    }

    if ($option2_label && $option2_price !== '') {
        echo '<div class="custom-option">';
        echo '<input type="radio" id="custom_option_2" name="custom_product_option" value="' . esc_attr($option2_price) . '">';
        echo '<label for="custom_option_2">' . esc_html($option2_label) . ' (+' . wc_price($option2_price) . ')</label>';
        echo '</div>';
    }
    echo '</div></div>';
});

add_action('admin_enqueue_scripts', function ($hook) {
    if ('post.php' !== $hook && 'post-new.php' !== $hook) {
        return;
    }
    if ('product' !== get_post_type()) {
        return;
    }
    wp_enqueue_script('sage/admin.js', asset('resources/js/admin.js')->uri(), ['jquery'], null, true);
    wp_enqueue_style('sage/admin.css', asset('resources/css/admin.scss')->uri(), false, null);
}, 100);