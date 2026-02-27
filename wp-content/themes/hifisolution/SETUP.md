# HiFi Solution — Guida all'installazione

## Requisiti
- WordPress 6.0+
- PHP 8.0+
- Tema GeneratePress installato e attivo come tema parent

## Installazione

### 1. Installa GeneratePress
1. Da WordPress Admin → Aspetto → Temi → Aggiungi nuovo
2. Cerca "GeneratePress" e installalo
3. **NON attivarlo** — attiveremo il child theme

### 2. Installa il tema child HiFi Solution
1. Carica la cartella `hifisolution` in `/wp-content/themes/`
2. Da WordPress Admin → Aspetto → Temi → Attiva "HiFi Solution"

### 3. Plugin necessari
Installa e attiva i seguenti plugin:

| Plugin | Scopo |
|--------|-------|
| **Advanced Custom Fields PRO** | Campi personalizzati prodotti (galleria, specifiche, ecc.) |
| **Yoast SEO** o **Rank Math** | SEO completo (sitemap, meta tags, ecc.) |
| **WP Rocket** o **LiteSpeed Cache** | Performance e caching |
| **Smush** o **ShortPixel** | Ottimizzazione immagini e conversione WebP |
| **WPForms Lite** | Form contatti |
| **Google Site Kit** | Analytics e Search Console |

### 4. Configurazione iniziale

#### Crea le pagine
1. **Home** — Assegna il template "Home Page"
2. **Chi Siamo** — Assegna il template "Chi Siamo"
3. **I Nostri Marchi** — Assegna il template "I Nostri Marchi"
4. **Servizi** — Assegna il template "Servizi"
5. **Contatti** — Assegna il template "Contatti"
6. **Blog** — Pagina standard per gli articoli
7. **Privacy Policy** — Pagina legale
8. **Cookie Policy** — Pagina legale

#### Imposta le pagine
- Da Impostazioni → Lettura:
  - "La pagina iniziale mostra" → Una pagina statica
  - Pagina iniziale: **Home**
  - Pagina articoli: **Blog**

#### Configura i permalink
- Da Impostazioni → Permalink → Struttura personalizzata:
  - `/%postname%/`
- Salva per rigenerare i rewrite rules

#### Crea i menu
- Da Aspetto → Menu:
  - **Menu Principale** (posizione: Menu Principale):
    - Home | Chi Siamo | Catalogo (link a /prodotti/) | Brand (link a /marchi/) | Servizi | Blog | Contatti
  - **Menu Footer** (posizione: Menu Footer):
    - Stesse voci

### 5. Aggiungi contenuti

#### Prodotti (CPT)
1. Da Prodotti HiFi → Aggiungi Nuovo
2. Compila:
   - Titolo (nome prodotto)
   - Contenuto (descrizione dettagliata, min 300 parole per SEO)
   - Immagine in evidenza
   - Galleria immagini (ACF)
   - Specifiche tecniche (ACF repeater)
   - Link allo shop (URL su hifisolution.it)
   - Prezzo indicativo
   - Brand (tassonomia)
   - Categoria prodotto (tassonomia)
   - Fascia di prezzo (tassonomia)

#### Pagine Brand (CPT)
1. Da Pagine Brand → Aggiungi Nuova
2. Compila:
   - Titolo (nome brand)
   - Contenuto (storia del brand)
   - Logo brand (ACF)
   - Filosofia del brand (ACF)
   - Perché HiFi Solution ha scelto questo brand (ACF)
   - Brand collegato (tassonomia, ACF)

### 6. Immagini
Carica le seguenti immagini nella cartella `assets/images/`:
- `placeholder-hero.jpg` — Immagine hero home page (1920x1080)
- `placeholder-about.jpg` — Foto showroom
- `placeholder-sala-ascolto.jpg` — Foto sala d'ascolto
- `logo.png` — Logo HiFi Solution
- `og-default.jpg` — Immagine Open Graph di default (1200x630)

### 7. Personalizzazioni
- **Telefono e indirizzo**: Cerca "XXX" nei file del tema e sostituisci con i dati reali
- **Google Maps embed**: Aggiorna l'URL dell'iframe con le coordinate corrette
- **WhatsApp**: Aggiorna il numero nella pagina contatti
- **Social media**: Aggiorna i link nel footer e nella pagina contatti
- **P.IVA**: Aggiorna nel footer

### 8. SEO
1. Configura Yoast SEO / Rank Math con le impostazioni consigliate
2. Registra il sito su Google Search Console
3. Invia la sitemap XML
4. Carica il file `robots.txt` nella root del dominio

## Struttura file

```
hifisolution/
├── style.css                    # Tema base CSS + metadata
├── functions.php                # Include moduli
├── header.php                   # Header custom
├── footer.php                   # Footer custom
├── 404.php                      # Pagina errore 404
├── searchform.php               # Form di ricerca
├── single-prodotto.php          # Singolo prodotto
├── archive-prodotto.php         # Catalogo prodotti
├── single-brand_page.php        # Singola pagina brand
├── taxonomy-brand.php           # Archivio per brand
├── taxonomy-categoria_prodotto.php # Archivio per categoria
├── inc/
│   ├── theme-setup.php          # Configurazione tema
│   ├── enqueue.php              # Stili e script
│   ├── custom-post-types.php    # CPT Prodotto e Brand
│   ├── custom-taxonomies.php    # Tassonomie
│   ├── acf-fields.php           # Campi ACF
│   ├── seo-schema.php           # Schema markup JSON-LD
│   ├── breadcrumbs.php          # Breadcrumbs
│   └── template-functions.php   # Helper functions
├── templates/
│   ├── template-home.php        # Home page
│   ├── template-chi-siamo.php   # Chi siamo
│   ├── template-servizi.php     # Servizi
│   ├── template-contatti.php    # Contatti
│   └── template-brand-archive.php # Archivio brand
├── template-parts/
│   ├── hero-section.php         # Hero home
│   ├── brand-carousel.php       # Carousel brand
│   ├── category-grid.php        # Griglia categorie
│   ├── content-prodotto-card.php # Card prodotto
│   ├── testimonials.php         # Testimonianze
│   └── blog-preview.php         # Preview blog
└── assets/
    ├── css/custom.css           # CSS aggiuntivo
    ├── js/main.js               # JS principale
    ├── js/product.js            # JS galleria prodotto
    ├── js/catalog.js            # JS filtri catalogo
    └── images/                  # Immagini tema
```
