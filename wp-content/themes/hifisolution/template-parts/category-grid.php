<?php
/**
 * Template Part: Griglia Categorie Prodotto.
 *
 * @package HiFiSolution
 */

defined('ABSPATH') || exit;

$categories = get_terms(array(
    'taxonomy'   => 'categoria_prodotto',
    'hide_empty' => false,
    'parent'     => 0,
    'orderby'    => 'name',
));

if (!$categories || is_wp_error($categories)) {
    return;
}
?>

<section class="hifi-section hifi-section--alt hifi-section--categories">
    <div class="hifi-container">
        <div class="hifi-section__header hifi-reveal">
            <span class="hifi-section__subtitle"><?php esc_html_e('Categorie', 'hifisolution'); ?></span>
            <h2 class="hifi-section__title"><?php esc_html_e('Esplora per categoria', 'hifisolution'); ?></h2>
        </div>

        <div class="hifi-categories__grid">
            <?php foreach ($categories as $category) :
                $image = get_term_meta($category->term_id, 'categoria_image', true);
                $count = $category->count;
                ?>
                <a href="<?php echo esc_url(get_term_link($category)); ?>" class="hifi-category-card hifi-reveal">
                    <?php if ($image) : ?>
                        <img class="hifi-category-card__img"
                             src="<?php echo esc_url($image); ?>"
                             alt="<?php echo esc_attr($category->name); ?>"
                             loading="lazy">
                    <?php else : ?>
                        <div class="hifi-category-card__img" style="background: linear-gradient(135deg, var(--hifi-bg-card), var(--hifi-bg-secondary));"></div>
                    <?php endif; ?>
                    <div class="hifi-category-card__overlay">
                        <h3 class="hifi-category-card__title"><?php echo esc_html($category->name); ?></h3>
                        <span class="hifi-category-card__count">
                            <?php printf(esc_html(_n('%d prodotto', '%d prodotti', $count, 'hifisolution')), $count); ?>
                        </span>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>
