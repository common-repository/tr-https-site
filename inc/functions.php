<?php
function tr_use_ssl($ssl=false)
{
    //return if post method
    if(is_array($_POST) && count($_POST)>0)return;
    
    if($ssl && !is_ssl())
    {
        if ( 0 === strpos($_SERVER['REQUEST_URI'], 'http') ) {
    		wp_redirect(preg_replace('|^http://|', 'https://', $_SERVER['REQUEST_URI']));
    	} else {
    		wp_redirect('https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
    	}
        exit;
    }else if(!$ssl && is_ssl())
    {
       if ( 0 === strpos($_SERVER['REQUEST_URI'], 'http') ) {
    		wp_redirect(preg_replace('|^https://|', 'http://', $_SERVER['REQUEST_URI']));
    	} else {
    		wp_redirect('http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
    	}
        exit;
    }
}