<?php
/**
 * Template Name: I Nostri Marchi
 * Template Post Type: page
 *
 * @package HiFiSolution
 */

defined('ABSPATH') || exit;

get_header();
?>

<main id="primary" class="site-main hifi-brands-page">

    <?php hifisolution_breadcrumbs(); ?>

    <section class="hifi-section">
        <div class="hifi-container">
            <div class="hifi-section__header hifi-reveal">
                <span class="hifi-section__subtitle"><?php esc_html_e('I nostri marchi', 'hifisolution'); ?></span>
                <h1 class="hifi-section__title"><?php esc_html_e('Brand selezionati per l\'eccellenza', 'hifisolution'); ?></h1>
                <p class="hifi-section__desc">
                    <?php esc_html_e('Collaboriamo solo con i migliori produttori di audio hi-fi al mondo. Ogni brand è stato scelto per la qualità, l\'innovazione e la fedeltà sonora dei suoi prodotti.', 'hifisolution'); ?>
                </p>
            </div>

            <div class="hifi-brand-grid">
                <?php
                $brands = new WP_Query(array(
                    'post_type'      => 'brand_page',
                    'posts_per_page' => -1,
                    'orderby'        => 'title',
                    'order'          => 'ASC',
                ));

                if ($brands->have_posts()) :
                    while ($brands->have_posts()) :
                        $brands->the_post();

                        ?>
                        <a href="<?php the_permalink(); ?>" class="hifi-brand-card hifi-reveal">
                            <div class="hifi-brand-card__logo">
                                <span style="font-size: 1.5rem; font-weight: 700; color: var(--hifi-accent);"><?php echo esc_html(get_the_title()); ?></span>
                            </div>
                            <span class="hifi-brand-card__name"><?php the_title(); ?></span>
                        </a>
                        <?php
                    endwhile;
                    wp_reset_postdata();
                else :
                    // Fallback: mostra i brand dalla tassonomia
                    $brand_terms = get_terms(array(
                        'taxonomy'   => 'brand',
                        'hide_empty' => false,
                        'orderby'    => 'name',
                    ));

                    if ($brand_terms && !is_wp_error($brand_terms)) :
                        foreach ($brand_terms as $brand_term) :
                            ?>
                            <a href="<?php echo esc_url(get_term_link($brand_term)); ?>" class="hifi-brand-card hifi-reveal">
                                <div class="hifi-brand-card__logo">
                                    <span style="font-size: 1.5rem; font-weight: 700; color: var(--hifi-accent);"><?php echo esc_html($brand_term->name); ?></span>
                                </div>
                                <span class="hifi-brand-card__name"><?php echo esc_html($brand_term->name); ?></span>
                            </a>
                            <?php
                        endforeach;
                    endif;
                endif;
                ?>
            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>
