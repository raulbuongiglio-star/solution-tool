<?php
/**
 * Template per l'archivio della tassonomia Categoria Prodotto.
 * Mostra le sottocategorie se presenti, altrimenti i prodotti.
 *
 * @package HiFiSolution
 */

defined('ABSPATH') || exit;

$current_term = get_queried_object();

// Controlla se la categoria ha sottocategorie.
$subcategories = get_terms(array(
    'taxonomy'   => 'categoria_prodotto',
    'parent'     => $current_term->term_id,
    'hide_empty' => false,
    'orderby'    => 'name',
));

// Se non ci sono sottocategorie, mostra i prodotti.
if (!$subcategories || is_wp_error($subcategories) || empty($subcategories)) {
    get_template_part('archive', 'prodotto');
    return;
}

// Altrimenti mostra le sottocategorie.
get_header();
?>

<main id="primary" class="site-main hifi-catalog">

    <?php hifisolution_breadcrumbs(); ?>

    <section class="hifi-section">
        <div class="hifi-container">
            <div class="hifi-section__header hifi-reveal">
                <span class="hifi-section__subtitle"><?php echo esc_html($current_term->name); ?></span>
                <h1 class="hifi-section__title"><?php printf(esc_html__('Categorie %s', 'hifisolution'), esc_html($current_term->name)); ?></h1>
                <?php if (term_description()) : ?>
                    <p class="hifi-section__desc"><?php echo wp_kses_post(term_description()); ?></p>
                <?php endif; ?>
            </div>

            <div class="hifi-categories__grid">
                <?php foreach ($subcategories as $subcat) :
                    $image = get_term_meta($subcat->term_id, 'categoria_image', true);
                    $count = $subcat->count;
                    ?>
                    <a href="<?php echo esc_url(get_term_link($subcat)); ?>" class="hifi-category-card hifi-reveal">
                        <?php if ($image) : ?>
                            <img class="hifi-category-card__img"
                                 src="<?php echo esc_url($image); ?>"
                                 alt="<?php echo esc_attr($subcat->name); ?>"
                                 loading="lazy">
                        <?php else : ?>
                            <div class="hifi-category-card__img" style="background: linear-gradient(135deg, var(--hifi-bg-card), var(--hifi-bg-secondary));"></div>
                        <?php endif; ?>
                        <div class="hifi-category-card__overlay">
                            <h3 class="hifi-category-card__title"><?php echo esc_html($subcat->name); ?></h3>
                            <span class="hifi-category-card__count">
                                <?php printf(esc_html(_n('%d prodotto', '%d prodotti', $count, 'hifisolution')), $count); ?>
                            </span>
                        </div>
                    </a>
                <?php endforeach; ?>
            </div>

            <?php
            // Mostra anche i prodotti direttamente assegnati a questa categoria, se presenti.
            if (have_posts()) :
            ?>
                <div class="hifi-section__header hifi-reveal" style="margin-top: var(--hifi-space-xl);">
                    <h2 class="hifi-section__title"><?php printf(esc_html__('Prodotti in %s', 'hifisolution'), esc_html($current_term->name)); ?></h2>
                </div>
                <div class="hifi-products__grid" id="hifi-products-grid">
                    <?php
                    while (have_posts()) :
                        the_post();
                        get_template_part('template-parts/content', 'prodotto-card');
                    endwhile;
                    ?>
                </div>
            <?php endif; ?>

        </div>
    </section>

</main>

<?php get_footer(); ?>
