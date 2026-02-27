<?php
/**
 * Template Name: Home Page
 * Template Post Type: page
 *
 * @package HiFiSolution
 */

defined('ABSPATH') || exit;

get_header();
?>

<main id="primary" class="site-main hifi-home">

    <!-- ===== HERO SECTION ===== -->
    <?php get_template_part('template-parts/hero', 'section'); ?>

    <!-- ===== BRAND CAROUSEL ===== -->
    <?php get_template_part('template-parts/brand', 'carousel'); ?>

    <!-- ===== CHI SIAMO BREVE ===== -->
    <section class="hifi-section hifi-section--about">
        <div class="hifi-container">
            <div class="hifi-section__header hifi-reveal">
                <span class="hifi-section__subtitle"><?php esc_html_e('Dal 1985', 'hifisolution'); ?></span>
                <h2 class="hifi-section__title"><?php esc_html_e('La passione per il suono perfetto', 'hifisolution'); ?></h2>
                <p class="hifi-section__desc">
                    <?php esc_html_e('Da oltre 40 anni, HiFi Solution è il punto di riferimento a Napoli per gli appassionati di audio di alta gamma. Il nostro impegno è offrire un\'esperienza d\'ascolto senza compromessi, guidati dalla passione e dalla competenza.', 'hifisolution'); ?>
                </p>
            </div>
            <div class="hifi-text-center hifi-reveal">
                <a href="<?php echo esc_url(home_url('/chi-siamo/')); ?>" class="hifi-btn hifi-btn--outline">
                    <?php esc_html_e('Scopri la nostra storia', 'hifisolution'); ?>
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                </a>
            </div>
        </div>
    </section>

    <!-- ===== CATEGORIE PRODOTTO ===== -->
    <?php get_template_part('template-parts/category', 'grid'); ?>

    <!-- ===== PERCHÉ SCEGLIERCI ===== -->
    <section class="hifi-section hifi-section--strengths">
        <div class="hifi-container">
            <div class="hifi-section__header hifi-reveal">
                <span class="hifi-section__subtitle"><?php esc_html_e('I nostri punti di forza', 'hifisolution'); ?></span>
                <h2 class="hifi-section__title"><?php esc_html_e('Perché scegliere HiFi Solution', 'hifisolution'); ?></h2>
            </div>

            <div class="hifi-strengths__grid">
                <div class="hifi-strength hifi-reveal">
                    <div class="hifi-strength__icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                    </div>
                    <h3 class="hifi-strength__title"><?php esc_html_e('Oltre 40 anni di esperienza', 'hifisolution'); ?></h3>
                    <p class="hifi-strength__desc"><?php esc_html_e('Dal 1985 selezioniamo i migliori prodotti audio hi-fi per i nostri clienti, con competenza e dedizione.', 'hifisolution'); ?></p>
                </div>

                <div class="hifi-strength hifi-reveal">
                    <div class="hifi-strength__icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 18v-6a9 9 0 0 1 18 0v6"></path><path d="M21 19a2 2 0 0 1-2 2h-1a2 2 0 0 1-2-2v-3a2 2 0 0 1 2-2h3zM3 19a2 2 0 0 0 2 2h1a2 2 0 0 0 2-2v-3a2 2 0 0 0-2-2H3z"></path></svg>
                    </div>
                    <h3 class="hifi-strength__title"><?php esc_html_e('Sala d\'ascolto dedicata', 'hifisolution'); ?></h3>
                    <p class="hifi-strength__desc"><?php esc_html_e('Un ambiente acusticamente trattato dove potrai ascoltare e confrontare i prodotti prima dell\'acquisto.', 'hifisolution'); ?></p>
                </div>

                <div class="hifi-strength hifi-reveal">
                    <div class="hifi-strength__icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                    </div>
                    <h3 class="hifi-strength__title"><?php esc_html_e('Consulenza personalizzata', 'hifisolution'); ?></h3>
                    <p class="hifi-strength__desc"><?php esc_html_e('Ti guidiamo nella scelta dell\'impianto perfetto per le tue esigenze, il tuo ambiente e il tuo budget.', 'hifisolution'); ?></p>
                </div>

                <div class="hifi-strength hifi-reveal">
                    <div class="hifi-strength__icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                    </div>
                    <h3 class="hifi-strength__title"><?php esc_html_e('Assistenza post-vendita', 'hifisolution'); ?></h3>
                    <p class="hifi-strength__desc"><?php esc_html_e('Il nostro supporto non finisce con l\'acquisto. Installazione, configurazione e assistenza continua.', 'hifisolution'); ?></p>
                </div>
            </div>
        </div>
    </section>

    <!-- ===== PRODOTTI IN EVIDENZA ===== -->
    <section class="hifi-section hifi-section--alt hifi-section--featured">
        <div class="hifi-container">
            <div class="hifi-section__header hifi-reveal">
                <span class="hifi-section__subtitle"><?php esc_html_e('Selezione', 'hifisolution'); ?></span>
                <h2 class="hifi-section__title"><?php esc_html_e('Prodotti in evidenza', 'hifisolution'); ?></h2>
                <p class="hifi-section__desc"><?php esc_html_e('Una selezione dei migliori prodotti audio hi-fi scelti per voi dai nostri esperti.', 'hifisolution'); ?></p>
            </div>

            <div class="hifi-products__grid">
                <?php
                $featured = hifisolution_get_featured_products(8);
                if ($featured->have_posts()) :
                    while ($featured->have_posts()) :
                        $featured->the_post();
                        get_template_part('template-parts/content', 'prodotto-card');
                    endwhile;
                    wp_reset_postdata();
                else :
                    // Fallback: ultimi prodotti
                    $latest = new WP_Query(array(
                        'post_type'      => 'prodotto',
                        'posts_per_page' => 8,
                    ));
                    if ($latest->have_posts()) :
                        while ($latest->have_posts()) :
                            $latest->the_post();
                            get_template_part('template-parts/content', 'prodotto-card');
                        endwhile;
                        wp_reset_postdata();
                    endif;
                endif;
                ?>
            </div>

            <div class="hifi-text-center hifi-mt-4 hifi-reveal">
                <a href="<?php echo esc_url(get_post_type_archive_link('prodotto')); ?>" class="hifi-btn hifi-btn--outline">
                    <?php esc_html_e('Vedi tutto il catalogo', 'hifisolution'); ?>
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                </a>
            </div>
        </div>
    </section>

    <!-- ===== TESTIMONIAL ===== -->
    <?php get_template_part('template-parts/testimonials'); ?>

    <!-- ===== BLOG PREVIEW ===== -->
    <?php get_template_part('template-parts/blog', 'preview'); ?>

    <!-- ===== CTA CONTATTI / MAPPA ===== -->
    <section class="hifi-section hifi-section--alt hifi-section--cta-map">
        <div class="hifi-container">
            <div class="hifi-section__header hifi-reveal">
                <span class="hifi-section__subtitle"><?php esc_html_e('Vieni a trovarci', 'hifisolution'); ?></span>
                <h2 class="hifi-section__title"><?php esc_html_e('Il nostro negozio a Napoli', 'hifisolution'); ?></h2>
                <p class="hifi-section__desc"><?php esc_html_e('Visita il nostro showroom per un\'esperienza d\'ascolto unica. Prenota una sessione nella nostra sala d\'ascolto dedicata.', 'hifisolution'); ?></p>
            </div>

            <div class="hifi-text-center hifi-reveal" style="margin-bottom: 40px;">
                <a href="<?php echo esc_url(home_url('/contatti/')); ?>" class="hifi-btn hifi-btn--primary">
                    <?php esc_html_e('Contattaci', 'hifisolution'); ?>
                </a>
            </div>

            <div class="hifi-map hifi-reveal">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3019.123456789!2d14.2681!3d40.8518!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2sHiFi+Solution!5e0!3m2!1sit!2sit!4v1234567890"
                    width="100%"
                    height="400"
                    style="border:0;"
                    allowfullscreen=""
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"
                    title="<?php esc_attr_e('Mappa HiFi Solution Napoli', 'hifisolution'); ?>">
                </iframe>
            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>
