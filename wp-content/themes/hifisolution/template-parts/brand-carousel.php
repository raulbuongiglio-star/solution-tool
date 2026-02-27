<?php
/**
 * Template Part: Brand Carousel animato.
 *
 * @package HiFiSolution
 */

defined('ABSPATH') || exit;

$brands = get_terms(array(
    'taxonomy'   => 'brand',
    'hide_empty' => false,
    'orderby'    => 'name',
));

if (!$brands || is_wp_error($brands)) {
    return;
}
?>

<section class="hifi-brands" aria-label="<?php esc_attr_e('Brand trattati', 'hifisolution'); ?>">
    <div class="hifi-brands__track">
        <?php
        // Duplica i brand per il loop infinito dell'animazione
        $all_brands = array_merge($brands, $brands);
        foreach ($all_brands as $brand) :
            ?>
            <a href="<?php echo esc_url(get_term_link($brand)); ?>" class="hifi-brands__item" title="<?php echo esc_attr($brand->name); ?>">
                <span style="font-size: 1.2rem; font-weight: 700; color: var(--hifi-text-primary); white-space: nowrap; letter-spacing: 2px;"><?php echo esc_html($brand->name); ?></span>
            </a>
        <?php endforeach; ?>
    </div>
</section>
