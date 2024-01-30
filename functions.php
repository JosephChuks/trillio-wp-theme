<?php
add_theme_support('menus');

function custom_theme_customize_js()
    {
    wp_enqueue_script('theme-customizer', get_template_directory_uri() . '/assets/js/theme-customizer.js', array('customize-preview'), '', true);
    }
add_action('customize_preview_init', 'custom_theme_customize_js');

function enqueue_assets()
    {
    // Enqueue Stylesheets
    wp_enqueue_style('style', get_stylesheet_directory_uri() . '/style.css', array(), '1.0', 'all');
    wp_enqueue_style('fonts', 'https://fonts.googleapis.com/css?family=Open+Sans:300,400,600', array(), '1.0', 'all');
    wp_enqueue_style('main-stylesheet', get_stylesheet_directory_uri() . '/assets/css/style.css', array(), '1.0', 'all');

    // Enqueue Scripts
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
function header_widget()
    {
    register_sidebar(array(
        'name' => esc_html__('Header widget', 'trillio'),
        'id' => 'header_widget',
        'description' => esc_html__('Add Header widget', 'trillio'),
        'before_widget' => '<div id="%1$s" class="user-nav__menu widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ));
    }
add_action('widgets_init', 'header_widget');
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


function custom_theme_customize_register($wp_customize)
    {
    $wp_customize->add_section('theme_colors', array(
        'title' => __('Theme Colors', 'trillio'),
        'priority' => 30,
    ));

    $wp_customize->add_setting('color_primary', array(
        'default' => '#35a406',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'color_primary', array(
        'label' => __('Primary Color', 'trillio'),
        'section' => 'theme_colors',
    )));


    $wp_customize->add_setting('color_primary_light', array(
        'default' => '#4ce909',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'color_primary_light', array(
        'label' => __('Primary Color Light', 'trillio'),
        'section' => 'theme_colors',
    )));

    $wp_customize->add_setting('color_secondary', array(
        'default' => '#f7140d',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'color_secondary', array(
        'label' => __('Secondary Color', 'trillio'),
        'section' => 'theme_colors',
    )));


    $wp_customize->add_setting('color-grey-light-1', array(
        'default' => '#faf9f9',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'color-grey-light-1', array(
        'label' => __('Theme Background Color', 'trillio'),
        'section' => 'theme_colors',
    )));

    $wp_customize->add_setting('color-grey-light-2', array(
        'default' => '#f4f2f2',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'color-grey-light-2', array(
        'label' => __('Container Background Color', 'trillio'),
        'section' => 'theme_colors',
    )));

    $wp_customize->add_setting('color-grey-light-3', array(
        'default' => '#f0eeee',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'color-grey-light-3', array(
        'label' => __('Content Background Color', 'trillio'),
        'section' => 'theme_colors',
    )));


    $wp_customize->add_setting('color-grey-dark-1', array(
        'default' => '#333',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'color-grey-dark-1', array(
        'label' => __('Text Color', 'trillio'),
        'section' => 'theme_colors',
    )));

    $wp_customize->add_setting('color-grey-dark-2', array(
        'default' => '#333',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'color-grey-dark-2', array(
        'label' => __('Primary Menu Background', 'trillio'),
        'section' => 'theme_colors',
    )));

    $wp_customize->add_setting('color-grey-dark-3', array(
        'default' => '#999',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'color-grey-dark-3', array(
        'label' => __('Placeholder color', 'trillio'),
        'section' => 'theme_colors',
    )));

    $wp_customize->add_setting('color-grey-dark-4', array(
        'default' => '#333',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'color-grey-dark-4', array(
        'label' => __('Footer', 'trillio'),
        'section' => 'theme_colors',
    )));



    // Add section
    $wp_customize->add_section('featured_image_settings', array(
        'title' => __('Featured Image', 'trillio-simple-wordpress-theme'),
        'priority' => 30,
    ));

    // Add setting
    $wp_customize->add_setting('enable_featured_image', array(
        'default' => true,
        'sanitize_callback' => 'sanitize_checkbox',
    ));

    // Add control
    $wp_customize->add_control('enable_featured_image', array(
        'label' => __('Enable Featured Image', 'trillio-simple-wordpress-theme'),
        'section' => 'featured_image_settings',
        'type' => 'checkbox',
    ));

    }
add_action('customize_register', 'custom_theme_customize_register');


function custom_theme_customizer_styles()
    {
    $color_primary = get_theme_mod('color_primary', '#35a406');
    $color_primary_light = get_theme_mod('color_primary_light', '#4ce909');
    $color_secondary = get_theme_mod('color_primary_light', '#f7140d');
    $color_grey_light_1 = get_theme_mod('color-grey-light-1', '#faf9f9');
    $color_grey_light_2 = get_theme_mod('color-grey-light-2', '#f4f2f2');
    $color_grey_light_3 = get_theme_mod('color-grey-light-3', '#f0eeee');
    $color_grey_dark_1 = get_theme_mod('color-grey-dark-1', '#333');
    $color_grey_dark_2 = get_theme_mod('color-grey-dark-2', '#333');
    $color_grey_dark_3 = get_theme_mod('color-grey-dark-3', '#999');
    $color_grey_dark_4 = get_theme_mod('color-grey-dark-4', '#333');

    ?>
                         <style type="text/css">
                             :root {
                                 --color-primary: <?php echo $color_primary; ?>;
                                 --color-primary-light: <?php echo $color_primary_light; ?>;
                                  --color-secondary: <?php echo $color_secondary; ?>;
                                 --color-grey-light-1: <?php echo $color_grey_light_1; ?>;
                                 --color-grey-light-2: <?php echo $color_grey_light_2; ?>;
                                 --color-grey-light-3: <?php echo $color_grey_light_3; ?>;

                                 --color-grey-dark-1: <?php echo $color_grey_dark_1; ?>;
                                 --color-grey-dark-2: <?php echo $color_grey_dark_2; ?>;
                                     --color-grey-dark-4: <?php echo $color_grey_dark_4; ?>;
                                 --color-grey-dark-3: <?php echo $color_grey_dark_3; ?>;
                             }
                         </style>
                        <?php
    }
add_action('wp_head', 'custom_theme_customizer_styles');


add_action('customize_register', 'custom_theme_customize_register');

function sanitize_checkbox($input)
    {
    return (isset($input) && true == $input) ? true : false;
    }
