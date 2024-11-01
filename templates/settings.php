<?php
if(isset($_POST['settings']))
{
    $domains_not_ssl = explode("\n",$_POST['domains_not_ssl']);
    $dmnotssl = array();
    foreach((array)$domains_not_ssl as $dm)
    {
        $dm = trim($dm);
        $dm = str_replace(array('http://','https://','www.'),array('','',''),$dm);
        $dmnotssl[] = trim($dm);
    }
    update_option('https_settings',$_POST['settings']);    
    update_option('domains_not_ssl',$dmnotssl);
    
    $msg_success = 'Updated settings success';
}

$settings = get_option('https_settings',array());
$domains_not_ssl = get_option('domains_not_ssl',array());
$domains_not_ssl = implode("\n",(array)$domains_not_ssl);

if(!isset($settings['show_text_bottom']) || $settings['show_text_bottom'] !='off')
{
    $settings['show_text_bottom'] = 'on';
}
?>
<link href="<?php echo TR_HTTPS_SITE_URL?>/css/adminstyles.css" rel="stylesheet" type="text/css" />

<div class="wrap Settings-wrap">
    <h2>SSL Settings</h2>    
    
    <?php if(!empty($msg_success)):?>
    <div class="updated below-h2"><p><?php echo $msg_success?></p></div>
    <?php endif;?>
    
    <div class="settings-header">
        <ul>
          <li><span>SSL Settings</span></li>
        </ul>
      </div>
    <div class="settings-container">
    <form method="post" class="baseformadmin" name="blogform">
        <input type="hidden" name="settings[config]" value="1" />
    
        <table width="100%" cellspacing="0" cellpadding="6" border="0">
        <tbody><tr>
          <td width="200" valign="top"><label>
              Use in Front end             : </label></td>
          <td><input type="checkbox" id="use_front" name="settings[front]" value="1" <?php checked($settings['front'],1)?> /></td>
        </tr>
        <tr>
          <td width="auto" valign="top"><label>
              Use in Admin              : </label></td>
          <td><input type="checkbox" id="use_admin" name="settings[admin]" value="1" <?php checked($settings['admin'],1)?> /></td>
        </tr>
        <tr>
          <td width="auto" valign="top"><label>
              Show attribution link: </label></td>
          <td>
          <label>Yes <input type="radio" id="show_text_bottom" name="settings[show_text_bottom]" value="on" <?php checked($settings['show_text_bottom'],'on')?> />  </label> 
          <label>&nbsp;&nbsp;No <input type="radio" id="dshow_text_bottom" name="settings[show_text_bottom]" value="off" <?php checked($settings['show_text_bottom'],'off')?> /> </label>
          
          <div style="clear: both;"><br/>When enabled, a small link is shown in the footer of your blog telling others where they can get this software. If you disable this, please consider writing a review or placing a link elsewhere.</div>
          </td>
        </tr>
        <tr>
          <td width="auto" valign="top"><label>
              Domains not ssl              : </label></td>
          <td><textarea id="domains_not_ssl" name="domains_not_ssl"><?php echo $domains_not_ssl?></textarea>
            <p class="desc">the domains listed by each line</p></td>
        </tr>
        
        <tr> 
          
          <td></td>
          <td><span class="Send-btn"> <a onclick="document['blogform'].submit()" href="#">Save</a> </span></td>
        </tr>
      </tbody></table>
      
       
    </form>
    
    </div>

</div>