<?php
/**
 * Template Name: Contatti
 * Template Post Type: page
 *
 * @package HiFiSolution
 */

defined('ABSPATH') || exit;

get_header();
?>

<main id="primary" class="site-main hifi-contact-page">

    <?php hifisolution_breadcrumbs(); ?>

    <section class="hifi-section">
        <div class="hifi-container">
            <div class="hifi-section__header hifi-reveal">
                <span class="hifi-section__subtitle"><?php esc_html_e('Contatti', 'hifisolution'); ?></span>
                <h1 class="hifi-section__title"><?php esc_html_e('Parliamo del tuo impianto ideale', 'hifisolution'); ?></h1>
                <p class="hifi-section__desc">
                    <?php esc_html_e('Siamo a tua disposizione per qualsiasi informazione, consulenza o per prenotare una sessione d\'ascolto nel nostro showroom.', 'hifisolution'); ?>
                </p>
            </div>

            <div class="hifi-contact__grid">

                <!-- Informazioni di contatto -->
                <div class="hifi-contact-info hifi-reveal">

                    <div class="hifi-contact-info__item">
                        <div class="hifi-contact-info__icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                        </div>
                        <div>
                            <div class="hifi-contact-info__label"><?php esc_html_e('Indirizzo', 'hifisolution'); ?></div>
                            <div class="hifi-contact-info__value">
                                HiFi Solution<br>
                                Via Massimo Stanzione 6<br>
                                80129 Napoli (NA), Italia
                            </div>
                        </div>
                    </div>

                    <div class="hifi-contact-info__item">
                        <div class="hifi-contact-info__icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
                        </div>
                        <div>
                            <div class="hifi-contact-info__label"><?php esc_html_e('Telefono', 'hifisolution'); ?></div>
                            <div class="hifi-contact-info__value">
                                <a href="tel:+390812298596">+39 081 2298596</a>
                            </div>
                        </div>
                    </div>

                    <div class="hifi-contact-info__item">
                        <div class="hifi-contact-info__icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                        </div>
                        <div>
                            <div class="hifi-contact-info__label"><?php esc_html_e('Email', 'hifisolution'); ?></div>
                            <div class="hifi-contact-info__value">
                                <a href="mailto:info@hs-hifi.it">info@hs-hifi.it</a><br>
                                <a href="mailto:info@hifisolution.it">info@hifisolution.it</a>
                            </div>
                        </div>
                    </div>

                    <div class="hifi-contact-info__item">
                        <div class="hifi-contact-info__icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                        </div>
                        <div>
                            <div class="hifi-contact-info__label"><?php esc_html_e('Orari di apertura', 'hifisolution'); ?></div>
                            <div class="hifi-contact-info__value">
                                <?php esc_html_e('Lun — Ven: 9:30 — 13:00 / 16:00 — 19:30', 'hifisolution'); ?><br>
                                <?php esc_html_e('Sab: 9:30 — 13:00', 'hifisolution'); ?><br>
                                <?php esc_html_e('Dom: Chiuso', 'hifisolution'); ?>
                            </div>
                        </div>
                    </div>

                    <!-- WhatsApp CTA -->
                    <div style="margin-top: 16px;">
                        <a href="https://wa.me/393663317291?text=Salve%2C%20vorrei%20informazioni%20sui%20vostri%20prodotti%20hi-fi" class="hifi-btn hifi-btn--whatsapp" target="_blank" rel="noopener noreferrer">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                            <?php esc_html_e('Scrivici su WhatsApp', 'hifisolution'); ?>
                        </a>
                    </div>

                    <!-- Social -->
                    <div style="margin-top: 24px;">
                        <div class="hifi-contact-info__label"><?php esc_html_e('Seguici', 'hifisolution'); ?></div>
                        <div class="hifi-footer__social" style="margin-top: 8px;">
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
                </div>

                <!-- Form di contatto -->
                <div class="hifi-reveal">
                    <div style="background-color: var(--hifi-bg-card); padding: 40px; border-radius: var(--hifi-radius-lg); border: 1px solid var(--hifi-border);">
                        <h2 style="font-size: 1.25rem; margin-bottom: 24px;"><?php esc_html_e('Inviaci un messaggio', 'hifisolution'); ?></h2>

                        <div class="hifi-form">
                            <?php
                            // Se WPForms è attivo, mostra il form
                            if (function_exists('wpforms_display')) {
                                // L'ID del form va configurato in WPForms
                                echo do_shortcode('[wpforms id="CONTACT_FORM_ID"]');
                            } else {
                                // Form HTML di fallback
                                ?>
                                <form method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>" class="hifi-contact-form">
                                    <input type="hidden" name="action" value="hifi_contact_form">
                                    <?php wp_nonce_field('hifi_contact', 'hifi_contact_nonce'); ?>

                                    <div style="margin-bottom: 20px;">
                                        <label for="hifi-name"><?php esc_html_e('Nome e Cognome *', 'hifisolution'); ?></label>
                                        <input type="text" id="hifi-name" name="hifi_name" required>
                                    </div>

                                    <div style="margin-bottom: 20px;">
                                        <label for="hifi-email"><?php esc_html_e('Email *', 'hifisolution'); ?></label>
                                        <input type="email" id="hifi-email" name="hifi_email" required>
                                    </div>

                                    <div style="margin-bottom: 20px;">
                                        <label for="hifi-phone"><?php esc_html_e('Telefono', 'hifisolution'); ?></label>
                                        <input type="tel" id="hifi-phone" name="hifi_phone">
                                    </div>

                                    <div style="margin-bottom: 20px;">
                                        <label for="hifi-interest"><?php esc_html_e('Interesse per', 'hifisolution'); ?></label>
                                        <select id="hifi-interest" name="hifi_interest">
                                            <option value=""><?php esc_html_e('Seleziona...', 'hifisolution'); ?></option>
                                            <option value="diffusori"><?php esc_html_e('Diffusori e Casse', 'hifisolution'); ?></option>
                                            <option value="amplificatori"><?php esc_html_e('Amplificatori', 'hifisolution'); ?></option>
                                            <option value="giradischi"><?php esc_html_e('Giradischi', 'hifisolution'); ?></option>
                                            <option value="sorgenti"><?php esc_html_e('Sorgenti Digitali', 'hifisolution'); ?></option>
                                            <option value="cuffie"><?php esc_html_e('Cuffie', 'hifisolution'); ?></option>
                                            <option value="sistemi"><?php esc_html_e('Sistemi Completi', 'hifisolution'); ?></option>
                                            <option value="consulenza"><?php esc_html_e('Consulenza', 'hifisolution'); ?></option>
                                            <option value="sala-ascolto"><?php esc_html_e('Prenotazione Sala d\'Ascolto', 'hifisolution'); ?></option>
                                            <option value="altro"><?php esc_html_e('Altro', 'hifisolution'); ?></option>
                                        </select>
                                    </div>

                                    <div style="margin-bottom: 20px;">
                                        <label for="hifi-message"><?php esc_html_e('Messaggio *', 'hifisolution'); ?></label>
                                        <textarea id="hifi-message" name="hifi_message" rows="5" required></textarea>
                                    </div>

                                    <button type="submit" class="hifi-btn hifi-btn--primary" style="width: 100%; justify-content: center;">
                                        <?php esc_html_e('Invia messaggio', 'hifisolution'); ?>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="22" y1="2" x2="11" y2="13"></line><polygon points="22 2 15 22 11 13 2 9 22 2"></polygon></svg>
                                    </button>
                                </form>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Mappa -->
    <section class="hifi-section hifi-section--alt">
        <div class="hifi-container">
            <div class="hifi-section__header hifi-reveal">
                <h2 class="hifi-section__title"><?php esc_html_e('Dove trovarci', 'hifisolution'); ?></h2>
            </div>
            <div class="hifi-map hifi-reveal">
                <iframe
                    src="https://www.google.com/maps?q=Via+Massimo+Stanzione+6,+80129+Napoli,+Italia&output=embed"
                    width="100%"
                    height="450"
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
