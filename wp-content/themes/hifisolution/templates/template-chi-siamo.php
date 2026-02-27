<?php
/**
 * Template Name: Chi Siamo
 * Template Post Type: page
 *
 * @package HiFiSolution
 */

defined('ABSPATH') || exit;

get_header();
?>

<main id="primary" class="site-main hifi-about">

    <?php hifisolution_breadcrumbs(); ?>

    <!-- ===== HERO CHI SIAMO ===== -->
    <section class="hifi-section">
        <div class="hifi-container">
            <div class="hifi-section__header hifi-reveal">
                <span class="hifi-section__subtitle"><?php esc_html_e('La nostra storia', 'hifisolution'); ?></span>
                <h1 class="hifi-section__title"><?php esc_html_e('Oltre 40 anni di passione per il suono', 'hifisolution'); ?></h1>
                <p class="hifi-section__desc">
                    <?php esc_html_e('Dal 1985, HiFi Solution è sinonimo di eccellenza nell\'audio hi-fi a Napoli. Una storia fatta di passione, competenza e dedizione al suono perfetto.', 'hifisolution'); ?>
                </p>
            </div>
        </div>
    </section>

    <!-- ===== FILOSOFIA ===== -->
    <section class="hifi-section hifi-section--alt">
        <div class="hifi-container">
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 60px; align-items: center;">
                <div class="hifi-reveal">
                    <span class="hifi-section__subtitle"><?php esc_html_e('La nostra filosofia', 'hifisolution'); ?></span>
                    <h2 style="margin-bottom: 20px;"><?php esc_html_e('L\'ascolto è un\'arte', 'hifisolution'); ?></h2>
                    <p><?php esc_html_e('Crediamo che la musica meriti di essere ascoltata come l\'artista l\'ha concepita. Per questo selezioniamo solo prodotti che rispettano la fedeltà del suono originale, senza compromessi.', 'hifisolution'); ?></p>
                    <p><?php esc_html_e('Ogni cliente è unico, con gusti musicali, ambienti e budget differenti. Il nostro approccio è sempre personalizzato: ascoltiamo le vostre esigenze e vi guidiamo verso la soluzione perfetta.', 'hifisolution'); ?></p>
                    <p><?php esc_html_e('Non vendiamo semplicemente apparecchi: creiamo esperienze d\'ascolto che trasformano il modo in cui vivete la musica.', 'hifisolution'); ?></p>
                </div>
                <div class="hifi-reveal">
                    <img src="<?php echo esc_url(HIFISOLUTION_URI . '/assets/images/placeholder-about.jpg'); ?>"
                         alt="<?php esc_attr_e('Showroom HiFi Solution Napoli', 'hifisolution'); ?>"
                         style="width: 100%; border-radius: var(--hifi-radius-lg); border: 1px solid var(--hifi-border);"
                         loading="lazy">
                </div>
            </div>
        </div>
    </section>

    <!-- ===== TIMELINE ===== -->
    <section class="hifi-section">
        <div class="hifi-container">
            <div class="hifi-section__header hifi-reveal">
                <span class="hifi-section__subtitle"><?php esc_html_e('La nostra storia', 'hifisolution'); ?></span>
                <h2 class="hifi-section__title"><?php esc_html_e('Un percorso di eccellenza', 'hifisolution'); ?></h2>
            </div>

            <div class="hifi-timeline">
                <div class="hifi-timeline__item hifi-reveal">
                    <div class="hifi-timeline__content">
                        <div class="hifi-timeline__year">1985</div>
                        <p class="hifi-timeline__text"><?php esc_html_e('Nasce HiFi Solution a Napoli, con la passione per l\'audio di qualità e la missione di portare il meglio dell\'hi-fi nella città partenopea.', 'hifisolution'); ?></p>
                    </div>
                    <div class="hifi-timeline__dot"></div>
                </div>

                <div class="hifi-timeline__item hifi-reveal">
                    <div class="hifi-timeline__content">
                        <div class="hifi-timeline__year">1990</div>
                        <p class="hifi-timeline__text"><?php esc_html_e('Diventiamo rivenditori autorizzati dei principali brand internazionali. La nostra reputazione cresce tra gli audiofili campani.', 'hifisolution'); ?></p>
                    </div>
                    <div class="hifi-timeline__dot"></div>
                </div>

                <div class="hifi-timeline__item hifi-reveal">
                    <div class="hifi-timeline__content">
                        <div class="hifi-timeline__year">2000</div>
                        <p class="hifi-timeline__text"><?php esc_html_e('Inaugurazione della sala d\'ascolto dedicata: un ambiente progettato per offrire sessioni di ascolto esclusive ai nostri clienti.', 'hifisolution'); ?></p>
                    </div>
                    <div class="hifi-timeline__dot"></div>
                </div>

                <div class="hifi-timeline__item hifi-reveal">
                    <div class="hifi-timeline__content">
                        <div class="hifi-timeline__year">2010</div>
                        <p class="hifi-timeline__text"><?php esc_html_e('Ampliamento dell\'offerta con sorgenti digitali, streaming hi-res e sistemi multiroom di ultima generazione.', 'hifisolution'); ?></p>
                    </div>
                    <div class="hifi-timeline__dot"></div>
                </div>

                <div class="hifi-timeline__item hifi-reveal">
                    <div class="hifi-timeline__content">
                        <div class="hifi-timeline__year">2020</div>
                        <p class="hifi-timeline__text"><?php esc_html_e('Lancio dello shop online hifisolution.it, per raggiungere gli appassionati di audio hi-fi in tutta Italia.', 'hifisolution'); ?></p>
                    </div>
                    <div class="hifi-timeline__dot"></div>
                </div>

                <div class="hifi-timeline__item hifi-reveal">
                    <div class="hifi-timeline__content">
                        <div class="hifi-timeline__year"><?php esc_html_e('Oggi', 'hifisolution'); ?></div>
                        <p class="hifi-timeline__text"><?php esc_html_e('Continuiamo a innovare e a selezionare il meglio dell\'audio hi-fi mondiale, rimanendo fedeli alla nostra missione originale: offrire un\'esperienza d\'ascolto senza compromessi.', 'hifisolution'); ?></p>
                    </div>
                    <div class="hifi-timeline__dot"></div>
                </div>
            </div>
        </div>
    </section>

    <!-- ===== SALA D'ASCOLTO ===== -->
    <section class="hifi-section hifi-section--alt">
        <div class="hifi-container">
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 60px; align-items: center;">
                <div class="hifi-reveal">
                    <img src="<?php echo esc_url(HIFISOLUTION_URI . '/assets/images/placeholder-sala-ascolto.jpg'); ?>"
                         alt="<?php esc_attr_e('Sala d\'ascolto HiFi Solution', 'hifisolution'); ?>"
                         style="width: 100%; border-radius: var(--hifi-radius-lg); border: 1px solid var(--hifi-border);"
                         loading="lazy">
                </div>
                <div class="hifi-reveal">
                    <span class="hifi-section__subtitle"><?php esc_html_e('Un\'esperienza unica', 'hifisolution'); ?></span>
                    <h2 style="margin-bottom: 20px;"><?php esc_html_e('La nostra sala d\'ascolto', 'hifisolution'); ?></h2>
                    <p><?php esc_html_e('Il cuore del nostro negozio è la sala d\'ascolto: un ambiente acusticamente trattato e progettato per offrire le condizioni ideali di ascolto.', 'hifisolution'); ?></p>
                    <p><?php esc_html_e('Qui potrai confrontare diffusori, amplificatori e sorgenti in condizioni ottimali, con la musica che preferisci. Un\'esperienza che va oltre il semplice acquisto: è un viaggio nel suono.', 'hifisolution'); ?></p>
                    <p><?php esc_html_e('Prenota una sessione di ascolto personalizzata e scopri la differenza che fa un impianto hi-fi di alta gamma.', 'hifisolution'); ?></p>
                    <div class="hifi-mt-2">
                        <a href="<?php echo esc_url(home_url('/contatti/')); ?>" class="hifi-btn hifi-btn--primary">
                            <?php esc_html_e('Prenota una sessione', 'hifisolution'); ?>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ===== VALORI ===== -->
    <section class="hifi-section">
        <div class="hifi-container">
            <div class="hifi-section__header hifi-reveal">
                <span class="hifi-section__subtitle"><?php esc_html_e('I nostri valori', 'hifisolution'); ?></span>
                <h2 class="hifi-section__title"><?php esc_html_e('Cosa ci guida ogni giorno', 'hifisolution'); ?></h2>
            </div>

            <div class="hifi-strengths__grid">
                <div class="hifi-strength hifi-reveal">
                    <div class="hifi-strength__icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg>
                    </div>
                    <h3 class="hifi-strength__title"><?php esc_html_e('Passione', 'hifisolution'); ?></h3>
                    <p class="hifi-strength__desc"><?php esc_html_e('Siamo audiofili prima che venditori. La nostra passione per il suono è il motore di tutto ciò che facciamo.', 'hifisolution'); ?></p>
                </div>

                <div class="hifi-strength hifi-reveal">
                    <div class="hifi-strength__icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"></path><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"></path></svg>
                    </div>
                    <h3 class="hifi-strength__title"><?php esc_html_e('Competenza', 'hifisolution'); ?></h3>
                    <p class="hifi-strength__desc"><?php esc_html_e('40 anni di esperienza ci hanno dato una conoscenza profonda del mondo dell\'audio hi-fi e delle sue sfumature.', 'hifisolution'); ?></p>
                </div>

                <div class="hifi-strength hifi-reveal">
                    <div class="hifi-strength__icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                    </div>
                    <h3 class="hifi-strength__title"><?php esc_html_e('Servizio personalizzato', 'hifisolution'); ?></h3>
                    <p class="hifi-strength__desc"><?php esc_html_e('Ogni cliente merita un\'attenzione unica. Ascoltiamo le vostre esigenze per creare la soluzione audio perfetta.', 'hifisolution'); ?></p>
                </div>
            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>
