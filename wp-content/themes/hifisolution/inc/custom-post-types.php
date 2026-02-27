<?php
/**
 * Custom Post Types — Registrazione CPT.
 *
 * @package HiFiSolution
 */

defined('ABSPATH') || exit;

/**
 * Registra il Custom Post Type "Prodotto".
 */
function hifisolution_register_cpt_prodotto() {
    $labels = array(
        'name'                  => __('Prodotti', 'hifisolution'),
        'singular_name'         => __('Prodotto', 'hifisolution'),
        'menu_name'             => __('Prodotti HiFi', 'hifisolution'),
        'name_admin_bar'        => __('Prodotto', 'hifisolution'),
        'add_new'               => __('Aggiungi Nuovo', 'hifisolution'),
        'add_new_item'          => __('Aggiungi Nuovo Prodotto', 'hifisolution'),
        'new_item'              => __('Nuovo Prodotto', 'hifisolution'),
        'edit_item'             => __('Modifica Prodotto', 'hifisolution'),
        'view_item'             => __('Visualizza Prodotto', 'hifisolution'),
        'all_items'             => __('Tutti i Prodotti', 'hifisolution'),
        'search_items'          => __('Cerca Prodotti', 'hifisolution'),
        'parent_item_colon'     => __('Prodotto Genitore:', 'hifisolution'),
        'not_found'             => __('Nessun prodotto trovato.', 'hifisolution'),
        'not_found_in_trash'    => __('Nessun prodotto nel cestino.', 'hifisolution'),
        'featured_image'        => __('Immagine Prodotto', 'hifisolution'),
        'set_featured_image'    => __('Imposta immagine prodotto', 'hifisolution'),
        'remove_featured_image' => __('Rimuovi immagine prodotto', 'hifisolution'),
        'use_featured_image'    => __('Usa come immagine prodotto', 'hifisolution'),
        'archives'              => __('Catalogo Prodotti', 'hifisolution'),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'show_in_rest'       => true,
        'query_var'          => true,
        'rewrite'            => array(
            'slug'       => 'prodotti',
            'with_front' => false,
        ),
        'capability_type' => 'post',
        'has_archive'     => true,
        'hierarchical'    => false,
        'menu_position'   => 5,
        'menu_icon'       => 'dashicons-format-audio',
        'supports'        => array(
            'title',
            'editor',
            'thumbnail',
            'excerpt',
            'revisions',
        ),
        'taxonomies' => array('categoria_prodotto', 'brand'),
    );

    register_post_type('prodotto', $args);
}
add_action('init', 'hifisolution_register_cpt_prodotto');

/**
 * Registra il Custom Post Type "Brand".
 *
 * Ogni brand ha una pagina dedicata con storia, filosofia e prodotti.
 */
function hifisolution_register_cpt_brand_page() {
    $labels = array(
        'name'               => __('Pagine Brand', 'hifisolution'),
        'singular_name'      => __('Pagina Brand', 'hifisolution'),
        'menu_name'          => __('Pagine Brand', 'hifisolution'),
        'add_new'            => __('Aggiungi Pagina Brand', 'hifisolution'),
        'add_new_item'       => __('Aggiungi Nuova Pagina Brand', 'hifisolution'),
        'edit_item'          => __('Modifica Pagina Brand', 'hifisolution'),
        'view_item'          => __('Visualizza Pagina Brand', 'hifisolution'),
        'all_items'          => __('Tutte le Pagine Brand', 'hifisolution'),
        'search_items'       => __('Cerca Pagine Brand', 'hifisolution'),
        'not_found'          => __('Nessuna pagina brand trovata.', 'hifisolution'),
        'not_found_in_trash' => __('Nessuna pagina brand nel cestino.', 'hifisolution'),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'show_in_rest'       => true,
        'query_var'          => true,
        'rewrite'            => array(
            'slug'       => 'marchi',
            'with_front' => false,
        ),
        'capability_type' => 'post',
        'has_archive'     => true,
        'hierarchical'    => false,
        'menu_position'   => 6,
        'menu_icon'       => 'dashicons-awards',
        'supports'        => array(
            'title',
            'editor',
            'thumbnail',
            'excerpt',
            'revisions',
        ),
    );

    register_post_type('brand_page', $args);
}
add_action('init', 'hifisolution_register_cpt_brand_page');

/**
 * Personalizza le colonne dell'admin per i prodotti.
 */
function hifisolution_prodotto_admin_columns($columns) {
    $new_columns = array();
    $new_columns['cb']                = $columns['cb'];
    $new_columns['thumbnail']         = __('Immagine', 'hifisolution');
    $new_columns['title']             = $columns['title'];
    $new_columns['brand']             = __('Brand', 'hifisolution');
    $new_columns['categoria_prodotto'] = __('Categoria', 'hifisolution');
    $new_columns['date']              = $columns['date'];
    return $new_columns;
}
add_filter('manage_prodotto_posts_columns', 'hifisolution_prodotto_admin_columns');

/**
 * Popola le colonne personalizzate dell'admin.
 */
function hifisolution_prodotto_admin_column_content($column, $post_id) {
    switch ($column) {
        case 'thumbnail':
            if (has_post_thumbnail($post_id)) {
                echo get_the_post_thumbnail($post_id, array(60, 60));
            } else {
                echo '<span class="dashicons dashicons-format-image" style="font-size:40px;color:#ccc;"></span>';
            }
            break;
        case 'brand':
            $terms = get_the_terms($post_id, 'brand');
            if ($terms && !is_wp_error($terms)) {
                $names = wp_list_pluck($terms, 'name');
                echo esc_html(implode(', ', $names));
            }
            break;
        case 'categoria_prodotto':
            $terms = get_the_terms($post_id, 'categoria_prodotto');
            if ($terms && !is_wp_error($terms)) {
                $names = wp_list_pluck($terms, 'name');
                echo esc_html(implode(', ', $names));
            }
            break;
    }
}
add_action('manage_prodotto_posts_custom_column', 'hifisolution_prodotto_admin_column_content', 10, 2);

/**
 * Flush rewrite rules on theme activation.
 */
function hifisolution_rewrite_flush() {
    hifisolution_register_cpt_prodotto();
    hifisolution_register_cpt_brand_page();
    flush_rewrite_rules();
}
add_action('after_switch_theme', 'hifisolution_rewrite_flush');
