<?php
/**
 * Template Functions — Funzioni helper per i template.
 *
 * @package HiFiSolution
 */

defined('ABSPATH') || exit;

/**
 * Restituisce il link allo shop per un prodotto.
 */
function hifisolution_get_shop_url($post_id = null) {
    if (!$post_id) {
        $post_id = get_the_ID();
    }

    $url = '';
    if (function_exists('get_field')) {
        $url = get_field('prodotto_shop_url', $post_id);
    } else {
        $url = get_post_meta($post_id, 'prodotto_shop_url', true);
    }

    return $url ? $url : HIFISOLUTION_SHOP_URL;
}

/**
 * Restituisce il prezzo indicativo di un prodotto.
 */
function hifisolution_get_price($post_id = null) {
    if (!$post_id) {
        $post_id = get_the_ID();
    }

    if (function_exists('get_field')) {
        return get_field('prodotto_prezzo_indicativo', $post_id);
    }

    return get_post_meta($post_id, 'prodotto_prezzo_indicativo', true);
}

/**
 * Restituisce le specifiche tecniche di un prodotto.
 */
function hifisolution_get_specs($post_id = null) {
    if (!$post_id) {
        $post_id = get_the_ID();
    }

    $specs = array();

    if (function_exists('get_field')) {
        $rows = get_field('prodotto_specifiche', $post_id);
        if (is_string($rows)) {
            $rows = maybe_unserialize($rows);
        }
        if (is_array($rows)) {
            foreach ($rows as $row) {
                if (is_array($row) && isset($row['specifica_nome'])) {
                    $specs[] = array(
                        'name'  => $row['specifica_nome'],
                        'value' => $row['specifica_valore'] ?? '',
                    );
                }
            }
        }
    }

    // Fallback senza ACF: legge il repeater direttamente da post_meta.
    if (empty($specs)) {
        $count = (int) get_post_meta($post_id, 'prodotto_specifiche', true);
        for ($i = 0; $i < $count; $i++) {
            $name  = get_post_meta($post_id, "prodotto_specifiche_{$i}_specifica_nome", true);
            $value = get_post_meta($post_id, "prodotto_specifiche_{$i}_specifica_valore", true);
            if ($name) {
                $specs[] = array(
                    'name'  => $name,
                    'value' => $value,
                );
            }
        }
    }

    return $specs;
}

/**
 * Restituisce la galleria immagini di un prodotto.
 */
function hifisolution_get_gallery($post_id = null) {
    if (!$post_id) {
        $post_id = get_the_ID();
    }

    $images = array();

    if (function_exists('get_field')) {
        $gallery = get_field('prodotto_galleria', $post_id);

        // get_field può restituire una stringa serializzata se i field group
        // non sono registrati correttamente — deserializziamo manualmente.
        if (is_string($gallery)) {
            $gallery = maybe_unserialize($gallery);
        }

        // Se è un array di ID (non di array associativi), convertiamo.
        if (is_array($gallery)) {
            $normalized = array();
            foreach ($gallery as $item) {
                if (is_array($item) && isset($item['url'])) {
                    $normalized[] = $item;
                } elseif (is_numeric($item)) {
                    $img_id = (int) $item;
                    $normalized[] = array(
                        'ID'    => $img_id,
                        'url'   => wp_get_attachment_url($img_id),
                        'sizes' => array(
                            'large'     => wp_get_attachment_image_url($img_id, 'large'),
                            'thumbnail' => wp_get_attachment_image_url($img_id, 'thumbnail'),
                        ),
                        'alt' => get_post_meta($img_id, '_wp_attachment_image_alt', true),
                    );
                }
            }
            if (!empty($normalized)) {
                return $normalized;
            }
        }
    }

    // Fallback senza ACF: legge galleria da post_meta.
    $gallery_meta = get_post_meta($post_id, 'prodotto_galleria', true);
    if ($gallery_meta) {
        $gallery_ids = maybe_unserialize($gallery_meta);
        if (is_array($gallery_ids)) {
            // Featured image prima.
            if (has_post_thumbnail($post_id)) {
                $thumb_id = get_post_thumbnail_id($post_id);
                $images[] = array(
                    'ID'    => $thumb_id,
                    'url'   => wp_get_attachment_url($thumb_id),
                    'sizes' => array(
                        'large'     => wp_get_attachment_image_url($thumb_id, 'large'),
                        'thumbnail' => wp_get_attachment_image_url($thumb_id, 'thumbnail'),
                    ),
                    'alt' => get_post_meta($thumb_id, '_wp_attachment_image_alt', true),
                );
            }
            foreach ($gallery_ids as $img_id) {
                $images[] = array(
                    'ID'    => $img_id,
                    'url'   => wp_get_attachment_url($img_id),
                    'sizes' => array(
                        'large'     => wp_get_attachment_image_url($img_id, 'large'),
                        'thumbnail' => wp_get_attachment_image_url($img_id, 'thumbnail'),
                    ),
                    'alt' => get_post_meta($img_id, '_wp_attachment_image_alt', true),
                );
            }
            return $images;
        }
    }

    // Fallback finale: solo immagine in evidenza.
    if (has_post_thumbnail($post_id)) {
        $thumb_id = get_post_thumbnail_id($post_id);
        $images[] = array(
            'ID'    => $thumb_id,
            'url'   => wp_get_attachment_url($thumb_id),
            'sizes' => array(
                'large'     => wp_get_attachment_image_url($thumb_id, 'large'),
                'thumbnail' => wp_get_attachment_image_url($thumb_id, 'thumbnail'),
            ),
            'alt'   => get_post_meta($thumb_id, '_wp_attachment_image_alt', true),
        );
    }

    return $images;
}

/**
 * Restituisce il nome del brand di un prodotto.
 */
function hifisolution_get_brand_name($post_id = null) {
    if (!$post_id) {
        $post_id = get_the_ID();
    }

    $brands = get_the_terms($post_id, 'brand');
    if ($brands && !is_wp_error($brands)) {
        return $brands[0]->name;
    }

    return '';
}

/**
 * Restituisce il nome della categoria di un prodotto.
 */
function hifisolution_get_category_name($post_id = null) {
    if (!$post_id) {
        $post_id = get_the_ID();
    }

    $categories = get_the_terms($post_id, 'categoria_prodotto');
    if ($categories && !is_wp_error($categories)) {
        return $categories[0]->name;
    }

    return '';
}

/**
 * Verifica se un prodotto è in evidenza.
 */
function hifisolution_is_featured($post_id = null) {
    if (!$post_id) {
        $post_id = get_the_ID();
    }

    if (function_exists('get_field')) {
        return (bool) get_field('prodotto_in_evidenza', $post_id);
    }

    return (bool) get_post_meta($post_id, 'prodotto_in_evidenza', true);
}

/**
 * Verifica se un prodotto è una novità.
 */
function hifisolution_is_new($post_id = null) {
    if (!$post_id) {
        $post_id = get_the_ID();
    }

    if (function_exists('get_field')) {
        return (bool) get_field('prodotto_novita', $post_id);
    }

    return (bool) get_post_meta($post_id, 'prodotto_novita', true);
}

/**
 * Query per i prodotti in evidenza.
 */
function hifisolution_get_featured_products($count = 8) {
    return new WP_Query(array(
        'post_type'      => 'prodotto',
        'posts_per_page' => $count,
        'meta_query'     => array(
            array(
                'key'     => 'prodotto_in_evidenza',
                'value'   => '1',
                'compare' => '=',
            ),
        ),
    ));
}

/**
 * Query per i prodotti di un brand specifico.
 */
function hifisolution_get_brand_products($brand_slug, $count = 12) {
    return new WP_Query(array(
        'post_type'      => 'prodotto',
        'posts_per_page' => $count,
        'tax_query'      => array(
            array(
                'taxonomy' => 'brand',
                'field'    => 'slug',
                'terms'    => $brand_slug,
            ),
        ),
    ));
}

/**
 * Query per i prodotti correlati.
 */
function hifisolution_get_related_products($post_id = null, $count = 4) {
    if (!$post_id) {
        $post_id = get_the_ID();
    }

    $tax_query = array('relation' => 'OR');

    $brands = get_the_terms($post_id, 'brand');
    if ($brands && !is_wp_error($brands)) {
        $tax_query[] = array(
            'taxonomy' => 'brand',
            'field'    => 'term_id',
            'terms'    => wp_list_pluck($brands, 'term_id'),
        );
    }

    $categories = get_the_terms($post_id, 'categoria_prodotto');
    if ($categories && !is_wp_error($categories)) {
        $tax_query[] = array(
            'taxonomy' => 'categoria_prodotto',
            'field'    => 'term_id',
            'terms'    => wp_list_pluck($categories, 'term_id'),
        );
    }

    return new WP_Query(array(
        'post_type'      => 'prodotto',
        'posts_per_page' => $count,
        'post__not_in'   => array($post_id),
        'tax_query'      => $tax_query,
        'orderby'        => 'rand',
    ));
}

/**
 * Handler AJAX per il filtro prodotti nel catalogo.
 */
function hifisolution_filter_products_ajax() {
    check_ajax_referer('hifi_nonce', 'nonce');

    $args = array(
        'post_type'      => 'prodotto',
        'posts_per_page' => 12,
        'paged'          => isset($_POST['page']) ? absint($_POST['page']) : 1,
    );

    $tax_query = array();

    if (!empty($_POST['categoria'])) {
        $tax_query[] = array(
            'taxonomy' => 'categoria_prodotto',
            'field'    => 'slug',
            'terms'    => sanitize_text_field(wp_unslash($_POST['categoria'])),
        );
    }

    if (!empty($_POST['brand'])) {
        $tax_query[] = array(
            'taxonomy' => 'brand',
            'field'    => 'slug',
            'terms'    => sanitize_text_field(wp_unslash($_POST['brand'])),
        );
    }

    if (!empty($_POST['fascia_prezzo'])) {
        $tax_query[] = array(
            'taxonomy' => 'fascia_prezzo',
            'field'    => 'slug',
            'terms'    => sanitize_text_field(wp_unslash($_POST['fascia_prezzo'])),
        );
    }

    if (!empty($tax_query)) {
        $args['tax_query'] = $tax_query;
    }

    $query = new WP_Query($args);

    ob_start();

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            get_template_part('template-parts/content', 'prodotto-card');
        }
    } else {
        echo '<p class="hifi-text-center hifi-text-muted">' . esc_html__('Nessun prodotto trovato con i filtri selezionati.', 'hifisolution') . '</p>';
    }

    wp_reset_postdata();

    $html = ob_get_clean();

    wp_send_json_success(array(
        'html'       => $html,
        'found'      => $query->found_posts,
        'max_pages'  => $query->max_num_pages,
    ));
}
add_action('wp_ajax_hifi_filter_products', 'hifisolution_filter_products_ajax');
add_action('wp_ajax_nopriv_hifi_filter_products', 'hifisolution_filter_products_ajax');
