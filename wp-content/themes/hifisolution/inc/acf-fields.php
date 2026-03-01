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
            array(
                'key'          => 'field_prodotto_finiture',
                'label'        => __('Finiture Disponibili', 'hifisolution'),
                'name'         => 'prodotto_finiture',
                'type'         => 'text',
                'instructions' => __('Finiture disponibili separate da virgola (es. "Silver, Black, Rosenut")', 'hifisolution'),
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

    // ---- Gruppo: Immagini Varianti Colore ----
    acf_add_local_field_group(array(
        'key'    => 'group_prodotto_varianti_immagini',
        'title'  => __('Immagini Varianti Colore', 'hifisolution'),
        'fields' => array(
            array(
                'key'          => 'field_prodotto_varianti_colore',
                'label'        => __('Varianti Colore', 'hifisolution'),
                'name'         => 'prodotto_varianti_colore',
                'type'         => 'repeater',
                'instructions' => __('Aggiungi una variante per ogni colore disponibile. Per ciascuna, carica l\'immagine frontale del prodotto in quel colore.', 'hifisolution'),
                'layout'       => 'block',
                'button_label' => __('Aggiungi Variante Colore', 'hifisolution'),
                'min'          => 0,
                'max'          => 10,
                'sub_fields'   => array(
                    array(
                        'key'          => 'field_variante_nome',
                        'label'        => __('Nome Colore', 'hifisolution'),
                        'name'         => 'variante_nome',
                        'type'         => 'text',
                        'instructions' => __('Es. "Nero", "Silver", "Rosenut"', 'hifisolution'),
                        'required'     => 1,
                    ),
                    array(
                        'key'          => 'field_variante_immagine_fronte',
                        'label'        => __('Immagine Frontale', 'hifisolution'),
                        'name'         => 'variante_immagine_fronte',
                        'type'         => 'image',
                        'instructions' => __('Immagine del prodotto visto da davanti in questo colore.', 'hifisolution'),
                        'return_format' => 'array',
                        'preview_size'  => 'medium',
                        'library'       => 'all',
                        'required'     => 1,
                    ),
                ),
            ),
            array(
                'key'          => 'field_prodotto_immagine_retro',
                'label'        => __('Immagine Retro', 'hifisolution'),
                'name'         => 'prodotto_immagine_retro',
                'type'         => 'image',
                'instructions' => __('Immagine del retro del prodotto (comune a tutte le varianti colore).', 'hifisolution'),
                'return_format' => 'array',
                'preview_size'  => 'medium',
                'library'       => 'all',
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
                'instructions' => __('Galleria aggiuntiva (usata come fallback se non ci sono varianti colore). La prima sarà usata come immagine principale se non è impostata l\'immagine in evidenza.', 'hifisolution'),
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
        'menu_order' => 2,
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
        'menu_order'  => 3,
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
        'menu_order'  => 4,
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

    add_meta_box(
        'hifi_prodotto_varianti',
        __('Immagini Varianti Colore', 'hifisolution'),
        'hifisolution_prodotto_varianti_callback',
        'prodotto',
        'normal',
        'high'
    );

    add_meta_box(
        'hifi_prodotto_galleria',
        __('Galleria Immagini', 'hifisolution'),
        'hifisolution_prodotto_galleria_callback',
        'prodotto',
        'normal',
        'default'
    );

    add_meta_box(
        'hifi_prodotto_specifiche',
        __('Specifiche Tecniche', 'hifisolution'),
        'hifisolution_prodotto_specifiche_callback',
        'prodotto',
        'normal',
        'default'
    );
}
add_action('add_meta_boxes', 'hifisolution_add_native_metaboxes');

/**
 * Callback per il meta box nativo del prodotto.
 */
function hifisolution_prodotto_metabox_callback($post) {
    wp_nonce_field('hifi_prodotto_meta', 'hifi_prodotto_nonce');

    $shop_url    = get_post_meta($post->ID, 'prodotto_shop_url', true);
    $prezzo      = get_post_meta($post->ID, 'prodotto_prezzo_indicativo', true);
    $sottotitolo = get_post_meta($post->ID, 'prodotto_sottotitolo', true);
    $in_evidenza = get_post_meta($post->ID, 'prodotto_in_evidenza', true);
    $novita      = get_post_meta($post->ID, 'prodotto_novita', true);

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
        <tr>
            <th><label for="prodotto_novita"><?php esc_html_e('Novità', 'hifisolution'); ?></label></th>
            <td><label><input type="checkbox" id="prodotto_novita" name="prodotto_novita" value="1" <?php checked($novita, '1'); ?>> <?php esc_html_e('Contrassegna come novità', 'hifisolution'); ?></label></td>
        </tr>
        <tr>
            <th><label for="prodotto_finiture"><?php esc_html_e('Finiture Disponibili', 'hifisolution'); ?></label></th>
            <td>
                <input type="text" id="prodotto_finiture" name="prodotto_finiture" value="<?php echo esc_attr(get_post_meta($post->ID, 'prodotto_finiture', true)); ?>" class="regular-text">
                <p class="description"><?php esc_html_e('Finiture separate da virgola (es. "Silver, Black, Rosenut")', 'hifisolution'); ?></p>
            </td>
        </tr>
    </table>
    <?php
}

/**
 * Callback per il meta box Galleria Immagini (nativo).
 */
function hifisolution_prodotto_galleria_callback($post) {
    $gallery_meta = get_post_meta($post->ID, 'prodotto_galleria', true);
    $gallery_ids  = $gallery_meta ? maybe_unserialize($gallery_meta) : array();
    if (!is_array($gallery_ids)) {
        $gallery_ids = array();
    }
    ?>
    <div id="hifi-gallery-wrap">
        <ul id="hifi-gallery-list" style="display:flex; flex-wrap:wrap; gap:10px; list-style:none; padding:0; margin:0 0 10px;">
            <?php foreach ($gallery_ids as $img_id) :
                $img_url = wp_get_attachment_image_url($img_id, 'thumbnail');
                if (!$img_url) continue;
            ?>
                <li data-id="<?php echo esc_attr($img_id); ?>" style="position:relative; cursor:move;">
                    <img src="<?php echo esc_url($img_url); ?>" style="width:80px; height:80px; object-fit:cover; border:1px solid #ddd; border-radius:4px;">
                    <button type="button" class="hifi-gallery-remove" data-id="<?php echo esc_attr($img_id); ?>" style="position:absolute; top:-6px; right:-6px; background:#dc3232; color:#fff; border:none; border-radius:50%; width:20px; height:20px; cursor:pointer; font-size:14px; line-height:1;">&times;</button>
                    <input type="hidden" name="prodotto_galleria[]" value="<?php echo esc_attr($img_id); ?>">
                </li>
            <?php endforeach; ?>
        </ul>
        <button type="button" id="hifi-gallery-add" class="button"><?php esc_html_e('Aggiungi Immagini', 'hifisolution'); ?></button>
    </div>
    <script>
    jQuery(function($){
        var frame;
        $('#hifi-gallery-add').on('click', function(e){
            e.preventDefault();
            if (frame) { frame.open(); return; }
            frame = wp.media({
                title: '<?php echo esc_js(__('Seleziona immagini', 'hifisolution')); ?>',
                multiple: true,
                library: { type: 'image' }
            });
            frame.on('select', function(){
                var attachments = frame.state().get('selection').toJSON();
                $.each(attachments, function(i, att){
                    var exists = $('#hifi-gallery-list input[value="'+att.id+'"]').length;
                    if (exists) return;
                    var thumb = att.sizes && att.sizes.thumbnail ? att.sizes.thumbnail.url : att.url;
                    var li = '<li data-id="'+att.id+'" style="position:relative; cursor:move;">' +
                        '<img src="'+thumb+'" style="width:80px; height:80px; object-fit:cover; border:1px solid #ddd; border-radius:4px;">' +
                        '<button type="button" class="hifi-gallery-remove" data-id="'+att.id+'" style="position:absolute; top:-6px; right:-6px; background:#dc3232; color:#fff; border:none; border-radius:50%; width:20px; height:20px; cursor:pointer; font-size:14px; line-height:1;">&times;</button>' +
                        '<input type="hidden" name="prodotto_galleria[]" value="'+att.id+'">' +
                        '</li>';
                    $('#hifi-gallery-list').append(li);
                });
            });
            frame.open();
        });
        $(document).on('click', '.hifi-gallery-remove', function(e){
            e.preventDefault();
            $(this).closest('li').remove();
        });
        $('#hifi-gallery-list').sortable({ placeholder: 'ui-state-highlight' });
    });
    </script>
    <?php
}

/**
 * Callback per il meta box Immagini Varianti Colore (nativo).
 */
function hifisolution_prodotto_varianti_callback($post) {
    $count = (int) get_post_meta($post->ID, 'prodotto_varianti_colore', true);
    $variants = array();
    for ($i = 0; $i < $count; $i++) {
        $name   = get_post_meta($post->ID, "prodotto_varianti_colore_{$i}_variante_nome", true);
        $img_id = (int) get_post_meta($post->ID, "prodotto_varianti_colore_{$i}_variante_immagine_fronte", true);
        $variants[] = array('name' => $name, 'img_id' => $img_id);
    }
    $rear_id = (int) get_post_meta($post->ID, 'prodotto_immagine_retro', true);
    ?>
    <p class="description" style="margin-bottom:12px;">
        <?php esc_html_e('Aggiungi una variante per ogni colore disponibile con la relativa immagine frontale. Puoi anche aggiungere un\'immagine del retro comune a tutte le varianti.', 'hifisolution'); ?>
    </p>

    <table id="hifi-variants-table" style="width:100%; border-collapse:collapse; margin-bottom:16px;">
        <thead>
            <tr>
                <th style="text-align:left; padding:6px;"><?php esc_html_e('Nome Colore', 'hifisolution'); ?></th>
                <th style="text-align:left; padding:6px;"><?php esc_html_e('Immagine Frontale', 'hifisolution'); ?></th>
                <th style="width:40px;"></th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($variants)) : foreach ($variants as $vi => $variant) :
                $thumb_url = $variant['img_id'] ? wp_get_attachment_image_url($variant['img_id'], 'thumbnail') : '';
            ?>
                <tr>
                    <td style="padding:4px;">
                        <input type="text" name="hifi_variante_nome[]" value="<?php echo esc_attr($variant['name']); ?>" class="regular-text" style="width:100%;" placeholder="<?php esc_attr_e('Es. Nero, Silver...', 'hifisolution'); ?>">
                    </td>
                    <td style="padding:4px;">
                        <div style="display:flex; align-items:center; gap:8px;">
                            <?php if ($thumb_url) : ?>
                                <img src="<?php echo esc_url($thumb_url); ?>" class="hifi-variant-preview" style="width:60px; height:60px; object-fit:cover; border:1px solid #ddd; border-radius:4px;">
                            <?php else : ?>
                                <img src="" class="hifi-variant-preview" style="width:60px; height:60px; object-fit:cover; border:1px solid #ddd; border-radius:4px; display:none;">
                            <?php endif; ?>
                            <input type="hidden" name="hifi_variante_img[]" value="<?php echo esc_attr($variant['img_id']); ?>" class="hifi-variant-img-id">
                            <button type="button" class="button hifi-variant-select-img"><?php esc_html_e('Seleziona', 'hifisolution'); ?></button>
                        </div>
                    </td>
                    <td style="padding:4px;"><button type="button" class="button hifi-variant-remove">&times;</button></td>
                </tr>
            <?php endforeach; endif; ?>
        </tbody>
    </table>
    <p><button type="button" id="hifi-variant-add" class="button"><?php esc_html_e('Aggiungi Variante Colore', 'hifisolution'); ?></button></p>

    <hr style="margin:20px 0;">
    <h4 style="margin-bottom:8px;"><?php esc_html_e('Immagine Retro (comune)', 'hifisolution'); ?></h4>
    <div style="display:flex; align-items:center; gap:12px;">
        <?php
        $rear_thumb = $rear_id ? wp_get_attachment_image_url($rear_id, 'thumbnail') : '';
        ?>
        <?php if ($rear_thumb) : ?>
            <img src="<?php echo esc_url($rear_thumb); ?>" id="hifi-rear-preview" style="width:80px; height:80px; object-fit:cover; border:1px solid #ddd; border-radius:4px;">
        <?php else : ?>
            <img src="" id="hifi-rear-preview" style="width:80px; height:80px; object-fit:cover; border:1px solid #ddd; border-radius:4px; display:none;">
        <?php endif; ?>
        <input type="hidden" name="hifi_retro_img" id="hifi-retro-img-id" value="<?php echo esc_attr($rear_id); ?>">
        <button type="button" id="hifi-rear-select" class="button"><?php esc_html_e('Seleziona immagine retro', 'hifisolution'); ?></button>
        <?php if ($rear_id) : ?>
            <button type="button" id="hifi-rear-remove" class="button">&times;</button>
        <?php else : ?>
            <button type="button" id="hifi-rear-remove" class="button" style="display:none;">&times;</button>
        <?php endif; ?>
    </div>

    <script>
    jQuery(function($){
        // Aggiungi variante
        $('#hifi-variant-add').on('click', function(){
            var row = '<tr>' +
                '<td style="padding:4px;"><input type="text" name="hifi_variante_nome[]" value="" class="regular-text" style="width:100%;" placeholder="<?php echo esc_js(__('Es. Nero, Silver...', 'hifisolution')); ?>"></td>' +
                '<td style="padding:4px;"><div style="display:flex; align-items:center; gap:8px;">' +
                '<img src="" class="hifi-variant-preview" style="width:60px; height:60px; object-fit:cover; border:1px solid #ddd; border-radius:4px; display:none;">' +
                '<input type="hidden" name="hifi_variante_img[]" value="" class="hifi-variant-img-id">' +
                '<button type="button" class="button hifi-variant-select-img"><?php echo esc_js(__('Seleziona', 'hifisolution')); ?></button>' +
                '</div></td>' +
                '<td style="padding:4px;"><button type="button" class="button hifi-variant-remove">&times;</button></td>' +
                '</tr>';
            $('#hifi-variants-table tbody').append(row);
        });

        // Rimuovi variante
        $(document).on('click', '.hifi-variant-remove', function(){
            $(this).closest('tr').remove();
        });

        // Seleziona immagine variante
        $(document).on('click', '.hifi-variant-select-img', function(e){
            e.preventDefault();
            var btn = $(this);
            var frame = wp.media({ title: '<?php echo esc_js(__('Seleziona immagine frontale', 'hifisolution')); ?>', multiple: false, library: { type: 'image' } });
            frame.on('select', function(){
                var att = frame.state().get('selection').first().toJSON();
                var thumb = att.sizes && att.sizes.thumbnail ? att.sizes.thumbnail.url : att.url;
                btn.siblings('.hifi-variant-img-id').val(att.id);
                btn.siblings('.hifi-variant-preview').attr('src', thumb).show();
            });
            frame.open();
        });

        // Seleziona immagine retro
        $('#hifi-rear-select').on('click', function(e){
            e.preventDefault();
            var frame = wp.media({ title: '<?php echo esc_js(__('Seleziona immagine retro', 'hifisolution')); ?>', multiple: false, library: { type: 'image' } });
            frame.on('select', function(){
                var att = frame.state().get('selection').first().toJSON();
                var thumb = att.sizes && att.sizes.thumbnail ? att.sizes.thumbnail.url : att.url;
                $('#hifi-retro-img-id').val(att.id);
                $('#hifi-rear-preview').attr('src', thumb).show();
                $('#hifi-rear-remove').show();
            });
            frame.open();
        });

        // Rimuovi immagine retro
        $('#hifi-rear-remove').on('click', function(){
            $('#hifi-retro-img-id').val('');
            $('#hifi-rear-preview').hide();
            $(this).hide();
        });
    });
    </script>
    <?php
}

/**
 * Callback per il meta box Specifiche Tecniche (nativo).
 */
function hifisolution_prodotto_specifiche_callback($post) {
    $count = (int) get_post_meta($post->ID, 'prodotto_specifiche', true);
    $specs = array();
    for ($i = 0; $i < $count; $i++) {
        $name  = get_post_meta($post->ID, "prodotto_specifiche_{$i}_specifica_nome", true);
        $value = get_post_meta($post->ID, "prodotto_specifiche_{$i}_specifica_valore", true);
        if ($name || $value) {
            $specs[] = array('name' => $name, 'value' => $value);
        }
    }
    ?>
    <table id="hifi-specs-table" style="width:100%; border-collapse:collapse;">
        <thead>
            <tr>
                <th style="text-align:left; padding:6px;"><?php esc_html_e('Specifica', 'hifisolution'); ?></th>
                <th style="text-align:left; padding:6px;"><?php esc_html_e('Valore', 'hifisolution'); ?></th>
                <th style="width:40px;"></th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($specs)) : foreach ($specs as $spec) : ?>
                <tr>
                    <td style="padding:4px;"><input type="text" name="hifi_spec_nome[]" value="<?php echo esc_attr($spec['name']); ?>" class="regular-text" style="width:100%;"></td>
                    <td style="padding:4px;"><input type="text" name="hifi_spec_valore[]" value="<?php echo esc_attr($spec['value']); ?>" class="regular-text" style="width:100%;"></td>
                    <td style="padding:4px;"><button type="button" class="button hifi-spec-remove">&times;</button></td>
                </tr>
            <?php endforeach; endif; ?>
        </tbody>
    </table>
    <p><button type="button" id="hifi-spec-add" class="button"><?php esc_html_e('Aggiungi Specifica', 'hifisolution'); ?></button></p>
    <script>
    jQuery(function($){
        $('#hifi-spec-add').on('click', function(){
            var row = '<tr>' +
                '<td style="padding:4px;"><input type="text" name="hifi_spec_nome[]" value="" class="regular-text" style="width:100%;"></td>' +
                '<td style="padding:4px;"><input type="text" name="hifi_spec_valore[]" value="" class="regular-text" style="width:100%;"></td>' +
                '<td style="padding:4px;"><button type="button" class="button hifi-spec-remove">&times;</button></td>' +
                '</tr>';
            $('#hifi-specs-table tbody').append(row);
        });
        $(document).on('click', '.hifi-spec-remove', function(){
            $(this).closest('tr').remove();
        });
    });
    </script>
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

    $fields = array('prodotto_shop_url', 'prodotto_prezzo_indicativo', 'prodotto_sottotitolo', 'prodotto_finiture');
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

    $novita = isset($_POST['prodotto_novita']) ? '1' : '0';
    update_post_meta($post_id, 'prodotto_novita', $novita);

    // Varianti colore.
    $old_variant_count = (int) get_post_meta($post_id, 'prodotto_varianti_colore', true);
    for ($i = 0; $i < $old_variant_count; $i++) {
        delete_post_meta($post_id, "prodotto_varianti_colore_{$i}_variante_nome");
        delete_post_meta($post_id, "prodotto_varianti_colore_{$i}_variante_immagine_fronte");
    }

    if (isset($_POST['hifi_variante_nome']) && is_array($_POST['hifi_variante_nome'])) {
        $var_names = array_map('sanitize_text_field', wp_unslash($_POST['hifi_variante_nome']));
        $var_imgs  = isset($_POST['hifi_variante_img']) ? array_map('absint', $_POST['hifi_variante_img']) : array();
        $var_index = 0;
        foreach ($var_names as $k => $vname) {
            if (empty($vname) || empty($var_imgs[$k])) continue;
            update_post_meta($post_id, "prodotto_varianti_colore_{$var_index}_variante_nome", $vname);
            update_post_meta($post_id, "prodotto_varianti_colore_{$var_index}_variante_immagine_fronte", $var_imgs[$k]);
            $var_index++;
        }
        update_post_meta($post_id, 'prodotto_varianti_colore', $var_index);
    } else {
        update_post_meta($post_id, 'prodotto_varianti_colore', 0);
    }

    // Immagine retro.
    if (isset($_POST['hifi_retro_img']) && absint($_POST['hifi_retro_img']) > 0) {
        update_post_meta($post_id, 'prodotto_immagine_retro', absint($_POST['hifi_retro_img']));
    } else {
        delete_post_meta($post_id, 'prodotto_immagine_retro');
    }

    // Galleria immagini.
    if (isset($_POST['prodotto_galleria'])) {
        $gallery_ids = array_map('absint', (array) $_POST['prodotto_galleria']);
        $gallery_ids = array_filter($gallery_ids);
        update_post_meta($post_id, 'prodotto_galleria', $gallery_ids);
    } else {
        delete_post_meta($post_id, 'prodotto_galleria');
    }

    // Specifiche tecniche.
    // Pulizia vecchie specifiche.
    $old_count = (int) get_post_meta($post_id, 'prodotto_specifiche', true);
    for ($i = 0; $i < $old_count; $i++) {
        delete_post_meta($post_id, "prodotto_specifiche_{$i}_specifica_nome");
        delete_post_meta($post_id, "prodotto_specifiche_{$i}_specifica_valore");
    }

    if (isset($_POST['hifi_spec_nome']) && is_array($_POST['hifi_spec_nome'])) {
        $names  = array_map('sanitize_text_field', wp_unslash($_POST['hifi_spec_nome']));
        $values = isset($_POST['hifi_spec_valore']) ? array_map('sanitize_text_field', wp_unslash($_POST['hifi_spec_valore'])) : array();
        $index  = 0;
        foreach ($names as $k => $name) {
            if (empty($name)) continue;
            update_post_meta($post_id, "prodotto_specifiche_{$index}_specifica_nome", $name);
            update_post_meta($post_id, "prodotto_specifiche_{$index}_specifica_valore", $values[$k] ?? '');
            $index++;
        }
        update_post_meta($post_id, 'prodotto_specifiche', $index);
    } else {
        update_post_meta($post_id, 'prodotto_specifiche', 0);
    }
}
add_action('save_post_prodotto', 'hifisolution_save_prodotto_meta');
