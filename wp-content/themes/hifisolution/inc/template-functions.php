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
 *
 * Raccoglie le immagini da più fonti nell'ordine:
 * 1. Immagine in evidenza (featured / thumbnail)
 * 2. Immagini dal campo prodotto_galleria (ACF o post_meta)
 *
 * L'immagine in evidenza è sempre la prima, senza duplicati.
 */
function hifisolution_get_gallery($post_id = null) {
    if (!$post_id) {
        $post_id = get_the_ID();
    }

    $seen_ids = array();
    $images   = array();

    // Helper: converte un attachment ID in array immagine.
    $id_to_image = function ($img_id) use (&$seen_ids) {
        $img_id = (int) $img_id;
        if ($img_id <= 0 || isset($seen_ids[$img_id])) {
            return null;
        }
        $url = wp_get_attachment_url($img_id);
        if (!$url) {
            return null;
        }
        $seen_ids[$img_id] = true;
        return array(
            'ID'    => $img_id,
            'url'   => $url,
            'sizes' => array(
                'large'     => wp_get_attachment_image_url($img_id, 'large'),
                'thumbnail' => wp_get_attachment_image_url($img_id, 'thumbnail'),
            ),
            'alt' => get_post_meta($img_id, '_wp_attachment_image_alt', true),
        );
    };

    // 1. Immagine in evidenza — sempre prima.
    if (has_post_thumbnail($post_id)) {
        $thumb = $id_to_image(get_post_thumbnail_id($post_id));
        if ($thumb) {
            $images[] = $thumb;
        }
    }

    // 2. Galleria da ACF (se disponibile).
    $gallery_ids = array();

    if (function_exists('get_field')) {
        $acf_gallery = get_field('prodotto_galleria', $post_id);

        if (is_string($acf_gallery)) {
            $acf_gallery = maybe_unserialize($acf_gallery);
        }

        if (is_array($acf_gallery)) {
            foreach ($acf_gallery as $item) {
                if (is_array($item) && isset($item['ID'])) {
                    $gallery_ids[] = (int) $item['ID'];
                } elseif (is_array($item) && isset($item['url'])) {
                    // ACF restituisce array associativo completo.
                    if (!isset($seen_ids[$item['ID'] ?? 0])) {
                        $seen_ids[$item['ID'] ?? 0] = true;
                        $images[] = $item;
                    }
                } elseif (is_numeric($item)) {
                    $gallery_ids[] = (int) $item;
                }
            }
        }
    }

    // 3. Fallback: legge galleria da post_meta (valori salvati dall'import
    //    o quando ACF non trova il campo registrato).
    if (empty($gallery_ids)) {
        $gallery_meta = get_post_meta($post_id, 'prodotto_galleria', true);
        // Gestisce sia array nativi che stringhe serializzate (vecchio formato).
        if (is_string($gallery_meta) && $gallery_meta) {
            $gallery_meta = maybe_unserialize($gallery_meta);
        }
        if (is_array($gallery_meta)) {
            $gallery_ids = $gallery_meta;
        }
    }

    // Converte gli ID in array immagine (salta duplicati con featured).
    foreach ($gallery_ids as $gid) {
        $img = $id_to_image($gid);
        if ($img) {
            $images[] = $img;
        }
    }

    return $images;
}

/**
 * Restituisce le immagini delle varianti colore di un prodotto.
 *
 * Struttura restituita:
 * array(
 *     'variants' => array(
 *         array( 'name' => 'Nero', 'image' => array( 'url' => ..., 'sizes' => ..., 'alt' => ... ) ),
 *         array( 'name' => 'Silver', 'image' => array( ... ) ),
 *     ),
 *     'rear' => array( 'url' => ..., 'sizes' => ..., 'alt' => ... ) | null,
 * )
 *
 * Restituisce null se non ci sono varianti configurate.
 */
function hifisolution_get_variant_images($post_id = null) {
    if (!$post_id) {
        $post_id = get_the_ID();
    }

    $variants = array();
    $rear     = null;

    // Helper: converte un attachment ID in array immagine.
    $id_to_image = function ($img_id) {
        $img_id = (int) $img_id;
        if ($img_id <= 0) {
            return null;
        }
        $url = wp_get_attachment_url($img_id);
        if (!$url) {
            return null;
        }
        return array(
            'ID'    => $img_id,
            'url'   => $url,
            'sizes' => array(
                'large'     => wp_get_attachment_image_url($img_id, 'large'),
                'thumbnail' => wp_get_attachment_image_url($img_id, 'thumbnail'),
            ),
            'alt' => get_post_meta($img_id, '_wp_attachment_image_alt', true),
        );
    };

    if (function_exists('get_field')) {
        $acf_variants = get_field('prodotto_varianti_colore', $post_id);
        if (is_array($acf_variants) && !empty($acf_variants)) {
            foreach ($acf_variants as $row) {
                $name = isset($row['variante_nome']) ? trim($row['variante_nome']) : '';
                $img  = isset($row['variante_immagine_fronte']) ? $row['variante_immagine_fronte'] : null;

                if (!$name || !$img) {
                    continue;
                }

                // ACF può restituire array completo o solo ID.
                if (is_array($img) && isset($img['url'])) {
                    $image_data = $img;
                } elseif (is_numeric($img)) {
                    $image_data = $id_to_image((int) $img);
                } else {
                    continue;
                }

                if ($image_data) {
                    $variants[] = array(
                        'name'  => $name,
                        'image' => $image_data,
                    );
                }
            }
        }

        $acf_rear = get_field('prodotto_immagine_retro', $post_id);
        if ($acf_rear) {
            if (is_array($acf_rear) && isset($acf_rear['url'])) {
                $rear = $acf_rear;
            } elseif (is_numeric($acf_rear)) {
                $rear = $id_to_image((int) $acf_rear);
            }
        }
    }

    // Fallback senza ACF: legge da post_meta.
    if (empty($variants)) {
        $count = (int) get_post_meta($post_id, 'prodotto_varianti_colore', true);
        for ($i = 0; $i < $count; $i++) {
            $name   = get_post_meta($post_id, "prodotto_varianti_colore_{$i}_variante_nome", true);
            $img_id = (int) get_post_meta($post_id, "prodotto_varianti_colore_{$i}_variante_immagine_fronte", true);
            if ($name && $img_id) {
                $image_data = $id_to_image($img_id);
                if ($image_data) {
                    $variants[] = array(
                        'name'  => $name,
                        'image' => $image_data,
                    );
                }
            }
        }

        $rear_id = (int) get_post_meta($post_id, 'prodotto_immagine_retro', true);
        if ($rear_id) {
            $rear = $id_to_image($rear_id);
        }
    }

    if (empty($variants)) {
        return null;
    }

    return array(
        'variants' => $variants,
        'rear'     => $rear,
    );
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
