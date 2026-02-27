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

    // Struttura categorie e sottocategorie (identica a PrestaShop hifisolution.it).
    $categories_tree = array(
        'amplificazioni' => array(
            'name'     => 'Amplificazioni',
            'children' => array(
                'integrati-stereo'            => 'Amplificatori Integrati Stereo',
                'finali-stereo'               => 'Amplificatori Finali Stereo',
                'finali-monofonici'           => 'Amplificatori Finali Monofonici',
                'preamplificatori-stereo'     => 'Preamplificatori Stereo',
                'preamplificatori-multicanale' => 'Preamplificatori Multicanale',
                'finali-multicanale'          => 'Amplificatori Finali Multicanale',
                'integrati-multicanale'       => 'Amplificatori Integrati Multicanale',
                'integrati-valvolari'         => 'Integrati Valvolari',
            ),
        ),
        'diffusori' => array(
            'name'     => 'Diffusori',
            'children' => array(
                'diffusori-da-pavimento'   => 'Diffusori da Pavimento',
                'diffusori-da-scaffale'    => 'Diffusori da Scaffale',
                'canali-centrali'          => 'Canali Centrali',
                'subwoofer-attivi'         => 'Subwoofer Attivi',
                'diffusori-attivi-wireless' => 'Diffusori Attivi e Wireless',
                'soundbar'                 => 'Soundbar',
                'diffusori-da-incasso'     => 'Diffusori da Incasso',
                'diffusori-da-esterno'     => 'Diffusori da Esterno',
            ),
        ),
        'sorgenti' => array(
            'name'     => 'Sorgenti',
            'children' => array(
                'lettori-cd-sacd'   => 'Lettori CD e SACD',
                'lettori-bluray'    => 'Lettori Blu-ray',
                'lettori-di-rete'   => 'Lettori di Rete',
                'dac'               => 'DAC',
                'sintonizzatori'    => 'Sintonizzatori',
            ),
        ),
        'giradischi' => array(
            'name'     => 'Giradischi',
            'children' => array(
                'bracci'                => 'Bracci',
                'testine'               => 'Testine',
                'preamplificatori-phono' => 'Preamplificatori Phono',
                'accessori-pulizia'     => 'Accessori per Pulizia',
            ),
        ),
        'cuffie' => array(
            'name'     => 'Cuffie',
            'children' => array(),
        ),
        'sistemi-completi' => array(
            'name'     => 'Sistemi Completi',
            'children' => array(
                'sistemi-all-in-one'  => 'Sistemi All in One',
                'sistemi-home-cinema' => 'Sistemi Home Cinema',
            ),
        ),
        'cavi-accessori' => array(
            'name'     => 'Cavi ed Accessori',
            'children' => array(),
        ),
        'video' => array(
            'name'     => 'Video',
            'children' => array(),
        ),
        'usato-ex-demo' => array(
            'name'     => 'Usato e Ex Demo',
            'children' => array(),
        ),
    );

    foreach ($categories_tree as $slug => $cat) {
        $parent_term = term_exists($slug, 'categoria_prodotto');
        if (!$parent_term) {
            $parent_term = wp_insert_term($cat['name'], 'categoria_prodotto', array('slug' => $slug));
        }
        if (is_wp_error($parent_term)) {
            continue;
        }
        $parent_id = is_array($parent_term) ? (int) $parent_term['term_id'] : (int) $parent_term;

        foreach ($cat['children'] as $child_slug => $child_name) {
            if (!term_exists($child_slug, 'categoria_prodotto')) {
                wp_insert_term($child_name, 'categoria_prodotto', array(
                    'slug'   => $child_slug,
                    'parent' => $parent_id,
                ));
            }
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

    // Brand predefiniti (identici a PrestaShop hifisolution.it).
    $default_brands = array(
        'aavik'             => array('Aavik',             'https://www.hifisolution.it/img/m/93-small_default.jpg'),
        'accuphase'         => array('Accuphase',         'https://www.hifisolution.it/img/m/12-small_default.jpg'),
        'acoustic-energy'   => array('Acoustic Energy',   'https://www.hifisolution.it/img/m/38-small_default.jpg'),
        'anthem'            => array('Anthem',            'https://www.hifisolution.it/img/m/25-small_default.jpg'),
        'arcam'             => array('Arcam',             'https://www.hifisolution.it/img/m/23-small_default.jpg'),
        'audiolab'          => array('Audiolab',          'https://www.hifisolution.it/img/m/55-small_default.jpg'),
        'audioquest'        => array('AudioQuest',        'https://www.hifisolution.it/img/m/74-small_default.jpg'),
        'auralic'           => array('AURALiC',           'https://www.hifisolution.it/img/m/26-small_default.jpg'),
        'axxess'            => array('AXXESS',            'https://www.hifisolution.it/img/m/87-small_default.jpg'),
        'bowers-wilkins'    => array('Bowers & Wilkins',  'https://www.hifisolution.it/img/m/4-small_default.jpg'),
        'cambridge-audio'   => array('Cambridge Audio',   'https://www.hifisolution.it/img/m/57-small_default.jpg'),
        'canor'             => array('Canor',             'https://www.hifisolution.it/img/m/10-small_default.jpg'),
        'cary-audio'        => array('Cary Audio',        'https://www.hifisolution.it/img/m/94-small_default.jpg'),
        'classe-audio'      => array('Classé Audio',      'https://www.hifisolution.it/img/m/31-small_default.jpg'),
        'convergent-audio'  => array('Convergent Audio',  'https://www.hifisolution.it/img/m/70-small_default.jpg'),
        'copland'           => array('Copland',           'https://www.hifisolution.it/img/m/65-small_default.jpg'),
        'denon'             => array('Denon',             'https://www.hifisolution.it/img/m/34-small_default.jpg'),
        'dual'              => array('Dual',              'https://www.hifisolution.it/img/m/68-small_default.jpg'),
        'egreat'            => array('Egreat',            'https://www.hifisolution.it/img/m/84-small_default.jpg'),
        'electrocompaniet'  => array('Electrocompaniet',  'https://www.hifisolution.it/img/m/53-small_default.jpg'),
        'epson'             => array('Epson',             'https://www.hifisolution.it/img/m/66-small_default.jpg'),
        'esoteric'          => array('Esoteric',          'https://www.hifisolution.it/img/m/40-small_default.jpg'),
        'falcon-acoustics'  => array('Falcon Acoustics',  'https://www.hifisolution.it/img/m/60-small_default.jpg'),
        'focal'             => array('Focal',             'https://www.hifisolution.it/img/m/1-small_default.jpg'),
        'gold-note'         => array('Gold Note',         'https://www.hifisolution.it/img/m/18-small_default.jpg'),
        'gryphon'           => array('Gryphon',           'https://www.hifisolution.it/img/m/85-small_default.jpg'),
        'harbeth'           => array('Harbeth',           'https://www.hifisolution.it/img/m/51-small_default.jpg'),
        'ja-michell'        => array('J.A. Michell',      'https://www.hifisolution.it/img/m/82-small_default.jpg'),
        'jbl'               => array('JBL',               'https://www.hifisolution.it/img/m/14-small_default.jpg'),
        'jeff-rowland'      => array('Jeff Rowland',      'https://www.hifisolution.it/img/m/9-small_default.jpg'),
        'klh'               => array('KLH',               'https://www.hifisolution.it/img/m/6-small_default.jpg'),
        'klimo'             => array('Klimo',             'https://www.hifisolution.it/img/m/27-small_default.jpg'),
        'leak'              => array('Leak',              'https://www.hifisolution.it/img/m/79-small_default.jpg'),
        'lehmannaudio'      => array('Lehmannaudio',      'https://www.hifisolution.it/img/m/63-small_default.jpg'),
        'lumin'             => array('Lumin',             'https://www.hifisolution.it/img/m/15-small_default.jpg'),
        'luxman'            => array('Luxman',            'https://www.hifisolution.it/img/m/71-small_default.jpg'),
        'magnetar-audio'    => array('Magnetar Audio',    'https://www.hifisolution.it/img/m/32-small_default.jpg'),
        'marantz'           => array('Marantz',           'https://www.hifisolution.it/img/m/11-small_default.jpg'),
        'mark-levinson'     => array('Mark Levinson',     'https://www.hifisolution.it/img/m/13-small_default.jpg'),
        'martin-logan'      => array('MartinLogan',       'https://www.hifisolution.it/img/m/76-small_default.jpg'),
        'matrix-audio'      => array('Matrix Audio',      'https://www.hifisolution.it/img/m/59-small_default.jpg'),
        'mcintosh'          => array('McIntosh',          'https://www.hifisolution.it/img/m/3-small_default.jpg'),
        'melco-audio'       => array('Melco Audio',       'https://www.hifisolution.it/img/m/7-small_default.jpg'),
        'meze-audio'        => array('Meze Audio',        'https://www.hifisolution.it/img/m/75-small_default.jpg'),
        'moonriver-audio'   => array('Moonriver Audio',   'https://www.hifisolution.it/img/m/86-small_default.jpg'),
        'musical-fidelity'  => array('Musical Fidelity',  'https://www.hifisolution.it/img/m/17-small_default.jpg'),
        'naim'              => array('Naim',              'https://www.hifisolution.it/img/m/5-small_default.jpg'),
        'nelson-pass'       => array('Nelson Pass',       'https://www.hifisolution.it/img/m/43-small_default.jpg'),
        'ortofon'           => array('Ortofon',           'https://www.hifisolution.it/img/m/33-small_default.jpg'),
        'paradigm'          => array('Paradigm',          'https://www.hifisolution.it/img/m/29-small_default.jpg'),
        'pass-labs'         => array('Pass Labs',         'https://www.hifisolution.it/img/m/62-small_default.jpg'),
        'polk-audio'        => array('Polk Audio',        'https://www.hifisolution.it/img/m/45-small_default.jpg'),
        'primare'           => array('Primare',           'https://www.hifisolution.it/img/m/30-small_default.jpg'),
        'pro-ject'          => array('Pro-Ject',          'https://www.hifisolution.it/img/m/92-small_default.jpg'),
        'proac'             => array('ProAc',             'https://www.hifisolution.it/img/m/52-small_default.jpg'),
        'q-acoustics'       => array('Q Acoustics',       'https://www.hifisolution.it/img/m/39-small_default.jpg'),
        'reavon'            => array('Reavon',            'https://www.hifisolution.it/img/m/69-small_default.jpg'),
        'rega'              => array('Rega',              'https://www.hifisolution.it/img/m/64-small_default.jpg'),
        'rel'               => array('REL Acoustics',     'https://www.hifisolution.it/img/m/67-small_default.jpg'),
        'roon'              => array('Roon',              'https://www.hifisolution.it/img/m/83-small_default.jpg'),
        'rotel'             => array('Rotel',             'https://www.hifisolution.it/img/m/54-small_default.jpg'),
        'spl'               => array('SPL',               'https://www.hifisolution.it/img/m/80-small_default.jpg'),
        'sugden-audio'      => array('Sugden Audio',      'https://www.hifisolution.it/img/m/49-small_default.jpg'),
        'synthesis'         => array('Synthesis',         'https://www.hifisolution.it/img/m/2-small_default.jpg'),
        'tannoy'            => array('Tannoy',            'https://www.hifisolution.it/img/m/46-small_default.jpg'),
        'tascam'            => array('Tascam',            'https://www.hifisolution.it/img/m/8-small_default.jpg'),
        'teac'              => array('TEAC',              'https://www.hifisolution.it/img/m/36-small_default.jpg'),
        'technics'          => array('Technics',          'https://www.hifisolution.it/img/m/47-small_default.jpg'),
        'tivoli-audio'      => array('Tivoli Audio',      'https://www.hifisolution.it/img/m/37-small_default.jpg'),
        'tonewinner'        => array('Tonewinner',        'https://www.hifisolution.it/img/m/88-small_default.jpg'),
        'triangle'          => array('Triangle',          'https://www.hifisolution.it/img/m/72-small_default.jpg'),
        'triode'            => array('Triode',            'https://www.hifisolution.it/img/m/91-small_default.jpg'),
        'velodyne'          => array('Velodyne',          'https://www.hifisolution.it/img/m/19-small_default.jpg'),
        'vincent-audio'     => array('Vincent Audio',     'https://www.hifisolution.it/img/m/78-small_default.jpg'),
        'vpi'               => array('VPI',               'https://www.hifisolution.it/img/m/41-small_default.jpg'),
        'vtl'               => array('VTL',               'https://www.hifisolution.it/img/m/20-small_default.jpg'),
        'wharfedale'        => array('Wharfedale',        'https://www.hifisolution.it/img/m/50-small_default.jpg'),
        'wiim'              => array('WiiM',              'https://www.hifisolution.it/img/m/96-small_default.jpg'),
    );

    foreach ($default_brands as $slug => $brand_data) {
        $term = term_exists($slug, 'brand');
        if (!$term) {
            $term = wp_insert_term($brand_data[0], 'brand', array('slug' => $slug));
        }
        if (!is_wp_error($term)) {
            $term_id = is_array($term) ? (int) $term['term_id'] : (int) $term;
            if (!get_term_meta($term_id, 'brand_logo', true)) {
                update_term_meta($term_id, 'brand_logo', $brand_data[1]);
            }
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
