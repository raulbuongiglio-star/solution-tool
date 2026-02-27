/**
 * HiFi Solution — Catalog JavaScript
 *
 * Filtri AJAX per il catalogo prodotti.
 *
 * @package HiFiSolution
 */

(function () {
    'use strict';

    var productsGrid = document.getElementById('hifi-products-grid');
    var filtersForm = document.getElementById('hifi-catalog-filters');

    if (!productsGrid || !filtersForm) return;

    var filterSelects = filtersForm.querySelectorAll('.hifi-filters__select');
    var currentPage = 1;
    var isLoading = false;

    /**
     * Gestione cambio filtro
     */
    filterSelects.forEach(function (select) {
        select.addEventListener('change', function () {
            currentPage = 1;
            fetchProducts();
        });
    });

    /**
     * Recupera i prodotti filtrati via AJAX
     */
    function fetchProducts() {
        if (isLoading || typeof hifiData === 'undefined') return;
        isLoading = true;

        // Mostra spinner
        productsGrid.innerHTML =
            '<div class="hifi-loading" style="grid-column: 1/-1;"><div class="hifi-spinner"></div></div>';

        // Raccogli i valori dei filtri
        var formData = new FormData();
        formData.append('action', 'hifi_filter_products');
        formData.append('nonce', hifiData.nonce);
        formData.append('page', currentPage);

        filterSelects.forEach(function (select) {
            var filterName = select.getAttribute('data-filter');
            var filterValue = select.value;
            if (filterName && filterValue) {
                formData.append(filterName, filterValue);
            }
        });

        // Richiesta AJAX
        fetch(hifiData.ajaxUrl, {
            method: 'POST',
            body: formData,
        })
            .then(function (response) {
                return response.json();
            })
            .then(function (data) {
                if (data.success) {
                    productsGrid.innerHTML = data.data.html;

                    // Re-inizializza scroll reveal per i nuovi elementi
                    initFilteredReveal();

                    // Aggiorna URL senza ricaricare la pagina
                    updateUrl();
                } else {
                    productsGrid.innerHTML =
                        '<p class="hifi-text-center hifi-text-muted" style="grid-column: 1/-1; padding: 60px 0;">Nessun prodotto trovato.</p>';
                }
            })
            .catch(function () {
                productsGrid.innerHTML =
                    '<p class="hifi-text-center hifi-text-muted" style="grid-column: 1/-1; padding: 60px 0;">Errore nel caricamento. Riprova.</p>';
            })
            .finally(function () {
                isLoading = false;
            });
    }

    /**
     * Re-inizializza le animazioni per i nuovi elementi
     */
    function initFilteredReveal() {
        var newElements = productsGrid.querySelectorAll('.hifi-reveal');
        if (!newElements.length) return;

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

            newElements.forEach(function (el) {
                observer.observe(el);
            });
        } else {
            newElements.forEach(function (el) {
                el.classList.add('revealed');
            });
        }
    }

    /**
     * Aggiorna l'URL con i parametri dei filtri
     */
    function updateUrl() {
        var params = new URLSearchParams();

        filterSelects.forEach(function (select) {
            var filterName = select.getAttribute('data-filter');
            var filterValue = select.value;
            if (filterName && filterValue) {
                params.set(filterName, filterValue);
            }
        });

        var newUrl =
            window.location.pathname +
            (params.toString() ? '?' + params.toString() : '');
        window.history.replaceState({}, '', newUrl);
    }

    /**
     * Inizializza i filtri dall'URL corrente
     */
    function initFiltersFromUrl() {
        var params = new URLSearchParams(window.location.search);

        filterSelects.forEach(function (select) {
            var filterName = select.getAttribute('data-filter');
            if (filterName && params.has(filterName)) {
                select.value = params.get(filterName);
            }
        });
    }

    // Inizializza
    initFiltersFromUrl();
})();
