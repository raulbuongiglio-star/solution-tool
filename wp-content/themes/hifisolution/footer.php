<?php
/**
 * Footer del tema HiFi Solution.
 *
 * @package HiFiSolution
 */

defined('ABSPATH') || exit;
?>

<footer id="colophon" class="site-footer">
    <div class="hifi-footer">
        <div class="hifi-container">
            <div class="hifi-footer__grid">

                <!-- Colonna 1: Info azienda -->
                <div>
                    <div class="hifi-header__brand" style="margin-bottom: 16px; display: inline-block;">
                        <span class="hifi-header__brand-name">HiFi</span>
                        <span class="hifi-header__brand-accent">Solution</span>
                    </div>
                    <p class="hifi-footer__desc">
                        <?php esc_html_e('Da oltre 40 anni, il punto di riferimento a Napoli per l\'audio hi-fi di alta gamma. Passione, competenza e prodotti selezionati per un\'esperienza d\'ascolto senza compromessi.', 'hifisolution'); ?>
                    </p>
                    <div class="hifi-footer__social">
                        <a href="https://www.facebook.com/hifisolution" target="_blank" rel="noopener noreferrer" aria-label="Facebook">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                        </a>
                        <a href="https://www.instagram.com/hifisolution" target="_blank" rel="noopener noreferrer" aria-label="Instagram">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                        </a>
                        <a href="https://www.youtube.com/hifisolution" target="_blank" rel="noopener noreferrer" aria-label="YouTube">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                        </a>
                    </div>
                </div>

                <!-- Colonna 2: Navigazione -->
                <div>
                    <h4 class="hifi-footer__title"><?php esc_html_e('Navigazione', 'hifisolution'); ?></h4>
                    <?php
                    wp_nav_menu(array(
                        'theme_location' => 'footer',
                        'container'      => false,
                        'menu_class'     => 'hifi-footer__links',
                        'depth'          => 1,
                        'fallback_cb'    => function () {
                            echo '<ul class="hifi-footer__links">';
                            echo '<li><a href="' . esc_url(home_url('/')) . '">' . esc_html__('Home', 'hifisolution') . '</a></li>';
                            echo '<li><a href="' . esc_url(home_url('/chi-siamo/')) . '">' . esc_html__('Chi Siamo', 'hifisolution') . '</a></li>';
                            echo '<li><a href="' . esc_url(get_post_type_archive_link('prodotto')) . '">' . esc_html__('Catalogo', 'hifisolution') . '</a></li>';
                            echo '<li><a href="' . esc_url(home_url('/marchi/')) . '">' . esc_html__('Brand', 'hifisolution') . '</a></li>';
                            echo '<li><a href="' . esc_url(home_url('/servizi/')) . '">' . esc_html__('Servizi', 'hifisolution') . '</a></li>';
                            echo '<li><a href="' . esc_url(home_url('/contatti/')) . '">' . esc_html__('Contatti', 'hifisolution') . '</a></li>';
                            echo '</ul>';
                        },
                    ));
                    ?>
                </div>

                <!-- Colonna 3: Categorie -->
                <div>
                    <h4 class="hifi-footer__title"><?php esc_html_e('Categorie', 'hifisolution'); ?></h4>
                    <ul class="hifi-footer__links">
                        <?php
                        $footer_cats = get_terms(array(
                            'taxonomy'   => 'categoria_prodotto',
                            'hide_empty' => false,
                            'parent'     => 0,
                        ));
                        if ($footer_cats && !is_wp_error($footer_cats)) :
                            foreach ($footer_cats as $cat) :
                                echo '<li><a href="' . esc_url(get_term_link($cat)) . '">' . esc_html($cat->name) . '</a></li>';
                            endforeach;
                        endif;
                        ?>
                    </ul>
                </div>

                <!-- Colonna 4: Contatti -->
                <div>
                    <h4 class="hifi-footer__title"><?php esc_html_e('Contatti', 'hifisolution'); ?></h4>
                    <ul class="hifi-footer__links">
                        <li style="margin-bottom: 12px;">
                            <span style="color: var(--hifi-text-muted); font-size: 0.8rem; display: block;"><?php esc_html_e('Indirizzo', 'hifisolution'); ?></span>
                            Via Massimo Stanzione 6<br>80129 Napoli (NA), Italia
                        </li>
                        <li style="margin-bottom: 12px;">
                            <span style="color: var(--hifi-text-muted); font-size: 0.8rem; display: block;"><?php esc_html_e('Telefono', 'hifisolution'); ?></span>
                            <a href="tel:+390812298596">+39 081 2298596</a>
                        </li>
                        <li style="margin-bottom: 12px;">
                            <span style="color: var(--hifi-text-muted); font-size: 0.8rem; display: block;"><?php esc_html_e('Email', 'hifisolution'); ?></span>
                            <a href="mailto:info@hs-hifi.it">info@hs-hifi.it</a><br>
                            <a href="mailto:info@hifisolution.it">info@hifisolution.it</a>
                        </li>
                        <li>
                            <span style="color: var(--hifi-text-muted); font-size: 0.8rem; display: block;"><?php esc_html_e('Shop Online', 'hifisolution'); ?></span>
                            <a href="<?php echo esc_url(HIFISOLUTION_SHOP_URL); ?>" target="_blank" rel="noopener noreferrer">hifisolution.it</a>
                        </li>
                    </ul>
                </div>

            </div>

            <!-- Footer Bottom -->
            <div class="hifi-footer__bottom">
                <div>
                    &copy; <?php echo esc_html(date('Y')); ?> HiFi Solution — <?php esc_html_e('Tutti i diritti riservati.', 'hifisolution'); ?>
                    | <a href="<?php echo esc_url(home_url('/privacy-policy/')); ?>"><?php esc_html_e('Privacy Policy', 'hifisolution'); ?></a>
                    | <a href="<?php echo esc_url(home_url('/cookie-policy/')); ?>"><?php esc_html_e('Cookie Policy', 'hifisolution'); ?></a>
                </div>
                <div>
                    P.IVA: 08014941218
                </div>
            </div>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
