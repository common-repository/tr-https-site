<?php

add_action('init','tr_template_redirect_init');
function tr_template_redirect_init()
{
    global $must_use_ssl_front;
    $settings = get_option('https_settings',array());
    if(stripos($_SERVER['REQUEST_URI'],'login')!==false)
    {
        //check ssl admin
        if($settings['admin'])
        {
            tr_use_ssl(true);
        }else
        {
            //tr_use_ssl(false);
        }
    }
    else if(isset($_POST['wp-submit']) && isset($_POST['log']))
    {
     //for login   
    }
    else if(($settings['front'] && !is_admin()) || ($settings['admin'] && is_admin()) )
    {
        tr_use_ssl(true);
        $must_use_ssl_front = true;
        
    }else if(is_admin())
    {
        //tr_use_ssl(false);
    }   
}


add_action('init','tr_content_init');
function tr_content_init()
{
    if(is_ssl())
    {
        @ob_start("tr_ob_httpshandler");
        add_filter('post_link','trssl_filter_post_link',99,3);
        add_filter('post_type_link','trssl_filter_post_link',99,3);
        add_filter('_get_page_link','tr_filter_get_page_link',99,2);
    }
        
}

function tr_ob_httpshandler($content)
{
    
    if(is_ssl())
    {
        $search = array('http://','http:\/\/');
        $replace = array('https://','https:\/\/');
    }else
    {
        $search = array('https://');
        $replace = array('http://');
        return $content;
    }
    $content = str_replace($search,$replace,$content);    
    
    $domains_not_ssl = get_option('domains_not_ssl',array());
    if(is_array($domains_not_ssl) && count($domains_not_ssl)>0)
    {
        foreach($domains_not_ssl as $dm)
        {
            $dm = trim($dm);
            if(empty($dm))continue;
            $content = preg_replace("/(https:\/\/)(www\.)?(".$dm.")/i","http://$2$3",$content);
        }
    }
    return $content;
}

function trssl_filter_post_link($permalink, $post, $leavename)
{
    $use_ssl = get_post_meta($post->ID ,'_use_ssl',true);
    
    if($use_ssl)
    {
        $permalink = preg_replace("/^(http:\/\/)/","https://",$permalink);
    }
    return $permalink;
}

function tr_filter_get_page_link($permalink, $id)
{
    $use_ssl = get_post_meta($id ,'_use_ssl',true);
    
    if($use_ssl)
    {
        $permalink = preg_replace("/^(http:\/\/)/","https://",$permalink);
    }
    return $permalink;
}