<?php
/**
 * Form di ricerca personalizzato.
 *
 * @package HiFiSolution
 */

defined('ABSPATH') || exit;
?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?>">
    <label class="hifi-sr-only" for="search-field"><?php esc_html_e('Cerca', 'hifisolution'); ?></label>
    <div style="display: flex; gap: 8px;">
        <input type="search"
               id="search-field"
               class="search-field"
               placeholder="<?php esc_attr_e('Cerca prodotti, brand, articoli...', 'hifisolution'); ?>"
               value="<?php echo get_search_query(); ?>"
               name="s"
               style="flex: 1; padding: 12px 16px; background: var(--hifi-bg-card); border: 1px solid var(--hifi-border); border-radius: var(--hifi-radius); color: var(--hifi-text-primary); font-family: var(--hifi-font-primary);">
        <button type="submit" class="hifi-btn hifi-btn--primary hifi-btn--sm">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
        </button>
    </div>
</form>
