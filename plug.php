<?php
/*
 * Plugin Name: TR Fix HTTPS for WordPress
 * Plugin URI: http://www.ngoctrinh.net
 * Description: Manage HTTPS for a wordpress site with easy to use settings.
 * Version: 0.1.4
 * Author: Trinh
 * Author URI: http://www.ngoctrinh.net
 * License: GPL2
*/



define('TR_HTTPS_SITE_DIR',plugin_dir_path(__FILE__).'/');
define('TR_HTTPS_SITE_URL',plugins_url('',__FILE__).'/');

include(TR_HTTPS_SITE_DIR.'inc/functions.php');

include(TR_HTTPS_SITE_DIR.'inc/init.php');

if(is_admin())
{
    include(TR_HTTPS_SITE_DIR.'inc/admin.php');
    
    include(TR_HTTPS_SITE_DIR.'inc/admin_menu.php');
    
}else
{
    include(TR_HTTPS_SITE_DIR.'inc/frontend.php');
}

