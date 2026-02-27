<?php
/**
 * Custom Taxonomies — Tassonomie personalizzate.
 *
 * @package HiFiSolution
 */

defined('ABSPATH') || exit;

/**
 * Registra la tassonomia "Categoria Prodotto".
 */
function hifisolution_register_taxonomy_categoria_prodotto() {
    $labels = array(
        'name'              => __('Categorie Prodotto', 'hifisolution'),
        'singular_name'     => __('Categoria Prodotto', 'hifisolution'),
        'search_items'      => __('Cerca Categorie', 'hifisolution'),
        'all_items'         => __('Tutte le Categorie', 'hifisolution'),
        'parent_item'       => __('Categoria Genitore', 'hifisolution'),
        'parent_item_colon' => __('Categoria Genitore:', 'hifisolution'),
        'edit_item'         => __('Modifica Categoria', 'hifisolution'),
        'update_item'       => __('Aggiorna Categoria', 'hifisolution'),
        'add_new_item'      => __('Aggiungi Nuova Categoria', 'hifisolution'),
        'new_item_name'     => __('Nome Nuova Categoria', 'hifisolution'),
        'menu_name'         => __('Categorie', 'hifisolution'),
    );

    $args = array(
        'labels'            => $labels,
        'hierarchical'      => true,
        'public'            => true,
        'show_ui'           => true,
        'show_in_rest'      => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array(
            'slug'         => 'prodotti/categoria',
            'with_front'   => false,
            'hierarchical' => true,
        ),
    );

    register_taxonomy('categoria_prodotto', array('prodotto'), $args);

    // Categorie predefinite
    $default_categories = array(
        'diffusori'         => 'Diffusori e Casse',
        'amplificatori'     => 'Amplificatori',
        'giradischi'        => 'Giradischi',
        'sorgenti-digitali' => 'Sorgenti Digitali',
        'cuffie'            => 'Cuffie',
        'cavi-accessori'    => 'Cavi e Accessori',
        'sistemi-completi'  => 'Sistemi Completi',
    );

    foreach ($default_categories as $slug => $name) {
        if (!term_exists($slug, 'categoria_prodotto')) {
            wp_insert_term($name, 'categoria_prodotto', array('slug' => $slug));
        }
    }
}
add_action('init', 'hifisolution_register_taxonomy_categoria_prodotto');

/**
 * Registra la tassonomia "Brand".
 */
function hifisolution_register_taxonomy_brand() {
    $labels = array(
        'name'              => __('Brand', 'hifisolution'),
        'singular_name'     => __('Brand', 'hifisolution'),
        'search_items'      => __('Cerca Brand', 'hifisolution'),
        'all_items'         => __('Tutti i Brand', 'hifisolution'),
        'edit_item'         => __('Modifica Brand', 'hifisolution'),
        'update_item'       => __('Aggiorna Brand', 'hifisolution'),
        'add_new_item'      => __('Aggiungi Nuovo Brand', 'hifisolution'),
        'new_item_name'     => __('Nome Nuovo Brand', 'hifisolution'),
        'menu_name'         => __('Brand', 'hifisolution'),
    );

    $args = array(
        'labels'            => $labels,
        'hierarchical'      => false,
        'public'            => true,
        'show_ui'           => true,
        'show_in_rest'      => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array(
            'slug'       => 'prodotti/brand',
            'with_front' => false,
        ),
    );

    register_taxonomy('brand', array('prodotto'), $args);

    // Brand predefiniti
    $default_brands = array(
        'bowers-wilkins' => 'Bowers & Wilkins',
        'marantz'        => 'Marantz',
        'rotel'          => 'Rotel',
        'ortofon'        => 'Ortofon',
        'focal'          => 'Focal',
    );

    foreach ($default_brands as $slug => $name) {
        if (!term_exists($slug, 'brand')) {
            wp_insert_term($name, 'brand', array('slug' => $slug));
        }
    }
}
add_action('init', 'hifisolution_register_taxonomy_brand');

/**
 * Registra la tassonomia "Fascia di Prezzo".
 */
function hifisolution_register_taxonomy_fascia_prezzo() {
    $labels = array(
        'name'          => __('Fasce di Prezzo', 'hifisolution'),
        'singular_name' => __('Fascia di Prezzo', 'hifisolution'),
        'search_items'  => __('Cerca Fascia', 'hifisolution'),
        'all_items'     => __('Tutte le Fasce', 'hifisolution'),
        'edit_item'     => __('Modifica Fascia', 'hifisolution'),
        'update_item'   => __('Aggiorna Fascia', 'hifisolution'),
        'add_new_item'  => __('Aggiungi Fascia', 'hifisolution'),
        'new_item_name' => __('Nome Nuova Fascia', 'hifisolution'),
        'menu_name'     => __('Fasce Prezzo', 'hifisolution'),
    );

    $args = array(
        'labels'            => $labels,
        'hierarchical'      => true,
        'public'            => true,
        'show_ui'           => true,
        'show_in_rest'      => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array(
            'slug'       => 'prodotti/prezzo',
            'with_front' => false,
        ),
    );

    register_taxonomy('fascia_prezzo', array('prodotto'), $args);

    // Fasce predefinite
    $default_ranges = array(
        'fino-500'      => 'Fino a €500',
        '500-1000'      => '€500 — €1.000',
        '1000-2500'     => '€1.000 — €2.500',
        '2500-5000'     => '€2.500 — €5.000',
        'oltre-5000'    => 'Oltre €5.000',
    );

    foreach ($default_ranges as $slug => $name) {
        if (!term_exists($slug, 'fascia_prezzo')) {
            wp_insert_term($name, 'fascia_prezzo', array('slug' => $slug));
        }
    }
}
add_action('init', 'hifisolution_register_taxonomy_fascia_prezzo');

/**
 * Modifica il permalink dei prodotti per includere il brand.
 * Struttura: /prodotti/[brand]/[nome-prodotto]/
 */
function hifisolution_prodotto_permalink($post_link, $post) {
    if ($post->post_type !== 'prodotto') {
        return $post_link;
    }

    $brands = get_the_terms($post->ID, 'brand');
    if ($brands && !is_wp_error($brands)) {
        $brand_slug = $brands[0]->slug;
        $post_link = str_replace('%brand%', $brand_slug, $post_link);
    } else {
        $post_link = str_replace('%brand%', 'altro', $post_link);
    }

    return $post_link;
}

/**
 * Aggiunge i campi immagine e descrizione ai term della tassonomia brand.
 */
function hifisolution_brand_add_fields($taxonomy) {
    ?>
    <div class="form-field">
        <label for="brand_logo"><?php esc_html_e('Logo Brand (URL immagine)', 'hifisolution'); ?></label>
        <input type="text" name="brand_logo" id="brand_logo" value="">
        <p class="description"><?php esc_html_e('URL del logo del brand.', 'hifisolution'); ?></p>
    </div>
    <div class="form-field">
        <label for="brand_website"><?php esc_html_e('Sito Web Brand', 'hifisolution'); ?></label>
        <input type="url" name="brand_website" id="brand_website" value="">
        <p class="description"><?php esc_html_e('URL del sito web ufficiale del brand.', 'hifisolution'); ?></p>
    </div>
    <?php
}
add_action('brand_add_form_fields', 'hifisolution_brand_add_fields');

/**
 * Campi edit per la tassonomia brand.
 */
function hifisolution_brand_edit_fields($term) {
    $logo    = get_term_meta($term->term_id, 'brand_logo', true);
    $website = get_term_meta($term->term_id, 'brand_website', true);
    ?>
    <tr class="form-field">
        <th scope="row"><label for="brand_logo"><?php esc_html_e('Logo Brand (URL immagine)', 'hifisolution'); ?></label></th>
        <td>
            <input type="text" name="brand_logo" id="brand_logo" value="<?php echo esc_attr($logo); ?>">
            <p class="description"><?php esc_html_e('URL del logo del brand.', 'hifisolution'); ?></p>
        </td>
    </tr>
    <tr class="form-field">
        <th scope="row"><label for="brand_website"><?php esc_html_e('Sito Web Brand', 'hifisolution'); ?></label></th>
        <td>
            <input type="url" name="brand_website" id="brand_website" value="<?php echo esc_url($website); ?>">
            <p class="description"><?php esc_html_e('URL del sito web ufficiale del brand.', 'hifisolution'); ?></p>
        </td>
    </tr>
    <?php
}
add_action('brand_edit_form_fields', 'hifisolution_brand_edit_fields');

/**
 * Salva i campi custom della tassonomia brand.
 */
function hifisolution_save_brand_fields($term_id) {
    if (isset($_POST['brand_logo'])) {
        update_term_meta($term_id, 'brand_logo', sanitize_text_field(wp_unslash($_POST['brand_logo'])));
    }
    if (isset($_POST['brand_website'])) {
        update_term_meta($term_id, 'brand_website', esc_url_raw(wp_unslash($_POST['brand_website'])));
    }
}
add_action('created_brand', 'hifisolution_save_brand_fields');
add_action('edited_brand', 'hifisolution_save_brand_fields');

/**
 * Aggiunge campo immagine alla tassonomia categoria_prodotto.
 */
function hifisolution_categoria_add_fields($taxonomy) {
    ?>
    <div class="form-field">
        <label for="categoria_image"><?php esc_html_e('Immagine Categoria (URL)', 'hifisolution'); ?></label>
        <input type="text" name="categoria_image" id="categoria_image" value="">
    </div>
    <?php
}
add_action('categoria_prodotto_add_form_fields', 'hifisolution_categoria_add_fields');

function hifisolution_categoria_edit_fields($term) {
    $image = get_term_meta($term->term_id, 'categoria_image', true);
    ?>
    <tr class="form-field">
        <th scope="row"><label for="categoria_image"><?php esc_html_e('Immagine Categoria (URL)', 'hifisolution'); ?></label></th>
        <td>
            <input type="text" name="categoria_image" id="categoria_image" value="<?php echo esc_attr($image); ?>">
        </td>
    </tr>
    <?php
}
add_action('categoria_prodotto_edit_form_fields', 'hifisolution_categoria_edit_fields');

function hifisolution_save_categoria_fields($term_id) {
    if (isset($_POST['categoria_image'])) {
        update_term_meta($term_id, 'categoria_image', sanitize_text_field(wp_unslash($_POST['categoria_image'])));
    }
}
add_action('created_categoria_prodotto', 'hifisolution_save_categoria_fields');
add_action('edited_categoria_prodotto', 'hifisolution_save_categoria_fields');
