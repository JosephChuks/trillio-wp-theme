<?php


function enqueue_assets()
    {
    // Enqueue Stylesheets
    wp_enqueue_style('style', get_stylesheet_directory_uri() . '/style.css', array(), '1.0', 'all');
    wp_enqueue_style('fonts', 'https://fonts.googleapis.com/css?family=Open+Sans:300,400,600', array(), '1.0', 'all');
    wp_enqueue_style('main-stylesheet', get_stylesheet_directory_uri() . '/assets/css/style.css', array(), '1.0', 'all');

    // Enqueue Scripts
    wp_enqueue_script('g-translate', get_template_directory_uri() . '/assets/js/g-translate.js', array('jquery'), '1.0', true);
    wp_enqueue_script('main', get_template_directory_uri() . '/assets/js/main.js', array('jquery'), '1.0', true);
    }

add_action('wp_enqueue_scripts', 'enqueue_assets');

function theme_setup()
    {
    add_theme_support('post-thumbnails');
    }
add_action('after_setup_theme', 'theme_setup');

function custom_wp_title($title)
    {
    if (is_home() || is_front_page()) {
        $title = get_bloginfo('name') . ' | ' . get_bloginfo('description');
        }
    elseif (is_singular()) {
        $title = single_post_title('', false) . ' | ' . get_bloginfo('name');
        }
    elseif (is_category() || is_tag() || is_tax()) {
        $title = single_term_title('', false) . ' | ' . get_bloginfo('name');
        }
    else {
        $title = get_the_title() . ' | ' . get_bloginfo('name');
        }
    return $title;
    }
add_filter('wp_title', 'custom_wp_title', 10, 1);

function custom_document_title_parts($title_parts)
    {
    if (is_home() || is_front_page()) {
        $title_parts['title'] = get_bloginfo('name') . ' | ' . get_bloginfo('description');
        }
    elseif (is_singular()) {
        $title_parts['title'] = single_post_title('', false) . ' | ' . get_bloginfo('name');
        }
    elseif (is_category() || is_tag() || is_tax()) {
        $title_parts['title'] = single_term_title('', false) . ' | ' . get_bloginfo('name');
        }
    else {
        $title_parts['title'] = get_the_title() . ' | ' . get_bloginfo('name');
        }

    return $title_parts;
    }
add_filter('document_title_parts', 'custom_document_title_parts', 10, 1);

//Logo
function theme_customizer_settings($wp_customize)
    {
    $wp_customize->add_section('theme_logo_section', array(
        'title' => esc_html__('Logo', 'trillio'),
        'priority' => 30,
    ));

    $wp_customize->add_setting('theme_logo', array(
        'transport' => 'refresh',
    ));

    $wp_customize->add_control(new WP_Customize_Cropped_Image_Control($wp_customize, 'theme_logo', array(
        'label' => esc_html__('Upload Logo', 'trillio'),
        'section' => 'theme_logo_section',
        'settings' => 'theme_logo',
        'flex_width' => true,
        'flex_height' => true,
    )));
    }
add_action('customize_register', 'theme_customizer_settings');

// Menu

function theme_register_menus()
    {
    register_nav_menus(
        array(
            'primary_menu' => esc_html__('Primary Menu', 'trillio'),
            'mobile_menu' => esc_html__('Mobile Menu', 'trillio'),
            'footer_menu' => esc_html__('Footer Menu', 'trillio'),
        )
    );
    }
add_action('init', 'theme_register_menus');


function theme_register_sidebar()
    {
    register_sidebar(array(
        'name' => esc_html__('Sidebar Widget Area', 'trillio'),
        'id' => 'sidebar-widget-area',
        'description' => esc_html__('Add widgets here to appear in the sidebar.', 'trillio'),
        'before_widget' => '<div id="%1$s" class="widget %2$s right-sidebar__widget"><div class="right-sidebar__content">',
        'after_widget' => '</div></div>',
        'before_title' => '<div class="right-sidebar__title">',
        'after_title' => '</div>',
    ));
    }
add_action('widgets_init', 'theme_register_sidebar');
function banner_one()
    {
    register_sidebar(array(
        'name' => esc_html__('Banner One', 'trillio'),
        'id' => 'banner_one',
        'description' => esc_html__('Add banner one', 'trillio'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ));
    }
add_action('widgets_init', 'banner_one');
function banner_two()
    {
    register_sidebar(array(
        'name' => esc_html__('Banner two', 'trillio'),
        'id' => 'banner_two',
        'description' => esc_html__('Add banner two', 'trillio'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ));
    }
add_action('widgets_init', 'banner_two');
function adsense_footer()
    {
    register_sidebar(array(
        'name' => esc_html__('Footer Banner', 'trillio'),
        'id' => 'adsense_footer',
        'description' => esc_html__('Footer Banner', 'trillio'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ));
    }
add_action('widgets_init', 'adsense_footer');


function get_related_posts()
    {
    $current_post_id = get_the_ID();
    $post_categories = wp_get_post_categories($current_post_id);
    $related_posts_args = array(
        'post__not_in' => array($current_post_id),
        'category__in' => $post_categories,
        'posts_per_page' => 3,
        'orderby' => 'rand',
    );
    $related_posts_query = new WP_Query($related_posts_args);
    return $related_posts_query;
    }
