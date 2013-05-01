<?php
/*
  Plugin Name: Video Plugin
  Plugin URI: localhost/wordpress
  Description: video hosting plugin with MVC
  Author: baseapp systems
  Version: 3.0
  Author URI: http://baseapp.com/
 */
 
 require 'plugin-updates/plugin-update-checker.php';
$MyUpdateChecker = new PluginUpdateChecker(
    'http://192.168.0.1/vikrant/wptest/ba-vid-plugin/info.json',
    __FILE__
);
 
 
include_once (dirname(__FILE__) . '/controller/controller.php');
include_once (plugin_dir_path(__FILE__) . '/model/class.Videoba.php');

function call() {
    $vid = new Videoba();
    if ($_GET['page'] == 'ba-settings') {
        ?> <div class="icon32" id="icon-edit">
        </div><h1><?php _e( 'Settings Page','Video Plugin' );?></h1> <?php
        $vid->vidSettings();
    } else if (isset($_POST['editpost']))           //Update button pressed
        $vid->manualSubmit1();


    else if ($_GET['page'] == 'ba-submit') {     //Adding new video
        $vid->manualSubmit1();
    } else if ($_GET['page'] == 'Video') {

        if ($_GET['mode'] == 'del') {           //Delete button pressed
            $post_tmp_del = get_post($_GET['id']);
            global $current_user;
            $user_id = $post_tmp_del->post_author;
            $current_auth = $current_user->ID;

            if (($current_auth == $user_id) || ($current_user->caps['administrator'] == '1')) {
                wp_delete_post($_GET['id'], TRUE);
                $vid->show_main();
            } else {
                ?>
                <div class="wrap"><h2>&nbsp</h2>                <!-- Success message -->
                    <div class="updated" id="message" style="background-color: rgb(255, 251, 204);">
                        <p><strong>Illegal Delete request.</strong>

                    </div>
                </div><?php
            }
        } else
        if ($_GET['mode'] == 'edit') {      //Edit  button pressed
            include_once (plugin_dir_path(__FILE__) . '/views/editform.php');       //printing edit form
        } else {
            $vid->show_main();
        }
    }
}
?>