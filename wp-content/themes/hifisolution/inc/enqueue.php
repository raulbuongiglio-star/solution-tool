<?php
/**
 * Enqueue Scripts e Styles.
 *
 * @package HiFiSolution
 */

defined('ABSPATH') || exit;

/**
 * Carica stili e script del tema.
 */
function hifisolution_enqueue_assets() {
    // Parent theme (GeneratePress)
    wp_enqueue_style(
        'generatepress-style',
        get_template_directory_uri() . '/style.css',
        array(),
        HIFISOLUTION_VERSION
    );

    // Google Fonts — Inter & DM Sans
    wp_enqueue_style(
        'hifisolution-fonts',
        'https://fonts.googleapis.com/css2?family=DM+Sans:ital,wght@0,400;0,500;0,700;1,400&family=Inter:wght@300;400;500;600;700&display=swap',
        array(),
        null
    );

    // Child theme stylesheet
    wp_enqueue_style(
        'hifisolution-style',
        get_stylesheet_uri(),
        array('generatepress-style'),
        HIFISOLUTION_VERSION
    );

    // Custom CSS
    wp_enqueue_style(
        'hifisolution-custom',
        HIFISOLUTION_URI . '/assets/css/custom.css',
        array('hifisolution-style'),
        HIFISOLUTION_VERSION
    );

    // Custom JS
    wp_enqueue_script(
        'hifisolution-main',
        HIFISOLUTION_URI . '/assets/js/main.js',
        array(),
        HIFISOLUTION_VERSION,
        true
    );

    // Passa dati a JavaScript
    wp_localize_script('hifisolution-main', 'hifiData', array(
        'ajaxUrl'  => admin_url('admin-ajax.php'),
        'nonce'    => wp_create_nonce('hifi_nonce'),
        'shopUrl'  => HIFISOLUTION_SHOP_URL,
        'themeUrl' => HIFISOLUTION_URI,
    ));

    // Script per il singolo prodotto (galleria lightbox)
    if (is_singular('prodotto')) {
        wp_enqueue_script(
            'hifisolution-product',
            HIFISOLUTION_URI . '/assets/js/product.js',
            array('hifisolution-main'),
            HIFISOLUTION_VERSION,
            true
        );
    }

    // Script per l'archivio prodotti (filtri AJAX)
    if (is_post_type_archive('prodotto') || is_tax('categoria_prodotto') || is_tax('brand')) {
        wp_enqueue_script(
            'hifisolution-catalog',
            HIFISOLUTION_URI . '/assets/js/catalog.js',
            array('hifisolution-main'),
            HIFISOLUTION_VERSION,
            true
        );
    }
}
add_action('wp_enqueue_scripts', 'hifisolution_enqueue_assets');

/**
 * Carica media uploader e sortable nell'admin per i metabox nativi.
 */
function hifisolution_admin_enqueue($hook) {
    if (function_exists('acf_add_local_field_group')) {
        return;
    }
    if (!in_array($hook, array('post.php', 'post-new.php'), true)) {
        return;
    }
    $screen = get_current_screen();
    if ($screen && $screen->post_type === 'prodotto') {
        wp_enqueue_media();
        wp_enqueue_script('jquery-ui-sortable');
    }
}
add_action('admin_enqueue_scripts', 'hifisolution_admin_enqueue');

/**
 * Preload dei font per performance.
 */
function hifisolution_preload_fonts() {
    ?>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <?php
}
add_action('wp_head', 'hifisolution_preload_fonts', 1);

/**
 * Aggiungi attributi async/defer agli script non critici.
 */
function hifisolution_script_loader_tag($tag, $handle, $src) {
    $async_scripts = array('hifisolution-catalog', 'hifisolution-product');
    if (in_array($handle, $async_scripts, true)) {
        return str_replace(' src', ' defer src', $tag);
    }
    return $tag;
}
add_filter('script_loader_tag', 'hifisolution_script_loader_tag', 10, 3);

/**
 * Rimuovi stili/script non necessari per migliorare le performance.
 */
function hifisolution_dequeue_unnecessary() {
    // Rimuovi emoji script di WordPress
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_action('admin_print_scripts', 'print_emoji_detection_script');
    remove_action('admin_print_styles', 'print_emoji_styles');

    // Rimuovi embed script se non necessario
    wp_deregister_script('wp-embed');
}
add_action('wp_enqueue_scripts', 'hifisolution_dequeue_unnecessary', 100);
