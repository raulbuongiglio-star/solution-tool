<?php
/**
 * Template Part: Blog Preview — Ultimi 3 articoli.
 *
 * @package HiFiSolution
 */

defined('ABSPATH') || exit;

$latest_posts = new WP_Query(array(
    'post_type'      => 'post',
    'posts_per_page' => 3,
    'post_status'    => 'publish',
));

if (!$latest_posts->have_posts()) {
    return;
}
?>

<section class="hifi-section hifi-section--alt hifi-section--blog">
    <div class="hifi-container">
        <div class="hifi-section__header hifi-reveal">
            <span class="hifi-section__subtitle"><?php esc_html_e('Magazine', 'hifisolution'); ?></span>
            <h2 class="hifi-section__title"><?php esc_html_e('Dal nostro blog', 'hifisolution'); ?></h2>
            <p class="hifi-section__desc"><?php esc_html_e('Guide, recensioni, novità e consigli dal mondo dell\'audio hi-fi.', 'hifisolution'); ?></p>
        </div>

        <div class="hifi-blog__grid">
            <?php while ($latest_posts->have_posts()) : $latest_posts->the_post(); ?>
                <article class="hifi-blog-card hifi-reveal">
                    <?php if (has_post_thumbnail()) : ?>
                        <div class="hifi-blog-card__image">
                            <a href="<?php the_permalink(); ?>">
                                <?php the_post_thumbnail('hifi-blog-card', array(
                                    'alt'     => get_the_title(),
                                    'loading' => 'lazy',
                                )); ?>
                            </a>
                        </div>
                    <?php endif; ?>

                    <div class="hifi-blog-card__body">
                        <?php
                        $categories = get_the_category();
                        if ($categories) :
                        ?>
                            <div class="hifi-blog-card__category"><?php echo esc_html($categories[0]->name); ?></div>
                        <?php endif; ?>

                        <h3 class="hifi-blog-card__title">
                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        </h3>

                        <p class="hifi-blog-card__excerpt"><?php echo esc_html(wp_trim_words(get_the_excerpt(), 20)); ?></p>

                        <time class="hifi-blog-card__date" datetime="<?php echo esc_attr(get_the_date('c')); ?>">
                            <?php echo esc_html(get_the_date()); ?>
                        </time>
                    </div>
                </article>
            <?php endwhile; ?>
            <?php wp_reset_postdata(); ?>
        </div>

        <div class="hifi-text-center hifi-mt-4 hifi-reveal">
            <a href="<?php echo esc_url(get_permalink(get_option('page_for_posts'))); ?>" class="hifi-btn hifi-btn--outline">
                <?php esc_html_e('Tutti gli articoli', 'hifisolution'); ?>
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
            </a>
        </div>
    </div>
</section>
