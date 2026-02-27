<?php
/**
 * Template per la pagina 404 — Pagina non trovata.
 *
 * @package HiFiSolution
 */

defined('ABSPATH') || exit;

get_header();
?>

<main id="primary" class="site-main">

    <?php hifisolution_breadcrumbs(); ?>

    <section class="hifi-section" style="min-height: 60vh; display: flex; align-items: center;">
        <div class="hifi-container hifi-text-center">
            <div class="hifi-reveal revealed">
                <p style="font-size: 8rem; font-weight: 700; color: var(--hifi-accent); line-height: 1; margin-bottom: 16px;">404</p>
                <h1 style="font-size: 1.75rem; margin-bottom: 16px;"><?php esc_html_e('Pagina non trovata', 'hifisolution'); ?></h1>
                <p class="hifi-section__desc" style="margin-bottom: 32px;">
                    <?php esc_html_e('La pagina che stai cercando non esiste o è stata spostata. Prova a navigare dal menu o a cercare nel nostro catalogo.', 'hifisolution'); ?>
                </p>
                <div style="display: flex; gap: 16px; justify-content: center; flex-wrap: wrap;">
                    <a href="<?php echo esc_url(home_url('/')); ?>" class="hifi-btn hifi-btn--primary">
                        <?php esc_html_e('Torna alla Home', 'hifisolution'); ?>
                    </a>
                    <a href="<?php echo esc_url(get_post_type_archive_link('prodotto')); ?>" class="hifi-btn hifi-btn--outline">
                        <?php esc_html_e('Vai al Catalogo', 'hifisolution'); ?>
                    </a>
                </div>
            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>
