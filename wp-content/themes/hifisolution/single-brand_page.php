<?php
/**
 * Template per la singola pagina brand.
 *
 * @package HiFiSolution
 */

defined('ABSPATH') || exit;

get_header();

$logo         = '';
$website      = '';
$anno         = '';
$paese        = '';
$filosofia    = '';
$perche       = '';
$brand_term   = null;

if (function_exists('get_field')) {
    $logo_data  = get_field('brand_logo');
    $logo       = $logo_data ? $logo_data['url'] : '';
    $website    = get_field('brand_website');
    $anno       = get_field('brand_anno_fondazione');
    $paese      = get_field('brand_paese');
    $filosofia  = get_field('brand_filosofia');
    $perche     = get_field('brand_perche_scelto');
    $brand_term = get_field('brand_taxonomy_link');
}

if (!$logo && has_post_thumbnail()) {
    $logo = get_the_post_thumbnail_url(get_the_ID(), 'hifi-brand-logo');
}
?>

<main id="primary" class="site-main">

    <?php hifisolution_breadcrumbs(); ?>

    <article id="post-<?php the_ID(); ?>" <?php post_class('hifi-brand-single'); ?>>

        <!-- ===== HEADER BRAND ===== -->
        <section class="hifi-section">
            <div class="hifi-container">
                <div style="display: grid; grid-template-columns: 200px 1fr; gap: 40px; align-items: center;" class="hifi-reveal">
                    <?php if ($logo) : ?>
                        <div style="background: var(--hifi-bg-card); border-radius: var(--hifi-radius-lg); border: 1px solid var(--hifi-border); padding: 32px; display: flex; align-items: center; justify-content: center;">
                            <img src="<?php echo esc_url($logo); ?>"
                                 alt="<?php echo esc_attr(get_the_title() . ' logo'); ?>"
                                 style="max-width: 100%; max-height: 100px;">
                        </div>
                    <?php endif; ?>

                    <div>
                        <h1 style="margin-bottom: 12px;"><?php the_title(); ?></h1>

                        <div style="display: flex; gap: 16px; flex-wrap: wrap; margin-bottom: 16px;">
                            <?php if ($anno) : ?>
                                <span class="hifi-product-single__meta-item">
                                    <?php printf(esc_html__('Fondato nel %s', 'hifisolution'), esc_html($anno)); ?>
                                </span>
                            <?php endif; ?>
                            <?php if ($paese) : ?>
                                <span class="hifi-product-single__meta-item">
                                    <?php echo esc_html($paese); ?>
                                </span>
                            <?php endif; ?>
                            <?php if ($website) : ?>
                                <a href="<?php echo esc_url($website); ?>" class="hifi-product-single__meta-item" target="_blank" rel="noopener noreferrer" style="text-decoration: none;">
                                    <?php esc_html_e('Sito ufficiale', 'hifisolution'); ?>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path><polyline points="15 3 21 3 21 9"></polyline><line x1="10" y1="14" x2="21" y2="3"></line></svg>
                                </a>
                            <?php endif; ?>
                        </div>

                        <?php if (has_excerpt()) : ?>
                            <p style="font-size: 1.05rem; color: var(--hifi-text-secondary);"><?php the_excerpt(); ?></p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </section>

        <!-- ===== STORIA E CONTENUTO ===== -->
        <section class="hifi-section hifi-section--alt">
            <div class="hifi-container">
                <div class="hifi-reveal" style="max-width: 800px; margin: 0 auto;">
                    <h2><?php printf(esc_html__('La storia di %s', 'hifisolution'), get_the_title()); ?></h2>
                    <div class="hifi-product-single__description">
                        <?php the_content(); ?>
                    </div>
                </div>
            </div>
        </section>

        <!-- ===== FILOSOFIA ===== -->
        <?php if ($filosofia) : ?>
        <section class="hifi-section">
            <div class="hifi-container">
                <div class="hifi-reveal" style="max-width: 800px; margin: 0 auto;">
                    <h2><?php printf(esc_html__('La filosofia di %s', 'hifisolution'), get_the_title()); ?></h2>
                    <div class="hifi-product-single__description">
                        <?php echo wp_kses_post($filosofia); ?>
                    </div>
                </div>
            </div>
        </section>
        <?php endif; ?>

        <!-- ===== PERCHÉ L'ABBIAMO SCELTO ===== -->
        <?php if ($perche) : ?>
        <section class="hifi-section hifi-section--alt">
            <div class="hifi-container">
                <div class="hifi-reveal" style="max-width: 800px; margin: 0 auto;">
                    <h2><?php printf(esc_html__('Perché HiFi Solution ha scelto %s', 'hifisolution'), get_the_title()); ?></h2>
                    <div class="hifi-product-single__description">
                        <?php echo wp_kses_post($perche); ?>
                    </div>
                </div>
            </div>
        </section>
        <?php endif; ?>

        <!-- ===== PRODOTTI DEL BRAND ===== -->
        <?php
        $brand_slug = '';
        if ($brand_term && !is_wp_error($brand_term)) {
            $brand_slug = $brand_term->slug;
        } else {
            $brand_slug = sanitize_title(get_the_title());
        }

        $brand_products = hifisolution_get_brand_products($brand_slug, 12);

        if ($brand_products->have_posts()) :
        ?>
        <section class="hifi-section">
            <div class="hifi-container">
                <div class="hifi-section__header hifi-reveal">
                    <span class="hifi-section__subtitle"><?php esc_html_e('Catalogo', 'hifisolution'); ?></span>
                    <h2 class="hifi-section__title"><?php printf(esc_html__('Prodotti %s', 'hifisolution'), get_the_title()); ?></h2>
                </div>

                <div class="hifi-products__grid">
                    <?php
                    while ($brand_products->have_posts()) :
                        $brand_products->the_post();
                        get_template_part('template-parts/content', 'prodotto-card');
                    endwhile;
                    wp_reset_postdata();
                    ?>
                </div>

                <?php if ($brand_term && !is_wp_error($brand_term)) : ?>
                    <div class="hifi-text-center hifi-mt-4">
                        <a href="<?php echo esc_url(get_term_link($brand_term)); ?>" class="hifi-btn hifi-btn--outline">
                            <?php printf(esc_html__('Vedi tutti i prodotti %s', 'hifisolution'), esc_html($brand_term->name)); ?>
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </section>
        <?php endif; ?>

    </article>

</main>

<?php get_footer(); ?>
