/**
 * HiFi Solution — Main JavaScript
 *
 * Animazioni, header scroll, menu mobile, lightbox.
 *
 * @package HiFiSolution
 */

(function () {
    'use strict';

    /**
     * Header scroll effect — aggiunge classe .scrolled
     */
    function initHeaderScroll() {
        var header = document.querySelector('.site-header');
        if (!header) return;

        var scrollThreshold = 50;

        function handleScroll() {
            if (window.scrollY > scrollThreshold) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }
        }

        window.addEventListener('scroll', handleScroll, { passive: true });
        handleScroll();
    }

    /**
     * Mobile menu toggle
     */
    function initMobileMenu() {
        var toggle = document.querySelector('.hifi-menu-toggle');
        var menu = document.querySelector('.hifi-nav__list');
        if (!toggle || !menu) return;

        toggle.addEventListener('click', function () {
            var isOpen = toggle.getAttribute('aria-expanded') === 'true';
            toggle.setAttribute('aria-expanded', !isOpen);
            menu.classList.toggle('is-open');
        });

        // Chiudi il menu quando si clicca su un link
        var links = menu.querySelectorAll('a');
        links.forEach(function (link) {
            link.addEventListener('click', function () {
                toggle.setAttribute('aria-expanded', 'false');
                menu.classList.remove('is-open');
            });
        });
    }

    /**
     * Scroll reveal — animazioni fade-in on scroll
     */
    function initScrollReveal() {
        var elements = document.querySelectorAll('.hifi-reveal');
        if (!elements.length) return;

        // Usa IntersectionObserver se disponibile
        if ('IntersectionObserver' in window) {
            var observer = new IntersectionObserver(
                function (entries) {
                    entries.forEach(function (entry) {
                        if (entry.isIntersecting) {
                            entry.target.classList.add('revealed');
                            observer.unobserve(entry.target);
                        }
                    });
                },
                {
                    threshold: 0.1,
                    rootMargin: '0px 0px -50px 0px',
                }
            );

            elements.forEach(function (el) {
                observer.observe(el);
            });
        } else {
            // Fallback: mostra tutto subito
            elements.forEach(function (el) {
                el.classList.add('revealed');
            });
        }
    }

    /**
     * Lightbox per le immagini prodotto
     */
    function initLightbox() {
        // Crea l'elemento lightbox se non esiste
        var lightbox = document.querySelector('.hifi-lightbox');
        if (!lightbox) {
            lightbox = document.createElement('div');
            lightbox.className = 'hifi-lightbox';
            lightbox.innerHTML =
                '<button class="hifi-lightbox__close" aria-label="Chiudi">&times;</button>' +
                '<img class="hifi-lightbox__img" src="" alt="">';
            document.body.appendChild(lightbox);
        }

        var lightboxImg = lightbox.querySelector('.hifi-lightbox__img');
        var closeBtn = lightbox.querySelector('.hifi-lightbox__close');

        // Apri lightbox cliccando sull'immagine principale del prodotto
        var mainImage = document.querySelector('.hifi-product-single__main-image img');
        if (mainImage) {
            mainImage.style.cursor = 'zoom-in';
            mainImage.addEventListener('click', function () {
                lightboxImg.src = this.src;
                lightboxImg.alt = this.alt;
                lightbox.classList.add('active');
                document.body.style.overflow = 'hidden';
            });
        }

        // Chiudi lightbox
        function closeLightbox() {
            lightbox.classList.remove('active');
            document.body.style.overflow = '';
        }

        if (closeBtn) {
            closeBtn.addEventListener('click', closeLightbox);
        }

        lightbox.addEventListener('click', function (e) {
            if (e.target === lightbox) {
                closeLightbox();
            }
        });

        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape' && lightbox.classList.contains('active')) {
                closeLightbox();
            }
        });
    }

    /**
     * Smooth scroll per gli anchor link
     */
    function initSmoothScroll() {
        document.querySelectorAll('a[href^="#"]').forEach(function (anchor) {
            anchor.addEventListener('click', function (e) {
                var targetId = this.getAttribute('href');
                if (targetId === '#') return;

                var target = document.querySelector(targetId);
                if (target) {
                    e.preventDefault();
                    var headerHeight = document.querySelector('.site-header')
                        ? document.querySelector('.site-header').offsetHeight
                        : 0;
                    var targetPosition =
                        target.getBoundingClientRect().top +
                        window.scrollY -
                        headerHeight -
                        20;
                    window.scrollTo({
                        top: targetPosition,
                        behavior: 'smooth',
                    });
                }
            });
        });
    }

    /**
     * Lazy loading per le immagini con attributo loading="lazy"
     * (supporto nativo dei browser moderni)
     */
    function initLazyLoading() {
        // Il browser gestisce automaticamente loading="lazy"
        // Aggiungiamo un fallback per browser più vecchi
        if (!('loading' in HTMLImageElement.prototype)) {
            var images = document.querySelectorAll('img[loading="lazy"]');
            if (images.length && 'IntersectionObserver' in window) {
                var imgObserver = new IntersectionObserver(function (entries) {
                    entries.forEach(function (entry) {
                        if (entry.isIntersecting) {
                            var img = entry.target;
                            if (img.dataset.src) {
                                img.src = img.dataset.src;
                            }
                            imgObserver.unobserve(img);
                        }
                    });
                });

                images.forEach(function (img) {
                    imgObserver.observe(img);
                });
            }
        }
    }

    /**
     * Inizializzazione al caricamento del DOM
     */
    document.addEventListener('DOMContentLoaded', function () {
        initHeaderScroll();
        initMobileMenu();
        initScrollReveal();
        initLightbox();
        initSmoothScroll();
        initLazyLoading();
    });
})();
