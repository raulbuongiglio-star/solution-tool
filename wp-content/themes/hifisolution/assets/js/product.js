/**
 * HiFi Solution — Product Page JavaScript
 *
 * Gestione galleria prodotto, thumbnails e varianti colore.
 *
 * @package HiFiSolution
 */

(function () {
    'use strict';

    /**
     * Cambia l'immagine principale con transizione fade.
     */
    function setMainImage(mainImage, fullSrc, altText) {
        if (!mainImage || !fullSrc) return;

        mainImage.style.opacity = '0';
        mainImage.style.transition = 'opacity 0.2s ease';

        setTimeout(function () {
            mainImage.src = fullSrc;
            if (altText) mainImage.alt = altText;
            mainImage.style.opacity = '1';
        }, 200);
    }

    /**
     * Galleria prodotto — cambio immagine tramite thumbnails
     */
    function initProductGallery() {
        var mainImage = document.getElementById('hifi-gallery-main');
        var thumbnails = document.querySelectorAll('.hifi-product-single__thumb');

        if (!mainImage || !thumbnails.length) return;

        thumbnails.forEach(function (thumb) {
            thumb.addEventListener('click', function () {
                var fullSrc = this.getAttribute('data-full');
                var altText = this.getAttribute('data-alt');

                setMainImage(mainImage, fullSrc, altText);

                // Aggiorna classe attiva sulle thumbnails
                thumbnails.forEach(function (t) {
                    t.classList.remove('active');
                });
                this.classList.add('active');

                // Sincronizza swatch variante se la thumbnail ha data-variant-index
                var variantIndex = this.getAttribute('data-variant-index');
                if (variantIndex !== null) {
                    syncVariantSwatches(variantIndex);
                }
            });
        });
    }

    /**
     * Varianti colore — cambio immagine tramite swatch colore
     */
    function initVariantSwatches() {
        var mainImage = document.getElementById('hifi-gallery-main');
        var swatches = document.querySelectorAll('.hifi-variant-swatch, .hifi-swatch--clickable');

        if (!mainImage || !swatches.length) return;

        swatches.forEach(function (swatch) {
            swatch.addEventListener('click', function () {
                var fullSrc = this.getAttribute('data-full');
                var altText = this.getAttribute('data-alt');
                var variantIndex = this.getAttribute('data-variant-index');

                setMainImage(mainImage, fullSrc, altText);

                // Sincronizza tutti gli swatch con lo stesso variant-index
                syncVariantSwatches(variantIndex);

                // Sincronizza la thumbnail corrispondente
                var matchingThumb = document.querySelector(
                    '.hifi-product-single__thumb[data-variant-index="' + variantIndex + '"]'
                );
                if (matchingThumb) {
                    document.querySelectorAll('.hifi-product-single__thumb').forEach(function (t) {
                        t.classList.remove('active');
                    });
                    matchingThumb.classList.add('active');
                }
            });
        });
    }

    /**
     * Sincronizza lo stato attivo di tutti gli swatch per un dato variant-index.
     */
    function syncVariantSwatches(variantIndex) {
        // Swatch nella barra colori sopra le thumbnails
        document.querySelectorAll('.hifi-variant-swatch').forEach(function (s) {
            s.classList.toggle('active', s.getAttribute('data-variant-index') === variantIndex);
        });

        // Swatch cliccabili nella sezione finiture
        document.querySelectorAll('.hifi-swatch--clickable').forEach(function (s) {
            s.classList.toggle('active', s.getAttribute('data-variant-index') === variantIndex);
        });
    }

    /**
     * Keyboard navigation per le thumbnails
     */
    function initGalleryKeyboard() {
        var thumbnails = document.querySelectorAll('.hifi-product-single__thumb');
        if (!thumbnails.length) return;

        document.addEventListener('keydown', function (e) {
            var activeThumb = document.querySelector(
                '.hifi-product-single__thumb.active'
            );
            if (!activeThumb) return;

            var index = Array.from(thumbnails).indexOf(activeThumb);

            if (e.key === 'ArrowRight' || e.key === 'ArrowDown') {
                e.preventDefault();
                var nextIndex = (index + 1) % thumbnails.length;
                thumbnails[nextIndex].click();
                thumbnails[nextIndex].focus();
            } else if (e.key === 'ArrowLeft' || e.key === 'ArrowUp') {
                e.preventDefault();
                var prevIndex =
                    (index - 1 + thumbnails.length) % thumbnails.length;
                thumbnails[prevIndex].click();
                thumbnails[prevIndex].focus();
            }
        });
    }

    /**
     * Inizializzazione
     */
    document.addEventListener('DOMContentLoaded', function () {
        initProductGallery();
        initVariantSwatches();
        initGalleryKeyboard();
    });
})();
