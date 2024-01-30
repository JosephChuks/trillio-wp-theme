<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php wp_title(); ?></title>
    <?php wp_head(); ?>
</head>

<body>
    <div class="container">
        <header class="header">
            <div class="header-items">
                <a href="<?php echo get_site_url() ?>">
                    <?php
                    if (function_exists('the_custom_logo')) {
                        $custom_logo_id = get_theme_mod('theme_logo');
                        $logo_url = wp_get_attachment_image_url($custom_logo_id, 'full');
                        echo '<img src="' . esc_url($logo_url) . '" alt="' . get_bloginfo('name') . '" class="logo">';
                        }
                    ?>
                </a>
                <form action="<?php echo get_site_url() ?>" class="search">
                    <input type="text" inputmode="predictOn" name="s" class="search__input"
                        placeholder="Enter Search Keyword">
                    <button class="search__button">
                        <svg class="search__icon">
                            <use
                                xlink:href="<?php echo get_template_directory_uri() ?>/assets/img/sprite.svg#icon-search">
                            </use>
                        </svg>
                    </button>
                </form>
                <nav class="user-nav">
                <?php dynamic_sidebar('header_widget'); ?>
                </nav>
            </div>
            <?php
            wp_nav_menu(array(
                'theme_location' => 'mobile_menu',
                'menu_class' => 'mobile-nav',
            ));
            ?>
        </header>
        <div class="content">
            <nav class="sidebar m-none">
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'primary_menu',
                    'menu_class' => 'primary-menu',
                ));
                ?>
            </nav>
            <main class="main">
                <div class="gallery">
                    <div class="gallery__item">
                        <?php dynamic_sidebar('banner_one'); ?>
                    </div>
                    <div class="gallery__item">
                        <?php dynamic_sidebar('banner_two'); ?>
                    </div>
                </div>