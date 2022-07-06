<?php

/**
 * Plugin Name:       Recruitment
 * Description:       Opcja odznaczenia dowolnego postu i wyświetlenie ich jako listy w pozycji "recruitment" w panelu administracyjnym .
 * Version:           1.0.0
 * Author:            Robert Dudka
 * Author URI:        https://robertrobin88.github.io/
 * License:           GPL v2 or later
 */


add_action('admin_menu', 'rd_add_css');

function rd_add_css()
{
    wp_enqueue_style('rd_add_css', plugins_url('dist/style.css', __FILE__));
}

defined('ABSPATH') or die('Houston, We Have A Problem');

add_action('admin_menu', 'add_page_recruitment');
add_action('add_meta_boxes', 'rd_add_custom_box');
add_action('save_post', 'addRecruitmentMeta');

function remove_all_recruitment_post($arrayPageId) {
    $arrayPageId;
    $stringIdToArray = explode(",", $arrayPageId);
    foreach($stringIdToArray as $pageId) {
        delete_post_meta($pageId, "recruitment", "true");
    }
}

function addRecruitmentMeta()
{
    $pageID = get_the_ID();
    if (isset($_POST['recruitment_checkbox'])) {
        add_post_meta($pageID, "recruitment", "true", true);
    } else {
        delete_post_meta($pageID, "recruitment", "true", true);
    }
}


function add_page_recruitment()
{
    add_submenu_page( 
        'options-general.php', 'Recruitment', 'Recruitment', 'manage_options', 'recruitment-settings', 'recruitment');
   
    // add_menu_page('Recruitment', 'Recruitment', 'manage_options', 'recruitment-custome', 'recruitment', 'dashicons-edit-page');
}

function remove_li(){
    delete_post_meta($_POST['remove_li'], "recruitment", "true");
}



if (isset($_POST['remove_li'])) {
    remove_li();
}
if (isset($_POST['remove_all_recruitment_post'])) {
    $arrayPageId = $_POST['remove_all_recruitment_post'];
    remove_all_recruitment_post($arrayPageId);
}

include_once('display_in_post.php');
include_once('display_in_admin_menu.php');

