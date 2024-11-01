<?php

add_action('admin_menu','trhttps_admin_menu');
function trhttps_admin_menu()
{
    add_options_page('Https Settings','Https Settings','manage_options','tr_https','tr_https_page');
    //add_menu_page('Https Settings','Https Settings','edit_pages','tr_https','tr_https_page');
}

function tr_https_page()
{
    include_once(TR_HTTPS_SITE_DIR.'templates/settings.php');
}
