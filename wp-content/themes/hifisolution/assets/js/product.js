/**
 * HiFi Solution — Product Page JavaScript
 *
 * Gestione galleria prodotto e thumbnails.
 *
 * @package HiFiSolution
 */

(function () {
    'use strict';

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

                if (fullSrc) {
                    // Fade out
                    mainImage.style.opacity = '0';
                    mainImage.style.transition = 'opacity 0.2s ease';

                    setTimeout(function () {
                        mainImage.src = fullSrc;
                        if (altText) mainImage.alt = altText;
                        mainImage.style.opacity = '1';
                    }, 200);
                }

                // Aggiorna classe attiva
                thumbnails.forEach(function (t) {
                    t.classList.remove('active');
                });
                this.classList.add('active');
            });
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
        initGalleryKeyboard();
    });
})();
