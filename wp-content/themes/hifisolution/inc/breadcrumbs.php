<?php
/**
 * Breadcrumbs — Navigazione a briciole di pane.
 *
 * @package HiFiSolution
 */

defined('ABSPATH') || exit;

/**
 * Restituisce l'array degli elementi del breadcrumb.
 */
function hifisolution_get_breadcrumb_items() {
    $items = array();

    // Home
    $items[] = array(
        'title' => __('Home', 'hifisolution'),
        'url'   => home_url('/'),
    );

    if (is_singular('prodotto')) {
        global $post;

        // Catalogo
        $items[] = array(
            'title' => __('Catalogo', 'hifisolution'),
            'url'   => get_post_type_archive_link('prodotto'),
        );

        // Categoria
        $categories = get_the_terms($post->ID, 'categoria_prodotto');
        if ($categories && !is_wp_error($categories)) {
            $cat = $categories[0];
            $items[] = array(
                'title' => $cat->name,
                'url'   => get_term_link($cat),
            );
        }

        // Brand
        $brands = get_the_terms($post->ID, 'brand');
        if ($brands && !is_wp_error($brands)) {
            $brand = $brands[0];
            $items[] = array(
                'title' => $brand->name,
                'url'   => get_term_link($brand),
            );
        }

        // Prodotto corrente
        $items[] = array(
            'title' => get_the_title(),
            'url'   => '',
        );

    } elseif (is_post_type_archive('prodotto')) {
        $items[] = array(
            'title' => __('Catalogo', 'hifisolution'),
            'url'   => '',
        );

    } elseif (is_tax('categoria_prodotto')) {
        $items[] = array(
            'title' => __('Catalogo', 'hifisolution'),
            'url'   => get_post_type_archive_link('prodotto'),
        );

        $term = get_queried_object();
        if ($term->parent) {
            $parent = get_term($term->parent, 'categoria_prodotto');
            $items[] = array(
                'title' => $parent->name,
                'url'   => get_term_link($parent),
            );
        }

        $items[] = array(
            'title' => $term->name,
            'url'   => '',
        );

    } elseif (is_tax('brand')) {
        $items[] = array(
            'title' => __('Catalogo', 'hifisolution'),
            'url'   => get_post_type_archive_link('prodotto'),
        );

        $term = get_queried_object();
        $items[] = array(
            'title' => $term->name,
            'url'   => '',
        );

    } elseif (is_singular('brand_page')) {
        $items[] = array(
            'title' => __('I Nostri Marchi', 'hifisolution'),
            'url'   => get_post_type_archive_link('brand_page'),
        );
        $items[] = array(
            'title' => get_the_title(),
            'url'   => '',
        );

    } elseif (is_post_type_archive('brand_page')) {
        $items[] = array(
            'title' => __('I Nostri Marchi', 'hifisolution'),
            'url'   => '',
        );

    } elseif (is_singular('post')) {
        $items[] = array(
            'title' => __('Blog', 'hifisolution'),
            'url'   => get_permalink(get_option('page_for_posts')),
        );

        $categories = get_the_category();
        if ($categories) {
            $items[] = array(
                'title' => $categories[0]->name,
                'url'   => get_category_link($categories[0]->term_id),
            );
        }

        $items[] = array(
            'title' => get_the_title(),
            'url'   => '',
        );

    } elseif (is_category()) {
        $items[] = array(
            'title' => __('Blog', 'hifisolution'),
            'url'   => get_permalink(get_option('page_for_posts')),
        );
        $items[] = array(
            'title' => single_cat_title('', false),
            'url'   => '',
        );

    } elseif (is_page()) {
        global $post;
        if ($post->post_parent) {
            $ancestors = get_post_ancestors($post->ID);
            $ancestors = array_reverse($ancestors);
            foreach ($ancestors as $ancestor_id) {
                $items[] = array(
                    'title' => get_the_title($ancestor_id),
                    'url'   => get_permalink($ancestor_id),
                );
            }
        }
        $items[] = array(
            'title' => get_the_title(),
            'url'   => '',
        );

    } elseif (is_search()) {
        $items[] = array(
            'title' => sprintf(__('Risultati per: "%s"', 'hifisolution'), get_search_query()),
            'url'   => '',
        );

    } elseif (is_404()) {
        $items[] = array(
            'title' => __('Pagina non trovata', 'hifisolution'),
            'url'   => '',
        );
    }

    return $items;
}

/**
 * Visualizza il breadcrumb HTML.
 */
function hifisolution_breadcrumbs() {
    if (is_front_page()) {
        return;
    }

    $items = hifisolution_get_breadcrumb_items();
    if (empty($items)) {
        return;
    }

    echo '<nav class="hifi-breadcrumbs" aria-label="' . esc_attr__('Breadcrumb', 'hifisolution') . '">';
    echo '<div class="hifi-container">';
    echo '<ol class="hifi-breadcrumbs__list" itemscope itemtype="https://schema.org/BreadcrumbList">';

    $count = count($items);
    foreach ($items as $i => $item) {
        $is_last = ($i === $count - 1);

        echo '<li class="hifi-breadcrumbs__item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';

        if (!$is_last && !empty($item['url'])) {
            echo '<a href="' . esc_url($item['url']) . '" itemprop="item">';
            echo '<span itemprop="name">' . esc_html($item['title']) . '</span>';
            echo '</a>';
            echo '<meta itemprop="position" content="' . ($i + 1) . '">';
            echo '<span class="hifi-breadcrumbs__sep" aria-hidden="true">/</span>';
        } else {
            echo '<span class="hifi-breadcrumbs__current" itemprop="name">' . esc_html($item['title']) . '</span>';
            echo '<meta itemprop="position" content="' . ($i + 1) . '">';
        }

        echo '</li>';
    }

    echo '</ol>';
    echo '</div>';
    echo '</nav>';
}
