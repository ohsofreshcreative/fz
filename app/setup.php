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


/*-- HIDE QUANTITY ---*/

add_filter('woocommerce_is_sold_individually', '__return_true');

add_filter('woocommerce_quantity_input_type', function ($type) {
    if (is_singular('product')) {
        return 'hidden';
    }
    return $type;
}, 10, 1);

add_filter('woocommerce_quantity_input_args', function ($args, $product) {
    if (is_singular('product')) {
        $args['input_value'] = 1;
        $args['min_value'] = 1;
        $args['max_value'] = 1;
    }
    return $args;
}, 10, 2);

add_filter('woocommerce_cart_item_quantity', function ($product_quantity) {
    return '';
}, 10, 1);

add_filter('woocommerce_add_to_cart_validation', function ($passed, $product_id, $quantity) {
    $cart_id = WC()->cart->generate_cart_id($product_id);
    if (WC()->cart->find_product_in_cart($cart_id)) {
        wc_add_notice(__('Możesz posiadać tylko jedną sztukę tego produktu w koszyku.'), 'error');
        return false;
    }
    return $passed;
}, 10, 3);


/*--- CART BEHAVIOR ---*/

add_filter('woocommerce_add_to_cart_redirect', function () {
    return wc_get_checkout_url();
});

add_filter('woocommerce_add_to_cart_validation', function ($passed) {
    if (! WC()->cart->is_empty()) {
        WC()->cart->empty_cart();
    }
    return $passed;
});

/*
|--------------------------------------------------------------------------
| WooCommerce Checkout Customizations
|--------------------------------------------------------------------------
*/

/**
 * 1. Dodanie niestandardowych pól dla uczestnika (jako pierwsza sekcja).
 */
add_action('woocommerce_before_checkout_billing_form', function ($checkout) {
    echo '<div id="participant_details_wrapper" class="mb-8">';
    echo '<h5 class="text-white -mt-4">Dane uczestnika</h5>';

    echo '<div id="participant_fields">';

    woocommerce_form_field('participant_name', [
        'type' => 'text', 'class' => ['form-row-first'], 'label' => __('Imię'), 'required' => true,
    ], $checkout->get_value('participant_name'));

    woocommerce_form_field('participant_surname', [
        'type' => 'text', 'class' => ['form-row-last'], 'label' => __('Nazwisko'), 'required' => true,
    ], $checkout->get_value('participant_surname'));

    woocommerce_form_field('participant_address', [
        'type' => 'text', 'class' => ['form-row-wide'], 'label' => __('Ulica'), 'required' => true,
    ], $checkout->get_value('participant_address'));
    
    woocommerce_form_field('participant_postcode', [
        'type' => 'text', 'class' => ['form-row-first'], 'label' => __('Kod pocztowy'), 'required' => true,
        'custom_attributes' => ['pattern' => '^\d{2}-\d{3}$', 'oninput' => "this.value = this.value.replace(/[^0-9-]/g, '').replace(/(\d{2})(\d{3})/, '$1-$2').substring(0, 6)", 'maxlength' => 6, 'placeholder' => 'XX-XXX'],
    ], $checkout->get_value('participant_postcode'));

    woocommerce_form_field('participant_city', [
        'type' => 'text', 'class' => ['form-row-last'], 'label' => __('Miejscowość'), 'required' => true,
    ], $checkout->get_value('participant_city'));

    woocommerce_form_field('participant_phone', [
        'type' => 'tel', 'class' => ['form-row-wide'], 'label' => __('Numer telefonu'), 'required' => true,
        'custom_attributes' => ['pattern' => '^\d{9}$', 'oninput' => "this.value = this.value.replace(/[^0-9]/g, '').substring(0, 9)", 'maxlength' => 9],
    ], $checkout->get_value('participant_phone'));

    woocommerce_form_field('participant_mail', [
        'type' => 'email', 'class' => ['form-row-wide'], 'label' => __('Email'), 'required' => true, 'placeholder' => __('na ten adres zostanie przesłany certyfikat'), 'validate' => ['email'],
    ], $checkout->get_value('participant_mail'));

    woocommerce_form_field('participant_stanowisko', [
        'type' => 'text', 'class' => ['form-row-wide'], 'label' => __('Stanowisko'), 'required' => true,
    ], $checkout->get_value('participant_stanowisko'));

    woocommerce_form_field('participant_recepty', [
        'type' => 'select', 'class' => ['form-row-wide'], 'label' => __('Uprawnienia do wystawiania recept'), 'required' => true,
        'options' => ['' => __('Wybierz opcję...'), 'tak' => __('Tak'), 'nie' => __('Nie')],
    ], $checkout->get_value('participant_recepty'));

    woocommerce_form_field('participant_option_one', [
        'type' => 'select', 'class' => ['form-row-wide'], 'label' => __('Czy posiadasz nr prawa wykonywania zawodu?'), 'required' => true,
        'options' => ['' => __('Wybierz opcję...'), 'yes' => __('Tak'), 'no' => __('Nie')],
    ], $checkout->get_value('participant_option_one'));
    
    // Dodajemy klasę .hidden do tego pola, aby JS mógł je pokazać/ukryć
    woocommerce_form_field('participant_option_two', [
        'type' => 'text', 'class' => ['form-row-wide', 'hidden'], 'label' => __('Nr prawa wykonywania zawodu'), 'required' => false,
    ], $checkout->get_value('participant_option_two'));
    
    echo '</div>'; // #participant_fields
    echo '</div>'; // #participant_details_wrapper
}, 5); // Priorytet 5, aby wykonało się jako pierwsze

/**
 * 2. Dodanie przycisków wyboru typu klienta i nagłówka do faktury.
 */
add_action('woocommerce_before_checkout_billing_form', function ($checkout) {
    echo '<div id="customer-type-buttons" class="mb-4">';
    echo '<button type="button" id="individual-btn" class="button">Chcę dostać fakturę imienną</button>';
    echo '<button type="button" id="business-btn" class="button">Chcę dostać fakturę VAT</button>';
    echo '</div>';
    
    echo '<div id="billing_details_header_wrapper">';
    echo '<h5 id="billing_details_header" class="text-white mt-10">Dane do faktury</h5>';
    echo '</div>';
}, 15); // Priorytet 15, aby wykonało się po polach uczestnika, ale przed polami billingowymi

/**
 * Modyfikacja pól rozliczeniowych WooCommerce (działa tak jak wcześniej).
 */
add_filter('woocommerce_billing_fields', function ($fields) {
    if (isset($fields['billing_postcode'])) {
        $fields['billing_postcode']['class'] = array_diff($fields['billing_postcode']['class'], array('form-row-wide'));
        $fields['billing_postcode']['class'][] = 'form-row-first';
        $fields['billing_postcode']['custom_attributes'] = [
            'pattern' => '^\d{2}-\d{3}$',
            'oninput' => "this.value = this.value.replace(/[^0-9-]/g, '').replace(/(\d{2})(\d{3})/, '$1-$2').substring(0, 6)",
            'maxlength' => 6,
        ];
    }

    if (isset($fields['billing_city'])) {
        $fields['billing_city']['class'] = array_diff($fields['billing_city']['class'], array('form-row-wide'));
        $fields['billing_city']['class'][] = 'form-row-last';
    }
    
    if (isset($fields['billing_phone'])) {
        $fields['billing_phone']['custom_attributes'] = [
            'pattern' => '^\d{9}$',
            'oninput' => "this.value = this.value.replace(/[^0-9]/g, '').substring(0, 9)",
            'maxlength' => 9,
        ];
    }

    if (isset($fields['billing_company'])) {
        $fields['billing_company']['label'] = 'Nazwa firmy/instytucji';
        $fields['billing_company']['class'][] = 'hidden';
    }

    if (isset($fields['billing_vat_id'])) {
        $fields['billing_vat_id']['label'] = 'NIP';
        $fields['billing_vat_id']['class'][] = 'hidden';
    }

    return $fields;
});

/**
 * Zapisywanie niestandardowych pól do meta zamówienia (bez zmian).
 */
add_action('woocommerce_checkout_create_order', function ($order) {
    $posted_data = $_POST;

    $billing_type = !empty($posted_data['billing_company']) ? 'Firma' : 'Osoba prywatna';
    $order->update_meta_data('Typ faktury', $billing_type);

    $fields_to_save = [
        'participant_name' => 'Imię uczestnika',
        'participant_surname' => 'Nazwisko uczestnika',
        'participant_address' => 'Adres uczestnika',
        'participant_postcode' => 'Kod pocztowy uczestnika',
        'participant_city' => 'Miejscowość uczestnika',
        'participant_phone' => 'Numer telefonu uczestnika',
        'participant_mail' => 'E-mail uczestnika (do certyfikatu)',
        'participant_stanowisko' => 'Stanowisko uczestnika',
        'participant_recepty' => 'Uprawnienia do wystawiania recept',
        'participant_option_one' => 'Czy posiadasz nr prawa wykonywania zawodu?',
        'participant_option_two' => 'Nr prawa wykonywania zawodu',
    ];

    foreach ($fields_to_save as $key => $label) {
        if (!empty($posted_data[$key])) {
            $order->update_meta_data($label, sanitize_text_field($posted_data[$key]));
        }
    }
});

/*--- Walidacja niestandardowych pól uczestnika ---*/

add_filter('woocommerce_checkout_fields', function ($fields) {
    if (isset($fields['billing']['billing_first_name'])) {
        $fields['billing']['billing_first_name']['required'] = false;
    }
    if (isset($fields['billing']['billing_last_name'])) {
        $fields['billing']['billing_last_name']['required'] = false;
    }
    return $fields;
});

add_action('woocommerce_checkout_process', function () {
    $is_business = isset($_POST['billing_is_business']) && $_POST['billing_is_business'] === 'yes';

    if (function_exists('wc_clear_notices')) {
        $all_notices = wc_get_notices('error');
        $notices_to_keep = [];

        foreach ($all_notices as $notice) {
            $message = is_array($notice) ? $notice['notice'] : $notice;
            if (strpos($message, 'rozliczeniowy') === false) {
                $notices_to_keep[] = $notice;
            }
        }

        wc_clear_notices();
        foreach ($notices_to_keep as $notice) {
            wc_add_notice(is_array($notice) ? $notice['notice'] : $notice, 'error');
        }
    }

    if ($is_business) {
        if (empty($_POST['billing_first_name'])) {
            \wc_add_notice('<strong>Nazwa firmy/instytucji</strong> jest polem wymaganym.', 'error');
        }
        if (empty($_POST['billing_last_name'])) {
            \wc_add_notice('<strong>NIP</strong> jest polem wymaganym.', 'error');
        }
    } else {
        if (empty($_POST['billing_first_name'])) {
            \wc_add_notice('<strong>Imię płatnika</strong> jest polem wymaganym.', 'error');
        }
        if (empty($_POST['billing_last_name'])) {
            \wc_add_notice('<strong>Nazwisko płatnika</strong> jest polem wymaganym.', 'error');
        }
    }

    $participant_fields = [
        'participant_name' => 'Imię uczestnika',
        'participant_surname' => 'Nazwisko uczestnika',
        'participant_address' => 'Ulica uczestnika',
        'participant_postcode' => 'Kod pocztowy uczestnika',
        'participant_city' => 'Miejscowość uczestnika',
        'participant_phone' => 'Numer telefonu uczestnika',
        'participant_mail' => 'Email uczestnika',
        'participant_stanowisko' => 'Stanowisko uczestnika',
        'participant_recepty' => 'Uprawnienia do wystawiania recept',
        'participant_option_one' => 'Odpowiedź na pytanie o nr prawa wykonywania zawodu',
    ];

    foreach ($participant_fields as $key => $label) {
        if (empty($_POST[$key])) {
            \wc_add_notice(sprintf('%s jest polem wymaganym.', '<strong>' . $label . '</strong>'), 'error');
        }
    }

    if (!empty($_POST['participant_option_one']) && $_POST['participant_option_one'] === 'yes') {
        if (empty($_POST['participant_option_two'])) {
            \wc_add_notice('<strong>Nr prawa wykonywania zawodu</strong> jest polem wymaganym.', 'error');
        }
    }
}, 20);

/*--- Walidacja pól firmy ---*/

add_action('woocommerce_checkout_process', function () {
    if (empty($_POST['billing_first_name'])) {
        $is_business = isset($_POST['billing_is_business']) && $_POST['billing_is_business'] === 'yes';
        if ($is_business) {
            \wc_add_notice('<strong>Nazwa firmy/instytucji</strong> jest polem wymaganym.', 'error');
        }
    }

    if (empty($_POST['billing_last_name'])) {
        $is_business = isset($_POST['billing_is_business']) && $_POST['billing_is_business'] === 'yes';
        if ($is_business) {
            \wc_add_notice('<strong>NIP</strong> jest polem wymaganym.', 'error');
        }
    }
}, 100);

add_action('woocommerce_after_checkout_billing_form', function () {
    echo '<input type="hidden" name="billing_is_business" id="billing_is_business" value="no" />';
});

/*--- ZGODY ---*/

add_action('woocommerce_review_order_before_submit', function () {
    \woocommerce_form_field('agreement_1', [
        'type' => 'checkbox',
        'class' => ['form-row', 'validate-required'],
        'input_class' => ['agreement-checkbox'],
        'required' => true,
        'label' => 'Akceptuję, że faktura VAT zostanie wystawiona na dane podane w formularzu rejestracyjnym, bez możliwości wystawienia korekty. Dlatego prosimy upewnić się, że wprowadzone dane są prawidłowe.&nbsp;<span class="required">*</span>',
    ]);

    \woocommerce_form_field('agreement_2', [
        'type' => 'checkbox',
        'class' => ['form-row'],
        'input_class' => ['agreement-checkbox'],
        'label' => 'Wyrażam zgodę na przetwarzanie moich danych osobowych (imię, nazwisko, grupa zawodowa, adres e-mail) przez Evereth Publishing Sp. z o.o. w celu przesyłania informacji marketingowych dotyczących produktów wydawniczych i usług oferowanych przez Evereth Publishing Sp. z o.o. Zgoda może zostać przez Ciebie wycofana w każdej chwili.',
    ]);

    \woocommerce_form_field('agreement_3', [
        'type' => 'checkbox',
        'class' => ['form-row'],
        'input_class' => ['agreement-checkbox'],
        'label' => 'Wyrażam zgodę na wykorzystanie mojego adresu e-mail w celu przesyłania informacji o produktach i usługach zaufanych partnerów Evereth Publishing Sp. z o.o., dzięki czemu będziemy mogli informować Cię o ofercie firm współpracujących z nami. Zgoda może zostać przez Ciebie wycofana w każdej chwili.',
    ]);
}, 9);

add_action('woocommerce_checkout_terms_and_conditions', function () {
    \woocommerce_form_field('select_all_agreements', [
        'type' => 'checkbox',
        'class' => ['form-row', 'select-all-agreements-row'],
        'input_class' => ['select-all-agreements-checkbox'],
        'label' => 'Zaznacz wszystkie',
    ]);
}, 25);

add_action('woocommerce_checkout_process', function () {
    if (empty($_POST['agreement_1'])) {
        \wc_add_notice('Musisz zaakceptować warunki dotyczące faktury VAT.', 'error');
    }
    if (empty($_POST['terms'])) {
        \wc_add_notice('Proszę przeczytać i zaakceptować warunki i zasady, aby kontynuować zamówienie.', 'error');
    }
});

add_action('woocommerce_checkout_create_order', function ($order) {
    if (!empty($_POST['agreement_1'])) {
        $order->update_meta_data('Zgoda (faktura VAT)', 'Tak');
    }
    if (!empty($_POST['agreement_2'])) {
        $order->update_meta_data('Zgoda (marketing Evereth)', 'Tak');
    }
    if (!empty($_POST['agreement_3'])) {
        $order->update_meta_data('Zgoda (marketing partnerzy)', 'Tak');
    }
});

/*--- SET PAYU AS DEFAULT ---*/

add_filter( 'woocommerce_default_gateway', 'osf_set_default_payu_gateway' );

function osf_set_default_payu_gateway( $default ) {
    // ID brany z value="" w input – u Ciebie: value="payulistbanks"
    return 'payulistbanks';
}
