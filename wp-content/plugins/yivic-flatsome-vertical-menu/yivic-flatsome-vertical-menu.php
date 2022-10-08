<?php

/**
 * Plugin Name: YIVIC FS Vertical Menus
 * Description: Menu dọc cho theme Flatsome
 * Plugin URI: https://yivic.com/plugins/yivic-fs-vertical-menu
 * Author: manhphucofficial@yahoo.com
 * Author URI: https://yivic.com
 * Version: 1.0.0
 * @since 1.0.0
 */

define('YIVIC_FL_VERTICAL_MENU_VERSION', '1.0.0');
define('YIVIC_FL_VERTICAL_MENU_DIR', plugin_dir_path(__FILE__));
define('YIVIC_FL_VERTICAL_MENU_URI', plugins_url('/', __FILE__));


class YIVIC_Flatsome_Vertical_Menu
{


    /**
     * YIVIC_Flatsome_Vertical_Menu constructor.
     */
    public function __construct()
    {
        $this->includes();
        add_filter('flatsome_header_element', array($this, 'menu_element'));
        add_action('after_setup_theme', array($this, 'register_menu_location'));
        add_action('wp_enqueue_scripts', array($this, 'scripts'));

        add_action('flatsome_header_elements', array($this, 'mega_menu_template'));
    }

    public function includes()
    {
        include(YIVIC_FL_VERTICAL_MENU_DIR . 'includes/functions.php');
        include(YIVIC_FL_VERTICAL_MENU_DIR . 'includes/class-yivic-vertical-menu-settings.php');
        if (!class_exists('Menu_Icons')) {
            include(YIVIC_FL_VERTICAL_MENU_DIR . 'libs/menu-icons/menu-icons.php');
        }
    }

    public function menu_element($nav_elements)
    {
        $nav_elements['mega-menu'] = __('<span style="background-color: red">Vertical Menu</span>', 'flatsome-admin');

        return $nav_elements;
    }

    public function register_menu_location()
    {

        register_nav_menus(array(
            'mega_menu' => __('Vertical Menu', 'flatsome'),
        ));

    }

    public function scripts()
    {
        wp_enqueue_script('yivic-vertical-menu', plugin_dir_url(__FILE__) . 'assets/js/yivic-vertical-menu.js', array('jquery'), YIVIC_FL_VERTICAL_MENU_VERSION, true);
        wp_enqueue_style('yivic-vertical-menu', plugin_dir_url(__FILE__) . 'assets/css/yivic-vertical-menu.css', array(), YIVIC_FL_VERTICAL_MENU_VERSION);
    }

    public function mega_menu_template($value)
    {
        if ($value == 'mega-menu') {
            $menu_title = yivic_fl_vm_get_option('menu_title', __('DANH MỤC SẢN PHẨM', 'flatsome'));
            $menu_event = yivic_fl_vm_get_option('menu_event', 'click');
            ?>
            <div id="mega-menu-wrap" class="yivic-vm-<?php echo $menu_event; ?>">
                <div id="mega-menu-title">
                    <i class="icon-menu"></i> <?php echo $menu_title; ?>
                </div>
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'mega_menu',
                    'container' => false,
                    'menu_id' => 'mega_menu',
                    'depth' => 0,
                ));
                ?>
            </div>
            <?php
        }

    }


}

new YIVIC_Flatsome_Vertical_Menu();