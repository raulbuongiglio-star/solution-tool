<?php
/**
 * Template Part: Hero Section per la Home Page.
 *
 * @package HiFiSolution
 */

defined('ABSPATH') || exit;
?>

<section class="hifi-hero">
    <div class="hifi-hero__bg">
        <img src="<?php echo esc_url(HIFISOLUTION_URI . '/assets/images/placeholder-hero.jpg'); ?>"
             alt="<?php esc_attr_e('HiFi Solution — Audio Hi-Fi di alta gamma', 'hifisolution'); ?>">
    </div>
    <div class="hifi-hero__overlay"></div>

    <div class="hifi-hero__content">
        <p class="hifi-hero__tagline"><?php esc_html_e('Audio Hi-Fi di alta gamma — Dal 1985', 'hifisolution'); ?></p>
        <h1 class="hifi-hero__title">
            <?php esc_html_e('L\'arte dell\'ascolto', 'hifisolution'); ?>
            <em><?php esc_html_e('perfetto', 'hifisolution'); ?></em>
        </h1>
        <p class="hifi-hero__desc">
            <?php esc_html_e('Da oltre 40 anni selezioniamo i migliori prodotti audio hi-fi per offrirvi un\'esperienza d\'ascolto senza compromessi. Benvenuti nel mondo HiFi Solution.', 'hifisolution'); ?>
        </p>
        <div class="hifi-hero__actions">
            <a href="<?php echo esc_url(get_post_type_archive_link('prodotto')); ?>" class="hifi-btn hifi-btn--primary">
                <?php esc_html_e('Esplora il catalogo', 'hifisolution'); ?>
            </a>
            <a href="<?php echo esc_url(home_url('/contatti/')); ?>" class="hifi-btn hifi-btn--outline">
                <?php esc_html_e('Prenota un ascolto', 'hifisolution'); ?>
            </a>
        </div>
    </div>

    <div class="hifi-hero__scroll">
        <span><?php esc_html_e('Scorri', 'hifisolution'); ?></span>
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <polyline points="6 9 12 15 18 9"></polyline>
        </svg>
    </div>
</section>
