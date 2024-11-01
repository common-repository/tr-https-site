<?php

add_action('template_redirect','tr_template_redirect_broad_member');
function tr_template_redirect_broad_member($wp_query)
{
    global $must_use_ssl_front;
    
    if((is_page() || is_single()) && $must_use_ssl_front==false)
    {
        global $post;
        
        $use_ssl = get_post_meta($post->ID ,'_use_ssl',true);
        
        
        if($use_ssl && !is_ssl())
        {
            tr_use_ssl(true);
        }
        else if(!$use_ssl && is_ssl())
        {
            //tr_use_ssl(false);
        }        
    }
    return $wp_query;   
}
