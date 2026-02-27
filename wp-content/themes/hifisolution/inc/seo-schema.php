<?php
/**
 * SEO Schema Markup — JSON-LD structured data.
 *
 * @package HiFiSolution
 */

defined('ABSPATH') || exit;

/**
 * Output dello schema markup JSON-LD nel <head>.
 */
function hifisolution_schema_output() {
    if (is_singular('prodotto')) {
        hifisolution_schema_product();
    } elseif (is_singular('brand_page')) {
        hifisolution_schema_brand();
    } elseif (is_singular('post')) {
        hifisolution_schema_article();
    } elseif (is_front_page()) {
        hifisolution_schema_organization();
    }

    // BreadcrumbList schema su tutte le pagine tranne la home
    if (!is_front_page()) {
        hifisolution_schema_breadcrumb();
    }
}
add_action('wp_head', 'hifisolution_schema_output', 99);

/**
 * Schema Product per i prodotti.
 */
function hifisolution_schema_product() {
    global $post;

    $brand_terms = get_the_terms($post->ID, 'brand');
    $brand_name  = ($brand_terms && !is_wp_error($brand_terms)) ? $brand_terms[0]->name : '';

    $category_terms = get_the_terms($post->ID, 'categoria_prodotto');
    $category_name  = ($category_terms && !is_wp_error($category_terms)) ? $category_terms[0]->name : '';

    $description = get_the_excerpt($post->ID);
    if (empty($description)) {
        $description = wp_trim_words(wp_strip_all_tags(get_the_content(null, false, $post)), 50);
    }

    $image_url = '';
    if (has_post_thumbnail($post->ID)) {
        $image_url = get_the_post_thumbnail_url($post->ID, 'large');
    }

    $shop_url = '';
    if (function_exists('get_field')) {
        $shop_url = get_field('prodotto_shop_url', $post->ID);
    } else {
        $shop_url = get_post_meta($post->ID, 'prodotto_shop_url', true);
    }
    if (empty($shop_url)) {
        $shop_url = HIFISOLUTION_SHOP_URL;
    }

    $schema = array(
        '@context'    => 'https://schema.org',
        '@type'       => 'Product',
        'name'        => get_the_title($post->ID),
        'description' => $description,
        'url'         => get_permalink($post->ID),
    );

    if ($image_url) {
        $schema['image'] = $image_url;
    }

    if ($brand_name) {
        $schema['brand'] = array(
            '@type' => 'Brand',
            'name'  => $brand_name,
        );
    }

    if ($category_name) {
        $schema['category'] = $category_name;
    }

    // Offers — link allo shop esterno
    $schema['offers'] = array(
        '@type'         => 'Offer',
        'url'           => $shop_url,
        'seller'        => array(
            '@type' => 'Organization',
            'name'  => 'HiFi Solution',
            'url'   => HIFISOLUTION_SHOP_URL,
        ),
        'availability'  => 'https://schema.org/InStock',
        'itemCondition' => 'https://schema.org/NewCondition',
    );

    // Prezzo indicativo
    $prezzo = '';
    if (function_exists('get_field')) {
        $prezzo = get_field('prodotto_prezzo_indicativo', $post->ID);
    } else {
        $prezzo = get_post_meta($post->ID, 'prodotto_prezzo_indicativo', true);
    }
    if ($prezzo) {
        // Estrai il numero dal prezzo indicativo
        $price_number = preg_replace('/[^\d.]/', '', $prezzo);
        if ($price_number) {
            $schema['offers']['price']         = $price_number;
            $schema['offers']['priceCurrency'] = 'EUR';
        }
    }

    hifisolution_output_jsonld($schema);
}

/**
 * Schema Organization per la home page.
 */
function hifisolution_schema_organization() {
    $schema = array(
        '@context'    => 'https://schema.org',
        '@type'       => 'LocalBusiness',
        'name'        => 'HiFi Solution',
        'description' => 'Vendita e consulenza audio Hi-Fi di alta gamma a Napoli dal 1985. Bowers & Wilkins, Marantz, Rotel, Focal e altri brand premium.',
        'url'         => home_url('/'),
        'telephone'   => '+39 081 2298596',
        'email'       => 'info@hs-hifi.it',
        'address'     => array(
            '@type'           => 'PostalAddress',
            'streetAddress'   => 'Via Massimo Stanzione 6',
            'postalCode'      => '80129',
            'addressLocality' => 'Napoli',
            'addressRegion'   => 'NA',
            'addressCountry'  => 'IT',
        ),
        'geo' => array(
            '@type'     => 'GeoCoordinates',
            'latitude'  => '40.8454',
            'longitude' => '14.2290',
        ),
        'sameAs' => array(
            'https://www.facebook.com/hifisolution',
            'https://www.instagram.com/hifisolution',
        ),
        'foundingDate' => '1985',
        'priceRange'   => '€€€',
        'image'        => HIFISOLUTION_URI . '/assets/images/hifi-solution-negozio.jpg',
    );

    hifisolution_output_jsonld($schema);
}

/**
 * Schema Article per i post del blog.
 */
function hifisolution_schema_article() {
    global $post;

    $image_url = '';
    if (has_post_thumbnail($post->ID)) {
        $image_url = get_the_post_thumbnail_url($post->ID, 'large');
    }

    $schema = array(
        '@context'      => 'https://schema.org',
        '@type'         => 'Article',
        'headline'      => get_the_title($post->ID),
        'description'   => get_the_excerpt($post->ID),
        'url'           => get_permalink($post->ID),
        'datePublished' => get_the_date('c', $post->ID),
        'dateModified'  => get_the_modified_date('c', $post->ID),
        'author'        => array(
            '@type' => 'Organization',
            'name'  => 'HiFi Solution',
        ),
        'publisher'     => array(
            '@type' => 'Organization',
            'name'  => 'HiFi Solution',
            'logo'  => array(
                '@type' => 'ImageObject',
                'url'   => HIFISOLUTION_URI . '/assets/images/logo.png',
            ),
        ),
    );

    if ($image_url) {
        $schema['image'] = $image_url;
    }

    hifisolution_output_jsonld($schema);
}

/**
 * Schema Brand per le pagine brand.
 */
function hifisolution_schema_brand() {
    global $post;

    $logo = '';
    if (function_exists('get_field')) {
        $logo_data = get_field('brand_logo', $post->ID);
        if ($logo_data) {
            $logo = $logo_data['url'];
        }
    }

    $schema = array(
        '@context'    => 'https://schema.org',
        '@type'       => 'Brand',
        'name'        => get_the_title($post->ID),
        'description' => get_the_excerpt($post->ID),
        'url'         => get_permalink($post->ID),
    );

    if ($logo) {
        $schema['logo'] = $logo;
    }

    hifisolution_output_jsonld($schema);
}

/**
 * Schema BreadcrumbList.
 */
function hifisolution_schema_breadcrumb() {
    $breadcrumbs = hifisolution_get_breadcrumb_items();
    if (empty($breadcrumbs)) {
        return;
    }

    $items = array();
    $position = 1;

    foreach ($breadcrumbs as $crumb) {
        $item = array(
            '@type'    => 'ListItem',
            'position' => $position,
            'name'     => $crumb['title'],
        );
        if (!empty($crumb['url'])) {
            $item['item'] = $crumb['url'];
        }
        $items[] = $item;
        $position++;
    }

    $schema = array(
        '@context'        => 'https://schema.org',
        '@type'           => 'BreadcrumbList',
        'itemListElement' => $items,
    );

    hifisolution_output_jsonld($schema);
}

/**
 * Output JSON-LD nel documento.
 */
function hifisolution_output_jsonld($schema) {
    echo '<script type="application/ld+json">' . "\n";
    echo wp_json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    echo "\n" . '</script>' . "\n";
}

/**
 * Genera Open Graph e Twitter Card meta tags.
 */
function hifisolution_open_graph_tags() {
    // Non aggiungere se Yoast o Rank Math sono attivi
    if (defined('WPSEO_VERSION') || class_exists('RankMath')) {
        return;
    }

    global $post;

    $title       = wp_get_document_title();
    $description = '';
    $image       = '';
    $type        = 'website';

    if (is_singular()) {
        $description = get_the_excerpt($post->ID);
        $type        = 'article';

        if (has_post_thumbnail($post->ID)) {
            $image = get_the_post_thumbnail_url($post->ID, 'large');
        }

        if (is_singular('prodotto')) {
            $type = 'product';
        }
    } else {
        $description = get_bloginfo('description');
    }

    if (empty($image)) {
        $image = HIFISOLUTION_URI . '/assets/images/og-default.jpg';
    }

    ?>
    <meta property="og:type" content="<?php echo esc_attr($type); ?>">
    <meta property="og:title" content="<?php echo esc_attr($title); ?>">
    <meta property="og:description" content="<?php echo esc_attr($description); ?>">
    <meta property="og:url" content="<?php echo esc_url(is_singular() ? get_permalink() : home_url('/')); ?>">
    <meta property="og:image" content="<?php echo esc_url($image); ?>">
    <meta property="og:site_name" content="HiFi Solution">
    <meta property="og:locale" content="it_IT">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?php echo esc_attr($title); ?>">
    <meta name="twitter:description" content="<?php echo esc_attr($description); ?>">
    <meta name="twitter:image" content="<?php echo esc_url($image); ?>">
    <?php
}
add_action('wp_head', 'hifisolution_open_graph_tags', 5);

/**
 * Genera il document title ottimizzato per SEO.
 */
function hifisolution_document_title_parts($title_parts) {
    if (is_singular('prodotto')) {
        global $post;

        // Title personalizzato da ACF
        $custom_title = '';
        if (function_exists('get_field')) {
            $custom_title = get_field('prodotto_meta_title', $post->ID);
        } else {
            $custom_title = get_post_meta($post->ID, 'prodotto_meta_title', true);
        }

        if ($custom_title) {
            $title_parts['title'] = $custom_title;
        } else {
            $brand_terms = get_the_terms($post->ID, 'brand');
            $brand_name  = ($brand_terms && !is_wp_error($brand_terms)) ? $brand_terms[0]->name : '';

            if ($brand_name) {
                $title_parts['title'] = get_the_title() . ' — ' . $brand_name;
            }
        }

        $title_parts['site'] = 'HiFi Solution Napoli';
    }

    return $title_parts;
}
add_filter('document_title_parts', 'hifisolution_document_title_parts');

/**
 * Meta description personalizzata.
 */
function hifisolution_meta_description() {
    if (defined('WPSEO_VERSION') || class_exists('RankMath')) {
        return;
    }

    $description = '';

    if (is_singular('prodotto')) {
        global $post;
        if (function_exists('get_field')) {
            $description = get_field('prodotto_meta_description', $post->ID);
        } else {
            $description = get_post_meta($post->ID, 'prodotto_meta_description', true);
        }
        if (empty($description)) {
            $description = get_the_excerpt($post->ID);
        }
    } elseif (is_singular()) {
        $description = get_the_excerpt();
    } elseif (is_front_page()) {
        $description = 'HiFi Solution — Vendita e consulenza audio Hi-Fi di alta gamma a Napoli dal 1985. Bowers & Wilkins, Marantz, Rotel, Focal e altri brand premium.';
    }

    if ($description) {
        echo '<meta name="description" content="' . esc_attr(wp_trim_words($description, 25)) . '">' . "\n";
    }
}
add_action('wp_head', 'hifisolution_meta_description', 4);
