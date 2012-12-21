<?php

/*
  Plugin Name: ba-vid-plugin
  Plugin URI: localhost/wordpress
  Description: video hosting plugin with MVC
  Author: baseapp systems
  Version: 1.0
  Author URI: http://baseapp.com/
 */
include_once (dirname(__FILE__) . '/controller/controller.php');
include_once (plugin_dir_path(__FILE__) . '/model/class.Videoba.php');

function call() {
    $vid = new Videoba();
    if (isset($_POST['editpost']))           //Update button pressed hg kjkjkj   
        $vid->manualSubmit1();

    if ($_GET['page'] == 'ba-submit') {     //Adding new video
        $vid->manualSubmit1();
    } else {

        if ($_GET['mode'] == 'del') {       //Delete button pressed
            wp_delete_post($_GET['id'], TRUE);
            $vid->show_main();
        } else
        if ($_GET['mode'] == 'edit') {      //Edit  button pressed
            include_once (plugin_dir_path(__FILE__) . '/views/editform.php');       //printing edit form
        } else {
            $vid->show_main();
        }
    }
}
?>
       
