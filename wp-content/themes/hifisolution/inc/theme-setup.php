<?php
/**
 * Theme Setup — Configurazione base del tema.
 *
 * @package HiFiSolution
 */

defined('ABSPATH') || exit;

/**
 * Setup del tema dopo il caricamento.
 */
function hifisolution_setup() {
    // Supporto titolo del documento
    add_theme_support('title-tag');

    // Supporto immagini in evidenza
    add_theme_support('post-thumbnails');

    // Dimensioni immagini personalizzate per i prodotti
    add_image_size('hifi-product-large', 800, 800, false);
    add_image_size('hifi-product-thumb', 150, 150, true);
    add_image_size('hifi-product-card', 400, 400, false);
    add_image_size('hifi-category-card', 600, 450, true);
    add_image_size('hifi-brand-logo', 300, 200, false);
    add_image_size('hifi-blog-card', 600, 340, true);
    add_image_size('hifi-hero', 1920, 1080, true);

    // Menu di navigazione
    register_nav_menus(array(
        'primary'      => __('Menu Principale', 'hifisolution'),
        'footer'       => __('Menu Footer', 'hifisolution'),
        'footer-legal' => __('Menu Footer Legale', 'hifisolution'),
    ));

    // Supporto HTML5
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ));

    // Supporto logo personalizzato
    add_theme_support('custom-logo', array(
        'height'      => 80,
        'width'       => 250,
        'flex-height' => true,
        'flex-width'  => true,
    ));

    // Disabilita l'editor a blocchi per il CPT prodotto (usa ACF)
    add_filter('use_block_editor_for_post_type', function ($use, $post_type) {
        if ($post_type === 'prodotto') {
            return false;
        }
        return $use;
    }, 10, 2);
}
add_action('after_setup_theme', 'hifisolution_setup');

/**
 * Registra le sidebar/widget areas.
 */
function hifisolution_widgets_init() {
    register_sidebar(array(
        'name'          => __('Footer Colonna 1', 'hifisolution'),
        'id'            => 'footer-1',
        'description'   => __('Widget per la prima colonna del footer.', 'hifisolution'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="hifi-footer__title">',
        'after_title'   => '</h4>',
    ));

    register_sidebar(array(
        'name'          => __('Footer Colonna 2', 'hifisolution'),
        'id'            => 'footer-2',
        'description'   => __('Widget per la seconda colonna del footer.', 'hifisolution'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="hifi-footer__title">',
        'after_title'   => '</h4>',
    ));

    register_sidebar(array(
        'name'          => __('Sidebar Blog', 'hifisolution'),
        'id'            => 'sidebar-blog',
        'description'   => __('Sidebar per le pagine del blog.', 'hifisolution'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ));
}
add_action('widgets_init', 'hifisolution_widgets_init');

/**
 * Modifica il numero di prodotti per pagina nell'archivio.
 */
function hifisolution_products_per_page($query) {
    if (!is_admin() && $query->is_main_query()) {
        if (is_post_type_archive('prodotto') || is_tax('categoria_prodotto') || is_tax('brand')) {
            $query->set('posts_per_page', 12);
        }
    }
}
add_action('pre_get_posts', 'hifisolution_products_per_page');

/**
 * Aggiungi classe al body per lo stile dark.
 */
function hifisolution_body_classes($classes) {
    $classes[] = 'hifi-dark-theme';
    if (is_singular('prodotto')) {
        $classes[] = 'hifi-single-product';
    }
    if (is_post_type_archive('prodotto') || is_tax('categoria_prodotto') || is_tax('brand')) {
        $classes[] = 'hifi-archive-product';
    }
    return $classes;
}
add_filter('body_class', 'hifisolution_body_classes');

/**
 * Modifica l'excerpt length.
 */
function hifisolution_excerpt_length($length) {
    return 25;
}
add_filter('excerpt_length', 'hifisolution_excerpt_length');

/**
 * Modifica l'excerpt more.
 */
function hifisolution_excerpt_more($more) {
    return '&hellip;';
}
add_filter('excerpt_more', 'hifisolution_excerpt_more');
