<?php
/**
 * Template per il singolo prodotto.
 *
 * @package HiFiSolution
 */

defined('ABSPATH') || exit;

get_header();

$brand_name    = hifisolution_get_brand_name();
$category_name = hifisolution_get_category_name();
$shop_url      = hifisolution_get_shop_url();
$price         = hifisolution_get_price();
$specs         = hifisolution_get_specs();
$gallery       = hifisolution_get_gallery();
$sottotitolo   = '';
$finiture      = '';

if (function_exists('get_field')) {
    $sottotitolo = get_field('prodotto_sottotitolo');
    $finiture    = get_field('prodotto_finiture');
} else {
    $sottotitolo = get_post_meta(get_the_ID(), 'prodotto_sottotitolo', true);
    $finiture    = get_post_meta(get_the_ID(), 'prodotto_finiture', true);
}
?>

<main id="primary" class="site-main">

    <?php hifisolution_breadcrumbs(); ?>

    <article id="post-<?php the_ID(); ?>" <?php post_class('hifi-product-single'); ?>>
        <div class="hifi-container">
            <div class="hifi-product-single__grid">

                <!-- ===== GALLERIA IMMAGINI ===== -->
                <div class="hifi-product-single__gallery">
                    <?php if (!empty($gallery)) : ?>
                        <div class="hifi-product-single__main-image" id="hifi-main-image">
                            <img src="<?php echo esc_url($gallery[0]['sizes']['large'] ?? $gallery[0]['url']); ?>"
                                 alt="<?php echo esc_attr(get_the_title() . ' — ' . $brand_name); ?>"
                                 id="hifi-gallery-main">
                        </div>
                        <?php if (count($gallery) > 1) : ?>
                            <div class="hifi-product-single__thumbnails">
                                <?php foreach ($gallery as $i => $image) : ?>
                                    <button class="hifi-product-single__thumb <?php echo $i === 0 ? 'active' : ''; ?>"
                                            data-full="<?php echo esc_url($image['sizes']['large'] ?? $image['url']); ?>"
                                            data-alt="<?php echo esc_attr($image['alt'] ?? get_the_title()); ?>">
                                        <img src="<?php echo esc_url($image['sizes']['thumbnail'] ?? $image['url']); ?>"
                                             alt="<?php echo esc_attr($image['alt'] ?? get_the_title() . ' immagine ' . ($i + 1)); ?>"
                                             loading="lazy">
                                    </button>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    <?php elseif (has_post_thumbnail()) : ?>
                        <div class="hifi-product-single__main-image">
                            <?php the_post_thumbnail('hifi-product-large', array(
                                'alt' => get_the_title() . ' — ' . $brand_name,
                            )); ?>
                        </div>
                    <?php else : ?>
                        <div class="hifi-product-single__main-image" style="aspect-ratio: 1; display: flex; align-items: center; justify-content: center;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" viewBox="0 0 24 24" fill="none" stroke="var(--hifi-border)" stroke-width="1"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><circle cx="8.5" cy="8.5" r="1.5"></circle><polyline points="21 15 16 10 5 21"></polyline></svg>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- ===== INFORMAZIONI PRODOTTO ===== -->
                <div class="hifi-product-single__info">

                    <?php if ($brand_name) : ?>
                        <div class="hifi-product-single__brand">
                            <?php
                            $brands = get_the_terms(get_the_ID(), 'brand');
                            if ($brands && !is_wp_error($brands)) :
                                ?>
                                <a href="<?php echo esc_url(get_term_link($brands[0])); ?>"><?php echo esc_html($brand_name); ?></a>
                            <?php else : ?>
                                <?php echo esc_html($brand_name); ?>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>

                    <h1 class="hifi-product-single__title"><?php the_title(); ?></h1>

                    <?php if ($sottotitolo) : ?>
                        <p style="font-size: 1.1rem; color: var(--hifi-text-secondary); margin-bottom: 20px;"><?php echo esc_html($sottotitolo); ?></p>
                    <?php endif; ?>

                    <!-- Meta -->
                    <div class="hifi-product-single__meta">
                        <?php if ($category_name) : ?>
                            <span class="hifi-product-single__meta-item">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 15s1-1 4-1 5 2 8 2 4-1 4-1V3s-1 1-4 1-5-2-8-2-4 1-4 1z"></path><line x1="4" y1="22" x2="4" y2="15"></line></svg>
                                <?php echo esc_html($category_name); ?>
                            </span>
                        <?php endif; ?>
                        <?php if ($price) : ?>
                            <span class="hifi-product-single__meta-item">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="1" x2="12" y2="23"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>
                                <?php echo esc_html($price); ?>
                            </span>
                        <?php endif; ?>
                        <?php if (hifisolution_is_new()) : ?>
                            <span class="hifi-product-single__meta-item" style="background-color: var(--hifi-accent); color: var(--hifi-bg-primary); border-color: var(--hifi-accent);">
                                <?php esc_html_e('Novità', 'hifisolution'); ?>
                            </span>
                        <?php endif; ?>
                    </div>

                    <!-- Finiture disponibili -->
                    <?php if ($finiture) : ?>
                        <div class="hifi-product-single__finiture-box">
                            <span class="hifi-product-single__finiture-label"><?php esc_html_e('Finiture disponibili:', 'hifisolution'); ?></span>
                            <span class="hifi-product-single__finiture-values">
                                <?php
                                $fin_array = array_map('trim', explode(',', $finiture));
                                foreach ($fin_array as $fin) :
                                    $fin_class = strtolower($fin) === 'nero' ? 'swatch--nero' : 'swatch--silver';
                                ?>
                                    <span class="hifi-swatch <?php echo esc_attr($fin_class); ?>"><?php echo esc_html($fin); ?></span>
                                <?php endforeach; ?>
                            </span>
                        </div>
                    <?php endif; ?>

                    <!-- CTA Acquista -->
                    <div class="hifi-product-single__cta">
                        <p><?php esc_html_e('Questo prodotto è disponibile nel nostro shop online', 'hifisolution'); ?></p>
                        <a href="<?php echo esc_url($shop_url); ?>"
                           class="hifi-btn hifi-btn--shop"
                           target="_blank"
                           rel="noopener noreferrer">
                            <?php esc_html_e('Acquista su HiFi Solution Shop', 'hifisolution'); ?>
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path><polyline points="15 3 21 3 21 9"></polyline><line x1="10" y1="14" x2="21" y2="3"></line></svg>
                        </a>
                    </div>

                    <!-- Descrizione -->
                    <div class="hifi-product-single__description">
                        <h2><?php esc_html_e('Descrizione', 'hifisolution'); ?></h2>
                        <?php the_content(); ?>
                    </div>

                    <!-- Specifiche Tecniche -->
                    <?php if (!empty($specs)) : ?>
                        <div class="hifi-specs">
                            <h2 class="hifi-specs__title"><?php esc_html_e('Specifiche Tecniche', 'hifisolution'); ?></h2>
                            <table class="hifi-specs__table">
                                <tbody>
                                    <?php foreach ($specs as $spec) : ?>
                                        <tr>
                                            <th><?php echo esc_html($spec['name']); ?></th>
                                            <td><?php echo esc_html($spec['value']); ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php endif; ?>

                    <!-- CTA secondaria -->
                    <div style="margin-top: 40px; display: flex; gap: 12px; flex-wrap: wrap;">
                        <a href="<?php echo esc_url($shop_url); ?>" class="hifi-btn hifi-btn--primary" target="_blank" rel="noopener noreferrer">
                            <?php esc_html_e('Acquista su HiFi Solution Shop', 'hifisolution'); ?>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path><polyline points="15 3 21 3 21 9"></polyline><line x1="10" y1="14" x2="21" y2="3"></line></svg>
                        </a>
                        <a href="<?php echo esc_url(home_url('/contatti/')); ?>" class="hifi-btn hifi-btn--outline">
                            <?php esc_html_e('Richiedi informazioni', 'hifisolution'); ?>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </article>

    <!-- ===== PRODOTTI CORRELATI ===== -->
    <?php
    $related = hifisolution_get_related_products(get_the_ID(), 4);
    if ($related->have_posts()) :
    ?>
    <section class="hifi-section hifi-section--alt">
        <div class="hifi-container">
            <div class="hifi-section__header hifi-reveal">
                <h2 class="hifi-section__title"><?php esc_html_e('Prodotti correlati', 'hifisolution'); ?></h2>
            </div>
            <div class="hifi-products__grid">
                <?php
                while ($related->have_posts()) :
                    $related->the_post();
                    get_template_part('template-parts/content', 'prodotto-card');
                endwhile;
                wp_reset_postdata();
                ?>
            </div>
        </div>
    </section>
    <?php endif; ?>

</main>

<?php get_footer(); ?>
