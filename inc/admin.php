<?php

add_action('post_submitbox_start', 'tr_post_submitbox_start_action');

function tr_post_submitbox_start_action() {
    global $post;
    $use_ssl = get_post_meta($post->ID ,'_use_ssl',true);
    ?>
    <input type="hidden" name="tr_act" value="update_postdata" />
    <div style="border-bottom: 1px solid #ddd;">
    <label>Use SSL: <input type="checkbox" name="use_ssl" value="1" <?php checked(true,$use_ssl,true)?> style="width: auto;min-width:20px;" /></label>
    </div>
    <?php
}

add_action('save_post','tr_savepostsubmitbox');
function tr_savepostsubmitbox($postID)
{
    if(false !== (wp_is_post_autosave($postID) || wp_is_post_revision($postID))) { return; }
    
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
    return $post->ID;
    } 
    if($_POST['tr_act']=='update_postdata')
    {
        update_post_meta($postID,'_use_ssl',$_POST['use_ssl']);
    }
        
}