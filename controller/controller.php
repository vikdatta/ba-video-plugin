<?php
if (($_GET['page'] == 'ba-submit') || ($_GET['page'] == 'ba-vid-plugin')) {
    add_action('admin_enqueue_scripts', 'load_css_scripts');      //include CSS here

    function load_css_scripts() {
        wp_register_style('validate', '/wp-content/plugins/ba-vid-plugin/css/jquery.validate.css');
        wp_register_style('validate2', '/wp-content/plugins/ba-vid-plugin/css/table.css');
        wp_enqueue_style('validate');
        wp_enqueue_style('validate2');
    }

    add_action('admin_enqueue_scripts', 'load_js_scripts');     //include .js scripts here

    function load_js_scripts() {
        wp_register_script('val1', '/wp-content/plugins/ba-vid-plugin/js/jquery.validate.js');
        wp_register_script('val2', '/wp-content/plugins/ba-vid-plugin/js/jquery.valid.calls.js');

        wp_enqueue_script('val1');
        wp_enqueue_script('val2');
    }

}




function my_admin_scripts() {
wp_enqueue_script('media-upload');
wp_enqueue_script('thickbox');
wp_register_script('my-upload', WP_PLUGIN_URL.'/ba-vid-plugin/my-script.js', array('jquery','media-upload','thickbox'));
wp_enqueue_script('my-upload');
}

function my_admin_styles() {
wp_enqueue_style('thickbox');
}

if (isset($_GET['page']) && $_GET['page'] == 'ba-submit') {
add_action('admin_print_scripts', 'my_admin_scripts');
add_action('admin_print_styles', 'my_admin_styles');
}



add_action('admin_menu', 'create_menu');         //Creating Custom Admin menu

function create_menu() {

    add_menu_page("ba-vid-plugin", "ba-vid-plugin", 0, "ba-vid-plugin", "show_video_menu", "../wp-content/plugins/BA-video/ba_icon.jpg");
    add_submenu_page("ba-vid-plugin", "ba-vid-plugin", "Manage Videos", 0, "ba-vid-plugin", "show_video_menu");
    add_submenu_page("ba-vid-plugin", "ba-vid-plugin", "Submit Videos", 0, "ba-submit", "show_video_menu");
    add_submenu_page("ba-vid-plugin", "ba-vid-plugin", "Settings", 4, "ba-settings", "show_video_menu");
}

function show_video_menu() {         //Callback function
    switch ($_GET['page']) {

        case 'ba-vid-plugin' :
            //include_once (dirname(__FILE__) . '/ba-managment.php');     //Manage Videos
            call();
            break;

        case 'ba-submit' :
            //include_once (dirname(__FILE__) . '/ba-managment.php');       //Submit Video
            call();
            break;
        
        case 'ba-settings' :
            add_option('status','publish');
            add_option('mail','no');
            call();
            break;
            
            }
}

