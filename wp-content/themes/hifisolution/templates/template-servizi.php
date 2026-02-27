<?php
/**
 * Template Name: Servizi
 * Template Post Type: page
 *
 * @package HiFiSolution
 */

defined('ABSPATH') || exit;

get_header();
?>

<main id="primary" class="site-main hifi-services-page">

    <?php hifisolution_breadcrumbs(); ?>

    <section class="hifi-section">
        <div class="hifi-container">
            <div class="hifi-section__header hifi-reveal">
                <span class="hifi-section__subtitle"><?php esc_html_e('I nostri servizi', 'hifisolution'); ?></span>
                <h1 class="hifi-section__title"><?php esc_html_e('Al vostro servizio, sempre', 'hifisolution'); ?></h1>
                <p class="hifi-section__desc">
                    <?php esc_html_e('Offriamo un servizio completo: dalla consulenza all\'installazione, fino all\'assistenza post-vendita. Il nostro obiettivo è la vostra soddisfazione.', 'hifisolution'); ?>
                </p>
            </div>

            <div class="hifi-services__grid">

                <!-- Consulenza personalizzata -->
                <div class="hifi-service-card hifi-reveal">
                    <div class="hifi-service-card__icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                    </div>
                    <h2 class="hifi-service-card__title"><?php esc_html_e('Consulenza personalizzata', 'hifisolution'); ?></h2>
                    <p class="hifi-service-card__desc">
                        <?php esc_html_e('Ogni impianto hi-fi è unico come chi lo ascolta. I nostri esperti analizzano le vostre preferenze musicali, l\'ambiente di ascolto e il budget per proporvi la soluzione ideale. Non vendiamo prodotti: creiamo esperienze sonore su misura.', 'hifisolution'); ?>
                    </p>
                </div>

                <!-- Sala d'ascolto -->
                <div class="hifi-service-card hifi-reveal">
                    <div class="hifi-service-card__icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 18v-6a9 9 0 0 1 18 0v6"></path><path d="M21 19a2 2 0 0 1-2 2h-1a2 2 0 0 1-2-2v-3a2 2 0 0 1 2-2h3zM3 19a2 2 0 0 0 2 2h1a2 2 0 0 0 2-2v-3a2 2 0 0 0-2-2H3z"></path></svg>
                    </div>
                    <h2 class="hifi-service-card__title"><?php esc_html_e('Sala d\'ascolto su appuntamento', 'hifisolution'); ?></h2>
                    <p class="hifi-service-card__desc">
                        <?php esc_html_e('Prenotate una sessione nella nostra sala d\'ascolto acusticamente trattata. Portatevi la vostra musica preferita e confrontate i prodotti in condizioni ideali. Un\'esperienza esclusiva che vi aiuterà a fare la scelta giusta.', 'hifisolution'); ?>
                    </p>
                </div>

                <!-- Installazione -->
                <div class="hifi-service-card hifi-reveal">
                    <div class="hifi-service-card__icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"></path></svg>
                    </div>
                    <h2 class="hifi-service-card__title"><?php esc_html_e('Installazione e configurazione', 'hifisolution'); ?></h2>
                    <p class="hifi-service-card__desc">
                        <?php esc_html_e('Il posizionamento e la configurazione corretta sono fondamentali per ottenere il massimo dal vostro impianto. I nostri tecnici installano e ottimizzano l\'impianto direttamente a casa vostra, calibrando ogni dettaglio acustico.', 'hifisolution'); ?>
                    </p>
                </div>

                <!-- Assistenza post-vendita -->
                <div class="hifi-service-card hifi-reveal">
                    <div class="hifi-service-card__icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                    </div>
                    <h2 class="hifi-service-card__title"><?php esc_html_e('Assistenza post-vendita', 'hifisolution'); ?></h2>
                    <p class="hifi-service-card__desc">
                        <?php esc_html_e('Il nostro impegno non finisce con la vendita. Offriamo assistenza continua, manutenzione e supporto tecnico per garantire che il vostro impianto funzioni sempre al meglio. Siamo a vostra disposizione per qualsiasi necessità.', 'hifisolution'); ?>
                    </p>
                </div>

                <!-- Permuta usato -->
                <div class="hifi-service-card hifi-reveal">
                    <div class="hifi-service-card__icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="17 1 21 5 17 9"></polyline><path d="M3 11V9a4 4 0 0 1 4-4h14"></path><polyline points="7 23 3 19 7 15"></polyline><path d="M21 13v2a4 4 0 0 1-4 4H3"></path></svg>
                    </div>
                    <h2 class="hifi-service-card__title"><?php esc_html_e('Permuta usato', 'hifisolution'); ?></h2>
                    <p class="hifi-service-card__desc">
                        <?php esc_html_e('Volete fare un upgrade del vostro impianto? Valutiamo il vostro usato e vi offriamo una permuta vantaggiosa. Un modo intelligente per passare a un livello superiore senza sprechi.', 'hifisolution'); ?>
                    </p>
                </div>

                <!-- Spedizione -->
                <div class="hifi-service-card hifi-reveal">
                    <div class="hifi-service-card__icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="1" y="3" width="15" height="13"></rect><polygon points="16 8 20 8 23 11 23 16 16 16 16 8"></polygon><circle cx="5.5" cy="18.5" r="2.5"></circle><circle cx="18.5" cy="18.5" r="2.5"></circle></svg>
                    </div>
                    <h2 class="hifi-service-card__title"><?php esc_html_e('Spedizione in tutta Italia', 'hifisolution'); ?></h2>
                    <p class="hifi-service-card__desc">
                        <?php esc_html_e('Attraverso il nostro shop online hifisolution.it spediamo in tutta Italia con imballaggio professionale e assicurazione completa. I vostri prodotti arrivano in perfette condizioni, ovunque vi troviate.', 'hifisolution'); ?>
                    </p>
                </div>

            </div>
        </div>
    </section>

    <!-- CTA -->
    <section class="hifi-section hifi-section--alt">
        <div class="hifi-container hifi-text-center hifi-reveal">
            <h2 class="hifi-section__title"><?php esc_html_e('Hai bisogno di una consulenza?', 'hifisolution'); ?></h2>
            <p class="hifi-section__desc" style="margin-bottom: 32px;">
                <?php esc_html_e('Contattaci per una consulenza personalizzata o prenota una sessione nella nostra sala d\'ascolto.', 'hifisolution'); ?>
            </p>
            <div style="display: flex; gap: 16px; justify-content: center; flex-wrap: wrap;">
                <a href="<?php echo esc_url(home_url('/contatti/')); ?>" class="hifi-btn hifi-btn--primary">
                    <?php esc_html_e('Contattaci', 'hifisolution'); ?>
                </a>
                <a href="<?php echo esc_url(HIFISOLUTION_SHOP_URL); ?>" class="hifi-btn hifi-btn--outline" target="_blank" rel="noopener noreferrer">
                    <?php esc_html_e('Visita lo shop online', 'hifisolution'); ?>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path><polyline points="15 3 21 3 21 9"></polyline><line x1="10" y1="14" x2="21" y2="3"></line></svg>
                </a>
            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>
