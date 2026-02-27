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

                        $logo = '';
                        if (function_exists('get_field')) {
                            $logo_data = get_field('brand_logo');
                            if ($logo_data) {
                                $logo = $logo_data['url'];
                            }
                        }

                        if (!$logo && has_post_thumbnail()) {
                            $logo = get_the_post_thumbnail_url(get_the_ID(), 'hifi-brand-logo');
                        }
                        ?>
                        <a href="<?php the_permalink(); ?>" class="hifi-brand-card hifi-reveal">
                            <div class="hifi-brand-card__logo">
                                <?php if ($logo) : ?>
                                    <img src="<?php echo esc_url($logo); ?>" alt="<?php echo esc_attr(get_the_title()); ?>" loading="lazy">
                                <?php else : ?>
                                    <span style="font-size: 1.5rem; font-weight: 700; color: var(--hifi-accent);"><?php echo esc_html(mb_substr(get_the_title(), 0, 2)); ?></span>
                                <?php endif; ?>
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
                            $logo = get_term_meta($brand_term->term_id, 'brand_logo', true);
                            ?>
                            <a href="<?php echo esc_url(get_term_link($brand_term)); ?>" class="hifi-brand-card hifi-reveal">
                                <div class="hifi-brand-card__logo">
                                    <?php if ($logo) : ?>
                                        <img src="<?php echo esc_url($logo); ?>" alt="<?php echo esc_attr($brand_term->name); ?>" loading="lazy">
                                    <?php else : ?>
                                        <span style="font-size: 1.5rem; font-weight: 700; color: var(--hifi-accent);"><?php echo esc_html(mb_substr($brand_term->name, 0, 2)); ?></span>
                                    <?php endif; ?>
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
