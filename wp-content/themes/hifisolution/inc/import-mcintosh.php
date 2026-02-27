<?php
/**
 * Importazione Prodotti McIntosh.
 *
 * Crea 6 prodotti McIntosh nel catalogo.
 * Attivazione: visita /wp-admin/?hifi_import_mcintosh=1
 *
 * @package HiFiSolution
 */

defined('ABSPATH') || exit;

/**
 * Handler di importazione McIntosh.
 */
function hifisolution_import_mcintosh() {
    if (!isset($_GET['hifi_import_mcintosh']) || $_GET['hifi_import_mcintosh'] !== '1') {
        return;
    }

    if (!current_user_can('manage_options')) {
        wp_die('Accesso non autorizzato.');
    }

    // Evita doppia importazione.
    if (get_option('hifi_mcintosh_imported')) {
        add_action('admin_notices', function () {
            echo '<div class="notice notice-warning"><p><strong>McIntosh:</strong> I prodotti sono gi&agrave; stati importati.</p></div>';
        });
        return;
    }

    // Serve per media_sideload_image.
    require_once ABSPATH . 'wp-admin/includes/media.php';
    require_once ABSPATH . 'wp-admin/includes/file.php';
    require_once ABSPATH . 'wp-admin/includes/image.php';

    // Assicura che il brand McIntosh esista.
    $brand_term = term_exists('mcintosh', 'brand');
    if (!$brand_term) {
        $brand_term = wp_insert_term('McIntosh', 'brand', array('slug' => 'mcintosh'));
    }
    if (is_array($brand_term)) {
        $brand_term_id = (int) $brand_term['term_id'];
    } else {
        $brand_term_id = (int) $brand_term;
    }

    // Meta del brand.
    update_term_meta($brand_term_id, 'brand_logo', 'https://www.mcintoshlabs.com/-/media/Images/mcintoshlabs/McIntoshLogo.svg');
    update_term_meta($brand_term_id, 'brand_website', 'https://www.mcintoshlabs.com');

    // Assicura che la categoria Amplificazioni > Integrati Stereo esista.
    $parent_term = term_exists('amplificazioni', 'categoria_prodotto');
    if (!$parent_term) {
        $parent_term = wp_insert_term('Amplificazioni', 'categoria_prodotto', array('slug' => 'amplificazioni'));
    }
    $parent_id = is_array($parent_term) ? (int) $parent_term['term_id'] : (int) $parent_term;

    $cat_term = term_exists('integrati-stereo', 'categoria_prodotto');
    if (!$cat_term) {
        wp_insert_term('Amplificatori Integrati Stereo', 'categoria_prodotto', array(
            'slug'   => 'integrati-stereo',
            'parent' => $parent_id,
        ));
    }

    // ---------- Definizione dei 6 prodotti ----------

    $products = array(

        // 1. MA12000
        array(
            'title'       => 'McIntosh MA12000',
            'slug'        => 'mcintosh-ma12000',
            'subtitle'    => 'Amplificatore Integrato Ibrido 2 Canali',
            'price'       => 'A partire da €23.000',
            'price_range' => 'oltre-5000',
            'featured'    => '1',
            'new'         => '1',
            'image_url'   => 'https://www.mcintoshlabs.com/-/media/Images/mcintoshlabs/Products/ProductImages/MA12000/MA12000-Front-Top-USB-landing-J.jpg',
            'excerpt'     => 'Il piu potente amplificatore integrato McIntosh: 350W per canale con tecnologia Hybrid Drive, preamplificazione a valvole e finale a stato solido.',
            'content'     => '<p>Il <strong>McIntosh MA12000</strong> rappresenta il vertice assoluto della gamma di amplificatori integrati McIntosh. Con una potenza di <strong>350 Watt per canale</strong> su carichi da 2, 4 e 8 Ohm grazie alla tecnologia brevettata Autoformer, questo amplificatore ibrido combina il meglio di due mondi: la calda musicalita delle valvole nella sezione preamplificatrice e la potenza pura dello stato solido nel finale.</p>

<p>La sezione preamplificatrice impiega <strong>4 valvole 12AX7A</strong> (2 per canale), mentre il modulo DAC DA2 integrato supporta audio ad alta risoluzione fino a <strong>DSD512 e PCM 32-bit/384kHz</strong>. Con 17 ingressi tra analogici e digitali, inclusi phono MC e MM con carico regolabile, HDMI ARC e USB, il MA12000 e pronto per qualsiasi sorgente musicale.</p>

<p>L\'equalizzatore analogico a 8 bande, i leggendari VU-meter blu a doppia scala e il design iconico con pannello frontale in vetro nero completano un amplificatore che non scende a compromessi ne in termini di prestazioni ne di estetica.</p>',
            'specs'       => array(
                array('Potenza', '350W per canale (2, 4, 8 Ohm)'),
                array('Tipo', 'Ibrido (valvole + stato solido)'),
                array('Valvole', '4x 12AX7A'),
                array('THD', '0,005%'),
                array('Risposta in frequenza', '20Hz - 20kHz (+0, -0,5dB)'),
                array('Rapporto S/N', '114dB (ingresso finale)'),
                array('Headroom dinamico', '1,5dB'),
                array('Ingressi analogici', '2 bilanciati, 6 sbilanciati, Phono MC + MM'),
                array('Ingressi digitali', '2 coassiali, 2 ottici, USB, MCT, HDMI ARC'),
                array('DAC', '8 canali, 32-bit/384kHz, Quad Balanced'),
                array('Uscita cuffie', 'Si, 6,3mm con HXD'),
                array('Dimensioni', '44,5 x 24 x 50,2 cm'),
                array('Peso', '48,9 kg'),
            ),
            'meta_title'  => 'McIntosh MA12000 — Amplificatore Integrato Ibrido',
            'meta_desc'   => 'McIntosh MA12000: amplificatore integrato ibrido da 350W/ch con preamplificazione a valvole, DAC DA2 ad alta risoluzione e tecnologia Autoformer.',
        ),

        // 2. MA9500
        array(
            'title'       => 'McIntosh MA9500',
            'slug'        => 'mcintosh-ma9500',
            'subtitle'    => 'Amplificatore Integrato Stato Solido 2 Canali',
            'price'       => 'A partire da €18.000',
            'price_range' => 'oltre-5000',
            'featured'    => '1',
            'new'         => '1',
            'image_url'   => 'https://www.mcintoshlabs.com/-/media/Images/mcintoshlabs/Products/ProductImages/MA9500/MA9500-Front-Top-USB-landing-J.jpg',
            'excerpt'     => 'L\'amplificatore integrato a stato solido di riferimento McIntosh: 300W per canale con DAC DA2, phono MC/MM e connettivita completa.',
            'content'     => '<p>Il <strong>McIntosh MA9500</strong> e il flagship degli amplificatori integrati a stato solido McIntosh. Eroga <strong>300 Watt per canale</strong> su qualsiasi carico da 2, 4 e 8 Ohm grazie ai trasformatori di uscita Autoformer brevettati, garantendo prestazioni costanti indipendentemente dai diffusori collegati.</p>

<p>Rispetto al predecessore MA9000, il MA9500 offre un <strong>headroom dinamico migliorato a 2,8dB</strong> grazie al raddoppio della capacita di filtraggio, per una riproduzione dei transienti ancora piu precisa e un controllo del basso superiore. Il modulo DAC DA2 integrato gestisce sorgenti digitali fino a <strong>DSD512 via USB</strong>.</p>

<p>La dotazione di ingressi e completa: 10 analogici (inclusi phono MC e MM con carico regolabile) e 7 digitali. L\'equalizzatore analogico a 8 bande permette di ottimizzare la risposta in frequenza per qualsiasi ambiente. Certificato Roon Tested.</p>',
            'specs'       => array(
                array('Potenza', '300W per canale (2, 4, 8 Ohm)'),
                array('Tipo', 'Stato solido'),
                array('THD', '0,005%'),
                array('Risposta in frequenza', '20Hz - 20kHz (+0, -0,5dB)'),
                array('Rapporto S/N', '114dB (ingresso finale)'),
                array('Headroom dinamico', '2,8dB'),
                array('Ingressi analogici', '2 bilanciati, 6 sbilanciati, Phono MC + MM'),
                array('Ingressi digitali', '2 coassiali, 2 ottici, USB, MCT, HDMI ARC'),
                array('DAC', '8 canali, 32-bit/384kHz, Quad Balanced'),
                array('Equalizzatore', '8 bande analogico'),
                array('Uscita cuffie', 'Si, 6,3mm con HXD'),
                array('Dimensioni', '44,5 x 24 x 50,2 cm'),
                array('Peso', '45,8 kg'),
            ),
            'meta_title'  => 'McIntosh MA9500 — Amplificatore Integrato 300W',
            'meta_desc'   => 'McIntosh MA9500: amplificatore integrato a stato solido da 300W/ch con Autoformer, DAC DA2 DSD512 e equalizzatore analogico a 8 bande.',
        ),

        // 3. MA8950
        array(
            'title'       => 'McIntosh MA8950',
            'slug'        => 'mcintosh-ma8950',
            'subtitle'    => 'Amplificatore Integrato Stato Solido 2 Canali',
            'price'       => 'A partire da €13.000',
            'price_range' => 'oltre-5000',
            'featured'    => '1',
            'new'         => '0',
            'image_url'   => 'https://www.mcintoshlabs.com/-/media/Images/mcintoshlabs/Products/ProductImages/MA8950/MA8950-Front-Top-HDMI-landing-J.jpg',
            'excerpt'     => 'Amplificatore integrato a stato solido da 200W per canale con tecnologia Autoformer, DAC DA2 e equalizzatore a 5 bande.',
            'content'     => '<p>Il <strong>McIntosh MA8950</strong> offre <strong>200 Watt per canale</strong> su 2, 4 e 8 Ohm in un formato piu compatto rispetto ai modelli superiori, senza rinunciare alle tecnologie distintive McIntosh. La tecnologia Autoformer assicura la piena potenza su qualsiasi carico, mentre il sistema Power Guard previene il clipping.</p>

<p>Erede del pluripremiato MA8900, il MA8950 introduce il modulo DAC DA2 aggiornato con supporto <strong>DSD512 via USB</strong> e un headroom dinamico migliorato a 3,1dB grazie al raddoppio della capacita di filtraggio. L\'equalizzatore analogico a 5 bande consente di adattare il suono al proprio ambiente di ascolto.</p>

<p>Con 15 ingressi analogici e 7 digitali, sezione phono MC/MM, uscita cuffie High Drive con HXD e Home Theater PassThru, il MA8950 e un centro di comando completo per qualsiasi sistema hi-fi.</p>',
            'specs'       => array(
                array('Potenza', '200W per canale (2, 4, 8 Ohm)'),
                array('Tipo', 'Stato solido'),
                array('THD', '0,005%'),
                array('Risposta in frequenza', '20Hz - 20kHz (+0, -0,5dB)'),
                array('Rapporto S/N', '95dB (alto livello)'),
                array('Headroom dinamico', '3,1dB'),
                array('Ingressi analogici', '1 bilanciato, 6 sbilanciati, Phono MC + MM'),
                array('Ingressi digitali', '2 coassiali, 2 ottici, USB, MCT, HDMI ARC'),
                array('DAC', '8 canali, 32-bit/384kHz, Quad Balanced'),
                array('Equalizzatore', '5 bande analogico'),
                array('Dimensioni', '44,5 x 19,4 x 47,6 cm'),
                array('Peso', '34,1 kg'),
            ),
            'meta_title'  => 'McIntosh MA8950 — Amplificatore Integrato 200W',
            'meta_desc'   => 'McIntosh MA8950: amplificatore integrato a stato solido da 200W/ch con Autoformer, DAC DA2 DSD512 e 22 ingressi totali.',
        ),

        // 4. MA352
        array(
            'title'       => 'McIntosh MA352',
            'slug'        => 'mcintosh-ma352',
            'subtitle'    => 'Amplificatore Integrato Ibrido 2 Canali',
            'price'       => 'A partire da €8.500',
            'price_range' => 'oltre-5000',
            'featured'    => '0',
            'new'         => '0',
            'image_url'   => 'https://www.mcintoshlabs.com/-/media/Images/mcintoshlabs/Products/ProductImages/MA352/MA352-Angle-landing-J.jpg',
            'excerpt'     => 'Amplificatore integrato ibrido con preamplificazione a valvole e finale a stato solido da 200W per canale. Design interamente analogico.',
            'content'     => '<p>Il <strong>McIntosh MA352</strong> e un amplificatore integrato ibrido che fonde l\'anima analogica delle valvole con la potenza dello stato solido. La sezione preamplificatrice utilizza <strong>2 valvole 12AX7A e 2 valvole 12AT7</strong>, mentre il finale a stato solido eroga <strong>200 Watt per canale su 8 Ohm e 320 Watt su 4 Ohm</strong>.</p>

<p>A differenza dei modelli superiori, il MA352 e un design <strong>interamente analogico</strong> — nessun DAC integrato — pensato per gli audiofili puristi che preferiscono sorgenti analogiche o DAC esterni dedicati. Il fattore di smorzamento superiore a 200 garantisce un controllo eccezionale sui diffusori.</p>

<p>L\'equipaggiamento include ingresso phono MM con carico regolabile, 2 ingressi bilanciati, 3 sbilanciati, 2 uscite subwoofer, equalizzatore a 5 bande e uscita cuffie con HXD. Premiato come "Best Hybrid Amplifier 2020" da Hi-Fi World.</p>',
            'specs'       => array(
                array('Potenza', '200W/ch (8 Ohm), 320W/ch (4 Ohm)'),
                array('Tipo', 'Ibrido (valvole + stato solido)'),
                array('Valvole', '2x 12AX7A + 2x 12AT7'),
                array('THD', '0,03%'),
                array('Risposta in frequenza', '20Hz - 20kHz (+0, -0,5dB)'),
                array('Fattore di smorzamento', '>200 (8 Ohm)'),
                array('Headroom dinamico', '1,5dB'),
                array('Ingressi', '2 bilanciati, 3 sbilanciati, Phono MM'),
                array('Uscite', 'Pre-out stereo, 2x subwoofer'),
                array('Equalizzatore', '5 bande analogico'),
                array('Uscita cuffie', 'Si, 6,3mm con HXD'),
                array('Dimensioni', '44,5 x 25,1 x 44,3 cm'),
                array('Peso', '29,9 kg'),
            ),
            'meta_title'  => 'McIntosh MA352 — Amplificatore Ibrido Analogico',
            'meta_desc'   => 'McIntosh MA352: amplificatore integrato ibrido con 4 valvole, 200W/ch e design interamente analogico. Best Hybrid Amplifier 2020.',
        ),

        // 5. MA7200
        array(
            'title'       => 'McIntosh MA7200',
            'slug'        => 'mcintosh-ma7200',
            'subtitle'    => 'Amplificatore Integrato Stato Solido 2 Canali',
            'price'       => 'A partire da €7.500',
            'price_range' => 'oltre-5000',
            'featured'    => '0',
            'new'         => '0',
            'image_url'   => 'https://www.mcintoshlabs.com/-/media/Images/mcintoshlabs/Products/ProductImages/MA7200/MA7200-Front-Top-USB-landing-J.jpg',
            'excerpt'     => 'Amplificatore integrato a stato solido da 200W per canale con Autoformer, DAC integrato e sezione phono MC/MM.',
            'content'     => '<p>Il <strong>McIntosh MA7200</strong> eroga <strong>200 Watt per canale</strong> su 2, 4 e 8 Ohm grazie alla tecnologia brevettata Autoformer, posizionandosi come un amplificatore integrato completo e versatile nella gamma McIntosh.</p>

<p>La dotazione e di alto livello: <strong>8 ingressi analogici</strong> (5 sbilanciati, 1 bilanciato, phono MC e MM) e <strong>7 ingressi digitali</strong> tramite il modulo DAC DA1 con supporto fino a DSD256 e PCM 32-bit/384kHz via USB. L\'ingresso MCT dedicato garantisce la connessione sicura con i trasporti SACD/CD McIntosh.</p>

<p>Le tecnologie Power Guard, Sentry Monitor e i Monogrammed Heatsinks proteggono l\'amplificatore e i diffusori in ogni condizione. L\'uscita cuffie High Drive con HXD completa un amplificatore pensato per essere il cuore di un sistema hi-fi di classe.</p>',
            'specs'       => array(
                array('Potenza', '200W per canale (2, 4, 8 Ohm)'),
                array('Tipo', 'Stato solido'),
                array('THD', '0,005%'),
                array('Risposta in frequenza', '20Hz - 20kHz (+0, -0,5dB)'),
                array('Rapporto S/N', '113dB (ingresso finale)'),
                array('Headroom dinamico', '2dB'),
                array('Fattore di smorzamento', '>40'),
                array('Ingressi analogici', '1 bilanciato, 5 sbilanciati, Phono MC + MM'),
                array('Ingressi digitali', '2 coassiali, 2 ottici, USB, MCT, HDMI ARC'),
                array('DAC', '8 canali, 32-bit, Quad Balanced'),
                array('Dimensioni', '44,5 x 19,4 x 55,9 cm'),
                array('Peso', '34,1 kg'),
            ),
            'meta_title'  => 'McIntosh MA7200 — Amplificatore Integrato 200W',
            'meta_desc'   => 'McIntosh MA7200: amplificatore integrato a stato solido 200W/ch con Autoformer, DAC integrato, phono MC/MM e 15 ingressi totali.',
        ),

        // 6. MSA5500
        array(
            'title'       => 'McIntosh MSA5500',
            'slug'        => 'mcintosh-msa5500',
            'subtitle'    => 'Amplificatore Integrato Streaming 2 Canali',
            'price'       => 'A partire da €6.000',
            'price_range' => 'oltre-5000',
            'featured'    => '1',
            'new'         => '1',
            'image_url'   => 'https://www.mcintoshlabs.com/-/media/Images/mcintoshlabs/Products/ProductImages/MSA5500/MSA5500-Front-Top-Bluetooth-landing-P.png',
            'excerpt'     => 'Amplificatore integrato con streamer musicale integrato: AirPlay, Bluetooth 5.0, Spotify Connect, TIDAL Connect, Roon Ready e 100W per canale.',
            'content'     => '<p>Il <strong>McIntosh MSA5500</strong> e il primo amplificatore integrato McIntosh con <strong>streamer musicale integrato</strong>. Unisce un amplificatore da <strong>100 Watt per canale</strong> (160W su 4 Ohm) a una piattaforma di streaming completa con Wi-Fi 6 e Bluetooth 5.0 aptX HD.</p>

<p>Supporta nativamente <strong>AirPlay, Spotify Connect, TIDAL Connect, Qobuz Connect e Google Cast</strong>, ed e certificato <strong>Roon Ready</strong> per l\'integrazione con il sistema di gestione musicale piu avanzato. Il DAC Quad Balanced 32-bit/384kHz gestisce formati fino a DSD512.</p>

<p>Nonostante le dimensioni compatte (solo 38 lbs), il MSA5500 non rinuncia a nulla: ingresso phono MM, 12 ingressi totali tra analogici e digitali, uscita cuffie con HXD, uscita subwoofer e Home Theater PassThru. Premiato come "Best High-End All-In-One Hi-Fi System 2025/2026" da AVForums.</p>',
            'specs'       => array(
                array('Potenza', '100W/ch (8 Ohm), 160W/ch (4 Ohm)'),
                array('Tipo', 'Stato solido con streamer'),
                array('THD', '0,005%'),
                array('Risposta in frequenza', '20Hz - 20kHz (+0, -0,5dB)'),
                array('Rapporto S/N', '110dB (ingresso finale)'),
                array('Headroom dinamico', '1,8dB'),
                array('Streaming', 'AirPlay, Bluetooth 5.0 aptX HD, Spotify Connect, TIDAL Connect, Qobuz Connect, Google Cast'),
                array('Roon', 'Roon Ready'),
                array('Wi-Fi', 'Wi-Fi 6 dual antenna'),
                array('Ingressi analogici', '1 bilanciato, 4 sbilanciati, Phono MM'),
                array('Ingressi digitali', '2 coassiali, 2 ottici, USB, MCT, HDMI ARC'),
                array('DAC', '8 canali, 32-bit/384kHz, Quad Balanced'),
                array('Dimensioni', '44,5 x 15,2 x 47,6 cm'),
                array('Peso', '17,2 kg'),
            ),
            'meta_title'  => 'McIntosh MSA5500 — Streaming Amplificatore Integrato',
            'meta_desc'   => 'McIntosh MSA5500: amplificatore integrato con streamer Wi-Fi 6, Roon Ready, Spotify/TIDAL Connect e 100W/ch. Best All-In-One 2025/2026.',
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
        wp_set_object_terms($post_id, 'mcintosh', 'brand');
        wp_set_object_terms($post_id, array('amplificazioni', 'integrati-stereo'), 'categoria_prodotto');
        wp_set_object_terms($post_id, $product['price_range'], 'fascia_prezzo');

        // Meta campi prodotto.
        update_post_meta($post_id, 'prodotto_sottotitolo', $product['subtitle']);
        update_post_meta($post_id, 'prodotto_shop_url', HIFISOLUTION_SHOP_URL);
        update_post_meta($post_id, 'prodotto_prezzo_indicativo', $product['price']);
        update_post_meta($post_id, 'prodotto_in_evidenza', $product['featured']);
        update_post_meta($post_id, 'prodotto_novita', $product['new']);

        // SEO.
        update_post_meta($post_id, 'prodotto_meta_title', $product['meta_title']);
        update_post_meta($post_id, 'prodotto_meta_description', $product['meta_desc']);

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

        // Immagine in evidenza.
        if (!empty($product['image_url'])) {
            $image_id = media_sideload_image($product['image_url'], $post_id, $product['title'], 'id');
            if (!is_wp_error($image_id)) {
                set_post_thumbnail($post_id, $image_id);
            }
        }

        $imported++;
    }

    // Segna come importato.
    update_option('hifi_mcintosh_imported', true);

    // Rigenera i permalink.
    flush_rewrite_rules();

    add_action('admin_notices', function () use ($imported) {
        echo '<div class="notice notice-success"><p><strong>McIntosh:</strong> ' . esc_html($imported) . ' prodotti importati con successo!</p></div>';
    });
}
add_action('admin_init', 'hifisolution_import_mcintosh');
