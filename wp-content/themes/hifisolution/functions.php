<?php
/**
 * HiFi Solution — Tema child di GeneratePress
 *
 * Audio Hi-Fi di alta gamma a Napoli dal 1985.
 * Sito vetrina istituzionale premium.
 *
 * @package HiFiSolution
 * @since 1.0.0
 */

defined('ABSPATH') || exit;

define('HIFISOLUTION_VERSION', '1.0.0');
define('HIFISOLUTION_DIR', get_stylesheet_directory());
define('HIFISOLUTION_URI', get_stylesheet_directory_uri());
define('HIFISOLUTION_SHOP_URL', 'https://www.hifisolution.it');

/**
 * Include dei moduli del tema.
 */
$hifisolution_includes = array(
    '/inc/theme-setup.php',
    '/inc/enqueue.php',
    '/inc/custom-post-types.php',
    '/inc/custom-taxonomies.php',
    '/inc/acf-fields.php',
    '/inc/seo-schema.php',
    '/inc/breadcrumbs.php',
    '/inc/template-functions.php',
);

foreach ($hifisolution_includes as $file) {
    $filepath = HIFISOLUTION_DIR . $file;
    if (file_exists($filepath)) {
        require_once $filepath;
    }
}
