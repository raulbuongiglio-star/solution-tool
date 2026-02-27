<?php
/**
 * Importazione Prodotti Rotel.
 *
 * Crea 39 prodotti Rotel nel catalogo.
 * Attivazione: visita /wp-admin/?hifi_import_rotel=1
 *
 * @package HiFiSolution
 */

defined('ABSPATH') || exit;

/**
 * Handler di importazione Rotel.
 */
function hifisolution_import_rotel() {
    if (!isset($_GET['hifi_import_rotel']) || $_GET['hifi_import_rotel'] !== '1') {
        return;
    }

    if (!current_user_can('manage_options')) {
        wp_die('Accesso non autorizzato.');
    }

    // Evita doppia importazione.
    if (get_option('hifi_rotel_imported')) {
        add_action('admin_notices', function () {
            echo '<div class="notice notice-warning"><p><strong>Rotel:</strong> I prodotti sono gi&agrave; stati importati.</p></div>';
        });
        return;
    }

    // Serve per media_sideload_image.
    require_once ABSPATH . 'wp-admin/includes/media.php';
    require_once ABSPATH . 'wp-admin/includes/file.php';
    require_once ABSPATH . 'wp-admin/includes/image.php';

    // Base URL per le immagini gallery.
    $gallery_base = 'https://www.audiogamma.it/caricamenti/gallery_prodotti/';

    // ---------- Definizione dei 39 prodotti ----------

    $products = array(

        // ===== SERIE DIAMOND =====

        // 1. Rotel RA-6000
        array(
            'title'     => 'Rotel RA-6000',
            'slug'      => 'rotel-ra-6000',
            'subtitle'  => 'Amplificatore Integrato Stereo',
            'cats'      => array('amplificazioni', 'integrati-stereo'),
            'front_url' => $gallery_base . 'Rotel-RA-6000-black.jpg',
            'back_url'  => $gallery_base . 'Rotel-RA-6000-back.jpg',
            'excerpt'   => 'Amplificatore integrato stereo da 200W per canale su 8 ohm con DAC 32-bit/384kHz, Bluetooth aptX HD e supporto MQA. Disponibile in finitura Nero e Silver.',
            'content'   => '<p>Il <strong>Rotel RA-6000</strong> celebra il 60esimo anniversario del marchio con 200W RMS su 8 ohm e 350W su 4 ohm, circuitazione dual-mono e stadio finale ad alta corrente. Il DAC Texas Instruments a 32-bit/384kHz, il supporto MQA e la certificazione Roon completano un amplificatore di riferimento per la Serie Diamond.</p>',
            'specs'     => array(
                array('Potenza', '200W/ch (8\u03A9), 350W/ch (4\u03A9)'),
                array('THD', '<0.0075%'),
                array('Fattore di smorzamento', '600'),
                array('DAC', 'Texas Instruments 32-bit/384kHz'),
                array('Bluetooth', 'aptX HD'),
                array('Ingressi', 'USB, XLR, RCA, Phono MM, 3 ottici, 3 coassiali'),
                array('Dimensioni', '431x144x425mm'),
                array('Peso', '18.8 kg'),
            ),
        ),

        // 2. Rotel DT-6000
        array(
            'title'     => 'Rotel DT-6000',
            'slug'      => 'rotel-dt-6000',
            'subtitle'  => 'Lettore CD e Convertitore DAC',
            'cats'      => array('sorgenti', 'lettori-cd-sacd'),
            'front_url' => $gallery_base . 'Rotel-DT-6000-black.jpg',
            'back_url'  => $gallery_base . 'Rotel-DT-6000-back.jpg',
            'excerpt'   => 'Lettore CD e DAC Serie Diamond con convertitore ESS Sabre ES9028PRO, supporto MQA e DSD nativo. Disponibile in finitura Nero e Silver.',
            'content'   => '<p>Il <strong>Rotel DT-6000</strong> e il lettore CD e DAC della Serie Diamond per il 60esimo anniversario. Equipaggiato con DAC ESS Sabre ES9028PRO a 8 canali, supporta MQA, DSD nativo fino a 11.2MHz e risoluzioni PCM fino a 32-bit/384kHz. Vincitore del premio EISA High Stereo System 2022-2023.</p>',
            'specs'     => array(
                array('THD', '<0.0007%'),
                array('Risposta in frequenza', '10Hz-70kHz'),
                array('Rapporto S/N', '>115dB'),
                array('Gamma dinamica', '>99dB'),
                array('DAC', 'ESS Sabre ES9028PRO'),
                array('Uscite', 'RCA, XLR bilanciate'),
                array('Ingressi digitali', 'Ottico, Coassiale, USB-B'),
                array('Dimensioni', '431x104x320mm'),
                array('Peso', '8.1 kg'),
            ),
        ),

        // ===== SERIE MICHI =====

        // 3. Rotel Michi P5 S2
        array(
            'title'     => 'Rotel Michi P5 S2',
            'slug'      => 'rotel-michi-p5-s2',
            'subtitle'  => 'Preamplificatore Stereo',
            'cats'      => array('amplificazioni', 'preamplificatori-stereo'),
            'front_url' => $gallery_base . 'rotel-Michi-P5-S2_front.jpg',
            'back_url'  => $gallery_base . 'rotel-Michi-P5-S2_back.jpg',
            'excerpt'   => 'Preamplificatore stereo con doppio DAC ESS Sabre ES9028PRO in configurazione mono, Bluetooth aptX HD, phono MM/MC e doppi trasformatori toroidali.',
            'content'   => '<p>Il <strong>Rotel Michi P5 S2</strong> e un preamplificatore stereo con doppio convertitore ESS Sabre ES9028PRO a 8 canali in configurazione mono per canale. Supporta MQA e DSD con 17 regolatori di tensione indipendenti e doppi trasformatori toroidali. Connettivita completa con ingressi analogici e digitali, Bluetooth aptX HD e stadio phono MM/MC.</p>',
            'specs'     => array(
                array('DAC', 'Doppio ESS Sabre ES9028PRO (32-bit/768kHz)'),
                array('Ingressi analogici', '4 RCA, 2 XLR, Phono MM/MC'),
                array('Ingressi digitali', '3 coassiali, 3 ottici, USB'),
                array('Bluetooth', 'aptX HD, AAC'),
                array('Alimentazione', 'Doppi trasformatori toroidali'),
                array('Peso', '22.9 kg'),
            ),
        ),

        // 4. Rotel Michi S5
        array(
            'title'     => 'Rotel Michi S5',
            'slug'      => 'rotel-michi-s5',
            'subtitle'  => 'Amplificatore Finale Stereo',
            'cats'      => array('amplificazioni', 'finali-stereo'),
            'front_url' => $gallery_base . 'Michi_by_Rotel_S5_01.jpg',
            'back_url'  => $gallery_base . 'Michi_by_Rotel_S5_r.jpg',
            'excerpt'   => 'Finale di potenza stereo da 500W per canale su 8 ohm con costruzione dual-mono e 32 transistor di uscita. Premio EISA Power Amplifier 2020-2021.',
            'content'   => '<p>Il <strong>Rotel Michi S5</strong> eroga 500W per canale su 8 ohm e 800W su 4 ohm con costruzione dual-mono in classe A/B. I 32 transistor di uscita ad alta corrente, i doppi trasformatori toroidali personalizzati e il fattore di smorzamento di 350 garantiscono un controllo assoluto su qualsiasi diffusore. Vincitore del premio EISA Power Amplifier 2020-2021.</p>',
            'specs'     => array(
                array('Potenza', '500W/ch (8\u03A9), 800W/ch (4\u03A9)'),
                array('THD', '<0.008%'),
                array('Fattore di smorzamento', '350'),
                array('Rapporto S/N', '120dB (pesato A)'),
                array('Risposta in frequenza', '10Hz-100kHz'),
                array('Dimensioni', '485x238x465mm'),
                array('Peso', '59.9 kg'),
            ),
        ),

        // 5. Rotel Michi M8
        array(
            'title'     => 'Rotel Michi M8',
            'slug'      => 'rotel-michi-m8',
            'subtitle'  => 'Amplificatore Finale Mono',
            'cats'      => array('amplificazioni', 'finali-monofonici'),
            'front_url' => $gallery_base . 'Michi_by_Rotel_M8_01.jpg',
            'back_url'  => $gallery_base . 'Michi_by_Rotel_M8_r.jpg',
            'excerpt'   => 'Finale di potenza mono da 1080W su 8 ohm e 1800W su 4 ohm con 32 transistor di uscita e display OLED a colori.',
            'content'   => '<p>Il <strong>Rotel Michi M8</strong> e un finale mono senza compromessi con 1080W su 8 ohm e 1800W su 4 ohm. Il design in classe A/B con 32 transistor di uscita, doppi trasformatori toroidali e display OLED a colori garantisce prestazioni al vertice assoluto della gamma Rotel.</p>',
            'specs'     => array(
                array('Potenza', '1080W (8\u03A9), 1800W (4\u03A9)'),
                array('THD', '<0.018%'),
                array('Fattore di smorzamento', '200'),
                array('Rapporto S/N', '120dB'),
                array('Risposta in frequenza', '10Hz-100kHz'),
                array('Ingressi', 'XLR, RCA'),
                array('Peso', '59.1 kg'),
            ),
        ),

        // 6. Rotel Michi X3 S2
        array(
            'title'     => 'Rotel Michi X3 S2',
            'slug'      => 'rotel-michi-x3-s2',
            'subtitle'  => 'Amplificatore Integrato Stereo',
            'cats'      => array('amplificazioni', 'integrati-stereo'),
            'front_url' => $gallery_base . 'rotel-Michi-X3-S2_front.jpg',
            'back_url'  => $gallery_base . 'rotel-Michi-X3-S2_back.jpg',
            'excerpt'   => 'Amplificatore integrato stereo da 200W per canale su 8 ohm con DAC ESS Sabre ES9028PRO, Bluetooth aptX HD e ingresso phono MM.',
            'content'   => '<p>Il <strong>Rotel Michi X3 S2</strong> eroga 200W per canale su 8 ohm in classe A/B con DAC ESS Sabre ES9028PRO a 8 canali. Supporta MQA, Bluetooth aptX HD e offre connettivita completa con 3 RCA, 1 XLR, USB, 3 coassiali, 3 ottici e ingresso phono MM. Certificato Roon.</p>',
            'specs'     => array(
                array('Potenza', '200W/ch (8\u03A9), 350W/ch (4\u03A9)'),
                array('THD', '<0.008%'),
                array('Fattore di smorzamento', '350'),
                array('DAC', 'ESS Sabre ES9028PRO'),
                array('Rapporto S/N', '102dB'),
                array('Bluetooth', 'aptX HD'),
                array('Dimensioni', '485x150x452mm'),
                array('Peso', '28.9 kg'),
            ),
        ),

        // 7. Rotel Michi X5 S2
        array(
            'title'     => 'Rotel Michi X5 S2',
            'slug'      => 'rotel-michi-x5-s2',
            'subtitle'  => 'Amplificatore Integrato Stereo',
            'cats'      => array('amplificazioni', 'integrati-stereo'),
            'front_url' => $gallery_base . 'rotel-Michi-X5-S2_front.jpg',
            'back_url'  => $gallery_base . 'rotel-Michi-X5-S2_back.jpg',
            'excerpt'   => 'Amplificatore integrato stereo da 350W per canale su 8 ohm con circuitazione dual-mono, doppi trasformatori toroidali e DAC ESS Sabre ES9028PRO.',
            'content'   => '<p>Il <strong>Rotel Michi X5 S2</strong> e il flagship degli integrati Michi con 350W su 8 ohm e 600W su 4 ohm. Circuitazione dual-mono con doppi trasformatori toroidali, condensatori da 22.000\u00B5F e DAC ESS Sabre ES9028PRO. Supporto MQA, Bluetooth aptX HD e certificazione Roon.</p>',
            'specs'     => array(
                array('Potenza', '350W/ch (8\u03A9), 600W/ch (4\u03A9)'),
                array('THD', '<0.009%'),
                array('Fattore di smorzamento', '350'),
                array('DAC', 'ESS Sabre ES9028PRO'),
                array('Rapporto S/N', '102dB'),
                array('Dimensioni', '485x195x452mm'),
                array('Peso', '43.8 kg'),
            ),
        ),

        // 8. Rotel Michi Q5
        array(
            'title'     => 'Rotel Michi Q5',
            'slug'      => 'rotel-michi-q5',
            'subtitle'  => 'Lettore CD e Convertitore DAC',
            'cats'      => array('sorgenti', 'lettori-cd-sacd'),
            'front_url' => $gallery_base . 'Rotel-Michi-Q5_01.jpg',
            'back_url'  => $gallery_base . 'Rotel-Michi-Q5_back.jpg',
            'excerpt'   => 'Lettore CD top-loading con meccanica CNC in alluminio sospesa su molle flottanti e DAC ESS Sabre ES9028PRO. Circuitazione dual-mono.',
            'content'   => '<p>Il <strong>Rotel Michi Q5</strong> e un lettore CD top-loading con convertitore DAC di riferimento. La meccanica proprietaria in alluminio lavorato CNC, sospesa su molle flottanti, garantisce una lettura precisa. Il DAC ESS Sabre ES9028PRO e la circuitazione dual-mono con doppi trasformatori toroidali completano un componente eccezionale.</p>',
            'specs'     => array(
                array('DAC', 'ESS Sabre ES9028PRO'),
                array('THD', '<0.0006%'),
                array('Rapporto S/N', '>115dB'),
                array('Gamma dinamica', '>99dB'),
                array('Ingressi digitali', 'USB 32-bit/384kHz, ottico, coassiale'),
                array('Uscite', 'XLR bilanciate, RCA'),
                array('Dimensioni', '485x150x452mm'),
                array('Peso', '23.5 kg'),
            ),
        ),

        // ===== SERIE RA =====

        // 9. Rotel RA-1572MKII
        array(
            'title'     => 'Rotel RA-1572MKII',
            'slug'      => 'rotel-ra-1572mkii',
            'subtitle'  => 'Amplificatore Integrato Stereo',
            'cats'      => array('amplificazioni', 'integrati-stereo'),
            'front_url' => 'https://www.audiogamma.it/caricamenti/img_prodotti/rotel-RA-1572MKII.jpg',
            'back_url'  => $gallery_base . 'rotel-RA-1572MKII_03.jpg',
            'excerpt'   => 'Amplificatore integrato stereo da 120W per canale con DAC 32-bit/384kHz, Bluetooth aptX e ingresso phono MM. Disponibile in finitura Nero e Silver.',
            'content'   => '<p>Il <strong>Rotel RA-1572MKII</strong> eroga 120W per canale su 8 ohm e 200W su 4 ohm con trasformatore toroidale e circuitazione dual-mono. Il DAC audiofilo supporta fino a 32-bit/384kHz con MQA, Bluetooth aptX e certificazione Roon. Ingressi analogici e digitali completi con phono MM.</p>',
            'specs'     => array(
                array('Potenza', '120W/ch (8\u03A9), 200W/ch (4\u03A9)'),
                array('THD', '<0.018%'),
                array('Rapporto S/N', '100dB'),
                array('DAC', '32-bit/384kHz'),
                array('Bluetooth', 'aptX'),
                array('Ingressi', 'Phono MM, 4 RCA, XLR, USB, ottici, coassiali'),
                array('Dimensioni', '431x144x358mm'),
                array('Peso', '13.63 kg'),
            ),
        ),

        // 10. Rotel RA-1592MKII
        array(
            'title'     => 'Rotel RA-1592MKII',
            'slug'      => 'rotel-ra-1592mkii',
            'subtitle'  => 'Amplificatore Integrato Stereo',
            'cats'      => array('amplificazioni', 'integrati-stereo'),
            'front_url' => 'https://www.audiogamma.it/caricamenti/img_prodotti/rotel-RA-1592MKII.jpg',
            'back_url'  => $gallery_base . 'rotel-RA-1592MKII_03.jpg',
            'excerpt'   => 'Amplificatore integrato stereo da 200W per canale con DAC Texas Instruments 32-bit/384kHz, Bluetooth aptX e certificazione Roon. Disponibile in finitura Nero e Silver.',
            'content'   => '<p>Il <strong>Rotel RA-1592MKII</strong> e il top della Serie RA con 200W su 8 ohm e 350W su 4 ohm, circuitazione dual-mono e DAC Texas Instruments a 32-bit/384kHz. Supporta MQA, Bluetooth aptX/AAC con Roon Ready. Headroom dinamico migliorato grazie al raddoppio della capacita di filtraggio.</p>',
            'specs'     => array(
                array('Potenza', '200W/ch (8\u03A9), 350W/ch (4\u03A9)'),
                array('THD', '<0.008%'),
                array('Rapporto S/N', '103dB'),
                array('DAC', 'Texas Instruments 32-bit/384kHz'),
                array('Bluetooth', 'aptX/AAC'),
                array('Dimensioni', '431x144x425mm'),
                array('Peso', '17.63 kg'),
            ),
        ),

        // ===== SERIE A =====

        // 11. Rotel A8
        array(
            'title'     => 'Rotel A8',
            'slug'      => 'rotel-a8',
            'subtitle'  => 'Amplificatore Integrato Stereo',
            'cats'      => array('amplificazioni', 'integrati-stereo'),
            'front_url' => $gallery_base . 'Rotel-A8_black.jpg',
            'back_url'  => $gallery_base . 'Rotel-A8_back.jpg',
            'excerpt'   => 'Amplificatore integrato compatto da 30W per canale con ingresso phono MM, controlli di tono e uscita cuffia. Disponibile in finitura Nero e Silver.',
            'content'   => '<p>Il <strong>Rotel A8</strong> e un amplificatore integrato compatto da 30W per canale su 8 ohm con stadio finale ad alta corrente e trasformatore toroidale. Offre 3 ingressi linea, ingresso phono MM, controlli di tono regolabili e uscita cuffia con telecomando incluso.</p>',
            'specs'     => array(
                array('Potenza', '30W/ch (8\u03A9), 40W/ch (4\u03A9)'),
                array('THD', '<0.03%'),
                array('Fattore di smorzamento', '80'),
                array('Ingressi', '3 RCA, 1 Phono MM'),
                array('Controlli tono', '\u00B16dB (Bassi/Alti)'),
                array('Dimensioni', '430x73x347mm'),
                array('Peso', '5.8 kg'),
            ),
        ),

        // 12. Rotel A10
        array(
            'title'     => 'Rotel A10',
            'slug'      => 'rotel-a10',
            'subtitle'  => 'Amplificatore Integrato Stereo',
            'cats'      => array('amplificazioni', 'integrati-stereo'),
            'front_url' => $gallery_base . 'rotel_A10_k.jpg',
            'back_url'  => $gallery_base . 'rotel_A10_r.jpg',
            'excerpt'   => 'Amplificatore integrato da 40W per canale con 5 ingressi linea, phono MM e protezione elettronica diffusori. Disponibile in finitura Nero e Silver.',
            'content'   => '<p>Il <strong>Rotel A10</strong> eroga 40W per canale su 8 ohm con stadio finale ad alta corrente e trasformatore toroidale. Cinque ingressi linea, ingresso phono MM, commutazione diffusori A/B/A+B e doppio trigger 12V completano un integrato versatile e compatto.</p>',
            'specs'     => array(
                array('Potenza', '40W/ch (8\u03A9)'),
                array('Ingressi', '5 linea, 1 Phono MM'),
                array('Uscite', 'Pre-out, cuffie'),
                array('Diffusori', 'A, B, A+B'),
                array('Trigger', 'Doppio 12V'),
            ),
        ),

        // 13. Rotel A10MKII
        array(
            'title'     => 'Rotel A10MKII',
            'slug'      => 'rotel-a10mkii',
            'subtitle'  => 'Amplificatore Integrato Stereo',
            'cats'      => array('amplificazioni', 'integrati-stereo'),
            'front_url' => $gallery_base . 'Rotel-A10MKII_black.jpg',
            'back_url'  => $gallery_base . 'Rotel-A10MKII_back.jpg',
            'excerpt'   => 'Amplificatore integrato da 50W per canale con trasformatore toroidale, phono MM e uscita cuffia dedicata. Disponibile in finitura Nero e Silver.',
            'content'   => '<p>Il <strong>Rotel A10MKII</strong> offre 50W per canale su 8 ohm con stadio finale ad alta corrente e trasformatore toroidale. Tre ingressi linea, ingresso phono MM, protezione elettronica e uscita cuffia dedicata con telecomando in dotazione.</p>',
            'specs'     => array(
                array('Potenza', '50W/ch (8\u03A9)'),
                array('THD', '<0.03%'),
                array('Fattore di smorzamento', '120'),
                array('Rapporto S/N', '90dB'),
                array('Dimensioni', '430x73x347mm'),
                array('Peso', '6.6 kg'),
            ),
        ),

        // 14. Rotel A11 Tribute
        array(
            'title'     => 'Rotel A11 Tribute',
            'slug'      => 'rotel-a11-tribute',
            'subtitle'  => 'Amplificatore Integrato Stereo',
            'cats'      => array('amplificazioni', 'integrati-stereo'),
            'front_url' => $gallery_base . 'rotel_A11-Tribute_k.jpg',
            'back_url'  => $gallery_base . 'rotel_A11-Tribute_r.jpg',
            'excerpt'   => 'Amplificatore integrato da 50W per canale sviluppato con Ken Ishiwata, Bluetooth aptX e ingresso phono MM. Disponibile in finitura Nero.',
            'content'   => '<p>Il <strong>Rotel A11 Tribute</strong> e un amplificatore integrato da 50W per canale sviluppato in collaborazione con Ken Ishiwata. Componenti aggiornati, Bluetooth aptX/AAC, 4 ingressi RCA, phono MM e uscita cuffia per un suono ricco e dettagliato.</p>',
            'specs'     => array(
                array('Potenza', '50W/ch (8\u03A9)'),
                array('THD', '<0.03%'),
                array('Fattore di smorzamento', '140'),
                array('Rapporto S/N', '100dB'),
                array('Bluetooth', 'aptX/AAC'),
                array('Ingressi', '4 RCA, 1 Phono MM'),
                array('Dimensioni', '430x93x345mm'),
                array('Peso', '6.85 kg'),
            ),
        ),

        // 15. Rotel A11MKII
        array(
            'title'     => 'Rotel A11MKII',
            'slug'      => 'rotel-a11mkii',
            'subtitle'  => 'Amplificatore Integrato Stereo',
            'cats'      => array('amplificazioni', 'integrati-stereo'),
            'front_url' => $gallery_base . 'Rotel-A11MKII_black.jpg',
            'back_url'  => $gallery_base . 'Rotel-A11MKII_back.jpg',
            'excerpt'   => 'Amplificatore integrato da 50W per canale con DAC Texas Instruments 32-bit/384kHz, Bluetooth aptX HD e phono MM. Disponibile in finitura Nero e Silver.',
            'content'   => '<p>Il <strong>Rotel A11MKII</strong> eroga 50W su 8 ohm e 62W su 4 ohm con DAC Texas Instruments 32-bit/384kHz. Ingressi digitali ottico e coassiale, Bluetooth aptX HD, 3 RCA, phono MM e controlli di tono \u00B16dB.</p>',
            'specs'     => array(
                array('Potenza', '50W/ch (8\u03A9), 62W/ch (4\u03A9)'),
                array('THD', '<0.03%'),
                array('DAC', 'Texas Instruments 32-bit/384kHz'),
                array('Bluetooth', 'aptX HD'),
                array('Ingressi', '3 RCA, Phono MM, ottico, coassiale'),
                array('Dimensioni', '430x73x347mm'),
                array('Peso', '6.8 kg'),
            ),
        ),

        // 16. Rotel A12MKII
        array(
            'title'     => 'Rotel A12MKII',
            'slug'      => 'rotel-a12mkii',
            'subtitle'  => 'Amplificatore Integrato Stereo',
            'cats'      => array('amplificazioni', 'integrati-stereo'),
            'front_url' => $gallery_base . 'Rotel-A12MKII_black_01.jpg',
            'back_url'  => $gallery_base . 'Rotel-A12MKII_silver_04.jpg',
            'excerpt'   => 'Amplificatore integrato da 60W per canale con DAC Texas Instruments 32-bit/384kHz, Bluetooth aptX e certificazione Roon. Disponibile in finitura Nero e Silver.',
            'content'   => '<p>Il <strong>Rotel A12MKII</strong> offre 60W per canale con DAC Texas Instruments 32-bit/384kHz, Bluetooth aptX e Roon Tested. Display LCD a 4 linee, 4 ingressi analogici, phono MM, 2 USB, 2 coassiali, 2 ottici e doppio trigger 12V.</p>',
            'specs'     => array(
                array('Potenza', '60W/ch (8\u03A9)'),
                array('DAC', 'Texas Instruments 32-bit/384kHz'),
                array('Bluetooth', 'aptX'),
                array('Streaming', 'Roon Tested'),
                array('Ingressi', '4 analogici, Phono MM, 2 USB, 2 coassiali, 2 ottici'),
                array('Display', 'LCD 4 linee'),
            ),
        ),

        // 17. Rotel A14MKII
        array(
            'title'     => 'Rotel A14MKII',
            'slug'      => 'rotel-a14mkii',
            'subtitle'  => 'Amplificatore Integrato Stereo',
            'cats'      => array('amplificazioni', 'integrati-stereo'),
            'front_url' => $gallery_base . 'rotel-A14MKII-black.jpg',
            'back_url'  => $gallery_base . 'rotel-A14MKII-back.jpg',
            'excerpt'   => 'Amplificatore integrato da 80W per canale con DAC 32-bit/384kHz, Bluetooth aptX, MQA e certificazione Roon. Disponibile in finitura Nero e Silver.',
            'content'   => '<p>Il <strong>Rotel A14MKII</strong> eroga 80W su 8 ohm e 150W su 4 ohm con DAC Texas Instruments 32-bit/384kHz. Supporta MQA, Bluetooth aptX e certificazione Roon con molteplici ingressi analogici e digitali e preamplificatore phono integrato.</p>',
            'specs'     => array(
                array('Potenza', '80W/ch (8\u03A9), 150W/ch (4\u03A9)'),
                array('THD', '<0.018%'),
                array('Fattore di smorzamento', '220'),
                array('Rapporto S/N', '103dB'),
                array('DAC', 'Texas Instruments 32-bit/384kHz'),
                array('Dimensioni', '430x93x345mm'),
                array('Peso', '8.9 kg'),
            ),
        ),

        // ===== SERIE RC =====

        // 18. Rotel RC-1572MKII
        array(
            'title'     => 'Rotel RC-1572MKII',
            'slug'      => 'rotel-rc-1572mkii',
            'subtitle'  => 'Preamplificatore Stereo',
            'cats'      => array('amplificazioni', 'preamplificatori-stereo'),
            'front_url' => $gallery_base . 'Rotel-RC-1572MKII-Black.jpg',
            'back_url'  => $gallery_base . 'Rotel-RC-1572MKII-Back.jpg',
            'excerpt'   => 'Preamplificatore stereo con DAC 32-bit/384kHz, Bluetooth aptX, Roon Ready e MQA. Ingressi phono MM e uscite XLR bilanciate. Disponibile in finitura Nero e Silver.',
            'content'   => '<p>Il <strong>Rotel RC-1572MKII</strong> e un preamplificatore stereo con convertitore D/A Texas Instruments a 32-bit/384kHz. Bluetooth aptX/AAC, Roon Ready, MQA, ingresso phono MM, 4 RCA, XLR, ingressi digitali e uscite bilanciate XLR completano un preamplificatore versatile.</p>',
            'specs'     => array(
                array('DAC', 'Texas Instruments 32-bit/384kHz'),
                array('Bluetooth', 'aptX/AAC'),
                array('Streaming', 'Roon Ready, MQA'),
                array('Ingressi', '4 RCA, XLR, Phono MM, 2 ottici, 2 coassiali, USB'),
                array('Uscite', 'RCA, XLR, subwoofer, cuffie'),
                array('Trasformatore', 'Toroidale'),
            ),
        ),

        // 19. Rotel RC-1590MKII
        array(
            'title'     => 'Rotel RC-1590MKII',
            'slug'      => 'rotel-rc-1590mkii',
            'subtitle'  => 'Preamplificatore Stereo',
            'cats'      => array('amplificazioni', 'preamplificatori-stereo'),
            'front_url' => $gallery_base . 'Rotel-RC-1590MKII-Black.jpg',
            'back_url'  => $gallery_base . 'Rotel-RC-1590MKII-Back.jpg',
            'excerpt'   => 'Preamplificatore stereo di riferimento con doppio trasformatore toroidale, DAC 32-bit/384kHz e Roon Ready. Disponibile in finitura Nero e Silver.',
            'content'   => '<p>Il <strong>Rotel RC-1590MKII</strong> e il preamplificatore di riferimento con convertitore D/A Texas Instruments 32-bit/384kHz e doppio trasformatore toroidale per sezioni analogica e digitale separate. Bluetooth aptX/AAC, Roon Ready, MQA e doppie uscite XLR bilanciate.</p>',
            'specs'     => array(
                array('DAC', 'Texas Instruments 32-bit/384kHz'),
                array('Bluetooth', 'aptX/AAC'),
                array('Streaming', 'Roon Ready, MQA'),
                array('Ingressi', '3 RCA, XLR, Phono MM, 3 coassiali, 3 ottici, 2 USB'),
                array('Uscite', 'Doppia XLR, subwoofer, cuffie'),
                array('Trasformatore', 'Doppio toroidale'),
            ),
        ),

        // ===== SERIE RB =====

        // 20. Rotel RB-1552 MKII
        array(
            'title'     => 'Rotel RB-1552 MKII',
            'slug'      => 'rotel-rb-1552-mkii',
            'subtitle'  => 'Amplificatore Finale Stereo',
            'cats'      => array('amplificazioni', 'finali-stereo'),
            'front_url' => $gallery_base . 'rotel_RB-1552-MKII_k.jpg',
            'back_url'  => $gallery_base . 'rotel_RB-1552-MKII_r.jpg',
            'excerpt'   => 'Finale stereo da 120W per canale con circuito Balanced Design in Classe A/B e configurazione dual-mono. Disponibile in finitura Nero e Silver.',
            'content'   => '<p>Il <strong>Rotel RB-1552 MKII</strong> eroga 120W per canale su 8 ohm con circuito Balanced Design in Classe A/B. Configurazione dual-mono, trasformatore toroidale e stadio di uscita ad alta corrente con ingressi XLR bilanciati e RCA.</p>',
            'specs'     => array(
                array('Potenza', '120W/ch (8\u03A9)'),
                array('Design', 'Balanced Design, Classe A/B'),
                array('Configurazione', 'Dual Mono'),
                array('Trasformatore', 'Toroidale'),
                array('Ingressi', 'XLR bilanciati, RCA'),
            ),
        ),

        // 21. Rotel RB-1582 MKII
        array(
            'title'     => 'Rotel RB-1582 MKII',
            'slug'      => 'rotel-rb-1582-mkii',
            'subtitle'  => 'Amplificatore Finale Stereo',
            'cats'      => array('amplificazioni', 'finali-stereo'),
            'front_url' => $gallery_base . 'rotel_RB-1582_MKII_k.jpg',
            'back_url'  => $gallery_base . 'rotel_RB-1582_MKII_r.jpg',
            'excerpt'   => 'Finale stereo da 200W per canale con condensatori Slit-Foil e costruzione dual-mono. Disponibile in finitura Nero e Silver.',
            'content'   => '<p>Il <strong>Rotel RB-1582 MKII</strong> eroga 200W per canale su 8 ohm con circuito Balanced Design in Classe A/B. Condensatori Slit-Foil, componenti selezionati, trasformatore toroidale e stadio di uscita ad alta corrente per prestazioni di riferimento.</p>',
            'specs'     => array(
                array('Potenza', '200W/ch (8\u03A9)'),
                array('Design', 'Balanced Design, Classe A/B'),
                array('Condensatori', 'Slit-Foil'),
                array('Trasformatore', 'Toroidale'),
                array('Ingressi', 'XLR bilanciati, RCA'),
            ),
        ),

        // 22. Rotel RB-1590
        array(
            'title'     => 'Rotel RB-1590',
            'slug'      => 'rotel-rb-1590',
            'subtitle'  => 'Amplificatore Finale Stereo',
            'cats'      => array('amplificazioni', 'finali-stereo'),
            'front_url' => $gallery_base . 'rotel_RB-1590_k.jpg',
            'back_url'  => $gallery_base . 'Rotel-RB-1590_03.jpg',
            'excerpt'   => 'Finale stereo di riferimento da 350W per canale con doppio trasformatore toroidale e condensatori Slit-Foil da 80.000\u00B5F. Disponibile in finitura Nero e Silver.',
            'content'   => '<p>Il <strong>Rotel RB-1590</strong> e il finale stereo di riferimento con 350W per canale su 8 ohm. Doppio trasformatore toroidale, configurazione dual-mono, condensatori BHC Slit-Foil da 80.000\u00B5F, stadio di uscita ad alta corrente e doppi terminali di uscita per canale.</p>',
            'specs'     => array(
                array('Potenza', '350W/ch (8\u03A9)'),
                array('Design', 'Balanced Design, Classe A/B'),
                array('Trasformatore', 'Doppio toroidale'),
                array('Condensatori', 'BHC Slit-Foil (80.000\u00B5F)'),
                array('Ingressi', 'XLR bilanciati, RCA'),
                array('Uscite', 'Doppi terminali per canale'),
            ),
        ),

        // ===== SERIE CD =====

        // 23. Rotel CD11 Tribute
        array(
            'title'     => 'Rotel CD11 Tribute',
            'slug'      => 'rotel-cd11-tribute',
            'subtitle'  => 'Lettore CD',
            'cats'      => array('sorgenti', 'lettori-cd-sacd'),
            'front_url' => $gallery_base . 'rotel_CD11-Tribute_k.jpg',
            'back_url'  => $gallery_base . 'rotel_CD11-Tribute_r.jpg',
            'excerpt'   => 'Lettore CD con meccanica di precisione e DAC Texas Instruments, ottimizzato da Ken Ishiwata. Disponibile in finitura Nero.',
            'content'   => '<p>Il <strong>Rotel CD11 Tribute</strong> e un lettore CD con meccanica di alta precisione e convertitore D/A Texas Instruments, ottimizzato da Ken Ishiwata con condensatori dedicati e materiale smorzante per la riduzione delle vibrazioni.</p>',
            'specs'     => array(
                array('THD', '0.009%'),
                array('Risposta in frequenza', '20Hz-20kHz \u00B10.5dB'),
                array('Rapporto S/N', '>125dB'),
                array('Gamma dinamica', '>99dB'),
                array('DAC', 'Texas Instruments'),
                array('Dimensioni', '430x98x314mm'),
                array('Peso', '5.8 kg'),
            ),
        ),

        // 24. Rotel CD11MKII
        array(
            'title'     => 'Rotel CD11MKII',
            'slug'      => 'rotel-cd11mkii',
            'subtitle'  => 'Lettore CD',
            'cats'      => array('sorgenti', 'lettori-cd-sacd'),
            'front_url' => $gallery_base . 'Rotel-CD11MKII_black.jpg',
            'back_url'  => $gallery_base . 'Rotel-CD11MKII_back.jpg',
            'excerpt'   => 'Lettore CD con DAC Texas Instruments PCM5102A a 32-bit/384kHz e alimentatori indipendenti. Disponibile in finitura Nero e Silver.',
            'content'   => '<p>Il <strong>Rotel CD11MKII</strong> e un lettore CD con meccanica di alta precisione e DAC Texas Instruments PCM5102A a 32-bit/384kHz. Alimentatori indipendenti per sezioni digitale e analogica, condensatori ultra-rapidi e filtri analogici custom.</p>',
            'specs'     => array(
                array('THD', '0.009%'),
                array('Risposta in frequenza', '20Hz-20kHz \u00B10.5dB'),
                array('Rapporto S/N', '>125dB'),
                array('DAC', 'Texas Instruments PCM5102A'),
                array('Uscite', 'RCA analogica, coassiale digitale'),
                array('Dimensioni', '430x98x314mm'),
                array('Peso', '6.2 kg'),
            ),
        ),

        // 25. Rotel CD14MKII
        array(
            'title'     => 'Rotel CD14MKII',
            'slug'      => 'rotel-cd14mkii',
            'subtitle'  => 'Lettore CD',
            'cats'      => array('sorgenti', 'lettori-cd-sacd'),
            'front_url' => $gallery_base . 'Rotel-CD14MKII_black_01.jpg',
            'back_url'  => $gallery_base . 'Rotel-CD14MKII_back.jpg',
            'excerpt'   => 'Lettore CD con DAC Texas Instruments Premium 32-bit/384kHz e meccanica motorizzata silenziosa. Disponibile in finitura Nero e Silver.',
            'content'   => '<p>Il <strong>Rotel CD14MKII</strong> offre un DAC Texas Instruments serie Premium a 32-bit/384kHz con alimentatori indipendenti per circuiti digitali e analogici. Filtri analogici custom e meccanica motorizzata silenziosa per una riproduzione cristallina.</p>',
            'specs'     => array(
                array('THD', '0.0035%'),
                array('Risposta in frequenza', '20Hz-20kHz \u00B10.5dB'),
                array('Rapporto S/N', '>118dB'),
                array('Gamma dinamica', '>99dB'),
                array('DAC', 'Texas Instruments Premium 32-bit'),
                array('Dimensioni', '430x98x314mm'),
                array('Peso', '6.51 kg'),
            ),
        ),

        // 26. Rotel RCD-1572MKII
        array(
            'title'     => 'Rotel RCD-1572MKII',
            'slug'      => 'rotel-rcd-1572mkii',
            'subtitle'  => 'Lettore CD',
            'cats'      => array('sorgenti', 'lettori-cd-sacd'),
            'front_url' => $gallery_base . 'Rotel-RCD-1572MKII_black.jpg',
            'back_url'  => $gallery_base . 'Rotel-RCD-1572MKII_02.jpg',
            'excerpt'   => 'Lettore CD con DAC Texas Instruments Premium 32-bit/384kHz, trasformatore toroidale e uscite bilanciate XLR. Disponibile in finitura Nero e Silver.',
            'content'   => '<p>Il <strong>Rotel RCD-1572MKII</strong> e il lettore CD di riferimento con DAC Texas Instruments Premium 32-bit/384kHz, trasformatore toroidale con alimentazioni isolate e uscite bilanciate XLR. Filtri analogici custom per la massima fedelta.</p>',
            'specs'     => array(
                array('THD', '0.0035%'),
                array('Rapporto S/N', '>118dB'),
                array('DAC', 'Texas Instruments Premium 32-bit/384kHz'),
                array('Uscite', 'RCA, XLR bilanciate, coassiale digitale'),
                array('Trasformatore', 'Toroidale'),
                array('Dimensioni', '431x104x320mm'),
                array('Peso', '7.34 kg'),
            ),
        ),

        // ===== SERIE T =====

        // 27. Rotel T11
        array(
            'title'     => 'Rotel T11',
            'slug'      => 'rotel-t11',
            'subtitle'  => 'Sintonizzatore DAB+/FM Stereo',
            'cats'      => array('sorgenti', 'sintonizzatori'),
            'front_url' => $gallery_base . 'rotel_T11_k.jpg',
            'back_url'  => $gallery_base . 'rotel_T11_r.jpg',
            'excerpt'   => 'Sintonizzatore DAB+/FM stereo con RDS, 30 stazioni preselezionabili e display LCD a 4 linee. Disponibile in finitura Nero e Silver.',
            'content'   => '<p>Il <strong>Rotel T11</strong> e un sintonizzatore DAB+/FM stereo con RDS e 30 stazioni preselezionabili. Stadi di uscita separati per analogico e digitale, alimentazioni indipendenti con componentistica selezionata e display grafico LCD a 4 linee.</p>',
            'specs'     => array(
                array('Tipo', 'Sintonizzatore DAB+/FM stereo con RDS'),
                array('Preselezionabili', '30 stazioni'),
                array('Uscite', 'Analogiche e digitali separate'),
                array('Display', 'LCD 4 linee'),
                array('Connettivita', 'RS-232'),
            ),
        ),

        // ===== SERIE RAS =====

        // 28. Rotel RAS-5000
        array(
            'title'     => 'Rotel RAS-5000',
            'slug'      => 'rotel-ras-5000',
            'subtitle'  => 'Amplificatore Integrato con Streamer',
            'cats'      => array('amplificazioni', 'integrati-stereo'),
            'front_url' => $gallery_base . 'Rotel-RAS-5000_black.jpg',
            'back_url'  => $gallery_base . 'Rotel-RAS-5000_back.jpg',
            'excerpt'   => 'Amplificatore integrato da 140W per canale con streamer di rete, DAC ESS, AirPlay 2, Roon Ready e EISA Award. Disponibile in finitura Nero e Silver.',
            'content'   => '<p>Il <strong>Rotel RAS-5000</strong> e un amplificatore integrato all-in-one da 140W su 8 ohm e 220W su 4 ohm con streamer di rete. DAC ESS 32-bit/384kHz, WiFi, Ethernet, Bluetooth aptX HD, AirPlay 2, Google Cast e Roon Ready. Vincitore EISA Streaming Amplifier 2024-2025.</p>',
            'specs'     => array(
                array('Potenza', '140W/ch (8\u03A9), 220W/ch (4\u03A9)'),
                array('THD', '<0.03%'),
                array('Rapporto S/N', '103dB'),
                array('DAC', 'ESS 32-bit/384kHz'),
                array('Streaming', 'AirPlay 2, Google Cast, Roon Ready, MQA'),
                array('Connettivita', 'WiFi, Ethernet, Bluetooth aptX HD, USB, HDMI eARC'),
                array('Dimensioni', '431x144x425mm'),
                array('Peso', '15.7 kg'),
            ),
        ),

        // ===== SERIE S =====

        // 29. Rotel S14
        array(
            'title'     => 'Rotel S14',
            'slug'      => 'rotel-s14',
            'subtitle'  => 'Amplificatore Integrato con Streamer',
            'cats'      => array('amplificazioni', 'integrati-stereo'),
            'front_url' => $gallery_base . 'Rotel-S14_black.jpg',
            'back_url'  => $gallery_base . 'Rotel-S14_back.jpg',
            'excerpt'   => 'Amplificatore integrato da 80W per canale con streaming di rete, Bluetooth aptX HD, MQA e Roon Ready. Disponibile in finitura Nero e Silver.',
            'content'   => '<p>Il <strong>Rotel S14</strong> offre 80W per canale su 8 ohm e 150W su 4 ohm con streaming di rete integrato. DAC ESS 32-bit, Bluetooth aptX HD, MQA e certificazione Roon Ready. Fattore di smorzamento di 400 per un controllo eccellente dei diffusori.</p>',
            'specs'     => array(
                array('Potenza', '80W/ch (8\u03A9), 150W/ch (4\u03A9)'),
                array('THD', '<0.04%'),
                array('Rapporto S/N', '100dB'),
                array('Fattore di smorzamento', '400'),
                array('Dimensioni', '430x93x345mm'),
                array('Peso', '9.15 kg'),
            ),
        ),

        // ===== SERIE RSP =====

        // 30. Rotel RSP-1576MKII
        array(
            'title'     => 'Rotel RSP-1576MKII',
            'slug'      => 'rotel-rsp-1576mkii',
            'subtitle'  => 'Processore Surround 7.1.4',
            'cats'      => array('amplificazioni', 'preamplificatori-multicanale'),
            'front_url' => $gallery_base . 'rotel_RSP-1576MKII_k.jpg',
            'back_url'  => $gallery_base . 'rotel_RSP-1576MKII_r.jpg',
            'excerpt'   => 'Processore surround 7.1.4 con Dolby Atmos, DTS:X, Dirac Live e 7 ingressi HDMI 2.0b. Disponibile in finitura Nero e Silver.',
            'content'   => '<p>Il <strong>Rotel RSP-1576MKII</strong> e un processore multicanale 7.1.4 con Dolby Atmos, DTS:X e Dirac Live Full. Sei DAC Wolfson audio-grade, 7 HDMI 2.0b con HDCP 2.2, display TFT da 7 pollici e connettivita completa per sistemi home theater di riferimento.</p>',
            'specs'     => array(
                array('THD', '0.0006%'),
                array('Rapporto S/N', '112dB'),
                array('HDMI', '7 ingressi 2.0b, 2 uscite HDCP 2.2'),
                array('DAC', '6x Wolfson 24-bit/192kHz'),
                array('Audio', 'Dolby Atmos, DTS:X, Dirac Live Full'),
                array('Display', 'TFT 7 pollici'),
                array('Dimensioni', '431x144x348mm'),
                array('Peso', '8.8 kg'),
            ),
        ),

        // ===== SERIE RMB =====

        // 31. Rotel RMB-1504
        array(
            'title'     => 'Rotel RMB-1504',
            'slug'      => 'rotel-rmb-1504',
            'subtitle'  => 'Amplificatore Finale Multicanale 4 Canali',
            'cats'      => array('amplificazioni', 'finali-multicanale'),
            'front_url' => $gallery_base . 'Rotel_RMB-1504_01.jpg',
            'back_url'  => $gallery_base . 'Rotel_RMB-1504_r.jpg',
            'excerpt'   => 'Finale multicanale a 4 canali da 70W per canale con Classe A/B e attenuatori frontali. Disponibile in finitura Nero.',
            'content'   => '<p>Il <strong>Rotel RMB-1504</strong> e un finale a 4 canali da 70W su 8 ohm e 115W su 4 ohm in Classe A/B. Attenuatori d\'ingresso frontali, trigger 12V con autoaccensione, doppi ingressi per cascata e uscite linea con buffer.</p>',
            'specs'     => array(
                array('Potenza', '70W/ch (8\u03A9), 115W/ch (4\u03A9)'),
                array('Canali', '4'),
                array('Classe', 'A/B'),
                array('Ingressi', 'Doppi per cascata'),
                array('Trigger', '12V con autoaccensione'),
            ),
        ),

        // 32. Rotel RMB-1506
        array(
            'title'     => 'Rotel RMB-1506',
            'slug'      => 'rotel-rmb-1506',
            'subtitle'  => 'Amplificatore Finale Multicanale 6 Canali',
            'cats'      => array('amplificazioni', 'finali-multicanale'),
            'front_url' => $gallery_base . 'rotel_RMB-1506_k.jpg',
            'back_url'  => $gallery_base . 'rotel_RMB-1506_r.jpg',
            'excerpt'   => 'Finale multicanale a 6 canali da 60W per canale con Classe A/B e cabinet 3U rack. Disponibile in finitura Nero.',
            'content'   => '<p>Il <strong>Rotel RMB-1506</strong> offre 60W per canale su 6 canali in 8 ohm con Classe A/B e stadio di uscita ad alta corrente. Cabinet 3U, attenuatori frontali, trigger 12V con autoaccensione e doppi ingressi per cascata.</p>',
            'specs'     => array(
                array('Potenza', '60W/ch (8\u03A9)'),
                array('Canali', '6'),
                array('Classe', 'A/B'),
                array('Cabinet', '3U rack'),
                array('Trigger', '12V con autoaccensione'),
            ),
        ),

        // 33. Rotel RMB-1555
        array(
            'title'     => 'Rotel RMB-1555',
            'slug'      => 'rotel-rmb-1555',
            'subtitle'  => 'Amplificatore Finale Multicanale 5 Canali',
            'cats'      => array('amplificazioni', 'finali-multicanale'),
            'front_url' => $gallery_base . 'rotel_RMB-1555_k.jpg',
            'back_url'  => $gallery_base . 'rotel_RMB-1555_r.jpg',
            'excerpt'   => 'Finale multicanale a 5 canali da 120W per canale con Balanced Design e trasformatore toroidale. Disponibile in finitura Nero e Silver.',
            'content'   => '<p>Il <strong>Rotel RMB-1555</strong> eroga 120W per canale su 5 canali in 8 ohm. Design Balanced Design in Classe A/B con trasformatore toroidale, stadi di uscita ad alta corrente e componenti selezionati.</p>',
            'specs'     => array(
                array('Potenza', '120W/ch (8\u03A9)'),
                array('Canali', '5'),
                array('Design', 'Balanced Design, Classe A/B'),
                array('Trasformatore', 'Toroidale'),
                array('Ingressi', 'RCA'),
                array('Trigger', '12V'),
            ),
        ),

        // 34. Rotel RMB-1585MKII
        array(
            'title'     => 'Rotel RMB-1585MKII',
            'slug'      => 'rotel-rmb-1585mkii',
            'subtitle'  => 'Amplificatore Finale Multicanale 5 Canali',
            'cats'      => array('amplificazioni', 'finali-multicanale'),
            'front_url' => $gallery_base . 'Rotel-RMB-1585MKII_black.jpg',
            'back_url'  => $gallery_base . 'Rotel-RMB-1585MKII_back.jpg',
            'excerpt'   => 'Finale multicanale a 5 canali da 210W per canale con doppi trasformatori toroidali e funzione bi-amp. Disponibile in finitura Nero e Silver.',
            'content'   => '<p>Il <strong>Rotel RMB-1585MKII</strong> eroga 210W per canale su 5 canali in 8 ohm. Doppi trasformatori toroidali, 8 condensatori Slit-Foil, ingressi XLR e RCA con commutazione automatica e funzione bi-amp integrata.</p>',
            'specs'     => array(
                array('Potenza', '210W/ch (8\u03A9)'),
                array('Canali', '5'),
                array('THD', '<0.03%'),
                array('Rapporto S/N', '120dB'),
                array('Design', 'Balanced Design'),
                array('Trasformatore', 'Doppio toroidale'),
                array('Ingressi', 'XLR bilanciati, RCA'),
                array('Dimensioni', '431x237x456mm'),
                array('Peso', '37.4 kg'),
            ),
        ),

        // 35. Rotel RMB-1587MKII
        array(
            'title'     => 'Rotel RMB-1587MKII',
            'slug'      => 'rotel-rmb-1587mkii',
            'subtitle'  => 'Amplificatore Finale Multicanale 7 Canali',
            'cats'      => array('amplificazioni', 'finali-multicanale'),
            'front_url' => $gallery_base . 'Rotel-RMB-1587MKII_black.jpg',
            'back_url'  => $gallery_base . 'Rotel-RMB-1587MKII_back.jpg',
            'excerpt'   => 'Finale multicanale a 7 canali da 155W per canale con doppi trasformatori toroidali e ventole a velocita variabile. Disponibile in finitura Nero e Silver.',
            'content'   => '<p>Il <strong>Rotel RMB-1587MKII</strong> eroga 155W per canale su 7 canali in 8 ohm e 250W su 4 ohm. Doppi trasformatori toroidali, ingressi XLR e RCA, ventole a velocita variabile e trigger 12V per integrazione home theater.</p>',
            'specs'     => array(
                array('Potenza', '155W/ch (8\u03A9), 250W/ch (4\u03A9)'),
                array('Canali', '7'),
                array('THD', '<0.03%'),
                array('Rapporto S/N', '111dB'),
                array('Trasformatore', 'Doppio toroidale'),
                array('Ingressi', 'XLR bilanciati, RCA'),
                array('Dimensioni', '431x237x456mm'),
                array('Peso', '37.6 kg'),
            ),
        ),

        // ===== SERIE C =====

        // 36. Rotel C8
        array(
            'title'     => 'Rotel C8',
            'slug'      => 'rotel-c8',
            'subtitle'  => 'Amplificatore Finale Multicanale 8 Canali',
            'cats'      => array('amplificazioni', 'finali-multicanale'),
            'front_url' => 'https://www.audiogamma.it/caricamenti/img_prodotti/Rotel-C8.jpg',
            'back_url'  => $gallery_base . 'Rotel-C8_03.jpg',
            'excerpt'   => 'Finale multicanale a 8 canali da 70W con switching a matrice per 8 zone di installazione. Disponibile in finitura Nero.',
            'content'   => '<p>Il <strong>Rotel C8</strong> e un finale a 8 canali da 70W su 4 ohm con bridge fino a 140W su 4 canali. Classe A/B, trasformatore toroidale e switching a matrice per fino a 8 zone di installazione personalizzata. Cabinet 2U rack.</p>',
            'specs'     => array(
                array('Potenza', '70W/ch x 8 (4\u03A9), 50W/ch x 8 (8\u03A9)'),
                array('Bridge', '140W/ch x 4 (4\u03A9)'),
                array('THD', '<0.1%'),
                array('Risposta in frequenza', '10Hz-100kHz'),
                array('Canali', '8'),
                array('Cabinet', '2U rack'),
                array('Dimensioni', '430x97x414mm'),
                array('Peso', '16.7 kg'),
            ),
        ),

        // 37. Rotel C8+
        array(
            'title'     => 'Rotel C8+',
            'slug'      => 'rotel-c8-plus',
            'subtitle'  => 'Amplificatore Finale Multicanale 8 Canali',
            'cats'      => array('amplificazioni', 'finali-multicanale'),
            'front_url' => $gallery_base . 'Rotel-C8+_01.jpg',
            'back_url'  => $gallery_base . 'Rotel-C8+_02.jpg',
            'excerpt'   => 'Finale multicanale a 8 canali da 100W con 4 ingressi digitali 24-bit/192kHz e bridge fino a 300W. Disponibile in finitura Nero.',
            'content'   => '<p>Il <strong>Rotel C8+</strong> eroga 100W su 8 ohm e 150W su 4 ohm per 8 canali con bridge fino a 300W. Quattro ingressi digitali 24-bit/192kHz, Classe A/B ad alta corrente e trasformatore toroidale per installazioni custom avanzate.</p>',
            'specs'     => array(
                array('Potenza', '100W/ch x 8 (8\u03A9), 150W/ch x 8 (4\u03A9)'),
                array('Bridge', '300W/ch x 4 (4\u03A9)'),
                array('Ingressi digitali', '4x 24-bit/192kHz'),
                array('THD', '<0.1%'),
                array('Rapporto S/N', '100dB'),
                array('Cabinet', '2U rack'),
                array('Dimensioni', '430x97x414mm'),
                array('Peso', '16.7 kg'),
            ),
        ),

        // ===== SERIE DX =====

        // 38. Rotel DX3
        array(
            'title'     => 'Rotel DX3',
            'slug'      => 'rotel-dx3',
            'subtitle'  => 'Amplificatore per Cuffie, DAC e Preamplificatore',
            'cats'      => array('cuffie', 'amplificatori-cuffie'),
            'front_url' => $gallery_base . 'Rotel_DX-3_black.jpg',
            'back_url'  => $gallery_base . 'Rotel_DX-3_back.jpg',
            'excerpt'   => 'Amplificatore per cuffie, DAC e preamplificatore con ESS Sabre 9028PRO, uscite bilanciate e sbilanciate. Disponibile in finitura Nero e Silver.',
            'content'   => '<p>Il <strong>Rotel DX3</strong> e un amplificatore per cuffie, DAC e preamplificatore compatto con DAC ESS Sabre 9028PRO. Supporta PCM 32-bit/384kHz e DSD 4x con ingressi USB, coassiale e ottico. Uscite cuffia bilanciate e sbilanciate per qualsiasi tipo di cuffia.</p>',
            'specs'     => array(
                array('DAC', 'ESS Sabre 9028PRO'),
                array('Risoluzione', 'PCM 32-bit/384kHz, DSD 4x'),
                array('THD', '<0.004%'),
                array('Rapporto S/N', '>110dB'),
                array('Uscita bilanciata', '2.8W (16\u03A9)'),
                array('Uscita sbilanciata', '765mW (16\u03A9)'),
                array('Ingressi', 'USB, coassiale, ottico'),
                array('Dimensioni', '215x76x247mm'),
                array('Peso', '3.2 kg'),
            ),
        ),

        // 39. Rotel DX5
        array(
            'title'     => 'Rotel DX5',
            'slug'      => 'rotel-dx5',
            'subtitle'  => 'Amplificatore Integrato Stereo Compatto',
            'cats'      => array('amplificazioni', 'integrati-stereo'),
            'front_url' => $gallery_base . 'Rotel_DX-5_black.jpg',
            'back_url'  => $gallery_base . 'Rotel_DX-5_back.jpg',
            'excerpt'   => 'Amplificatore integrato compatto da 25W per canale con DAC ESS Sabre, Bluetooth aptX HD e HDMI ARC. Disponibile in finitura Nero e Silver.',
            'content'   => '<p>Il <strong>Rotel DX5</strong> e un amplificatore integrato compatto da 25W su 8 ohm e 33W su 4 ohm con DAC ESS Sabre ES9039Q2M. Bluetooth aptX HD, HDMI ARC, ingressi USB, coassiale e ottico con uscita subwoofer dedicata.</p>',
            'specs'     => array(
                array('Potenza', '25W/ch (8\u03A9), 33W/ch (4\u03A9)'),
                array('DAC', 'ESS Sabre ES9039Q2M'),
                array('THD', '<0.03%'),
                array('Fattore di smorzamento', '140'),
                array('Rapporto S/N', '>100dB'),
                array('Bluetooth', 'aptX HD'),
                array('HDMI', 'ARC'),
                array('Dimensioni', '215x76x251mm'),
                array('Peso', '4.1 kg'),
            ),
        ),
    );

    $imported = 0;

    foreach ($products as $product) {

        // Evita duplicati.
        $existing = get_page_by_path($product['slug'], OBJECT, 'prodotto');
        if ($existing) {
            continue;
        }

        // Crea il post.
        $post_id = wp_insert_post(array(
            'post_type'    => 'prodotto',
            'post_title'   => $product['title'],
            'post_name'    => $product['slug'],
            'post_content' => $product['content'],
            'post_excerpt' => $product['excerpt'],
            'post_status'  => 'publish',
        ));

        if (is_wp_error($post_id)) {
            continue;
        }

        // Tassonomie.
        wp_set_object_terms($post_id, 'rotel', 'brand');
        wp_set_object_terms($post_id, $product['cats'], 'categoria_prodotto');

        // Meta campi prodotto.
        update_post_meta($post_id, 'prodotto_sottotitolo', $product['subtitle']);
        update_post_meta($post_id, 'prodotto_shop_url', HIFISOLUTION_SHOP_URL);

        // Specifiche tecniche (formato ACF repeater).
        $spec_count = count($product['specs']);
        update_post_meta($post_id, 'prodotto_specifiche', $spec_count);
        update_post_meta($post_id, '_prodotto_specifiche', 'field_prodotto_specifiche');

        foreach ($product['specs'] as $i => $spec) {
            update_post_meta($post_id, "prodotto_specifiche_{$i}_specifica_nome", $spec[0]);
            update_post_meta($post_id, "_prodotto_specifiche_{$i}_specifica_nome", 'field_specifica_nome');
            update_post_meta($post_id, "prodotto_specifiche_{$i}_specifica_valore", $spec[1]);
            update_post_meta($post_id, "_prodotto_specifiche_{$i}_specifica_valore", 'field_specifica_valore');
        }

        // Immagine frontale (featured image).
        if (!empty($product['front_url'])) {
            $image_id = media_sideload_image($product['front_url'], $post_id, $product['title'], 'id');
            if (!is_wp_error($image_id)) {
                set_post_thumbnail($post_id, $image_id);
            }
        }

        // Immagine posteriore (gallery ACF).
        if (!empty($product['back_url'])) {
            $back_id = media_sideload_image($product['back_url'], $post_id, $product['title'] . ' Retro', 'id');
            if (!is_wp_error($back_id)) {
                update_post_meta($post_id, 'prodotto_galleria', serialize(array($back_id)));
                update_post_meta($post_id, '_prodotto_galleria', 'field_prodotto_galleria');
            }
        }

        $imported++;
    }

    // Segna come importato.
    update_option('hifi_rotel_imported', true);

    // Rigenera i permalink.
    flush_rewrite_rules();

    add_action('admin_notices', function () use ($imported) {
        echo '<div class="notice notice-success"><p><strong>Rotel:</strong> ' . esc_html($imported) . ' prodotti importati con successo!</p></div>';
    });
}
add_action('admin_init', 'hifisolution_import_rotel');
