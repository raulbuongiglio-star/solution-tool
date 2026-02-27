<?php
/**
 * Template Part: Card Prodotto per le griglie.
 *
 * @package HiFiSolution
 */

defined('ABSPATH') || exit;

$brand_name = hifisolution_get_brand_name();
$category   = hifisolution_get_category_name();
$price      = hifisolution_get_price();
$shop_url   = hifisolution_get_shop_url();
$is_new     = hifisolution_is_new();
?>

<div class="hifi-product-card hifi-reveal">
    <div class="hifi-product-card__image">
        <?php if (has_post_thumbnail()) : ?>
            <a href="<?php the_permalink(); ?>">
                <?php the_post_thumbnail('hifi-product-card', array(
                    'alt'     => get_the_title() . ($brand_name ? ' — ' . $brand_name : ''),
                    'loading' => 'lazy',
                )); ?>
            </a>
        <?php else : ?>
            <a href="<?php the_permalink(); ?>" style="display: flex; align-items: center; justify-content: center; width: 100%; height: 100%;">
                <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="var(--hifi-border)" stroke-width="1"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><circle cx="8.5" cy="8.5" r="1.5"></circle><polyline points="21 15 16 10 5 21"></polyline></svg>
            </a>
        <?php endif; ?>

        <?php if ($is_new) : ?>
            <span class="hifi-product-card__badge"><?php esc_html_e('Novità', 'hifisolution'); ?></span>
        <?php endif; ?>
    </div>

    <div class="hifi-product-card__body">
        <?php if ($brand_name) : ?>
            <div class="hifi-product-card__brand"><?php echo esc_html($brand_name); ?></div>
        <?php endif; ?>

        <h3 class="hifi-product-card__title">
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
        </h3>

        <?php if ($category) : ?>
            <div class="hifi-product-card__category"><?php echo esc_html($category); ?></div>
        <?php endif; ?>

        <?php if ($price) : ?>
            <div class="hifi-product-card__price"><?php echo esc_html($price); ?></div>
        <?php endif; ?>
    </div>

    <div class="hifi-product-card__footer">
        <a href="<?php the_permalink(); ?>" class="hifi-btn hifi-btn--outline hifi-btn--sm" style="flex: 1; justify-content: center;">
            <?php esc_html_e('Dettagli', 'hifisolution'); ?>
        </a>
        <a href="<?php echo esc_url($shop_url); ?>" class="hifi-btn hifi-btn--primary hifi-btn--sm" target="_blank" rel="noopener noreferrer" style="flex: 1; justify-content: center;">
            <?php esc_html_e('Shop', 'hifisolution'); ?>
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path><polyline points="15 3 21 3 21 9"></polyline><line x1="10" y1="14" x2="21" y2="3"></line></svg>
        </a>
    </div>
</div>
