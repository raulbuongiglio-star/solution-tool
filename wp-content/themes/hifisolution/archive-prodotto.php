<?php
/**
 * Template per l'archivio prodotti (catalogo).
 *
 * @package HiFiSolution
 */

defined('ABSPATH') || exit;

get_header();
?>

<main id="primary" class="site-main hifi-catalog">

    <?php hifisolution_breadcrumbs(); ?>

    <section class="hifi-section">
        <div class="hifi-container">
            <div class="hifi-section__header hifi-reveal">
                <span class="hifi-section__subtitle"><?php esc_html_e('Il nostro catalogo', 'hifisolution'); ?></span>
                <?php if (is_tax('categoria_prodotto')) : ?>
                    <h1 class="hifi-section__title"><?php single_term_title(); ?></h1>
                    <?php if (term_description()) : ?>
                        <p class="hifi-section__desc"><?php echo wp_kses_post(term_description()); ?></p>
                    <?php endif; ?>
                <?php elseif (is_tax('brand')) : ?>
                    <h1 class="hifi-section__title"><?php single_term_title(); ?></h1>
                    <?php if (term_description()) : ?>
                        <p class="hifi-section__desc"><?php echo wp_kses_post(term_description()); ?></p>
                    <?php endif; ?>
                <?php elseif (is_tax('fascia_prezzo')) : ?>
                    <h1 class="hifi-section__title"><?php single_term_title(); ?></h1>
                <?php else : ?>
                    <h1 class="hifi-section__title"><?php esc_html_e('Catalogo Prodotti', 'hifisolution'); ?></h1>
                    <p class="hifi-section__desc"><?php esc_html_e('Esplora la nostra selezione di prodotti audio hi-fi di alta gamma. Ogni prodotto è disponibile per l\'acquisto sul nostro shop online.', 'hifisolution'); ?></p>
                <?php endif; ?>
            </div>

            <!-- ===== FILTRI ===== -->
            <div class="hifi-filters hifi-reveal" id="hifi-catalog-filters">
                <div class="hifi-filters__group">
                    <label class="hifi-filters__label" for="filter-categoria"><?php esc_html_e('Categoria', 'hifisolution'); ?></label>
                    <select class="hifi-filters__select" id="filter-categoria" data-filter="categoria">
                        <option value=""><?php esc_html_e('Tutte le categorie', 'hifisolution'); ?></option>
                        <?php
                        $categories = get_terms(array(
                            'taxonomy'   => 'categoria_prodotto',
                            'hide_empty' => true,
                        ));
                        if ($categories && !is_wp_error($categories)) :
                            foreach ($categories as $cat) :
                                $selected = (is_tax('categoria_prodotto', $cat->slug)) ? 'selected' : '';
                                ?>
                                <option value="<?php echo esc_attr($cat->slug); ?>" <?php echo $selected; ?>><?php echo esc_html($cat->name); ?> (<?php echo esc_html($cat->count); ?>)</option>
                            <?php endforeach;
                        endif;
                        ?>
                    </select>
                </div>

                <div class="hifi-filters__group">
                    <label class="hifi-filters__label" for="filter-brand"><?php esc_html_e('Brand', 'hifisolution'); ?></label>
                    <select class="hifi-filters__select" id="filter-brand" data-filter="brand">
                        <option value=""><?php esc_html_e('Tutti i brand', 'hifisolution'); ?></option>
                        <?php
                        $brands = get_terms(array(
                            'taxonomy'   => 'brand',
                            'hide_empty' => true,
                        ));
                        if ($brands && !is_wp_error($brands)) :
                            foreach ($brands as $brand) :
                                $selected = (is_tax('brand', $brand->slug)) ? 'selected' : '';
                                ?>
                                <option value="<?php echo esc_attr($brand->slug); ?>" <?php echo $selected; ?>><?php echo esc_html($brand->name); ?> (<?php echo esc_html($brand->count); ?>)</option>
                            <?php endforeach;
                        endif;
                        ?>
                    </select>
                </div>

                <div class="hifi-filters__group">
                    <label class="hifi-filters__label" for="filter-prezzo"><?php esc_html_e('Fascia di prezzo', 'hifisolution'); ?></label>
                    <select class="hifi-filters__select" id="filter-prezzo" data-filter="fascia_prezzo">
                        <option value=""><?php esc_html_e('Tutte le fasce', 'hifisolution'); ?></option>
                        <?php
                        $price_ranges = get_terms(array(
                            'taxonomy'   => 'fascia_prezzo',
                            'hide_empty' => true,
                        ));
                        if ($price_ranges && !is_wp_error($price_ranges)) :
                            foreach ($price_ranges as $range) :
                                $selected = (is_tax('fascia_prezzo', $range->slug)) ? 'selected' : '';
                                ?>
                                <option value="<?php echo esc_attr($range->slug); ?>" <?php echo $selected; ?>><?php echo esc_html($range->name); ?></option>
                            <?php endforeach;
                        endif;
                        ?>
                    </select>
                </div>
            </div>

            <!-- ===== GRIGLIA PRODOTTI ===== -->
            <div class="hifi-products__grid" id="hifi-products-grid">
                <?php
                if (have_posts()) :
                    while (have_posts()) :
                        the_post();
                        get_template_part('template-parts/content', 'prodotto-card');
                    endwhile;
                else :
                    ?>
                    <div class="hifi-text-center" style="grid-column: 1/-1; padding: 60px 0;">
                        <p style="font-size: 1.1rem; color: var(--hifi-text-muted);">
                            <?php esc_html_e('Nessun prodotto trovato. Prova a modificare i filtri di ricerca.', 'hifisolution'); ?>
                        </p>
                        <a href="<?php echo esc_url(get_post_type_archive_link('prodotto')); ?>" class="hifi-btn hifi-btn--outline hifi-mt-2">
                            <?php esc_html_e('Vedi tutti i prodotti', 'hifisolution'); ?>
                        </a>
                    </div>
                    <?php
                endif;
                ?>
            </div>

            <!-- ===== PAGINAZIONE ===== -->
            <?php
            $pagination = paginate_links(array(
                'type'      => 'array',
                'prev_text' => '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="15 18 9 12 15 6"></polyline></svg>',
                'next_text' => '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 18 15 12 9 6"></polyline></svg>',
            ));

            if ($pagination) :
            ?>
            <nav class="hifi-pagination" aria-label="<?php esc_attr_e('Paginazione prodotti', 'hifisolution'); ?>">
                <?php foreach ($pagination as $page_link) : ?>
                    <?php echo $page_link; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                <?php endforeach; ?>
            </nav>
            <?php endif; ?>

        </div>
    </section>

</main>

<?php get_footer(); ?>
