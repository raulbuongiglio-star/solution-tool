<?php
/**
 * Header del tema HiFi Solution.
 *
 * @package HiFiSolution
 */

defined('ABSPATH') || exit;
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e('Vai al contenuto', 'hifisolution'); ?></a>

<header id="masthead" class="site-header">
    <div class="hifi-container">
        <div class="hifi-header">
            <!-- Logo -->
            <div class="hifi-header__logo">
                <?php if (has_custom_logo()) : ?>
                    <?php the_custom_logo(); ?>
                <?php else : ?>
                    <a href="<?php echo esc_url(home_url('/')); ?>" class="hifi-header__brand" rel="home">
                        <span class="hifi-header__brand-name">HiFi</span>
                        <span class="hifi-header__brand-accent">Solution</span>
                    </a>
                <?php endif; ?>
            </div>

            <!-- Navigation -->
            <nav id="site-navigation" class="main-navigation" aria-label="<?php esc_attr_e('Menu principale', 'hifisolution'); ?>">
                <button class="hifi-menu-toggle" aria-controls="primary-menu" aria-expanded="false" aria-label="<?php esc_attr_e('Menu', 'hifisolution'); ?>">
                    <span class="hifi-menu-toggle__bar"></span>
                    <span class="hifi-menu-toggle__bar"></span>
                    <span class="hifi-menu-toggle__bar"></span>
                </button>
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'primary',
                    'menu_id'        => 'primary-menu',
                    'container'      => false,
                    'menu_class'     => 'hifi-nav__list',
                    'fallback_cb'    => 'hifisolution_fallback_menu',
                ));
                ?>
            </nav>

            <!-- CTA Header -->
            <div class="hifi-header__cta">
                <a href="<?php echo esc_url(HIFISOLUTION_SHOP_URL); ?>" class="hifi-btn hifi-btn--primary hifi-btn--sm" target="_blank" rel="noopener noreferrer">
                    <?php esc_html_e('Shop Online', 'hifisolution'); ?>
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path><polyline points="15 3 21 3 21 9"></polyline><line x1="10" y1="14" x2="21" y2="3"></line></svg>
                </a>
            </div>
        </div>
    </div>
</header>

<?php
/**
 * Fallback menu se nessun menu è assegnato.
 */
function hifisolution_fallback_menu() {
    echo '<ul class="hifi-nav__list">';
    echo '<li><a href="' . esc_url(home_url('/')) . '">' . esc_html__('Home', 'hifisolution') . '</a></li>';
    echo '<li><a href="' . esc_url(home_url('/chi-siamo/')) . '">' . esc_html__('Chi Siamo', 'hifisolution') . '</a></li>';
    echo '<li><a href="' . esc_url(get_post_type_archive_link('prodotto')) . '">' . esc_html__('Catalogo', 'hifisolution') . '</a></li>';
    echo '<li><a href="' . esc_url(home_url('/marchi/')) . '">' . esc_html__('Brand', 'hifisolution') . '</a></li>';
    echo '<li><a href="' . esc_url(home_url('/servizi/')) . '">' . esc_html__('Servizi', 'hifisolution') . '</a></li>';
    echo '<li><a href="' . esc_url(home_url('/blog/')) . '">' . esc_html__('Blog', 'hifisolution') . '</a></li>';
    echo '<li><a href="' . esc_url(home_url('/contatti/')) . '">' . esc_html__('Contatti', 'hifisolution') . '</a></li>';
    echo '</ul>';
}
?>
