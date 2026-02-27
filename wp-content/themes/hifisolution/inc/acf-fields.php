<?php
/**
 * ACF Fields — Configurazione campi personalizzati.
 *
 * Se ACF Pro non è installato, registra meta box nativi WordPress.
 *
 * @package HiFiSolution
 */

defined('ABSPATH') || exit;

/**
 * Registra i gruppi di campi ACF per il CPT Prodotto.
 */
function hifisolution_register_acf_fields() {
    if (!function_exists('acf_add_local_field_group')) {
        return;
    }

    // ---- Gruppo: Dettagli Prodotto ----
    acf_add_local_field_group(array(
        'key'      => 'group_prodotto_dettagli',
        'title'    => __('Dettagli Prodotto', 'hifisolution'),
        'fields'   => array(
            array(
                'key'          => 'field_prodotto_sottotitolo',
                'label'        => __('Sottotitolo', 'hifisolution'),
                'name'         => 'prodotto_sottotitolo',
                'type'         => 'text',
                'instructions' => __('Breve descrizione sotto il titolo (es. "Diffusore da pavimento serie 800")', 'hifisolution'),
            ),
            array(
                'key'          => 'field_prodotto_shop_url',
                'label'        => __('Link allo Shop', 'hifisolution'),
                'name'         => 'prodotto_shop_url',
                'type'         => 'url',
                'instructions' => __('URL della pagina prodotto su hifisolution.it (PrestaShop)', 'hifisolution'),
                'required'     => 1,
                'default_value' => 'https://www.hifisolution.it',
            ),
            array(
                'key'          => 'field_prodotto_prezzo_indicativo',
                'label'        => __('Fascia di Prezzo Indicativa', 'hifisolution'),
                'name'         => 'prodotto_prezzo_indicativo',
                'type'         => 'text',
                'instructions' => __('Prezzo indicativo (es. "A partire da €2.500" o "€1.200 — €1.800")', 'hifisolution'),
            ),
            array(
                'key'          => 'field_prodotto_in_evidenza',
                'label'        => __('In Evidenza', 'hifisolution'),
                'name'         => 'prodotto_in_evidenza',
                'type'         => 'true_false',
                'instructions' => __('Mostra questo prodotto nella sezione "In Evidenza" della home page.', 'hifisolution'),
                'ui'           => 1,
            ),
            array(
                'key'          => 'field_prodotto_novita',
                'label'        => __('Novità', 'hifisolution'),
                'name'         => 'prodotto_novita',
                'type'         => 'true_false',
                'instructions' => __('Contrassegna questo prodotto come novità.', 'hifisolution'),
                'ui'           => 1,
            ),
        ),
        'location' => array(
            array(
                array(
                    'param'    => 'post_type',
                    'operator' => '==',
                    'value'    => 'prodotto',
                ),
            ),
        ),
        'position'          => 'normal',
        'style'             => 'default',
        'label_placement'   => 'top',
        'menu_order'        => 0,
    ));

    // ---- Gruppo: Galleria Immagini Prodotto ----
    acf_add_local_field_group(array(
        'key'    => 'group_prodotto_galleria',
        'title'  => __('Galleria Immagini', 'hifisolution'),
        'fields' => array(
            array(
                'key'          => 'field_prodotto_galleria',
                'label'        => __('Immagini Prodotto', 'hifisolution'),
                'name'         => 'prodotto_galleria',
                'type'         => 'gallery',
                'instructions' => __('Carica le immagini del prodotto. La prima sarà usata come immagine principale se non è impostata l\'immagine in evidenza.', 'hifisolution'),
                'return_format' => 'array',
                'preview_size'  => 'medium',
                'library'       => 'all',
                'min'           => 0,
                'max'           => 20,
            ),
        ),
        'location' => array(
            array(
                array(
                    'param'    => 'post_type',
                    'operator' => '==',
                    'value'    => 'prodotto',
                ),
            ),
        ),
        'position'  => 'normal',
        'style'     => 'default',
        'menu_order' => 1,
    ));

    // ---- Gruppo: Specifiche Tecniche ----
    acf_add_local_field_group(array(
        'key'    => 'group_prodotto_specifiche',
        'title'  => __('Specifiche Tecniche', 'hifisolution'),
        'fields' => array(
            array(
                'key'          => 'field_prodotto_specifiche',
                'label'        => __('Specifiche', 'hifisolution'),
                'name'         => 'prodotto_specifiche',
                'type'         => 'repeater',
                'instructions' => __('Aggiungi le specifiche tecniche del prodotto.', 'hifisolution'),
                'layout'       => 'table',
                'button_label' => __('Aggiungi Specifica', 'hifisolution'),
                'sub_fields'   => array(
                    array(
                        'key'   => 'field_specifica_nome',
                        'label' => __('Specifica', 'hifisolution'),
                        'name'  => 'specifica_nome',
                        'type'  => 'text',
                    ),
                    array(
                        'key'   => 'field_specifica_valore',
                        'label' => __('Valore', 'hifisolution'),
                        'name'  => 'specifica_valore',
                        'type'  => 'text',
                    ),
                ),
            ),
        ),
        'location' => array(
            array(
                array(
                    'param'    => 'post_type',
                    'operator' => '==',
                    'value'    => 'prodotto',
                ),
            ),
        ),
        'position'   => 'normal',
        'style'      => 'default',
        'menu_order'  => 2,
    ));

    // ---- Gruppo: SEO Prodotto ----
    acf_add_local_field_group(array(
        'key'    => 'group_prodotto_seo',
        'title'  => __('SEO Prodotto', 'hifisolution'),
        'fields' => array(
            array(
                'key'          => 'field_prodotto_meta_title',
                'label'        => __('Meta Title (opzionale)', 'hifisolution'),
                'name'         => 'prodotto_meta_title',
                'type'         => 'text',
                'instructions' => __('Se vuoto, verrà generato automaticamente: "[Nome] — [Brand] | HiFi Solution Napoli"', 'hifisolution'),
                'maxlength'    => 70,
            ),
            array(
                'key'          => 'field_prodotto_meta_description',
                'label'        => __('Meta Description (opzionale)', 'hifisolution'),
                'name'         => 'prodotto_meta_description',
                'type'         => 'textarea',
                'instructions' => __('Se vuota, verrà usato l\'excerpt.', 'hifisolution'),
                'maxlength'    => 160,
                'rows'         => 2,
            ),
        ),
        'location' => array(
            array(
                array(
                    'param'    => 'post_type',
                    'operator' => '==',
                    'value'    => 'prodotto',
                ),
            ),
        ),
        'position'   => 'side',
        'style'      => 'default',
        'menu_order'  => 3,
    ));

    // ---- Gruppo: Dettagli Brand Page ----
    acf_add_local_field_group(array(
        'key'    => 'group_brand_page_dettagli',
        'title'  => __('Dettagli Brand', 'hifisolution'),
        'fields' => array(
            array(
                'key'   => 'field_brand_logo',
                'label' => __('Logo Brand', 'hifisolution'),
                'name'  => 'brand_logo',
                'type'  => 'image',
                'return_format' => 'array',
                'preview_size'  => 'medium',
            ),
            array(
                'key'          => 'field_brand_website',
                'label'        => __('Sito Web Ufficiale', 'hifisolution'),
                'name'         => 'brand_website',
                'type'         => 'url',
            ),
            array(
                'key'          => 'field_brand_anno_fondazione',
                'label'        => __('Anno di Fondazione', 'hifisolution'),
                'name'         => 'brand_anno_fondazione',
                'type'         => 'text',
            ),
            array(
                'key'          => 'field_brand_paese',
                'label'        => __('Paese di Origine', 'hifisolution'),
                'name'         => 'brand_paese',
                'type'         => 'text',
            ),
            array(
                'key'          => 'field_brand_filosofia',
                'label'        => __('Filosofia del Brand', 'hifisolution'),
                'name'         => 'brand_filosofia',
                'type'         => 'wysiwyg',
                'media_upload' => 0,
            ),
            array(
                'key'          => 'field_brand_perche_scelto',
                'label'        => __('Perché HiFi Solution ha scelto questo brand', 'hifisolution'),
                'name'         => 'brand_perche_scelto',
                'type'         => 'wysiwyg',
                'media_upload' => 0,
            ),
            array(
                'key'          => 'field_brand_taxonomy_link',
                'label'        => __('Brand (Tassonomia)', 'hifisolution'),
                'name'         => 'brand_taxonomy_link',
                'type'         => 'taxonomy',
                'taxonomy'     => 'brand',
                'field_type'   => 'select',
                'return_format' => 'object',
                'instructions' => __('Seleziona il brand corrispondente per collegare i prodotti.', 'hifisolution'),
            ),
        ),
        'location' => array(
            array(
                array(
                    'param'    => 'post_type',
                    'operator' => '==',
                    'value'    => 'brand_page',
                ),
            ),
        ),
        'position'   => 'normal',
        'style'      => 'default',
        'menu_order'  => 0,
    ));
}
add_action('acf/init', 'hifisolution_register_acf_fields');

/**
 * Fallback: Meta box nativi se ACF non è installato.
 */
function hifisolution_add_native_metaboxes() {
    if (function_exists('acf_add_local_field_group')) {
        return;
    }

    add_meta_box(
        'hifi_prodotto_dettagli',
        __('Dettagli Prodotto', 'hifisolution'),
        'hifisolution_prodotto_metabox_callback',
        'prodotto',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'hifisolution_add_native_metaboxes');

/**
 * Callback per il meta box nativo del prodotto.
 */
function hifisolution_prodotto_metabox_callback($post) {
    wp_nonce_field('hifi_prodotto_meta', 'hifi_prodotto_nonce');

    $shop_url   = get_post_meta($post->ID, 'prodotto_shop_url', true);
    $prezzo     = get_post_meta($post->ID, 'prodotto_prezzo_indicativo', true);
    $sottotitolo = get_post_meta($post->ID, 'prodotto_sottotitolo', true);
    $in_evidenza = get_post_meta($post->ID, 'prodotto_in_evidenza', true);

    ?>
    <table class="form-table">
        <tr>
            <th><label for="prodotto_sottotitolo"><?php esc_html_e('Sottotitolo', 'hifisolution'); ?></label></th>
            <td><input type="text" id="prodotto_sottotitolo" name="prodotto_sottotitolo" value="<?php echo esc_attr($sottotitolo); ?>" class="regular-text"></td>
        </tr>
        <tr>
            <th><label for="prodotto_shop_url"><?php esc_html_e('Link allo Shop', 'hifisolution'); ?></label></th>
            <td><input type="url" id="prodotto_shop_url" name="prodotto_shop_url" value="<?php echo esc_url($shop_url); ?>" class="regular-text" required></td>
        </tr>
        <tr>
            <th><label for="prodotto_prezzo_indicativo"><?php esc_html_e('Prezzo Indicativo', 'hifisolution'); ?></label></th>
            <td><input type="text" id="prodotto_prezzo_indicativo" name="prodotto_prezzo_indicativo" value="<?php echo esc_attr($prezzo); ?>" class="regular-text"></td>
        </tr>
        <tr>
            <th><label for="prodotto_in_evidenza"><?php esc_html_e('In Evidenza', 'hifisolution'); ?></label></th>
            <td><label><input type="checkbox" id="prodotto_in_evidenza" name="prodotto_in_evidenza" value="1" <?php checked($in_evidenza, '1'); ?>> <?php esc_html_e('Mostra in home page', 'hifisolution'); ?></label></td>
        </tr>
    </table>
    <?php
}

/**
 * Salva i meta del prodotto (fallback nativo).
 */
function hifisolution_save_prodotto_meta($post_id) {
    if (function_exists('acf_add_local_field_group')) {
        return;
    }

    if (!isset($_POST['hifi_prodotto_nonce']) || !wp_verify_nonce($_POST['hifi_prodotto_nonce'], 'hifi_prodotto_meta')) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    $fields = array('prodotto_shop_url', 'prodotto_prezzo_indicativo', 'prodotto_sottotitolo');
    foreach ($fields as $field) {
        if (isset($_POST[$field])) {
            $value = $field === 'prodotto_shop_url'
                ? esc_url_raw(wp_unslash($_POST[$field]))
                : sanitize_text_field(wp_unslash($_POST[$field]));
            update_post_meta($post_id, $field, $value);
        }
    }

    $in_evidenza = isset($_POST['prodotto_in_evidenza']) ? '1' : '0';
    update_post_meta($post_id, 'prodotto_in_evidenza', $in_evidenza);
}
add_action('save_post_prodotto', 'hifisolution_save_prodotto_meta');
