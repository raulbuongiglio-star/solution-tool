<?php
/**
 * Template Part: Sezione Testimonial / Recensioni.
 *
 * @package HiFiSolution
 */

defined('ABSPATH') || exit;

// Testimonial statici — possono essere sostituiti con un CPT o ACF Options
$testimonials = array(
    array(
        'quote'  => 'Professionalità e competenza straordinarie. Mi hanno guidato nella scelta dell\'impianto perfetto per la mia sala d\'ascolto. Un\'esperienza che consiglio a tutti gli appassionati.',
        'author' => 'Marco R.',
        'role'   => 'Audiofilo',
        'stars'  => 5,
    ),
    array(
        'quote'  => 'Dopo anni di ricerche, ho trovato in HiFi Solution il partner ideale. La sala d\'ascolto è un\'esperienza unica: poter confrontare i prodotti prima dell\'acquisto fa tutta la differenza.',
        'author' => 'Laura M.',
        'role'   => 'Musicista',
        'stars'  => 5,
    ),
    array(
        'quote'  => 'Servizio impeccabile dalla consulenza alla configurazione a casa. Il team di HiFi Solution ha trasformato il mio salotto in una sala concerti. Qualità e passione autentiche.',
        'author' => 'Giuseppe T.',
        'role'   => 'Cliente dal 2015',
        'stars'  => 5,
    ),
);
?>

<section class="hifi-section hifi-section--testimonials">
    <div class="hifi-container">
        <div class="hifi-section__header hifi-reveal">
            <span class="hifi-section__subtitle"><?php esc_html_e('Recensioni', 'hifisolution'); ?></span>
            <h2 class="hifi-section__title"><?php esc_html_e('Cosa dicono i nostri clienti', 'hifisolution'); ?></h2>
        </div>

        <div class="hifi-testimonials__grid">
            <?php foreach ($testimonials as $testimonial) : ?>
                <div class="hifi-testimonial hifi-reveal">
                    <div class="hifi-testimonial__stars">
                        <?php echo str_repeat('&#9733; ', $testimonial['stars']); ?>
                    </div>
                    <p class="hifi-testimonial__quote"><?php echo esc_html($testimonial['quote']); ?></p>
                    <div>
                        <div class="hifi-testimonial__author"><?php echo esc_html($testimonial['author']); ?></div>
                        <div class="hifi-testimonial__role"><?php echo esc_html($testimonial['role']); ?></div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
